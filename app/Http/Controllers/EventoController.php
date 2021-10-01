<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use DateTime;

class EventoController extends Controller
{
    //Envia as informações para a datatable da home
    public function index()
    {
        $eventos = Evento::all();

        if (request()->ajax()) {
            return DataTables::of($eventos)
                ->addColumn('convidados', function ($data) {
                    return $data->convidados->count();
                })
                ->addColumn('action', function ($data) {
                    return '
                    <div role="group" aria-label="Basic example">
                        <a href="' . route("eventos.view", ["id" => $data->id]) . '" name="view" id="' . $data->id . '" class="btn btn-outline-primary btn-sm">Vizualizar </a>
                        <a href="' . route("eventos.edit", ["id" => $data->id]) . '" name="edit" id="' . $data->id . '" class="btn btn-outline-success btn-sm">Editar </a>
                        <a name="delete" id="' . $data->id . '" class="btn btn-outline-danger btn-sm delete-btn delete"> Excluir</a>
                    </div>
                  ';
                })
                ->rawColumns(['convidados', 'action'])
                ->make(true);
        }
        return response()->json($eventos);
    }

    //Cria o evento
    public function store(Request $request)
    {
        //Validação de campos do form
        $rules = [
            'name' => 'required',
            'description' => 'required',
            'date' => 'required',
        ];
        $messages = [
            'name.required' => 'Opa! Parece que você se esqueceu de digitar seu nome.',
            'description.required' => 'Opa! A descrição do evento é necessária.',
            'date.required' => 'Hmm... Faltou inserir a data.'
        ];

        try {
            $request->validate($rules, $messages);

            $evento = new Evento();
            $evento->name = $request->name;
            $evento->description = $request->description;
            $evento->date = $request->date;
            $evento->save();

            return response()->json(['message' => 'Cadastro realizado com sucesso']);
        } catch (\Error $err) {
            return response()->json($err, 500);
        }
    }

    //Ediação de um evento
    public function update(Request $request, $id)
    {

        //Validação de campos do form
        $rules = [
            'name' => 'required',
            'description' => 'required',
            'date' => 'required',
        ];
        $messages = [
            'name.required' => 'Opa! Parece que você se esqueceu de digitar seu nome.',
            'description.required' => 'Opa! A descrição do evento é necessária.',
            'date.required' => 'Hmm... Faltou inserir a data.'
        ];

        try {
            $evento = Evento::find($id);
            $request->validate($rules, $messages);
            $evento->name = $request->name;
            $evento->description = $request->description;
            $evento->date = $request->date;
            $evento->save();

            return response()->json(['message' => 'Edição realizada com sucesso']);
        } catch (\Error $err) {
            return response()->json($err, 500);
        }
    }

    //Exclusão de evento
    public function destroy($id)
    {
        try {
            Evento::find($id)->delete();
            return response()->json(['message' => 'Deletado com sucesso']);
        } catch (\Error $err) {
            return response()->json($err, 500);
        }
    }

    //FUNÇÕES DA WEB ROUTES

    public function show($id)
    {
        $evento = Evento::find($id);
        return view('view_evento', compact('evento', $evento));
    }

    public function edit($id)
    {
        $evento = Evento::find($id);
        return view('edit_evento', compact('evento', $evento));
    }
    
    public function create()
    {
        //Verifica se hoje já foi adicionado algum evento
        $today = new DateTime('today');
        $eventos = Evento::whereDay('created_at', $today)->get();

        if(isset($eventos[0])) {
            return redirect()->back()->with(['message' => 'Hoje já foi criado um evento. Não é possível criar mais um.']);
        }
        return view('create_evento');
    }
}
