@extends('template')

@section('main')
<ol class="breadcrumb alert-success">
    Selamat datang Bapak/Ibu &nbsp;<b>{{ Auth::user()->name }}</b> . Anda login dengan sebagai : {{ ucwords(str_replace('_', ' ',Auth::user()->level)) }}
</ol>
<!-- Icon Cards-->

<div class="card mb-3">
    <div class="card-header">
            Ikhtisar Kejadian Putra/Putri Orang Tua </div>
</div>
<div class="card mb-3">
    
    <div class="card-body">
        <?php //foreach ($siswa as $sw) { ?>
        <div class="form-group">
        <a href="<?php echo url('wali/list_siswa/detail/') ?>">
            <div class="col-xl-12 col-sm-12 mb-12">
                <div class="card text-white bg-primary o-hidden h-100">
                    <div class="card-body">
                        <div class="card-body-icon">
                            <i class="fas fa-fw fa-user-edit"></i>
                        </div>
                        <div class="mr-5">Ali Hamdan</div>
                    </div>
                    
                    
                </div>
                
                <div class="card text-dark bg-light o-hidden h-100" style="padding-top: 12px;">
                        <ul class="list-group list-group-flush">
                                <li class="list-group-item">First item</li>
                                <li class="list-group-item">Second item</li>
                                <li class="list-group-item">Third item</li>
                              </ul>
                        <ul type = "square">
                                
                                <li>Beetroot</li>
                                <li>Ginger</li>
                                <li>Potato</li>
                                
                             </ul>
                             <ul type = "circle">
                                
                                    <li>Lihat Lebih Lanjur</li>
                                    
                                 </ul>
                             
                </div>
                
            </div>
            
        </a>
        </div>
        <?php //} ?>
        
    </div>
</div>
@endsection

@section('added-js')

@endsection