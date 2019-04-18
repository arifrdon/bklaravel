@extends('template')
@section('main')
<div class="card mb-3">
    <div class="card-header">
        Pengaturan BK
    </div>
    <div class="card-body">
        {{-- {{  config('poin_awal') }}
        {{  config('fitur_reward') }}
        {{  config('operator_bk') }} --}}
        <form action="{{ url('update_pengaturan') }}" method="post" enctype="multipart/form-data" >
            @csrf
            <div class="form-group">
                <label for="poin_awal">Poin Awal: *</label>
                <input type="text" value="{{  old("poin_awal", config('poin_awal')) }}" name="poin_awal" placeholder="Poin Awal" class="form-control {{ $errors->has('poin_awal') ? 'is-invalid':'' }}">
                @if ($errors->has('poin_awal'))
                <div class="invalid-feedback">
                    <span class="form-text text-muted">{{ $errors->first('poin_awal') }}</span>
                </div>
                @endif
            </div>

            <div class="form-group">
                <label for="fitur_reward">Fitur Reward: *</label>
                <select class="form-control {{ $errors->has('fitur_reward') ? 'is-invalid':'' }}" name="fitur_reward" id="fitur_reward" >
                    <option {{ old("fitur_reward", config('fitur_reward')) == "1" ? "selected":"" }} value = "1">Ada</option>
                    <option {{ old("fitur_reward", config('fitur_reward')) == "0" ? "selected":"" }} value = "0">Tidak Ada</option>
                </select>
                @if ($errors->has('fitur_reward'))
                <div class="invalid-feedback">
                    <span class="form-text text-muted">{{ $errors->first('fitur_reward') }}</span>
                </div>
                @endif
            </div>

            <div class="form-group">
                <label for="operator_bk">Jika Ada Pelanggaran, Maka: *</label>
                <select class="form-control {{ $errors->has('operator_bk') ? 'is-invalid':'' }}" name="operator_bk" id="operator_bk" >
                    <option {{ old("operator_bk", config('operator_bk')) == "kurang" ? "selected":"" }} value = "kurang">Poin Dikurangi</option>
                    <option {{ old("operator_bk", config('operator_bk')) == "tambah" ? "selected":"" }} value = "tambah">Poin Ditambah</option>
                </select>
                @if ($errors->has('operator_bk'))
                <div class="invalid-feedback">
                    <span class="form-text text-muted">{{ $errors->first('operator_bk') }}</span>
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