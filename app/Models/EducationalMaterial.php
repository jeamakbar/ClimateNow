<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EducationalMaterial extends Model
{
    protected $fillable = [
        'title', 'category', 'image', 'difficulty', 'description', 
        'created_by', 'views', 'file_path'
    ];

    protected $casts = [
        'views' => 'integer'
    ];

    // Relationships
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Helper methods
    public function incrementViews()
    {
        $this->increment('views');
    }

    public function scopeByCategory($query, $category)
    {
        if ($category === 'terpopuler') {
            return $query->orderBy('views', 'desc');
        }
        return $query->where('category', $category);
    }
} 