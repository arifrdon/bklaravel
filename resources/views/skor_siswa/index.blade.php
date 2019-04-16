@extends('template')

@section('main')
<div class="card mb-3">
    <div class="card-header">
        <a href="kejadian_siswa/create"><i class="fas fa-plus"></i> Add New</a>
    </div>
    
    <div class="card-body">
        <div class="table-responsive">
            @if (!empty($kejadian_siswa_list))
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
                        <?php $i = ($kejadian_siswa_list->currentpage()-1)* $kejadian_siswa_list->perpage() + 1; ?>
                        @foreach ($kejadian_siswa_list as $item)
                            <tr>
                                <td> {{ $i++ }}</td>
                                <td> {{ $item->siswa->nisn }}</td>
                                <td> {{ $item->siswa->nama_siswa }}</td>
                                <td> {{ $item->kejadian->nama_kejadian }}</td>
                                <td> {{ $item->kejadian->poin_kejadian }}</td>
                                <td> {{ $item->tanggaljam_kejadian->format('d-m-Y H:i:s') }}</td>
                                <td>
                                    <a href="{{ url('kejadian_siswa/'.$item->id) }}" class="btn btn-small"><i class="fas fa-info-circle"></i>Detail</a>
                                    <a href="{{ url('kejadian_siswa/'.$item->id.'/edit') }}" class="btn btn-small"><i class="fas fa-edit"></i>Edit</a>
                                    
                                    <a class="btn btn-small text-danger" href="#"
                                    onclick="
                                    var result = confirm('Are you sure you want to Delete?');
                                    if (result) {
                                        event.preventDefault();
                                        document.getElementById('delete-form').submit();
                                    }
                                    ">
                                    <i class="fas fa-trash"></i>Delete
                                    </a>
                                    <form id="delete-form" action="{{ url('kejadian_siswa/'.$item->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="card-body">
                    <div class="float-left">
                        <strong>
                            Data Kejadian: {{ $jumlah_kejadian_siswa }}
                        </strong>
                    </div>
                    
                    <div class="float-right">
                        {{-- {{ $siswa_list-links() }} --}}
                        {{ $kejadian_siswa_list->links() }}
                    </div>
                </div>
            @else
                <p>Tidak ada data kejadian sekolah.</p>
            @endif
            
        </div>
    </div>
</div>
@stop