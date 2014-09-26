<!-- Layout principal -->
@extends("frontend.courses.layout_destaque");

<!-- Titulo de la pagina -->
@section("title");
	Cursos
@stop

<!-- Contenido principal -->
@section("maincontent")
	<div class="columna_central_home">
		<div class="course" data-id="{{$course->id}}">
    <div class="course_title">
      <h1>{{$course->event->title}} : {{$course->title}}</h1>
      <h5>Data : {{$course->start}} a {{$course->end}} - Local : {{$course->address}}</h5>
    </div>
    <div id="content">
    <form method="post">
    	<input type="hidden" name="usertype" value="{{$usertype->id}}"/>
    	<input type="hidden" name="course" value="{{$course->id}}"/>
    	@if($inscription->user->type == 'associate')
    		<input type="hidden" name="id" value="{{$participant->id_asociado}}"/>
    	@else
    		<input type="hidden" name="id" value="{{$participant->id_participante}}"/>
    	@endif
    	<input type="hidden" name="inscription" value="{{$inscription->id}}"/>
		<label>Nome: </label><input type="text" name="nombre_completo" value="{{ $participant->nombre_completo }}"/><br>
		<label>Razon Social: </label><input type="text" name="razon_social" value="{{ $participant->razon_social }}"/><br>
		<label>Inscripcion Estaduak: </label><input type="text" name="inscription_estadual" value="{{ $participant->inscription_estadual }}"/><br>
		<label>Inscripcion Municipal: </label><input type="text" name="inscription_municipal" value="{{ $participant->inscription_municipal }}"/><br>
		<label>Tipo Pessoa: </label>
			<select name="estado">
				<option value="F" {{ $participant->tipo_pessoa == 'F' ? 'selected' : '' }}>F</option>
				<option value="J" {{ $participant->tipo_pessoa == 'J' ? 'selected' : '' }}>J</option>
			</select>
			<br>
		<label>CPF: </label><input type="text" name="cpf" value="{{ $participant->cpf }}"/><br>
		<label>CNPJ: </label><input type="text" name="cnpj" value="{{ $participant->cnpj }}"/><br>
		<label>Passaporte: </label><input type="text" name="passaporte" value="{{ $participant->passaporte }}"/><br>
		<label>Email: </label><input type="email" name="email" value="{{ $participant->email }}"/><br>
		<label>Web Site: </label><input type="text" name="web_site" value="{{ $participant->web_site }}"/><br>
		<label>Resposavel: </label><input type="text" name="responsavel" value="{{ $participant->responsavel }}"/><br>
		<label>Observacao: </label><input type="text" name="observacao" value="{{ $participant->observacao }}"/><br>
		<label>Empresa: </label><input type="text" name="empresa" value="{{ $participant->empresa }}"/><br>
		<label>Cargo: </label><input type="text" name="cargo" value="{{ $participant->cargo }}"/><br>
		<label>CEP Res: </label><input type="text" name="cep_res" value="{{ $participant->cep_res }}"/><br>
		<label>CEP Com: </label><input type="text" name="cep_com" value="{{ $participant->cep_com }}"/><br>
		<label>Logradouro Res: </label><input type="text" name="logradouro_res" value="{{ $participant->logradouro_res }}"/><br>
		<label>Logradouro Com: </label><input type="text" name="logradouro_com" value="{{ $participant->logradouro_com }}"/><br>
		<label>Dir Res: </label><input type="text" name="dir_res" value="{{ $participant->dir_res }}"/><br>
		<label>Dir Com: </label><input type="text" name="dir_com" value="{{ $participant->dir_com }}"/><br>
		<label>Complemento Res: </label><input type="text" name="complemento_res" value="{{ $participant->complemento_res }}"/><br>
		<label>Complemento Com: </label><input type="text" name="complemento_com" value="{{ $participant->complemento_com }}"/><br>
		<label>Numero Res: </label><input type="text" name="numero_res" value="{{ $participant->numero_res }}"/><br>
		<label>Numero Com: </label><input type="text" name="numero_com" value="{{ $participant->numero_com }}"/><br>
		<label>Bairro Res: </label><input type="text" name="bairro_res" value="{{ $participant->bairro_res }}"/><br>
		<label>Bairro Com: </label><input type="text" name="bairro_com" value="{{ $participant->bairro_com }}"/><br>
		<label>Pais Res: </label><input type="text" name="pais_res" value="{{ $participant->pais_res }}"/><br>
		<label>Pais Com: </label><input type="text" name="pais_com" value="{{ $participant->pais_com }}"/><br>
		<label>Municipio Res: </label><input type="text" name="municipio_res" value="{{ $participant->municipio_res }}"/><br>
		<label>Municipio Com: </label><input type="text" name="municipio_com" value="{{ $participant->municipio_com }}"/><br>
		<label>UF Res: </label><input type="text" name="uf_res" value="{{ $participant->uf_res }}"/><br>
		<label>UF Com: </label><input type="text" name="uf_com" value="{{ $participant->uf_com }}"/><br>
		<label>DDI Res: </label><input type="text" name="ddi_res" value="{{ $participant->ddi_res }}"/><br>
		<label>DDI Com: </label><input type="text" name="ddi_com" value="{{ $participant->ddi_com }}"/><br>
		<label>DDD Res: </label><input type="text" name="ddd_res" value="{{ $participant->ddd_res }}"/><br>
		<label>DDD Com: </label><input type="text" name="ddd_com" value="{{ $participant->ddd_com }}"/><br>
		<label>DDI Res 2: </label><input type="text" name="ddi_two_res" value="{{ $participant->ddi_two_res }}"/><br>
		<label>DDI Com 2: </label><input type="text" name="ddi_two_com" value="{{ $participant->ddi_two_com }}"/><br>
		<label>DDD Res 2: </label><input type="text" name="ddd_two_res" value="{{ $participant->ddd_two_res }}"/><br>
		<label>DDD Com 2: </label><input type="text" name="ddd_two_com" value="{{ $participant->ddd_two_com }}"/><br>
		<label>DDI Cel Res: </label><input type="text" name="ddi_cel_res" value="{{ $participant->ddi_cel_res }}"/><br>
		<label>DDI Cel Com: </label><input type="text" name="ddi_cel_com" value="{{ $participant->ddi_cel_com }}"/><br>
		<label>DDD Cel Res: </label><input type="text" name="ddd_cel_res" value="{{ $participant->ddd_cel_res }}"/><br>
		<label>DDD Cel Com: </label><input type="text" name="ddd_cel_com" value="{{ $participant->ddd_cel_com }}"/><br>
		<label>Telefone Res: </label><input type="text" name="telefone_res" value="{{ $participant->telefone_res }}"/><br>
		<label>Telefone Com: </label><input type="text" name="telefone_com" value="{{ $participant->telefone_com }}"/><br>
		<label>Telefone Res 2: </label><input type="text" name="telefone_seg_res" value="{{ $participant->telefone_seg_res }}"/><br>
		<label>Telefone Com 2: </label><input type="text" name="telefone_seg_com" value="{{ $participant->telefone_seg_com }}"/><br>
		<label>Celular Res: </label><input type="text" name="celular_res" value="{{ $participant->celular_res }}"/><br>
		<label>Celular Com: </label><input type="text" name="celular_com" value="{{ $participant->celular_com }}"/><br>
		<input type="submit" value="Enviar"/>
	</form>
    </div>
    </div>
	</div>

@stop
