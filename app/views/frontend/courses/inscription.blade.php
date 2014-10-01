<!-- Layout principal -->
@extends("frontend.courses.layout_destaque");

<!-- Titulo de la pagina -->
@section("title");
	Cursos
@stop
<style>
  table, th, td{
    border: 1px solid #00366c !important;
  }
</style>

<!-- Contenido principal -->
@section("maincontent")
	
	<div class="content">
		<div class="course" data-id="{{$course->id}}">
    <div class="course_title">
      <h1>{{$course->event->title}} : {{$course->title}}</h1>
      <!-- <h5 class="data-adress">Data : {{$course->start}} a {{$course->end}} - Local : {{$course->address}}</h5> -->
    </div>
    <div id="content">
      <div>
          <p>Para submeter seu trabalho, escolha uma categoria abaixo</p>
          <div></div>
          @if(count($course->usertypes) > 0)
            <table>
              <tr>
                <th>CATEGORIAS</th>
                @foreach($course->usertypes[0]->dates as $date)
                  <th>ATÉ {{date("d-m-Y", strtotime($date->end))}}</th>
                @endforeach
                  <th>INSCRIÇÕES</th>
              </tr>
            @foreach($course->usertypes as $user)
              <tr>
                <td>{{$user->title}}</td>
                @foreach($user->dates as $date)
                  <th>{{$date->price}}</th>
                @endforeach
                <td>
                @if($user->associate)
                  <a href="{{ URL::to('/autenticacao/associado/'.$user->id) }}">CLIQUE AQUI</a>
                @else
                  <a href="{{ URL::to('/autenticacao/participante/'.$user->id) }}">CLIQUE AQUI</a>
                @endif
                </td>
              </tr>
            @endforeach
            </table>
          @endif
      </div>
      
    </div>
  </div>
  </div>


@stop