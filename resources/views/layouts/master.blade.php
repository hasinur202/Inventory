
<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>সন্ধিপাঠ লাইব্রেরি</title>

  <link rel="stylesheet" href="{{asset('/css/app.css') }}">
  
</head>
<body class="hold-transition sidebar-mini" >
<div class="wrapper" id="app">

    <app></app>

  

</div>

<script src="{{asset('/js/app.js') }}"></script>

</body>
</html>
