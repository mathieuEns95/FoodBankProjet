@extends("layouts.admin")

@section('content')
<div class="row">
  <div class="col-md-12">
      <div class="card">
          <div class="card-header card-header-primary">
              <h3 class="card-title">M.A.J d'un migrant</h3>
          </div>
          <div class="card-body">
              <form method="POST" action="{{ route('migrants.update', ['id'=> $migrant->id]) }}" id="add_migrant_form">
                  <div class="row">
                      @csrf
                  </div>
                  <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                              <label class="bmd-label-floating">Nom</label>
                              <input type="text"
                              class="form-control{{ $errors->has('nom') ? ' is-invalid' : '' }}"
                              name="nom" required value="{{ $migrant->nom }}">
                          </div>
                          @if ($errors->has('nom'))
                          <span class="invalid-feedback" style="display: block;" role="alert">
                              <strong>{{ $errors->first('nom') }}</strong>
                          </span>
                          @endif
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <label class="bmd-label-floating">Prénom</label>
                              <input type="text"
                              class="form-control{{ $errors->has('prenom') ? ' is-invalid' : '' }}"
                              name="prenom" required value="{{ $migrant->prenom }}">
                          </div>
                          @if ($errors->has('prenom'))
                          <span class="invalid-feedback" style="display: block;" role="alert">
                              <strong>{{ $errors->first('prenom') }}</strong>
                          </span>
                          @endif
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                              <label class="bmd-label-floating">N° CNI</label>
                              <input type="text"
                              class="form-control{{ $errors->has('cni') ? ' is-invalid' : '' }}"
                              name="cni" value="{{ $migrant->passeport }}">
                          </div>
                          @if ($errors->has('cni'))
                          <span class="invalid-feedback" style="display: block;" role="alert">
                              <strong>{{ $errors->first('cni') }}</strong>
                          </span>
                          @endif
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <label class="bmd-label-floating">Adresse Email</label>
                              <input type="email"
                              class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                              name="email" value="{{ $migrant->email }}">
                          </div>
                          @if ($errors->has('email'))
                          <span class="invalid-feedback" style="display: block;" role="alert">
                              <strong>{{ $errors->first('email') }}</strong>
                          </span>
                          @endif
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                              <label class="bmd-label-floating">Telephone</label>
                              <input type="text"
                              class="form-control{{ $errors->has('telephone') ? ' is-invalid' : '' }}"
                              name="telephone" value="{{ $migrant->telephone }}">
                          </div>
                          @if ($errors->has('telephone'))
                          <span class="invalid-feedback" style="display: block;" role="alert">
                              <strong>{{ $errors->first('telephone') }}</strong>
                          </span>
                          @endif
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <label class="bmd-label-floating">Adresse</label>
                              <input type="text"
                              class="form-control{{ $errors->has('adresse') ? ' is-invalid' : '' }}"
                              name="adresse" required value="{{ $migrant->adresse }}">
                          </div>
                          @if ($errors->has('adresse'))
                          <span class="invalid-feedback" style="display: block;" role="alert">
                              <strong>{{ $errors->first('adresse') }}</strong>
                          </span>
                          @endif
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                              <label class="bmd-label-floating">Solvabilité</label>
                              <input type="text"
                              class="form-control{{ $errors->has('solvability') ? ' is-invalid' : '' }}"
                              name="solvability" value="{{ $migrant->solvability }}">
                          </div>
                          @if ($errors->has('solvability'))
                          <span class="invalid-feedback" style="display: block;" role="alert">
                              <strong>{{ $errors->first('solvability') }}</strong>
                          </span>
                          @endif
                      </div>
                  </div>
                  <button type="submit" class="btn btn-success pull-right">Modifier migrant</button>
                  <div class="clearfix"></div>
              </form>
          </div>
      </div>
  </div>
</div>
@endsection

@section('js')
<script>
  $(document).on('submit', "#add_migrant_form", function(e){
    var cni = $("input[name='cni']").val();
    var tel = $("input[name='telephone']").val();

    if(cni=="" && tel == ""){
      e.preventDefault();
      $("input[name='cni']").focus();
    }
  });
</script>
@endsection
