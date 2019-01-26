<?php

namespace Rosa;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Week extends Model
{
    // Fillable
    protected $fillable = ['name', 'class', 'number', 'starts_at', 'ends_at'];

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

    public function lessons()
    {
        return $this->belongsToMany(Lesson::class, 'lesson_week');
    }

    public function attendance()
    {
        return $this->belongsToMany(User::class, 'user_week');
    }

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

    public static function current()
    {
        $date = Carbon::now();

        return Week::whereYear('starts_at', $date)->where('number', $date->format('W'))->first();
    }
}
