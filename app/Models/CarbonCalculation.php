<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarbonCalculation extends Model
{
    protected $fillable = [
        'user_id', 'action_type', 'amount', 'impact_value'
    ];

    protected $casts = [
        'amount' => 'integer',
        'impact_value' => 'float'
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function calculateImpact($type, $amount)
    {
        $multipliers = [
            'penanaman_pohon' => 21,
            'pengurangan_plastik' => 1,
            'pengurangan_emisi' => 2.3
        ];
        return $amount * ($multipliers[$type] ?? 0);
    }
} 