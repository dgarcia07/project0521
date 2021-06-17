<!-- Modal -->
<div class="modal fade" id="idAddClient" tabindex="-1" role="dialog" aria-labelledby="idAddClientTitle" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <form action="{{route('clients.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLongTitle">Crear cliente</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <div class="form-group">
                  <label for="idCode">Codigo</label>
                  <input type="text" name="cod" class="form-control" id="idCode" placeholder="Codigo">
                  {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
               </div>
               <div class="form-group">
                  <label for="idName">Nombre</label>
                  <input type="text" name="name" class="form-control" id="idName" placeholder="Nombre">
                  {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
               </div>
               <div class="form-group">
                  <label for="idCity">Ciudad</label>
                  <select class="form-control" name="city" id="idCity">
                     @foreach ($cities as $key => $city)
                        <option value="{{$city->id}}">{{$city->name}}</option>
                     @endforeach
                  </select>
                  {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
               </div>
               <div class="form-group">
                  <label for="idFile">Imagen</label>
                  <input type="file" name="image" class="form-control" id="idFile">
               </div>
               <div class="form-group">
                  <label for="idState">Estado</label>
                  <select class="form-control" name="state" id="idState">
                     @foreach (Config::get('constants.states') as $key => $state)
                        <option value="{{$key}}">{{$state['name']}}</option>
                     @endforeach
                  </select>
                  {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
               </div>
            </div>
            <div class="modal-footer p-3">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
               <button type="submit" class="btn btn-primary"><i class="fa fa-save" aria-hidden="true"></i> Guardar</button>
            </div>
         </form>
      </div>
   </div>
</div>
