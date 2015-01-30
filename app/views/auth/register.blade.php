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
    <form class="updateform" id="register-form" method="post">
    	<input type="hidden" name="usertype" value="{{$usertype->id}}"/>
    	<input type="hidden" name="course" value="{{$course->id}}"/>
    	<div class="control-box">
			<label>Nome: </label>
			<input type="text" name="nome"/><!-- 
			<input type="text" name="nome" required/> -->
		</div>
    	<div class="control-box">
			<label>Email: </label>
			<input type="email" name="email"/><!-- 
			<input type="email" name="email" required/> -->
		</div>
    	<div class="control-box">
			<label>RG: </label>
			<input type="text" name="rg"/>
		</div>
    	<div class="control-box">
			<label>CPF: </label>
			<input type="text" name="cpf" value="{{ $cpf }}"/><!-- 
			<input type="text" name="cpf" value="{{ $cpf }}" required/> -->
		</div>
    	<div class="control-box">
			<label>Endereço: </label>
			<input type="text" name="endereco"/>
		</div>
    	<div class="control-box">
			<label>N°: </label>
			<input type="text" name="numero"/>
		</div>
    	<div class="control-box">
			<label>Complemento: </label>
			<input type="text" name="complemento"/>
		</div>
    	<div class="control-box">
			<label>CEP: </label>
			<input type="text" name="cep"/>
		</div>
    	<div class="control-box">
			<label>Estado: </label>
				<select name="estado" required>
					<option value="0" selected>Selecione um estado</option>
					@foreach($estados as $state)
						<option value="{{$state->name_estado}}">{{$state->name_estado}}</option>
					@endforeach
				</select>
		</div>
    	<div class="control-box">
			<label>Cidade: </label>
			<input type="text" name="cidade"/>
		</div>
    	<div class="control-box">
			<label>Empresa: </label>
			<input type="text" name="empresa"/>
		</div>
    	<div class="control-box">
			<label>Telefone: </label>
			<input type="text" name="telefone_empresa"/>
		</div>
    	<div class="control-box">
			<label>Celular: </label>
			<input type="text" name="celular_empresa"/>
		</div>
    	<div class="control-box">
			<input type="submit" value="Enviar"/>
		</div>
		<script>
		$(document).bind('ready', function(){
			$('#register-form').bind('submit', function(e){
				e.preventDefault();
				if($('select[name=estado]').val() == 0){
					// alert($('select[name=estado]').val());
					alert('Deve selecionar um estado');
					$('select[name=estado]').focus();
					return false;
				}
				else{
					this.submit();
				}
			});
		});
		</script>
	</form>
    </div>
    </div>
	</div>

@stop
