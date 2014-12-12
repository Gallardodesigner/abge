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
      <h1>{{$course->title}}</h1>
      <!-- <h5 class="data-adress">Data : {{$course->start}} a {{$course->end}} - Local : {{$course->address}}</h5> -->
    </div>
    <div id="content">
      <div>
          
            {{ $section->content }}
          <div class="content">
          </div>
              
          @if(count($course->usertypes) > 0)
            <table>
              
            @foreach($course->usertypes as $user)
              <tr>
              @if($user->associate)
                  <td><a href="{{ URL::to('/autenticacao/trabalhoassociado/'.$user->id) }}">{{$user->title}}</a>
                  </td>
              @else
                  <td>
                    <a href="{{ URL::to('/autenticacao/trabalhoparticipante/'.$user->id) }}">{{$user->title}}</a>
                  </td>
              @endif
              </tr>
            @endforeach
            </table>
          @endif
      </div>
      
    </div>
	</div>
</div>

@stop