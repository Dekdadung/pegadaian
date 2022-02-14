<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NOTA</title>
    <style>
    body {
        margin: 0;
        padding: 0;
    }

    body,
    * {
        font-family: arial;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        margin: 0;
        padding: 0;
    }

    p {
        margin: 0;
        padding: 0;
    }

    p.solid {
        border-style: solid;
        padding: 2px;
        height: 40px;
        width: 200px;
    }

    .container {
        height: 148.5mm;
        width: 210mm;
        margin-right: auto;
        margin-left: auto;
    }

    .brand-section {
        background-color: #0d1033;
        padding: 10px 40px;
    }

    .logo {
        width: 50%;
    }

    .row {
        display: flex;
        flex-wrap: wrap;
    }

    .col-6 {
        width: 50%;
        flex: 0 0 auto;
    }

    .body-section {
        padding: 0px 15px;
        border: 1px solid gray;
    }

    .heading {
        font-size: 12px;
        margin-bottom: 08px;
    }

    .sub-heading {
        margin-bottom: 05px;
        font-size: 10px;
        text-align: justify;
    }

    p.content-s {
        font-size: 14px;
    }

    table {
        background-color: #fff;
        width: 100%;
        border-collapse: collapse;
    }

    .text-right {
        text-align: end;
    }

    .w-20 {
        width: 20%;
    }

    .card-footer {
        border: 1px;
        margin-left: 08px;
        margin-right: 08px;
        font-size: 12px;
        text-align: center;
    }

    .my-tables tr td {
        padding-bottom: 5px;
    }
    </style>
</head>
<!-- window.print() -->

<body onload="window.print()">

    <div class="container">

        <div class="body-section">
            <div class="row">
                <div class="col-12 mb-5">
                    <table style="margin-bottom: 10px;">
                        <thead>
                            <tr>
                                <th><img width="80px" src="<?= base_url('template/assets/img/tangan.png') ?>" alt="">
                                </th>
                                <th style="text-align: left;width:340px">
                                    <img width="100px" src="<?= base_url('template/assets/img/tulisan.png') ?>" alt="">
                                    <br>
                                    <h5>Alamat : <?= $data_cabang->alamat ?></h5>
                                    <h5>Telp. / WA : <?= $data_cabang->telp_cabang ?></h5>
                                    <h5>Operasional : Senin - Sabtu / 08:00 WITA - 20:00 WITA</h5>
                                </th>
                                <th>
                                    <span style="text-decoration: underline;font-size: 18px;">SURAT BUKTI GADAI
                                        BARANG</span>
                                    <p>
                                    <h4 style="margin-top: 3px;">No Nota. <?= $data_nota->kode_pinjaman ?></h4>
                                    </p>
                                </th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="col-12">
                    <table style="width: 100%;font-size:13px" class="my-tables">
                        <tbody>
                            <tr>
                                <td style="width: 120px;">Nama</td>
                                <td style="width: 335px;">: <?= $data_nota->nama ?></td>
                                <td style="width: 120px;">Kondisi</td>
                                <td>: <?= $data_nota->kondisi ?></td>
                            </tr>
                            <tr>
                                <td style="width: 120px;">Alamat</td>
                                <td style="width: 335px;">: <?= $data_nota->alamat_nasabah ?></td>
                                <td style="width: 120px;">Tgl. Gadai</td>
                                <td>: <?= bulan($data_nota->tgl_gadai) ?></td>
                            </tr>
                            <tr>
                                <td style="width: 120px;">No. Telp</td>
                                <td style="width: 335px;">: <?= $data_nota->no_telp ?></td>
                                <td style="width: 120px;">Tgl. Jatuh Tempo</td>
                                <td>: <?= bulan($data_nota->tgl_jatuh_tempo) ?></td>
                            </tr>
                            <tr>
                                <td style="width: 120px;">Jenis Barang</td>
                                <td style="width: 335px;">: <?= $data_nota->nama_barang ?></td>
                                <td style="width: 120px;">Tgl. Lelang</td>
                                <td>: <?= bulan($data_nota->tgl_lelang) ?></td>
                            </tr>
                            <tr>
                                <td style="width: 120px;">No.Imei/Seri</td>
                                <td style="width: 335px;">: <?= $data_nota->seri ?></td>
                                <td style="width: 120px;">Jumlah Pinjaman</td>
                                <td>: Rp.<?= rupiah($data_nota->jumlah_pinjaman) ?></td>
                            </tr>
                            <tr>
                                <td style="width: 120px;">Kelengkapan</td>
                                <td style="width: 335px;">: <?= $data_nota->kelengkapan ?></td>
                                <td style="width: 120px;">Bunga</td>
                                <td>: Rp.<?= rupiah($data_nota->bunga) ?></td>
                            </tr>
                            <tr>
                                <td style="width: 120px;">Jumlah Barang</td>
                                <td style="width: 335px;">: <?= $data_nota->jumlah ?></td>
                                <td style="width: 120px;">Password</td>
                                <td>:<?= $data_nota->password ?> </td>
                            </tr>
                            <table style="width: 100%;font-size:11px" class="my-tables">
                                <tr>
                                    <input type="checkbox">Januari
                                    <input type="checkbox">Februari
                                    <input type="checkbox">Maret
                                    <input type="checkbox">April
                                    <input type="checkbox">Mei
                                    <input type="checkbox">Juni
                                    <input type="checkbox">Juli
                                    <input type="checkbox">Agustus
                                    <input type="checkbox">September
                                    <input type="checkbox">Oktober
                                    <br>
                                    <input type="checkbox">November
                                    <input type="checkbox">Desember
                                </tr>
                            </table>
                        </tbody>
                    </table>
                </div>
                <!-- <div class="col-6">
                    <p class="sub-heading content-s">Nama : <?= $data_nota->nama ?></p>
                    <p class="sub-heading content-s">Alamat : <?= $data_nota->alamat_nasabah ?></p>
                    <p class="sub-heading content-s">No. Telp : </p>
                    <p class="sub-heading content-s">Jenis Barang : </p>
                    <p class="sub-heading content-s">No. Imei/Seri : </p>
                    <p class="sub-heading content-s">Kelengkapan : </p>
                    <p class="sub-heading content-s">Jumlah Barang : </p>
                </div>
                <div class="col-6">
                    <br>
                    <br>
                    <p class="sub-heading content-s">Kondisi : <?= $data_nota->kondisi ?></p>
                    <p class="sub-heading content-s">Tgl. Gadai : </p>
                    <p class="sub-heading content-s">Tgl. Jatuh Tempo : </p>
                    <p class="sub-heading content-s">Jumlah Pinjaman : </p>
                    <p class="sub-heading content-s">Bunga : </p>
                    <p class="sub-heading content-s">Kode Pinjaman : <?= $data_nota->kode_pinjaman ?></p>
                </div> -->
            </div>
        </div>
        <div class="row" style="padding:5px 5px">
            <div class="col">
                <h2 class="heading">PERJANJIAN PINJAMAN GADAI</h2>
                <p class="sub-heading">1. Barang yang dijaminkan adalah milik nasabah atau orang lain yang dikuasakan
                    kepada Nasabah untuk
                    digadaikan yang bukan berasal dari kejahatan, tidak dalam objek sengketa atau sita pinjaman.
                </p>
                <p class="sub-heading">2. Untuk menebus barang gadai, nasabah harus datang sendiri atau dengan
                    mengalihkan hak kepada orang lain
                    dengan melampirkan<b>Surat Kuasa Asli</b> dan <b>Foto Copy KTP</b> Nasabah yang menerima kuasa.
                </p>
                <p class="sub-heading">3. Nasabah tunduk pada peraturan - peraturan yang dibuat oleh <b>FLOBAMORA
                        GADAI</b>.</p>
                <p class="sub-heading">4. Saya bersedia dan tidak akan ada <b>TUNTUTAN DALAM BENTUK APAPUN</b>, baik
                    secara <b>PIDANA/PERDATA</b>
                    kepada pihak <b>FLOBAMORA GADAI</b>. Jika saya <b>LALAI</b>/tidak melakukan pelunasan sampai dengan
                    tanggal jatuh tempo.</p>
                <p class="sub-heading">5. Saya bersedia menyetujui apabila barang yang saya gadaikan di Flobamora Gadai
                    tidak saya tebus atau
                    diperpanjang pada waktu jatuh tempo, maka setelah jatuh tempo barang elektronik yang saya gadaikan
                    dianggap <b>HANGUS/LELANG</b>.
                </p>
                <p class="sub-heading">6. FLOBAMORA GADAI tidak bertanggung jawab atas data/file yang ada dalam
                    elektronik yang digadaikan.</p>
                <p class="sub-heading">7. Pihak FLOBAMORA GADAI tidak menggunakan barang yang sedang digadaikan, maka
                    pihak <b>FLOBAMORA GADAI</b>
                    tidak bertanggung jawab atas kerusakan - kerusakan barang elektronik yang digadaikan.</p>
                </p>
            </div>
            <div class="col-6">
                <p class="sub-heading">Demikian perjanjian pinjaman Gadai ini berlaku mengikat sejak Surat Bukti Kredit
                    ini
                    ditandatangani oleh para pihak.
                </p>
                <p class="sub-heading solid"><b>Rekening Flobamora (Bank BRI) :
                        <br>
                        463901002599507
                        <br>
                        a/n Yustina Ariance Bifel</b>
                </p>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-footer">
                        <br>
                        <p><b>Nasabah</b></p>
                        <br>
                        <br>
                        <p>(..............................)</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div style="margin-left: 90px;" class="card-footer">
                        <p>Denpasar,............................</p>
                        <p style="margin-left: 50px;"><b>Flobamora Gadai</b></p>
                        <br>
                        <br>
                        <p style="text-align: right;">(..............................)</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>



    </div>

</body>

</html>