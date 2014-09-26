@extends("backend.layout")

@section("css")
{{HTML::style("assetsadmin/css/bootstrap-fileupload.min.css")}}
{{HTML::style("assetsadmin/css/bootstrap-timepicker.min.css")}}
{{HTML::style("assetsadmin/js/chosen/chosen.min.css")}}
<style type="text/css">
        /*
    Stylesheet for examples by DevHeart.
    http://devheart.org/

    Article title:  jQuery: Customizable layout using drag n drop
    Article URI:    http://devheart.org/articles/jquery-customizable-layout-using-drag-and-drop/

    Example title:  1. Getting started with sortable lists
    Example URI:    http://devheart.org/examples/jquery-customizable-layout-using-drag-and-drop/1-getting-started-with-sortable-lists/index.html
*/

/*
    Alignment
------------------------------------------------------------------- */

/* Floats */

.left {float: left;}
.right {float: right;}

.clear,.clearer {clear: both;}
.clearer {
    display: block;
    font-size: 0;
    height: 0;
    line-height: 0;
}


/*
    Example specifics
------------------------------------------------------------------- /

.column.first {margin-bottom: 60px;}


/* Sortable items /

.sortable-list {
    background-color: #F93;
    list-style: none;
    margin: 0;
    min-height: 60px;
    padding: 10px;
}
.sortable-item {
    background-color: #FFF;
    border: 1px solid #000;
    cursor: move;
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
    padding: 20px 0;
    text-align: center;
}

/* Containment area */


/* Item placeholder (visual helper) /

.placeholder {
    background-color: #BFB;
    border: 1px dashed #666;
    height: 58px;
    margin-bottom: 5px;
}
*/
    </style>
@stop


@section("js")
<!-- <script src="http://tinymce.cachefly.net/4.1/jquery.tinymce.min.js"></script>
<script src="http://tinymce.cachefly.net/4.1/tinymce.min.js"></script>

 -->
{{HTML::script("assetsadmin/js/tiny_mce/jquery.tinymce.min.js")}}
{{HTML::script("assetsadmin/js/tiny_mce/tinymce.js")}}

{{HTML::script("assetsadmin/js/wysiwyg.js")}}
{{HTML::script("assetsadmin/js/jquery.smartWizard.min.js")}}
{{HTML::script("assetsadmin/js/fullcalendar.min.js")}}
{{HTML::script("assetsadmin/js/chosen/chosen.jquery.min.js")}}
{{HTML::script("assetsadmin/js/chosen/chosen.proto.min.js")}}

<script type='text/javascript'>


    jQuery(document).ready(function() {

        jQuery('#course').submit(function(e){
            //e.preventDefault()
            var elem = jQuery(this);
            console.log(elem.serialize());
        });
///Lista sortable
        jQuery('.chosen-select').chosen({no_results_text: "Oops, nothing found!"});
     elementos=[];
        jQuery('#containment .sortable-list').sortable({
        connectWith: '#containment .sortable-list',
        containment: '#containment',
         start: function (event, ui){
            var data = {
                'index': ui.item.index(),
                'id': ui.item.attr("id")
            };
            start_position = data.index;
            console.log("Arrastrando el Video " + data.id + " en la posicion " + data.index);
        },
        stop: function(event, ui){
            //console.log("Stop");
            var data = {
                'index': ui.item.index(),
                'id': ui.item.attr("id"),
                'start': start_position
            };
            if (jQuery(ui.item).parent().attr("id")=="to-save"){
                console.log("Agregando el Video " + data.id + " en la posicion " + data.index );
                console.log(ui);
                jQuery("#to-save").append("<input id='teacher_"+data.id+"' type='hidden' name='teachers[]' value='"+data.id+"'>");
                console.log( jQuery("#teacher_"+data.id).val());
              
            }
            if (jQuery(ui.item).parent().attr("id")=="to-remove"){
                console.log("Borrando el Video " + data.id + " en la posicion " + data.index );
                console.log(ui);
                jQuery("#to-save > #teacher_"+data.id).remove();
                console.log( jQuery("#teacher_"+data.id).val());

            }
        }
    });

    /// Fin Lista sortable


   
    jQuery('#wizard').smartWizard({onFinish: onFinishCallback});

    function onFinishCallback(){
      jQuery("#course").submit();  
    } 
        
        jQuery('#start').datepicker({
                defaultDate: "+1w",
            dateFormat: "dd-mm-yy",

              onClose: function( selectedDate ) {
                jQuery("#end" ).datepicker("option", "minDate", selectedDate );
            }
        });

        jQuery( "#end" ).datepicker({
            defaultDate: "+1w",
            dateFormat: "dd-mm-yy",
          onClose: function( selectedDate ) {
            jQuery( "#start" ).datepicker( "option", "maxDate", selectedDate );
            }
        });

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
    Edit Course
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
                        <form id="course" class="stdform " method="POST" action="">
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
                                            <span class="label">Sections</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#wiz1step4">
                                            <span class="h2">Step 4</span>
                                            <span class="label">Participants</span>
                                        </a>
                                    </li>
                                  
                                    
                                </ul>
                                

                                <div id="wiz1step1" class="formwiz">
                                <h4 class="widgettitle">Step 1: Basic Information</h4>
                                
                                    <p>
                                        <label>Title</label>
                                        <span class="field"><input type="text" name="title" id="title" class="input-xxlarge" value="{{$course->title}}" /></span>
                                    </p>
                                    
                                    <p>
                                        <label>Description</label>
                                        <span class="field"><input type="text" name="description" id="description" class="input-xxlarge" value="{{$course->description}}" /></span>
                                    </p>
                                    <p>
                                        <label>Header</label>
                                        <span class="field"><input type="file" name="header" id="header" class="btn btn-primary" /></span>
                                    </p>
                                    <p>
                                        <label>Company</label>
                                        <span class="field">
                                            @if (isset($companies))

                                                <select class="chosen-select" name="company_id" >
                                                @foreach ($companies as $company)
                                                @if ($course->company->id == $company->id)
                                                    <option value="{{$company->id}}" selected>{{$company->title}}</option>
                                                @else
                                                    <option value="{{$company->id}}">{{$company->title}}</option>
                                                @endif
                                                @endforeach
                                                </select>
                                            @endif
                                        </span>
                                    </p>                                
                                    <p>
                                        <label>Category</label>
                                        <span class="field">
                                            @if (isset($categories))

                                                <select class="chosen-select" name="category_id" >

                                                @foreach ($categories as $category)
                                                @if ($course->category->id == $category->id)
                                                    <option value="{{$category->id}}" selected>{{$category->title}}</option>
                                                @else
                                                    <option value="{{$category->id}}">{{$category->title}}</option>
                                                @endif
                                                @endforeach
                                                </select>
                                            @endif
                                        </span>
                                    <p>
                                        <label>Event</label>
                                        <span class="field">
                                            @if (isset($events))
                                                <select class="chosen-select" name="event_id" >
                                                @foreach ($events as $event)
                                                @if ($course->event->id == $event->id)
                                                    <option value="{{$event->id}}" selected>{{$event->title}}</option>
                                                @else
                                                    <option value="{{$event->id}}">{{$event->title}}</option>
                                                @endif
                                                @endforeach
                                                </select>
                                            @endif
                                        </span>
                                    </p>
                                </div>
                                <div id="wiz1step2" class="formwiz">
                                    <h4 class="widgettitle">Step 2: Data and Location</h4>
                                    
                                        <p>
                                            <label>Data Start</label>
                                            <span class="field">
                                               <input id="start" type="input" name="start" value="{{$course->start}}">
                                                    <!-- <input type="hidden" id="finish" name="finish"> -->
                                            </span>
                                        </p>
                                        <p>
                                            <label>Data End</label>
                                            <span class="field">
                                               <input id="end" type="input" name="end" value="{{$course->end}}">
                                                    <!-- <input type="hidden" id="finish" name="finish"> -->
                                            </span>
                                        </p>
                                        <p>
                                            <label>Address</label>
                                            <span class="field"><textarea cols="30" rows="10" name="address" class="span3">{{$course->address}}</textarea></span>
                                        </p>
                                                                                                       
                                </div>
                                <div id="wiz1step3" class="formwiz">
                                    <h4 class="widgettitle">Step 3: Sections</h4>
                                    
                                        <p>
                                            <label>Sections</label>
                                            <span class="field">
                                                @foreach ($sections as $section)
                                                    <?php $bandera = false; ?>
                                                    @foreach($course->coursesections as $selected)
                                                        @if($selected->section->id == $section->id)
                                                             <?php $bandera = true; ?>
                                                        @endif
                                                    @endforeach
                                                    @if($bandera)
                                                        <input type="checkbox" name="section[]" value="{{$section->id}}" checked>{{$section->title}}<br />
                                                    @else
                                                         <input type="checkbox" name="section[]" value="{{$section->id}}">{{$section->title}}<br />
                                                    @endif
                                                @endforeach
                                            </span>
                                        </p>
                                                                                                       
                                </div>
                                <div id="wiz1step4" class="formwiz">
                                    <h4 class="widgettitle">Step 4: Participants</h4>
                                       
                                        <p>
                                            <label>Min Participants</label>
                                            <span class="field"> <input type="number" name="min" value="{{$course->min}}"> </span>
                                        </p>
                                        <p>
                                            <label>Message</label>
                                            <span class="field"><textarea cols="50" rows="10" name="min_message" class="span6">{{$course->min_message}}</textarea></span>
                                        </p>
                                        <p>
                                            <label>Max Participants</label>
                                            <span class="field"> <input type="number" name="max" value="{{$course->max}}"> </span>
                                        </p>   
                                        <p>
                                            <label>Message</label>
                                            <span class="field"><textarea cols="50" rows="10" name="max_message" class="span6">{{$course->max_message}}</textarea></span>
                                            
                                        </p>
                                                                                                       
                                </div>
                    <!--            <div id="wiz1step4" class="formwiz">
                                    <h4 class="widgettitle">Step 4: Payment</h4>
                                       
                                        <p>
                                            <label>Inscription</label>
                                            <span class="field"><textarea cols="50" rows="10" name="inscription" class="span6"></textarea></span>
                                        </p>
                                        <p>
                                            <label>Associates Payment</label>
                                            <span class="field"><textarea cols="50" rows="10" name="associates_payment" class="span6"></textarea></span>
                                        </p>
                                        <p>
                                            <label>Associates Message</label>
                                            <span class="field"><textarea cols="50" rows="10" name="associates_message" class="span6"></textarea></span>
                                        </p>
                                        <p>
                                            <label>Participants Payment</label>
                                            <span class="field"><textarea cols="50" rows="10" name="participants_payment" class="span6"></textarea></span>
                                        </p>
                                        <p>
                                            <label>Participants Message</label>
                                            <span class="field"><textarea cols="50" rows="10" name="participants_message" class="span6"></textarea></span>
                                        </p>
                                                                                                       
                                </div>-->
                            </div>
                            <div class="clearfix"></div>
                        </form>
                </div>

                
@stop