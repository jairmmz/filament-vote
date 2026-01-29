<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoliticalParty extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'acronym',
        'logo',
        'color',
        'description',
        'website',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function candidates()
    {
        return $this->hasMany(Candidate::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
