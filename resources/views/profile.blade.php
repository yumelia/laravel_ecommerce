<?php $nama = "Karrisa Yumelia"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @php $umur= 17; @endphp
    Ini Profile Saya
    <?php echo $nama; ?> <br>
    Umur Saya : {{ $umur }}
</body>
</html>