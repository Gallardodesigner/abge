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
Galerias
@stop

@section("iconpage")
<span class="iconfa-briefcase"></span>
@stop

@section("maintitle")
Fotos
@stop

@section("nameview")
    Todas as Fotos
@stop

@section("MainContent")
<div class="maincontent">

    <div class="maincontentinner">
        <div class="widgetbox">
            <div class="headtitle">
                <div class="btn-group">
                    <a href="{{ $parent }}" class="btn dropdown-toggle">Voltar</a>
                    <a href="{{ $route }}/create" class="btn dropdown-toggle" style="padding-left:1em">Adicionar Foto</a>
                </div>
                <h4 class="widgettitle">Todas as Fotos</h4>
            </div>
            
            <table id="dyntable" class="table table-bordered responsive">
                
                <thead>
                    <tr>
                        <th class="head0 nosort"><input type="checkbox" class="checkall" /></th>
                        <th class="head0" style="text-align:center;width:50%;">Foto</th>
                        <th class="head0" style="text-align:center;width:50%;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                	@foreach($pictures as $picture)
                    <tr class="gradeX">
                      <td class="aligncenter"><span class="center">
                        <input type="checkbox" />
                      </span></td>
                        <td class="center" style="vertical-align:middle;width:10%;"><img class="rounded" src="/uploads/photo_album/medium_{{$picture->image}}" /></td>
                        <td class="center" style="vertical-align:middle;width:20%;">
                            <a data-id="{{$picture->id_content}}" data-action="delete" class="btn confirmbutton btn-danger alertdanger" style="color:#FFF !important; margin-left:10px;"><i class="iconfa-trash" style="color:#FFF;margin-right:10px;"></i>Deletar</a>
                       </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
                
@stop