<!-- Layout principal -->
@extends("frontend.courses.layout_destaque");

<!-- Titulo de la pagina -->
@section("title");
	Cursos
@stop

<!-- Contenido principal -->
@section("maincontent")
	<div class="content">
		<div class="course" data-id="{{$course->id}}">
    <div class="course_title">
      <h1>{{$course->event->title}} : {{$course->title}}</h1>
      <!-- <h5>Data : {{$course->start}} a {{$course->end}} - Local : {{$course->address}}</h5> -->
    </div>
    <div id="content">
    <form class="updateform" method="post">
    	<input type="hidden" name="usertype" value="{{$usertype->id}}"/>
    	<input type="hidden" name="course" value="{{$course->id}}"/>
    	@if($inscription->user->type == 'associate')
    		<input type="hidden" name="id" value="{{$participant->id_asociado}}"/>
    	@else
    		<input type="hidden" name="id" value="{{$participant->id_participante}}"/>
    	@endif
    	<input type="hidden" name="inscription" value="{{$inscription->id}}"/>
		<div class="control-box">
			<label>Nome: </label>
			<input type="text" name="nome" value="{{ $participant->nome }}"/>
		</div>
		<div class="control-box">
			<label>RG: </label>
			<input type="text" name="rg" value="{{ $participant->rg }}"/>
		</div>
		<div class="control-box">
			<label>Formação Profissional: </label>
			<select name="formacao">
				<option value="0" selected>Seleccione uma formação</option>
				@foreach($formacoes as $formacao)
					@if($participant->formacao == $formacao->id)
						<option value="{{$formacao->id}}" selected>{{$formacao->nome}}</option>
					@else
						<option value="{{$formacao->id}}">{{$formacao->nome}}</option>
					@endif
				@endforeach
			</select>
		</div>
		<div class="control-box">
			<label>Empresa: </label>
			<input type="text" name="empresa" value="{{ $participant->empresa }}"/>
		</div>
		<div class="control-box">
			<label>Email: </label>
			<input type="email" name="email" value="{{ $participant->email }}"/>
		</div>
		
		<div class="control-box">
			<input type="submit" value="Enviar"/>
		</div>
	</form>
    </div>
    </div>
	</div>

@stop
