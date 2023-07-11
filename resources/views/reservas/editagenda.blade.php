<!-- Modal -->
<div class="modal fade" id="editagenda{{$reserva->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">EDITAR RESERVAR #<strong> {{$reserva->id}} </strong></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

        <form method="POST" action="{{ url('/reservas/' . $reserva->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}
            <div class="modal-body">

                <div class="mb-3">
                    <label for="" class="form-label">ESTADO</label>
                    <select class="form-control" name="estado" id="estado">
                        <option value='1' @selected("1" == $reserva->estado)>ACTIVO</option>
                        <option value='0' @selected("0" == $reserva->estado)>INACTIVO</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">HABITACIÓN</label>
                    <input type="text" class="form-control" name="habitacion_id" id="" aria-describedby="helpId" placeholder="" value="{{$modelHabitacion->getNameRoom($reserva->habitacion_id)}}" disabled>
                </div>
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="" class="form-label">FECHA ENTRADA</label>
                        <input type="text" class="form-control" name="fecha_inicio" id="" aria-describedby="helpId" placeholder="" value="{{$reserva->fecha_inicio}}" disabled>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="" class="form-label">FECHA SALIDA</label>
                        <input type="text" class="form-control" name="fecha_fin" id="" aria-describedby="helpId" placeholder="" value="{{$reserva->fecha_fin}}" disabled>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="" class="form-label">CLIENTE</label>
                        <input type="text" class="form-control" name="cliente_id" id="" aria-describedby="helpId" placeholder="" value="{{$modelCliente->getNameCustomer($reserva->cliente_id)}}" disabled>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="" class="form-label">RESPONSABLE</label>
                        <input type="text" class="form-control" name="empleado_id" id="" aria-describedby="helpId" placeholder="" value="{{$modelUser->getNameUser($reserva->empleado_id)}}" disabled>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Editar Estado Reserva</button>
            </div>
        </form>
    </div>
  </div>
</div>

@section('js')
    <script> console.log('Editar agenda!'); </script>
@stop

