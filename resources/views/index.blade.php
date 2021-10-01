@extends('layouts.master')

@section('content')
  <div class="c-body">
    <main class="c-main">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <h1><b>Eventos</b> <a href="{{ route('eventos.create') }}" class="btn btn-success float-right">Novo
                Evento</a></h1>
            @include('layouts.messages')
            <!-- Verifica se recebeu uma mensagem de aviso para o usuário e imprime na tela -->
            @if (\Session::has('message'))
              <div class="alert alert-danger" id="error" role="alert">
                <h4 class="alert-heading">Erro!</h4>
                <p class="message_valid">{!! \Session::get('message') !!}</p>
              </div>
            @endif
            <br>
            <div class="card p-3 card-content" style="border: solid 1px #bfc1c5">
              <div class="card-body">
                <div class="page-content container-fluid">
                  <div class="widget-body" style="background-color: #fff;">
                    <br>
                    <br>
                    <div class="table-responsive ">
                      <table class="table table-bordered datatable">
                        <thead>
                          <tr style="background-color: #e6e6e6;">
                            <th width="25%">Nome</th>
                            <th width="">Descrição</th>
                            <th width="11%">Data</th>
                            <th width="11%">Convidados</th>
                            <th width="21%" class="text-center">Ações</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td colspan="8">Nenhum registro encontrado.</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>
@endsection

@section('js')
  <script>
    //Cria datatable de eventos
    $(document).ready(function() {
      var dataTable = $('.datatable').DataTable({
        processing: true,
        serverSide: true,
        autoWidth: false,
        pageLength: 15,
        "order": [
          [0, "desc"]
        ],
        ajax: 'api/eventos',
        type: 'GET',
        language: {
          url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
        },
        columns: [{
            data: 'name',
            name: 'name'
          },
          {
            data: 'description',
            name: 'description'
          },
          {
            data: 'date',
            name: 'date',
            sClass: 'text-center'
          },
          {
            data: 'convidados',
            name: 'convidados',
            sClass: 'text-center'
          },
          {
            data: 'action',
            name: 'action',
            orderable: false,
            serachable: false,
            sClass: 'text-center'
          },
        ],
      })
    })

    //Deleta evento
    $(document).on('click', '.delete', function() {
      var id = $(this).attr('id');
      $.ajax({
        url: "../api/eventos/" + id,
        type: 'DELETE',
        data: {},
        success: function(data) {
          $('.datatable').DataTable().ajax.reload();
          $('.message').html(data.message)
          $('#success').show();
          setTimeout(function() {
            $('#success').hide();
          }, 4000);
        },
        error: function(err) {
          $('.message').html("Não é possível excluir eventos que tenham convidados adicionados.");
          $('#error').show();
          setTimeout(function() {
            $('#error').hide();
          }, 4000);
        }
      })
    })
  </script>
@endsection
