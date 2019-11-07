<?php

namespace App\Http\Controllers;

use App\Timeline;
use Illuminate\Http\Request;

class TimelineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $events = new Timeline();

        $from = $request->from;
        $to = $request->to;

        return response()->json([
            "data" => $events->
            where("start_date", "<", $to)->
            where("end_date", ">=", $from)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $event = new Timeline();

        $event->text = strip_tags($request->text);
        $event->start_date = $request->start_date;
        $event->end_date = $request->end_date;
        $event->subject = $request->subject;
        $event->save();

        return response()->json([
            "action"=> "inserted",
            "tid" => $event->id
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Timeline  $timeline
     * @return \Illuminate\Http\Response
     */
    public function show(Timeline $timeline)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Timeline  $timeline
     * @return \Illuminate\Http\Response
     */
    public function edit(Timeline $timeline)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Timeline  $timeline
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $event = Timeline::find($id);

        $event->text = strip_tags($request->text);
        $event->start_date = $request->start_date;
        $event->end_date = $request->end_date;
        $event->subject = $request->subject;
        $event->save();

        return response()->json([
            "action"=> "updated"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Timeline  $timeline
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Timeline::find($id);
        $event->delete();

        return response()->json([
            "action"=> "deleted"
        ]);
    }
}
