<?php
$length = 11;
$bytes = random_bytes($length);
$result = bin2hex($bytes);
$logn_pwd = 'Pudhumai@123';
$random_char = $result;
$hashed_val = crypt($logn_pwd, '$2a$07$' . $random_char);

echo $hashed_val;
?>