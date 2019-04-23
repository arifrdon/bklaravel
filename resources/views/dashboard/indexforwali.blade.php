@extends('template')

@section('main')
<ol class="breadcrumb alert-success">
    Selamat datang Bapak/Ibu &nbsp;<b>{{ Auth::user()->name }}</b> . Anda login dengan sebagai : {{ ucwords(str_replace('_', ' ',Auth::user()->level)) }}
</ol>
<!-- Icon Cards-->

<div class="card mb-3">
    <div class="card-header">
            Ikhtisar 3 Kejadian Terbaru Putra/Putri Orang Tua </div>
</div>
<div class="card mb-3">
    @foreach ($resume_siswa_list as $rsl)
        
    
    <div class="card-body">
        <div class="form-group">
            <div class="col-xl-12 col-sm-12 mb-12">
                <div class="card text-white bg-primary o-hidden h-100">
                    <div class="card-body">
                        <div class="card-body-icon">
                            <i class="fas fa-fw fa-user-edit"></i>
                        </div>
                        <div class="mr-5">{{$rsl->nama_siswa}}</div>
                    </div> 
                </div>
                
                <div class="card text-dark bg-light o-hidden h-100">
                    @if (count($rsl->kejadian) > 0)
                        <table class="table table-bordered table-sm">
                            <tbody>
                                @foreach ($rsl->kejadian as $rslk)
                                    <tr>
                                        <td>{{ $rslk->nama_kejadian }}</td>
                                        <td>{{ $rslk->pivot->tanggaljam_kejadian->format('d-m-Y H:i:s') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>    
                        <ul>
                        <li> <a  href="{{ url('kejadian_siswa/cari?kata_kunci='.$rsl->nama_siswa)}}">Lihat Lebih Lanjut...</a> </li>
                        </ul> 
                    @else
                    <p class="text-center">--Tidak ada Kejadian--</p>
                      
                    @endif
                     
                </div>
            </div>
        </div>
    </div>
    @endforeach
    
</div>
@endsection

@section('added-js')

@endsection