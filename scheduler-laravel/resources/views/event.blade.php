@extends('master')

@section('styles')
    <link rel="stylesheet" href="{{asset('scheduler_trial/codebase/dhtmlxscheduler.css')}}">
    <link rel="stylesheet" href="{{asset('scheduler_trial/codebase/dhtmlxscheduler_material.css')}}">
    <style type="text/css">
        body{
            height:80%;
            width: 100%;
            padding:0px;
            margin:0px;
            overflow: hidden;
        }
    </style>
@stop

@section('scripts')
    <script src="{{asset('scheduler_trial/codebase/dhtmlxscheduler.js')}}"></script>
@stop

@section('content')
    <div id="scheduler_here" class="dhx_cal_container" style='width:100%; height:100%;'>
        <div class="dhx_cal_navline">
            <div class="dhx_cal_prev_button">&nbsp;</div>
            <div class="dhx_cal_next_button">&nbsp;</div>
            <div class="dhx_cal_today_button"></div>
            <div class="dhx_cal_date"></div>
            <div class="dhx_cal_tab" name="day_tab"></div>
            <div class="dhx_cal_tab" name="week_tab"></div>
            <div class="dhx_cal_tab" name="month_tab"></div>
        </div>
        <div class="dhx_cal_header"></div>
        <div class="dhx_cal_data"></div>
    </div>
    <script type="text/javascript">
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();

        today = mm + '-' + dd + '-' + yyyy;

        scheduler.init("scheduler_here");
        scheduler.setLoadMode("month");


        scheduler.config.date_format = "%Y-%m-%d %H:%i:%s";
        scheduler.init("scheduler_here", today, "month");

        scheduler.load("/events", "json");
        var dp = new dataProcessor("/events");
        dp.init(scheduler);
        dp.setTransactionMode("REST");
    </script>

@endsection
