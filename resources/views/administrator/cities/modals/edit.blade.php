<!-- Modal -->
<div class="modal fade" id="idEditCity" tabindex="-1" role="dialog" aria-labelledby="idEditCityTitle" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <form id="idFormEdit" action="#" method="post">
            @csrf
            @method('put')
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLongTitle">Editar ciudad</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <div class="form-group">
                  <label for="idEditCode">Codigo</label>
                  <input type="text" name="cod" class="form-control" id="idEditCode" placeholder="Codigo">
                  {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
               </div>
               <div class="form-group">
                  <label for="idEditName">Ciudad</label>
                  <input type="text" name="name" class="form-control" id="idEditName" placeholder="Ciudad">
                  {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
               </div>
               <div class="form-group">
                  <label for="idEditState">Estado</label>
                  <select class="form-control" name="state" id="idEditState">
                     @foreach (Config::get('constants.states') as $key => $state)
                        <option value="{{$key}}">{{$state['name']}}</option>
                     @endforeach
                  </select>
                  {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
               </div>
            </div>
            <div class="modal-footer p-3">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
               <button type="submit" class="btn btn-primary"><i class="fa fa-save" aria-hidden="true"></i> Actualizar</button>
            </div>
         </form>
      </div>
   </div>
</div>
