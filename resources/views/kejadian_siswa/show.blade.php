@extends('template')
@section('main')
<div class="card mb-3">
    <div class="card-header">
        <a href="{{ url('kejadian_siswa') }}"><i class="fas fa-arrow-left"></i> Back</a>
    </div>
    <div class="card-body">
            <div class="form-group">
                <label>Nisn: {{ $kejadian_siswa->siswa->nisn }}</label>
            </div>

            <div class="form-group">
                <label>Nama Siswa: {{ $kejadian_siswa->siswa->nama_siswa }}</label>
            </div>

            <div class="form-group">
                <label>Nama Kejadian: {{ $kejadian_siswa->kejadian->nama_kejadian }}</label>
            </div>

            <div class="form-group">
                <label>Poin Kejadian: {{ $kejadian_siswa->kejadian->poin_kejadian }}</label>
            </div>

            <div class="form-group">
                <label>Tanggal Kejadian: {{ $kejadian_siswa->tanggaljam_kejadian->format('d-m-Y H:i:s') }}</label>
            </div>
            
    </div>

    <div class="card-footer small text-muted">
        
    </div>

</div>
@endsection
