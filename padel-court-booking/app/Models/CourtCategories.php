<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany; 

class CourtCategories extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_name',
        'description',
    ];

    public function courts(): HasMany
    {
        return $this->hasMany(Courts::class, 'court_category_id');
    }
}