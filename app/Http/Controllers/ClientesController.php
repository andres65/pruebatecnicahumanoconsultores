<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use App\Models\TipoDocumentos;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
      /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = DB::table('clientes')
                ->where('estado', '=', 1)
                ->get();
        $tipoDocumento=DB::table('tipo_documentos')
        ->where('estado', '=', 1)
        ->get();

        $modeldocumento = new TipoDocumentos();

        return view('clientes.index', compact('clientes', 'tipoDocumento', 'modeldocumento'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|min:3',
            'apellido' => 'required|min:3',
            'tipo_documento_id' => 'required',
            'documento' => 'required|min:5|unique:clientes,documento',
            'email' => 'required|email|unique:clientes,email',
            'fecha_nacimiento' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $clientes=new Clientes;
        $clientes->nombre=$request->input('nombre');
        $clientes->apellido=$request->input('apellido');
        $clientes->tipo_documento_id=$request->input('tipo_documento_id');
        $clientes->documento=$request->input('documento');
        $clientes->email=$request->input('email');
        $clientes->fecha_nacimiento=$request->input('fecha_nacimiento');
        $clientes->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Clientes $clientes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|min:3',
            'apellido' => 'required|min:3',
            'tipo_documento_id' => 'required',
            'documento' => 'required|min:5',
            'email' => 'required|email',
            'fecha_nacimiento' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $clientes=Clientes::find($id);
        $clientes->nombre=$request->input('nombre');
        $clientes->apellido=$request->input('apellido');
        $clientes->tipo_documento_id=$request->input('tipo_documento_id');
        $clientes->documento=$request->input('documento');
        $clientes->email=$request->input('email');
        $clientes->fecha_nacimiento=$request->input('fecha_nacimiento');
        $clientes->update();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $clientes=Clientes::find($id);
        $clientes->estado = 0;
        $clientes->update();

        return redirect()->back();
    }

}
