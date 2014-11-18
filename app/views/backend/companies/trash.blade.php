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
			jConfirm('{{ Lang::get("messages.are_you_sure") }} {{ Lang::get("messages.delete") }} {{ Lang::get("messages.this_element") }}', '{{ Lang::get("display.confirmation_dialog")}}', function(r) {
				 // jAlert('Confirmed: ' + r, 'Confirmation Results');
				if(r==true){
					window.location.assign("{{$route}}/delete/"+elem.attr("data-id"));
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
{{ Lang::get('titles.companies') }}
@stop

@section("nameview")
    {{ Lang::get('display.trashed_companies') }}
@stop

@section("MainContent")
<div class="maincontent">
            <div class="maincontentinner">
            
                <!-- Gets replaced with TinyMCE, remember HTML in a textarea should be encoded -->
                @if($msg_success!=null)
						<div class="widgetbox box-success">
                            <h4 class="widgettitle">{{ Lang::get('display.success') }} <a class="close">×</a> <a class="minimize">–</a></h4>
                            <div class="widgetcontent">
                                {{$msg_success}}
                            </div>
                        </div>
                @endif
                <!-- @if(isset($msg_error)) -->
                @if($msg_error!=null)
						<div class="widgetbox box-danger">
                            <h4 class="widgettitle">{{ Lang::get('display.error') }} <a class="close">×</a> <a class="minimize">–</a></h4>
                            <div class="widgetcontent">
                                {{$msg_error}}
                            </div>
                        </div>
                @endif
                <!-- @endif -->
                <div class="widgetbox">
                    <div class="headtitle">
                        <div class="btn-group">
                             <a href="/dashboard/companies" class="btn dropdown-toggle">{{ Lang::get('display.back') }}</a>
                        </div>
                        <h4 class="widgettitle">{{ Lang::get('display.trashed_companies') }}</h4>
                    </div>
                    
                    <table id="dyntable" class="table table-bordered responsive">
                        
                        <thead>
                            <tr>
                                <th class="head0 nosort"><input type="checkbox" class="checkall" /></th>
                                <th class="head0" style="text-align:center;">{{ Lang::get('display.thumb') }}</th>
                                <th class="head0" style="text-align:center;">{{ Lang::get('display.title') }}</th>
                                <th class="head1" style="text-align:center;">{{ Lang::get('display.description') }}</th>
                                <th class="head0" style="text-align:center;">{{ Lang::get('display.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                        	@foreach($companies as $company)
                            <tr class="gradeX">
                             <td class="aligncenter"><span class="center">
                                <input type="checkbox" />
                              </span></td>
                                <td class="center" style="vertical-align:middle;"><img class="rounded" src="/uploads/thumb_{{$company->url}}" /></td>
                                <td class="center" style="vertical-align:middle;"><h4>{{$company->title}}</h4></td>
                                <td class="description" style="vertical-align:middle;">{{$company->content}}</td>
                                <td class="center">



                                <a href="/dashboard/companies/untrash/{{$company->id}}" class="btn btn-warning alertwarning" style="color:#FFF !important;"><i class="iconfa-undo" style="color:#FFF;margin-right:10px;"></i>{{ Lang::get('display.untrash') }}</a>
								<a data-id="{{$company->id}}" class="btn confirmbutton btn-danger alertdanger" style="color:#FFF !important; margin-left:10px;"><i class="iconfa-remove" style="color:#FFF;margin-right:10px;"></i>{{ Lang::get('display.delete') }}</a>

                               </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                
@stop