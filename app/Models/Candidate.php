<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    /** @use HasFactory<\Database\Factories\CandidateFactory> */
    use HasFactory;

    protected $fillable = [
        'poll_id',
        'political_party_id',
        'name',
        'photo',
        'biography',
        'proposals',
        'number',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'proposals' => 'array',
            'is_active' => 'boolean',
        ];
    }

    public function poll()
    {
        return $this->belongsTo(Poll::class);
    }

    public function politicalParty()
    {
        return $this->belongsTo(PoliticalParty::class);
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}
