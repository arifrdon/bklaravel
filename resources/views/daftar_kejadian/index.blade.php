@extends('template')

@section('main')
<div class="card mb-3">
    <div class="card-header">
        <a href="daftar_kejadian/create"><i class="fas fa-plus"></i> Add New</a>
    </div>
    
    <div class="card-body">

        <div class="table-responsive">
            
            @if (!empty($daftar_kejadian_list))
                <table id="dtserverside" class="table table-hover" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kejadian</th>
                            <th>Poin Kejadian</th>
                            <th>Tipe Kejadian</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; ?>
                        @foreach ($daftar_kejadian_list as $item)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td> {{ $item->nama_kejadian }}</td>
                                <td> {{ $item->poin_kejadian }}</td>
                                <td> {{ $item->tipe_kejadian }}</td>
                                <td> {{ $item->nama_kejadian }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <div class="card-body">
                    <div class="float-left">
                        <strong>
                            Data Kejadian: {{ $jumlah_daftar_kejadian }}
                        </strong>
                    </div>
                    
                    <div class="float-right">
                        {{-- {{ $siswa_list-links() }} --}}
                        {{ $daftar_kejadian_list->links() }}
                    </div>
                </div>
            @else
                <p>Tidak ada data kejadian sekolah.</p>
            @endif
            
        </div>
    </div>
</div>
@stop