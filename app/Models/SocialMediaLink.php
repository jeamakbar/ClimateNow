<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialMediaLink extends Model
{
    protected $fillable = [
        'platform', 'url', 'icon'
    ];

    public function getIconPath()
    {
        return $this->icon ?? "icons/{$this->platform}.svg";
    }
} 