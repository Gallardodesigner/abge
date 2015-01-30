<!-- Layout principal -->
@extends("frontend.courses.layout_destaque")

<!-- Titulo de la pagina -->
@section("title")
	Cursos
@stop
<style>
  table, th, td{
    border: 1px solid #00366c !important;
  }
  .texto_inscriptions{
    margin-bottom: 30px;

  }
  .texto_inscriptions ul{
    margin-left: 20px;
  }
  .texto_inscriptions ul li{

    line-height: 1.5;
  }

</style>

<!-- Contenido principal -->
@section("maincontent")
	
	<div class="content">
		<div class="course" data-id="{{$course->id}}">
    <div class="course_title">
      <h1>{{$course->title}}</h1>
      <!-- <h5 class="data-adress">Data : {{$course->start}} a {{$course->end}} - Local : {{$course->address}}</h5> -->
    </div>
    <div id="content">
      <div>

          <div class="content">

          <div class="texto_inscriptions">
 
            {{ $section->content }}

          </div>
          <?php //dd($course->usertypes[1]) ?>
          @if(count($course->usertypes) > 0 && $course->usertypes[0]->status != 'draft')
            <table>
              <tr>
                <th>CATEGORIAS</th>
                @foreach($course->usertypes[0]->dates as $date)
                  <th>ATÉ {{date("d-m-Y", strtotime($date->end))}}</th>
                @endforeach
                  <th>INSCRIÇÕES</th>
              </tr>
            @foreach($course->usertypes as $user)
            @if($user->status != 'draft')
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
            @endif
            @endforeach
            </table>
          @endif
      </div>
      
    </div>
  </div>
  </div>
  </div>

@stop