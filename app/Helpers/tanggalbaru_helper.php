<?php

function tanggalbaru($tanggal)
{
    $bulan = array(
        'Jan' => '01',
        'Feb' => '02',
        'Mar' => '03',
        'Apr' => '04',
        'May' => '05',
        'Jun' => '06',
        'Jul' => '07',
        'Aug' => '08',
        'Sep' => '09',
        'Oct' => '10',
        'Nov' => '11',
        'Dec' => '12',
    );
    $split = explode('-', $tanggal);
    // var_dump($split);
    // die;
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
    return $tahun . '-' . $nmonth . '-' . $split[0];
}
