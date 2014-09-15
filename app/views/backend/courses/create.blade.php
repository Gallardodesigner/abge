@extends("backend.layout")

@section("css")
{{HTML::style("assetsadmin/css/bootstrap-fileupload.min.css")}}
{{HTML::style("assetsadmin/css/bootstrap-timepicker.min.css")}}

@stop


@section("js")
<!-- <script src="http://tinymce.cachefly.net/4.1/jquery.tinymce.min.js"></script>
<script src="http://tinymce.cachefly.net/4.1/tinymce.min.js"></script>

 -->
{{HTML::script("assetsadmin/js/tiny_mce/jquery.tinymce.min.js")}}
{{HTML::script("assetsadmin/js/tiny_mce/tinymce.js")}}

{{HTML::script("assetsadmin/js/wysiwyg.js")}}
{{HTML::script("assetsadmin/js/fullcalendar.min.js")}}
{{HTML::script("assetsadmin/js/jquery.smartWizard.min.js")}}

<script type='text/javascript'>

    jQuery(document).ready(function() {
    jQuery('#wizard').smartWizard({onFinish: onFinishCallback});
        
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();
        
        var calendar = jQuery('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            buttonText: {
                prev: '&laquo;',
                next: '&raquo;',
                prevYear: '&nbsp;&lt;&lt;&nbsp;',
                nextYear: '&nbsp;&gt;&gt;&nbsp;',
                today: 'today',
                month: 'month',
                week: 'week',
                day: 'day'
            },
            selectable: true,
            selectHelper: true,

            select: function(start, end, allDay) {
                var title = prompt('Event Title:');
                if (title) {
                    calendar.fullCalendar('renderEvent',
                        {
                            title: title,
                            start: start,
                            end: end,
                            allDay: allDay
                        },
                        true // make the event "stick"
                    );
                }
                calendar.fullCalendar('unselect');
            },
            editable: true,
            // events: [
            //     {
            //         title: 'All Day Event',
            //         start: new Date(y, m, 1)
            //     },
            //     {
            //         title: 'Meeting',
            //         start: new Date(y, m, d, 10, 30),
            //         allDay: false
            //     },
            //     {
            //         title: 'Lunch',
            //         start: new Date(y, m, d, 12, 0),
            //         end: new Date(y, m, d, 14, 0),
            //         allDay: false
            //     },
            //     {
            //         title: 'Birthday Party',
            //         start: new Date(y, m, d+1, 19, 0),
            //         end: new Date(y, m, d+1, 22, 30),
            //         allDay: false
            //     },
            //     {
            //         title: 'Click for Google',
            //         start: new Date(y, m, 28),
            //         end: new Date(y, m, 29),
            //         url: 'http://google.com/'
            //     }
            // ]
        });
        
    });

</script>
@stop

@section("title")
Courses
@stop

@section("iconpage")
<span class="iconfa-book"></span>
@stop

@section("maintitle")
Courses
@stop

@section("nameview")
    Add Course
@stop


@section("MainContent")
<div class="maincontent">
            <div class="maincontentinner">
            
                <!-- Gets replaced with TinyMCE, remember HTML in a textarea should be encoded -->
                <div class="widget">
                    <div class="headtitle">
                    <div class="btn-group">
                        <a href="/dashboard/courses" class="btn dropdown-toggle">Back</a>
                    </div>
                    </div>
                    <h4 class="widgettitle">Add Courses</h4>
                    <div class="widgetcontent">
                        <form class="stdform " action="">
                            <div id="wizard" class="wizard">
                                <ul class="hormenu">
                                    <li>
                                        <a href="#wiz1step1">
                                            <span class="h2">Step 1</span>
                                            <span class="label">Basic Information</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#wiz1step2">
                                            <span class="h2">Step 2</span>
                                            <span class="label">Data and Location</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#wiz1step3">
                                            <span class="h2">Step 3</span>
                                            <span class="label">Content</span>
                                        </a>
                                    </li>
                                     <li>
                                        <a href="#wiz1step4">
                                            <span class="h2">Step 4</span>
                                            <span class="label">Program Content</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#wiz1step5">
                                            <span class="h2">Step 5</span>
                                            <span class="label">Teachers</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#wiz1step6">
                                            <span class="h2">Step 6</span>
                                            <span class="label">Company</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#wiz1step7">
                                            <span class="h2">Step 7</span>
                                            <span class="label">Sponsors</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#wiz1step8">
                                            <span class="h2">Step 8</span>
                                            <span class="label">Promo</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#wiz1step9">
                                            <span class="h2">Step 9</span>
                                            <span class="label">General Informations</span>
                                        </a>
                                    </li>
                                </ul>
                                

                            <div id="wiz1step1" class="formwiz">
                            <h4 class="widgettitle">Step 1: Basic Information</h4>
                            
                                <p>
                                    <label>Title</label>
                                    <span class="field"><input type="text" name="firstname" id="firstname" class="input-xxlarge" /></span>
                                </p>
                                
                                <p>
                                    <label>Description</label>
                                    <span class="field"><input type="text" name="lastname" id="lastname" class="input-xxlarge" /></span>
                                </p>
                                                                
                                <p>
                                    <label>Type</label>
                                    <span class="field">
                                        <select name="selection" id="selection" class="uniformselect">
                                            <option value="">Choose One</option>
                                            <option value="1">Course</option>
                                            <option value="2">Congress</option>
                                        </select>
                                    </span>
                                </p>
                                
                            
                            
                        </div>
                            </div>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>

                
@stop