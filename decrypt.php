<?php
function dekripsi($password)
{
    $key = 5;
    $hasil='';
    for ($i = 0; $i < strlen($password); $i++) {
        $kode[$i] = ord($password[$i]); // rubah ASII ke desimal
        $b[$i] = ($kode[$i] - $key) % 256; // proses dekripsi Caesar
        $c[$i] = chr($b[$i]); //rubah desimal ke ASCII
    }
    for ($i = 0; $i < strlen($password); $i++) {
        $hasil .= $c[$i];
    }
    return $hasil;
}
?>