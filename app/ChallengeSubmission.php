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
    protected $fillable = ['url', 'comment', 'challenge_id', "placement"];

    /**
     * Default relations.
     *
     * @var array
     */
    protected $with = ['user'];

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

    /**
     * Return all users that have voted for a given submission.
     *
     * @return Rosa\User
     */
    public function votes()
    {
        return $this->belongsToMany(User::class, 'submission_user');
    }
}
