@extends('frontend.associates.layout')

@section('css')

@stop

@section('content')

     <div class="row center">
          <div class="col-md-3">
               <span class="tile col-md-12 bg-light-blue">
                    <span class="title">Personal Registrado: <span>0</span></span>
                    <a href="/administrador/personal" class="content">Haga click aqui para ver todos el personal registrado</a>
               </span>
          </div>
          <div class="col-md-3">
               <span class="tile col-md-12 bg-red">
                    <span class="title">Sanciones: <span>0</span></span>
                    <a href="/administrador/sanciones" class="content">Haga click aqui para ver todos el personal registrado</a>
               </span>
          </div>
          <div class="col-md-3">
               <span class="tile col-md-12 bg-light-green">
                    <span class="title">Condecoraciones: <span>0</span></span>
                    <a href="/administrador/condecoraciones" class="content">Haga click aqui para ver todos el personal registrado</a>
               </span>
          </div>
     	<div class="col-md-3">
               <span class="tile col-md-12 bg-blue-grey">
                    <span class="title">Usuarios de Dpto: <span>0</span></span>
                    <a href="/administrador/usuarios" class="content">Haga click aqui para ver todos el personal registrado</a>
               </span>
          </div>
     </div>

@stop

@section('javascripts')

@stop