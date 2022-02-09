<?php

function faketgl($tanggal)
{
    $split = explode('-', $tanggal);
    $nmonth = date("m", strtotime($split[1]));
    $tahun = '2021';
    switch ($split[2]) {
        case '22':
            $tahun = '2022';
            break;
        case '21':
            $tahun = '2021';
            break;
        case '19':
            $tahun = '2019';
            break;
        default:
            $tahun = '2021';
            break;
    }
    $tgl_baru = $split[0] + 1;
    return $tahun . '-' . $nmonth . '-' . $tgl_baru;
}
