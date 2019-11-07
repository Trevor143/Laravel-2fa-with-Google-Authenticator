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
        .dhx_cal_event div.dhx_footer,
        .dhx_cal_event.past_event div.dhx_footer,
        .dhx_cal_event.event_meeting div.dhx_footer,
        .dhx_cal_event.event_delivery div.dhx_footer,
        .dhx_cal_event.event_crucial div.dhx_footer{
            background-color: transparent !important;
        }
        .dhx_cal_event .dhx_body{
            -webkit-transition: opacity 0.1s;
            transition: opacity 0.1s;
            opacity: 0.7;
        }
        .dhx_cal_event .dhx_title{
            line-height: 12px;
        }
        .dhx_cal_event_line:hover,
        .dhx_cal_event:hover .dhx_body,
        .dhx_cal_event.selected .dhx_body,
        .dhx_cal_event.dhx_cal_select_menu .dhx_body{
            opacity: 1;
        }

        .dhx_cal_event.event_delivery div,
        .dhx_cal_event_line.event_delivery{
            background-color: #FF5722 !important;
            border-color: #732d16 !important;
        }

        .dhx_cal_event.dhx_cal_editor.event_delivery{
            background-color: #FF5722 !important;
        }

        .dhx_cal_event_clear.event_delivery{
            color:#FF5722 !important;
        }

        .dhx_cal_event.event_crucial div,
        .dhx_cal_event_line.event_crucial{
            background-color: #0FC4A7 !important;
            border-color: #698490 !important;
        }

        .dhx_cal_event.dhx_cal_editor.event_crucial{
            background-color: #0FC4A7 !important;
        }

        .dhx_cal_event_clear.event_crucial{
            color:#0FC4A7 !important;
        }

        .dhx_cal_event.event_meeting div,
        .dhx_cal_event_line.event_meeting{
            background-color: #684f8c !important;
            border-color: #9575CD !important;
        }

        .dhx_cal_event.dhx_cal_editor.event_meeting{
            background-color: #684f8c !important;
        }

        .dhx_cal_event_clear.event_meeting{
            color:#B82594 !important;
        }
    </style>
@stop

@section('scripts')
    <script src="{{asset('scheduler_trial/codebase/dhtmlxscheduler.js')}}"></script>
    <script type="text/javascript">
        function init() {
            scheduler.config.time_step = 30;
            scheduler.config.multi_day = true;
            scheduler.locale.labels.section_subject = "Type";
            scheduler.config.first_hour = 8;
            scheduler.config.limit_time_select = true;
            scheduler.config.details_on_dblclick = true;
            scheduler.config.details_on_create = true;

            scheduler.templates.event_class = function (start, end, event) {
                var css = "";

                if (event.subject) // if event has subject property then special class should be assigned
                    css += "event_" + event.subject;

                if (event.id === scheduler.getState().select_id) {
                    css += " selected";
                }
                return css;
            };

            var subject = [
                {key: '', label: 'Appointment'},
                {key: 'meeting', label: 'meeting'},
                {key: 'delivery', label: 'delivery'},
                {key: 'crucial', label: 'crucial'}
            ];

            scheduler.config.lightbox.sections = [
                {name: "description", height: 43, map_to: "text", type: "textarea", focus: true},
                {name: "subject", height: 20, type: "select", options: subject, map_to: "subject"},
                {name: "time", height: 72, type: "time", map_to: "auto"}
            ];

            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
            var yyyy = today.getFullYear();

            today = mm + '-' + dd + '-' + yyyy;

            // scheduler.init("scheduler_here");
            scheduler.setLoadMode("month");
            scheduler.config.date_format = "%Y-%m-%d %H:%i:%s";

            scheduler.init("scheduler_here", today, "month");

            scheduler.load("/events", "json");
            var dp = new dataProcessor("/events");
            dp.init(scheduler);
            dp.setTransactionMode("REST");
        }

    </script>
    <script src="https://cdn.ravenjs.com/3.10.0/raven.min.js"></script>
    <script>Raven.config('https://b506cc95e6244203a69070d518196d06@sentry.dhtmlx.ru/7').install()</script></head>

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
        // var today = new Date();
        // var dd = String(today.getDate()).padStart(2, '0');
        // var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        // var yyyy = today.getFullYear();
        //
        // today = mm + '-' + dd + '-' + yyyy;
        //
        // // scheduler.init("scheduler_here");
        // scheduler.setLoadMode("month");
        //
        //
        // scheduler.config.date_format = "%Y-%m-%d %H:%i:%s";
        // scheduler.init("scheduler_here", today, "month");
        //
        // scheduler.load("/events", "json");
        // var dp = new dataProcessor("/events");
        // dp.init(scheduler);
        // dp.setTransactionMode("REST");
    </script>

@endsection
