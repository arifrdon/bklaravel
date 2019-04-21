@extends('template')

@section('main')
<div class="card mb-3">
    
    
    <div class="card-body">
        <div class="card-footer">
            <form action="{{url('skor_siswa/cari')}}" method="GET">
                <div class="input-group">
                    <input type="text" name="kata_kunci" value="{{ !empty($kata_kunci) ? $kata_kunci : '' }}" class="form-control" placeholder="Cari Nama Siswa">
                    <div class="input-group-btn">
                    <button class="btn btn-default" type="submit">
                        Cari
                    </button>
                    </div>
                </div>
            </form> 
        </div>
        <div class="table-responsive">
            @if (!empty($skor_list))
                <table id="dtserverside" class="table table-hover" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Induk</th>
                            <th>Nama Siswa</th>
                            <th>Poin Awal</th>
                            <th>Poin Reward</th>
                            <th>Poin Pelanggaran</th>
                            <th>Poin Akhir</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = ($skor_list->currentpage()-1)* $skor_list->perpage() + 1;
                            $pr = 0;
                            $pp = 0;
                        ?>
                        @foreach ($skor_list as $item)
                            <tr>
                                <td> {{ $i++ }}</td>
                                <td> {{ $item->nisn }}</td>
                                <td> {{ $item->nama_siswa }}</td>
                                <td> {{ config('poin_awal') }}</td>
                                <td> {{ $pr = $item->kejadian->where('tipe_kejadian','reward')->sum('poin_kejadian') }}</td>
                                <td> {{ $pp = $item->kejadian->where('tipe_kejadian','pelanggaran')->sum('poin_kejadian') }}</td>
                                <td> {{ (config('operator_bk') == "kurang") ? config('poin_awal') - ($pp-$pr) : config('poin_awal') + ($pp+$pr) }}</td>
                                <td>
                                    <a href="{{ url('skor_siswa/'.$item->id.'/detail') }}" class="btn btn-small"><i class="fas fa-info-circle"></i>Detail</a>
                                    <a href="{{ url('skor_siswa/'.$item->id.'/pdf') }}" class="btn btn-small"><i class="fas fa-file-pdf"></i>Cetak</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="card-body">
                    <div class="float-left">
                        <strong>
                            Data Kejadian: {{ $jumlah_skor }}
                        </strong>
                    </div>
                    
                    <div class="float-right">
                        {{-- {{ $siswa_list-links() }} --}}
                        {{ $skor_list->links() }}
                    </div>
                </div>
            @else
                <p>Tidak ada data kejadian sekolah.</p>
            @endif
            
        </div>
    </div>
</div>
@stop