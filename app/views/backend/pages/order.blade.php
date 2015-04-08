@extends("backend.layout")

@section("css")
{{HTML::style("assetsadmin/css/bootstrap-fileupload.min.css")}}
{{HTML::style("assetsadmin/css/bootstrap-timepicker.min.css")}}
{{HTML::style("assets/nestable/nestable.css")}}
{{HTML::style("assets/jqtree/jqtree.css")}}
<style type="text/css">
	.actions{
		text-align:right;
		right: 10px;
	}
</style>
@stop

<?php

	function displayElement($item, $route){
		echo '<li class="dd-item" data-id="'.$item->id.'">';
		echo '<div class="dd-handle"><span class="title">'.$item->title.'</span></div>';
		if(count($item->children) > 0):
			echo '<ol class="dd-list">';
			foreach($item->children as $subitem):
				displayElement($subitem, $route);
			endforeach;
			echo '</ol>';
		endif;
		echo '</li>';
	}

 ?>

@section("js")
{{HTML::script("assetsadmin/js/jquery.jgrowl.js")}}
{{HTML::script("assetsadmin/js/jquery.alerts.js")}}
{{HTML::script("assetsadmin/js/jquery.dataTables.min.js")}}
{{HTML::script("assets/nestable/jquery.nestable.js")}}
{{HTML::script("assets/jqtree/tree.jquery.js")}}

<script type='text/javascript'>

    var confirmButtons = function(){
        console.log('click');
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

    var jqTree = {{ $json }};

     jQuery(document).ready(function(){

     	jQuery('.dd').nestable({ /* config options */ });
     	jQuery('.dd-handle').on('click', function(e) {
		    /* on change event */
		    console.log("click");
		    console.log(jQuery(this).attr('data-id'));
		});
     	jQuery('.dd').on('change', function() {
		    /* on change event */
		    console.log(jQuery('.dd').nestable('serialize'));
		    jQuery.ajax({
		    	url: "{{ $route.'/order' }}",
			    data: {"data": jQuery('.dd').nestable('serialize')}, //handsontable.getData()}, //returns all cells' data
			    dataType: 'json',
			    type: 'POST',
			    success: function (res) { console.log(res); },
			    error: function(err) { console.log("ERROR: "); console.log(err) }
		    })
		});

		jQuery('#tree').tree({
			data: jqTree,
		    autoOpen: true,
		    dragAndDrop: true,
		});

		jQuery('#tree').bind(
		    'tree.move',
		    function(event) {
		        console.log('event', event.move_info.moved_node);
		        console.log('target_node', event.move_info.target_node);
		        console.log('position', event.move_info.position);
		        console.log('previous_parent', event.move_info.previous_parent);
		    }
		);
     	
     	

        // dynamic table

        /*var table = jQuery('#dyntable').dataTable({
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
        });*/
        
    });
</script>
@stop

@section("title")
{{ Lang::get('Páginas') }}
@stop

@section("iconpage")
<span class="iconfa-book"></span>
@stop

@section("maintitle")
{{ Lang::get('Páginas') }}
@stop

@section("nameview")
{{ Lang::get('Todas as Páginas') }}
@stop

@section("MainContent")
<div class="maincontent">
            <div class="maincontentinner">
                <!-- Gets replaced with TinyMCE, remember HTML in a textarea should be encoded -->
                <div class="widgetbox">
                    <div class="headtitle">
                        <div class="btn-group">
                            <a href="{{ $route }}" class="btn dropdown-toggle">{{ Lang::get('Voltar')}}</a>
                        </div>
                        <h4 class="widgettitle">{{ Lang::get('Todas as Páginas') }}</h4>
                    </div>
                    <!-- <table id="dyntable" class="table table-bordered responsive">
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
                                <th class="head0" width="35%">Titulo</th>
                                <th class="head1"style="width:35%">URL</th>
                                <th class="head0" style="width:30%">{{ Lang::get('display.actions')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($pages))
                                @foreach($pages as $page)
                                    <tr class="gradeX">
                                      <td class="aligncenter"><span class="center">
                                        <input type="checkbox" />
                                      </span></td>
                                        <td>{{$page->title}}</td>
                                        <td>{{$page->name}}</td>
                                        <td class="center">
                                            <a href="{{ $route }}/update/{{$page->id_page}}" class="btn btn-warning alertwarning" style="color:#FFF !important;"><i class="iconfa-edit" style="color:#FFF;margin-right:10px;"></i>{{Lang::get('display.edit')}}</a>
                                            <a data-id="{{$page->id_page}}" data-action="delete" class="btn confirmbutton btn-danger alertdanger" style="color:#FFF !important;"><i class="iconfa-trash" style="color:#FFF;margin-right:10px;"></i>{{Lang::get('display.delete')}}</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table> -->
					
					@if(isset($pages))
						<div class="dd">
						    <ol class="dd-list">
					            @foreach($pages as $page)
					                <?php displayElement($page, $route); ?>
					             @endforeach
						    </ol>
						</div>
					@endif
					
                </div>
                <!-- <div id="tree"></div> -->


                
@stop