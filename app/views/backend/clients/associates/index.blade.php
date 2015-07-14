@extends("backend.layout")

@section("css")
{{HTML::style("assetsadmin/css/bootstrap-fileupload.min.css")}}
{{HTML::style("assetsadmin/css/bootstrap-timepicker.min.css")}}

@stop

@section("js")
{{HTML::script("assetsadmin/js/jquery.jgrowl.js")}}
{{HTML::script("assetsadmin/js/jquery.alerts.js")}}
{{HTML::script("assetsadmin/js/jquery.dataTables.min.js")}}

<?php 

    function paginatorURI( $filter ){
        return "&nombre_completo=". ($filter['nombre_completo'] != '' ? $filter['nombre_completo'] : '0') ."&categoria=". ($filter['categoria'] != '' ? $filter['categoria'] : '0') ."&tipo_pessoa=".( $filter['tipo_pessoa'] != '' ? $filter['tipo_pessoa'] : '0') ."&pagamento=".( $filter['pagamento'] != '' ? $filter['pagamento'] : '0') ."";
    }

?>

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
        jQuery('#ticket-submit').on('click', function(e){
            e.preventDefault();
            jQuery('#form-ticket').submit();
        });
        jQuery('#checkall').on('change', function(e){
            /*if(jQuery(this).attr('checked') !== undefined){
                console.log("checked")
                jQuery('.chkbtn').prop("checked", true );
                jQuery('.chkbtn').parent
            }
            else{
                console.log("not checked")
                jQuery('.chkbtn').each(function(){
                    jQuery(this).prop('checked',false);
                });
            }*/
            var checkboxes = jQuery(this).closest('form').find(':checkbox');
            if(jQuery(this).is(':checked')) {
                console.log("checked");
                checkboxes.prop('checked', true);
                jQuery('.chkbtn').parent('span').addClass('checked');
            } else {
                console.log("not checked");
                checkboxes.prop('checked', false);
                jQuery('.chkbtn').parent('span').removeClass('checked');
            }
        });
        
        
    });
</script>
@stop

@section("title")
Associados
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
                            <a href="{{ $route }}/exportasociados/{{ $filter['nombre_completo'] != '' ? $filter['nombre_completo'] : '0' }}/{{ $filter['categoria'] }}/{{ $filter['tipo_pessoa'] }}/{{ $filter['pagamento'] }}" class="btn"><i class="iconsweets-excel"></i>Excel</a>
                            <a href="{{ $route }}/create" class="btn dropdown-toggle">Adicionar Associado</a>
                        </div>
                        <h4 class="widgettitle">Todos os Associados</h4>
                    </div>
                    <div style="margin:1em">
                        <form method="get">
                            <div>                        
                                <h4 style="display:inline-block;margin-right:1em;">Filtrar por: </h4>
                                <span style="display:inline-block;"><label>Nome: </label><input type="text" name="nombre_completo" value="{{ $filter['nombre_completo'] != '0' ? $filter['nombre_completo'] : '' }}"></span>
                                <span style="display:inline-block;">
                                    <label>Categoria: </label>
                                    <select name="categoria">
                                        <option value="0">Selecione</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id_categoria_asociado}}" {{ $filter['categoria'] == $category->id_categoria_asociado ? 'selected' : '' }}>{{$category->nombre_categoria}}</option>
                                        @endforeach
                                    </select>
                                </span>
                                <span style="display:inline-block;">
                                    <label>Tipo Pessoa: </label>
                                    <select name="tipo_pessoa">
                                        <option value="0" {{ $filter['tipo_pessoa'] == '0' ? 'selected' : '' }}>Selecione</option>
                                        <option value="F" {{ $filter['tipo_pessoa'] === 'F' ? 'selected' : '' }}>Pessoa Fisica</option>
                                        <option value="J" {{ $filter['tipo_pessoa'] === 'J' ? 'selected' : '' }}>Pessoa Juridica</option>
                                    </select>
                                </span>
                                <span style="display:inline-block;">
                                    <label>Pagamento: </label>
                                    <select name="pagamento">
                                        <option value="0" {{ $filter['pagamento'] == '0' ? 'selected' : '' }}>Selecione</option>
                                        <option value="paid" {{ $filter['pagamento'] === 'paid' ? 'selected' : '' }}>Todos</option>
                                        <option value="paid_active" {{ $filter['pagamento'] === 'paid_active' ? 'selected' : '' }}>Pago Validado</option>
                                        <option value="paid_inactive" {{ $filter['pagamento'] === 'paid_inactive' ? 'selected' : '' }}>Pago Não Validado</option>
                                        <option value="notpaid" {{ $filter['pagamento'] === 'notpaid' ? 'selected' : '' }}>Não Pago</option>
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
                                    <a href="{{ $route }}" id="ticket-submit" class="btn">Generar Boletos</a>
                                </span>
                            </div>
                        </form>
                    </div>
                    <style type="text/css">
                        table.responsive td:first-child, table.responsive td:first-child, table.responsive.pinned td, table.responsive th:first-child {
                            display:block;
                            overflow: visible;
                            z-index: 999;
                        }
                    </style>
                    <form method="post" action="{{ $route }}/processtickets" target="_blank" id="form-ticket">
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
                                <th class="head0" ><input type="checkbox" class="checkall" id="checkall"/></th>
                                <th class="head1" style="width:20%;margin-right: 0px;">Nome</th>
                                <th class="head1" style="width:20%;margin-right: 0px;">Email</th>
                                <th class="head0" style="width:10%;margin-right: 0px;">Nome Da Empresa</th>
                                <th class="head1" style="width:7%;margin-right: 0px;">Tipo de Pessoa</th>
                                <th class="head1" style="width:7%;margin-right: 0px;">Status</th>
                                <th class="head1" style="width:7%;margin-right: 0px;">Pago</th>
                                <th class="head1" style="width:9%;margin-right: 0px;">Pagamento {{ $annuity->ano }}</th>
                                <th class="head0" style="width:18%">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($associates))
                                @foreach($associates as $associate)
                                    <tr class="gradeX">
                                        <td class="aligncenter" >
                                            <input type="checkbox" class="chkbtn" name="chk[{{$associate->id_asociado}}]" value="{{$associate->id_asociado}}"/>

                                        </td>
                                        <td>{{$associate->nombre_completo}} ({{$associate->categoria}})</td>
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
                                            @if( $payment = $associate->getPaymentByAnnuity( $annuity ) )
                                                @if( $payment->status )
                                                    <a href="{{ $route }}/status/{{$associate->id_asociado}}"><i class="iconfa-ok" style="color:#9F9;margin-right:10px;font-size:20pt"></i></a>
                                                @else
                                                    <a href="{{ $route }}/status/{{$associate->id_asociado}}"><i class="iconfa-remove" style="color:#F99;margin-right:10px;font-size:20pt"></i></a>
                                                @endif
                                            @else
                                                <i class="iconfa-remove" style="color:#000;margin-right:10px;font-size:20pt"></i>
                                            @endif                                
                                        </td>
                                        <td>
                                            @if( $payment = $associate->getPaymentByAnnuity( $annuity ) )
                                                @if( $payment->status )
                                                    <a href="{{ $route }}/{{$associate->id_asociado}}/payments/update/{{$payment->id}}" style="color:#6C6;margin-right:10px;font-size:12pt;font-style:none;">R$ {{ number_format($payment->pagamento, 2, ',', '.') }}</a>
                                                @else
                                                    <a href="{{ $route }}/{{$associate->id_asociado}}/payments/update/{{$payment->id}}" style="color:#C66;margin-right:10px;font-size:12pt;font-style:none;">R$ {{ number_format($payment->pagamento, 2, ',', '.') }}</a>
                                                @endif
                                            @else
                                                    <a href="{{ $route }}/{{$associate->id_asociado}}/ticket" style="color:#000;margin-right:10px;font-size:12pt;font-style:none;" target="_blank">R$ {{ number_format(0, 2, ',', '.') }}</a>
                                            @endif
                                        </td>
                                        <td class="center">
                                            <a href="{{ $route }}/{{$associate->id_asociado}}/payments" class="btn btn-primary" style="color:#FFF !important;"><i class="iconfa-money" style="color:#FFF;margin-right:10px;"></i>{{Lang::get('Anuidades')}}</a>
                                            @if( $payment = $associate->getPaymentByAnnuity( $annuity ) )
                                            @else
                                            @endif
                                            <a href="{{ $route }}/update/{{$associate->id_asociado}}" class="btn btn-warning alertwarning" style="color:#FFF !important;"><i class="iconfa-edit" style="color:#FFF;margin-right:10px;"></i>{{Lang::get('Atualizar')}}</a>
                                            <!-- <a data-id="{{$associate->id_asociado}}" data-action="delete" class="btn confirmbutton btn-danger alertdanger" style="color:#FFF !important;"><i class="iconfa-trash" style="color:#FFF;margin-right:10px;"></i>{{Lang::get('display.delete')}}</a> -->
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    <div class="pagination">

                        <ul class="pagination"> 
                            <li>
                                <a href="{{$route}}?page=1{{paginatorURI( $filter )}}">Primera</a>
                            </li>
                            <li {{ $associates->getCurrentPage() == 1 ? 'class=disabled': '' }}>
                                @if($associates->getCurrentPage() == 1)
                                    <span>Anterior</span>
                                @else
                                    <a href="{{$route}}?page={{ $associates->getCurrentPage() -1 }}{{paginatorURI( $filter )}}">Anterior</a>
                                @endif
                            </li>
                            @if($associates->getCurrentPage() > 8)
                                <li>
                                    <a href="{{$route}}?page=1{{paginatorURI( $filter )}}">1</a>
                                </li>
                                <li {{ $associates->getCurrentPage() == 1 ? 'class=disabled': '' }}>
                                    <a href="{{$route}}?page=2{{paginatorURI( $filter )}}">2</a>
                                </li>
                                <li class="disabled"><span>...</span></li>
                            @endif
                            @for($i = $associates->getCurrentPage() - 3 ; $i <= ($associates->getCurrentPage() + 3) ; $i++)
                                @if($i > 0 && $i <= $associates->getLastPage())
                                    @if($i == $associates->getCurrentPage())
                                        <li class="active">
                                            <span>{{($i)}}</span>
                                        </li>
                                    @else
                                        <li>
                                            <a href="{{$route}}?page={{($i)}}{{paginatorURI( $filter )}}">{{($i)}}</a>
                                        </li>
                                    @endif
                                @endif
                            @endfor
                            @if($associates->getCurrentPage() < ($associates->getLastPage() - 5))
                                <li class="disabled"><span>...</span></li>
                                <li>
                                    <a href="{{$route}}?page={{($associates->getLastPage() - 1)}}{{paginatorURI( $filter )}}">{{($associates->getLastPage() - 1)}}</a>
                                </li>
                                <li >
                                    <a href="{{$route}}?page={{($associates->getLastPage())}}{{paginatorURI( $filter )}}">{{($associates->getLastPage() )}}</a>
                                </li>
                            @endif
                            <li {{ $associates->getCurrentPage() == 1 ? 'class=disabled': '' }}>
                                @if($associates->getCurrentPage() == $associates->getLastPage())
                                    <span>Siguiente</span>
                                @else
                                    <a href="{{$route}}?page={{$associates->getCurrentPage() + 1}}{{paginatorURI( $filter )}}">Siguiente</a>
                                @endif
                            </li>
                            <li>
                                <a href="{{$route}}?page={{ $associates->getLastPage() }}{{paginatorURI( $filter )}}">Última</a>
                            </li>
                        </ul>   
                        
                        <!--{{ $associates->links() }}-->
                        
                    </div>
                    <style type="text/css">
                        .pagination ul{
                            list-style: none;
                            display: inline-block;
                        }
                        .pagination{
                            text-align: right;
                        }
                    </style>
                </div>



                
@stop