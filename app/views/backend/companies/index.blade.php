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
			jConfirm('Are you sure to trash this element?', 'Confirmation Dialog', function(r) {
				 // jAlert('Confirmed: ' + r, 'Confirmation Results');
				if(r==true){
					window.location.assign("/dashboard/companies/"+elem.attr("data-action")+"/"+elem.attr("data-id"));
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
<span class="iconfa-tags"></span>
@stop

@section("maintitle")
Companies
@stop

@section("nameview")
    All companies
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
                            <a href="companies/create" class="btn dropdown-toggle">Add New Category</a>
                        </div>
                        <h4 class="widgettitle">All companies</h4>
                    </div>
                    
                    <table id="dyntable" class="table table-bordered responsive">
                        
                        <thead>
                            <tr>
                                <th class="head0 nosort"><input type="checkbox" class="checkall" /></th>
                                <th class="head0" style="text-align:center;">Thumb</th>
                                <th class="head0" style="text-align:center;">Title</th>
                                <th class="head1" style="text-align:center;">Description</th>
                                <th class="head1" style="text-align:center;">Status</th>
                                <th class="head0" style="text-align:center;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        	@foreach($companies as $company)
                            <tr class="gradeX">
                              <td class="aligncenter"><span class="center">
                                <input type="checkbox" />
                              </span></td>
                                <td><img src=<?php $img=substr($company->url,9);echo "'".substr_replace($company->url,"small_".$img,9)."'"; ?> /></td>
                                <td><h4>{{$company->title}}</h4></td>
                                <td>{{$company->content}}</td>
                                <td>{{ Lang::get('display.'.$company->status) }}</td>
                                <td class="center">

                                    <a href="/dashboard/companies/update/{{$company->id}}" class="btn btn-warning alertwarning" style="color:#FFF !important;"><i class="iconfa-edit" style="color:#FFF;margin-right:10px;"></i>Edit</a>
                                   
                                    @if($company->status == 'publish')

                                        <a data-id="{{$company->id}}" data-action="draft" class="btn confirmbutton btn-primary alertdanger" style="color:#FFF !important; margin-left:10px;"><i class="iconfa-file" style="color:#FFF;margin-right:10px;"></i>Draft</a>
                                    
                                    @else
                                    
                                        <a data-id="{{$company->id}}" data-action="publish" class="btn confirmbutton btn-success alertdanger" style="color:#FFF !important; margin-left:10px;"><i class="iconfa-ok" style="color:#FFF;margin-right:10px;"></i>Publish</a>

                                    @endif

                                    <a data-id="{{$company->id}}" data-action="trash" class="btn confirmbutton btn-danger alertdanger" style="color:#FFF !important; margin-left:10px;"><i class="iconfa-trash" style="color:#FFF;margin-right:10px;"></i>Trash</a>

                               </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                
@stop