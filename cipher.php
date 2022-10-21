<?php

function enkripsi($password) 
{
    $kalimat = $password;
    $key = 5;
    for ($i = 0; $i < strlen($kalimat); $i++) {
        $kode[$i] = ord($kalimat[$i]); //rubah ASCII ke desimal
        $b[$i] = ($kode[$i] + $key) % 256; //proses enkripsi
        $c[$i] = chr($b[$i]); //rubah desimal ke ASCII
    }
    $hsl = '';
    for ($i = 0;
        $i < strlen($kalimat);
        $i++
    ) {
        $hsl = $hsl . $c[$i];
    }
    return $hsl;
}
?>