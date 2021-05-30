@extends('layout.index')

@section('content')
   <div class="row">
      <div class="col-md-12">
         @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
               <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                  <i class="nc-icon nc-simple-remove"></i>
               </button>
               <ul>
                  @foreach ($errors->all() as $error)
                     <li>{{ $error }}</li>
                  @endforeach
               </ul>
            </div>
         @endif
         @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
               <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                  <i class="nc-icon nc-simple-remove"></i>
               </button>
               <span>{{ session('success') }}</span>
            </div>
         @endif
         @if (session('danger'))
            <div class="alert alert-danger alert-dismissible fade show">
               <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                  <i class="nc-icon nc-simple-remove"></i>
               </button>
               <span>{{ session('danger') }}</span>
            </div>
         @endif
         <div class="card" id="idContentFilter" style="display:none;">
            <div class="card-header">
               <div class="row align-items-center">
                  <div class="col">
                     <h4 class="card-title"> Búsqueda avanzada</h4>
                  </div>
               </div>
            </div>
            <div class="card-body">
               <form class="" action="{{route('users.index')}}" method="get">
                  <div class="row align-items-end">
                     <div class="col-md-4">
                        <div class="form-group">
                           <label for="idFilterName" class="control-label">Nombre</label>
                           <input type="text" name="name" class="form-control" id="idFilterName" placeholder="Nombre" value="{{request()->get('name')}}">
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group">
                           <label for="idFilterEmail" class="control-label">Correo</label>
                           <input type="text" name="email" class="form-control" id="idFilterEmail" placeholder="Correo" value="{{request()->get('email')}}">
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group">
                           <label for="idFilterState" class="control-label">Estado</label>
                           <select class="form-control" name="state" id="idFilterState">
                              <option value="">Todos</option>
                              @foreach (Config::get('constants.states') as $key => $state)
                                 <option value="{{$key}}">{{$state['name']}}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="row justify-content-between">
                     <div class="col-3">
                        <div class="form-group">
                           <a href="{{route('users.index')}}" class="btn btn-danger btn-block">Limpiar</a>
                        </div>
                     </div>
                     <div class="col-3">
                        <div class="form-group">
                           <button type="submit" class="btn btn-primary btn-block">Buscar</button>
                        </div>
                     </div>
                  </div>
               </form>
            </div>
         </div>
         <div class="card cardTable">
            <div class="card-header">
               <div class="row align-items-center">
                  <div class="col">
                     <h4 class="card-title"> Usuarios</h4>
                  </div>
                  <div class="col text-right">
                     <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#idAddUser"><i class="fa fa-plus" aria-hidden="true"></i> Agregar</button>
                     <button type="button" class="btn btn-dark" id="idBtnSearchFilter"><i class="fa fa-filter" aria-hidden="true"></i></button>
                  </div>
               </div>
            </div>
            <div class="card-body">
               <div class="table-responsive ">
                  <table class="table">
                     <thead class=" text-primary">
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Estado</th>
                        <th class="text-right">Opciones</th>
                     </thead>
                     <tbody>
                        @if (count($users)>0)
                           @foreach ($users as $key => $user)
                              <tr>
                                 <td>{{$user->name}}</td>
                                 <td>{{$user->email}}</td>
                                 <td><span class="badge badge-{{Config::get('constants.states')[$user->state]['color']}}">{{Config::get('constants.states')[$user->state]['name']}}</span> </td>
                                 <td class="text-right">
                                    <button type="button" class="btn btn-info btn-sm" onclick="editUser({{$user->id}})"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button>
                                    @if ($user->id!=1)
                                       <button type="button" class="btn btn-danger btn-sm" onclick="deleteUser({{$user->id}})"><i class="fa fa-trash" aria-hidden="true"></i> Eliminar</button>
                                    @endif
                                 </td>
                              </tr>
                           @endforeach
                        @else
                           <tr>
                              <td colspan="5">No se encontraron registros</td>
                           </tr>
                        @endif
                     </tbody>
                  </table>
               </div>
               <div class="row">
                  <div class="col">
                     {{ $users->links("pagination::bootstrap-4") }}
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   @include('administrator.users.modals.create')
   @include('administrator.users.modals.edit')
@endsection

@section('js')
   <script type="text/javascript">
   $(document).ready(function() {
      $("#idBtnSearchFilter").click(function() {
         $("#idContentFilter").slideToggle("slow");
      });

      $("#idFilterState").val("{{request()->get('state')}}");
   });

   function editUser(id) {
      $.ajax({
         type: 'GET',
         url: "/users/"+id+"/edit",
         dataType: 'json',
         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
         beforeSend:function(){},
         success:function(response){
            if (response.code==200) {
               var result = response.data;
               $("#idFormEdit").attr('action', 'users/'+id);
               $("#idEditName").val(result.name);
               $("#idEditEmail").val(result.email);
               $("#idEditState").val(result.state);
               $("#idEditUser").modal('show');
            }
         },
         error: function(xhr){}
      });
   }

   function deleteUser(id) {
      Swal.fire({
         title: 'Deseas eliminar el usuario?',
         showCancelButton: true,
         confirmButtonText: "Si, eliminar",
      }).then((result) => {
         if (result.isConfirmed) {
            $.ajax({
               type: 'DELETE',
               url: "/users/"+id,
               cache: false,
               data:{
                  _token:'{{ csrf_token() }}'
               },
               dataType: 'json',
               headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
               beforeSend:function(){},
               success:function(response){
                  if (response.code==200) {
                     Swal.fire({
                        text: response.message,
                        icon: 'success',
                     }).then((result) => {
                        if (result.isConfirmed) {
                           location.reload();
                        }
                     })
                  }
               },
               error: function(xhr){}
            });
         }
      })
   }
   </script>
@endsection
