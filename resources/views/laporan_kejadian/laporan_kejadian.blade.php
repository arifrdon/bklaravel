@extends('template')
@section('main')
<div class="card mb-3">
    <div class="card-header">
        <a href="{{ url('kejadian_siswa') }}"><i class="fas fa-arrow-left"></i> Back</a>
    </div>
    <div class="card-body">
        {{-- {{  config('poin_awal') }}
        {{  config('fitur_reward') }}
        {{  config('operator_bk') }} --}}
        <form action="{{ url('laporan_kejadian') }}" method="post" enctype="multipart/form-data" >
            @csrf
            <div class="form-group">
                <label for="dtpstart">Mulai Dari Tanggal*</label>
                <input type="date" value="{{ old('dtpstart', isset($input["dtpstart"]) ? $input["dtpstart"]:'') }}" name="dtpstart" id="dtpstart" placeholder="Tanggal Mulai" class="form-control {{ $errors->has('dtpstart') ? 'is-invalid':'' }}">
                @if ($errors->has('dtpstart'))
                <div class="invalid-feedback">
                    <span class="form-text text-muted">{{ $errors->first('dtpstart') }}</span>
                </div>
                @endif
            </div>

            <div class="form-group">
                <label for="dtpend">Sampai Dengan Tanggal*</label>
                <input type="date" value="{{ old('dtpend', isset($input["dtpend"]) ? $input["dtpend"]:'') }}" name="dtpend" placeholder="Tanggal Selesai" class="form-control {{ $errors->has('dtpend') ? 'is-invalid':'' }}">
                @if ($errors->has('dtpend'))
                <div class="invalid-feedback">
                    <span class="form-text text-muted">{{ $errors->first('dtpend') }}</span>
                </div>
                @endif
            </div>

            <div class="form-group">
                <label for="id_kelas">Kelas *</label>
                <select placeholder="Pilih Siswa" class="form-control {{ $errors->has('id_kelas') ? 'is-invalid':'' }}" name="id_kelas" id="id_kelas" >
                    <option {{ old("id_kelas", isset($input["id_kelas"]) ? $input["id_kelas"]:'') == "semua" ? "selected":"" }}  value = "semua">Semua Kelas</option>
                    @foreach ($kelas_list as $key => $value)
                    <option {{ old("id_kelas", isset($input["id_kelas"]) ? $input["id_kelas"]:'') == $key ? "selected":"" }}  value = "{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
                @if ($errors->has('id_kelas'))
                <div class="invalid-feedback">
                    <span class="form-text text-muted">{{ $errors->first('id_kelas') }}</span>
                </div>
                @endif
            </div>

            <div class="form-group">
                <label for="tipe_kejadian">Tipe*</label>
                <select placeholder="Pilih Siswa" class="form-control {{ $errors->has('tipe_kejadian') ? 'is-invalid':'' }}" name="tipe_kejadian" id="tipe_kejadian" >
                    @if (config('fitur_reward') == 1)
                        <option {{ old("tipe_kejadian", isset($input["tipe_kejadian"]) ? $input["tipe_kejadian"]:'') == "semua" ? "selected":"" }}  value = "semua">Pelanggaran dan Reward</option>
                        <option {{ old("tipe_kejadian", isset($input["tipe_kejadian"]) ? $input["tipe_kejadian"]:'') == "reward" ? "selected":"" }}  value = "reward">Reward</option>
                    @endif
                        <option {{ old("tipe_kejadian", isset($input["tipe_kejadian"]) ? $input["tipe_kejadian"]:'') == "pelanggaran" ? "selected":"" }}  value = "pelanggaran">Pelanggaran</option>
                </select>
                @if ($errors->has('tipe_kejadian'))
                <div class="invalid-feedback">
                    <span class="form-text text-muted">{{ $errors->first('tipe_kejadian') }}</span>
                </div>
                @endif
            </div>
            
            <input class="btn btn-success" type="submit" name="btn" value="Submit" />
        </form>
    </div>

    <div class="card-footer small text-muted">
        * required fields
    </div>

</div>
@if (!empty($laporan_result) && isset($laporan_result))
    <hr>
    <div class="card mb-3">
        <div class="card-header">
            <div style="text-align: right">
                <a href="laporan_kejadian_excel?dtpstart={{ $input["dtpstart"] }}&dtpend={{ $input["dtpend"] }}&id_kelas={{ $input["id_kelas"] }}&tipe_kejadian={{ $input["tipe_kejadian"] }}" target="_blank"><button type="button" class="btn btn-success"><i class="fa fa-download"></i> Excel</button> </a>
            </div>
        </div>
        <div class="card-body">
            <table width="100%" border="1">
                <thead>
                <tr>
                    <th class="text-center"> No</th>
                    <th class="text-center"> No Induk</th>
                    <th class="text-center"> Nama</th>
                    <th class="text-center"> Nama Kejadian</th>
                    <th class="text-center"> Poin</th>
                    <th class="text-center"> Tanggal Kejadian</th>
                    <th class="text-center"> Kelas</th>
                    <th class="text-center"> Tipe Kejadian</th>
                </tr>
                </thead>
                <tbody>
                    <?php $no = 0; ?>
                    @foreach ($laporan_result as $lr)
                        <tr>
                            <td>{{ ++$no }}</td>
                            <td>{{$lr->siswa->nisn }}</td>
                            <td>{{$lr->siswa->nama_siswa }}</td>
                            <td>{{$lr->kejadian->nama_kejadian }}</td>
                            <td>{{$lr->kejadian->poin_kejadian }}</td>
                            <td>{{$lr->tanggaljam_kejadian->format('d-F-Y H:i') }}</td>
                            <td>{{$lr->siswa->kelassw->nama_kelas }}</td>
                            <td>{{$lr->kejadian->tipe_kejadian }}</td>
                        </tr>
                    @endforeach
                
                </tbody>
            </table>
        </div>
    </div>
@endif
@endsection

@section('added-js')
<script>
    $(document).ready(function(){
        $('#id_siswa').select2();
		$('#id_kejadian').select2();
    });
</script>
@endsection