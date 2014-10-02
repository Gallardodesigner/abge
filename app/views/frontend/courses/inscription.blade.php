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
  .texto_inscriptions{
    margin-bottom: 30px;
    font-size: 11pt;
    font-family: "Trebuchet MS";
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
      <h1>{{$course->event->title}} : {{$course->title}}</h1>
      <!-- <h5 class="data-adress">Data : {{$course->start}} a {{$course->end}} - Local : {{$course->address}}</h5> -->
    </div>
    <div id="content">
      <div>
          <div class="texto_inscriptions">
            <p >As inscrições para o 9o SBCGG deverão ser efetuadas para efetivar a aceitação do Artigo e sua 

publicação nos anais do evento.</p>

<p>Observações Importantes</p>
<ul>
<li>Serão considerados sócios aqueles que estiverem com a anuidade de 2014 quitada no 

ato da inscrição.</li>

<li>Os estudantes de graduação e pós graduação deverão comprovar essa situação

através de documento oficial, encaminhado por e-mail ou apresentado no ato da 

retirada do material.</li>

<li>Após o dia 16/03/2015 as inscrições somente poderão ser feitas no local do Congresso.</li> 

<li>Cancelamentos de inscrição somente serão aceitos até 30 dias antes do início do 

Congresso e a devolução corresponderá a 80% do valor pago.</li>

<li>Notas de empenhos somente serão aceitas até 06/03/2015, quando deverão ser 

substituídas pelo pagamento efetivo. O não pagamento até esta data implicará no 

cancelamento da inscrição.</li>
</ul>
          </div>
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