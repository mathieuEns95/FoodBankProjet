@extends("layouts.admin")

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header card-header-primary">
        <h3 class="card-title">Nouveau migrant</h3>
        <p class="card-category">Saisissez les informations du nouveau migrant</p>
      </div>
      <div class="card-body">
        <form method="POST" action="{{ route('migrants.add_migrant') }}" id="add_migrant_form">
          <div class="row">
            @csrf
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="bmd-label-floating">Nom <sup class="text-danger">*</sup></label>
                <input type="text" class="form-control{{ $errors->has('nom') ? ' is-invalid' : '' }}"
                name="nom" required value="{{ old('nom') }}">
              </div>
              @if ($errors->has('nom'))
              <span class="invalid-feedback" style="display: block;" role="alert">
                <strong>{{ $errors->first('nom') }}</strong>
              </span>
              @endif
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="bmd-label-floating">Prénom <sup class="text-danger">*</sup></label>
                <input type="text" class="form-control{{ $errors->has('prenom') ? ' is-invalid' : '' }}"
                name="prenom" required value="{{ old('prenom') }}">
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
                <label class="bmd-label-floating">Pays <sup class="text-danger">*</sup></label>
                <select name="pays" id="pays"class="form-control{{ $errors->has('pays') ? ' is-invalid' : '' }}" required>
                  <option value="">Sélectionner le pays</option>
                  <option value="cameroun">Cameroun</option>
                  <option value="congo">Congo</option>
                </select>
                @if ($errors->has('pays'))
                <span class="invalid-feedback" style="display: block;" role="alert">
                  <strong>{{ $errors->first('pays') }}</strong>
                </span>
                @endif
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="bmd-label-floating">Date de Naissance <sup class="text-danger">*</sup></label>
                <input type="date" class="form-control{{ $errors->has('date_of_birth') ? ' is-invalid' : '' }}"
                name="date_of_birth" required value="{{ old('date_of_birth') }}">
              </div>
              @if ($errors->has('date_of_birth'))
              <span class="invalid-feedback" style="display: block;" role="alert">
                <strong>{{ $errors->first('date_of_birth') }}</strong>
              </span>
              @endif
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="bmd-label-floating">Passseport <sup class="text-danger">*</sup></label>
                <input type="text" class="form-control{{ $errors->has('passeport') ? ' is-invalid' : '' }}"
                name="passeport" required value="{{ old('passeport') }}">
              </div>
              @if ($errors->has('passeport'))
              <span class="invalid-feedback" style="display: block;" role="alert">
                <strong>{{ $errors->first('passeport') }}</strong>
              </span>
              @endif
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="bmd-label-floating">Adresse Email <sup class="text-danger">*</sup></label>
                <input type="email"
                class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                name="email" value="{{ old('email') }}">
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
                <label class="bmd-label-floating">Profession <sup class="text-danger">*</sup></label>
                <select name="profession" id="profession"class="form-control{{ $errors->has('profession') ? ' is-invalid' : '' }}" required>
                  <option value="">Sélectionner la profession</option>
                  <option value="etudiant">Etudiant</option>
                  <option value="travailleur">Travailleur</option>
                  <option value="entrepreneur">Entrepreneur</option>
                  <option value="stagiaire">Stagiaire</option>
                </select>
              </div>
              @if ($errors->has('profession'))
              <span class="invalid-feedback" style="display: block;" role="alert">
                <strong>{{ $errors->first('profession') }}</strong>
              </span>
              @endif
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="bmd-label-floating">Adresse <sup class="text-danger">*</sup></label>
                <input type="text" class="form-control{{ $errors->has('adresse') ? ' is-invalid' : '' }}"
                name="adresse" required>
              </div>
              @if ($errors->has('adresse'))
              <span class="invalid-feedback" style="display: block;" role="alert">
                <strong>{{ $errors->first('adresse') }}</strong>
              </span>
              @endif
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label class="bmd-label-floating">Nombre de colocataires <sup class="text-danger">*</sup></label>
                <input type="number" min="0" class="form-control{{ $errors->has('nbre_coloc') ? ' is-invalid' : '' }}" name="nbre_coloc" value="{{ old('nbre_coloc') }}" required>
              </div>
              @if ($errors->has('nbre_coloc'))
              <span class="invalid-feedback" style="display: block;" role="alert">
                <strong>{{ $errors->first('nbre_coloc') }}</strong>
              </span>
              @endif
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label class="bmd-label-floating">Nombre d'enfants</label>
                <input type="number" min="0" class="form-control{{ $errors->has('nbre_enfants') ? ' is-invalid' : '' }}"
                name="nbre_enfants" value="{{ old('nbre_enfants') }}">
              </div>
              @if ($errors->has('nbre_enfants'))
              <span class="invalid-feedback" style="display: block;" role="alert">
                <strong>{{ $errors->first('nbre_enfants') }}</strong>
              </span>
              @endif
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="bmd-label-floating">Telephone <sup class="text-danger">*</sup></label>
                <input type="text" class="form-control{{ $errors->has('telephone') ? ' is-invalid' : '' }}" name="telephone" value="{{ old('telephone') }}" required>
              </div>
              @if ($errors->has('telephone'))
              <span class="invalid-feedback" style="display: block;" role="alert">
                <strong>{{ $errors->first('telephone') }}</strong>
              </span>
              @endif
            </div>
          </div>
          <button type="submit" class="btn btn-success pull-right">Créer migrant</button>
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
