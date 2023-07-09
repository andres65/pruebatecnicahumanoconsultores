<?php

namespace App\Http\Controllers;

use App\Models\TipoDocumentos;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class TipoDocumentosController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tipoDocumento=TipoDocumentos::paginate(5);
        return view('tipo_documento.index', compact('tipoDocumento'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|min:3',
            'estado' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $tipoDocumento=new TipoDocumentos;
        $tipoDocumento->nombre=$request->input('nombre');
        $tipoDocumento->estado=$request->input('estado');
        $tipoDocumento->observaciones=$request->input('observaciones');
        $tipoDocumento->save();

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|min:3',
            'estado' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $tipoDocumento=TipoDocumentos::find($id);
        $tipoDocumento->nombre=$request->input('nombre');
        $tipoDocumento->estado=$request->input('estado');
        $tipoDocumento->observaciones=$request->input('observaciones');
        $tipoDocumento->update();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tipoDocumento=TipoDocumentos::find($id);
        $tipoDocumento->delete();

        return redirect()->back();
    }

}
