<!-- Modal -->
<div class="modal fade" id="edit{{$Documento->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">EDITAR TIPO DOCUMENTO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

       <form method="POST" action="{{ url('/tipodocumento/' . $Documento->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}
            <div class="modal-body">
                <div class="mb-3">
                <label for="" class="form-label">NOMBRE</label>
                <input type="text"
                    class="form-control" name="nombre" id="" aria-describedby="helpId" placeholder="" value="{{$Documento->nombre}}" minlength="3" required>
                </div>
                <div class="mb-3">
                <label for="" class="form-label">ESTADO</label>
                    <select class="form-control" name="estado" id="estado">
                        <option value='1' @selected("1" == $Documento->estado)>ACTIVO</option>
                        <option value='0' @selected("0" == $Documento->estado)>INACTIVO</option>
                    </select>
                </div>
                <div class="mb-3">
                <label for="" class="form-label">OBSERVACIONES</label>
                <input type="text"
                    class="form-control" name="observaciones" id="" aria-describedby="helpId" placeholder="" value="{{$Documento->observaciones}}">
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
<div class="modal fade" id="delete{{$Documento->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ELIMINAR TIPO DOCUMENTO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form method="POST" action="{{ url('/tipodocumento' . '/' . $Documento->id) }}" accept-charset="UTF-8" style="display:inline">
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
            <div class="modal-body">
                Esta seguro de eliminar a <strong>{{$Documento->nombre}}</strong> ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-danger">Eliminar</button>
            </div>
        </form>
    </div>
  </div>
</div>

