<?php

namespace Rosa;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    // Fillable
    protected $fillable = ['starts_at', 'ends_at'];

    public function createWeeks()
    {
        $end   = Carbon::parse($this->ends_at);
        $start = Carbon::parse($this->starts_at);

        $weeks = $start->diffInWeeks($end);

        for ($i=0; $i < $weeks; ++$i) {
            $this->weeks()->create([
                'number'    => $start->format('W'),
                'starts_at' => $start->copy()->startOfWeek(),
                'ends_at'   => $start->copy()->endOfWeek(),
            ]);

            $start->addWeek();
        }
    }

    public function weeks()
    {
        return $this->hasMany(Week::class);
    }
}
