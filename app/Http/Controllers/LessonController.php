<?php

namespace Rosa\Http\Controllers;

use Storage;
use Rosa\Lesson;
use Illuminate\Http\Request;
use Rosa\Http\Requests\lessons\LessonRequest;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Lesson::with('user')->orderBy('id', 'DESC')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(LessonRequest $request)
    {
        return auth()->user()->lessons()->create($request->all());
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
        return Lesson::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(LessonRequest $request, $id)
    {
        return (string) Lesson::findOrFail($id)->update($request->all());
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
        Lesson::delete($id);
    }

    public function masthead(Request $request)
    {
        $url = Storage::putFile('mastheads', $request->file('masthead'));
        if ($url) {
            return Storage::url($url);
        }
    }

    
}
