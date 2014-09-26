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
      <h5 class="data-adress">Data : {{$course->start}} a {{$course->end}} - Local : {{$course->address}}</h5>
    </div>
    <div id="content">
      <div>
        
          @if(count($course->usertypes) > 0)
            <table>
              <tr>
                <th>{{Lang::get('display.usertype')}}</th>
                @foreach($course->usertypes[0]->dates as $date)
                  <th>{{Lang::get('display.until')}} {{date("d-m-Y", strtotime($date->end))}}</th>
                @endforeach
                  <th>{{Lang::get('inscription_link')}}</th>
              </tr>
            @foreach($course->usertypes as $user)
              <tr>
                <td>{{$user->title}}</td>
                @foreach($user->dates as $date)
                  <th>{{$date->price}}</th>
                @endforeach
                <td>
                @if($user->associate)
                  <a href="{{ URL::to('/auth/associate/'.$user->id) }}">{{Lang::get('display.signin')}}</a>
                @else
                  <a href="{{ URL::to('/auth/participant/'.$user->id) }}">{{Lang::get('display.signin')}}</a>
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