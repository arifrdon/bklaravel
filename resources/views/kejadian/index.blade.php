@extends('template')

@section('main')
<div class="card mb-3">
    
    <div class="card-header">
        <a href="kejadian/create"><i class="fas fa-plus"></i> Add New</a>
    </div>
    
    <div class="card-body">
        {{-- @foreach ($siswa_list as $item)
            {{ $item->user->name }}
        @endforeach --}}
        <div class="card-footer">
            <form action="{{url('kejadian/cari')}}" method="GET">
                <div class="input-group">
                    <input type="text" name="kata_kunci" value="{{ !empty($kata_kunci) ? $kata_kunci : '' }}" class="form-control" placeholder="Cari Nama Kejadian">
                    <div class="input-group-btn">
                    <button class="btn btn-default" type="submit">
                        Cari
                    </button>
                    </div>
                </div>
            </form> 
        </div>
        <div class="table-responsive">
            
            @if (!empty($kejadian_list))
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
                        <?php $i = ($kejadian_list->currentpage()-1)* $kejadian_list->perpage() + 1; ?>
                        @foreach ($kejadian_list as $item)
                            <tr>
                                <td> {{ $i++ }}</td>
                                <td> {{ $item->nama_kejadian }}</td>
                                <td> {{ $item->poin_kejadian }}</td>
                                <td> {{ $item->tipe_kejadian }}</td>
                                <td>
                                    <a href="{{ url('kejadian/'.$item->id) }}" class="btn btn-small"><i class="fas fa-info-circle"></i>Detail</a>
                                    <a href="{{ url('kejadian/'.$item->id.'/edit') }}" class="btn btn-small"><i class="fas fa-edit"></i>Edit</a>
                                    
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
                                    <form id="delete-form" action="{{ url('kejadian/'.$item->id) }}" method="POST" style="display: none;">
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
                            Data Kejadian: {{ $jumlah_kejadian }}
                        </strong>
                    </div>
                    
                    <div class="float-right">
                        {{-- {{ $siswa_list-links() }} --}}
                        {{ $kejadian_list->links() }}
                    </div>
                </div>
            @else
                <p>Tidak ada data kejadian sekolah.</p>
            @endif
            
        </div>
    </div>
</div>
@stop