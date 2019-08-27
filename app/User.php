<?php

namespace Rosa;

use Carbon\Carbon;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * Assignable attributes.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'staff', 'approved', 'avatar', 'paragraph', 'student', 'score',
    ];

    /**
     * Appended attributes.
     *
     * @var array
     */
    protected $appends = ['name', 'attendedWeek'];

    /**
     * Default load relations.
     *
     * @var array
     */
    protected $with = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Return the ranking of a user in the highscores.
     *
     * @return int
     */
    public function position()
    {
        $ranked = self::orderBy('score', 'DESC')->where('student', true)->get()->unique('score');

        $rank = 0;

        foreach ($ranked->toArray() as $index => $user) {
            if ($user['score'] == $this->score) {
                $rank = $index + 1;
            }
        }

        return $rank;
    }

    /**
     * Lesson relation.
     *
     * @return Rosa\Lesson
     */
    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    /**
     * return all attended weeks.
     *
     * @return Rosa\Week
     */
    public function attendance()
    {
        return $this->belongsToMany(Week::class, 'user_week');
    }

    /**
     * Return all attended terms.
     *
     * @return Rosa\Term
     */
    public function terms()
    {
        return $this->belongsToMany(Term::class, 'term_user');
    }

    /**
     * Return challengeSubmission relation 
     *
     * @return Rosa\ChallengeSubmission
     */
    public function challengeSubmissions()
    {
        return $this->hasMany(ChallengeSubmission::class);
    }

    /* Attributes */

    /**
     * Returns the user name fully written out.
     *
     * @return string
     */
    public function getNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * Return whether user attended current week
     *
     * @return bool
     */
    public function getAttendedWeekAttribute()
    {
        $date = new Carbon();

        if (!Week::current()) {
            return false;
        }

        return $this->attendance()->where('weeks.id', Week::current()->id)->exists();
    }
}
