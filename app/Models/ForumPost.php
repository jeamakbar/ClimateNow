<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForumPost extends Model
{
    protected $fillable = [
        'title', 'content', 'category', 'user_id'
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reactions()
    {
        return $this->hasMany(ForumReaction::class, 'post_id');
    }

    public function comments()
    {
        return $this->hasMany(ForumComment::class, 'post_id');
    }

    // Helper methods
    public function getLikesCount()
    {
        return $this->reactions()->where('reaction_type', 'like')->count();
    }

    public function getDislikesCount()
    {
        return $this->reactions()->where('reaction_type', 'dislike')->count();
    }

    public function scopeTrending($query)
    {
        return $query->withCount('reactions')
                     ->orderBy('reactions_count', 'desc');
    }
} 