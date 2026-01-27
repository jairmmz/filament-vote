<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    /** @use HasFactory<\Database\Factories\VoteFactory> */
    use HasFactory;

    protected $fillable = [
        'code',
        'poll_id',
        'user_id',
        'candidate_id',
        'vote_type',
        'ip_address',
        'user_agent',
    ];

    protected static function booted()
    {
        static::creating(function ($vote) {
            do {
                $code = strtoupper(str()->random(10));
            } while (self::where('code', $code)->exists());

            $vote->code = $code;
        });
    }

    public function poll()
    {
        return $this->belongsTo(Poll::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}
