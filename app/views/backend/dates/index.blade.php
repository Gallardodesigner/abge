@extends("backend.layout")

@section("css")
{{HTML::style("assetsadmin/css/bootstrap-fileupload.min.css")}}
{{HTML::style("assetsadmin/css/bootstrap-timepicker.min.css")}}

@stop


@section("js")

{{HTML::script("assetsadmin/js/jquery.jgrowl.js")}}
{{HTML::script("assetsadmin/js/jquery.alerts.js")}}
{{HTML::script("assetsadmin/js/jquery.dataTables.min.js")}}


<script type='text/javascript'>

     jQuery(document).ready(function(){
        // dynamic table
        jQuery('#dyntable').dataTable({
            "sPaginationType": "full_numbers",
            "aaSortingFixed": [[0,'asc']],
            "fnDrawCallback": function(oSettings) {
                jQuery.uniform.update();
            }
        });


        if(jQuery('.confirmbutton').length > 0) {
		  jQuery('.confirmbutton').on("click",function(e){
            e.preventDefault();
			var elem=jQuery(this);
			jConfirm('{{ Lang::get("messages.are_you_sure") }} '+elem.attr("data-action")+'  {{ Lang::get("messages.this_element") }}', 'Confirmation Dialog', function(r) {
				 // jAlert('Confirmed: ' + r, 'Confirmation Results');
				if(r==true){
					window.location.assign("{{ $route }}/"+elem.attr("data-action")+"/"+elem.attr("data-id"));
				}
			});
		});
	}
        
    });
</script>
@stop

@section("title")
{{ Lang::get('titles.courses') }}
@stop

@section("iconpage")
<span class="iconfa-user-md"></span>
@stop

@section("maintitle")
Date
@stop

@section("nameview")
    All Dates
@stop

@section("MainContent")
<div class="maincontent">
            <div class="maincontentinner">
            
                <!-- Gets replaced with TinyMCE, remember HTML in a textarea should be encoded -->
                @if($msg_success!=null)
						<div class="widgetbox box-success">
                            <h4 class="widgettitle">Success <a class="close">×</a> <a class="minimize">–</a></h4>
                            <div class="widgetcontent">
                                {{$msg_success}}
                            </div>
                        </div>
                @endif
                <!-- @if(isset($msg_error)) -->
                @if($msg_error!=null)
						<div class="widgetbox box-danger">
                            <h4 class="widgettitle">Error <a class="close">×</a> <a class="minimize">–</a></h4>
                            <div class="widgetcontent">
                                {{$msg_error}}
                            </div>
                        </div>
                @endif
                <!-- @endif -->
                <div class="widgetbox">
                    <div class="headtitle">
                        <div class="btn-group">
                            <a href="{{ $parent }}" class="btn dropdown-toggle"{{ Lang::get('display.back') }}/a>
                            <a href="dates/create" class="btn dropdown-toggle" style="padding-left:20px">Add New Date</a>
                        </div>
                        <h4 class="widgettitle">All Dates</h4>
                    </div>
                    
                    <table id="dyntable" class="table table-bordered responsive">
                        
                        <thead>
                            <tr>
                                <th class="head0 nosort"><input type="checkbox" class="checkall" /></th>
                                <th class="head0" style="text-align:center;width:10%">Start Date</th>
                                <th class="head0" style="text-align:center;width:20%">End Date</th>
                                <th class="head1" style="text-align:center;width:40%">Message</th>
                                <th class="head0" style="text-align:center;width:20%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        	@foreach($dates as $date)
                            <tr class="gradeX">
                              <td class="aligncenter"><span class="center">
                                <input type="checkbox" />
                              </span></td>
                                <td class="center" style="vertical-align:middle;width:10%;"><h4>{{date("d-m-Y", strtotime($date->start))}}</h4></td>
                                <td class="center" style="vertical-align:middle;width:20%;"><h4>{{date("d-m-Y", strtotime($date->end))}}</h4></td>
                                <td class="description" style="vertical-align:middle;width:40%;">{{$date->message}}</td>
                                <td class="center" style="vertical-align:middle;width:20%;">

                                    <a href="{{ $route }}/update/{{$date->id}}" class="btn btn-warning alertwarning" style="color:#FFF !important;"><i class="iconfa-edit" style="color:#FFF;margin-right:10px;"></i>Edit</a>
                                   
                                    <a data-id="{{$date->id}}" data-action="delete" class="btn confirmbutton btn-danger alertdanger" style="color:#FFF !important; margin-left:10px;"><i class="iconfa-trash" style="color:#FFF;margin-right:10px;"></i>Delete</a>

                               </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                
@stop