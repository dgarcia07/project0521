@extends('layout.home')

@section('content')
   <div class="container">
      <div class="row justify-content-center">
         <div class="col-md-4 col-sm-6">
            <form method="POST" action="{{ route('login') }}">
               @csrf
               <div class="card cardContent" data-background="color" data-color="blue">
                  <div class="card-header">
                     <h3 class="card-title text-center">Iniciar sesión</h3>
                  </div>
                  <div class="card-content">
                     <div class="form-group">
                        <label>Correo</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                           @error('email')
                              <span class="invalid-feedback" role="alert">
                                 <strong>{{ $message }}</strong>
                              </span>
                           @enderror
                        </div>
                        <div class="form-group">
                           <label>Contraseña</label>
                           <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                              @error('password')
                                 <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                 </span>
                              @enderror
                           </div>
                        </div>
                        <div class="card-footer text-center">
                           <div class="form-group row mb-0">
                              <div class="col">
                                 <button type="submit" class="btn btn-primary btn-block">Iniciar sesión</button>
                              </div>
                           </div>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      @endsection
