<?php

namespace Rosa\Http\Controllers\Api;

namespace Rosa\Http\Controllers\Api;

use Rosa\User;
use Rosa\Week;
use Carbon\Carbon;
use Rosa\Challenge;
use Illuminate\Http\Request;
use Rosa\Http\Controllers\Controller;
use Rosa\Http\Requests\WinnerRequest;
use Rosa\Http\Requests\Challenge\StoreRequest;

class ChallengeController extends Controller
{
    /**
     * Return the relevant challenge week.
     *
     * @return Rosa\Week
     */
    public static function currentWeek()
    {
        $now = Carbon::now();

        if ($now->dayOfWeek < 3) {
            $now->subWeek();
        }

        return Week::where('number', $now->format('W'))->whereYear('starts_at', $now)->first();
    }

    /**
     * Return the current challenge of the week.
     *
     * @return Rosa\Challenge
     */
    public static function currentChallenge()
    {
        return $this->currentWeek()->load(['challenge.winners', 'challenge.submissions.votes'])->challenge;
    }

    /**
     * Return all submissions for a given or current week.
     *
     * @param $weekId
     *
     * @return array
     */
    public function submissions($weekId = null)
    {
        if ($weekId) {
            $week = Week::findOrFail($weekId);
        } else {
            $week = $this->currentWeek();
        }

        return $week->load('challenge.submissions')->challenge->submissions->orderBy('id', 'DESC');
    }

    /**
     * Add a winner to the challenge.
     *
     * @param Request $request
     *
     * @return Rosa\Challenge
     */
    public function addWinner(WinnerRequest $request)
    {
        $scores = [40, 30, 20, 10, 5];

        $user = User::findOrFail($request->user_id);

        $user->score = $scores[$request->placement - 1];
        $user->save();

        $current =$this->currentWeek();

        DB::insert('insert into challenge_user (user_id, week_id, placement) values (?, ?, ?)', [$request->user_id, $current->id, $request->placement]);

        return $current->load('challenge.winners')->challenge;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Challenge::all()->load('winners');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        return$this->currentWeek()->challenge()->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Challenge::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRequest $request, $id)
    {
        return Challenge::findOrFail($id)->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Challenge::findOrFail($id)->destroy();
    }
}
