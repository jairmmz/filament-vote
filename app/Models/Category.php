<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'is_active',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function polls()
    {
        return $this->hasMany(Poll::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function activePolls()
    {
        return $this->hasMany(Poll::class)->whereIn('status', ['activo', 'cerrado']);
    }
}
