@extends('layouts.admin');

@section('content')
<div class="card-body">
	<table id="bootstrap-data-table" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>N°</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Adresse</th>
                <th>Retraits restants</th>
                <th>Solvabilité</th>
                <th>Date d'adhésion</th>
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
            	<td>{{ $mig->nbre_retraits }}</td>
            	<td>{{ $mig->solvability }}</td>
            	<td>{{ date("d M Y", $mig->date_creation) }}</td>
            	<td>
            		<a href="{{ route('migrants.show_code', ['code' => $mig->qr_code]) }}"><i class="pe-7s-cart"></i>View Qr Code</a>
            		<a href="#"><i class="pe-7s-cart"></i></a>
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
                <th>Retraits restants</th>
                <th>Solvabilité</th>
                <th>Date d'adhésion</th>
                <th>Actions</th>
            </tr>
        </tfoot>
    </table>
</div>
@endsection