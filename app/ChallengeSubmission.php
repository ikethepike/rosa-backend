<?php

namespace Rosa;

use Illuminate\Database\Eloquent\Model;

class ChallengeSubmission extends Model
{
    /**
     * Fillable properties.
     *
     * @var array
     */
    protected $fillable = ['url', 'comment'];

    /* Relations */

    /**
     * Return User relation.
     *
     * @return Rosa\User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Return challenge relation.
     *
     * @return Rosa\Challenge
     */
    public function challenge()
    {
        return $this->belongsTo(Challenge::class);
    }
}
