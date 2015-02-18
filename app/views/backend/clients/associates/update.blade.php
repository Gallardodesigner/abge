@extends("backend.layout")

@section("css")
{{HTML::style("assetsadmin/css/bootstrap-fileupload.min.css")}}
{{HTML::style("assetsadmin/css/bootstrap-timepicker.min.css")}}
{{HTML::style("assetsadmin/js/chosen/chosen.min.css")}}
<style type="text/css">
        /*
    Stylesheet for examples by DevHeart.
    http://devheart.org/

    Article title:  jQuery: Customizable layout using drag n drop
    Article URI:    http://devheart.org/articles/jquery-customizable-layout-using-drag-and-drop/

    Example title:  1. Getting started with sortable lists
    Example URI:    http://devheart.org/examples/jquery-customizable-layout-using-drag-and-drop/1-getting-started-with-sortable-lists/index.html
*/

/*
    Alignment
------------------------------------------------------------------- */

/* Floats */

.left {float: left;}
.right {float: right;}

.clear,.clearer {clear: both;}
.clearer {
    display: block;
    font-size: 0;
    height: 0;
    line-height: 0;
}

/*
    Example specifics
------------------------------------------------------------------- /

.column.first {margin-bottom: 60px;}


/* Sortable items /

.sortable-list {
    background-color: #F93;
    list-style: none;
    margin: 0;
    min-height: 60px;
    padding: 10px;
}
.sortable-item {
    background-color: #FFF;
    border: 1px solid #000;
    cursor: move;
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
    padding: 20px 0;
    text-align: center;
}

/* Containment area */


/* Item placeholder (visual helper) /

.placeholder {
    background-color: #BFB;
    border: 1px dashed #666;
    height: 58px;
    margin-bottom: 5px;
}
*/
    </style>
@stop


@section("js")
<!-- <script src="http://tinymce.cachefly.net/4.1/jquery.tinymce.min.js"></script>
<script src="http://tinymce.cachefly.net/4.1/tinymce.min.js"></script>

{{HTML::script("assetsadmin/js/tiny_mce/jquery.tinymce.min.js")}}
{{HTML::script("assetsadmin/js/tiny_mce/tinymce.js")}}

{{HTML::script("assetsadmin/js/wysiwyg.js")}}
 -->
{{HTML::script("assetsadmin/js/jquery.smartWizard.min.js")}}
{{HTML::script("assetsadmin/js/fullcalendar.min.js")}}
{{HTML::script("assetsadmin/js/chosen/chosen.jquery.min.js")}}
{{HTML::script("assetsadmin/js/chosen/chosen.proto.min.js")}}

<script type='text/javascript'>


    jQuery(document).ready(function() {

        jQuery('#associate').submit(function(e){
            //e.preventDefault()
            var elem = jQuery(this);
            console.log(elem.serialize());
        });
///Lista sortable
        jQuery('.chosen-select').chosen({no_results_text: "Oops, nothing found!"});
     elementos=[];
        jQuery('#containment .sortable-list').sortable({
        connectWith: '#containment .sortable-list',
        containment: '#containment',
         start: function (event, ui){
            var data = {
                'index': ui.item.index(),
                'id': ui.item.attr("id")
            };
            start_position = data.index;
            console.log("Arrastrando el Video " + data.id + " en la posicion " + data.index);
        },
        stop: function(event, ui){
            //console.log("Stop");
            var data = {
                'index': ui.item.index(),
                'id': ui.item.attr("id"),
                'start': start_position
            };
            if (jQuery(ui.item).parent().attr("id")=="to-save"){
                console.log("Agregando el Video " + data.id + " en la posicion " + data.index );
                console.log(ui);
                jQuery("#to-save").append("<input id='teacher_"+data.id+"' type='hidden' name='teachers[]' value='"+data.id+"'>");
                console.log( jQuery("#teacher_"+data.id).val());
              
            }
            if (jQuery(ui.item).parent().attr("id")=="to-remove"){
                console.log("Borrando el Video " + data.id + " en la posicion " + data.index );
                console.log(ui);
                jQuery("#to-save > #teacher_"+data.id).remove();
                console.log( jQuery("#teacher_"+data.id).val());

            }
        }
    });

    /// Fin Lista sortable
   
    jQuery('#wizard').smartWizard({onFinish: onFinishCallback});

    function onFinishCallback(){
      jQuery("#associate").submit();  
    } 
        
        jQuery('#data_cadastro').datepicker({
            defaultDate: "+1w",
            dateFormat: "dd-mm-yy",
        });
        jQuery('#data_nascimento').datepicker({
            defaultDate: "+1w",
            dateFormat: "dd-mm-yy",
        });

        jQuery('#start').datepicker({
                defaultDate: "+1w",
            dateFormat: "dd-mm-yy",

              onClose: function( selectedDate ) {
                jQuery("#end" ).datepicker("option", "minDate", selectedDate );
            }
        });

        jQuery( "#end" ).datepicker({
            defaultDate: "+1w",
            dateFormat: "dd-mm-yy",
          onClose: function( selectedDate ) {
            jQuery( "#start" ).datepicker( "option", "maxDate", selectedDate );
            }
        });

        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();
        
        var calendar = jQuery('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            buttonText: {
                prev: '&laquo;',
                next: '&raquo;',
                prevYear: '&nbsp;&lt;&lt;&nbsp;',
                nextYear: '&nbsp;&gt;&gt;&nbsp;',
                today: 'today',
                month: 'month',
                week: 'week',
                day: 'day'
            },
            selectable: true,
            selectHelper: true,

            select: function(start, end, allDay) {
                var title = prompt('Event Title:');
                if (title) {
                    calendar.fullCalendar('renderEvent',
                        {
                            title: title,
                            start: start,
                            end: end,
                            allDay: allDay
                        },
                        true // make the event "stick"
                    );
                }
                calendar.fullCalendar('unselect');
            },
            editable: true,
            // events: [
            //     {
            //         title: 'All Day Event',
            //         start: new Date(y, m, 1)
            //     },
            //     {
            //         title: 'Meeting',
            //         start: new Date(y, m, d, 10, 30),
            //         allDay: false
            //     },
            //     {
            //         title: 'Lunch',
            //         start: new Date(y, m, d, 12, 0),
            //         end: new Date(y, m, d, 14, 0),
            //         allDay: false
            //     },
            //     {
            //         title: 'Birthday Party',
            //         start: new Date(y, m, d+1, 19, 0),
            //         end: new Date(y, m, d+1, 22, 30),
            //         allDay: false
            //     },
            //     {
            //         title: 'Click for Google',
            //         start: new Date(y, m, 28),
            //         end: new Date(y, m, 29),
            //         url: 'http://google.com/'
            //     }
            // ]
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
    Adicionar Associado
@stop

@section("MainContent")
<div class="maincontent">
            <div class="maincontentinner">
            
                <!-- Gets replaced with TinyMCE, remember HTML in a textarea should be encoded -->
                <div class="widget">
                    <div class="headtitle">
                    <div class="btn-group">
                        <a href="{{ $route }}" class="btn dropdown-toggle">Atrás</a>
                    </div>
                    </div>
                    <h4 class="widgettitle">Adicionar Associado</h4>
                        <form id="associate" class="stdform " method="POST" action="" enctype="multipart/form-data">
                            <div id="wizard" class="wizard">
                                <ul class="hormenu">
                                    <li>
                                        <a href="#wiz1step1">
                                            <span class="h2">Passo 1</span>
                                            <span class="label">Dados Pessoais</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#wiz1step2">
                                            <span class="h2">Passo 2</span>
                                            <span class="label">Endereços Residencial</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#wiz1step3">
                                            <span class="h2">Passo 3</span>
                                            <span class="label">Endereços Comercial</span>
                                        </a>
                                    </li>  
                                    <li>
                                        <a href="#wiz1step4">
                                            <span class="h2">Passo 4</span>
                                            <span class="label">Matrícula</span>
                                        </a>
                                    </li>  
                                    <li>
                                        <a href="#wiz1step5">
                                            <span class="h2">Passo 5</span>
                                            <span class="label">Dados Acadêmicos</span>
                                        </a>
                                    </li>  
                                    <li>
                                        <a href="#wiz1step6">
                                            <span class="h2">Passo 6</span>
                                            <span class="label">Área de Atuação - Curriculum</span>
                                        </a>
                                    </li>  
                                </ul>

                                <div id="wiz1step1" class="formwiz">
                                    <h4 class="widgettitle">Passo 1: Dados Pessoais</h4>
                                
                                    <p>
                                        <label>Nome Completo</label>
                                        <span class="field"><input type="text" name="nombre_completo" id="nombre_completo" class="input-xxlarge" value="{{$associate->nombre_completo}}" /></span>
                                    </p>
                                    <p>
                                        <label>Email</label>
                                        <span class="field"><input type="email" name="email" id="email" class="input-xxlarge" value="{{$associate->email}}" /></span>
                                    </p>
                                    <p>
                                        <label>Edo civil</label>
                                        <span class="field">
                                            <select name="edo_civil" id="asociados_edo_civil">
                                                <option value="1" {{ $associate->edo_civil == '1' ? 'selected' : '' }}>Solteiro(a)</option>
                                                <option value="2" {{ $associate->edo_civil == '2' ? 'selected' : '' }}>Casado(a)</option>
                                                <option value="3" {{ $associate->edo_civil == '3' ? 'selected' : '' }}>Divorciado(a)</option>
                                                <option value="4" {{ $associate->edo_civil == '4' ? 'selected' : '' }}>Viudo(a)</option>
                                            </select>
                                        </span>
                                    </p>
                                    <p>
                                        <label>Status do Associado</label>
                                        <span class="field">
                                            <select class="chosen-select" name="status_asso">
                                                <option value="0" {{ $associate->status_asso == '0' ? 'selected' : '' }}>Desabilitado</option>
                                                <option value="1" {{ $associate->status_asso == '1' ? 'selected' : '' }}>Habilitado</option>
                                            </select>
                                        </span>
                                    </p>
                                    <p>
                                        <label>Estado matricula</label>
                                        <span class="field">
                                            @if (isset($estados))
                                                <select class="chosen-select" name="estado_matricula" >
                                                    @foreach ($estados as $estado)
                                                        <option value="{{$estado->id_estado}}" {{ $associate->estado_matricula == $estado->id_estado ? 'selected' : '' }}>{{$estado->name_estado}}</option>
                                                    @endforeach
                                                </select>
                                            @endif
                                        </span>
                                    </p>                                
                                    <p>
                                        <label>Passaporte</label>
                                        <span class="field"><input type="text" name="passaporte" id="passaporte" class="input-xxlarge" value="{{$associate->passaporte}}" /></span>
                                    </p>                                
                                    <p>
                                        <label>Instituição</label>
                                        <span class="field"><input type="text" name="institucion" id="institucion" class="input-xxlarge" value="{{$associate->institucion}}" /></span>
                                    </p>                                
                                    <p>
                                        <label>Empresa</label>
                                        <span class="field"><input type="text" name="empresa" id="empresa" class="input-xxlarge" value="{{$associate->empresa}}" /></span>
                                    </p>                               
                                    <p>
                                        <label>RG</label>
                                        <span class="field"><input type="text" name="rg" id="rg" class="input-xxlarge" value="{{$associate->rg}}" /></span>
                                    </p>    
                                    <p>
                                        <label>Correspondência</label>
                                        <span class="field">
                                            <select style="width:100px;" name="tipo_correspondencia" id="asociados_tipo_correspondencia">
                                                <option value="c" {{ $associate->tipo_correspondencia == 'c' ? 'selected' : '' }}>Comercial</option>
                                                <option value="r" {{ $associate->tipo_correspondencia == 'r' ? 'selected' : '' }}>Residencial</option>
                                            </select>
                                        </span>
                                    </p>  
                                    <p>
                                        <label>Data de nascimento</label>
                                        <span class="field"><input type="text" name="data_nascimento" id="data_nascimento" class="input-xxlarge"  value="{{$associate->data_nascimento}}"/></span>
                                    </p>  
                                    <p>
                                        <label>Sexo</label>
                                        <span class="field">
                                            <select name="sexo" id="sexo">
                                                <option value="1" {{ $associate->sexo == '1' ? 'selected' : '' }}>Masculino</option>
                                                <option value="2" {{ $associate->sexo == '2' ? 'selected' : '' }}>Feminino</option>
                                            </select>
                                        </span>
                                    </p>

                                    <p>
                                        <label>Código da Matrícula</label>
                                        <span class="field"><input type="text" name="codigo_matricula" id="codigo_matricula" class="input-xxlarge" value="{{$associate->codigo_matricula}}" /></span>
                                    </p> 
                                    <p>
                                        <label>Senha</label>
                                        <span class="field"><input type="password" name="senha" id="senha" class="input-xxlarge" /></span>
                                    </p> 
                                    <p>
                                        <label>Web site</label>
                                        <span class="field"><input type="text" name="web_site" id="web_site" class="input-xxlarge"  value="{{$associate->web_site}}"/></span>
                                    </p>
                                    <p>
                                        <label>Categoria profissional</label>
                                        <span class="field">
                                            @if (isset($categorias))
                                                <select class="chosen-select" name="categoria">
                                                    @foreach ($categorias as $categoria)
                                                        <option value="{{$categoria->id_categoria_asociado}}" {{ $associate->categoria == $categoria->id_categoria_asocaido ? 'selected' : '' }}>{{$categoria->nombre_categoria}}</option>
                                                    @endforeach
                                                </select>
                                            @endif
                                        </span>
                                    </p>                            
                                    <p>
                                        <label>Cargo</label>
                                        <span class="field"><input type="text" name="cargo" id="cargo" class="input-xxlarge"  value="{{$associate->cargo}}"/></span>
                                    </p>
                                    <p>
                                        <label>CPF</label>
                                        <span class="field"><input type="text" name="cpf" id="cpf" class="input-xxlarge"  value="{{$associate->cpf}}"/> &nbsp;&nbsp; <em>Só números</em></span>
                                    </p>
                                    
                                    <!-- <p>
                                        <label>Tipo pessoa</label>
                                        <span class="field">
                                            <select class="chosen-select" name="tipo_pessoa">
                                                <option value="" {{ $associate->tipo_pessoa == '' ? 'selected' : '' }}>Selecione Tipo de Pessoa</option>
                                                <option value="F" {{ $associate->tipo_pessoa == 'F' ? 'selected' : '' }}>Pessoa Física</option>
                                                <option value="J" {{ $associate->tipo_pessoa == 'J' ? 'selected' : '' }}>Pessoa Jurídica</option>
                                            </select>
                                        </span>
                                    </p>
                                    <p>
                                        <label>Formação</label>
                                        <span class="field">
                                            @if (isset($formacaos))
                                                <select class="chosen-select" name="formacao">
                                                    @foreach ($formacaos as $formacao)
                                                        <option value="{{$formacao->id}}" {{ $associate->formacao == $formacao->id ? 'selected' : '' }}>{{$formacao->nome}}</option>
                                                    @endforeach
                                                </select>
                                            @endif
                                        </span>
                                    </p>
                                    <p>
                                        <label>Data cadastro</label>
                                        <span class="field"><input type="text" name="data_cadastro" id="data_cadastro" class="input-xxlarge"  value="{{$associate->data_cadastro}}"/></span>
                                    </p> -->
                                </div>
                                <div id="wiz1step2" class="formwiz">
                                    <h4 class="widgettitle">Passo 2: Endereços Residencial</h4>
                                    
                                    <p>
                                        <label>CEP</label>
                                        <span class="field"><input type="text" name="cep_res" id="cep_res" class="input-xxlarge" value="{{ $associate->cep_res }}" /></span>
                                    </p>
                                    <p>
                                        <label>Número</label>
                                        <span class="field"><input type="text" name="numero_res" id="numero_res" class="input-xxlarge" value="{{$associate->numero_res}}" /></span>
                                    </p>
                                    <p>
                                        <label>Complemento</label>
                                        <span class="field"><input type="text" name="complemento_res" id="complemento_res" class="input-xxlarge" value="{{$associate->complemento_res}}" /></span>
                                    </p>
                                    <p>
                                        <label>Pais</label>
                                        <span class="field">
											<select name="pais_res" id="asociados_pais_res">
												<option {{ $associate->pais_res == '0' ? 'selected' : '' }} value="0">Selecione o País</option>
												<option {{ $associate->pais_res == 'AF' ? 'selected' : '' }} value="AF">Afghanistan</option>
												<option {{ $associate->pais_res == 'AX' ? 'selected' : '' }} value="AX">Åland Islands</option>
												<option {{ $associate->pais_res == 'AL' ? 'selected' : '' }} value="AL">Albania</option>
												<option {{ $associate->pais_res == 'DZ' ? 'selected' : '' }} value="DZ">Algeria</option>
												<option {{ $associate->pais_res == 'AS' ? 'selected' : '' }} value="AS">American Samoa</option>
												<option {{ $associate->pais_res == '1' ? 'selected' : '' }} value="1">Americas</option>
												<option {{ $associate->pais_res == 'AD' ? 'selected' : '' }} value="AD">Andorra</option>
												<option {{ $associate->pais_res == 'AO' ? 'selected' : '' }} value="AO">Angola</option>
												<option {{ $associate->pais_res == 'AI' ? 'selected' : '' }} value="AI">Anguilla</option>
												<option {{ $associate->pais_res == 'AQ' ? 'selected' : '' }} value="AQ">Antarctica</option>
												<option {{ $associate->pais_res == 'AG' ? 'selected' : '' }} value="AG">Antigua and Barbuda</option>
												<option {{ $associate->pais_res == 'AR' ? 'selected' : '' }} value="AR">Argentina</option>
												<option {{ $associate->pais_res == 'AM' ? 'selected' : '' }} value="AM">Armenia</option>
												<option {{ $associate->pais_res == 'AW' ? 'selected' : '' }} value="AW">Aruba</option>
												<option {{ $associate->pais_res == '142' ? 'selected' : '' }} value="142">Asia</option>
												<option {{ $associate->pais_res == 'AU' ? 'selected' : '' }} value="AU">Australia</option>
												<option {{ $associate->pais_res == '43' ? 'selected' : '' }} value="43">Australia and New Zealand</option>
												<option {{ $associate->pais_res == 'AT' ? 'selected' : '' }} value="AT">Austria</option>
												<option {{ $associate->pais_res == 'AZ' ? 'selected' : '' }} value="AZ">Azerbaijan</option>
												<option {{ $associate->pais_res == 'BS' ? 'selected' : '' }} value="BS">Bahamas</option>
												<option {{ $associate->pais_res == 'BH' ? 'selected' : '' }} value="BH">Bahrain</option>
												<option {{ $associate->pais_res == 'BD' ? 'selected' : '' }} value="BD">Bangladesh</option>
												<option {{ $associate->pais_res == 'BB' ? 'selected' : '' }} value="BB">Barbados</option>
												<option {{ $associate->pais_res == 'BY' ? 'selected' : '' }} value="BY">Belarus</option>
												<option {{ $associate->pais_res == 'BE' ? 'selected' : '' }} value="BE">Belgium</option>
												<option {{ $associate->pais_res == 'BZ' ? 'selected' : '' }} value="BZ">Belize</option>
												<option {{ $associate->pais_res == 'BJ' ? 'selected' : '' }} value="BJ">Benin</option>
												<option {{ $associate->pais_res == 'BM' ? 'selected' : '' }} value="BM">Bermuda</option>
												<option {{ $associate->pais_res == 'BT' ? 'selected' : '' }} value="BT">Bhutan</option>
												<option {{ $associate->pais_res == 'BO' ? 'selected' : '' }} value="BO">Bolivia</option>
												<option {{ $associate->pais_res == 'BA' ? 'selected' : '' }} value="BA">Bosnia and Herzegovina</option>
												<option {{ $associate->pais_res == 'BW' ? 'selected' : '' }} value="BW">Botswana</option>
												<option {{ $associate->pais_res == 'BV' ? 'selected' : '' }} value="BV">Bouvet Island</option>
												<option {{ $associate->pais_res == 'BR' ? 'selected' : '' }} value="BR">Brazil</option>
												<option {{ $associate->pais_res == 'IO' ? 'selected' : '' }} value="IO">British Indian Ocean Territory</option>
												<option {{ $associate->pais_res == 'VG' ? 'selected' : '' }} value="VG">British Virgin Islands</option>
												<option {{ $associate->pais_res == 'BN' ? 'selected' : '' }} value="BN">Brunei</option>
												<option {{ $associate->pais_res == 'BG' ? 'selected' : '' }} value="BG">Bulgaria</option>
												<option {{ $associate->pais_res == 'BF' ? 'selected' : '' }} value="BF">Burkina Faso</option>
												<option {{ $associate->pais_res == 'BI' ? 'selected' : '' }} value="BI">Burundi</option>
												<option {{ $associate->pais_res == 'KH' ? 'selected' : '' }} value="KH">Cambodia</option>
												<option {{ $associate->pais_res == 'CM' ? 'selected' : '' }} value="CM">Cameroon</option>
												<option {{ $associate->pais_res == 'CA' ? 'selected' : '' }} value="CA">Canada</option>
												<option {{ $associate->pais_res == 'CV' ? 'selected' : '' }} value="CV">Cape Verde</option>
												<option {{ $associate->pais_res == '2' ? 'selected' : '' }} value="2">Caribbean</option>
												<option {{ $associate->pais_res == 'KY' ? 'selected' : '' }} value="KY">Cayman Islands</option>
												<option {{ $associate->pais_res == 'CF' ? 'selected' : '' }} value="CF">Central African Republic</option>
												<option {{ $associate->pais_res == '11' ? 'selected' : '' }} value="11">Central America</option>
												<option {{ $associate->pais_res == '143' ? 'selected' : '' }} value="143">Central Asia</option>
												<option {{ $associate->pais_res == 'TD' ? 'selected' : '' }} value="TD">Chad</option>
												<option {{ $associate->pais_res == '830' ? 'selected' : '' }} value="830">Channel Islands</option>
												<option {{ $associate->pais_res == 'CL' ? 'selected' : '' }} value="CL">Chile</option>
												<option {{ $associate->pais_res == 'CN' ? 'selected' : '' }} value="CN">China</option>
												<option {{ $associate->pais_res == 'CX' ? 'selected' : '' }} value="CX">Christmas Island</option>
												<option {{ $associate->pais_res == 'CC' ? 'selected' : '' }} value="CC">Cocos [Keeling] Islands</option>
												<option {{ $associate->pais_res == 'CO' ? 'selected' : '' }} value="CO">Colombia</option>
												<option {{ $associate->pais_res == '172' ? 'selected' : '' }} value="172">Commonwealth of Independent States</option>
												<option {{ $associate->pais_res == 'KM' ? 'selected' : '' }} value="KM">Comoros</option>
												<option {{ $associate->pais_res == 'CG' ? 'selected' : '' }} value="CG">Congo - Brazzaville</option>
												<option {{ $associate->pais_res == 'CD' ? 'selected' : '' }} value="CD">Congo - Kinshasa</option>
												<option {{ $associate->pais_res == 'CK' ? 'selected' : '' }} value="CK">Cook Islands</option>
												<option {{ $associate->pais_res == 'CR' ? 'selected' : '' }} value="CR">Costa Rica</option>
												<option {{ $associate->pais_res == 'CI' ? 'selected' : '' }} value="CI">Côte d’Ivoire</option>
												<option {{ $associate->pais_res == 'HR' ? 'selected' : '' }} value="HR">Croatia</option>
												<option {{ $associate->pais_res == 'CU' ? 'selected' : '' }} value="CU">Cuba</option>
												<option {{ $associate->pais_res == 'CY' ? 'selected' : '' }} value="CY">Cyprus</option>
												<option {{ $associate->pais_res == '200' ? 'selected' : '' }} value="200">Czechoslovakia</option>
												<option {{ $associate->pais_res == 'CZ' ? 'selected' : '' }} value="CZ">Czech Republic</option>
												<option {{ $associate->pais_res == 'DK' ? 'selected' : '' }} value="DK">Denmark</option>
												<option {{ $associate->pais_res == 'DJ' ? 'selected' : '' }} value="DJ">Djibouti</option>
												<option {{ $associate->pais_res == 'DM' ? 'selected' : '' }} value="DM">Dominica</option>
												<option {{ $associate->pais_res == 'DO' ? 'selected' : '' }} value="DO">Dominican Republic</option>
												<option {{ $associate->pais_res == '12' ? 'selected' : '' }} value="12">Eastern Africa</option>
												<option {{ $associate->pais_res == '24' ? 'selected' : '' }} value="24">Eastern Asia</option>
												<option {{ $associate->pais_res == '151' ? 'selected' : '' }} value="151">Eastern Europe</option>
												<option {{ $associate->pais_res == 'EC' ? 'selected' : '' }} value="EC">Ecuador</option>
												<option {{ $associate->pais_res == 'EG' ? 'selected' : '' }} value="EG">Egypt</option>
												<option {{ $associate->pais_res == 'SV' ? 'selected' : '' }} value="SV">El Salvador</option>
												<option {{ $associate->pais_res == 'GQ' ? 'selected' : '' }} value="GQ">Equatorial Guinea</option>
												<option {{ $associate->pais_res == 'ER' ? 'selected' : '' }} value="ER">Eritrea</option>
												<option {{ $associate->pais_res == 'EE' ? 'selected' : '' }} value="EE">Estonia</option>
												<option {{ $associate->pais_res == 'ET' ? 'selected' : '' }} value="ET">Ethiopia</option>
												<option {{ $associate->pais_res == '150' ? 'selected' : '' }} value="150">Europe</option>
												<option {{ $associate->pais_res == 'QU' ? 'selected' : '' }} value="QU">European Union</option>
												<option {{ $associate->pais_res == 'FK' ? 'selected' : '' }} value="FK">Falkland Islands</option>
												<option {{ $associate->pais_res == 'FO' ? 'selected' : '' }} value="FO">Faroe Islands</option>
												<option {{ $associate->pais_res == 'FJ' ? 'selected' : '' }} value="FJ">Fiji</option>
												<option {{ $associate->pais_res == 'FI' ? 'selected' : '' }} value="FI">Finland</option>
												<option {{ $associate->pais_res == 'FR' ? 'selected' : '' }} value="FR">France</option>
												<option {{ $associate->pais_res == 'GF' ? 'selected' : '' }} value="GF">French Guiana</option>
												<option {{ $associate->pais_res == 'PF' ? 'selected' : '' }} value="PF">French Polynesia</option>
												<option {{ $associate->pais_res == 'TF' ? 'selected' : '' }} value="TF">French Southern Territories</option>
												<option {{ $associate->pais_res == 'GA' ? 'selected' : '' }} value="GA">Gabon</option>
												<option {{ $associate->pais_res == 'GM' ? 'selected' : '' }} value="GM">Gambia</option>
												<option {{ $associate->pais_res == 'GE' ? 'selected' : '' }} value="GE">Georgia</option>
												<option {{ $associate->pais_res == 'DE' ? 'selected' : '' }} value="DE">Germany</option>
												<option {{ $associate->pais_res == 'GH' ? 'selected' : '' }} value="GH">Ghana</option>
												<option {{ $associate->pais_res == 'GI' ? 'selected' : '' }} value="GI">Gibraltar</option>
												<option {{ $associate->pais_res == 'GR' ? 'selected' : '' }} value="GR">Greece</option>
												<option {{ $associate->pais_res == 'GL' ? 'selected' : '' }} value="GL">Greenland</option>
												<option {{ $associate->pais_res == 'GD' ? 'selected' : '' }} value="GD">Grenada</option>
												<option {{ $associate->pais_res == 'GP' ? 'selected' : '' }} value="GP">Guadeloupe</option>
												<option {{ $associate->pais_res == 'GU' ? 'selected' : '' }} value="GU">Guam</option>
												<option {{ $associate->pais_res == 'GT' ? 'selected' : '' }} value="GT">Guatemala</option>
												<option {{ $associate->pais_res == 'GG' ? 'selected' : '' }} value="GG">Guernsey</option>
												<option {{ $associate->pais_res == 'GN' ? 'selected' : '' }} value="GN">Guinea</option>
												<option {{ $associate->pais_res == 'GW' ? 'selected' : '' }} value="GW">Guinea-Bissau</option>
												<option {{ $associate->pais_res == 'GY' ? 'selected' : '' }} value="GY">Guyana</option>
												<option {{ $associate->pais_res == 'HT' ? 'selected' : '' }} value="HT">Haiti</option>
												<option {{ $associate->pais_res == 'HM' ? 'selected' : '' }} value="HM">Heard Island and McDonald Islands</option>
												<option {{ $associate->pais_res == 'HN' ? 'selected' : '' }} value="HN">Honduras</option>
												<option {{ $associate->pais_res == 'HK' ? 'selected' : '' }} value="HK">Hong Kong SAR China</option>
												<option {{ $associate->pais_res == 'HU' ? 'selected' : '' }} value="HU">Hungary</option>
												<option {{ $associate->pais_res == 'IS' ? 'selected' : '' }} value="IS">Iceland</option>
												<option {{ $associate->pais_res == 'IN' ? 'selected' : '' }} value="IN">India</option>
												<option {{ $associate->pais_res == 'ID' ? 'selected' : '' }} value="ID">Indonesia</option>
												<option {{ $associate->pais_res == 'IR' ? 'selected' : '' }} value="IR">Iran</option>
												<option {{ $associate->pais_res == 'IQ' ? 'selected' : '' }} value="IQ">Iraq</option>
												<option {{ $associate->pais_res == 'IE' ? 'selected' : '' }} value="IE">Ireland</option>
												<option {{ $associate->pais_res == 'IM' ? 'selected' : '' }} value="IM">Isle of Man</option>
												<option {{ $associate->pais_res == 'IL' ? 'selected' : '' }} value="IL">Israel</option>
												<option {{ $associate->pais_res == 'IT' ? 'selected' : '' }} value="IT">Italy</option>
												<option {{ $associate->pais_res == 'JM' ? 'selected' : '' }} value="JM">Jamaica</option>
												<option {{ $associate->pais_res == 'JP' ? 'selected' : '' }} value="JP">Japan</option>
												<option {{ $associate->pais_res == 'JE' ? 'selected' : '' }} value="JE">Jersey</option>
												<option {{ $associate->pais_res == 'JO' ? 'selected' : '' }} value="JO">Jordan</option>
												<option {{ $associate->pais_res == 'KZ' ? 'selected' : '' }} value="KZ">Kazakhstan</option>
												<option {{ $associate->pais_res == 'KE' ? 'selected' : '' }} value="KE">Kenya</option>
												<option {{ $associate->pais_res == 'KI' ? 'selected' : '' }} value="KI">Kiribati</option>
												<option {{ $associate->pais_res == 'KW' ? 'selected' : '' }} value="KW">Kuwait</option>
												<option {{ $associate->pais_res == 'KG' ? 'selected' : '' }} value="KG">Kyrgyzstan</option>
												<option {{ $associate->pais_res == 'LA' ? 'selected' : '' }} value="LA">Laos</option>
												<option {{ $associate->pais_res == '419' ? 'selected' : '' }} value="419">Latin America and the Caribbean</option>
												<option {{ $associate->pais_res == 'LV' ? 'selected' : '' }} value="LV">Latvia</option>
												<option {{ $associate->pais_res == 'LB' ? 'selected' : '' }} value="LB">Lebanon</option>
												<option {{ $associate->pais_res == 'LS' ? 'selected' : '' }} value="LS">Lesotho</option>
												<option {{ $associate->pais_res == 'LR' ? 'selected' : '' }} value="LR">Liberia</option>
												<option {{ $associate->pais_res == 'LY' ? 'selected' : '' }} value="LY">Libya</option>
												<option {{ $associate->pais_res == 'LI' ? 'selected' : '' }} value="LI">Liechtenstein</option>
												<option {{ $associate->pais_res == 'LT' ? 'selected' : '' }} value="LT">Lithuania</option>
												<option {{ $associate->pais_res == 'LU' ? 'selected' : '' }} value="LU">Luxembourg</option>
												<option {{ $associate->pais_res == 'MO' ? 'selected' : '' }} value="MO">Macau SAR China</option>
												<option {{ $associate->pais_res == 'MK' ? 'selected' : '' }} value="MK">Macedonia</option>
												<option {{ $associate->pais_res == 'MG' ? 'selected' : '' }} value="MG">Madagascar</option>
												<option {{ $associate->pais_res == 'MW' ? 'selected' : '' }} value="MW">Malawi</option>
												<option {{ $associate->pais_res == 'MY' ? 'selected' : '' }} value="MY">Malaysia</option>
												<option {{ $associate->pais_res == 'MV' ? 'selected' : '' }} value="MV">Maldives</option>
												<option {{ $associate->pais_res == 'ML' ? 'selected' : '' }} value="ML">Mali</option>
												<option {{ $associate->pais_res == 'MT' ? 'selected' : '' }} value="MT">Malta</option>
												<option {{ $associate->pais_res == 'MH' ? 'selected' : '' }} value="MH">Marshall Islands</option>
												<option {{ $associate->pais_res == 'MQ' ? 'selected' : '' }} value="MQ">Martinique</option>
												<option {{ $associate->pais_res == 'MR' ? 'selected' : '' }} value="MR">Mauritania</option>
												<option {{ $associate->pais_res == 'MU' ? 'selected' : '' }} value="MU">Mauritius</option>
												<option {{ $associate->pais_res == 'YT' ? 'selected' : '' }} value="YT">Mayotte</option>
												<option {{ $associate->pais_res == '44' ? 'selected' : '' }} value="44">Melanesia</option>
												<option {{ $associate->pais_res == 'MX' ? 'selected' : '' }} value="MX">Mexico</option>
												<option {{ $associate->pais_res == 'FM' ? 'selected' : '' }} value="FM">Micronesia</option>
												<option {{ $associate->pais_res == '47' ? 'selected' : '' }} value="47">Micronesian Region</option>
												<option {{ $associate->pais_res == '15' ? 'selected' : '' }} value="15">Middle Africa</option>
												<option {{ $associate->pais_res == 'MD' ? 'selected' : '' }} value="MD">Moldova</option>
												<option {{ $associate->pais_res == 'MC' ? 'selected' : '' }} value="MC">Monaco</option>
												<option {{ $associate->pais_res == 'MN' ? 'selected' : '' }} value="MN">Mongolia</option>
												<option {{ $associate->pais_res == 'ME' ? 'selected' : '' }} value="ME">Montenegro</option>
												<option {{ $associate->pais_res == 'MS' ? 'selected' : '' }} value="MS">Montserrat</option>
												<option {{ $associate->pais_res == 'MA' ? 'selected' : '' }} value="MA">Morocco</option>
												<option {{ $associate->pais_res == 'MZ' ? 'selected' : '' }} value="MZ">Mozambique</option>
												<option {{ $associate->pais_res == 'MM' ? 'selected' : '' }} value="MM">Myanmar [Burma]</option>
												<option {{ $associate->pais_res == 'NA' ? 'selected' : '' }} value="NA">Namibia</option>
												<option {{ $associate->pais_res == 'NR' ? 'selected' : '' }} value="NR">Nauru</option>
												<option {{ $associate->pais_res == 'NP' ? 'selected' : '' }} value="NP">Nepal</option>
												<option {{ $associate->pais_res == 'NL' ? 'selected' : '' }} value="NL">Netherlands</option>
												<option {{ $associate->pais_res == 'AN' ? 'selected' : '' }} value="AN">Netherlands Antilles</option>
												<option {{ $associate->pais_res == 'NC' ? 'selected' : '' }} value="NC">New Caledonia</option>
												<option {{ $associate->pais_res == 'NZ' ? 'selected' : '' }} value="NZ">New Zealand</option>
												<option {{ $associate->pais_res == 'NI' ? 'selected' : '' }} value="NI">Nicaragua</option>
												<option {{ $associate->pais_res == 'NE' ? 'selected' : '' }} value="NE">Niger</option>
												<option {{ $associate->pais_res == 'NG' ? 'selected' : '' }} value="NG">Nigeria</option>
												<option {{ $associate->pais_res == 'NU' ? 'selected' : '' }} value="NU">Niue</option>
												<option {{ $associate->pais_res == 'NF' ? 'selected' : '' }} value="NF">Norfolk Island</option>
												<option {{ $associate->pais_res == '13' ? 'selected' : '' }} value="13">Northern Africa</option>
												<option {{ $associate->pais_res == '17' ? 'selected' : '' }} value="17">Northern America</option>
												<option {{ $associate->pais_res == '154' ? 'selected' : '' }} value="154">Northern Europe</option>
												<option {{ $associate->pais_res == 'MP' ? 'selected' : '' }} value="MP">Northern Mariana Islands</option>
												<option {{ $associate->pais_res == 'KP' ? 'selected' : '' }} value="KP">North Korea</option>
												<option {{ $associate->pais_res == 'NO' ? 'selected' : '' }} value="NO">Norway</option>
												<option {{ $associate->pais_res == '0' ? 'selected' : '' }} value="0">Oceania</option>
												<option {{ $associate->pais_res == 'OM' ? 'selected' : '' }} value="OM">Oman</option>
												<option {{ $associate->pais_res == 'QO' ? 'selected' : '' }} value="QO">Outlying Oceania</option>
												<option {{ $associate->pais_res == 'PK' ? 'selected' : '' }} value="PK">Pakistan</option>
												<option {{ $associate->pais_res == 'PW' ? 'selected' : '' }} value="PW">Palau</option>
												<option {{ $associate->pais_res == 'PS' ? 'selected' : '' }} value="PS">Palestinian Territories</option>
												<option {{ $associate->pais_res == 'PA' ? 'selected' : '' }} value="PA">Panama</option>
												<option {{ $associate->pais_res == 'PG' ? 'selected' : '' }} value="PG">Papua New Guinea</option>
												<option {{ $associate->pais_res == 'PY' ? 'selected' : '' }} value="PY">Paraguay</option>
												<option {{ $associate->pais_res == 'PE' ? 'selected' : '' }} value="PE">Peru</option>
												<option {{ $associate->pais_res == 'PH' ? 'selected' : '' }} value="PH">Philippines</option>
												<option {{ $associate->pais_res == 'PN' ? 'selected' : '' }} value="PN">Pitcairn Islands</option>
												<option {{ $associate->pais_res == 'PL' ? 'selected' : '' }} value="PL">Poland</option>
												<option {{ $associate->pais_res == '49' ? 'selected' : '' }} value="49">Polynesia</option>
												<option {{ $associate->pais_res == 'PT' ? 'selected' : '' }} value="PT">Portugal</option>
												<option {{ $associate->pais_res == 'PR' ? 'selected' : '' }} value="PR">Puerto Rico</option>
												<option {{ $associate->pais_res == 'QA' ? 'selected' : '' }} value="QA">Qatar</option>
												<option {{ $associate->pais_res == 'RE' ? 'selected' : '' }} value="RE">Réunion</option>
												<option {{ $associate->pais_res == 'RO' ? 'selected' : '' }} value="RO">Romania</option>
												<option {{ $associate->pais_res == 'RU' ? 'selected' : '' }} value="RU">Russia</option>
												<option {{ $associate->pais_res == 'RW' ? 'selected' : '' }} value="RW">Rwanda</option>
												<option {{ $associate->pais_res == 'BL' ? 'selected' : '' }} value="BL">Saint Barthélemy</option>
												<option {{ $associate->pais_res == 'SH' ? 'selected' : '' }} value="SH">Saint Helena</option>
												<option {{ $associate->pais_res == 'KN' ? 'selected' : '' }} value="KN">Saint Kitts and Nevis</option>
												<option {{ $associate->pais_res == 'LC' ? 'selected' : '' }} value="LC">Saint Lucia</option>
												<option {{ $associate->pais_res == 'MF' ? 'selected' : '' }} value="MF">Saint Martin</option>
												<option {{ $associate->pais_res == 'PM' ? 'selected' : '' }} value="PM">Saint Pierre and Miquelon</option>
												<option {{ $associate->pais_res == 'VC' ? 'selected' : '' }} value="VC">Saint Vincent and the Grenadines</option>
												<option {{ $associate->pais_res == 'WS' ? 'selected' : '' }} value="WS">Samoa</option>
												<option {{ $associate->pais_res == 'SM' ? 'selected' : '' }} value="SM">San Marino</option>
												<option {{ $associate->pais_res == 'ST' ? 'selected' : '' }} value="ST">São Tomé and Príncipe</option>
												<option {{ $associate->pais_res == 'SA' ? 'selected' : '' }} value="SA">Saudi Arabia</option>
												<option {{ $associate->pais_res == 'SN' ? 'selected' : '' }} value="SN">Senegal</option>
												<option {{ $associate->pais_res == 'RS' ? 'selected' : '' }} value="RS">Serbia</option>
												<option {{ $associate->pais_res == 'CS' ? 'selected' : '' }} value="CS">Serbia and Montenegro</option>
												<option {{ $associate->pais_res == 'SC' ? 'selected' : '' }} value="SC">Seychelles</option>
												<option {{ $associate->pais_res == 'SL' ? 'selected' : '' }} value="SL">Sierra Leone</option>
												<option {{ $associate->pais_res == 'SG' ? 'selected' : '' }} value="SG">Singapore</option>
												<option {{ $associate->pais_res == 'SK' ? 'selected' : '' }} value="SK">Slovakia</option>
												<option {{ $associate->pais_res == 'SI' ? 'selected' : '' }} value="SI">Slovenia</option>
												<option {{ $associate->pais_res == 'SB' ? 'selected' : '' }} value="SB">Solomon Islands</option>
												<option {{ $associate->pais_res == 'SO' ? 'selected' : '' }} value="SO">Somalia</option>
												<option {{ $associate->pais_res == 'ZA' ? 'selected' : '' }} value="ZA">South Africa</option>
												<option {{ $associate->pais_res == '5' ? 'selected' : '' }} value="5">South America</option>
												<option {{ $associate->pais_res == '50' ? 'selected' : '' }} value="50">South-Central Asia</option>
												<option {{ $associate->pais_res == '29' ? 'selected' : '' }} value="29">South-Eastern Asia</option>
												<option {{ $associate->pais_res == '28' ? 'selected' : '' }} value="28">Southern Asia</option>
												<option {{ $associate->pais_res == '3' ? 'selected' : '' }} value="3">Southern Europe</option>
												<option {{ $associate->pais_res == 'GS' ? 'selected' : '' }} value="GS">South Georgia and the South Sandwich Islands</option>
												<option {{ $associate->pais_res == 'KR' ? 'selected' : '' }} value="KR">South Korea</option>
												<option {{ $associate->pais_res == 'ES' ? 'selected' : '' }} value="ES">Spain</option>
												<option {{ $associate->pais_res == 'LK' ? 'selected' : '' }} value="LK">Sri Lanka</option>
												<option {{ $associate->pais_res == 'SD' ? 'selected' : '' }} value="SD">Sudan</option>
												<option {{ $associate->pais_res == 'SR' ? 'selected' : '' }} value="SR">Suriname</option>
												<option {{ $associate->pais_res == 'SJ' ? 'selected' : '' }} value="SJ">Svalbard and Jan Mayen</option>
												<option {{ $associate->pais_res == 'SZ' ? 'selected' : '' }} value="SZ">Swaziland</option>
												<option {{ $associate->pais_res == 'SE' ? 'selected' : '' }} value="SE">Sweden</option>
												<option {{ $associate->pais_res == 'CH' ? 'selected' : '' }} value="CH">Switzerland</option>
												<option {{ $associate->pais_res == 'SY' ? 'selected' : '' }} value="SY">Syria</option>
												<option {{ $associate->pais_res == 'TW' ? 'selected' : '' }} value="TW">Taiwan</option>
												<option {{ $associate->pais_res == 'TJ' ? 'selected' : '' }} value="TJ">Tajikistan</option>
												<option {{ $associate->pais_res == 'TZ' ? 'selected' : '' }} value="TZ">Tanzania</option>
												<option {{ $associate->pais_res == 'TH' ? 'selected' : '' }} value="TH">Thailand</option>
												<option {{ $associate->pais_res == 'TL' ? 'selected' : '' }} value="TL">Timor-Leste</option>
												<option {{ $associate->pais_res == 'TG' ? 'selected' : '' }} value="TG">Togo</option>
												<option {{ $associate->pais_res == 'TK' ? 'selected' : '' }} value="TK">Tokelau</option>
												<option {{ $associate->pais_res == 'TO' ? 'selected' : '' }} value="TO">Tonga</option>
												<option {{ $associate->pais_res == 'TT' ? 'selected' : '' }} value="TT">Trinidad and Tobago</option>
												<option {{ $associate->pais_res == 'TN' ? 'selected' : '' }} value="TN">Tunisia</option>
												<option {{ $associate->pais_res == 'TR' ? 'selected' : '' }} value="TR">Turkey</option>
												<option {{ $associate->pais_res == 'TM' ? 'selected' : '' }} value="TM">Turkmenistan</option>
												<option {{ $associate->pais_res == 'TC' ? 'selected' : '' }} value="TC">Turks and Caicos Islands</option>
												<option {{ $associate->pais_res == 'TV' ? 'selected' : '' }} value="TV">Tuvalu</option>
												<option {{ $associate->pais_res == 'UG' ? 'selected' : '' }} value="UG">Uganda</option>
												<option {{ $associate->pais_res == 'UA' ? 'selected' : '' }} value="UA">Ukraine</option>
												<option {{ $associate->pais_res == 'AE' ? 'selected' : '' }} value="AE">United Arab Emirates</option>
												<option {{ $associate->pais_res == 'GB' ? 'selected' : '' }} value="GB">United Kingdom</option>
												<option {{ $associate->pais_res == 'US' ? 'selected' : '' }} value="US">United States</option>
												<option {{ $associate->pais_res == 'ZZ' ? 'selected' : '' }} value="ZZ">Unknown or Invalid Region</option>
												<option {{ $associate->pais_res == 'UY' ? 'selected' : '' }} value="UY">Uruguay</option>
												<option {{ $associate->pais_res == 'UM' ? 'selected' : '' }} value="UM">U.S. Minor Outlying Islands</option>
												<option {{ $associate->pais_res == 'VI' ? 'selected' : '' }} value="VI">U.S. Virgin Islands</option>
												<option {{ $associate->pais_res == 'UZ' ? 'selected' : '' }} value="UZ">Uzbekistan</option>
												<option {{ $associate->pais_res == 'VU' ? 'selected' : '' }} value="VU">Vanuatu</option>
												<option {{ $associate->pais_res == 'VA' ? 'selected' : '' }} value="VA">Vatican City</option>
												<option {{ $associate->pais_res == 'VE' ? 'selected' : '' }} value="VE">Venezuela</option>
												<option {{ $associate->pais_res == 'VN' ? 'selected' : '' }} value="VN">Vietnam</option>
												<option {{ $associate->pais_res == 'WF' ? 'selected' : '' }} value="WF">Wallis and Futuna</option>
												<option {{ $associate->pais_res == '9' ? 'selected' : '' }} value="9">Western Africa</option>
												<option {{ $associate->pais_res == '145' ? 'selected' : '' }} value="145">Western Asia</option>
												<option {{ $associate->pais_res == '155' ? 'selected' : '' }} value="155">Western Europe</option>
												<option {{ $associate->pais_res == 'EH' ? 'selected' : '' }} value="EH">Western Sahara</option>
												<option {{ $associate->pais_res == 'YE' ? 'selected' : '' }} value="YE">Yemen</option>
												<option {{ $associate->pais_res == 'ZM' ? 'selected' : '' }} value="ZM">Zambia</option>
												<option {{ $associate->pais_res == 'ZW' ? 'selected' : '' }} value="ZW">Zimbabwe</option>
											</select>
                                        </span>
                                    </p>
                                    <p>
                                        <label>Tipo de Logradouro:</label>
                                        <span class="field">
                                            @if (isset($logradouros))
                                                <select class="chosen-select" name="logradouro_res">
                                                    @foreach ($logradouros as $logradouro)
                                                        <option value="{{$logradouro->id_logradouro}}" {{ $associate->logradouro_res == $logradouro->id_logradouro ? 'selected' : '' }}>{{$logradouro->nombre}}</option>
                                                    @endforeach
                                                </select>
                                            @endif
                                        </span>
                                    </p>
                                    <p>
                                        <label>Endereço</label>
                                        <span class="field"><input type="text" name="dir_res" id="dir_res" class="input-xxlarge" value="{{$associate->dir_res}}" /></span>
                                    </p>
                                    <p>
                                        <label>Bairro</label>
                                        <span class="field"><input type="text" name="bairro_res" id="bairro_res" class="input-xxlarge" value="{{$associate->bairro_res}}" /></span>
                                    </p>
                                    <p>
                                        <label>Localidade</label>
                                        <span class="field"><input type="text" name="ciudad_internacional_res" id="ciudad_internacional_res" class="input-xxlarge" value="{{ $associate->ciudad_internacional_res }}"/></span>
                                    </p>
                                    <p>
                                        <label>Telefone</label>
                                        <span class="field"><input type="text" name="ddd_res" id="ddd_res" class="input-small" value="{{ $associate->ddd_res }}" /><input type="text" name="ddi_res" id="ddi_res" class="input-small" value="{{ $associate->ddi_res }}" /><input type="text" name="telefone_res" id="telefone_res" class="input-xlarge" value="{{ $associate->telefone_res }}" /></span>
                                    </p>
                                    <p>
                                        <label>Telefone 2</label>
                                        <span class="field"><input type="text" name="ddd_two_res" id="ddd_two_res" class="input-small" value="{{ $associate->ddd_two_res }}" /><input type="text" name="ddi_two_res" id="ddi_two_res" class="input-small" value="{{ $associate->ddi_two_res }}" /><input type="text" name="telefone_seg_res" id="telefone_seg_res" class="input-xlarge" value="{{ $associate->telefone_seg_res }}" /></span>
                                    </p>
                                    <p>
                                        <label>Celular</label>
                                        <span class="field"><input type="text" name="ddd_cel_res" id="ddd_cel_res" class="input-small" value="{{ $associate->ddd_cel_res }}" /><input type="text" name="ddi_cel_res" id="ddi_cel_res" class="input-small" value="{{ $associate->ddi_cel_res }}" /><input type="text" name="celular_res" id="celular_res" class="input-xlarge" value="{{ $associate->celular_res }}" /></span>
                                    </p>                                                          
                                </div>
                                <div id="wiz1step3" class="formwiz">
                                    <h4 class="widgettitle">Passo 3: Endereços Comercial</h4>
                                    
                                    <p>
                                        <label>CEP</label>
                                        <span class="field"><input type="text" name="cep_com" id="cep_com" class="input-xxlarge" value="{{$associate->cep_com}}" /></span>
                                    </p>
                                    <p>
                                        <label>Número</label>
                                        <span class="field"><input type="text" name="numero_com" id="numero_com" class="input-xxlarge" value="{{ $associate->numero_com }}" /></span>
                                    </p>
                                    <p>
                                        <label>Complemento</label>
                                        <span class="field"><input type="text" name="complemento_com" id="complemento_com" class="input-xxlarge" value="{{ $associate->complemento_com }}" /></span>
                                    </p>
                                    <p>
                                        <label>Tipo de Logradouro:</label>
                                        <span class="field">
                                            @if (isset($logradouros))
                                                <select class="chosen-select" name="logradouro_com">
                                                    @foreach ($logradouros as $logradouro)
                                                        <option value="{{$logradouro->id_logradouro}}" {{$associate->logradouro_com == $logradouro->id ? 'selected' : '' }}>{{$logradouro->nombre}}</option>
                                                    @endforeach
                                                </select>
                                            @endif
                                        </span>
                                    </p>
                                    <p>
                                        <label>Pais</label>
                                        <span class="field">
                                            <select name="pais_com" id="asociados_pais_com">
                                                <option {{ $associate->pais_com == '0' ? 'selected' : '' }} value="0">Selecione o País</option>
                                                <option {{ $associate->pais_com == 'AF' ? 'selected' : '' }} value="AF">Afghanistan</option>
                                                <option {{ $associate->pais_com == 'AX' ? 'selected' : '' }} value="AX">Åland Islands</option>
                                                <option {{ $associate->pais_com == 'AL' ? 'selected' : '' }} value="AL">Albania</option>
                                                <option {{ $associate->pais_com == 'DZ' ? 'selected' : '' }} value="DZ">Algeria</option>
                                                <option {{ $associate->pais_com == 'AS' ? 'selected' : '' }} value="AS">American Samoa</option>
                                                <option {{ $associate->pais_com == '1' ? 'selected' : '' }} value="1">Americas</option>
                                                <option {{ $associate->pais_com == 'AD' ? 'selected' : '' }} value="AD">Andorra</option>
                                                <option {{ $associate->pais_com == 'AO' ? 'selected' : '' }} value="AO">Angola</option>
                                                <option {{ $associate->pais_com == 'AI' ? 'selected' : '' }} value="AI">Anguilla</option>
                                                <option {{ $associate->pais_com == 'AQ' ? 'selected' : '' }} value="AQ">Antarctica</option>
                                                <option {{ $associate->pais_com == 'AG' ? 'selected' : '' }} value="AG">Antigua and Barbuda</option>
                                                <option {{ $associate->pais_com == 'AR' ? 'selected' : '' }} value="AR">Argentina</option>
                                                <option {{ $associate->pais_com == 'AM' ? 'selected' : '' }} value="AM">Armenia</option>
                                                <option {{ $associate->pais_com == 'AW' ? 'selected' : '' }} value="AW">Aruba</option>
                                                <option {{ $associate->pais_com == '142' ? 'selected' : '' }} value="142">Asia</option>
                                                <option {{ $associate->pais_com == 'AU' ? 'selected' : '' }} value="AU">Australia</option>
                                                <option {{ $associate->pais_com == '43' ? 'selected' : '' }} value="43">Australia and New Zealand</option>
                                                <option {{ $associate->pais_com == 'AT' ? 'selected' : '' }} value="AT">Austria</option>
                                                <option {{ $associate->pais_com == 'AZ' ? 'selected' : '' }} value="AZ">Azerbaijan</option>
                                                <option {{ $associate->pais_com == 'BS' ? 'selected' : '' }} value="BS">Bahamas</option>
                                                <option {{ $associate->pais_com == 'BH' ? 'selected' : '' }} value="BH">Bahrain</option>
                                                <option {{ $associate->pais_com == 'BD' ? 'selected' : '' }} value="BD">Bangladesh</option>
                                                <option {{ $associate->pais_com == 'BB' ? 'selected' : '' }} value="BB">Barbados</option>
                                                <option {{ $associate->pais_com == 'BY' ? 'selected' : '' }} value="BY">Belarus</option>
                                                <option {{ $associate->pais_com == 'BE' ? 'selected' : '' }} value="BE">Belgium</option>
                                                <option {{ $associate->pais_com == 'BZ' ? 'selected' : '' }} value="BZ">Belize</option>
                                                <option {{ $associate->pais_com == 'BJ' ? 'selected' : '' }} value="BJ">Benin</option>
                                                <option {{ $associate->pais_com == 'BM' ? 'selected' : '' }} value="BM">Bermuda</option>
                                                <option {{ $associate->pais_com == 'BT' ? 'selected' : '' }} value="BT">Bhutan</option>
                                                <option {{ $associate->pais_com == 'BO' ? 'selected' : '' }} value="BO">Bolivia</option>
                                                <option {{ $associate->pais_com == 'BA' ? 'selected' : '' }} value="BA">Bosnia and Herzegovina</option>
                                                <option {{ $associate->pais_com == 'BW' ? 'selected' : '' }} value="BW">Botswana</option>
                                                <option {{ $associate->pais_com == 'BV' ? 'selected' : '' }} value="BV">Bouvet Island</option>
                                                <option {{ $associate->pais_com == 'BR' ? 'selected' : '' }} value="BR">Brazil</option>
                                                <option {{ $associate->pais_com == 'IO' ? 'selected' : '' }} value="IO">British Indian Ocean Territory</option>
                                                <option {{ $associate->pais_com == 'VG' ? 'selected' : '' }} value="VG">British Virgin Islands</option>
                                                <option {{ $associate->pais_com == 'BN' ? 'selected' : '' }} value="BN">Brunei</option>
                                                <option {{ $associate->pais_com == 'BG' ? 'selected' : '' }} value="BG">Bulgaria</option>
                                                <option {{ $associate->pais_com == 'BF' ? 'selected' : '' }} value="BF">Burkina Faso</option>
                                                <option {{ $associate->pais_com == 'BI' ? 'selected' : '' }} value="BI">Burundi</option>
                                                <option {{ $associate->pais_com == 'KH' ? 'selected' : '' }} value="KH">Cambodia</option>
                                                <option {{ $associate->pais_com == 'CM' ? 'selected' : '' }} value="CM">Cameroon</option>
                                                <option {{ $associate->pais_com == 'CA' ? 'selected' : '' }} value="CA">Canada</option>
                                                <option {{ $associate->pais_com == 'CV' ? 'selected' : '' }} value="CV">Cape Verde</option>
                                                <option {{ $associate->pais_com == '2' ? 'selected' : '' }} value="2">Caribbean</option>
                                                <option {{ $associate->pais_com == 'KY' ? 'selected' : '' }} value="KY">Cayman Islands</option>
                                                <option {{ $associate->pais_com == 'CF' ? 'selected' : '' }} value="CF">Central African Republic</option>
                                                <option {{ $associate->pais_com == '11' ? 'selected' : '' }} value="11">Central America</option>
                                                <option {{ $associate->pais_com == '143' ? 'selected' : '' }} value="143">Central Asia</option>
                                                <option {{ $associate->pais_com == 'TD' ? 'selected' : '' }} value="TD">Chad</option>
                                                <option {{ $associate->pais_com == '830' ? 'selected' : '' }} value="830">Channel Islands</option>
                                                <option {{ $associate->pais_com == 'CL' ? 'selected' : '' }} value="CL">Chile</option>
                                                <option {{ $associate->pais_com == 'CN' ? 'selected' : '' }} value="CN">China</option>
                                                <option {{ $associate->pais_com == 'CX' ? 'selected' : '' }} value="CX">Christmas Island</option>
                                                <option {{ $associate->pais_com == 'CC' ? 'selected' : '' }} value="CC">Cocos [Keeling] Islands</option>
                                                <option {{ $associate->pais_com == 'CO' ? 'selected' : '' }} value="CO">Colombia</option>
                                                <option {{ $associate->pais_com == '172' ? 'selected' : '' }} value="172">Commonwealth of Independent States</option>
                                                <option {{ $associate->pais_com == 'KM' ? 'selected' : '' }} value="KM">Comoros</option>
                                                <option {{ $associate->pais_com == 'CG' ? 'selected' : '' }} value="CG">Congo - Brazzaville</option>
                                                <option {{ $associate->pais_com == 'CD' ? 'selected' : '' }} value="CD">Congo - Kinshasa</option>
                                                <option {{ $associate->pais_com == 'CK' ? 'selected' : '' }} value="CK">Cook Islands</option>
                                                <option {{ $associate->pais_com == 'CR' ? 'selected' : '' }} value="CR">Costa Rica</option>
                                                <option {{ $associate->pais_com == 'CI' ? 'selected' : '' }} value="CI">Côte d’Ivoire</option>
                                                <option {{ $associate->pais_com == 'HR' ? 'selected' : '' }} value="HR">Croatia</option>
                                                <option {{ $associate->pais_com == 'CU' ? 'selected' : '' }} value="CU">Cuba</option>
                                                <option {{ $associate->pais_com == 'CY' ? 'selected' : '' }} value="CY">Cyprus</option>
                                                <option {{ $associate->pais_com == '200' ? 'selected' : '' }} value="200">Czechoslovakia</option>
                                                <option {{ $associate->pais_com == 'CZ' ? 'selected' : '' }} value="CZ">Czech Republic</option>
                                                <option {{ $associate->pais_com == 'DK' ? 'selected' : '' }} value="DK">Denmark</option>
                                                <option {{ $associate->pais_com == 'DJ' ? 'selected' : '' }} value="DJ">Djibouti</option>
                                                <option {{ $associate->pais_com == 'DM' ? 'selected' : '' }} value="DM">Dominica</option>
                                                <option {{ $associate->pais_com == 'DO' ? 'selected' : '' }} value="DO">Dominican Republic</option>
                                                <option {{ $associate->pais_com == '12' ? 'selected' : '' }} value="12">Eastern Africa</option>
                                                <option {{ $associate->pais_com == '24' ? 'selected' : '' }} value="24">Eastern Asia</option>
                                                <option {{ $associate->pais_com == '151' ? 'selected' : '' }} value="151">Eastern Europe</option>
                                                <option {{ $associate->pais_com == 'EC' ? 'selected' : '' }} value="EC">Ecuador</option>
                                                <option {{ $associate->pais_com == 'EG' ? 'selected' : '' }} value="EG">Egypt</option>
                                                <option {{ $associate->pais_com == 'SV' ? 'selected' : '' }} value="SV">El Salvador</option>
                                                <option {{ $associate->pais_com == 'GQ' ? 'selected' : '' }} value="GQ">Equatorial Guinea</option>
                                                <option {{ $associate->pais_com == 'ER' ? 'selected' : '' }} value="ER">Eritrea</option>
                                                <option {{ $associate->pais_com == 'EE' ? 'selected' : '' }} value="EE">Estonia</option>
                                                <option {{ $associate->pais_com == 'ET' ? 'selected' : '' }} value="ET">Ethiopia</option>
                                                <option {{ $associate->pais_com == '150' ? 'selected' : '' }} value="150">Europe</option>
                                                <option {{ $associate->pais_com == 'QU' ? 'selected' : '' }} value="QU">European Union</option>
                                                <option {{ $associate->pais_com == 'FK' ? 'selected' : '' }} value="FK">Falkland Islands</option>
                                                <option {{ $associate->pais_com == 'FO' ? 'selected' : '' }} value="FO">Faroe Islands</option>
                                                <option {{ $associate->pais_com == 'FJ' ? 'selected' : '' }} value="FJ">Fiji</option>
                                                <option {{ $associate->pais_com == 'FI' ? 'selected' : '' }} value="FI">Finland</option>
                                                <option {{ $associate->pais_com == 'FR' ? 'selected' : '' }} value="FR">France</option>
                                                <option {{ $associate->pais_com == 'GF' ? 'selected' : '' }} value="GF">French Guiana</option>
                                                <option {{ $associate->pais_com == 'PF' ? 'selected' : '' }} value="PF">French Polynesia</option>
                                                <option {{ $associate->pais_com == 'TF' ? 'selected' : '' }} value="TF">French Southern Territories</option>
                                                <option {{ $associate->pais_com == 'GA' ? 'selected' : '' }} value="GA">Gabon</option>
                                                <option {{ $associate->pais_com == 'GM' ? 'selected' : '' }} value="GM">Gambia</option>
                                                <option {{ $associate->pais_com == 'GE' ? 'selected' : '' }} value="GE">Georgia</option>
                                                <option {{ $associate->pais_com == 'DE' ? 'selected' : '' }} value="DE">Germany</option>
                                                <option {{ $associate->pais_com == 'GH' ? 'selected' : '' }} value="GH">Ghana</option>
                                                <option {{ $associate->pais_com == 'GI' ? 'selected' : '' }} value="GI">Gibraltar</option>
                                                <option {{ $associate->pais_com == 'GR' ? 'selected' : '' }} value="GR">Greece</option>
                                                <option {{ $associate->pais_com == 'GL' ? 'selected' : '' }} value="GL">Greenland</option>
                                                <option {{ $associate->pais_com == 'GD' ? 'selected' : '' }} value="GD">Grenada</option>
                                                <option {{ $associate->pais_com == 'GP' ? 'selected' : '' }} value="GP">Guadeloupe</option>
                                                <option {{ $associate->pais_com == 'GU' ? 'selected' : '' }} value="GU">Guam</option>
                                                <option {{ $associate->pais_com == 'GT' ? 'selected' : '' }} value="GT">Guatemala</option>
                                                <option {{ $associate->pais_com == 'GG' ? 'selected' : '' }} value="GG">Guernsey</option>
                                                <option {{ $associate->pais_com == 'GN' ? 'selected' : '' }} value="GN">Guinea</option>
                                                <option {{ $associate->pais_com == 'GW' ? 'selected' : '' }} value="GW">Guinea-Bissau</option>
                                                <option {{ $associate->pais_com == 'GY' ? 'selected' : '' }} value="GY">Guyana</option>
                                                <option {{ $associate->pais_com == 'HT' ? 'selected' : '' }} value="HT">Haiti</option>
                                                <option {{ $associate->pais_com == 'HM' ? 'selected' : '' }} value="HM">Heard Island and McDonald Islands</option>
                                                <option {{ $associate->pais_com == 'HN' ? 'selected' : '' }} value="HN">Honduras</option>
                                                <option {{ $associate->pais_com == 'HK' ? 'selected' : '' }} value="HK">Hong Kong SAR China</option>
                                                <option {{ $associate->pais_com == 'HU' ? 'selected' : '' }} value="HU">Hungary</option>
                                                <option {{ $associate->pais_com == 'IS' ? 'selected' : '' }} value="IS">Iceland</option>
                                                <option {{ $associate->pais_com == 'IN' ? 'selected' : '' }} value="IN">India</option>
                                                <option {{ $associate->pais_com == 'ID' ? 'selected' : '' }} value="ID">Indonesia</option>
                                                <option {{ $associate->pais_com == 'IR' ? 'selected' : '' }} value="IR">Iran</option>
                                                <option {{ $associate->pais_com == 'IQ' ? 'selected' : '' }} value="IQ">Iraq</option>
                                                <option {{ $associate->pais_com == 'IE' ? 'selected' : '' }} value="IE">Ireland</option>
                                                <option {{ $associate->pais_com == 'IM' ? 'selected' : '' }} value="IM">Isle of Man</option>
                                                <option {{ $associate->pais_com == 'IL' ? 'selected' : '' }} value="IL">Israel</option>
                                                <option {{ $associate->pais_com == 'IT' ? 'selected' : '' }} value="IT">Italy</option>
                                                <option {{ $associate->pais_com == 'JM' ? 'selected' : '' }} value="JM">Jamaica</option>
                                                <option {{ $associate->pais_com == 'JP' ? 'selected' : '' }} value="JP">Japan</option>
                                                <option {{ $associate->pais_com == 'JE' ? 'selected' : '' }} value="JE">Jersey</option>
                                                <option {{ $associate->pais_com == 'JO' ? 'selected' : '' }} value="JO">Jordan</option>
                                                <option {{ $associate->pais_com == 'KZ' ? 'selected' : '' }} value="KZ">Kazakhstan</option>
                                                <option {{ $associate->pais_com == 'KE' ? 'selected' : '' }} value="KE">Kenya</option>
                                                <option {{ $associate->pais_com == 'KI' ? 'selected' : '' }} value="KI">Kiribati</option>
                                                <option {{ $associate->pais_com == 'KW' ? 'selected' : '' }} value="KW">Kuwait</option>
                                                <option {{ $associate->pais_com == 'KG' ? 'selected' : '' }} value="KG">Kyrgyzstan</option>
                                                <option {{ $associate->pais_com == 'LA' ? 'selected' : '' }} value="LA">Laos</option>
                                                <option {{ $associate->pais_com == '419' ? 'selected' : '' }} value="419">Latin America and the Caribbean</option>
                                                <option {{ $associate->pais_com == 'LV' ? 'selected' : '' }} value="LV">Latvia</option>
                                                <option {{ $associate->pais_com == 'LB' ? 'selected' : '' }} value="LB">Lebanon</option>
                                                <option {{ $associate->pais_com == 'LS' ? 'selected' : '' }} value="LS">Lesotho</option>
                                                <option {{ $associate->pais_com == 'LR' ? 'selected' : '' }} value="LR">Liberia</option>
                                                <option {{ $associate->pais_com == 'LY' ? 'selected' : '' }} value="LY">Libya</option>
                                                <option {{ $associate->pais_com == 'LI' ? 'selected' : '' }} value="LI">Liechtenstein</option>
                                                <option {{ $associate->pais_com == 'LT' ? 'selected' : '' }} value="LT">Lithuania</option>
                                                <option {{ $associate->pais_com == 'LU' ? 'selected' : '' }} value="LU">Luxembourg</option>
                                                <option {{ $associate->pais_com == 'MO' ? 'selected' : '' }} value="MO">Macau SAR China</option>
                                                <option {{ $associate->pais_com == 'MK' ? 'selected' : '' }} value="MK">Macedonia</option>
                                                <option {{ $associate->pais_com == 'MG' ? 'selected' : '' }} value="MG">Madagascar</option>
                                                <option {{ $associate->pais_com == 'MW' ? 'selected' : '' }} value="MW">Malawi</option>
                                                <option {{ $associate->pais_com == 'MY' ? 'selected' : '' }} value="MY">Malaysia</option>
                                                <option {{ $associate->pais_com == 'MV' ? 'selected' : '' }} value="MV">Maldives</option>
                                                <option {{ $associate->pais_com == 'ML' ? 'selected' : '' }} value="ML">Mali</option>
                                                <option {{ $associate->pais_com == 'MT' ? 'selected' : '' }} value="MT">Malta</option>
                                                <option {{ $associate->pais_com == 'MH' ? 'selected' : '' }} value="MH">Marshall Islands</option>
                                                <option {{ $associate->pais_com == 'MQ' ? 'selected' : '' }} value="MQ">Martinique</option>
                                                <option {{ $associate->pais_com == 'MR' ? 'selected' : '' }} value="MR">Mauritania</option>
                                                <option {{ $associate->pais_com == 'MU' ? 'selected' : '' }} value="MU">Mauritius</option>
                                                <option {{ $associate->pais_com == 'YT' ? 'selected' : '' }} value="YT">Mayotte</option>
                                                <option {{ $associate->pais_com == '44' ? 'selected' : '' }} value="44">Melanesia</option>
                                                <option {{ $associate->pais_com == 'MX' ? 'selected' : '' }} value="MX">Mexico</option>
                                                <option {{ $associate->pais_com == 'FM' ? 'selected' : '' }} value="FM">Micronesia</option>
                                                <option {{ $associate->pais_com == '47' ? 'selected' : '' }} value="47">Micronesian Region</option>
                                                <option {{ $associate->pais_com == '15' ? 'selected' : '' }} value="15">Middle Africa</option>
                                                <option {{ $associate->pais_com == 'MD' ? 'selected' : '' }} value="MD">Moldova</option>
                                                <option {{ $associate->pais_com == 'MC' ? 'selected' : '' }} value="MC">Monaco</option>
                                                <option {{ $associate->pais_com == 'MN' ? 'selected' : '' }} value="MN">Mongolia</option>
                                                <option {{ $associate->pais_com == 'ME' ? 'selected' : '' }} value="ME">Montenegro</option>
                                                <option {{ $associate->pais_com == 'MS' ? 'selected' : '' }} value="MS">Montserrat</option>
                                                <option {{ $associate->pais_com == 'MA' ? 'selected' : '' }} value="MA">Morocco</option>
                                                <option {{ $associate->pais_com == 'MZ' ? 'selected' : '' }} value="MZ">Mozambique</option>
                                                <option {{ $associate->pais_com == 'MM' ? 'selected' : '' }} value="MM">Myanmar [Burma]</option>
                                                <option {{ $associate->pais_com == 'NA' ? 'selected' : '' }} value="NA">Namibia</option>
                                                <option {{ $associate->pais_com == 'NR' ? 'selected' : '' }} value="NR">Nauru</option>
                                                <option {{ $associate->pais_com == 'NP' ? 'selected' : '' }} value="NP">Nepal</option>
                                                <option {{ $associate->pais_com == 'NL' ? 'selected' : '' }} value="NL">Netherlands</option>
                                                <option {{ $associate->pais_com == 'AN' ? 'selected' : '' }} value="AN">Netherlands Antilles</option>
                                                <option {{ $associate->pais_com == 'NC' ? 'selected' : '' }} value="NC">New Caledonia</option>
                                                <option {{ $associate->pais_com == 'NZ' ? 'selected' : '' }} value="NZ">New Zealand</option>
                                                <option {{ $associate->pais_com == 'NI' ? 'selected' : '' }} value="NI">Nicaragua</option>
                                                <option {{ $associate->pais_com == 'NE' ? 'selected' : '' }} value="NE">Niger</option>
                                                <option {{ $associate->pais_com == 'NG' ? 'selected' : '' }} value="NG">Nigeria</option>
                                                <option {{ $associate->pais_com == 'NU' ? 'selected' : '' }} value="NU">Niue</option>
                                                <option {{ $associate->pais_com == 'NF' ? 'selected' : '' }} value="NF">Norfolk Island</option>
                                                <option {{ $associate->pais_com == '13' ? 'selected' : '' }} value="13">Northern Africa</option>
                                                <option {{ $associate->pais_com == '17' ? 'selected' : '' }} value="17">Northern America</option>
                                                <option {{ $associate->pais_com == '154' ? 'selected' : '' }} value="154">Northern Europe</option>
                                                <option {{ $associate->pais_com == 'MP' ? 'selected' : '' }} value="MP">Northern Mariana Islands</option>
                                                <option {{ $associate->pais_com == 'KP' ? 'selected' : '' }} value="KP">North Korea</option>
                                                <option {{ $associate->pais_com == 'NO' ? 'selected' : '' }} value="NO">Norway</option>
                                                <option {{ $associate->pais_com == '0' ? 'selected' : '' }} value="0">Oceania</option>
                                                <option {{ $associate->pais_com == 'OM' ? 'selected' : '' }} value="OM">Oman</option>
                                                <option {{ $associate->pais_com == 'QO' ? 'selected' : '' }} value="QO">Outlying Oceania</option>
                                                <option {{ $associate->pais_com == 'PK' ? 'selected' : '' }} value="PK">Pakistan</option>
                                                <option {{ $associate->pais_com == 'PW' ? 'selected' : '' }} value="PW">Palau</option>
                                                <option {{ $associate->pais_com == 'PS' ? 'selected' : '' }} value="PS">Palestinian Territories</option>
                                                <option {{ $associate->pais_com == 'PA' ? 'selected' : '' }} value="PA">Panama</option>
                                                <option {{ $associate->pais_com == 'PG' ? 'selected' : '' }} value="PG">Papua New Guinea</option>
                                                <option {{ $associate->pais_com == 'PY' ? 'selected' : '' }} value="PY">Paraguay</option>
                                                <option {{ $associate->pais_com == 'PE' ? 'selected' : '' }} value="PE">Peru</option>
                                                <option {{ $associate->pais_com == 'PH' ? 'selected' : '' }} value="PH">Philippines</option>
                                                <option {{ $associate->pais_com == 'PN' ? 'selected' : '' }} value="PN">Pitcairn Islands</option>
                                                <option {{ $associate->pais_com == 'PL' ? 'selected' : '' }} value="PL">Poland</option>
                                                <option {{ $associate->pais_com == '49' ? 'selected' : '' }} value="49">Polynesia</option>
                                                <option {{ $associate->pais_com == 'PT' ? 'selected' : '' }} value="PT">Portugal</option>
                                                <option {{ $associate->pais_com == 'PR' ? 'selected' : '' }} value="PR">Puerto Rico</option>
                                                <option {{ $associate->pais_com == 'QA' ? 'selected' : '' }} value="QA">Qatar</option>
                                                <option {{ $associate->pais_com == 'RE' ? 'selected' : '' }} value="RE">Réunion</option>
                                                <option {{ $associate->pais_com == 'RO' ? 'selected' : '' }} value="RO">Romania</option>
                                                <option {{ $associate->pais_com == 'RU' ? 'selected' : '' }} value="RU">Russia</option>
                                                <option {{ $associate->pais_com == 'RW' ? 'selected' : '' }} value="RW">Rwanda</option>
                                                <option {{ $associate->pais_com == 'BL' ? 'selected' : '' }} value="BL">Saint Barthélemy</option>
                                                <option {{ $associate->pais_com == 'SH' ? 'selected' : '' }} value="SH">Saint Helena</option>
                                                <option {{ $associate->pais_com == 'KN' ? 'selected' : '' }} value="KN">Saint Kitts and Nevis</option>
                                                <option {{ $associate->pais_com == 'LC' ? 'selected' : '' }} value="LC">Saint Lucia</option>
                                                <option {{ $associate->pais_com == 'MF' ? 'selected' : '' }} value="MF">Saint Martin</option>
                                                <option {{ $associate->pais_com == 'PM' ? 'selected' : '' }} value="PM">Saint Pierre and Miquelon</option>
                                                <option {{ $associate->pais_com == 'VC' ? 'selected' : '' }} value="VC">Saint Vincent and the Grenadines</option>
                                                <option {{ $associate->pais_com == 'WS' ? 'selected' : '' }} value="WS">Samoa</option>
                                                <option {{ $associate->pais_com == 'SM' ? 'selected' : '' }} value="SM">San Marino</option>
                                                <option {{ $associate->pais_com == 'ST' ? 'selected' : '' }} value="ST">São Tomé and Príncipe</option>
                                                <option {{ $associate->pais_com == 'SA' ? 'selected' : '' }} value="SA">Saudi Arabia</option>
                                                <option {{ $associate->pais_com == 'SN' ? 'selected' : '' }} value="SN">Senegal</option>
                                                <option {{ $associate->pais_com == 'RS' ? 'selected' : '' }} value="RS">Serbia</option>
                                                <option {{ $associate->pais_com == 'CS' ? 'selected' : '' }} value="CS">Serbia and Montenegro</option>
                                                <option {{ $associate->pais_com == 'SC' ? 'selected' : '' }} value="SC">Seychelles</option>
                                                <option {{ $associate->pais_com == 'SL' ? 'selected' : '' }} value="SL">Sierra Leone</option>
                                                <option {{ $associate->pais_com == 'SG' ? 'selected' : '' }} value="SG">Singapore</option>
                                                <option {{ $associate->pais_com == 'SK' ? 'selected' : '' }} value="SK">Slovakia</option>
                                                <option {{ $associate->pais_com == 'SI' ? 'selected' : '' }} value="SI">Slovenia</option>
                                                <option {{ $associate->pais_com == 'SB' ? 'selected' : '' }} value="SB">Solomon Islands</option>
                                                <option {{ $associate->pais_com == 'SO' ? 'selected' : '' }} value="SO">Somalia</option>
                                                <option {{ $associate->pais_com == 'ZA' ? 'selected' : '' }} value="ZA">South Africa</option>
                                                <option {{ $associate->pais_com == '5' ? 'selected' : '' }} value="5">South America</option>
                                                <option {{ $associate->pais_com == '50' ? 'selected' : '' }} value="50">South-Central Asia</option>
                                                <option {{ $associate->pais_com == '29' ? 'selected' : '' }} value="29">South-Eastern Asia</option>
                                                <option {{ $associate->pais_com == '28' ? 'selected' : '' }} value="28">Southern Asia</option>
                                                <option {{ $associate->pais_com == '3' ? 'selected' : '' }} value="3">Southern Europe</option>
                                                <option {{ $associate->pais_com == 'GS' ? 'selected' : '' }} value="GS">South Georgia and the South Sandwich Islands</option>
                                                <option {{ $associate->pais_com == 'KR' ? 'selected' : '' }} value="KR">South Korea</option>
                                                <option {{ $associate->pais_com == 'ES' ? 'selected' : '' }} value="ES">Spain</option>
                                                <option {{ $associate->pais_com == 'LK' ? 'selected' : '' }} value="LK">Sri Lanka</option>
                                                <option {{ $associate->pais_com == 'SD' ? 'selected' : '' }} value="SD">Sudan</option>
                                                <option {{ $associate->pais_com == 'SR' ? 'selected' : '' }} value="SR">Suriname</option>
                                                <option {{ $associate->pais_com == 'SJ' ? 'selected' : '' }} value="SJ">Svalbard and Jan Mayen</option>
                                                <option {{ $associate->pais_com == 'SZ' ? 'selected' : '' }} value="SZ">Swaziland</option>
                                                <option {{ $associate->pais_com == 'SE' ? 'selected' : '' }} value="SE">Sweden</option>
                                                <option {{ $associate->pais_com == 'CH' ? 'selected' : '' }} value="CH">Switzerland</option>
                                                <option {{ $associate->pais_com == 'SY' ? 'selected' : '' }} value="SY">Syria</option>
                                                <option {{ $associate->pais_com == 'TW' ? 'selected' : '' }} value="TW">Taiwan</option>
                                                <option {{ $associate->pais_com == 'TJ' ? 'selected' : '' }} value="TJ">Tajikistan</option>
                                                <option {{ $associate->pais_com == 'TZ' ? 'selected' : '' }} value="TZ">Tanzania</option>
                                                <option {{ $associate->pais_com == 'TH' ? 'selected' : '' }} value="TH">Thailand</option>
                                                <option {{ $associate->pais_com == 'TL' ? 'selected' : '' }} value="TL">Timor-Leste</option>
                                                <option {{ $associate->pais_com == 'TG' ? 'selected' : '' }} value="TG">Togo</option>
                                                <option {{ $associate->pais_com == 'TK' ? 'selected' : '' }} value="TK">Tokelau</option>
                                                <option {{ $associate->pais_com == 'TO' ? 'selected' : '' }} value="TO">Tonga</option>
                                                <option {{ $associate->pais_com == 'TT' ? 'selected' : '' }} value="TT">Trinidad and Tobago</option>
                                                <option {{ $associate->pais_com == 'TN' ? 'selected' : '' }} value="TN">Tunisia</option>
                                                <option {{ $associate->pais_com == 'TR' ? 'selected' : '' }} value="TR">Turkey</option>
                                                <option {{ $associate->pais_com == 'TM' ? 'selected' : '' }} value="TM">Turkmenistan</option>
                                                <option {{ $associate->pais_com == 'TC' ? 'selected' : '' }} value="TC">Turks and Caicos Islands</option>
                                                <option {{ $associate->pais_com == 'TV' ? 'selected' : '' }} value="TV">Tuvalu</option>
                                                <option {{ $associate->pais_com == 'UG' ? 'selected' : '' }} value="UG">Uganda</option>
                                                <option {{ $associate->pais_com == 'UA' ? 'selected' : '' }} value="UA">Ukraine</option>
                                                <option {{ $associate->pais_com == 'AE' ? 'selected' : '' }} value="AE">United Arab Emirates</option>
                                                <option {{ $associate->pais_com == 'GB' ? 'selected' : '' }} value="GB">United Kingdom</option>
                                                <option {{ $associate->pais_com == 'US' ? 'selected' : '' }} value="US">United States</option>
                                                <option {{ $associate->pais_com == 'ZZ' ? 'selected' : '' }} value="ZZ">Unknown or Invalid Region</option>
                                                <option {{ $associate->pais_com == 'UY' ? 'selected' : '' }} value="UY">Uruguay</option>
                                                <option {{ $associate->pais_com == 'UM' ? 'selected' : '' }} value="UM">U.S. Minor Outlying Islands</option>
                                                <option {{ $associate->pais_com == 'VI' ? 'selected' : '' }} value="VI">U.S. Virgin Islands</option>
                                                <option {{ $associate->pais_com == 'UZ' ? 'selected' : '' }} value="UZ">Uzbekistan</option>
                                                <option {{ $associate->pais_com == 'VU' ? 'selected' : '' }} value="VU">Vanuatu</option>
                                                <option {{ $associate->pais_com == 'VA' ? 'selected' : '' }} value="VA">Vatican City</option>
                                                <option {{ $associate->pais_com == 'VE' ? 'selected' : '' }} value="VE">Venezuela</option>
                                                <option {{ $associate->pais_com == 'VN' ? 'selected' : '' }} value="VN">Vietnam</option>
                                                <option {{ $associate->pais_com == 'WF' ? 'selected' : '' }} value="WF">Wallis and Futuna</option>
                                                <option {{ $associate->pais_com == '9' ? 'selected' : '' }} value="9">Western Africa</option>
                                                <option {{ $associate->pais_com == '145' ? 'selected' : '' }} value="145">Western Asia</option>
                                                <option {{ $associate->pais_com == '155' ? 'selected' : '' }} value="155">Western Europe</option>
                                                <option {{ $associate->pais_com == 'EH' ? 'selected' : '' }} value="EH">Western Sahara</option>
                                                <option {{ $associate->pais_com == 'YE' ? 'selected' : '' }} value="YE">Yemen</option>
                                                <option {{ $associate->pais_com == 'ZM' ? 'selected' : '' }} value="ZM">Zambia</option>
                                                <option {{ $associate->pais_com == 'ZW' ? 'selected' : '' }} value="ZW">Zimbabwe</option>
                                            </select>
                                        </span>
                                    </p>
                                    <p>
                                        <label>Endereço</label>
                                        <span class="field"><input type="text" name="dir_com" id="dir_com" class="input-xxlarge" value="{{ $associate->dir_com }}" /></span>
                                    </p>
                                    <p>
                                        <label>Bairro</label>
                                        <span class="field"><input type="text" name="bairro_com" id="bairro_com" class="input-xxlarge" value="{{ $associate->bairro_com }}" /></span>
                                    </p>
                                    <p>
                                        <label>Localidade</label>
                                        <span class="field"><input type="text" name="ciudad_internacional_com" id="ciudad_internacional_com" class="input-xxlarge" value="{{ $associate->ciudad_internacional_com }}"/></span>
                                    </p>
                                    <p>
                                        <label>Telefone</label>
                                        <span class="field"><input type="text" name="ddd_com" id="ddd_com" class="input-small" value="{{$associate->ddd_com}}" /><input type="text" name="ddi_com" id="ddi_com" class="input-small" value="{{$associate->ddi_com}}" /><input type="text" name="telefone_com" id="telefone_com" class="input-xlarge" value="{{$associate->telefone_com}}" /></span>
                                    </p>
                                    <p>
                                        <label>Telefone 2</label>
                                        <span class="field"><input type="text" name="ddd_two_com" id="ddd_two_com" class="input-small" value="{{$associate->ddd_two_com}}" /><input type="text" name="ddi_two_com" id="ddi_two_com" class="input-small" value="{{$associate->ddi_two_com}}" /><input type="text" name="telefone_seg_com" id="telefone_seg_com" class="input-xlarge" value="{{$associate->telefone_seg_com}}" /></span>
                                    </p>
                                    <p>
                                        <label>Celular</label>
                                        <span class="field"><input type="text" name="ddd_cel_com" id="ddd_cel_com" class="input-small" value="{{$associate->ddd_cel_com}}" /><input type="text" name="ddi_cel_com" id="ddi_cel_com" class="input-small" value="{{$associate->ddi_cel_com}}" /><input type="text" name="celular_com" id="celular_com" class="input-xlarge" value="{{$associate->celular_com}}" /></span>
                                    </p>                                                          
                                </div>
                                <div id="wiz1step4" class="formwiz">
                                    <h4 class="widgettitle">Passo 4: Matrícula</h4>
                                    
                                    <p>
                                        <label>Data Cadastro</label>
                                        <span class="field">{{ date('d-m-Y', strtotime($associate->data_cadastro)) }}</span>
                                    </p>
                                    <p>
                                        <label>Cód. Matrícula</label>
                                        <span class="field">{{ $associate->codigo_matricula == '' || $associate->codigo_matricula == null ? 'Nenhum dado' : $associate->codigo_matricula }}</span>
                                    </p>
                                    <p>
                                        <label>Estado</label>
                                        <span class="field">{{ $associate->estado_matricula == '' || $associate->estado_matricula == null ? 'Nenhum dado' : $associate->estado_matricula }}</span>
                                    </p>                                                         
                                </div>
                                <div id="wiz1step5" class="formwiz"> 

                                    <h4 class="widgettitle">Passo 5: Dados Acadêmicos</h4>
                                    @foreach($associate->academics as $academic)
                                        <!-- 
                                        <fieldset>
                                            <legend></legend>
                                            <p>
                                                <label>Tipo de graduação</label>
                                                <span class="field">
                                                    <select name="tipo_graduacion" id="asociados_datos_academicos_tipo_graduacion">
                                                        <option value="0" {{ $academic->tipo_graduacion == '0' ? 'selected' : '' }}>DOUTORADO</option>
                                                        <option value="1" {{ $academic->tipo_graduacion == '1' ? 'selected' : '' }}>ESPECIALIZAÇÃO</option>
                                                        <option value="2" {{ $academic->tipo_graduacion == '2' ? 'selected' : '' }}>GRADUAÇÃO</option>
                                                        <option value="3" {{ $academic->tipo_graduacion == '3' ? 'selected' : '' }}>MESTRADO</option>
                                                        <option value="4" {{ $academic->tipo_graduacion == '4' ? 'selected' : '' }}>PÓS-GRADUAÇÃO</option>
                                                    </select>
                                                </span>
                                            </p>
                                            <p>
                                                <label>Instituição:</label>
                                                <span class="field"><input type="text" name="institucion" id="institucion" class="input-xxlarge" value="{{ $academic->institucion }}"/></span>
                                            </p>
                                            <p>
                                                <label>Faculdade:</label>
                                                <span class="field"><input type="text" name="facultad" id="facultad" class="input-xxlarge" value="{{ $academic->facultad }}"/></span>
                                            </p>
                                            <p>
                                                <label>Formação:</label>
                                                <span class="field">
                                                    @if (isset($formacoes))
                                                        <select class="chosen-select" name="curso_realizado">
                                                            @foreach ($formacoes as $formacao)
                                                                <option value="{{$formacao->id}}" {{ $academic->curso_realizado == $formacao->id ? 'selected' : '' }}>{{$formacao->nome}}</option>
                                                            @endforeach
                                                        </select>
                                                    @endif
                                                </span>
                                            </p>
                                            <p>
                                                <label>Ano de início</label>
                                                <span class="field"><input type="text" name="ano_inicio" id="ano_inicio" class="input-xxlarge" value="{{ $academic->ano_inicio }}"/></span>
                                            </p>
                                            <p>
                                                <label>Ano de finalização</label>
                                                <span class="field"><input type="text" name="ano_finalizacion" id="ano_finalizacion" class="input-xxlarge" value="{{ $academic->ano_finalizacion }}" /></span>
                                            </p> 
                                        </fieldset> 
                                        -->
                                        <div id="escolaridade_{{$academic->id_datos_acad}}" style="margin-left: 5em;display:inline-block">
                                            <p>
                                                <b>Tipo de graduação:</b> 
                                                <span id="tipo_graduacion_{{$academic->id_datos_acad}}">
                                                    {{ $academic->tipo_graduacion == 0 ? 'DOUTORADO' : ''}}
                                                    {{ $academic->tipo_graduacion == 1 ? 'ESPECIALIZAÇÃO' : ''}}
                                                    {{ $academic->tipo_graduacion == 2 ? 'GRADUAÇÃO' : ''}}
                                                    {{ $academic->tipo_graduacion == 3 ? 'MESTRADO' : ''}}
                                                    {{ $academic->tipo_graduacion == 4 ? 'PÓS-GRADUAÇÃO' : ''}}
                                                </span>
                                            </p>
                                            <p>
                                                <b>Instituição:</b> 
                                                <span id="institucion_{{ $academic->id_datos_acad }}">
                                                    {{ $academic->institucion }}
                                                </span>
                                            </p>
                                            <p>
                                                <b>Faculdade:</b> 
                                                <span id="facultad_{{ $academic->id_datos_acad }}">
                                                    {{ $academic->facultad }}
                                                </span>
                                            </p>
                                            <p>
                                                <b>Formação:</b> 
                                                <span id="curso_realizado_{{$academic->id_datos_acad}}">
                                                    @foreach( $formacoes as $formacao )
                                                         @if($academic->curso_realizado == $formacao->id )
                                                            {{ $formacao->nome }}
                                                         @endif
                                                    @endforeach
                                                </span>
                                            </p>
                                            <p>
                                                <b>Ano de início:</b> 
                                                <span id="ano_inicio_{{$academic->id_datos_acad}}">
                                                    {{ $academic->ano_inicio }}
                                                </span>
                                            </p>
                                            <p>
                                                <b>Ano de finalização:</b> 
                                                <span id="ano_finalizacion_{{$academic->id_datos_acad}}">
                                                    {{ $academic->ano_finalizacion }}
                                                </span>
                                            </p>
                                            <p>
                                                <span>
                                                    <a href="/ajax/atualizarescolaridade/{{ $academic->id_datos_acad }}" class="fancybox fancybox.ajax btn" id="adicionar_escolaridade" >Atualizar</a>
                                                    <a href="/ajax/deletarescolaridade/{{ $academic->id_datos_acad }}" class="fancybox fancybox.ajax btn" id="adicionar_escolaridade" >Deletar</a>
                                                </span>
                                            </p>
                                        </div>
                                    @endforeach  
                                    <p id="adicionarbutton" style="margin-bottom:10px" class="right"><label><a href="/ajax/adicionarescolaridade/{{ $associate->id_asociado}}" class="fancybox fancybox.ajax btn" id="adicionar_escolaridade" >Adicionar Escolaridade</a></label></p> 
                                </div>
                                                                               
                                <div id="wiz1step6" class="formwiz">
                                    <h4 class="widgettitle">Passo 6: Área de Atuação - Curriculum</h4>
                                    <p>
                                        <label>Área de Atuação</label>
                                        <span class="field">
											<select style="width: 215px; margin-left: 2px;" onchange="mostrar_otras()" name="area_de_especializacion" id="asociados_area_de_especializacion">
												<option {{ $associate->area_especializacion == '0' ? 'selected' : '' }} value="0">Outras</option>
												<option {{ $associate->area_especializacion == '1' ? 'selected' : '' }} value="1">Obra Civil</option>
												<option {{ $associate->area_especializacion == '2' ? 'selected' : '' }} value="2">Irrigação</option>
												<option {{ $associate->area_especializacion == '3' ? 'selected' : '' }} value="3">Mineração</option>
												<option {{ $associate->area_especializacion == '4' ? 'selected' : '' }} value="4">Projeto / Consultoria</option>
												<option {{ $associate->area_especializacion == '5' ? 'selected' : '' }} value="5">Planejamento Urbano</option>
												<option {{ $associate->area_especializacion == '6' ? 'selected' : '' }} value="6">Gestão Ambiental</option>
												<option {{ $associate->area_especializacion == '7' ? 'selected' : '' }} value="7">Hidrogeologia</option>
												<option {{ $associate->area_especializacion == '8' ? 'selected' : '' }} value="8">Fundações / Serviços Geotécnicos</option>
												<option {{ $associate->area_especializacion == '9' ? 'selected' : '' }} value="9" selected="selected">Geofísica</option>
												<option {{ $associate->area_especializacion == '10' ? 'selected' : '' }} value="10">Ensino / Pesquisa</option>
												<option {{ $associate->area_especializacion == '11' ? 'selected' : '' }} value="11">Gerenciamento de Empreendimentos</option>
											</select>
                                        </span>
                                    </p>    
                                    <p>
                                        <label>Mini CV</label>
                                        <script language=JavaScript>
                                          <!--

                                          function countCharacters(){
                                            console.log("load");
                                            var textarea = document.getElementById('classificados_conteudo');
                                            var characters = document.getElementById('characters');
                                            characters.innerHTML = (textarea.value.length);
                                          }

                                          function check_length()
                                            {
                                              var textarea = document.getElementById('classificados_conteudo');
                                              var characters = document.getElementById('characters');
                                              console.log(textarea.value);
                                              maxLen = 500; // max number of characters allowed
                                              if (textarea.value.length > maxLen) {
                                                // Alert message if maximum limit is reached. 
                                                // If required Alert can be removed. 
                                                var msg = "Você atingiu seu limite máximo de caracteres permitido";
                                                alert(msg);
                                                // Reached the Maximum length so trim the textarea
                                                textarea.value = textarea.value.substring(0, maxLen);
                                               }
                                              else{ // Maximum length not reached so update the value of my_text counter
                                                characters.innerHTML = maxLen - textarea.value.length;
                                                }
                                              }
                                            //-->
                                        </script>
                                        <span>
                                            <textarea name="classificados_conteudo" id="classificados_conteudo" style="width:60%;height:150px" onkeypress="check_length(this.form);" onkeydown="check_length(this.form)">{{ $associate->classificados_conteudo }}</textarea>
                                            <em style="display:inline-block;" id="characters" onload="countCharacters();">500</em><em> Caracteres de 500</em>                                                     
                                        </span>
                                    </p>  

                                    <p>
                                        <label>Imagem</label>
                                        <img src="http://abge.org.br/uploads/classificados/{{$associate->classificados_imagem}}">
                                    </p>                                                     
                                    <p>
                                        <label>Publicar Curriculum</label>
                                        <span>
                                            <input name="classificados_view" type="radio" value="1" id="asociados_classificados_view_1" {{$associate->classificados_view === "1" ? 'checked="checked"' : ''}}>&nbsp;<span for="asociados_classificados_view_1">Sim</span> <br>
                                            <input name="classificados_view" type="radio" value="0" id="asociados_classificados_view_0" {{$associate->classificados_view === "0" ? 'checked="checked"' : ''}}>&nbsp;<span for="asociados_classificados_view_0">Não</span>
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </form>
                </div>

                <script type="text/javascript">
                jQuery(document).on('ready', function(){
                    console.log('Ready');
                    var formacao_form = false;
                    var id_associado = {{ $associate->id_asociado }};
                    jQuery('#adicionar_escolaridade').fancybox();
                });
                </script>

@stop