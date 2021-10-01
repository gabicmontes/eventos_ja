<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Convidado;
use Yajra\DataTables\Facades\DataTables;

class ConvidadoController extends Controller
{
    //Envia as informações para a datatable com convidados do evento referenciado pelo $id
    public function index($id)
    {
        $convidados = Convidado::where('evento_id', $id);
        if (request()->ajax()) {
            return DataTables::of($convidados)
                ->addColumn('action', function ($data) {
                    return '
                    <div role="group" aria-label="Basic example">
                        <a name="delete" id="' . $data->id . '" class="btn btn-outline-danger btn-sm delete-btn delete"> Excluir</a>
                        <a href="' . route("convidados.edit", ["id" => $data->id]) . '" name="edit" id="' . $data->id . '" class="btn btn-outline-success btn-sm">Editar </a>
                        <a href="' . route("convidados.view", ["id" => $data->id]) . '" name="view" id="' . $data->id . '" class="btn btn-outline-primary btn-sm">Vizualizar </a>
           
                    </div>
                  ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return response()->json($convidados);
        
    }

    //Cria novo convidado para o evento
    public function store(Request $request)
    {
        //Validação de campos do form
        $rules = [
            'name' => 'required',
            'email' => 'required',
            'email_confirm' => 'required|same:email',
        ];
        $messages = [
            'name.required' => 'Opa! Parece que você se esqueceu de digitar seu nome.',
            'email.required' => 'Você precisa digitar seu email.',
            'email_confirm.required' => 'Você esqueceu de digitar a confirmação de e-mail.',
            'email_confirm.same' => 'Humm.. Os e-mails não conferem. Tente novamente.'
        ];

        try {
            $request->validate($rules, $messages);

            $convidado = new Convidado();
            $convidado->evento_id = $request->evento_id;
            $convidado->name = $request->name;
            $convidado->email = $request->email;
            $convidado->save();

            return response()->json(['message' => 'Convidado adicionado com sucesso']);
        } catch (\Error $err) {
            return response()->json($err, 500);
        }
    }

    //Edita convidado
    public function update(Request $request, $id)
    {
        //Validação de campos do form
        $rules = [
            'name' => 'required',
        ];
        $messages = [
            'name.required' => 'Opa! Parece que você se esqueceu de digitar seu nome.',
        ];

        try {
            $request->validate($rules, $messages);

            $convidado = Convidado::find($id);
            $convidado->name = $request->name;
            $convidado->save();

            return response()->json(['message' => 'Convidado editado com sucesso']);
        } catch (\Error $err) {
            return response()->json($err, 500);
        }
    }

    //Deleta convidado do evento
    public function destroy($id)
    {
        Convidado::find($id)->delete();

        return response()->json(['message' => 'Deletado com sucesso']);
    }    

    //FUNÇÕES DA WEB ROUTES

    public function create($id)
    {
        return view('create_convidado', compact('id'));
    }

    public function show($id)
    {
        $convidado = Convidado::find($id);
        return view('view_convidado', compact('convidado', $convidado));
    }

    public function edit($id)
    {
        $convidado = Convidado::find($id);
        return view('edit_convidado', compact('convidado', $convidado));
    }
}
