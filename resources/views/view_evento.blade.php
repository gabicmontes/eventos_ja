@extends('layouts.master')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <h1><b>Evento</b> <a href="{{ URL::previous() }}" id="voltar" class="btn btn-primary float-right">Voltar</a></h1>
      @include('layouts.messages')
      <br>
      <div class="card p-3 card-content" style="border: solid 1px #bfc1c5">
        <div class="card-body">
          <div class="page-content container-fluid">
            <div class="widget-body" style="background-color: #fff;">
              <form class="app_form" id="form_edit" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label for="name" class="legend">Nome</label>
                  <input name="name" type="text" class="form-control" id="name" value="{{ $evento->name }}" disabled>
                </div>
                <div class="form-group">
                  <label for="description" class="legend">Descrição</label>
                  <textarea name="description" class="form-control" id="description" rows="3"
                    disabled>{{ $evento->description }}</textarea>
                </div>
                <div class="form-group">
                  <label for="date" class="legend">Data</label>
                  <input name="date" type="date" class="form-control" id="date" value="{{ $evento->date }}" disabled>
                </div>
                <br>
                <div class="form-group float-right">
                  <a href="{{ route('eventos.edit', ['id' => $evento->id]) }}" class="btn btn-success">Editar</a>
                  <a href="/" class="btn btn-danger">Voltar</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <br>
      <br>
      <h3><b>Convidados</b></h3>
      <br>
      <div class="card p-3 card-content" style="border: solid 1px #bfc1c5">
        <div class="card-body">
          <div class="page-content container-fluid">
            <div class="widget-body" style="background-color: #fff;">
              <div class="table-responsive ">
                <table class="table table-bordered datatable">
                  <thead>
                    <tr style="background-color: #e6e6e6;">
                      <th width="25%">Nome</th>
                      <th width="">E-mail</th>
                      <th width="30%" class="text-center">Ações</th>
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

@endsection

@section('js')
  <script>
    //Datatable com os convidados do evento
    $(document).ready(function() {
      var id = '{{$evento->id}}';
      var dataTable = $('.datatable').DataTable({
        processing: true,
        serverSide: true,
        autoWidth: false,
        pageLength: 15,
        "order": [
          [0, "desc"]
        ],
        ajax: '../../api/convidados/index/'+id,
        type: 'GET',
        language: {
          url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
        },
        columns: [{
            data: 'name',
            name: 'name'
          },
          {
            data: 'email',
            name: 'email'
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

    //Detela convidados do evento
    $(document).on('click','.delete',function(){
      var id = $(this).attr('id');
      $.ajax({
        url: "../../api/convidados/" + id,
        type: 'DELETE',
        data: {
        },
        success: function(data) {
          $('.datatable').DataTable().ajax.reload();
          $('.message').html(data.message)
          $('#success').show();
          setTimeout(function() {
            $('#success').hide();
          }, 4000);
          location.reload();
        },
        error: function(err) {
          $('.message').html(err.responseJSON.errors);
            $('#error').show();
            setTimeout(function() {
              $('#error').hide();
            }, 4000);
        }
      })
    })
    

  </script>
@endsection
