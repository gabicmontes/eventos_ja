@extends('layouts.master')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <h1><b>Adicionar Convidado</b> <a href="{{ URL::previous() }}" id="voltar" class="btn btn-primary float-right">Voltar</a></h1>
      @include('layouts.messages')
      <br>
      <div class="card p-3 card-content" style="border: solid 1px #bfc1c5">
        <div class="card-body">
          <div class="page-content container-fluid">
            <div class="widget-body" style="background-color: #fff;">
              <form class="app_form" id="form_create" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label for="name" class="legend">Nome</label>
                  <input name="name" type="text" class="form-control" id="name" value="{{ $convidado->name }}" disabled>
                </div>
                <div class="form-group">
                  <label for="name" class="legend">E-mail</label>
                  <input name="name" type="text" class="form-control" id="email" value="{{ $convidado->email }}" disabled>
                </div>
                <br>
                <div class="form-group float-right">
                  <a href="{{ route('convidados.edit', ['id' => $convidado->id]) }}" class="btn btn-success">Editar</a>
                  <a href="../../view/{{$convidado->evento_id}}" class="btn btn-danger">Cancelar</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
