<!-- Modal -->
<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">AGREGAR TIPO DOCUMENTO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form acction="{{route('tipodocumento.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="modal-body">
                <div class="mb-3">
                <label for="" class="form-label">NOMBRE</label>
                <input type="text"
                    class="form-control" name="nombre" id="" aria-describedby="helpId" placeholder="" minlength="3" required>
                </div>
                <div class="mb-3">
                <label for="" class="form-label">ESTADO</label>
                    <select class="form-control" name="estado" id="estado">
                        <option value='1' selected>ACTIVO</option>
                        <option value='0'>INACTIVO</option>
                    </select>
                </div>
                <div class="mb-3">
                <label for="" class="form-label">OBSERVACIONES</label>
                <input type="text"
                    class="form-control" name="observaciones" id="" aria-describedby="helpId" placeholder="">
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
