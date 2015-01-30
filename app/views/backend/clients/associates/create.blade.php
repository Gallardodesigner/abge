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

 -->
{{HTML::script("assetsadmin/js/tiny_mce/jquery.tinymce.min.js")}}
{{HTML::script("assetsadmin/js/tiny_mce/tinymce.js")}}

{{HTML::script("assetsadmin/js/wysiwyg.js")}}
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
                                            <span class="label">End. Residencial</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#wiz1step3">
                                            <span class="h2">Passo 3</span>
                                            <span class="label">End. Comercial</span>
                                        </a>
                                    </li>  
                                    <li>
                                        <a href="#wiz1step4">
                                            <span class="h2">Passo 4</span>
                                            <span class="label">Dados Acadêmicos</span>
                                        </a>
                                    </li>  
                                    <li>
                                        <a href="#wiz1step5">
                                            <span class="h2">Passo 5</span>
                                            <span class="label">Área de Atuação</span>
                                        </a>
                                    </li>  
                                </ul>

                                <div id="wiz1step1" class="formwiz">
                                	<h4 class="widgettitle">Passo 1: Dados Pessoais</h4>
                                    <p>
                                        <label>Nome Completo</label>
                                        <span class="field"><input type="text" name="nombre_completo" id="nombre_completo" class="input-xxlarge" /></span>
                                    </p>
                                    <p>
                                        <label>Email</label>
                                        <span class="field"><input type="email" name="email" id="email" class="input-xxlarge" /></span>
                                    </p>
                                    <p>
                                        <label>Edo civil</label>
                                        <span class="field">
                                            <select name="edo_civil" id="asociados_edo_civil">
                                                <option value="1">Solteiro(a)</option>
                                                <option value="2">Casado(a)</option>
                                                <option value="3">Divorciado(a)</option>
                                                <option value="4">Viudo(a)</option>
                                            </select>
                                        </span>
                                    </p>
                                    <p>
                                        <label>Passaporte</label>
                                        <span class="field"><input type="text" name="passaporte" id="passaporte" class="input-xxlarge" /></span>
                                    </p>
                                    <p>
                                        <label>Instituição</label>
                                        <span class="field"><input type="text" name="institucion" id="institucion" class="input-xxlarge" /></span>
                                    </p>
                                    <p>
                                        <label>Empresa</label>
                                        <span class="field"><input type="text" name="empresa" id="empresa" class="input-xxlarge" /></span>
                                    </p>
                                    <p>
                                        <label>RG</label>
                                        <span class="field"><input type="text" name="rg" id="rg" class="input-xxlarge" /></span>
                                    </p>
                                    <p>
                                        <label>Correspondência</label>
                                        <span class="field">
                                            <select style="width:100px;" name="tipo_correspondencia" id="asociados_tipo_correspondencia">
                                                <option value="c" selected="selected">Comercial</option>
                                                <option value="r">Residencial</option>
                                            </select>
                                        </span>
                                    </p> 
                                    <p>
                                        <label>Data de nascimento</label>
                                        <span class="field"><input type="text" name="data_nascimento" id="data_nascimento" class="input-xxlarge" /></span>
                                    </p>
                                    <p>
                                        <label>Sexo</label>
                                        <span class="field">
                                            <select name="sexo" id="sexo">
                                                <option value="1">Masculino</option>
                                                <option value="2">Feminino</option>
                                            </select>
                                        </span>
                                    </p>
                                    <p>
                                        <label>Senha</label>
                                        <span class="field"><input type="password" name="senha" id="senha" class="input-xxlarge" /></span>
                                    </p>
                                    <p>
                                        <label>Web site</label>
                                        <span class="field"><input type="text" name="web_site" id="web_site" class="input-xxlarge" /></span>
                                    </p>
                                    <p>
                                        <label>Categoria profissional</label>
                                        <span class="field">
                                            @if (isset($categorias))
                                                <select class="chosen-select" name="categoria">
                                                    @foreach ($categorias as $categoria)
                                                        <option value="{{$categoria->id_categoria_asociado}}">{{$categoria->nombre_categoria}}</option>
                                                    @endforeach
                                                </select>
                                            @endif
                                        </span>
                                    </p> 
                                    <p>
                                        <label>Cargo</label>
                                        <span class="field"><input type="text" name="cargo" id="cargo" class="input-xxlarge" /></span>
                                    </p>
                                    <p>
                                        <label>CPF</label>
                                        <span class="field"><input type="text" name="cpf" id="cpf" class="input-xxlarge" required/> &nbsp;&nbsp; <em>Só números</em></span>
                                    </p>
                                
                                    <!-- <p>
                                        <label>Status do Associado</label>
                                        <span class="field">
                                            <select class="chosen-select" name="status_asso">
                                                <option value="0">Desabilitado</option>
                                                <option value="1">Habilitado</option>
                                            </select>
                                        </span>
                                    </p>
                                    <p>
                                        <label>Estado matricula</label>
                                        <span class="field">
                                            @if (isset($estados))
                                                <select class="chosen-select" name="estado_matricula" >
                                                                                        @foreach ($estados as $estado)
                                                                                            <option value="{{$estado->id_estado}}">{{$estado->name_estado}}</option>
                                                                                        @endforeach
                                                </select>
                                            @endif
                                        </span>
                                    </p>                                
                                    <p>
                                        <label>Código da Matrícula</label>
                                        <span class="field"><input type="text" name="codigo_matricula" id="codigo_matricula" class="input-xxlarge" /></span>
                                    </p> 
                                    <p>
                                        <label>Tipo pessoa</label>
                                        <span class="field">
                                            <select class="chosen-select" name="tipo_pessoa">
                                                <option value="" selected="selected">Selecione Tipo de Pessoa</option>
                                                <option value="F">Pessoa Física</option>
                                                <option value="J">Pessoa Jurídica</option>
                                            </select>
                                        </span>
                                    </p>
                                    <p>
                                        <label>Formação</label>
                                        <span class="field">
                                            @if (isset($formacaos))
                                                <select class="chosen-select" name="formacao">
                                                                                        @foreach ($formacaos as $formacao)
                                                                                            <option value="{{$formacao->id}}">{{$formacao->nome}}</option>
                                                                                        @endforeach
                                                </select>
                                            @endif
                                        </span>
                                    </p>
                                    <p>
                                        <label>Data cadastro</label>
                                        <span class="field"><input type="text" name="data_cadastro" id="data_cadastro" class="input-xxlarge" /></span>
                                    </p> -->
                                </div>
                                <div id="wiz1step2" class="formwiz">
                                    <h4 class="widgettitle">Passo 2: Endereços Residencial</h4>
                                    
                                    <p>
                                        <label>CEP</label>
                                        <span class="field"><input type="text" name="cep_res" id="cep_res" class="input-xxlarge" /></span>
                                    </p>
                                    <p>
                                        <label>Número</label>
                                        <span class="field"><input type="text" name="numero_res" id="numero_res" class="input-xxlarge" /></span>
                                    </p>
                                    <p>
                                        <label>Complemento</label>
                                        <span class="field"><input type="text" name="complemento_res" id="complemento_res" class="input-xxlarge" /></span>
                                    </p>
                                    <p>
                                        <label>Pais</label>
                                        <span class="field">
                                            <select name="pais_res" id="asociados_pais_res"><option value="0">Selecione o País</option>
                                                <option value="AF">Afghanistan</option>
                                                <option value="AX">Åland Islands</option>
                                                <option value="AL">Albania</option>
                                                <option value="DZ">Algeria</option>
                                                <option value="AS">American Samoa</option>
                                                <option value="1">Americas</option>
                                                <option value="AD">Andorra</option>
                                                <option value="AO">Angola</option>
                                                <option value="AI">Anguilla</option>
                                                <option value="AQ">Antarctica</option>
                                                <option value="AG">Antigua and Barbuda</option>
                                                <option value="AR">Argentina</option>
                                                <option value="AM">Armenia</option>
                                                <option value="AW">Aruba</option>
                                                <option value="142">Asia</option>
                                                <option value="AU">Australia</option>
                                                <option value="43">Australia and New Zealand</option>
                                                <option value="AT">Austria</option>
                                                <option value="AZ">Azerbaijan</option>
                                                <option value="BS">Bahamas</option>
                                                <option value="BH">Bahrain</option>
                                                <option value="BD">Bangladesh</option>
                                                <option value="BB">Barbados</option>
                                                <option value="BY">Belarus</option>
                                                <option value="BE">Belgium</option>
                                                <option value="BZ">Belize</option>
                                                <option value="BJ">Benin</option>
                                                <option value="BM">Bermuda</option>
                                                <option value="BT">Bhutan</option>
                                                <option value="BO">Bolivia</option>
                                                <option value="BA">Bosnia and Herzegovina</option>
                                                <option value="BW">Botswana</option>
                                                <option value="BV">Bouvet Island</option>
                                                <option value="BR">Brazil</option>
                                                <option value="IO">British Indian Ocean Territory</option>
                                                <option value="VG">British Virgin Islands</option>
                                                <option value="BN">Brunei</option>
                                                <option value="BG">Bulgaria</option>
                                                <option value="BF">Burkina Faso</option>
                                                <option value="BI">Burundi</option>
                                                <option value="KH">Cambodia</option>
                                                <option value="CM">Cameroon</option>
                                                <option value="CA">Canada</option>
                                                <option value="CV">Cape Verde</option>
                                                <option value="2">Caribbean</option>
                                                <option value="KY">Cayman Islands</option>
                                                <option value="CF">Central African Republic</option>
                                                <option value="11">Central America</option>
                                                <option value="143">Central Asia</option>
                                                <option value="TD">Chad</option>
                                                <option value="830">Channel Islands</option>
                                                <option value="CL">Chile</option>
                                                <option value="CN">China</option>
                                                <option value="CX">Christmas Island</option>
                                                <option value="CC">Cocos [Keeling] Islands</option>
                                                <option value="CO">Colombia</option>
                                                <option value="172">Commonwealth of Independent States</option>
                                                <option value="KM">Comoros</option>
                                                <option value="CG">Congo - Brazzaville</option>
                                                <option value="CD">Congo - Kinshasa</option>
                                                <option value="CK">Cook Islands</option>
                                                <option value="CR">Costa Rica</option>
                                                <option value="CI">Côte d’Ivoire</option>
                                                <option value="HR">Croatia</option>
                                                <option value="CU">Cuba</option>
                                                <option value="CY">Cyprus</option>
                                                <option value="200">Czechoslovakia</option>
                                                <option value="CZ">Czech Republic</option>
                                                <option value="DK">Denmark</option>
                                                <option value="DJ">Djibouti</option>
                                                <option value="DM">Dominica</option>
                                                <option value="DO">Dominican Republic</option>
                                                <option value="12">Eastern Africa</option>
                                                <option value="24">Eastern Asia</option>
                                                <option value="151">Eastern Europe</option>
                                                <option value="EC">Ecuador</option>
                                                <option value="EG">Egypt</option>
                                                <option value="SV">El Salvador</option>
                                                <option value="GQ">Equatorial Guinea</option>
                                                <option value="ER">Eritrea</option>
                                                <option value="EE">Estonia</option>
                                                <option value="ET">Ethiopia</option>
                                                <option value="150">Europe</option>
                                                <option value="QU">European Union</option>
                                                <option value="FK">Falkland Islands</option>
                                                <option value="FO">Faroe Islands</option>
                                                <option value="FJ">Fiji</option>
                                                <option value="FI">Finland</option>
                                                <option value="FR">France</option>
                                                <option value="GF">French Guiana</option>
                                                <option value="PF">French Polynesia</option>
                                                <option value="TF">French Southern Territories</option>
                                                <option value="GA">Gabon</option>
                                                <option value="GM">Gambia</option>
                                                <option value="GE">Georgia</option>
                                                <option value="DE">Germany</option>
                                                <option value="GH">Ghana</option>
                                                <option value="GI">Gibraltar</option>
                                                <option value="GR">Greece</option>
                                                <option value="GL">Greenland</option>
                                                <option value="GD">Grenada</option>
                                                <option value="GP">Guadeloupe</option>
                                                <option value="GU">Guam</option>
                                                <option value="GT">Guatemala</option>
                                                <option value="GG">Guernsey</option>
                                                <option value="GN">Guinea</option>
                                                <option value="GW">Guinea-Bissau</option>
                                                <option value="GY">Guyana</option>
                                                <option value="HT">Haiti</option>
                                                <option value="HM">Heard Island and McDonald Islands</option>
                                                <option value="HN">Honduras</option>
                                                <option value="HK">Hong Kong SAR China</option>
                                                <option value="HU">Hungary</option>
                                                <option value="IS">Iceland</option>
                                                <option value="IN">India</option>
                                                <option value="ID">Indonesia</option>
                                                <option value="IR">Iran</option>
                                                <option value="IQ">Iraq</option>
                                                <option value="IE">Ireland</option>
                                                <option value="IM">Isle of Man</option>
                                                <option value="IL">Israel</option>
                                                <option value="IT">Italy</option>
                                                <option value="JM">Jamaica</option>
                                                <option value="JP">Japan</option>
                                                <option value="JE">Jersey</option>
                                                <option value="JO">Jordan</option>
                                                <option value="KZ">Kazakhstan</option>
                                                <option value="KE">Kenya</option>
                                                <option value="KI">Kiribati</option>
                                                <option value="KW">Kuwait</option>
                                                <option value="KG">Kyrgyzstan</option>
                                                <option value="LA">Laos</option>
                                                <option value="419">Latin America and the Caribbean</option>
                                                <option value="LV">Latvia</option>
                                                <option value="LB">Lebanon</option>
                                                <option value="LS">Lesotho</option>
                                                <option value="LR">Liberia</option>
                                                <option value="LY">Libya</option>
                                                <option value="LI">Liechtenstein</option>
                                                <option value="LT">Lithuania</option>
                                                <option value="LU">Luxembourg</option>
                                                <option value="MO">Macau SAR China</option>
                                                <option value="MK">Macedonia</option>
                                                <option value="MG">Madagascar</option>
                                                <option value="MW">Malawi</option>
                                                <option value="MY">Malaysia</option>
                                                <option value="MV">Maldives</option>
                                                <option value="ML">Mali</option>
                                                <option value="MT">Malta</option>
                                                <option value="MH">Marshall Islands</option>
                                                <option value="MQ">Martinique</option>
                                                <option value="MR">Mauritania</option>
                                                <option value="MU">Mauritius</option>
                                                <option value="YT">Mayotte</option>
                                                <option value="44">Melanesia</option>
                                                <option value="MX">Mexico</option>
                                                <option value="FM">Micronesia</option>
                                                <option value="47">Micronesian Region</option>
                                                <option value="15">Middle Africa</option>
                                                <option value="MD">Moldova</option>
                                                <option value="MC">Monaco</option>
                                                <option value="MN">Mongolia</option>
                                                <option value="ME">Montenegro</option>
                                                <option value="MS">Montserrat</option>
                                                <option value="MA">Morocco</option>
                                                <option value="MZ">Mozambique</option>
                                                <option value="MM">Myanmar [Burma]</option>
                                                <option value="NA">Namibia</option>
                                                <option value="NR">Nauru</option>
                                                <option value="NP">Nepal</option>
                                                <option value="NL">Netherlands</option>
                                                <option value="AN">Netherlands Antilles</option>
                                                <option value="NC">New Caledonia</option>
                                                <option value="NZ">New Zealand</option>
                                                <option value="NI">Nicaragua</option>
                                                <option value="NE">Niger</option>
                                                <option value="NG">Nigeria</option>
                                                <option value="NU">Niue</option>
                                                <option value="NF">Norfolk Island</option>
                                                <option value="13">Northern Africa</option>
                                                <option value="17">Northern America</option>
                                                <option value="154">Northern Europe</option>
                                                <option value="MP">Northern Mariana Islands</option>
                                                <option value="KP">North Korea</option>
                                                <option value="NO">Norway</option>
                                                <option value="0">Oceania</option>
                                                <option value="OM">Oman</option>
                                                <option value="QO">Outlying Oceania</option>
                                                <option value="PK">Pakistan</option>
                                                <option value="PW">Palau</option>
                                                <option value="PS">Palestinian Territories</option>
                                                <option value="PA">Panama</option>
                                                <option value="PG">Papua New Guinea</option>
                                                <option value="PY">Paraguay</option>
                                                <option value="PE">Peru</option>
                                                <option value="PH">Philippines</option>
                                                <option value="PN">Pitcairn Islands</option>
                                                <option value="PL">Poland</option>
                                                <option value="49">Polynesia</option>
                                                <option value="PT">Portugal</option>
                                                <option value="PR">Puerto Rico</option>
                                                <option value="QA">Qatar</option>
                                                <option value="RE">Réunion</option>
                                                <option value="RO">Romania</option>
                                                <option value="RU">Russia</option>
                                                <option value="RW">Rwanda</option>
                                                <option value="BL">Saint Barthélemy</option>
                                                <option value="SH">Saint Helena</option>
                                                <option value="KN">Saint Kitts and Nevis</option>
                                                <option value="LC">Saint Lucia</option>
                                                <option value="MF">Saint Martin</option>
                                                <option value="PM">Saint Pierre and Miquelon</option>
                                                <option value="VC">Saint Vincent and the Grenadines</option>
                                                <option value="WS">Samoa</option>
                                                <option value="SM">San Marino</option>
                                                <option value="ST">São Tomé and Príncipe</option>
                                                <option value="SA">Saudi Arabia</option>
                                                <option value="SN">Senegal</option>
                                                <option value="RS">Serbia</option>
                                                <option value="CS">Serbia and Montenegro</option>
                                                <option value="SC">Seychelles</option>
                                                <option value="SL">Sierra Leone</option>
                                                <option value="SG">Singapore</option>
                                                <option value="SK">Slovakia</option>
                                                <option value="SI">Slovenia</option>
                                                <option value="SB">Solomon Islands</option>
                                                <option value="SO">Somalia</option>
                                                <option value="ZA">South Africa</option>
                                                <option value="5">South America</option>
                                                <option value="50">South-Central Asia</option>
                                                <option value="29">South-Eastern Asia</option>
                                                <option value="28">Southern Asia</option>
                                                <option value="3">Southern Europe</option>
                                                <option value="GS">South Georgia and the South Sandwich Islands</option>
                                                <option value="KR">South Korea</option>
                                                <option value="ES">Spain</option>
                                                <option value="LK">Sri Lanka</option>
                                                <option value="SD">Sudan</option>
                                                <option value="SR">Suriname</option>
                                                <option value="SJ">Svalbard and Jan Mayen</option>
                                                <option value="SZ">Swaziland</option>
                                                <option value="SE">Sweden</option>
                                                <option value="CH">Switzerland</option>
                                                <option value="SY">Syria</option>
                                                <option value="TW">Taiwan</option>
                                                <option value="TJ">Tajikistan</option>
                                                <option value="TZ">Tanzania</option>
                                                <option value="TH">Thailand</option>
                                                <option value="TL">Timor-Leste</option>
                                                <option value="TG">Togo</option>
                                                <option value="TK">Tokelau</option>
                                                <option value="TO">Tonga</option>
                                                <option value="TT">Trinidad and Tobago</option>
                                                <option value="TN">Tunisia</option>
                                                <option value="TR">Turkey</option>
                                                <option value="TM">Turkmenistan</option>
                                                <option value="TC">Turks and Caicos Islands</option>
                                                <option value="TV">Tuvalu</option>
                                                <option value="UG">Uganda</option>
                                                <option value="UA">Ukraine</option>
                                                <option value="AE">United Arab Emirates</option>
                                                <option value="GB">United Kingdom</option>
                                                <option value="US">United States</option>
                                                <option value="ZZ">Unknown or Invalid Region</option>
                                                <option value="UY">Uruguay</option>
                                                <option value="UM">U.S. Minor Outlying Islands</option>
                                                <option value="VI">U.S. Virgin Islands</option>
                                                <option value="UZ">Uzbekistan</option>
                                                <option value="VU">Vanuatu</option>
                                                <option value="VA">Vatican City</option>
                                                <option value="VE">Venezuela</option>
                                                <option value="VN">Vietnam</option>
                                                <option value="WF">Wallis and Futuna</option>
                                                <option value="9">Western Africa</option>
                                                <option value="145">Western Asia</option>
                                                <option value="155">Western Europe</option>
                                                <option value="EH">Western Sahara</option>
                                                <option value="YE">Yemen</option>
                                                <option value="ZM">Zambia</option>
                                                <option value="ZW">Zimbabwe</option>
                                            </select>
                                        </span>
                                    </p>
                                    <p>
                                        <label>Tipo de Logradouro:</label>
                                        <span class="field">
                                            @if (isset($logradouros))
                                                <select class="chosen-select" name="logradouro_res">
	                                                @foreach ($logradouros as $logradouro)
	                                                    <option value="{{$logradouro->id_logradouro}}">{{$logradouro->nombre}}</option>
	                                                @endforeach
                                                </select>
                                            @endif
                                        </span>
                                    </p>
                                    <p>
                                        <label>Endereço</label>
                                        <span class="field"><input type="text" name="dir_res" id="dir_res" class="input-xxlarge" /></span>
                                    </p>
                                    <p>
                                        <label>Bairro</label>
                                        <span class="field"><input type="text" name="bairro_res" id="bairro_res" class="input-xxlarge" /></span>
                                    </p>
                                    <p>
                                        <label>Localidade</label>
                                        <span class="field"><input type="text" name="ciudad_internacional_res" id="ciudad_internacional_res" class="input-xxlarge" /></span>
                                    </p>
                                    <p>
                                        <label>Telefone</label>
                                        <span class="field"><input type="text" name="ddd_res" id="ddd_res" class="input-small" /><input type="text" name="ddi_res" id="ddi_res" class="input-small" /><input type="text" name="telefone_res" id="telefone_res" class="input-xlarge" /></span>
                                    </p>
                                    <p>
                                        <label>Telefone 2</label>
                                        <span class="field"><input type="text" name="ddd_two_res" id="ddd_two_res" class="input-small" /><input type="text" name="ddi_two_res" id="ddi_two_res" class="input-small" /><input type="text" name="telefone_seg_res" id="telefone_seg_res" class="input-xlarge" /></span>
                                    </p>
                                    <p>
                                        <label>Celular</label>
                                        <span class="field"><input type="text" name="ddd_cel_res" id="ddd_cel_res" class="input-small" /><input type="text" name="ddi_cel_res" id="ddi_cel_res" class="input-small" /><input type="text" name="celular_res" id="celular_res" class="input-xlarge" /></span>
                                    </p>                                                          
                                </div>
                                <div id="wiz1step3" class="formwiz">
                                    <h4 class="widgettitle">Passo 3: Endereços Comercial</h4>
                                    
                                    <p>
                                        <label>CEP</label>
                                        <span class="field"><input type="text" name="cep_com" id="cep_com" class="input-xxlarge" /></span>
                                    </p>
                                    <p>
                                        <label>Número</label>
                                        <span class="field"><input type="text" name="numero_com" id="numero_com" class="input-xxlarge" /></span>
                                    </p>
                                    <p>
                                        <label>Complemento</label>
                                        <span class="field"><input type="text" name="complemento_com" id="complemento_com" class="input-xxlarge" /></span>
                                    </p>
                                    <p>
                                        <label>Pais</label>
                                        <span class="field">
                                            <select name="pais_com" id="asociados_pais_com"><option value="0">Selecione o País</option>
                                                <option value="AF">Afghanistan</option>
                                                <option value="AX">Åland Islands</option>
                                                <option value="AL">Albania</option>
                                                <option value="DZ">Algeria</option>
                                                <option value="AS">American Samoa</option>
                                                <option value="1">Americas</option>
                                                <option value="AD">Andorra</option>
                                                <option value="AO">Angola</option>
                                                <option value="AI">Anguilla</option>
                                                <option value="AQ">Antarctica</option>
                                                <option value="AG">Antigua and Barbuda</option>
                                                <option value="AR">Argentina</option>
                                                <option value="AM">Armenia</option>
                                                <option value="AW">Aruba</option>
                                                <option value="142">Asia</option>
                                                <option value="AU">Australia</option>
                                                <option value="43">Australia and New Zealand</option>
                                                <option value="AT">Austria</option>
                                                <option value="AZ">Azerbaijan</option>
                                                <option value="BS">Bahamas</option>
                                                <option value="BH">Bahrain</option>
                                                <option value="BD">Bangladesh</option>
                                                <option value="BB">Barbados</option>
                                                <option value="BY">Belarus</option>
                                                <option value="BE">Belgium</option>
                                                <option value="BZ">Belize</option>
                                                <option value="BJ">Benin</option>
                                                <option value="BM">Bermuda</option>
                                                <option value="BT">Bhutan</option>
                                                <option value="BO">Bolivia</option>
                                                <option value="BA">Bosnia and Herzegovina</option>
                                                <option value="BW">Botswana</option>
                                                <option value="BV">Bouvet Island</option>
                                                <option value="BR">Brazil</option>
                                                <option value="IO">British Indian Ocean Territory</option>
                                                <option value="VG">British Virgin Islands</option>
                                                <option value="BN">Brunei</option>
                                                <option value="BG">Bulgaria</option>
                                                <option value="BF">Burkina Faso</option>
                                                <option value="BI">Burundi</option>
                                                <option value="KH">Cambodia</option>
                                                <option value="CM">Cameroon</option>
                                                <option value="CA">Canada</option>
                                                <option value="CV">Cape Verde</option>
                                                <option value="2">Caribbean</option>
                                                <option value="KY">Cayman Islands</option>
                                                <option value="CF">Central African Republic</option>
                                                <option value="11">Central America</option>
                                                <option value="143">Central Asia</option>
                                                <option value="TD">Chad</option>
                                                <option value="830">Channel Islands</option>
                                                <option value="CL">Chile</option>
                                                <option value="CN">China</option>
                                                <option value="CX">Christmas Island</option>
                                                <option value="CC">Cocos [Keeling] Islands</option>
                                                <option value="CO">Colombia</option>
                                                <option value="172">Commonwealth of Independent States</option>
                                                <option value="KM">Comoros</option>
                                                <option value="CG">Congo - Brazzaville</option>
                                                <option value="CD">Congo - Kinshasa</option>
                                                <option value="CK">Cook Islands</option>
                                                <option value="CR">Costa Rica</option>
                                                <option value="CI">Côte d’Ivoire</option>
                                                <option value="HR">Croatia</option>
                                                <option value="CU">Cuba</option>
                                                <option value="CY">Cyprus</option>
                                                <option value="200">Czechoslovakia</option>
                                                <option value="CZ">Czech Republic</option>
                                                <option value="DK">Denmark</option>
                                                <option value="DJ">Djibouti</option>
                                                <option value="DM">Dominica</option>
                                                <option value="DO">Dominican Republic</option>
                                                <option value="12">Eastern Africa</option>
                                                <option value="24">Eastern Asia</option>
                                                <option value="151">Eastern Europe</option>
                                                <option value="EC">Ecuador</option>
                                                <option value="EG">Egypt</option>
                                                <option value="SV">El Salvador</option>
                                                <option value="GQ">Equatorial Guinea</option>
                                                <option value="ER">Eritrea</option>
                                                <option value="EE">Estonia</option>
                                                <option value="ET">Ethiopia</option>
                                                <option value="150">Europe</option>
                                                <option value="QU">European Union</option>
                                                <option value="FK">Falkland Islands</option>
                                                <option value="FO">Faroe Islands</option>
                                                <option value="FJ">Fiji</option>
                                                <option value="FI">Finland</option>
                                                <option value="FR">France</option>
                                                <option value="GF">French Guiana</option>
                                                <option value="PF">French Polynesia</option>
                                                <option value="TF">French Southern Territories</option>
                                                <option value="GA">Gabon</option>
                                                <option value="GM">Gambia</option>
                                                <option value="GE">Georgia</option>
                                                <option value="DE">Germany</option>
                                                <option value="GH">Ghana</option>
                                                <option value="GI">Gibraltar</option>
                                                <option value="GR">Greece</option>
                                                <option value="GL">Greenland</option>
                                                <option value="GD">Grenada</option>
                                                <option value="GP">Guadeloupe</option>
                                                <option value="GU">Guam</option>
                                                <option value="GT">Guatemala</option>
                                                <option value="GG">Guernsey</option>
                                                <option value="GN">Guinea</option>
                                                <option value="GW">Guinea-Bissau</option>
                                                <option value="GY">Guyana</option>
                                                <option value="HT">Haiti</option>
                                                <option value="HM">Heard Island and McDonald Islands</option>
                                                <option value="HN">Honduras</option>
                                                <option value="HK">Hong Kong SAR China</option>
                                                <option value="HU">Hungary</option>
                                                <option value="IS">Iceland</option>
                                                <option value="IN">India</option>
                                                <option value="ID">Indonesia</option>
                                                <option value="IR">Iran</option>
                                                <option value="IQ">Iraq</option>
                                                <option value="IE">Ireland</option>
                                                <option value="IM">Isle of Man</option>
                                                <option value="IL">Israel</option>
                                                <option value="IT">Italy</option>
                                                <option value="JM">Jamaica</option>
                                                <option value="JP">Japan</option>
                                                <option value="JE">Jersey</option>
                                                <option value="JO">Jordan</option>
                                                <option value="KZ">Kazakhstan</option>
                                                <option value="KE">Kenya</option>
                                                <option value="KI">Kiribati</option>
                                                <option value="KW">Kuwait</option>
                                                <option value="KG">Kyrgyzstan</option>
                                                <option value="LA">Laos</option>
                                                <option value="419">Latin America and the Caribbean</option>
                                                <option value="LV">Latvia</option>
                                                <option value="LB">Lebanon</option>
                                                <option value="LS">Lesotho</option>
                                                <option value="LR">Liberia</option>
                                                <option value="LY">Libya</option>
                                                <option value="LI">Liechtenstein</option>
                                                <option value="LT">Lithuania</option>
                                                <option value="LU">Luxembourg</option>
                                                <option value="MO">Macau SAR China</option>
                                                <option value="MK">Macedonia</option>
                                                <option value="MG">Madagascar</option>
                                                <option value="MW">Malawi</option>
                                                <option value="MY">Malaysia</option>
                                                <option value="MV">Maldives</option>
                                                <option value="ML">Mali</option>
                                                <option value="MT">Malta</option>
                                                <option value="MH">Marshall Islands</option>
                                                <option value="MQ">Martinique</option>
                                                <option value="MR">Mauritania</option>
                                                <option value="MU">Mauritius</option>
                                                <option value="YT">Mayotte</option>
                                                <option value="44">Melanesia</option>
                                                <option value="MX">Mexico</option>
                                                <option value="FM">Micronesia</option>
                                                <option value="47">Micronesian Region</option>
                                                <option value="15">Middle Africa</option>
                                                <option value="MD">Moldova</option>
                                                <option value="MC">Monaco</option>
                                                <option value="MN">Mongolia</option>
                                                <option value="ME">Montenegro</option>
                                                <option value="MS">Montserrat</option>
                                                <option value="MA">Morocco</option>
                                                <option value="MZ">Mozambique</option>
                                                <option value="MM">Myanmar [Burma]</option>
                                                <option value="NA">Namibia</option>
                                                <option value="NR">Nauru</option>
                                                <option value="NP">Nepal</option>
                                                <option value="NL">Netherlands</option>
                                                <option value="AN">Netherlands Antilles</option>
                                                <option value="NC">New Caledonia</option>
                                                <option value="NZ">New Zealand</option>
                                                <option value="NI">Nicaragua</option>
                                                <option value="NE">Niger</option>
                                                <option value="NG">Nigeria</option>
                                                <option value="NU">Niue</option>
                                                <option value="NF">Norfolk Island</option>
                                                <option value="13">Northern Africa</option>
                                                <option value="17">Northern America</option>
                                                <option value="154">Northern Europe</option>
                                                <option value="MP">Northern Mariana Islands</option>
                                                <option value="KP">North Korea</option>
                                                <option value="NO">Norway</option>
                                                <option value="0">Oceania</option>
                                                <option value="OM">Oman</option>
                                                <option value="QO">Outlying Oceania</option>
                                                <option value="PK">Pakistan</option>
                                                <option value="PW">Palau</option>
                                                <option value="PS">Palestinian Territories</option>
                                                <option value="PA">Panama</option>
                                                <option value="PG">Papua New Guinea</option>
                                                <option value="PY">Paraguay</option>
                                                <option value="PE">Peru</option>
                                                <option value="PH">Philippines</option>
                                                <option value="PN">Pitcairn Islands</option>
                                                <option value="PL">Poland</option>
                                                <option value="49">Polynesia</option>
                                                <option value="PT">Portugal</option>
                                                <option value="PR">Puerto Rico</option>
                                                <option value="QA">Qatar</option>
                                                <option value="RE">Réunion</option>
                                                <option value="RO">Romania</option>
                                                <option value="RU">Russia</option>
                                                <option value="RW">Rwanda</option>
                                                <option value="BL">Saint Barthélemy</option>
                                                <option value="SH">Saint Helena</option>
                                                <option value="KN">Saint Kitts and Nevis</option>
                                                <option value="LC">Saint Lucia</option>
                                                <option value="MF">Saint Martin</option>
                                                <option value="PM">Saint Pierre and Miquelon</option>
                                                <option value="VC">Saint Vincent and the Grenadines</option>
                                                <option value="WS">Samoa</option>
                                                <option value="SM">San Marino</option>
                                                <option value="ST">São Tomé and Príncipe</option>
                                                <option value="SA">Saudi Arabia</option>
                                                <option value="SN">Senegal</option>
                                                <option value="RS">Serbia</option>
                                                <option value="CS">Serbia and Montenegro</option>
                                                <option value="SC">Seychelles</option>
                                                <option value="SL">Sierra Leone</option>
                                                <option value="SG">Singapore</option>
                                                <option value="SK">Slovakia</option>
                                                <option value="SI">Slovenia</option>
                                                <option value="SB">Solomon Islands</option>
                                                <option value="SO">Somalia</option>
                                                <option value="ZA">South Africa</option>
                                                <option value="5">South America</option>
                                                <option value="50">South-Central Asia</option>
                                                <option value="29">South-Eastern Asia</option>
                                                <option value="28">Southern Asia</option>
                                                <option value="3">Southern Europe</option>
                                                <option value="GS">South Georgia and the South Sandwich Islands</option>
                                                <option value="KR">South Korea</option>
                                                <option value="ES">Spain</option>
                                                <option value="LK">Sri Lanka</option>
                                                <option value="SD">Sudan</option>
                                                <option value="SR">Suriname</option>
                                                <option value="SJ">Svalbard and Jan Mayen</option>
                                                <option value="SZ">Swaziland</option>
                                                <option value="SE">Sweden</option>
                                                <option value="CH">Switzerland</option>
                                                <option value="SY">Syria</option>
                                                <option value="TW">Taiwan</option>
                                                <option value="TJ">Tajikistan</option>
                                                <option value="TZ">Tanzania</option>
                                                <option value="TH">Thailand</option>
                                                <option value="TL">Timor-Leste</option>
                                                <option value="TG">Togo</option>
                                                <option value="TK">Tokelau</option>
                                                <option value="TO">Tonga</option>
                                                <option value="TT">Trinidad and Tobago</option>
                                                <option value="TN">Tunisia</option>
                                                <option value="TR">Turkey</option>
                                                <option value="TM">Turkmenistan</option>
                                                <option value="TC">Turks and Caicos Islands</option>
                                                <option value="TV">Tuvalu</option>
                                                <option value="UG">Uganda</option>
                                                <option value="UA">Ukraine</option>
                                                <option value="AE">United Arab Emirates</option>
                                                <option value="GB">United Kingdom</option>
                                                <option value="US">United States</option>
                                                <option value="ZZ">Unknown or Invalid Region</option>
                                                <option value="UY">Uruguay</option>
                                                <option value="UM">U.S. Minor Outlying Islands</option>
                                                <option value="VI">U.S. Virgin Islands</option>
                                                <option value="UZ">Uzbekistan</option>
                                                <option value="VU">Vanuatu</option>
                                                <option value="VA">Vatican City</option>
                                                <option value="VE">Venezuela</option>
                                                <option value="VN">Vietnam</option>
                                                <option value="WF">Wallis and Futuna</option>
                                                <option value="9">Western Africa</option>
                                                <option value="145">Western Asia</option>
                                                <option value="155">Western Europe</option>
                                                <option value="EH">Western Sahara</option>
                                                <option value="YE">Yemen</option>
                                                <option value="ZM">Zambia</option>
                                                <option value="ZW">Zimbabwe</option>
                                            </select>
                                        </span>
                                    </p>
                                    <p>
                                        <label>Tipo de Logradouro:</label>
                                        <span class="field">
                                            @if (isset($logradouros))
                                                <select class="chosen-select" name="logradouro_com">
                                                    @foreach ($logradouros as $logradouro)
                                                        <option value="{{$logradouro->id_logradouro}}">{{$logradouro->nombre}}</option>
                                                    @endforeach
                                                </select>
                                            @endif
                                        </span>
                                    </p>
                                    <p>
                                        <label>Endereço</label>
                                        <span class="field"><input type="text" name="dir_com" id="dir_com" class="input-xxlarge" /></span>
                                    </p>
                                    <p>
                                        <label>Bairro</label>
                                        <span class="field"><input type="text" name="bairro_com" id="bairro_com" class="input-xxlarge" /></span>
                                    </p>
                                    <p>
                                        <label>Localidade</label>
                                        <span class="field"><input type="text" name="ciudad_internacional_com" id="ciudad_internacional_com" class="input-xxlarge" /></span>
                                    </p>
                                    <p>
                                        <label>Telefone</label>
                                        <span class="field"><input type="text" name="ddd_com" id="ddd_com" class="input-small" /><input type="text" name="ddi_com" id="ddi_com" class="input-small" /><input type="text" name="telefone_com" id="telefone_com" class="input-xlarge" /></span>
                                    </p>
                                    <p>
                                        <label>Telefone 2</label>
                                        <span class="field"><input type="text" name="ddd_two_com" id="ddd_two_com" class="input-small" /><input type="text" name="ddi_two_com" id="ddi_two_com" class="input-small" /><input type="text" name="telefone_seg_com" id="telefone_seg_com" class="input-xlarge" /></span>
                                    </p>
                                    <p>
                                        <label>Celular</label>
                                        <span class="field"><input type="text" name="ddd_cel_com" id="ddd_cel_com" class="input-small" /><input type="text" name="ddi_cel_com" id="ddi_cel_com" class="input-small" /><input type="text" name="cel_com" id="cel_com" class="input-xlarge" /></span>
                                    </p>                                                           
                                </div>
                                <div id="wiz1step4" class="formwiz">
                                    <h4 class="widgettitle">Passo 4: Dados Acadêmicos</h4>
                                    <p>
                                        <label>Tipo de graduação</label>
                                        <span class="field">
                                            <select name="tipo_graduacion" id="asociados_datos_academicos_tipo_graduacion">
                                                <option value="0">DOUTORADO</option>
                                                <option value="1">ESPECIALIZAÇÃO</option>
                                                <option value="2">GRADUAÇÃO</option>
                                                <option value="3">MESTRADO</option>
                                                <option value="4">PÓS-GRADUAÇÃO</option>
                                            </select>
                                        </span>
                                    </p>
                                    <p>
                                        <label>Instituição:</label>
                                        <span class="field"><input type="text" name="institucion" id="institucion" class="input-xxlarge" /></span>
                                    </p>
                                    <p>
                                        <label>Faculdade:</label>
                                        <span class="field"><input type="text" name="facultad" id="facultad" class="input-xxlarge" /></span>
                                    </p>
                                    <p>
                                        <label>Formação:</label>
                                        <span class="field">
                                            @if (isset($formacoes))
                                                <select class="chosen-select" name="curso_realizado">
                                                    @foreach ($formacoes as $formacao)
                                                        <option value="{{$formacao->id}}">{{$formacao->nome}}</option>
                                                    @endforeach
                                                </select>
                                            @endif
                                        </span>
                                    </p>
                                    <p>
                                        <label>Ano de início</label>
                                        <span class="field"><input type="text" name="ano_inicio" id="ano_inicio" class="input-xxlarge" /></span>
                                    </p>
                                    <p>
                                        <label>Ano de finalização</label>
                                        <span class="field"><input type="text" name="ano_finalizacion" id="ano_finalizacion" class="input-xxlarge" /></span>
                                    </p>                                                  
                                </div>
                                <div id="wiz1step5" class="formwiz">
                                    <h4 class="widgettitle">Passo 5: Área de Atuação</h4>
                                    <p>
                                        <label>Área de Atuação</label>
                                        <span class="field">
											<select style="width: 215px; margin-left: 2px;" onchange="mostrar_otras()" name="area_de_especializacion" id="asociados_area_de_especializacion">
												<option value="0">Outras</option>
												<option value="1">Obra Civil</option>
												<option value="2">Irrigação</option>
												<option value="3">Mineração</option>
												<option value="4">Projeto / Consultoria</option>
												<option value="5">Planejamento Urbano</option>
												<option value="6">Gestão Ambiental</option>
												<option value="7">Hidrogeologia</option>
												<option value="8">Fundações / Serviços Geotécnicos</option>
												<option value="9" selected="selected">Geofísica</option>
												<option value="10">Ensino / Pesquisa</option>
												<option value="11">Gerenciamento de Empreendimentos</option>
											</select>
                                        </span>
                                    </p>                                                           
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </form>
                </div>

                
@stop