<?php

namespace Rosa;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    // fillable
    protected $fillable = ['masthead', 'title', 'text'];
}
