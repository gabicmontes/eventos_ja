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
                  <input name="name" type="text" class="form-control" id="name" value="{{ $convidado->name }}">
                </div>
                <div class="form-group">
                  <label for="name" class="legend">E-mail</label>
                  <input name="name" type="text" class="form-control" id="email" value="{{ $convidado->email }}" disabled>
                  <label for="name" class="legend">Não é permitido alterar o e-mail do  convidado</label>
                </div>
                <br>
                <div class="form-group float-right">
                  <a id="salvar" class="btn btn-success">Salvar</a>
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

@section('js')
  <script>

    //Salva as edições do convidado
    $('#salvar').on('click', function() {
      var id = '{{ $convidado->id }}';
      var name = $('#name').val();
      $.ajax({
        url: "../../api/convidados/"+id,
        type: "PUT",
        data: {
          name: name,
        },
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
          $('.message').html(data.message)
          $('#success').show();
          setTimeout(function() {
            $('#success').hide();
          }, 4000);
        },
        error: function(err) {
          if (err.responseJSON.errors) {
            $('.message').html(err.responseJSON.errors);
            $('#error').show();
            setTimeout(function() {
              $('#error').hide();
            }, 4000);
          } 
        },
      });
    });
  </script>
@endsection
