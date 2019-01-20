<?php

namespace Rosa\Http\Controllers;

use Rosa\Term;
use Rosa\Week;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PlanningController extends Controller
{
    public function planning()
    {
        return $this->activeTerm();
    }

    private function activeTerm()
    {
        return Term::whereDate('starts_at', '<', date('Y-m-d'))->whereDate('ends_at', '>', date('Y-m-d'))->with('weeks.lessons.user')->first();
    }

    public function createTerm(Request $request)
    {
        $date = new Carbon();
        $date->setISODate((int) date('Y'), $request->week);

        if (Term::whereDate('ends_at', '>', $date->format('Y-m-d'))->exists()) {
            return abort(409, 'Term already exists');
        }

        $term = Term::create(['ends_at' => $date->endOfWeek()]);

        // Let's the weeks
        $term->createWeeks();

        return $term->load('weeks.lessons.user');
    }

    public function attachLesson(Request $request)
    {
        $week = Week::findOrFail($request->week);
        $week->lessons()->attach($request->lesson);
    }

    public function detachLesson(Request $request)
    {
        $week = Week::findOrFail($request->week);
        $week->lessons()->detach($request->lesson);
    }
}
