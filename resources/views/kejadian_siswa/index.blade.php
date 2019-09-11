@extends('template')

@section('main')
<div class="card mb-3">
    @if (Auth::user()->level =="admin" || Auth::user()->level =="guru_bk" || (Auth::user()->level =="guru" && config('wali_list')->contains(Auth::user()->id)))
        <div class="card-header">
            <a href="kejadian_siswa/create"><i class="fas fa-plus"></i> Add New</a>
        </div>
    @endif
    
    
    <div class="card-body">
        <div class="table-responsive">
            <div class="card-footer">
                <form action="{{url('kejadian_siswa/cari')}}" method="GET">
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
            @if (!empty($kejadian_siswa_list))
                <table id="dtserverside" class="table table-hover" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Induk</th>
                            <th>Nama Siswa</th>
                            <th>Nama Kejadian</th>
                            <th>Poin</th>
                            <th>Tanggal Kejadian</th>
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
                                <td style="width: 18%;"> {{ $item->kejadian->nama_kejadian }}</td>
                                <td> {{ $item->kejadian->poin_kejadian }}</td>
                                <td> {{ $item->tanggaljam_kejadian->format('d-m-Y H:i:s') }}</td>
                                <td>
                                    
                                    <a href="{{ url('kejadian_siswa/'.$item->id.'/chatview') }}" class="btn btn-small"><i class="fas fa-comments"></i>Comment</a>
                                    
                                    @if (Auth::user()->level =="admin" || Auth::user()->level =="guru_bk" || (Auth::user()->level =="guru" && config('wali_list')->contains(Auth::user()->id)))
                                        <a href="{{ url('kejadian_siswa/'.$item->id.'/edit') }}" class="btn btn-small"><i class="fas fa-edit"></i>Edit</a>
                                        
                                        <a class="btn btn-small text-danger" href="#"
                                        onclick="
                                        var result = confirm('Are you sure you want to Delete?');
                                        if (result) {
                                            event.preventDefault();
                                            document.getElementById('delete-form-{{$item->id}}').submit();
                                        }
                                        ">
                                        <i class="fas fa-trash"></i>Delete
                                        </a>
                                        <form id="delete-form-{{$item->id}}" action="{{ url('kejadian_siswa/'.$item->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    @endif
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