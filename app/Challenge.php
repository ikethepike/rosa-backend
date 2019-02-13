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
}
