<?php

    exec('whereis php mysql vim python ruby java apache2 nginx openssl vsftpd make'.
          '|awk \'{ split($1, a, ":");if (length($2)==0) print a[1]",Not Installed"; else print a[1]","$2;}\'',$result);

    header('Content-Type: application/json; charset=UTF-8');

    $final = array();
    $x = 0;

    foreach ($result as $a)
    {
        array_push($final, json_encode(explode(',',$a)));
        $x++;
    }
    echo '[' . implode(',', $final) . ']';
