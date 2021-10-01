@extends('layouts.master')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <h1><b>Novo Evento</b> <a href="{{ URL::previous() }}" id="voltar" class="btn btn-primary float-right">Voltar</a></h1>
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
                  <input name="name" type="text" class="form-control" id="name">
                </div>
                <div class="form-group">
                  <label for="description" class="legend">Descrição</label>
                  <textarea name="description" class="form-control" id="description" rows="3"></textarea>
                </div>
                <div class="form-group">
                  <label for="date" class="legend">Data</label>
                  <input name="date" type="date" class="form-control" id="date">
                </div>
                <br>
                <div class="form-group float-right">
                  <a id="salvar" class="btn btn-success">Salvar</a>
                  <a href="/" class="btn btn-danger">Cancelar</a>
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
    //Salva o evento
    $('#salvar').on('click', function() {
      var name = $('#name').val();
      var description = $('#description').val();
      var date = $('#date').val();
      $.ajax({
        url: '../api/eventos',
        type: "POST",
        data: {
          name: name,
          description: description,
          date: date
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
        //Pega o tipo de erro retornado da validação e insere a mensagem na tela
        error: function(err) {
          if (err.responseJSON.errors.name) {
            $('.message').html(err.responseJSON.errors.name);
            $('#error').show();
            setTimeout(function() {
              $('#error').hide();
            }, 4000);
          } else {
            if (err.responseJSON.errors.description) {
              $('.message').html(err.responseJSON.errors.description);
              $('#error').show();
              setTimeout(function() {
                $('#error').hide();
              }, 4000);
            } else {
              if (err.responseJSON.errors.date) {
                $('.message').html(err.responseJSON.errors.date);
                $('#error').show();
                setTimeout(function() {
                  $('#error').hide();
                }, 4000);
              }
            }
          }
        },
      });
    });
  </script>
@endsection
