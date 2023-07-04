<!-- Modal -->
<div class="modal fade" id="edit{{$habitacion->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">EDITAR TIPO habitacion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

       <form method="POST" action="{{ url('/habitaciones/' . $habitacion->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}
            <div class="modal-body">
                <div class="mb-3">
                <label for="" class="form-label">NOMBRE</label>
                <input type="text"
                    class="form-control" name="nombre" id="" aria-describedby="helpId" placeholder="" value="{{$habitacion->nombre}}" minlength="3" required>
                </div>

                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="" class="form-label">ESTADO</label>
                        <select class="form-control" name="estado" id="estado">
                            <option value='1' @selected("1" == $habitacion->estado)>ACTIVO</option>
                            <option value='0' @selected("0" == $habitacion->estado)>INACTIVO</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="" class="form-label">CUPO (N° personas)</label>
                        <input type="number"
                        class="form-control" name="cupo" id="" aria-describedby="helpId" placeholder="" value="{{$habitacion->cupo}}" minlength="1" required>
                    </div>
                </div>


                <div class="mb-3">
                <label for="" class="form-label">OBSERVACIONES</label>
                <input type="text"
                    class="form-control" name="observaciones" id="" aria-describedby="helpId" placeholder="" value="{{$habitacion->observaciones}}">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
  </div>
</div>





<!-- Modal Eliminar -->
<div class="modal fade" id="delete{{$habitacion->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ELIMINAR TIPO habitacion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form method="POST" action="{{ url('/habitaciones' . '/' . $habitacion->id) }}" accept-charset="UTF-8" style="display:inline">
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
            <div class="modal-body">
                Esta seguro de eliminar a <strong>{{$habitacion->nombre}}</strong> ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-danger">Eliminar</button>
            </div>
        </form>
    </div>
  </div>
</div>

