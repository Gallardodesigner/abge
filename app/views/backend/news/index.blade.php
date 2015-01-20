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
{{ Lang::get('titles.news') }}
@stop

@section("iconpage")
<span class="iconfa-book"></span>
@stop

@section("maintitle")
{{ Lang::get('titles.news') }}
@stop

@section("nameview")
    {{ Lang::get('display.all_news') }}
@stop

@section("MainContent")
<div class="maincontent">
            <div class="maincontentinner">
            
                <!-- Gets replaced with TinyMCE, remember HTML in a textarea should be encoded -->
                <div class="widgetbox">
                    <div class="headtitle">
                        <div class="btn-group">
                            <a href="{{ $route }}/create" class="btn dropdown-toggle">{{ Lang::get('display.add_new')}}</a>
                        </div>
                        <h4 class="widgettitle">{{ Lang::get('display.all_news') }}</h4>
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
                                <th class="head0" width="30%">{{ Lang::get('display.title')}}</th>
                                <th class="head1"style="width:25%">{{ Lang::get('display.sub_title')}}</th>
                                <th class="head0" style="width:10%">{{ Lang::get('display.date')}}</th>
                                <th class="head1" style="width:15%">{{ Lang::get('display.image')}}</th>
                                <th class="head0" style="width:20%">{{ Lang::get('display.actions')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($news))
                                @foreach($news as $new)
                                    <tr class="gradeX">
                                      <td class="aligncenter"><span class="center">
                                        <input type="checkbox" />
                                      </span></td>
                                        <td>{{$new->title}}</td>
                                        <td>{{$new->sub_title}}</td>
                                        <td>{{date("d-m-Y", strtotime($new->date))}}</td>
                                        <td><img src="/uploads/news/small_{{$new->image}}"/></td>
                                        <td class="center">
                                            <a href="{{ $route }}/update/{{$new->id_news}}" class="btn btn-warning alertwarning" style="color:#FFF !important;"><i class="iconfa-edit" style="color:#FFF;margin-right:10px;"></i>{{Lang::get('display.edit')}}</a>
                                            <a data-id="{{$new->id_news}}" data-action="delete" class="btn confirmbutton btn-danger alertdanger" style="color:#FFF !important;"><i class="iconfa-trash" style="color:#FFF;margin-right:10px;"></i>{{Lang::get('display.delete')}}</a>
                                            <a href="{{ $route }}/arquivos/{{$new->id_news}}" class="btn btn-info alertwarning" style="color:#FFF !important;"><i class="iconfa-file" style="color:#FFF;margin-right:10px;"></i>{{Lang::get('display.arquivos')}}</a>
                                            <a href="{{ $route }}/albums/{{$new->id_news}}" class="btn btn-success alertwarning" style="color:#FFF !important;"><i class="iconfa-picture" style="color:#FFF;margin-right:10px;"></i>{{Lang::get('display.albums')}}</a>
                                            <a href="{{ $route }}/videos/{{$new->id_news}}" class="btn btn-inverse alertwarning" style="color:#FFF !important;"><i class="iconfa-facetime-video" style="color:#FFF;margin-right:10px;"></i>{{Lang::get('display.videos')}}</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>

                
@stop