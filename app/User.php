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
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'staff', 'approved', 'avatar', 'paragraph', 'student',
    ];

    protected $appends = ['name', 'attendedWeek'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Lesson relation.
     */
    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function attendance()
    {
        return $this->belongsToMany(Week::class, 'user_week');
    }

    public function terms()
    {
        return $this->belongsToMany(Term::class, 'term_user');
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

    public function getAttendedWeekAttribute()
    {
        if (!$this->student || $this->staff) {
            return false;
        }

        $date = new Carbon();

        return $this->attendance()->where('weeks.id', Week::current()->id)->exists();
    }
}
