<?php

$data = "username=quocthinhtme&password=asdasd&fullname=Nguy%E1%BB%85n+Qu%E1%BB%91c+Th%E1%BB%8Bnh&email=Quocthinhtme%40gmail.com&phone=0383914506&submit=";

$col_name = "";
$value = "";
$arr = explode("&", $data);
foreach ($arr as $item) {
    $col =  explode("=", $item);
    $col_name = $col_name . $col[0] . ", ";
    $value = $value . ($col[1] ?: "null") . ", ";
}
echo $col_name;
echo "<br/>";
echo $value;
