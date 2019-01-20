<?php

namespace Rosa;

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
        'first_name', 'last_name', 'email', 'password', 'staff', 'approved', 'avatar', 'paragraph',
    ];

    protected $appends = ['name'];

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

    public function getNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
