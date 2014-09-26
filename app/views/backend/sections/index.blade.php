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
			jConfirm('Are you sure to '+elem.attr("data-action")+' this element?', 'Confirmation Dialog', function(r) {
				 // jAlert('Confirmed: ' + r, 'Confirmation Results');
				if(r==true){
					window.location.assign("/dashboard/sections/"+elem.attr("data-action")+"/"+elem.attr("data-id"));
				}
			});
		});
	}
        
    });
</script>
@stop

@section("title")
Courses
@stop

@section("iconpage")
<span class="iconfa-user-md"></span>
@stop

@section("maintitle")
Teacher
@stop

@section("nameview")
    All Sections
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
                            <a href="sections/create" class="btn dropdown-toggle">Add New Section</a>
                        </div>
                        <h4 class="widgettitle">All Sections</h4>
                    </div>
                    
                    <table id="dyntable" class="table table-bordered responsive">
                        
                        <thead>
                            <tr>
                                <th class="head0 nosort"><input type="checkbox" class="checkall" /></th>
                                <th class="head0" style="text-align:center;width:10%">Order</th>
                                <th class="head0" style="text-align:center;width:10%">Title</th>
                                <th class="head0" style="text-align:center;width:40%">Description</th>
                                <th class="head1" style="text-align:center;width:20%">Upload Files</th>
                                <th class="head1" style="text-align:center;width:10%">Status</th>
                                <th class="head0" style="text-align:center;width:20%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        	@foreach($sections as $section)
                            <tr class="gradeX">
                              <td class="aligncenter"><span class="center">
                                <input type="checkbox" />
                              </span></td>
                                <td class="center" style="vertical-align:middle;width:10%;">
                                    <h4 style="display:inline-block; margin-right: 15px">{{$section->order}}</h4>
                                    <div style="display:inline-block">

                                        @if($section->order < count($sections))
                                            <a href="{{ $route }}/down/{{$section->id}}" style="display:block;height:10px; text-decoration: none;"><i class="iconfa-sort-down" style="color:#33A;font-size:20pt;height:10px;"></i></a>
                                        @endif
                                        @if($section->order > 1 )
                                            <a href="{{ $route }}/up/{{$section->id}}" style="display:block;height:10px; text-decoration: none;margin-top: -20px"><i class="iconfa-sort-up" style="color:#33A;font-size:20pt; height:10px;"></i></a>
                                            
                                        @endif
                                    </div>
                                </td>
                                <td class="center" style="vertical-align:middle;width:10%;"><h4>{{$section->title}}</h4></td>
                                <td class="description" style="vertical-align:middle;width:40%;">{{$section->description}}</td>
                                <td class="center" style="vertical-align:middle;width:20%;"><h4>{{$section->file}}</h4></td>
                                <td class="center" style="vertical-align:middle;width:10%;">{{ Lang::get('display.'.$section->status) }}</td>
                                <td class="center" style="vertical-align:middle;width:20%;">

                                    <a href="/dashboard/sections/update/{{$section->id}}" class="btn btn-warning alertwarning" style="color:#FFF !important;"><i class="iconfa-edit" style="color:#FFF;margin-right:10px;"></i>Edit</a>
                                   
                                    @if($section->status == 'publish')

                                        <a data-id="{{$section->id}}" data-action="draft" class="btn confirmbutton btn-primary alertdanger" style="color:#FFF !important; margin-left:10px;"><i class="iconfa-file" style="color:#FFF;margin-right:10px;"></i>Draft</a>
                                    
                                    @else
                                    
                                        <a data-id="{{$section->id}}" data-action="publish" class="btn confirmbutton btn-success alertdanger" style="color:#FFF !important; margin-left:10px;"><i class="iconfa-ok" style="color:#FFF;margin-right:10px;"></i>Publish</a>

                                    @endif

                                    <a data-id="{{$section->id}}" data-action="trash" class="btn confirmbutton btn-danger alertdanger" style="color:#FFF !important; margin-left:10px;"><i class="iconfa-trash" style="color:#FFF;margin-right:10px;"></i>Trash</a>

                               </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                
@stop