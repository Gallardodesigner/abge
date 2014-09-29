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
      <!-- <h5 class="data-adress">Data : {{$course->start}} a {{$course->end}} - Local : {{$course->address}}</h5> -->
    </div>
    <div id="content">
      <div>
        
          @if(count($course->usertypes) > 0)
            <table>
              
            @foreach($course->usertypes as $user)
              <tr>
                <td>{{$user->title}}</td>
                
                <td>
                <td>
                  
                </td>
                <td></td>
                @if($user->associate)
                  <a href="{{ URL::to('/auth/workassociate/'.$user->id) }}">{{Lang::get('display.submit_your_work')}}</a>
                @else
                  <a href="{{ URL::to('/auth/workparticipant/'.$user->id) }}">{{Lang::get('display.submit_your_work')}}</a>
                @endif
                </td>
              </tr>
            @endforeach
            </table>
          @endif
      </div>
      
    </div>
	</div>


@stop