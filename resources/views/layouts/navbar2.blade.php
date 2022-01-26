<!doctype html>
<html lang="en" style="height: 100%">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/styles1.css"/>
    <link rel="stylesheet" href="/css/styles.css"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>SIKMA</title>
    @livewireStyles
    @livewireScripts
  </head>

  <body style="height: 100%">  
    <div class="header" style="width: 100%; background-color:black; height:10%; padding:10px 30px">
        <span style="color:white">SIKMA </span><span style="color: #FFE600">ITK</span>
    </div>
    <div style="height: 90%; width:100%">
      @yield('isi')
    </div>
    
    <footer class="page-footer font-small" style="background-color: #000000;">
      <br>
    </footer>
  </body>
</html>