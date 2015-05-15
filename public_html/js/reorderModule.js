/*
 * Ext JS Library 3.2.0
 * Copyright(c) 2006-2010, Ext JS, LLC.
 * licensing@extjs.com
 * 
 * http://extjs.com/license
 *
 * HMary Bonilla - mbonilla@aberic.com
 * Sistema de Pestañas por Language
 */

var url = 'http://'+location.hostname+'/portal/backend_dev.php';

Ext.onReady(function(){
    // shorthand
    var Tree = Ext.tree;    
    var tree = new Tree.TreePanel({
        title:'Árvore de menu tipo',
        el:'tree-div',        
        useArrows:true,
        autoScroll:true,
        animate:true,
        enableDD:true,
        containerScroll: true,       
        loader: new Ext.tree.TreeLoader({dataUrl:url+'/lxmodule/treeSections', requestMethod: 'POST'}),

        root:{
            nodeType: 'async',
            text: 'Menu',
            draggable:false,
            id:'0'
        }       
    });
    
    // listeners
    tree.addListener('movenode', function (tree, node, oldParent, newParent, index, home){
        var id_seccion = node.id;
        var padre_antes = oldParent.id;
        var padre_nuevo = newParent.id;
        var posicion = index+1;
        jQuery.ajax({type:'POST',dataType:'html',success:function(data, textStatus){jQuery('#resultados').html(data);},url:'/portal/backend_dev.php/lxmodule/listenerMove/id_module/' + id_seccion + '/padre_antes/' + padre_antes + '/padre_nuevo/' + padre_nuevo + '/posicion/' + posicion}); return false;
    });
    // render the tree
    tree.render();
    tree.getRootNode().expand();
});