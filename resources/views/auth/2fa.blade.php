@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">{{ __('Login 2FA') }}</div>
          <div class="card-body">
            <form method="POST" action="{{ route('login.2fa',$user->id) }}" aria-label="{{ __('Login') }}">
              @csrf
              <div class="form-group row">
                <div class="col-lg-4">
                  <img id="imgQR" src="{{$urlQR}}"/>
                </div>
                <div class="col-lg-8">
                  <div class="form-group">
                    <label for="code_verification" class="col-form-label">
                      {{ __('CÓDIGO DE VERIFICACIÓN') }}
                    </label>
                    <input 
                      id="code_verification" 
                      type="text" 
                      class="form-control{{ $errors->has('code_verification') ? ' is-invalid' : '' }}" 
                      name="code_verification"
                      value="{{ old('code_verification') }}" 
                      required
                      autofocus>
                    @if ($errors->has('code_verification'))
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('code_verification') }}</strong>
                      </span>
                    @endif
                  </div>
                  <button type="submit" class="btn btn-primary">ENVIAR</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection