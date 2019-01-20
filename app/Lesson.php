<?php

namespace Rosa;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    // fillable
    protected $fillable = ['masthead', 'title', 'text', 'boilerplate', 'disable_editor'];

    /* Relations */

    /**
     * Author of the lesson.
     *
     * @return Rosa\User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lessons()
    {
        return $this->belongsToMany(Week::class, 'lesson_week');
    }
}
