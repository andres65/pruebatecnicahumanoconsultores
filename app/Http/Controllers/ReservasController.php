<?php

namespace App\Http\Controllers;

use App\Models\Reservas;
use App\Models\Habitaciones;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $cupo = $request->input('num_personas');

        // Validar que la fecha de entrada no sea menor a la fecha actual
        $validator = Validator::make($request->all(), [
            'fecha_entrada' => 'required|date|after_or_equal:today',
            'fecha_salida' => 'required|date|after:fecha_entrada',
            'num_personas' => 'required|numeric|min:1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Realiza la búsqueda en la base de datos según las fechas proporcionadas
        $habitaciones = DB::table('habitaciones')
                ->where('estado', 1)
                ->where('cupo', '>=', $cupo)
                ->get();

        $reservas = Reservas::join('habitaciones', 'habitaciones.id', '=', 'reserva.habitacion_id')
                ->select('habitaciones.*')
                ->where('reserva.fecha_fin', '<', $fechaInicio)
                ->where('reserva.estado', 1)
                ->where('habitaciones.cupo', '>=', $cupo)
                ->get();

        $availables = $habitaciones->concat($reservas);

        //dd($habitaciones, $reservas, $availables);

        return view('reservas.index', ['availables' => $availables, 'fechaInicio' => $fechaInicio, 'fechaFin' => $fechaFin, 'cupo' => $cupo]);

    }


}
