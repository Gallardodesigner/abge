/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Muestra las opciones Edit - Delete - Entre otras de los listados de los diferentes modulos
 */
var tmpStyle;

function overRow(item)
{
    $(".row-actions_" + item).show();
    /*tmpStyle = $("#row_style_" + item).attr('class');
    $("#row_style_" + item).attr('class','bgList');*/
}
/**
 * Oculta las opciones Edit - Delete - Entre otras de los listados de los diferentes modulos
 */
function outRow(item)
{    
    $(".row-actions_" + item).hide();
    /*$("#row_style_" + item).attr('class',tmpStyle);*/
}
/**
 * Muestra los privilegios
 */
function viewInfoSection()
{
    $(".informationSection").show();
    $("#viewInfoSection").hide();
    $("#noViewInfoSection").show();
}

function noViewInfoSection()
{
    $(".informationSection").hide();
    $("#viewInfoSection").show();
    $("#noViewInfoSection").hide();
}


/**
 * Muestra los privilegios
 */
function showPrivileges(item)
{
    $(".permissions_" + item).show();
    $("#displayPrivActive_" + item).hide();
    $("#displayPrivDesactive_" + item).show();
}
/**
 * Oculta los privilegios
 */
function hidePrivileges(item)
{
    $(".permissions_" + item).hide();
    $("#displayPrivActive_" + item).show();
    $("#displayPrivDesactive_" + item).hide();
}
/**
 * Oculta el mensaje de actualizacion de privilegios
 */
function fadeMessage(secuence)
{
    $("#message_" + secuence).hide();

}
/**
 * Ajax para registrar los nuevos permisos
 */
function submitPermissions(module,priv,profile)
{
    // Detecto el status del check, checked o unchecked
    var checkSelected = $("#chk_" + module + "_" + priv + ":checked").val();
    var privPpal = 0;
    if(!checkSelected){
        checkSelected = 0;
    }
    // Si el privilegio seleccionado es distinto de 1(View), lo activo
    if(priv != 1)
        {
            $("#chk_" + module + "_1").attr('checked',true);
            privPpal = 1; // Me indica que en la accion debo agregar otra permisologia con id_privelege = 1
        }
    // Si el privilegio seleccionado es igual a 1(View) y lo estoy desactivando, entonces desactivo el resto
    if(priv == 1 && checkSelected !=1)
        {
            $("#chk_" + module + "_2").attr('checked',false);
            $("#chk_" + module + "_3").attr('checked',false);
            $("#chk_" + module + "_4").attr('checked',false);
        }
    // Ajax para guardar los cambios de permisologia
    $(function(){
        $.ajax({
          type: "POST",
          url: "lxprofile/changePrivileges?id_module=" + module + "&id_privilege=" + priv + "&id_profile=" + profile + "&status=" + checkSelected + "&privPpal=" + privPpal,
          dataType: "script",
          beforeSend: function(objeto){
                $("#message_" + module).html("Wait ...");
          },
          success: function(msg){
                $("#message_" + module).animate({width:150, height:10}, "slow");
                $("#message_" + module).html('<div>Saved &nbsp;&nbsp;&nbsp; <a href="#" onclick="fadeMessage(' + module + ' );">Hide</a></div>');                
          },
          error: function(objeto, quepaso, otroobj){
                $("#message_" + module).animate({width:150, height:10}, "slow");
                $("#message_" + module).html('<div>Error. Please update browser&nbsp;&nbsp;&nbsp; <a href="#" onclick="fadeMessage(' + module + ' );">Hide</a></div>');
          }

        });
    });
}


function submitPermissionsUser(module,iduser)
{
    // Detecto el status del check, checked o unchecked
    var checkSelected = $('input[name=chk_' + module + ']').is(':checked');
    var privPpal = 0;
    if(!checkSelected){
        checkSelected = 0;
    }else{
        checkSelected = 1;
    }
    // Ajax para guardar los cambios de permisologia del usuario
    $(function(){
        $.ajax({
          type: "POST",
          url: "lxuserpermission/changePermissionUser?id_module=" + module + "&id_user=" + iduser + "&status=" + checkSelected,
          dataType: "script",
          beforeSend: function(objeto){
                $("#message_" + module).html("Wait ...");
          },
          success: function(msg){
                $("#message_" + module).animate({width:150, height:10}, "slow");
                $("#message_" + module).html('<div>Dados armazenados &nbsp;&nbsp;&nbsp; <a href="#" onclick="fadeMessage(' + module + ' );">Ocultar</a></div>');                
          },
          error: function(objeto, quepaso, otroobj){
                $("#message_" + module).animate({width:150, height:10}, "slow");
                $("#message_" + module).html('<div>Error. Por favor, atualize navegador&nbsp;&nbsp;&nbsp; <a href="#" onclick="fadeMessage(' + module + ' );">Ocultar</a></div>');
          }

        });
    });
}

function activaComboFormacao(idasociado)
{
    $("#formacao_actual_" + idasociado).hide();
    $("#formacao_" + idasociado).show();
    $("#formacion_"  + idasociado).val($("#id_formacao_" + idasociado).val());
    
}

function cancelarFilaFormacao(idasociado)
{
    
    $("#formacao_actual_" + idasociado).show();
    $("#formacao_" + idasociado).hide();
}


function activaComboEstado(idasociado, estado_sel, ciudad_sel, endereco)
{
    $("#estatico_uf_" + endereco + "_" + idasociado).hide();
    $("#estatico_mun_" + endereco + "_" + idasociado).hide();
    $("#dinamic_uf_" + endereco + "_" + idasociado).show();
    $("#estado_" + endereco + "_" + idasociado).val($("#id_estado_" + endereco + "_save_" + idasociado).val());
    cargaCiudades(idasociado, $("#id_ciudad_" + endereco + "_save_" + idasociado).val(), endereco);
    $("#dinamic_mun_" + endereco + "_" + idasociado).show();    
}

function cancelarCombosFila(idestado, end)
{
    
    $("#estatico_uf_" + end + "_" + idestado).show();
    $("#estatico_mun_" + end + "_" + idestado).show();
    $("#dinamic_uf_" + end + "_" + idestado).hide();
    $("#dinamic_mun_" + end + "_" + idestado).hide();   
}

function cargaCiudades(idasociado, ciudad_sel, endereco)
{
    var url = 'http://'+location.hostname+'/backend_dev.php/';
    var idEstado = $("#estado_" + endereco + "_" + idasociado).val();
    $(function(){
        $.ajax({
          type: "POST",
          url: url +"asociados/getMunicipiosUf?id=" + idEstado,
          dataType: "script",
          beforeSend: function(objeto){
                $("#ciudad_" + endereco + "_" + idasociado + " > option").remove();  
                $("#ciudad_" + endereco + "_" + idasociado).append("<option>Cargando...</option>");
          },
          success: function(msg){
                $("#ciudad_" + endereco + "_" + idasociado).html(msg);    
                $("#ciudad_" + endereco + "_" + idasociado).val(ciudad_sel)
                
          },
          error: function(objeto, quepaso, otroobj){
                
          }
        });
    });
}

function guardaFormacao(idasociado)
{
    var url = 'http://'+location.hostname+'/backend_dev.php/';
    var idFormacao = $("#formacion_" + idasociado).val();
    $("#id_formacao_" + idasociado).val(idFormacao);
    $(function(){
        $.ajax({
          type: "POST",
          url: url +"asociados/guardaFormacion?id_formacion=" + idFormacao + "&id_asociado=" + idasociado,
          dataType: "script",
          beforeSend: function(objeto){
                $("#formacao_" + idasociado).hide();
                $("#preload-formacao-" + idasociado).show();
          },
          success: function(msg){
                var nome_formacao = $('#formacion_' + idasociado + ' option:selected').text();
                
                if($('#formacion_' + idasociado).val() <= 0)
                    {
                        nome_formacao = 'não';
                    }
                $("#formacao_actual_" + idasociado).show();
                $("#preload-formacao-" + idasociado).hide();
                $("#formacao_actual_" + idasociado).html(nome_formacao);
          },
          error: function(objeto, quepaso, otroobj){
                
          }
        });
    });
}

function guardaDatos(idasociado, tipo_correspondencia, endereco)
{
    var url = 'http://'+location.hostname+'/backend_dev.php/';
    var idEstado = $("#estado_" + endereco + "_" + idasociado).val();
    var idCiudad = $("#ciudad_" + endereco + "_" + idasociado).val();
    $("#id_estado_" + endereco + "_save_" + idasociado).val(idEstado);
    $("#id_ciudad_" + endereco + "_save_" + idasociado).val(idCiudad);
    $(function(){
        $.ajax({
          type: "POST",
          url: url +"asociados/guardaDatos?id_estado=" + idEstado + "&id_ciudad=" + idCiudad + "&id_asociado=" + idasociado + "&tipo_correspondencia=" + endereco,
          dataType: "script",
          beforeSend: function(objeto){
                $("#dinamic_uf_" + endereco + "_" + idasociado).hide();
                $("#dinamic_mun_" + endereco + "_" + idasociado).hide();
                $("#preload-uf-" + endereco + "-" + idasociado).show();
                $("#preload-mun-" + endereco + "-" + idasociado).show();
          },
          success: function(msg){
                var nome_estado = $('#estado_' + endereco + '_' + idasociado + ' option:selected').text();
                var nome_ciudad = $('#ciudad_' + endereco + '_' + idasociado + ' option:selected').text();
                if($('#estado_' + endereco + '_' + idasociado).val() <= 0)
                    {
                        nome_estado = 'não';
                    }
                if($('#ciudad_' + endereco + '_' + idasociado).val() <= 0)
                    {
                        nome_ciudad = 'não';
                    }
                $("#estatico_mun_" + endereco + "_" + idasociado).show();
                $("#estatico_uf_" + endereco + "_" + idasociado).show();
                $("#preload-uf-" + endereco + "-" + idasociado).hide();
                $("#preload-mun-" + endereco + "-" + idasociado).hide();
                $("#estatico_uf_" + endereco + "_" + idasociado).html(nome_estado);
                $("#estatico_mun_" + endereco + "_" + idasociado).html(nome_ciudad);
          },
          error: function(objeto, quepaso, otroobj){
                
          }
        });
    });
}

function changeCategoryInNuclueByNews(idnucleo, idnews)
{
    // Detecto el status del check, checked o unchecked
    var category = $("#category").val();
    var url = 'http://'+location.hostname+'/backend_dev.php/';
    // Ajax para guardar los cambios de permisologia del usuario
    $(function(){
        $.ajax({
          type: "POST",
          url: url +"news/changeCategoryInNuclueByNews?id_news=" + idnews + "&id_nucleo=" + idnucleo + "&category=" + category,
          dataType: "script",
          beforeSend: function(objeto){
                $("#message").html("Wait ...");
          },
          success: function(msg){
                $("#message").animate({width:400, height:10}, "slow");
                $("#message").html('<div class="msn_ready">Dados armazenados</div>');       
                
          },
          error: function(objeto, quepaso, otroobj){
                $("#message").animate({width:400, height:10}, "slow");
                $("#message").html('<div class="msn_error">Error. Por favor, atualize navegador&nbsp;</div>');
          }
        });
    });
}

function uploadItem(moduleAction)
{
    var url = 'http://'+location.hostname+'/backend_dev.php/';
    var urlUpload = url + moduleAction;
    var btnUpload=$('#upload_image');
    var status=$('#mimeError');
    new AjaxUpload(btnUpload, {
    action: urlUpload,
    name: 'uploadfile',
    dataType: 'html',
    onSubmit: function(file,ext){
    //if there is an error
    if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){
        status.show();
        status.animate({opacity: 5000}, 0)
        status.animate({opacity: 0}, 7000);
        return false;
    }
    $('#preLoad').show();
    btnUpload.css("display","none");
    $('#msg_upload').css("display","none");
    $('#wait').css("display","");
    $('#wait').html("&nbsp;&nbsp;Wait until the upload image...");
    },
    onComplete: function(file, response){
    $('#preLoad').hide();
    //Add uploaded file to list
    $('#image_poster').append(response);
    $('#preLoad').remove().appendTo("#image_poster");
    $('#no_foto').fadeOut('');
    btnUpload.css("display","");
    $('#wait').css("display","none");
    $('#msg_upload').css("display","");
    }
    });
}






