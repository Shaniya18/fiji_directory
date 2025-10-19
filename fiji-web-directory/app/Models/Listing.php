<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_name',
        'description',
        'contact_email',
        'phone_number',
        'website_url',
        'region',
        'tags',
        'average_rating',
        'user_id',
        'category_id',
    ];

    protected $casts = [
        'average_rating' => 'float',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function address()
    {
        return $this->hasOne(Address::class);
    }

    // Calculate average rating
    public function updateAverageRating()
    {
        $this->average_rating = $this->reviews()->avg('rating') ?? 0;
        $this->save();
    }
}