<?php

namespace Rosa;

use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    /**
     * Fillable properties.
     *
     * @var array
     */
    protected $fillable = ['title', 'description', 'image'];

    /* Relations */

    /**
     * Return week relation.
     *
     * @return Rosa\Week
     */
    public function week()
    {
        return $this->belongsTo(Week::class);
    }

    /**
     * Return winners.
     *
     * @return Rosa\User
     */
    public function winners()
    {
        return $this->belongsToMany(User::class, 'challenge_user')->withPivot('placement');
    }

    /**
     * Return all submissions.
     *
     * @return Rosa\Submission
     */
    public function submissions()
    {
        return $this->hasMany(ChallengeSubmission::class);
    }
}
