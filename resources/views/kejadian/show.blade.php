@extends('template')
@section('main')
<div class="card mb-3">
    <div class="card-header">
        <a href="{{ url('kejadian') }}"><i class="fas fa-arrow-left"></i> Back</a>
    </div>
    <div class="card-body">
            <div class="form-group">
                <label for="nama_kejadian">Nama Kejadian: {{ $kejadian->nama_kejadian }}</label>
            </div>

            <div class="form-group">
                <label for="poin_kejadian">Poin Kejadian: {{ $kejadian->poin_kejadian }}</label>
            </div>

            <div class="form-group">
                <label for="tipe_kejadian">Tipe Kejadian: {{ $kejadian->tipe_kejadian }}</label>
            </div>
    </div>

    <div class="card-footer small text-muted">
        
    </div>

</div>
@endsection
