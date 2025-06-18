<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   @if ($barang && $kode)
    menampilkan promo untuk <strong>{{$barang}}</strong> <br>
    dengan kode promo <strong>{{$kode}}</strong>
    @elseif ($barang)
     menampilkan promo untuk <strong>{{$barang}}</strong>
    @else
    menampilkan semua promo barang
    @endif

</body>
</html>