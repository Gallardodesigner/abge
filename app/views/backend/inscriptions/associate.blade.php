@extends("backend.layout")

@section("css")
{{HTML::style("assetsadmin/css/bootstrap-fileupload.min.css")}}
{{HTML::style("assetsadmin/css/bootstrap-timepicker.min.css")}}

@stop


@section("js")
<!-- <script src="http://tinymce.cachefly.net/4.1/jquery.tinymce.min.js"></script>
<script src="http://tinymce.cachefly.net/4.1/tinymce.min.js"></script>

 -->
 <!-- {{HTML::script("assetsadmin/js/tiny_mce/jquery.tinymce.min.js")}} -->
<!-- {{HTML::script("assetsadmin/js/tiny_mce/tinymce.js")}} -->
<!-- {{HTML::script("assetsadmin/js/wysiwyg.js")}} -->
<script>
 
</script>
@stop

@section("title")
{{ Lang::get('titles.courses') }}
@stop

@section("iconpage")
<span class="iconfa-user-md"></span>
@stop

@section("maintitle")
{{ Lang::get('titles.sections')}}
@stop

@section("nameview")
    {{Lang::get('display.add_section')}}
@stop


@section("MainContent")
<div class="maincontent">
            <div class="maincontentinner">
            
                <!-- Gets replaced with TinyMCE, remember HTML in a textarea should be encoded -->
                <div class="widgetbox">
                <div class="headtitle">
                    <div class="btn-group">
                        <a href="{{ $route }}" class="btn dropdown-toggle">{{ Lang::get('display.back') }}</a>
                    </div>
                    </div>
                <h4 class="widgettitle">{{Lang::get('display.add_section')}}</h4>
                <div class="widgetcontent">
                    <form class="stdform stdform2" method="post">
                            <p>
                                <label>{{ Lang::get('display.associate_code') }}</label>
                                <span class="field">{{$user->associate->asociado->codigo_asoc}}</span>
                            </p>  
                            <p>
                                <label>{{ Lang::get('display.name') }}</label>
                                <span class="field">{{$user->associate->asociado->nombre_completo}}</span>
                            </p>  
                            <p>
                                <label>{{ Lang::get('display.email') }}</label>
                                <span class="field">{{$user->associate->asociado->email}}</span>
                            </p>
                            <p>
                                <label>{{ Lang::get('display.business_name') }}</label>
                                <span class="field">{{$user->associate->asociado->razon_social}}</span>
                            </p>  
                            <p>
                                <label>{{ Lang::get('display.type_of_person') }}</label>
                                <span class="field">{{$user->associate->asociado->tipo_pessoa}}</span>
                            </p> 
                            <p>
                                <label>{{ Lang::get('display.statal_inscription') }}</label>
                                <span class="field">{{$user->associate->asociado->inscripcion_estadual}}</span>
                            </p>  
                            <p>
                                <label>{{ Lang::get('display.municipal_inscription') }}</label>
                                <span class="field">{{$user->associate->asociado->inscripcion_municipal}}</span>
                            </p>
                            <p>
                                <label>{{ Lang::get('display.training') }}</label>
                                <span class="field">
                                    
                                    @foreach($trainings as $training)
                                        @if($user->associate->asociado->formacao == $training->id)
                                            {{$training->nome}}
                                        @endif
                                    @endforeach

                                </span>
                                <span class="field">{{$training->nome}}</span>
                            </p>    
                            <p>
                                <label>{{ Lang::get('display.category') }}</label>
                                <span class="field">
                                    
                                    @foreach($categories as $category)
                                        @if($user->associate->asociado->categoria == $category->id_categoria_asociado)
                                            {{$category->nombre_categoria}}
                                        @endif
                                    @endforeach

                                </span>
                            </p>  
                            <p>
                                <label>{{ Lang::get('display.cpf') }}</label>
                                <span class="field">{{$user->associate->asociado->cpf}}</span>
                            </p>  
                            <p>
                                <label>{{ Lang::get('display.cnpj') }}</label>
                                <span class="field">{{$user->associate->asociado->cnpj}}</span>
                            </p>  
                            <p>
                                <label>{{ Lang::get('display.passport') }}</label>
                                <span class="field">{{$user->associate->asociado->passaporte}}</span>
                            </p>  
                            <p>
                                <label>{{ Lang::get('display.rg') }}</label>
                                <span class="field">{{$user->associate->asociado->rg}}</span>
                            </p>  
                            <p>
                                <label>{{ Lang::get('display.born_date') }}</label>
                                <span class="field">{{$user->associate->asociado->data_nascimento}}</span>
                            </p>  
                            <p>
                                <label>{{ Lang::get('display.sex') }}</label>
                                <span class="field">{{$user->associate->asociado->sexo}}</span>
                            </p>  
                            <p>
                                <label>{{ Lang::get('display.email') }}</label>
                                <span class="field">{{$user->associate->asociado->email}}</span>
                            </p>  
                            <p>
                                <label>{{ Lang::get('display.type_of_person') }}</label>
                                <span class="field">{{$user->associate->asociado->tipo_pessoa}}</span>
                            </p>  
                            <p>
                                <label>{{ Lang::get('display.web_site') }}</label>
                                <span class="field">{{$user->associate->asociado->web_site}}</span>
                            </p>   
                            <p>
                                <label>{{ Lang::get('display.responsible') }}</label>
                                <span class="field">{{$user->associate->asociado->responsavel}}</span>
                            </p>   
                            <p>
                                <label>{{ Lang::get('display.observation') }}</label>
                                <span class="field">{{$user->associate->asociado->observacao}}</span>
                            </p>   
                            <p>
                                <label>{{ Lang::get('display.publications') }}</label>
                                <span class="field">{{$user->associate->asociado->publicacoes}}</span>
                            </p>   
                            <p>
                                <label>{{ Lang::get('display.institution') }}</label>
                                <span class="field">{{$user->associate->asociado->institucion}}</span>
                            </p>   
                            <p>
                                <label>{{ Lang::get('display.registration_date') }}</label>
                                <span class="field">{{$user->associate->asociado->data_cadastro}}</span>
                            </p>   
                            <p>
                                <label>{{ Lang::get('display.business') }}</label>
                                <span class="field">{{$user->associate->asociado->empresa}}</span>
                            </p>   
                            <p>
                                <label>{{ Lang::get('display.office') }}</label>
                                <span class="field">{{$user->associate->asociado->cargo}}</span>
                            </p>   
                            <p>
                                <label>{{ Lang::get('display.scientific_name') }}</label>
                                <span class="field">{{$user->associate->asociado->nome_cientifico}}</span>
                            </p>   
                            <p>
                                <label>{{ Lang::get('display.cep_res') }}</label>
                                <span class="field">{{$user->associate->asociado->cep_res}}</span>
                            </p>   
                            <p>
                                <label>{{ Lang::get('display.cep_com') }}</label>
                                <span class="field">{{$user->associate->asociado->cep_com}}</span>
                            </p>   
                            <p>
                                <label>{{ Lang::get('display.logradouro_res') }}</label>
                                <span class="field">
                                    
                                    @foreach($backyards as $backyard)
                                        @if($user->associate->asociado->logradouro_res == $backyard->id_logradouro)
                                            {{$backyard->nombre}}
                                        @endif
                                    @endforeach

                                </span>
                            </p>   
                            <p>
                                <label>{{ Lang::get('display.logradouro_com') }}</label>
                                <span class="field">
                                    
                                    @foreach($backyards as $backyard)
                                        @if($user->associate->asociado->logradouro_com == $backyard->id_logradouro)
                                            {{$backyard->nombre}}
                                        @endif
                                    @endforeach

                                </span>
                            </p>   
                            <p>
                                <label>{{ Lang::get('display.dir_res') }}</label>
                                <span class="field">{{$user->associate->asociado->dir_res}}</span>
                            </p>   
                            <p>
                                <label>{{ Lang::get('display.dir_com') }}</label>
                                <span class="field">{{$user->associate->asociado->dir_com}}</span>
                            </p>   
                            <p>
                                <label>{{ Lang::get('display.complemento_res') }}</label>
                                <span class="field">{{$user->associate->asociado->complemento_res}}</span>
                            </p>   
                            <p>
                                <label>{{ Lang::get('display.complemento_com') }}</label>
                                <span class="field">{{$user->associate->asociado->complemento_com}}</span>
                            </p>   
                            <p>
                                <label>{{ Lang::get('display.numero_res') }}</label>
                                <span class="field">{{$user->associate->asociado->numero_res}}</span>
                            </p> 
                            <p>
                                <label>{{ Lang::get('display.numero_com') }}</label>
                                <span class="field">{{$user->associate->asociado->numero_com}}</span>
                            </p> 
                            <p>
                                <label>{{ Lang::get('display.bairro_res') }}</label>
                                <span class="field">{{$user->associate->asociado->bairro_res}}</span>
                            </p> 
                            <p>
                                <label>{{ Lang::get('display.bairro_com') }}</label>
                                <span class="field">{{$user->associate->asociado->bairro_com}}</span>
                            </p> 
                            <p>
                                <label>{{ Lang::get('display.pais_res') }}</label>
                                <span class="field">{{$user->associate->asociado->pais_res}}</span>
                            </p> 
                            <p>
                                <label>{{ Lang::get('display.pais_com') }}</label>
                                <span class="field">{{$user->associate->asociado->pais_com}}</span>
                            </p> 
                            <p>
                                <label>{{ Lang::get('display.municipio_res') }}</label>
                                <span class="field">
                                    
                                    @foreach($towns as $town)
                                        @if($user->associate->asociado->municipio_res == $town->id_municipio)
                                            {{$town->name_municipio}}
                                        @endif
                                    @endforeach

                                </span>
                            </p> 
                            <p>
                                <label>{{ Lang::get('display.municipio_com') }}</label>
                                <span class="field">
                                    
                                    @foreach($towns as $town)
                                        @if($user->associate->asociado->municipio_com == $town->id_municipio)
                                            {{$town->name_municipio}}
                                            
                                        @endif
                                    @endforeach

                                </span>
                            </p> 
                            <p>
                                <label>{{ Lang::get('display.uf_res') }}</label>
                                <span class="field">
                                    
                                    @foreach($estados as $state)
                                        @if($user->associate->asociado->uf_res == $state->id_estado)
                                            {{$state->name_estado}}
                                        @endif
                                    @endforeach

                                </span>
                            </p> 
                            <p>
                                <label>{{ Lang::get('display.uf_com') }}</label>
                                <span class="field">
                                    
                                    @foreach($estados as $state)
                                        @if($user->associate->asociado->uf_com == $state->id_estado)
                                            {{$state->name_estado}}
                                        @endif
                                    @endforeach

                                </span>
                            </p> 
                            <p>
                                <label>{{ Lang::get('display.ddi_res') }}</label>
                                <span class="field">{{$user->associate->asociado->ddi_res}}</span>
                            </p> 
                            <p>
                                <label>{{ Lang::get('display.ddd_res') }}</label>
                                <span class="field">{{$user->associate->asociado->ddd_res}}</span>
                            </p> 
                            <p>
                                <label>{{ Lang::get('display.ddd_com') }}</label>
                                <span class="field">{{$user->associate->asociado->ddd_com}}</span>
                            </p> 
                            <p>
                                <label>{{ Lang::get('display.ddi_com') }}</label>
                                <span class="field">{{$user->associate->asociado->ddi_com}}</span>
                            </p> 
                            <p>
                                <label>{{ Lang::get('display.ddd_two_res') }}</label>
                                <span class="field">{{$user->associate->asociado->ddd_two_res}}</span>
                            </p> 
                            <p>
                                <label>{{ Lang::get('display.ddi_two_res') }}</label>
                                <span class="field">{{$user->associate->asociado->ddi_two_res}}</span>
                            </p> 
                            <p>
                                <label>{{ Lang::get('display.ddd_two_com') }}</label>
                                <span class="field">{{$user->associate->asociado->ddd_two_com}}</span>
                            </p> 
                            <p>
                                <label>{{ Lang::get('display.ddi_two_com') }}</label>
                                <span class="field">{{$user->associate->asociado->ddi_two_com}}</span>
                            </p> 
                            <p>
                                <label>{{ Lang::get('display.ddi_cel_res') }}</label>
                                <span class="field">{{$user->associate->asociado->ddi_cel_res}}</span>
                            </p> 
                            <p>
                                <label>{{ Lang::get('display.ddi_cel_com') }}</label>
                                <span class="field">{{$user->associate->asociado->ddi_cel_com}}</span>
                            </p> 
                            <p>
                                <label>{{ Lang::get('display.telefone_res') }}</label>
                                <span class="field">{{$user->associate->asociado->telefone_res}}</span>
                            </p> 
                            <p>
                                <label>{{ Lang::get('display.telefone_com') }}</label>
                                <span class="field">{{$user->associate->asociado->telefone_com}}</span>
                            </p> 
                            <p>
                                <label>{{ Lang::get('display.telefone_seg_res') }}</label>
                                <span class="field">{{$user->associate->asociado->telefone_seg_res}}</span>
                            </p> 
                            <p>
                                <label>{{ Lang::get('display.telefone_seg_com') }}</label>
                                <span class="field">{{$user->associate->asociado->telefone_seg_com}}</span>
                            </p> 
                            <p>
                                <label>{{ Lang::get('display.ddd_cel_res') }}</label>
                                <span class="field">{{$user->associate->asociado->ddd_cel_res}}</span>
                            </p> 
                            <p>
                                <label>{{ Lang::get('display.celular_res') }}</label>
                                <span class="field">{{$user->associate->asociado->celular_res}}</span>
                            </p> 
                            <p>
                                <label>{{ Lang::get('display.ddd_cel_com') }}</label>
                                <span class="field">{{$user->associate->asociado->ddd_cel_com}}</span>
                            </p> 
                            <p>
                                <label>{{ Lang::get('display.celular_com') }}</label>
                                <span class="field">{{$user->associate->asociado->celular_com}}</span>
                            </p> 
                            <p>
                                <label>{{ Lang::get('display.status_asso') }}</label>
                                <span class="field">{{$user->associate->asociado->status_asso}}</span>
                            </p> 
                            <p>
                                <label>{{ Lang::get('display.area_de_especializacion') }}</label>
                                <span class="field">{{$user->associate->asociado->area_de_especializacion}}</span>
                            </p> 
                            <p>
                                <label>{{ Lang::get('display.area_de_especializacion_otro') }}</label>
                                <span class="field">{{$user->associate->asociado->area_de_especializacion_otro}}</span>
                            </p> 
                            <p>
                                <label>{{ Lang::get('display.ciudad_internacional_res') }}</label>
                                <span class="field">{{$user->associate->asociado->ciudad_internacional_res}}</span>
                            </p> 
                            <p>
                                <label>{{ Lang::get('display.ciudad_internacional_com') }}</label>
                                <span class="field">{{$user->associate->asociado->ciudad_internacional_com}}</span>
                            </p> 
                            <p>
                                <label>{{ Lang::get('display.tipo_correspondencia') }}</label>
                                <span class="field">{{$user->associate->asociado->tipo_correspondencia}}</span>
                            </p> 
                            <p>
                                <label>{{ Lang::get('display.voto_candidato') }}</label>
                                <span class="field">{{$user->associate->asociado->voto_candidato}}</span>
                            </p> 
                            <div class="clearfix"></div>
                    </form>
                </div><!--widgetcontent-->
            </div>
    

                
@stop


