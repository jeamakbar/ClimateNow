<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonitoringLocation extends Model
{
    protected $fillable = [
        'name', 'latitude', 'longitude', 'description',
        'impact_type', 'image', 'reported_by'
    ];

    // Relationships
    public function reporter()
    {
        return $this->belongsTo(User::class, 'reported_by');
    }

    public function scopeNearby($query, $lat, $lng, $radius = 5)
    {
        return $query->whereRaw("
            ST_Distance_Sphere(
                point(longitude, latitude),
                point(?, ?)
            ) <= ?
        ", [$lng, $lat, $radius * 1000]);
    }
} 