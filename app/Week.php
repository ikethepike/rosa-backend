<?php

namespace Rosa;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Week extends Model
{
    /**
     * Fillable properties.
     *
     * @var array
     */
    protected $fillable = ['name', 'class', 'number', 'starts_at', 'ends_at'];

    /**
     * Default relations.
     */
    protected $appends = ['date'];

    /* Relations */

    /**
     * Return the attached term.
     *
     * @return Rosa\Term
     */
    public function term()
    {
        return $this->hasOne(Term::class);
    }

    /**
     * Return lessons.
     *
     * @return Rosa\Lesson
     */
    public function lessons()
    {
        return $this->belongsToMany(Lesson::class, 'lesson_week');
    }

    /**
     * Return weekly attendance.
     *
     * @return Rosa\User
     */
    public function attendance()
    {
        return $this->belongsToMany(User::class, 'user_week');
    }

    /**
     * Return weekly challenge.
     *
     * @return Rosa\Challenge
     */
    public function challenge()
    {
        return $this->hasOne(Challenge::class);
    }

    /* Attributes */

    /**
     * Return week status.
     *
     * @return string
     */
    public function getDateAttribute()
    {
        $week = (int) date('W');

        if ($this->number == $week) {
            return 'current';
        }

        if ($this->number < $week) {
            return 'past';
        }

        return 'future';
    }

    /**
     * Return the current week.
     *
     * @return Rosa\Week
     */
    public static function current()
    {
        $date = Carbon::now();

        return Week::whereYear('starts_at', $date)->where('number', $date->format('W'))->first();
    }
}
