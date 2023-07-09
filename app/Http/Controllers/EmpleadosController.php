<?php

namespace App\Http\Controllers;

use App\Models\Empleados;
use App\Models\TipoDocumentos;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class EmpleadosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $empleados = DB::table('empleados')
                ->where('estado', '=', 1)
                ->paginate(8);

        $tipoDocumento=DB::table('tipo_documentos')
        ->where('estado', '=', 1)
        ->get();

        $modeldocumento = new TipoDocumentos();

        return view('empleados.index', compact('empleados', 'tipoDocumento', 'modeldocumento'));
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
            'documento' => 'required|min:5|unique:empleados,documento',
            'email' => 'required|email|unique:empleados,email',
            'fecha_nacimiento' => 'required',
            'rol' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $empleados=new Empleados;
        $empleados->nombre=$request->input('nombre');
        $empleados->apellido=$request->input('apellido');
        $empleados->tipo_documento_id=$request->input('tipo_documento_id');
        $empleados->documento=$request->input('documento');
        $empleados->email=$request->input('email');
        $empleados->fecha_nacimiento=$request->input('fecha_nacimiento');
        $empleados->rol=$request->input('rol');
        $empleados->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Empleados $empleados)
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
            'rol' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $empleados=Empleados::find($id);
        $empleados->nombre=$request->input('nombre');
        $empleados->apellido=$request->input('apellido');
        $empleados->tipo_documento_id=$request->input('tipo_documento_id');
        $empleados->documento=$request->input('documento');
        $empleados->email=$request->input('email');
        $empleados->fecha_nacimiento=$request->input('fecha_nacimiento');
        $empleados->rol=$request->input('rol');
        $empleados->update();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $empleados=Empleados::find($id);
        $empleados->estado = 0;
        $empleados->update();

        return redirect()->back();
    }
}
