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
Associadow
@stop

@section("iconpage")
<span class="iconfa-book"></span>
@stop

@section("maintitle")
Associados
@stop

@section("nameview")
Todos os Associados
@stop

@section("MainContent")
<div class="maincontent">
            <div class="maincontentinner">
            
                <!-- Gets replaced with TinyMCE, remember HTML in a textarea should be encoded -->
                <div class="widgetbox">
                    <div class="headtitle">
                        <div class="btn-group">
                            <a href="{{ $route }}/exportasociados" class="btn"><i class="iconsweets-excel"></i>Excel</a>
                            <a href="{{ $route }}/create" class="btn dropdown-toggle">Adicionar Associado</a>
                        </div>
                        <h4 class="widgettitle">Todos os Associados</h4>
                    </div>
                    <div style="margin:1em">
                        <form method="post">
                            <div>                        
                                <h4 style="display:inline-block;margin-right:1em;">Filtrar por: </h4>
                                <span style="display:inline-block;"><label>Nome: </label><input type="text" name="nombre_completo"></span>
                                <span style="display:inline-block;">
                                    <label>Categoria: </label>
                                    <select name="categoria">
                                        <option value=null>Selecione</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id_categoria_asociado}}">{{$category->nombre_categoria}}</option>
                                        @endforeach
                                    </select>
                                </span>
                                <span style="display:inline-block;">
                                    <label>Tipo Pessoa: </label>
                                    <select name="tipo_usuario">
                                        <option value=null>Selecione</option>
                                        <option value="F">Pessoa Fisica</option>
                                        <option value="J">Pessoa Juridica</option>
                                    </select>
                                </span>
                                <!-- <span style="display:inline-block;">
                                    <label>Pagamento: </label>
                                    <select name="pagamento">
                                        <option value="0">Selecione</option>
                                        <option value="1">Pago</option>
                                        <option value="99">Não Pago</option>
                                    </select>
                                </span> -->
                                <span style="display:inline-block;">
                                    <input class="btn" type="submit" value="Pesquisar">
                                    <a href="{{ $route }}" class="btn">Ver Todos</a>
                                </span>
                            </div>
                        </form>
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
                                <th class="head0" width="30%">Nome</th>
                                <th class="head1"style="width:25%">Email</th>
                                <th class="head0" style="width:10%">Nome Da Empresa</th>
                                <th class="head1" style="width:15%">Tipo de Pessoa</th>
                                <th class="head1" style="width:15%">Es Associado</th>
                                <th class="head1" style="width:15%">Estatuto de Associado</th>
                                <th class="head0" style="width:20%">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($associates))
                                @foreach($associates as $associate)
                                    <tr class="gradeX">
                                      <td class="aligncenter"><span class="center">
                                        <input type="checkbox" />
                                      </span></td>
                                        <td>{{$associate->nombre_completo}}</td>
                                        <td>{{$associate->email}}</td>
                                        <td>{{$associate->razon_social}}</td>
                                        <td>{{$associate->category['tipo_usuario']}}</td>
                                        <td>
                                            @if($associate->es_asociado)
                                                <a href="{{ $route }}/es/{{$associate->id_asociado}}"><i class="iconfa-ok" style="color:#9F9;margin-right:10px;font-size:20pt"></i></a>
                                            @else
                                                <a href="{{ $route }}/es/{{$associate->id_asociado}}"><i class="iconfa-remove" style="color:#F99;margin-right:10px;font-size:20pt"></i></a>
                                            @endif
                                        </td>
                                        <td>
                                            @if($associate->status_asso)
                                                <a href="{{ $route }}/status/{{$associate->id_asociado}}"><i class="iconfa-ok" style="color:#9F9;margin-right:10px;font-size:20pt"></i></a>
                                            @else
                                                <a href="{{ $route }}/status/{{$associate->id_asociado}}"><i class="iconfa-remove" style="color:#F99;margin-right:10px;font-size:20pt"></i></a>
                                            @endif
                                        </td>
                                        <td class="center">
                                            <a href="{{ $route }}/update/{{$associate->id_asociado}}" class="btn btn-warning alertwarning" style="color:#FFF !important;"><i class="iconfa-edit" style="color:#FFF;margin-right:10px;"></i>{{Lang::get('display.edit')}}</a>
                                            <!-- <a data-id="{{$associate->id_asociado}}" data-action="delete" class="btn confirmbutton btn-danger alertdanger" style="color:#FFF !important;"><i class="iconfa-trash" style="color:#FFF;margin-right:10px;"></i>{{Lang::get('display.delete')}}</a> -->
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>

                
@stop