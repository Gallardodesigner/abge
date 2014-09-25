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
                    window.location.assign("/dashboard/courses/"+elem.attr("data-action")+"/"+elem.attr("data-id"));
                }
            });
        });
      }
        
    });
</script>
@stop

@section("title")
Files
@stop

@section("iconpage")
<span class="iconfa-book"></span>
@stop

@section("maintitle")
Files
@stop

@section("nameview")
    All Files {{ $inscription->user->name}}
@stop

@section("MainContent")
<div class="maincontent">
            <div class="maincontentinner">
            
                <!-- Gets replaced with TinyMCE, remember HTML in a textarea should be encoded -->
                <div class="widgetbox">
                    <div class="headtitle">
                        <div class="btn-group">
                            <a href="{{ $parent }}" class="btn dropdown-toggle">Back</a>
                        </div>
                        <h4 class="widgettitle">All Files {{ $inscription->user->name}}</h4>
                    </div>
                    <table id="dyntable" class="table table-bordered responsive">
                        <colgroup>
                            <col class="con0" style="align: center; " />
                            <col class="con1" />
                            <col class="con0" />
                            <col class="con1" />
                            <col class="con0" />
                            <col class="con1" />
                        </colgroup>
                        <thead>
                            <tr>
                                <th class="head0 nosort" style="width:10%"><input type="checkbox" class="checkall" /></th>
                                <th style="width:55%">Title</th>
                                <th class="head0" style="width:10%">URL</th>
                                <th class="head1" style="width:10%">Status</th>
                                <th class="head0" style="width:25%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($files))
                                @foreach($files as $file)
                                    <tr class="gradeX">
                                      <td class="aligncenter"><span class="center">
                                        <input type="checkbox" />
                                      </span></td>
                                        <td style="width:30%">
											<h4>{{ $file->title != '' ? $file->title : Lang::get('display.void')}}</h4>
										</td>
                                        <td>
                                            <a href="{{URL::to($file->url)}}" target="_blank">{{ $file->mime }}</a>
										</td>
                                        <td>{{ Lang::get('display.'.$file->status)}}</td>
                                        <td class="center">
                                        	@if($file->status == 'draft' OR $file->status == 'trash')
                                             <a href="{{ $route }}/publish/{{$file->id}}" class="btn btn-success alertwarning" style="color:#FFF !important;"><i class="iconfa-tasks" style="color:#FFF;margin-right:10px;"></i>{{Lang::get('display.verify_file')}}</a>
                                             @endif
                                             @if($file->status == 'draft' OR $file->status == 'publish')
                                             <a href="{{ $route }}/trash/{{$file->id}}" class="btn btn-danger alertwarning" style="color:#FFF !important;"><i class="iconfa-tasks" style="color:#FFF;margin-right:10px;"></i>{{Lang::get('display.decline_file')}}</a>
                                             @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>

                
@stop