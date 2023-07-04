<?php

namespace App\Http\Controllers;

use App\Models\Reservas;
use App\Models\Habitaciones;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ReservasController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $habitaciones=Habitaciones::all();
        return view('reservas.index', compact('habitaciones'));
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


    /**
     * function to search for the reservation according to the given data.
     */
    public function searchReservation(Request $request)
    {
        $fechaInicio = $request->input('fecha_entrada');
        $fechaFin = $request->input('fecha_salida');

        // Validar que la fecha de entrada no sea menor a la fecha actual
        $validator = Validator::make($request->all(), [
            'fecha_entrada' => 'required|date|after_or_equal:today',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Validar que la fecha de salida no sea menor a la fecha de entrada
        $validator = Validator::make($request->all(), [
            'fecha_salida' => 'required|date|after:fecha_entrada',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Realiza la búsqueda en la base de datos según las fechas proporcionadas
        $habitaciones = Habitaciones::where('estado', 1)->get();
        $reservas = Reservas::join('habitaciones', 'habitaciones.id', '=', 'reserva.habitacion_id')
        ->select('habitaciones.*')
        ->where('reserva.fecha_fin', '<', $fechaInicio)
        ->where('reserva.estado', 1)
        ->get();

        $resultado = $habitaciones->concat($reservas);


        dd($habitaciones, $reservas, $resultado);



    }


}
