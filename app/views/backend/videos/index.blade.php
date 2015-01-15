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

    var confirmButtons = function(){
        
        if(jQuery('.confirmbutton').length > 0) {
          jQuery('.confirmbutton').on("click",function(e){
            e.preventDefault();
            var elem=jQuery(this);
            var action = null;
            switch(elem.attr("data-action")){
                case 'publish':
                    action = '{{Lang::get("messages.publish")}}';
                    break;
                case 'draft':
                    action = '{{Lang::get("messages.draft")}}';
                    break;
                case 'trash':
                    action = '{{Lang::get("messages.trash")}}';
                    break;
                case 'delete':
                    action = '{{Lang::get("messages.delete")}}';
                    break;
                default:
                    action = '{{Lang::get("messages.draft")}}';
                    break;
            }
            jConfirm('{{ Lang::get("messages.are_you_sure") }} '+action+' {{ Lang::get("messages.this_element") }}', '{{ Lang::get("display.confirmation_dialog")}}', function(r) {
                 // jAlert('Confirmed: ' + r, 'Confirmation Results');
                if(r==true){
                    console.log("{{ $route }}/"+elem.attr("data-action")+"/"+elem.attr("data-id"));
                    window.location.assign("{{ $route }}/"+elem.attr("data-action")+"/"+elem.attr("data-id"));
                    }
                });
            });
        }

    }

     jQuery(document).ready(function(){
        // dynamic table

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
{{ Lang::get('titles.videos') }}
@stop

@section("iconpage")
<span class="iconfa-book"></span>
@stop

@section("maintitle")
{{ Lang::get('titles.videos') }}
@stop

@section("nameview")
{{ Lang::get('display.all_videos') }}
@stop

@section("MainContent")
<div class="maincontent">
            <div class="maincontentinner">
            
                <!-- Gets replaced with TinyMCE, remember HTML in a textarea should be encoded -->
                <div class="widgetbox">
                    <div class="headtitle">
                        <div class="btn-group">
                            <a href="{{ $route }}/create" class="btn dropdown-toggle">{{ Lang::get('display.add_video')}}</a>
                        </div>
                        <h4 class="widgettitle">{{ Lang::get('display.all_videos') }}</h4>
                    </div>
                    <table id="dyntable" class="table table-bordered responsive">
                        <colgroup>
                            <col class="con0" />
                            <col class="con1" />
                            <col class="con0" />
                            <col class="con1" />
                            <col class="con0" />
                            <col class="con1" />
                        </colgroup>
                        <thead>
                            <tr>
                                <th class="head0 nosort" style="width:15%"><input type="checkbox" class="checkall" /></th>
                                <th class="head0" width="35%">Titulo</th>
                                <th class="head1"style="width:35%">URL</th>
                                <th class="head0" style="width:30%">{{ Lang::get('display.actions')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($videos))
                                @foreach($videos as $video)
                                    <tr class="gradeX">
                                      <td class="aligncenter"><span class="center">
                                        <input type="checkbox" />
                                      </span></td>
                                        <td>{{$video->titulo_video}}</td>
                                        <td>{{$video->url_video}}</td>
                                        <td class="center">
                                            <a href="{{ $route }}/update/{{$video->id_video}}" class="btn btn-warning alertwarning" style="color:#FFF !important;"><i class="iconfa-edit" style="color:#FFF;margin-right:10px;"></i>{{Lang::get('display.edit')}}</a>
                                            <a data-id="{{$video->id_video}}" data-action="delete" class="btn confirmbutton btn-danger alertdanger" style="color:#FFF !important;"><i class="iconfa-trash" style="color:#FFF;margin-right:10px;"></i>{{Lang::get('display.delete')}}</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>

                
@stop