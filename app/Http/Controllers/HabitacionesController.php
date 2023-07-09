<?php

namespace App\Http\Controllers;

use App\Models\Habitaciones;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class HabitacionesController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $habitaciones=Habitaciones::paginate(8);
        return view('habitaciones.index', compact('habitaciones'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|min:3',
            'estado' => 'required',
            'cupo' => 'required|min:1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $habitaciones=new Habitaciones;
        $habitaciones->nombre=$request->input('nombre');
        $habitaciones->estado=$request->input('estado');
        $habitaciones->cupo=$request->input('cupo');
        $habitaciones->observaciones=$request->input('observaciones');
        $habitaciones->save();

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
            'cupo' => 'required|min:1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $habitaciones=Habitaciones::find($id);
        $habitaciones->nombre=$request->input('nombre');
        $habitaciones->estado=$request->input('estado');
        $habitaciones->cupo=$request->input('cupo');
        $habitaciones->observaciones=$request->input('observaciones');
        $habitaciones->update();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $habitaciones=Habitaciones::find($id);
        $habitaciones->delete();

        return redirect()->back();
    }

}
