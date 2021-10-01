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
                  <input name="name" type="text" class="form-control" id="name">
                </div>
                <div class="form-group">
                  <label for="name" class="legend">E-mail</label>
                  <input name="name" type="text" class="form-control" id="email">
                </div>
                <div class="form-group">
                  <label for="name" class="legend">Confirmação de E-mail</label>
                  <input name="name" type="text" class="form-control" id="email_confirm">
                </div>
                <br>
                <div class="form-group float-right">
                  <a id="salvar" class="btn btn-success">Salvar</a>
                  <a href="{{ URL::previous() }}" class="btn btn-danger">Cancelar</a>
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
    //Adiciona (cria) convidado no evento
    $('#salvar').on('click', function() {
      var evento_id = '{{ $id }}';
      var name = $('#name').val();
      var email = $('#email').val();
      var email_confirm = $('#email_confirm').val();
      $.ajax({
        url: "../../api/convidados",
        type: "POST",
        data: {
          name: name,
          email: email,
          email_confirm: email_confirm,
          evento_id: evento_id
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
            if (err.responseJSON.errors.email) {
              $('.message').html(err.responseJSON.errors.email);
              $('#error').show();
              setTimeout(function() {
                $('#error').hide();
              }, 4000);
            } else {
              if (err.responseJSON.errors.email_confirm) {
                $('.message').html(err.responseJSON.errors.email_confirm);
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
