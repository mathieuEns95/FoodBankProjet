@extends('layouts.admin');

@section('content')
<div class="card-body">
	<table id="bootstrap-data-table" class="table-bordered">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Adresse</th>
                    <th>Solvabilité</th>
                    <th>Date adhésion</th>
                    <th>Pays</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            	<?php $i=1; foreach($migrants as $mig): ?>
                <tr>
                	<td>{{ $i }}</td>
                	<td>{{ $mig->prenom . " " . $mig->nom }}</td>
                	<td>{{ $mig->email }}</td>
                	<td>{{ $mig->adresse }}</td>
                	<td>{{ $mig->solvability }}</td>
                    <td>{{ date("d M Y", $mig->date_creation) }}</td>
                    <td>{{ ucwords($mig->pays) }}</td>
                	<td>
                		<a href="{{ route('migrants.show_code', ['code' => $mig->qr_code]) }}"><i class="fas fa-eye" label="View Qr Code"></i></i></a>
                        <a href="{{ route('migrants.edit', ['id' => $mig->id]) }}"><i class="fas fa-edit text-success"></i></a>
                        <a href="{{ route('migrants.delete', ['id' => $mig->id]) }}"><i class="far fa-trash-alt text-danger"></i></a>
                	</td>
                </tr>
                <?php $i++; endforeach ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>N°</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Adresse</th>
                    <th>Solvabilité</th>
                    <th>Date adhésion</th>
                    <th>Pays</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
        </table>

</div>
<div class="card-body" style="background: green; color: white">
     <p>VOILA ICI</p>
     <table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">Age</th>
      <th scope="col">Nombre</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
    </tr>
  </tbody>
</table>
</div>
@endsection
