<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
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
        'status',
        'category_id',
        'user_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Check if pending
    public function isPending()
    {
        return $this->status === 'pending';
    }

    // Check if approved
    public function isApproved()
    {
        return $this->status === 'approved';
    }
}