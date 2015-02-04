
<div style="margin-left: 5em;display:inline-block">
    <p>
        <b>Tipo de graduação:</b> 
        <span id="tipo_graduacion_{{$academic->id_datos_acad}}">
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