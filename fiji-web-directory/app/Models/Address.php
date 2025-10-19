<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'listing_id',
        'street',
        'city',
        'province_state',
        'country',
        'latitude',
        'longitude',
    ];

    protected $casts = [
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
    ];

    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }
}