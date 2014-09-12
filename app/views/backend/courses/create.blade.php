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

<script type='text/javascript'>

    jQuery(document).ready(function() {
    
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
                            <div class="par control-group info">
                                <h4 class="widgettitle title-inverse">Title</h4>
                                <input id="title" class="input-block-level" type="text" placeholder="Title">
                            </div>
                            <div class="row-fluid">   
                                <div class="control-group info span12">
                                    <h4 class="widgettitle title-inverse">Content</h4>
                                 <textarea id="content" name="content" rows="12" cols="80" style="width: 80%" class="tinymce" placeholder="Conteúdo">
                                 </textarea>
                                </div>
                            </div>
                            <div class="row-fluid">
                                <div class="span6 control-group info">
                                    <div class="control-group info">
                                        <h4 class="widgettitle title-inverse">Objetives</h4>
                                        <textarea id="objetive" name="objetive" rows="7" cols="80" style="width: 80%" class="tinymce" placeholder="Conteúdo">
                                        </textarea>

                                    </div>
                                </div>
                                <div class="span6">
                                    <div class="control-group info">
                                        <h4 class="widgettitle title-inverse">Methodology</h4>
                                        <textarea id="methodology" name="methodology" rows="7" cols="80" style="width: 80%" class="tinymce" placeholder="Conteúdo">
                                        </textarea>

                                    </div>
                                </div>
                            </div>
                            <div class="row-fluid">
                                <div class="control-group info">
                                    <div class="control-group info">
                                        <h4 class="widgettitle title-inverse">Target</h4>
                                        <textarea id="target" name="target" rows="7" cols="80" style="width: 80%" class="tinymce" placeholder="Conteúdo">
                                        </textarea>

                                    </div>
                                </div>
                            </div>
                            <div class="row-fluid">
                                <div class="span6">
                                    <div class="control-group info">
                                        <h4 class="widgettitle title-inverse">Duration</h4>
                                        <div id='calendar'></div>
                                    </div>
                                </div>
                                <div class="span6">
                                    <div class="control-group info">
                                        <h4 class="widgettitle title-inverse">Company</h4>
                                        <select name="selection" id="selection2" class="uniformselect input-block-level">
                                            <option value="">Choose One</option>
                                            <option value="1">Selection One</option>
                                            <option value="2">Selection Two</option>
                                            <option value="3">Selection Three</option>
                                            <option value="4">Selection Four</option>
                                        </select>
                                         <h4 class="widgettitle title-inverse">Category</h4>
                                        <select name="selection" id="selection2" class="uniformselect input-block-level">
                                            <option value="">Choose One</option>
                                            <option value="1">Selection One</option>
                                            <option value="2">Selection Two</option>
                                            <option value="3">Selection Three</option>
                                            <option value="4">Selection Four</option>
                                        </select>

                                    </div>
                                </div>
                            </div>
                            <br />
                            <div class="pull-right">
                                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" name="reset" class="btn">Reset</button>
                            </div>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>

                
@stop