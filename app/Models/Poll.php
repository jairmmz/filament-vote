<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Poll extends Model
{
    /** @use HasFactory<\Database\Factories\PollFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'slug',
        'description',
        'image',
        'location',
        'status',
        'starts_at',
        'ends_at',
    ];

    protected function casts(): array
    {
        return [
            'starts_at' => 'datetime',
            'ends_at' => 'datetime',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function candidates()
    {
        return $this->hasMany(Candidate::class)->orderBy('id');
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    public function scopeActives($query)
    {
        return $query->whereIn('status', ['activo', 'cerrado']);
    }

    public function actionLabel(?User $user): ?string
    {
        if ($this->status === 'cerrado' || $this->ends_at->isPast()) {
            return 'Ver Resultados';
        }

        if ($this->status === 'activo') {
            if ($user && $user->hasVotedInPoll($this)) {
                return 'Ver Resultados';
            }

            return 'Votar Ahora';
        }

        return null;
    }
}
