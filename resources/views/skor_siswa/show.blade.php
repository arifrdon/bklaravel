@extends('template')
@section('main')
<div class="card mb-3">
    <div class="card-header">
        <a href="{{ url('skor_siswa') }}"><i class="fas fa-arrow-left"></i> Back</a>
    </div>
    <div class="card-body">
            <div class="form-group">
                <label>Nisn: {{ $skor_detail->nisn }}</label>
            </div>

            <div class="form-group">
                <label>Nama Siswa: {{ $skor_detail->nama_siswa }}</label>
            </div>

            <div class="form-group">
                <label>Kelas: {{ $skor_detail->kelassw->nama_kelas }}</label>
            </div>

            <div class="form-group">
                <label>Wali Kelas: {{ $skor_detail->kelassw->user->name }}</label>
            </div>

            <div class="form-group">
                <label>Orang Tua: {{ $skor_detail->user->name }}</label>
            </div>

            <hr>

            <table class="table-bordered table">
                <thead>
                <tr bgcolor="#CCCCCC">
                    <th>Nama Kejadian</th>
                    <th>Tanggal</th>
                    <th>Tipe Kejadian</th>
                    <th>Poin</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($skor_detail->kejadian as $sd)
                    <tr>
                        <th>{{ $sd->nama_kejadian }}</th>
                        <th>{{ $sd->pivot->tanggaljam_kejadian->format('d-m-Y H:i') }}</th>
                        <th>{{ $sd->tipe_kejadian }}</th>
                        <th>{{ $sd->poin_kejadian }}</th>
                    </tr>
                @endforeach
                </tbody>
                </table>
    </div>

    <div class="card-footer small text-muted">
        <?php 
            $sa = (config('operator_bk') == "kurang") ? config('poin_awal') - ($skor_detail->kejadian->where('tipe_kejadian','pelanggaran')->sum('poin_kejadian') - $skor_detail->kejadian->where('tipe_kejadian','reward')->sum('poin_kejadian')) : config('poin_awal') + ($skor_detail->kejadian->where('tipe_kejadian','pelanggaran')->sum('poin_kejadian') + $skor_detail->kejadian->where('tipe_kejadian','reward')->sum('poin_kejadian'))
        ?>
        <strong>Skor Akhir: <?php echo $sa; ?></strong>
    </div>

</div>
@endsection
