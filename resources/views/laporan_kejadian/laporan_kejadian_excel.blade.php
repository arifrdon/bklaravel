<?php
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=bk_laporan_siswa.xls");
?>
<table border='1' width="100%">
    <thead>
    <tr>
        <th class="text-center"> No</th>
        <th class="text-center"> No Induk</th>
        <th  class="text-center"> Nama</th>
        <th  class="text-center"> Nama Kejadian</th>
        <th  class="text-center"> Poin</th>
        <th class="text-center"> Tanggal Kejadian</th>
        <th class="text-center"> Kelas</th>
        <th class="text-center"> Tipe Kejadian</th>
    </tr>
    </thead>
    <tbody>
    <?php
        $no = 0;
        foreach($laporan_result as $lr){
    ?>
    <tr>
        <td>{{ ++$no }}</td>
        <td>{{$lr->siswa->nisn }}</td>
        <td>{{$lr->siswa->nama_siswa }}</td>
        <td>{{$lr->kejadian->nama_kejadian }}</td>
        <td>{{$lr->kejadian->poin_kejadian }}</td>
        <td>{{$lr->tanggaljam_kejadian->format('d-m-Y H:i') }}</td>
        <td>{{$lr->siswa->kelassw->nama_kelas }}</td>
        <td>{{$lr->kejadian->tipe_kejadian }}</td>
    </tr>
    <?php 
        } 
    ?>
    </tbody>
</table>
                            