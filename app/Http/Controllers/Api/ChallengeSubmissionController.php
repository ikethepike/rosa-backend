<?php

namespace Rosa\Http\Controllers\Api;

use Illuminate\Http\Request;
use Rosa\ChallengeSubmission;
use Rosa\Http\Controllers\Controller;
use Rosa\Http\Requests\ChallengeSubmission\StoreRequest;

class ChallengeSubmissionController extends Controller
{
    /**
     * Applaud a user for their work.
     *
     * @param Request $request
     *
     * @return int
     */
    public function applaud(Request $request)
    {
        $submission = ChallengeSubmission::findOrFail($request->submission);

        if ($submission->user_id === $request->user()->id) {
            return abort(401, 'No cheating');
        }

        if ($submission->votes()->where('users.id', $request->user()->id)->exists()) {
            return abort(409, 'Already voted');
        }

        $submission->user->score += 5;
        $submission->user->save();

        $submission->votes()->attach($request->user());

        return $submission->load('votes');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ChallengeSubmission::all();
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
        $currentChallenge       = ChallengeController::currentChallenge();
        $create                 = $request->all();
        $create['challenge_id'] = $currentChallenge->id;

        $user = $request->user();
        $user->score += 40;
        $user->save();

        return $user->challengeSubmissions()->create($create)->load('user');
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
        return ChallengeSubmission::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return ChallengeSubmission::findOrFail($id)->update($request->all());
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
        return (int) ChallengeSubmission::findOrFail($id)->destroy();
    }
}
