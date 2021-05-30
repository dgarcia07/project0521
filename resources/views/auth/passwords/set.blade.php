@extends('layout.home')

@section('content')
   <div class="container">
      <div class="row justify-content-center">
         <div class="col-md-4 col-sm-6">
            <form method="POST" action="{{ route('post.setPassword') }}">
               @csrf
               <div class="card cardContent" data-background="color" data-color="blue">
                  <div class="card-header">
                     <h3 class="card-title text-center">Establecer contraseña</h3>
                  </div>
                  <div class="card-content">
                     <div class="form-group">
                        <label>Correo</label>
                        <input id="email" type="email" class="form-control" value="{{$user->email}}" disabled>
                     </div>
                     <input type="hidden" name="email" value="{{$user->email}}">
                     <input type="hidden" name="confirmation_token" value="{{$user->confirmation_token}}">
                     <div class="form-group">
                        <label>Contraseña</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" />
                     </div>
                     <div class="form-group">
                        <label>Repetir contraseña</label>
                        <input id="password" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required autocomplete="current-password" />
                     </div>
                     </div>
                     <div class="card-footer text-center">
                        <div class="form-group row mb-0">
                           <div class="col">
                              <button type="submit" class="btn btn-primary btn-block">Establecer</button>
                           </div>
                        </div>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   @endsection
