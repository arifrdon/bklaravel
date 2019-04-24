@extends('template')
@section('main')
<div class="card mb-3">
    <div class="card-header">
        <a href="{{ url('imageshow') }}"><i class="fas fa-arrow-left"></i> Back</a>
    </div>
    <div class="card-body">
        {{-- {{  config('poin_awal') }}
        {{  config('fitur_reward') }}
        {{  config('operator_bk') }} --}}
        <form action="{{ url('imagestore') }}" method="post" enctype="multipart/form-data" >
            @csrf
            <div class="form-group">
                <label for="imagepath">Image*</label>
                <br>
                <input type="file" name="imagepath" id="imagepath" class=" {{ $errors->has('imagepath') ? '':'' }}">
                <br>
                @if ($errors->has('imagepath'))
                    {{ $errors->first('imagepath') }}
                
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
