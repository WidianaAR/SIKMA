<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Data KP</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body>
<div class="wrapper">
  <section class="invoice">
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          <i class="fa fa-globe"></i> Laporan KP
          <small class="pull-right">Date: {{ date('d-M-Y')}}</small>
        </h2>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12 table-responsive">
        <table class="table table-striped">
          <thead>
          <tr>
            <th>Nama Mahasiswa</th>
            <th>Dosen Pembimbing</th>
            <th>NIM</th>
            <th>Judul KP</th>
            <th>Instansi</th>
            <th>Jadwal Semhas</th>
            <th>Keterangan</th>
            <th>Nilai Akhir</th>
          </tr>
          </thead>
          <tbody>
              <?php $no=1?>
          @foreach ($kp as $post)
          <tr>
            <td>{{$post->nama_mahasiswa}}</td>
            <td>{{$post->nama_dosen}}</td>
            <td>{{$post->NIM}}</td>
            <td>{{$post->judul_kp}}</td>
            <td>{{$post->instansi_kp}}</td>
            <td>{{$post->semhas}}</td>
            <td>{{$post->keterangan}}</td>
            <td>{{$post->nilai_akhir}}</td>
          </tr>  
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </section>
</div>
</body>
</html>