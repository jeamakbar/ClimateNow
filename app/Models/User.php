<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
        'name', 'email', 'password', 'profile_picture', 'theme', 'is_admin'
    ];

    protected $hidden = ['password'];

    protected $casts = [
        'is_admin' => 'boolean',
    ];

    // Relationships
    public function events()
    {
        return $this->hasMany(Event::class, 'created_by');
    }

    public function eventParticipations()
    {
        return $this->hasMany(EventParticipant::class);
    }

    public function educationalMaterials()
    {
        return $this->hasMany(EducationalMaterial::class, 'created_by');
    }

    public function carbonCalculations()
    {
        return $this->hasMany(CarbonCalculation::class);
    }

    public function forumPosts()
    {
        return $this->hasMany(ForumPost::class);
    }

    public function forumReactions()
    {
        return $this->hasMany(ForumReaction::class);
    }

    public function forumComments()
    {
        return $this->hasMany(ForumComment::class);
    }

    public function news()
    {
        return $this->hasMany(News::class, 'created_by');
    }

    public function monitoringLocations()
    {
        return $this->hasMany(MonitoringLocation::class, 'reported_by');
    }

    public function toggleTheme()
    {
        $this->theme = $this->theme === 'dark' ? 'light' : 'dark';
        $this->save();
        return $this->theme;
    }
}
