<!-- Modal -->
<div class="modal fade" id="idAddUser" tabindex="-1" role="dialog" aria-labelledby="idAddUserTitle" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <form action="{{route('users.store')}}" method="post">
            @csrf
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLongTitle">Crear usuario</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <div class="form-group">
                  <label for="idName">Nombre</label>
                  <input type="text" name="name" class="form-control" id="idName" placeholder="Nombre">
               </div>
               <div class="form-group">
                  <label for="idEmail">Correo</label>
                  <input type="text" name="email" class="form-control" id="idEmail" placeholder="Correo">
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
