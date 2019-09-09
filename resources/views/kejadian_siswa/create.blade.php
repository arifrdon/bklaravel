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
        <form action="{{ url('kejadian_siswa') }}" method="post" enctype="multipart/form-data" >
            @csrf
            <div class="form-group">
                <label for="id_siswa">Nama Siswa*</label>
                <select placeholder="Pilih Siswa" class="form-control {{ $errors->has('id_siswa') ? 'is-invalid':'' }}" name="id_siswa" id="id_siswa" >
                    @foreach ($siswa_list as $key => $value)
                        <option {{ old("id_siswa") == $key ? "selected":"" }}  value = "{{ $key }}">{{ $value }}</option>
                    @endforeach
                    
                </select>
                @if ($errors->has('id_siswa'))
                <div class="invalid-feedback">
                    <span class="form-text text-muted">{{ $errors->first('id_siswa') }}</span>
                </div>
                @endif
            </div>

            <div class="form-group">
                <label for="id_kejadian">Nama Kejadian*</label>
                <select placeholder="Pilih Siswa" class="form-control {{ $errors->has('id_kejadian') ? 'is-invalid':'' }}" name="id_kejadian" id="id_kejadian" >
                    @foreach ($kejadian_list as $key => $value)
                        <option {{ old("id_kejadian") == $key ? "selected":"" }}  value = "{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
                @if ($errors->has('id_kejadian'))
                <div class="invalid-feedback">
                    <span class="form-text text-muted">{{ $errors->first('id_kejadian') }}</span>
                </div>
                @endif
            </div>

            <div class="form-group">
                <label for="tanggal_kejadian">Tanggal Kejadian*</label>
                <input type="date" value="{{ old('tanggal_kejadian') }}" name="tanggal_kejadian" placeholder="Tanggal Kejadian" class="form-control {{ $errors->has('tanggal_kejadian') ? 'is-invalid':'' }}">
                @if ($errors->has('tanggal_kejadian'))
                <div class="invalid-feedback">
                    <span class="form-text text-muted">{{ $errors->first('tanggal_kejadian') }}</span>
                </div>
                @endif
            </div>
            

            <div class="form-group">
                <label for="jam_kejadian">Jam Kejadian*</label>
                <input type="time" value="{{ old('jam_kejadian') }}" name="jam_kejadian" placeholder="Tanggal Kejadian" class="form-control {{ $errors->has('jam_kejadian') ? 'is-invalid':'' }}">
                @if ($errors->has('jam_kejadian'))
                <div class="invalid-feedback">
                    <span class="form-text text-muted">{{ $errors->first('jam_kejadian') }}</span>
                </div>
                @endif
            </div>
            
            <input class="btn btn-success" type="submit" name="btn" value="Save" />
        </form>
    </div>

    <div class="card-footer small text-muted">
        * required fields
    </div>

</div>
@endsection

@section('added-js')
<script>
    $(document).ready(function(){
        $('#id_siswa').select2();
		$('#id_kejadian').select2();
    });
</script>
@endsection