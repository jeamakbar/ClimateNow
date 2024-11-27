<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'name', 'event_date', 'location', 'description', 'image', 'created_by'
    ];

    protected $casts = [
        'event_date' => 'datetime'
    ];

    // Relationships
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function participants()
    {
        return $this->hasMany(EventParticipant::class);
    }

    // Helper methods
    public function getAverageRating()
    {
        return $this->participants()->whereNotNull('rating')->avg('rating') ?? 0;
    }

    public function isUserParticipating($userId)
    {
        return $this->participants()
                    ->where('user_id', $userId)
                    ->exists();
    }
} 