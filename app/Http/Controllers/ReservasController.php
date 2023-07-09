<?php

namespace App\Http\Controllers;

use App\Models\Reservas;
use App\Models\Habitaciones;
use App\Models\Clientes;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class ReservasController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tipoDocumento=DB::table('tipo_documentos')
        ->where('estado', '=', 1)
        ->get();
        $habitaciones=Habitaciones::all();
        return view('reservas.index', compact('habitaciones','tipoDocumento'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
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
            'fecha_salida' => 'required|date|after_or_equal:fecha_entrada',
            'num_personas' => 'required|numeric|min:1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $tipoDocumento=DB::table('tipo_documentos')
        ->where('estado', '=', 1)
        ->get();

        //busqueda de habitaciones disponibles segun el cupo, fecha inicio, fecha fin y estado de la misma
        $habitacionesDisponibles = Habitaciones::where('cupo', '>=', $cupo)
        ->whereNotIn('id', function ($query) use ($fechaInicio, $fechaFin) {
            $query->select('habitacion_id')
                ->from('reserva')
                ->where('estado', 1)
                ->where(function ($query) use ($fechaInicio, $fechaFin) {
                    $query->where('fecha_fin', '>=', $fechaInicio)
                        ->where('fecha_inicio', '<=', $fechaFin);
                });
        })
        ->get();

        $availables =  $habitacionesDisponibles;

        return view('reservas.index', ['availables' => $availables, 'fechaInicio' => $fechaInicio, 'fechaFin' => $fechaFin, 'cupo' => $cupo, 'tipoDocumento' => $tipoDocumento]);

    }

    public function guardarCliente(Request $request)
    {

            //obtener el N° de dias
            $fechaInicio = $request->input('fechaInicio');
            $fechaFin = $request->input('fechaFin');
            $inicio = Carbon::createFromFormat('Y-m-d', $fechaInicio);
            $fin = Carbon::createFromFormat('Y-m-d', $fechaFin);
            $numDias = $inicio->diffInDays($fin);

            //validar si es un cliente nuevo
            $cliente_id = $request->input('idclientereserva');
            if (is_null($cliente_id)) {
                $validator = Validator::make($request->all(), [
                    'nombrecliente' => 'required|min:3',
                    'apellidocliente' => 'required|min:3',
                    'tipo_documento_id' => 'required',
                    'documentocliente' => 'required|min:5|unique:clientes,documento',
                    'emailcliente' => 'required|email|unique:clientes,email',
                    'fecha_nacimientocliente' => 'required',
                ]);

                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }

                $clientes=new Clientes;
                $clientes->nombre=$request->input('nombrecliente');
                $clientes->apellido=$request->input('apellidocliente');
                $clientes->tipo_documento_id=$request->input('tipo_documento_id');
                $clientes->documento=$request->input('documentocliente');
                $clientes->email=$request->input('emailcliente');
                $clientes->fecha_nacimiento=$request->input('fecha_nacimientocliente');
                $clientes->save();

                $cliente_id = $clientes->id;
            }

            $reserva=new Reservas;
            $reserva->habitacion_id=$request->input('idhabitacion');
            $reserva->dias=$numDias;
            $reserva->fecha_inicio=$fechaInicio;
            $reserva->fecha_fin=$fechaFin;
            $reserva->cliente_id=$cliente_id;
            $reserva->empleado_id=Auth::user()->id;
            $reserva->save();

            //editar el estado de la habitacion reservada
            $habitaciones=Habitaciones::find($request->input('idhabitacion'));
            $habitaciones->estado=0;
            $habitaciones->update();

            //redireccionar a  listado de reservas
            return redirect('reservas-listareservas');

    }

    public function buscarCliente(Request $request)
    {
        $searchTerm = $request->input('search');

        // Realiza la lógica de búsqueda de clientes en tu base de datos
        $resultados = Clientes::where('documento', $searchTerm)->get();

        if ($resultados) {
          // Devuelve los resultados como una respuesta JSON
          return response()->json($resultados);
        } else {
          // No se encontraron resultados
          return response()->json();
        }
    }

    public function listaReservas()
    {
        $reservas = Reservas::where('estado', 1)
                ->orderBy('id', 'desc')
                ->paginate(8);
        $modelCliente = new Clientes();
        $modelHabitacion = new Habitaciones();
        $modelUser = new User();

        return view('reservas.listareservas', ['reservas' => $reservas,'modelCliente' => $modelCliente,'modelHabitacion' => $modelHabitacion,'modelUser' => $modelUser]);
    }


}
