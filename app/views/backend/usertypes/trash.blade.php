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
			jConfirm('{{ Lang::get("messages.are_you_sure") }} {{ Lang::get("messages.delete") }} {{ Lang::get("messages.this_element") }}', 'Confirmation Dialog', function(r) {
				 // jAlert('Confirmed: ' + r, 'Confirmation Results');
				if(r==true){
					window.location.assign("/dashboard/teachers/delete/"+elem.attr("data-id"));
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
<span class="iconfa-trash"></span>
@stop

@section("maintitle")
Teacher
@stop

@section("nameview")
    All Teachers Trashed
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
                             <a href="/dashboard/teachers" class="btn dropdown-toggle"{{ Lang::get('display.back') }}/a>
                        </div>
                        <h4 class="widgettitle">All Teachers Trashed</h4>
                    </div>
                    
                    <table id="dyntable" class="table table-bordered responsive">
                        
                        <thead>
                            <tr>
                                <th class="head0 nosort"><input type="checkbox" class="checkall" /></th>
                                <th class="head0" style="text-align:center;">Thumb</th>
                                <th class="head0" style="text-align:center;">Name</th>
                                <th class="head1" style="text-align:center;">Description</th>
                                <th class="head0" style="text-align:center;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        	@foreach($teachers as $teacher)
                            <tr class="gradeX">
                             <td class="aligncenter"><span class="center">
                                <input type="checkbox" />
                              </span></td>
                                <td class="center" style="vertical-align:middle;"><img class="rounded" src="/uploads/thumb_{{$teacher->url}}" /></td>
                                <td class="center" style="vertical-align:middle;"><h4>{{$teacher->firstName}}{{$teacher->lastName}}</h4></td>
                                <td class="center" style="vertical-align:middle;">{{$teacher->content}}</td>
                                <td class="center">



                                <a href="/dashboard/teachers/untrash/{{$teacher->id}}" class="btn btn-warning alertwarning" style="color:#FFF !important;"><i class="iconfa-undo" style="color:#FFF;margin-right:10px;"></i>Untrash</a>
								<a data-id="{{$teacher->id}}" class="btn confirmbutton btn-danger alertdanger" style="color:#FFF !important; margin-left:10px;"><i class="iconfa-remove" style="color:#FFF;margin-right:10px;"></i>Delete</a>

                               </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                
@stop