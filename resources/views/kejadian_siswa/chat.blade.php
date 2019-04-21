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
            <hr>
            <div class="form-group">
            <?php 
                foreach($forum_kejadian_list as $fk){
            ?>
                <table class="table-bordered table">
                    <tr><td bgcolor="#CCCCCC">
                    <span style="float: left;">
                    <?php 
                        if($fk->user->level != "orang_tua"){
                            echo ucwords($fk->user->name)." "."(".ucwords(str_replace('_', ' ', $fk->user->level)).")";
                        } else {
                            echo ucwords($fk->user->name)." "."(".ucwords(str_replace('_', ' ', $fk->user->level)).")";
                        }
                    ?> 
                    </span>
                    <span style="float: right;">
                    <?php 
                        echo $fk->created_at->format('d-m-Y H:i');
                    ?> 
                    <?php 
                        if(Auth::user()->id == $fk->user->id){
                    ?>
                        <a href="#"
                        onclick="
                        var result = confirm('Apakah Anda yakin untuk menghapus?');
                        if (result) {
                            event.preventDefault();
                            document.getElementById('delete-form').submit();
                        }
                        ">
                        <div class="btn btn-danger btn-xs"><i class="fa fa-times"></i></div>
                        </a>
                        <form id="delete-form" action="{{ url('kejadian_siswa/'.$kejadian_siswa->id.'/'.$fk->id.'/chatdelete') }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    <?php 
                        }
                    ?>
                    </span> 
                    </td></tr>
                    <tr><td><?php echo $fk->komentar; ?></td></tr>
                
                </table>
            <?php
                }
            ?>
            </div>
            <hr>
            <form action="{{ url('kejadian_siswa/'.$kejadian_siswa->id.'/chatsave') }}" method="post" enctype="multipart/form-data" >
                @csrf
            <div class="form-group">
                <label for="komentar">Komentar*</label><br>
                
                <label><?php echo ucwords(Auth::user()->name); ?> (<?php echo ucwords(str_replace('_', ' ', Auth::user()->level)); ?>)</label>
                <textarea name="komentar" id="komentar" class="form-control {{ $errors->has('komentar') ? 'is-invalid':'' }}" cols="20" rows="5"></textarea>
                @if ($errors->has('komentar'))
                <div class="invalid-feedback">
                    {{ $errors->first('komentar') }}
                </div>
                @endif
            </div>
            <input class="btn btn-success" type="submit" name="btn" value="Save" />
            </form>
    </div>

    <div class="card-footer small text-muted">
        
    </div>

</div>
@endsection
