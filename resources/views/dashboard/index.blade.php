@extends('layouts.admin');

@section('content')
<div class="card-body">
    <table class="table-bordered bootstrap-data-table">
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
                    <a href="#" id="deleteMigrantElement" data-id="{{$mig->id}}"><i class="far fa-trash-alt text-danger"></i></a>
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

<div class="modal fade" id="deleteMigrantModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel"><i class="far fa-user-circle"></i> Vouslez-vous vraiment supprimer les informations de ce migrant ?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('migrants.delete') }}" id="deleteMigrantForm">
                    @csrf
                    <input type="hidden" id="migrant_id" name="migrant_id">
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary btn-block" value="Supprimer">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection

@section('js')
<script>
    $(document).on("click", "#deleteMigrantElement", function(evt){
        evt.preventDefault();

        var id = $(this).attr('data-id');

        $("#migrant_id").val(id);
        $("#deleteMigrantModal").modal();
        // window.location = "{{ route('migrants.delete', ['id' => "+id+"]) }}";
    });
</script>
@endsection