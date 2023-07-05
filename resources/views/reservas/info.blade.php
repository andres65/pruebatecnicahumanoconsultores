<!-- Modal -->
<div class="modal fade" id="edit{{$available->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">RESERVAR HABITACION #{{$available->id}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

       <form method="POST" action="{{ url('/availablees/' . $available->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}
            <div class="modal-body">

                <div class="form-group">
                    <div class="form-row">
                        <label for="searchInput">Buscar cliente por N° de Identificación</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control searchInput" placeholder="Ingrese el nombre del cliente" minlength="3" required>
                            <input type="text" class="idmodal" value="{{$available->id}}"  >
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-primary btnBuscar">Buscar</button>
                        </div>
                    </div>
                </div>

                <div id="searchResults{{$available->id}}">
                    <!-- Aquí se mostrarán los resultados de búsqueda -->
                </div>
                <div id="searchMessage{{$available->id}}">
                    <!-- Aquí se mostrará el mensaje si no se encuentran resultados -->
                </div>

                <div class="mb-3">
                <label for="" class="form-label">NOMBRE</label>
                <input type="text" class="form-control" name="nombre" id="" aria-describedby="helpId" placeholder="" value="{{$available->nombre}}" minlength="3" required>
                </div>

                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="" class="form-label">ESTADO</label>
                        <select class="form-control" name="estado" id="estado">
                            <option value='1' @selected("1" == $available->estado)>ACTIVO</option>
                            <option value='0' @selected("0" == $available->estado)>INACTIVO</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="" class="form-label">CUPO (N° personas)</label>
                        <input type="number"
                        class="form-control" name="cupo" id="" aria-describedby="helpId" placeholder="" value="{{$cupo}}" minlength="1" required>
                    </div>
                </div>


                <div class="mb-3">
                <label for="" class="form-label">OBSERVACIONES</label>
                <input type="text"
                    class="form-control" name="observaciones" id="" aria-describedby="helpId" placeholder="" value="{{$available->observaciones}}">
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

