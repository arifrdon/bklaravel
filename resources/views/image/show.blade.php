@extends('template')
@section('main')
<div class="card mb-3">
   
        <div class="card-header">
            <a href="imagecreate"><i class="fas fa-plus"></i> Add New</a>
        </div>
  
    
    
    <div class="card-body">
        
        <div class="table-responsive">
            
            @if (!empty($image_list))
                <table id="dtserverside" class="table table-hover" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Image</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; ?>
                        @foreach ($image_list as $item)
                            <tr>
                                <td> {{ $i++ }}</td>
                            <td style="width: 43%"> <img width="100px" src="{{ asset('fotopribadi/'.$item->imagepath )}}" alt=""> {{  $item->imagepath }}</td>
                                <td>
                                    
                                    {{-- <a href="{{ url('kejadian/'.$item->id.'/edit') }}" class="btn btn-small"><i class="fas fa-edit"></i>Edit</a> --}}
                                    
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
                                    <form id="delete-form" action="{{ url('imagedelete/'.$item->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
            @else
                <p>Tidak ada data image.</p>
            @endif
            
        </div>
    </div>
</div>
@endsection