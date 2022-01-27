<?php
$session = session();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EXPORT DATA</title>

    <style>
    html,
    body {
        height: 100%;
    }

    html {
        display: table;
        margin: auto;
    }

    body {
        display: table-cell;
        vertical-align: middle;
    }

    table th {
        background: #0c1c60 !important;
        color: #fff !important;
        border: 1px solid #ddd !important;
        line-height: 15px !important;
        text-align: center !important;
        vertical-align: middle !important;

    }

    table td {
        line-height: 15px !important;
        text-align: center !important;
        border: 1px solid;
    }
    </style>

</head>

<body>
    <h2>Data Pegadaian</h2>
    <table class="table table-striped table-bordered">
        <thead>
            <tr class="text-center">
                <th>No</th>
                <th>Kode Pinjaman</th>
                <th>Nama Nasabah</th>
                <th>Tgl. Gadai</th>
                <th>Jatuh Tempo</th>
                <th>Tgl. Lelang</th>
                <th>Jumlah Pinjaman</th>
                <th>Kode Cabang</th>
            </tr>
            <div class="text-center">
                <?php
                $no = 1;
                // var_dump($gadai);
                foreach ($gadai as $row) :
                ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $row->kode_pinjaman; ?></td>
                    <td><?= $row->nama; ?></td>
                    <td><?= $row->tgl_gadai; ?></td>
                    <td><?= $row->tgl_jatuh_tempo; ?></td>
                    <td><?= $row->tgl_lelang; ?></td>
                    <td><?= rupiah($row->jumlah_pinjaman); ?></td>
                    <td><?= $row->kode_cabang; ?></td>
                </tr>
                <?php
                endforeach;
                ?>
            </div>
            </tbody>
    </table>
</body>

</html>