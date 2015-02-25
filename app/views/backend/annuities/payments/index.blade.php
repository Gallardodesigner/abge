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
Pagamentos
@stop

@section("iconpage")
<span class="iconfa-book"></span>
@stop

@section("maintitle")
Pagamentos
@stop

@section("nameview")
Todos os Pagamentos
@stop

@section("MainContent")
<div class="maincontent">
            <div class="maincontentinner">
            
                <!-- Gets replaced with TinyMCE, remember HTML in a textarea should be encoded -->
                <div class="widgetbox">
                    <div class="headtitle">
                        <div class="btn-group">
                            <a href="{{ $parent }}" class="btn dropdown-toggle">Voltar</a>
                            <a href="{{ $route }}/create" class="btn dropdown-toggle" style="padding-left: 20px;">Adicionar Nuevo</a>
                        </div>
                        <h4 class="widgettitle">Todos os Pagamentos do categoria {{ $category->category->nombre_categoria }} en anuidade {{ $category->annuity->ano }}</h4>
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
                                <th class="head0" width="60%">Nome do Associado</th>
                                <th class="head0" width="60%">Data de pagamento</th>
                                <th class="head0" width="60%">Monto do Pagamento</th>
                                <th class="head0" width="60%">Status do Pagamento</th>
                                <th class="head0" style="width:40%">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($payments))
                                @foreach($payments as $payment)
                                    <tr class="gradeX">
                                      <td class="aligncenter"><span class="center">
                                        <input type="checkbox" />
                                      </span></td>
                                        <td>{{$payment->associate->nombre_completo}}</td>
                                        <td>{{date('d-m-Y',strtotime($payment->data_pagamento))}}</td>
                                        <td> R$ {{$payment->pagamento}}</td>
                                        <td>
                                            @if($payment->status)
                                                <i class="iconfa-ok" style="color:#9F9;margin-right:10px;font-size:20pt"></i>
                                            @else
                                                <i class="iconfa-remove" style="color:#F99;margin-right:10px;font-size:20pt"></i>
                                            @endif
                                        </td>
                                        <td class="center">
                                            @if(!$payment->status)
                                                <a href="{{ $route }}/paid/{{$payment->id}}" class="btn btn-success alertwarning" style="color:#FFF !important;"><i class="iconfa-tasks" style="color:#FFF;margin-right:10px;"></i>{{Lang::get('display.verify_payment')}}</a>
                                            @else
                                                <a href="{{ $route }}/notpaid/{{$payment->id}}" class="btn btn-danger alertwarning" style="color:#FFF !important;"><i class="iconfa-tasks" style="color:#FFF;margin-right:10px;"></i>{{Lang::get('display.decline_payment')}}</a>
                                            @endif
                                            <a href="{{ $route }}/update/{{$payment->id}}" class="btn btn-warning alertwarning" style="color:#FFF !important;"><i class="iconfa-edit" style="color:#FFF;margin-right:10px;"></i>Editar</a>
                                            <a data-id="{{$payment->id}}" data-action="delete" class="btn confirmbutton btn-danger alertdanger" style="color:#FFF !important;"><i class="iconfa-trash" style="color:#FFF;margin-right:10px;"></i>Eliminar</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>

                
@stop