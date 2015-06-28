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
Banners
@stop

@section("iconpage")
<span class="iconfa-briefcase"></span>
@stop

@section("maintitle")
Banners
@stop

@section("nameview")
    Todos os banners
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
                            <a href="{{ $route }}/create" class="btn dropdown-toggle">Adicionar Banner</a>
                        </div>
                        <h4 class="widgettitle">Todos os banners</h4>
                    </div>
                    
                    <table id="dyntable" class="table table-bordered responsive">
                        
                        <thead>
                            <tr>
                                <th class="head0 nosort"><input type="checkbox" class="checkall" /></th>
                                <th class="head0" style="text-align:center;width:10%;">Thumb</th>
                                <th class="head0" style="text-align:center;width:20%;">Nome</th>
                                <th class="head0" style="text-align:center;width:20%;">Tipo</th>
                                <th class="head1" style="text-align:center;width:10%;">Status</th>
                                <th class="head0" style="text-align:center;width:20%;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        	@foreach($banners as $banner)
                            <tr class="gradeX">
                              <td class="aligncenter"><span class="center">
                                <input type="checkbox" />
                              </span></td>
                                <td class="center" style="vertical-align:middle;width:10%;"><a href="{{ $banner->url != '' ? $banner->url : '#' }}"><img class="rounded" src="/{{ Banners::$images_folder }}thumb_{{$banner->image}}" /></a></td>
                                <td class="center" style="vertical-align:middle;width:20%;"><h4>{{$banner->name}}</h4></td>
                                <td class="center" style="vertical-align:middle;width:10%;">
									{{ Str::contains($banner->type, 'publicaciones' ) ? 'Publicações<br>' : '' }}
									{{ Str::contains($banner->type, 'socios' ) ? 'Socios - Patrocinadores<br>' : '' }}
									{{ Str::contains($banner->type, 'eventos' ) ? 'Eventos- Apoio ABGE <br>' : '' }}
									{{ Str::contains($banner->type, 'parceiros' ) ? 'Parceiros<br>' : '' }}
                                </td>
                                <td class="center" style="vertical-align:middle;width:10%;">{{ Lang::get('display.'.$banner->status) }}</td>
                                <td class="center" style="vertical-align:middle;width:20%;">

                                    <a href="{{ $route }}/update/{{$banner->id}}" class="btn btn-warning alertwarning" style="color:#FFF !important;"><i class="iconfa-edit" style="color:#FFF;margin-right:10px;"></i>Atualizar</a>
                                   
                                    @if($banner->status == 'publish')

                                        <a data-id="{{$banner->id}}" data-action="draft" class="btn confirmbutton btn-primary alertdanger" style="color:#FFF !important; margin-left:10px;"><i class="iconfa-file" style="color:#FFF;margin-right:10px;"></i>Draft</a>
                                    
                                    @else
                                    
                                        <a data-id="{{$banner->id}}" data-action="publish" class="btn confirmbutton btn-success alertdanger" style="color:#FFF !important; margin-left:10px;"><i class="iconfa-ok" style="color:#FFF;margin-right:10px;"></i>Publish</a>

                                    @endif

                                    <a data-id="{{$banner->id}}" data-action="delete" class="btn confirmbutton btn-danger alertdanger" style="color:#FFF !important; margin-left:10px;"><i class="iconfa-trash" style="color:#FFF;margin-right:10px;"></i>Deletar</a>

                               </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                
@stop