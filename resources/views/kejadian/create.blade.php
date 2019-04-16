@extends('template')
@section('main')
<div class="card mb-3">
    <div class="card-header">
        <a href="{{ url('kejadian') }}"><i class="fas fa-arrow-left"></i> Back</a>
    </div>
    <div class="card-body">
        {{-- {{  config('poin_awal') }}
        {{  config('fitur_reward') }}
        {{  config('operator_bk') }} --}}
        <form action="{{ url('kejadian') }}" method="post" enctype="multipart/form-data" >
            @csrf
            <div class="form-group">
                <label for="nama_kejadian">Nama Kejadian*</label>
                <input type="text" value="{{ old('nama_kejadian') }}" name="nama_kejadian" placeholder="Nama Kejadian" class="form-control {{ $errors->has('nama_kejadian') ? 'is-invalid':'' }}">
                @if ($errors->has('nama_kejadian'))
                <div class="invalid-feedback">
                    <span class="form-text text-muted">{{ $errors->first('nama_kejadian') }}</span>
                </div>
                @endif
            </div>

            <div class="form-group">
                <label for="poin_kejadian">Poin Kejadian*</label>
                <input type="text" value="{{ old('poin_kejadian') }}" name="poin_kejadian" placeholder="Poin Kejadian" class="form-control {{ $errors->has('poin_kejadian') ? 'is-invalid':'' }}">
                @if ($errors->has('poin_kejadian'))
                <div class="invalid-feedback">
                    <span class="form-text text-muted">{{ $errors->first('poin_kejadian') }}</span>
                </div>
                @endif
            </div>

            <div class="form-group">
                <label for="tipe_kejadian">Tipe Kejadian*</label>
                <select class="form-control {{ $errors->has('tipe_kejadian') ? 'is-invalid':'' }}" name="tipe_kejadian" id="tipe_kejadian" >
                    <option {{ old("tipe_kejadian") == "pelanggaran" ? "selected":"" }} value = "pelanggaran">Pelanggaran</option>
                    <option {{ old("tipe_kejadian") == "reward" ? "selected":"" }} value = "reward" style='{{ config('fitur_reward') == 0 ? 'display:none': '' }}'  >Reward</option>
                </select>
                @if ($errors->has('tipe_kejadian'))
                <div class="invalid-feedback">
                    <span class="form-text text-muted">{{ $errors->first('tipe_kejadian') }}</span>
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
