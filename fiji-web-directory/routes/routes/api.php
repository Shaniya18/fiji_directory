<?php

// Set the content type to application/json
header('Content-Type: application/json');

// Allow requests from any origin for development purposes
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Handle preflight OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// --- Database Configuration ---
// IMPORTANT: Replace these with your actual database credentials.
$host = 'localhost';
$dbname = 'your_directory_db';
$user = 'your_username';
$password = 'your_password';

// Use PDO to connect to the database.
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    // Set PDO attributes to throw exceptions on error
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Return objects, which is often more convenient than arrays
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database connection failed: ' . $e->getMessage()]);
    exit;
}

// --- Helper Functions ---

/**
 * Sends a JSON response and exits.
 * @param mixed $data The data to be encoded as JSON.
 * @param int $statusCode The HTTP status code.
 */
function sendResponse($data, $statusCode = 200) {
    http_response_code($statusCode);
    echo json_encode($data);
    exit;
}

/**
 * Checks for a valid authentication token and returns the user object.
 * @param PDO $pdo The PDO database connection object.
 * @return object|false The authenticated user object or false if authentication fails.
 */
function getAuthenticatedUser($pdo) {
    // Look for the Authorization header
    $headers = getallheaders();
    if (!isset($headers['Authorization'])) {
        return false;
    }
    
    list($type, $token) = explode(' ', $headers['Authorization']);

    // Check if the token type is 'Bearer'
    if ($type !== 'Bearer' || empty($token)) {
        return false;
    }
    
    // In a real application, you would validate this token against a database.
    // For this example, we'll assume the token is the user's ID for simplicity.
    // Replace this with a more secure token validation logic.
    $stmt = $pdo->prepare("SELECT * FROM users WHERE auth_token = ? LIMIT 1");
    $stmt->execute([$token]);
    $user = $stmt->fetch();
    
    return $user;
}

/**
 * Checks if the authenticated user is an admin.
 * @param object|false $user The user object from getAuthenticatedUser().
 * @return bool True if the user is an admin, false otherwise.
 */
function isAdmin($user) {
    return $user && isset($user->is_admin) && $user->is_admin == 1;
}

// --- API Routing ---
$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestUri = explode('/', trim($_SERVER['REQUEST_URI'], '/'));

// Check for the base URL `/api/v1/`
if ($requestUri[0] !== 'api' || (isset($requestUri[1]) && $requestUri[1] !== 'v1')) {
    sendResponse(['error' => 'Invalid API version.'], 404);
}

// Remove the base URL parts
array_shift($requestUri); // 'api'
array_shift($requestUri); // 'v1'

$resource = array_shift($requestUri);
$id = array_shift($requestUri);
$subResource = array_shift($requestUri);

// Get the request body if it exists
$input = json_decode(file_get_contents("php://input"), true);

// --- Main API Logic ---
switch ($resource) {
    // --- Authentication Endpoints ---
    case 'auth':
        if ($subResource === 'login' && $requestMethod === 'POST') {
            // NOTE: This is a simplified login. In a real application, passwords should be hashed and verified.
            $stmt = $pdo->prepare("SELECT id, username, is_admin FROM users WHERE username = ? AND password_hash = ? LIMIT 1");
            $stmt->execute([$input['username'], sha1($input['password'])]); // Using SHA1 for example, but use something stronger like password_hash()
            $user = $stmt->fetch();
            
            if ($user) {
                // Generate and store a token
                $token = bin2hex(random_bytes(16));
                $updateStmt = $pdo->prepare("UPDATE users SET auth_token = ? WHERE id = ?");
                $updateStmt->execute([$token, $user->id]);
                
                sendResponse(['token' => $token], 200);
            } else {
                sendResponse(['error' => 'Invalid credentials.'], 401);
            }
        } elseif ($subResource === 'verify-token' && $requestMethod === 'GET') {
            $user = getAuthenticatedUser($pdo);
            if ($user) {
                sendResponse([
                    'is_valid' => true,
                    'user' => [
                        'username' => $user->username,
                        'is_admin' => $user->is_admin == 1
                    ]
                ], 200);
            } else {
                sendResponse(['is_valid' => false, 'error' => 'Invalid token.'], 401);
            }
        } else {
            sendResponse(['error' => 'Endpoint not found.'], 404);
        }
        break;

    // --- Public Endpoints ---
    case 'listings':
        if ($requestMethod === 'GET') {
            if ($id) {
                // Retrieve a single approved listing
                $stmt = $pdo->prepare("SELECT * FROM listings WHERE id = ? AND is_approved = 1");
                $stmt->execute([$id]);
                $listing = $stmt->fetch();
                if ($listing) {
                    sendResponse($listing);
                } else {
                    sendResponse(['error' => 'Listing not found.'], 404);
                }
            } else {
                // Retrieve all approved listings
                $stmt = $pdo->query("SELECT * FROM listings WHERE is_approved = 1");
                $listings = $stmt->fetchAll();
                sendResponse($listings);
            }
        } elseif ($subResource === 'reviews' && $requestMethod === 'POST' && $id) {
            // Submit a new review for a listing
            $stmt = $pdo->prepare("INSERT INTO reviews (listing_id, rating, comment) VALUES (?, ?, ?)");
            try {
                $stmt->execute([$id, $input['rating'], $input['comment']]);
                sendResponse(['review_id' => $pdo->lastInsertId(), 'message' => 'Review submitted successfully.'], 201);
            } catch (PDOException $e) {
                sendResponse(['error' => 'Failed to submit review.', 'details' => $e->getMessage()], 400);
            }
        } elseif ($requestMethod === 'PUT' && $id) { // Admin-only
            $user = getAuthenticatedUser($pdo);
            if (!isAdmin($user)) {
                sendResponse(['error' => 'Forbidden. Admin access required.'], 403);
            }
            $updateFields = [];
            $values = [];
            foreach ($input as $key => $value) {
                $updateFields[] = "$key = ?";
                $values[] = $value;
            }
            $values[] = $id;

            $sql = "UPDATE listings SET " . implode(', ', $updateFields) . " WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            try {
                $stmt->execute($values);
                sendResponse(['listing_id' => $id, 'message' => 'Listing updated successfully.'], 200);
            } catch (PDOException $e) {
                sendResponse(['error' => 'Failed to update listing.', 'details' => $e->getMessage()], 400);
            }
        } elseif ($requestMethod === 'DELETE' && $id) { // Admin-only
            $user = getAuthenticatedUser($pdo);
            if (!isAdmin($user)) {
                sendResponse(['error' => 'Forbidden. Admin access required.'], 403);
            }
            $stmt = $pdo->prepare("DELETE FROM listings WHERE id = ?");
            $stmt->execute([$id]);
            sendResponse(['message' => 'Listing deleted successfully.'], 200);
        } else {
            sendResponse(['error' => 'Method or endpoint not allowed for listings.'], 405);
        }
        break;

    case 'categories':
        if ($requestMethod === 'GET') {
            // Retrieve all categories
            $stmt = $pdo->query("SELECT * FROM categories");
            $categories = $stmt->fetchAll();
            sendResponse($categories);
        } elseif ($requestMethod === 'POST') { // Admin-only
            $user = getAuthenticatedUser($pdo);
            if (!isAdmin($user)) {
                sendResponse(['error' => 'Forbidden. Admin access required.'], 403);
            }
            $stmt = $pdo->prepare("INSERT INTO categories (name, parent_id) VALUES (?, ?)");
            try {
                $stmt->execute([$input['name'], $input['parent_id']]);
                sendResponse(['category_id' => $pdo->lastInsertId(), 'message' => 'Category created.'], 201);
            } catch (PDOException $e) {
                sendResponse(['error' => 'Failed to create category.', 'details' => $e->getMessage()], 400);
            }
        } elseif ($requestMethod === 'PUT' && $id) { // Admin-only
            $user = getAuthenticatedUser($pdo);
            if (!isAdmin($user)) {
                sendResponse(['error' => 'Forbidden. Admin access required.'], 403);
            }
            $stmt = $pdo->prepare("UPDATE categories SET name = ? WHERE id = ?");
            try {
                $stmt->execute([$input['name'], $id]);
                sendResponse(['category_id' => $id, 'message' => 'Category updated.'], 200);
            } catch (PDOException $e) {
                sendResponse(['error' => 'Failed to update category.', 'details' => $e->getMessage()], 400);
            }
        } elseif ($requestMethod === 'DELETE' && $id) { // Admin-only
            $user = getAuthenticatedUser($pdo);
            if (!isAdmin($user)) {
                sendResponse(['error' => 'Forbidden. Admin access required.'], 403);
            }
            // In a real application, you would handle child categories and their listings.
            $pdo->prepare("DELETE FROM categories WHERE id = ?")->execute([$id]);
            sendResponse(['message' => 'Category deleted.'], 200);
        } else {
            sendResponse(['error' => 'Method or endpoint not allowed for categories.'], 405);
        }
        break;

    case 'submissions':
        if ($requestMethod === 'POST') { // Public
            $stmt = $pdo->prepare("INSERT INTO submissions (business_name, description, contact_email, phone_number, website_url, category_id, status) VALUES (?, ?, ?, ?, ?, ?, ?)");
            try {
                $stmt->execute([$input['business_name'], $input['description'], $input['contact_email'], $input['phone_number'], $input['website_url'], $input['category_id'], 'pending']);
                sendResponse(['submission_id' => $pdo->lastInsertId(), 'status' => 'pending'], 201);
            } catch (PDOException $e) {
                sendResponse(['error' => 'Failed to create submission.', 'details' => $e->getMessage()], 400);
            }
        } elseif ($requestMethod === 'GET') { // Admin-only
            $user = getAuthenticatedUser($pdo);
            if (!isAdmin($user)) {
                sendResponse(['error' => 'Forbidden. Admin access required.'], 403);
            }
            $stmt = $pdo->query("SELECT * FROM submissions WHERE status = 'pending'");
            $submissions = $stmt->fetchAll();
            sendResponse($submissions);
        } elseif ($requestMethod === 'PUT' && $id) { // Admin-only
            $user = getAuthenticatedUser($pdo);
            if (!isAdmin($user)) {
                sendResponse(['error' => 'Forbidden. Admin access required.'], 403);
            }
            if (!isset($input['status']) || ($input['status'] !== 'approved' && $input['status'] !== 'rejected')) {
                sendResponse(['error' => 'Invalid status provided.'], 400);
            }
            $stmt = $pdo->prepare("UPDATE submissions SET status = ? WHERE id = ?");
            $stmt->execute([$input['status'], $id]);
            sendResponse(['submission_id' => $id, 'message' => 'Submission updated.'], 200);
        } else {
            sendResponse(['error' => 'Method not allowed for submissions.'], 405);
        }
        break;
    
    default:
        sendResponse(['error' => 'Resource not found.'], 404);
        break;
}

?>
