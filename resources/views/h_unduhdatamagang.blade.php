<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Data Magang</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body>
<div class="wrapper">
  <section class="invoice">
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          <i class="fa fa-globe"></i> Laporan Magang
          <small class="pull-right">Date: {{ date('d-M-Y')}}</small>
        </h2>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12 table-responsive">
        <table class="table table-striped">
          <thead>
          <tr>
            <th>Nama </th>           
            <th>NIM</th>           
            <th>Instansi</th>
            <th>Keterangan</th>
            <th>Nilai</th>
          </tr>
          </thead>
          <tbody>
              <?php $no=1?>
          @foreach ($magang as $post)
          <tr>
            <td>{{$post->nama_mahasiswa}}</td>
            <td>{{$post->NIM}}</td>
            <td>{{$post->instansi_magang}}</td>
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