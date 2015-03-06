@extends("backend.layout")

@section("css")
{{HTML::style("assetsadmin/css/bootstrap-fileupload.min.css")}}
{{HTML::style("assetsadmin/css/bootstrap-timepicker.min.css")}}
{{HTML::style("assetsadmin/js/chosen/chosen.min.css")}}
@stop


@section("js")
<!-- <script src="http://tinymce.cachefly.net/4.1/jquery.tinymce.min.js"></script>
<script src="http://tinymce.cachefly.net/4.1/tinymce.min.js"></script>

{{HTML::script("assetsadmin/js/wysiwyg.js")}}
{{HTML::script("assetsadmin/js/jquery.smartWizard.min.js")}}
{{HTML::script("assetsadmin/js/fullcalendar.min.js")}}
{{HTML::script("assetsadmin/js/tiny_mce/jquery.tinymce.min.js")}}
{{HTML::script("assetsadmin/js/tiny_mce/tinymce.js")}}
{{HTML::script("assetsadmin/js/wysiwyg.js")}}
 -->
{{HTML::script("assetsadmin/js/tiny_mce/jquery.tinymce.min.js")}}
{{HTML::script("assetsadmin/js/tiny_mce/tinymce.js")}}

{{HTML::script("assetsadmin/js/wysiwyg.js")}}
{{HTML::script("assetsadmin/js/jquery.smartWizard.min.js")}}
{{HTML::script("assetsadmin/js/fullcalendar.min.js")}}
{{HTML::script("assetsadmin/js/chosen/chosen.jquery.min.js")}}
{{HTML::script("assetsadmin/js/chosen/chosen.proto.min.js")}}
<script>
 		
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
Atualizar Pagamento
@stop

@section("iconpage")
<span class="iconfa-book"></span>
@stop

@section("maintitle")
Atualizar Pagamento
@stop

@section("nameview")
    Atualizar
@stop

@section("MainContent")
<div class="maincontent">
            <div class="maincontentinner">
            
                <!-- Gets replaced with TinyMCE, remember HTML in a textarea should be encoded -->
                <div class="widgetbox">
                <div class="headtitle">
                    <div class="btn-group">
                        <a href="{{ $route }}" class="btn dropdown-toggle">Voltar</a>
                    </div>
                </div>
                <h4 class="widgettitle">Atualizar Pagamento</h4>
                <div class="widgetcontent">
                    <form class="stdform stdform2" method="post" enctype="multipart/form-data">
                        <p>
                            <label>Linha 1: </label>
                            <span class="field"><input type="text" name="linea_1" value="{{ $instruction->linea_1 }}"></span></span>
                        </p>  
                        <p>
                            <label>Linha 2: </label>
                            <span class="field"><input type="text" name="linea_2" value="{{ $instruction->linea_2 }}"></span></span>
                        </p>   
                        <p>
                            <label>Linha 3: </label>
                            <span class="field"><input type="text" name="linea_3" value="{{ $instruction->linea_3 }}"></span></span>
                        </p>  
                        <!-- <p>
                             <label>Linha 4: </label>
                             <span class="field"><input type="text" name="linea_4" value="{{ $instruction->linea_4 }}"></span></span>
                         </p>  --> 
                        <p class="pull-right">
                            <button class="btn btn-primary">Atualizar</button>
                            <button type="reset" class="btn">Limpiar</button>
                        </p>
                        <div class="clearfix"></div>
                    </form>
                </div><!--widgetcontent-->
            </div>
    

                
@stop