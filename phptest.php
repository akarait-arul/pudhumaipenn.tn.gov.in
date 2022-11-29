<html>
<head>
    <title>API TEST</title>
</head>
<body>
 <h1>Handled by <?php print_r(gethostname()); ?></h1>
<?php
$ip = '13.233.170.209';
$port = '443';
$connect = fsockopen($ip,$port);

if(!$connect){
    echo 'emis1-tnschool connection failed';
}
else{
    echo 'emis1-tnschool connection successfully';
}
?>
</body>
</html>

