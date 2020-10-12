@extends('layouts.admin');

@section('content')
<div class="card-body">
    <h3 class="text-center">Rangement par âge</h3>
    <table class="table-bordered bootstrap-data-table">
        <thead>
            <tr>
                <th>Âge</th>
                <th>Nombre</th>
            </tr>
        </thead>
        <tbody>
            <?php $i=1; foreach($stats_per_age as $stat): ?>
            <tr>
                <td>{{ date('Y') - (int)$stat->annee }}</td>
                <td>{{ $stat->nbre }}</td>
            </tr>
            <?php $i++; endforeach ?>
        </tbody>
        <tfoot>
            <tr>
                <th>Âge</th>
                <th>Nombre</th>
            </tr>
        </tfoot>
    </table>

    <hr>

    <h3 class="text-center">Rangement par pays</h3>
    <table class="table-bordered bootstrap-data-table">
        <thead>
            <tr>
                <th>Pays</th>
                <th>Nombre</th>
            </tr>
        </thead>
        <tbody>
            <?php $i=1; foreach($stats_per_country as $stat): ?>
            <tr>
                <td>{{ $stat->pays }}</td>
                <td>{{ $stat->nbre }}</td>
            </tr>
            <?php $i++; endforeach ?>
        </tbody>
        <tfoot>
            <tr>
                <th>Pays</th>
                <th>Nombre</th>
            </tr>
        </tfoot>
    </table>

    <hr>

    <h3 class="text-center">Rangement par Profession</h3>
    <table class="table-bordered bootstrap-data-table">
        <thead>
            <tr>
                <th>Profession</th>
                <th>Nombre</th>
            </tr>
        </thead>
        <tbody>
            <?php $i=1; foreach($stats_per_profession as $stat): ?>
            <tr>
                <td>{{ $stat->profession }}</td>
                <td>{{ $stat->nbre }}</td>
            </tr>
            <?php $i++; endforeach ?>
        </tbody>
        <tfoot>
            <tr>
                <th>Profession</th>
                <th>Nombre</th>
            </tr>
        </tfoot>
    </table>

    <hr>

    <h3 class="text-center">Rangement par Adresse</h3>
    <table class="table-bordered bootstrap-data-table">
        <thead>
            <tr>
                <th>Adresse</th>
                <th>Nombre</th>
            </tr>
        </thead>
        <tbody>
            <?php $i=1; foreach($stats_per_adresse as $stat): ?>
            <tr>
                <td>{{ $stat->adresse }}</td>
                <td>{{ $stat->nbre }}</td>
            </tr>
            <?php $i++; endforeach ?>
        </tbody>
        <tfoot>
            <tr>
                <th>Adresse</th>
                <th>Nombre</th>
            </tr>
        </tfoot>
    </table>
</div>
<div class="card-body" style="background: green; color: white">


</div>
@endsection
