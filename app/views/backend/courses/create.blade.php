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
                                            <span class="label">Company, Sponsors & Promo</span>
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
                                        <label>Event</label>
                                        <span class="field">
                                            @if (isset($events))
                                                <select class="chosen-select" name="events" >
                                                @foreach ($events as $event)
                                                    <option value="{{$event->id}}">{{$event->title}}</option>
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
                                               <input id="start" type="input" name="start">
                                                    <!-- <input type="hidden" id="finish" name="finish"> -->
                                            </span>
                                        </p>
                                        <p>
                                            <label>Data End</label>
                                            <span class="field">
                                               <input id="end" type="input" name="end">
                                                    <!-- <input type="hidden" id="finish" name="finish"> -->
                                            </span>
                                        </p>
                                        <p>
                                            <label>Address</label>
                                            <span class="field"><textarea cols="30" rows="10" name="address" class="span3"></textarea></span>
                                        </p>
                                                                                                       
                                </div>
                                <div id="wiz1step3" class="formwiz">
                                    <h4 class="widgettitle">Step 3: Content</h4>
                                    
                                        <p>
                                            <label>Content</label>
                                            <span class="field"><textarea cols="50" rows="10" name="content" class="span6"></textarea></span>
                                        </p>
                                                                                                       
                                </div>
                                <div id="wiz1step4" class="formwiz">
                                    <h4 class="widgettitle">Step 4: Program Content</h4>
                                    
                                        <p>
                                            <label>Content</label>
                                            <span class="field"><textarea cols="50" rows="10" name="program" class="span6"></textarea></span>
                                        </p>
                                                                                                       
                                </div>
                                <div id="wiz1step5" class="formwiz">
                                    <h4 class="widgettitle">Step 5: Teachers</h4>
                                    
                                        <p>
                                            <label>Add Teachers</label>
                                            <span class="field">
                                            
                                                        @if (isset($teachers))
                                                            <select class="chosen-select" name="teachers" multiple>
                                                            @foreach ($teachers as $teacher)
                                                                <option value="{{$teacher->id}}">{{$teacher->lastName.', '.$teacher->firstName}}</option>
                                                            @endforeach
                                                            </select>
                                                        @endif
                                                        
                                            </span>
                                        </p>
                                    <div class="clearfix"></div>

                                                                                                       
                                </div>

                                <div id="wiz1step6" class="formwiz">
                                    <h4 class="widgettitle">Step 6: Company, Sponsors & Promo</h4>
                                    
                                        <p>
                                            <label>Add company</label>
                                            <span class="field">
                                            
                                                        @if (isset($companies))
                                                            <select class="chosen-select" name="company_id">
                                                            @foreach ($companies as $company)
                                                                <option value="{{$company->id}}">{{$company->title}}</option>
                                                            @endforeach
                                                            </select>
                                                        @endif
                                                        
                                            </span>
                                        </p>
                                         <p>
                                            <label>Add sponsor</label>
                                            <span class="field">
                                            
                                                        @if (isset($promotioners))
                                                            <select class="chosen-select" name="promotioners" multiple>
                                                            @foreach ($promotioners as $promotion)
                                                                <option value="{{$promotion->id}}">{{$promotion->title}}</option>
                                                            @endforeach
                                                            </select>
                                                        @endif
                                                        
                                            </span>
                                        </p>
                                         <p>
                                            <label>Add promo</label>
                                            <span class="field">
                                            
                                                        @if (isset($supporters))
                                                            <select class="chosen-select" name="suporters" multiple>
                                                            @foreach ($supporters as $support)
                                                                <option value="{{$teacher->id}}">{{$support->title}}</option>
                                                            @endforeach
                                                            </select>
                                                        @endif
                                                        
                                            </span>
                                        </p>
                                    <div class="clearfix"></div>
                                                                                                       
                                </div>
                                
                            </div>
                            <div class="clearfix"></div>
                        </form>
                </div>

                
@stop