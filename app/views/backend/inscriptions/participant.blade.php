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
                                <label>{{ Lang::get('display.name') }}</label>
                                <span class="field">{{$user->participant->participante->nome}}</span>
                            </p>  
                            <p>
                                <label>{{ Lang::get('display.rg') }}</label>
                                <span class="field">{{$user->participant->participante->rg}}</span>
                            </p>  
                            <p>
                                <label>{{ Lang::get('display.cpf') }}</label>
                                <span class="field">{{$user->participant->participante->cpf}}</span>
                            </p>  
                            <p>
                                <label>{{ Lang::get('display.address') }}</label>
                                <span class="field">{{$user->participant->participante->endereco}}</span>
                            </p>  
                            <p>
                                <label>{{ Lang::get('display.number') }}</label>
                                <span class="field">{{$user->participant->participante->numero}}</span>
                            </p>  
                            <p>
                                <label>{{ Lang::get('display.complement') }}</label>
                                <span class="field">{{$user->participant->participante->complemento}}</span>
                            </p>  
                            <p>
                                <label>{{ Lang::get('display.cep') }}</label>
                                <span class="field">{{$user->participant->participante->cep}}</span>
                            </p> 
                            <p>
                                <label>{{ Lang::get('display.city') }}</label>
                                <span class="field">{{$user->participant->participante->cidade}}</span>
                            </p>   
                            <p>
                                <label>{{ Lang::get('display.state') }}</label>
                                <span class="field">{{$user->participant->participante->estado}}</span>
                            </p>  
                            <p>
                                <label>{{ Lang::get('display.business') }}</label>
                                <span class="field">{{$user->participant->participante->empresa}}</span>
                            </p>  
                            <p>
                                <label>{{ Lang::get('display.cnpj') }}</label>
                                <span class="field">{{$user->participant->participante->cnpj}}</span>
                            </p> 
                            <p>
                                <label>{{ Lang::get('display.address') }} {{ Lang::get('display.business') }}</label>
                                <span class="field">{{$user->participant->participante->endereco_empresa}}</span>
                            </p>    
                            <p>
                                <label>{{ Lang::get('display.number') }} {{ Lang::get('display.business') }}</label>
                                <span class="field">{{$user->participant->participante->numero_empresa}}</span>
                            </p>    
                            <p>
                                <label>{{ Lang::get('display.complement') }} {{ Lang::get('display.business') }}</label>
                                <span class="field">{{$user->participant->participante->complemento_empresa}}</span>
                            </p>    
                            <p>
                                <label>{{ Lang::get('display.cep') }} {{ Lang::get('display.business') }}</label>
                                <span class="field">{{$user->participant->participante->cep_empresa}}</span>
                            </p>    
                            <p>
                                <label>{{ Lang::get('display.city') }} {{ Lang::get('display.business') }}</label>
                                <span class="field">{{$user->participant->participante->cidade_empresa}}</span>
                            </p>    
                            <p>
                                <label>{{ Lang::get('display.state') }} {{ Lang::get('display.business') }}</label>
                                <span class="field">{{$user->participant->participante->estado_empresa}}</span>
                            </p>       
                            <p>
                                <label>{{ Lang::get('display.email') }}</label>
                                <span class="field">{{$user->participant->participante->email}}</span>
                            </p>  
                            <p>
                                <label>{{ Lang::get('display.phone') }}</label>
                                <span class="field">{{$user->participant->participante->telefone }}</span>
                            </p> 
                            <p>
                                <label>{{ Lang::get('display.movil_phone') }}</label>
                                <span class="field">{{$user->participant->participante->celular }}</span>
                            </p> 
                            <p>
                                <label>{{ Lang::get('display.state') }}</label>
                                <span class="field">
                                    
                                    @foreach($estados as $state)
                                        @if($user->participant->participante->estado == $state->name_estado)
                                            {{$state->name_estado}}
                                        @endif
                                    @endforeach

                                </span>
                            </p>   
                            <div class="clearfix"></div>
                    </form>
                </div><!--widgetcontent-->
            </div>
    

                
@stop