<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'parent_category_id',
    ];

    // Parent category relationship
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_category_id');
    }

    // Child categories (subcategories)
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_category_id');
    }

    // Listings in this category
    public function listings()
    {
        return $this->hasMany(Listing::class);
    }

    // Submissions for this category
    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }
}
