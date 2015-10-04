@extends("backend.layout")

@section("css")
{{HTML::style("assetsadmin/css/bootstrap-fileupload.min.css")}}
{{HTML::style("assetsadmin/css/bootstrap-timepicker.min.css")}}

@stop


@section("js")

{{HTML::script("assetsadmin/js/jquery.jgrowl.js")}}
{{HTML::script("assetsadmin/js/jquery.alerts.js")}}
{{HTML::script("assetsadmin/js/jquery.dataTables.min.js")}}


<script type="text/javascript">
    var confirmButtons = function(){
        if(jQuery('.confirmbutton').length > 0) {
            jQuery('.confirmbutton').on("click",function(e){
                e.preventDefault();
                var elem=jQuery(this);
                jConfirm('{{ Lang::get("messages.are_you_sure") }} '+elem.attr("data-action")+' {{ Lang::get("messages.this_element") }}', '{{ Lang::get("display.confirmation_dialog")}}', function(r) {
                     // jAlert('Confirmed: ' + r, 'Confirmation Results');
                    if(r==true){
                        window.location.assign("{{ $route }}/"+elem.attr("data-action")+"/"+elem.attr("data-id"));
                    }
                });
            });
        }
        if(jQuery('.delete-inscription').length > 0){
            console.log("delete");
            jQuery('.delete-inscription').on("click",function(e){
                console.log("click");
                e.preventDefault();
                var elem=jQuery(this);
                jConfirm('{{ Lang::get("messages.are_you_sure") }} {{ Lang::get("display.delete") }} {{ Lang::get("messages.this_element") }}', '{{ Lang::get("display.confirmation_dialog")}}', function(r) {
                     // jAlert('Confirmed: ' + r, 'Confirmation Results');
                    if(r==true){
                        window.location.assign("{{ $route }}/delete/"+elem.attr("data-id"));
                    }
                });
            });
        }
    }

     jQuery(document).on('ready', function(){
        // dynamic table
        console.log("ready");
        var table = jQuery('#dyntable').dataTable({
            "sPaginationType": "full_numbers",
            "aaSortingFixed": [[0,'asc']],
            "fnDrawCallback": function(oSettings) {
                jQuery.uniform.update();
            }
        });

        confirmButtons();

        table.on('page.dt', function(e){
            console.log("page");
            confirmButtons();
        });

        table.on('draw.dt', function(e){
            console.log("draw");
            confirmButtons();
        });
        
    });
</script>
@stop

@section("title")
Courses
@stop

@section("iconpage")
<span class="iconfa-briefcase"></span>
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
                            <a href="companies/create" class="btn dropdown-toggle">Add New Company</a>
                        </div>
                        <h4 class="widgettitle">All Companies</h4>
                    </div>
                    
                    <table id="dyntable" class="table table-bordered responsive">
                        
                        <thead>
                            <tr>
                                <th class="head0 nosort"><input type="checkbox" class="checkall" /></th>
                                <th class="head0" style="text-align:center;width:10%;">Thumb</th>
                                <th class="head0" style="text-align:center;width:20%;">Title</th>
                                <th class="head1" style="text-align:center;width:40%;">Description</th>
                                <th class="head1" style="text-align:center;width:10%;">Status</th>
                                <th class="head0" style="text-align:center;width:20%;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        	@foreach($companies as $company)
                            <tr class="gradeX">
                              <td class="aligncenter"><span class="center">
                                <input type="checkbox" />
                              </span></td>
                                <td class="center" style="vertical-align:middle;width:10%;"><img class="rounded" src="/uploads/thumb_{{$company->url}}" /></td>
                                <td class="center" style="vertical-align:middle;width:20%;"><h4>{{$company->title}}</h4></td>
                                <td class="description" style="vertical-align:middle;width:40%;">{{$company->content}}</td>
                                <td class="center" style="vertical-align:middle;width:10%;">{{ Lang::get('display.'.$company->status) }}</td>
                                <td class="center" style="vertical-align:middle;width:20%;">

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