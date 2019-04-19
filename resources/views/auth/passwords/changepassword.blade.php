@extends('template')
@section('main')
<div class="card mb-3">
					
    <div class="card-body">
        <form action="{{ url('update_password') }}" method="post" enctype="multipart/form-data" >
            @csrf
            <div class="form-group">
                <label for="cur_pass">Password Saat Ini *</label>
                <input type="password" name="cur_pass" placeholder="Password Saat Ini" class="form-control  {{ $errors->has('cur_pass') ? 'is-invalid':'' }}">
                <div class="invalid-feedback">
                    {{ $errors->first('cur_pass') }}
                </div>
            </div>

            <div class="form-group">
                <label for="new_pass">Password Baru *</label>
                <input class="form-control {{ $errors->has('new_pass') ? 'is-invalid':'' }}"
                 type="password" name="new_pass" placeholder="Password Baru" />
                <div class="invalid-feedback">
                    {{ $errors->first('new_pass') }}
                </div>
            </div>

            <div class="form-group">
                <label for="new_pass_c">Konfirmasi Password Baru *</label>
                <input class="form-control {{ $errors->has('new_pass_c') ? 'is-invalid':'' }}"
                 type="password" name="new_pass_c" placeholder="Konfirmasi Password Baru" />
                <div class="invalid-feedback">
                    {{ $errors->first('new_pass_c') }}
                </div>
            </div>
            
            <input class="btn btn-success" type="submit" name="btn" value="Update" />
        </form>

    </div>

    <div class="card-footer small text-muted">
        * required fields
    </div>

</div>
@endsection