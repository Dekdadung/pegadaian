/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */
// var rupiah = document.getElementById('rupiah');
// rupiah.addEventListener('keyup', function(e)
// {
//     rupiah.value = formatRupiah(this.value, 'Rp. ');
// });

// var path = location.pathname.split('/')
// var url = location.origin + '/' +path[1]

// $('div.navbar-collapse.collapse ul.navbar-nav li a').each(function(){
//     if($(this).attr('href').indexOf(url) !== -1) {
//         $(this).parent().addClass('active').parent().parent('li').addClass('active')
//     }
// })

// var rupiah = document.getElementById('rupiah');
//     rupiah.addEventListener('keyup', function(e)
//     {
//         rupiah.value = formatRupiah(this.value);
//     });

// function formatRupiah(angka, prefix){
// 			var number_string = angka.replace(/[^,\d]/g, '').toString(),
// 			split   		= number_string.split(','),
// 			sisa     		= split[0].length % 3,
// 			rupiah     		= split[0].substr(0, sisa),
// 			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
 
// 			// tambahkan titik jika yang di input sudah menjadi angka ribuan
// 			if(ribuan){
// 				separator = sisa ? '.' : '';
// 				rupiah += separator + ribuan.join('.');
// 			}
 
// 			rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
// 			return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
// 		}

$(document).ready(function(){

    var path = location.pathname.split('/')
    var url = location.origin + '/' +path[1]
    
    $('div.navbar-collapse.collapse ul.navbar-nav li a').each(function(){
        if($(this).attr('href').indexOf(url) !== -1) {
            $(this).parent().addClass('active').parent().parent('li').addClass('active')
        }
    })
    
    var rupiah = document.getElementById('rupiah');
    if($('#rupiah').length > 0){
        rupiah.addEventListener('keyup', function(e)
        {
            rupiah.value = formatRupiah(this.value);
        });
    }
    
    function formatRupiah(angka, prefix){
                var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split   		= number_string.split(','),
                sisa     		= split[0].length % 3,
                rupiah     		= split[0].substr(0, sisa),
                ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
     
                // tambahkan titik jika yang di input sudah menjadi angka ribuan
                if(ribuan){
                    separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }
     
                rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
            }    

            $(document).on('click','.btn-detail',function(e){
                e.preventDefault();
                var get_data = $(this).siblings('textarea').val();
                    var convert_row = JSON.parse(get_data);
                $('#modalDetail').modal('show');
                $.each(convert_row, function(key, val){
                    $('.row_'+key).text(val);
                });
            });
            $("#tabelGadai").dataTable();

    $('.jumlah_pinjaman_input').change(function(){
        var checkedNew = $(this).val().replace(/\./g, "");
        var sisa_saldo_akhir = $('.sisa_saldo_akhir').val();
        if(parseInt(checkedNew) > parseInt(sisa_saldo_akhir)){
            swal({
                title: "Saldo Kurang !",
                text: "Mohon Inputkan Jumlah Sesuai Saldo !",
                icon: "warning",
              });
            $(this).val('');
            $(this).focus();
        }
    });
    // $("#mytable").dataTable();
    
    // document.getElementById('myForm').onsubmit = function() {
    //     var valInDecimals = document.getElementById('myPercent').value / 100;
    // } 

    $(document).on('click', '#btn-edit', function(){
            $('.modal-body #id-barang').val($(this).data('id-barang'));
            $('.modal-body #nama-barang').val($(this).data('nama-barang'));
            $('#actionform').attr('action','/barang/update/'+$(this).data('id-barang'));
        // console.log(data_row);
        // alert('assa');
    });

    $(document).on('click', '#btn-edit-cabang', function(){
        $('.modal-body #kode-cabang').val($(this).data('kode-cabang'));
        $('.modal-body #nama-cabang').val($(this).data('nama-cabang'));
        $('.modal-body #kode-toko').val($(this).data('kode-toko'));
        $('.modal-body #alamat').val($(this).data('alamat'));
        $('#formcabang').attr('action','/cabang/update/'+$(this).data('kode-cabang'));
    // console.log(data_row);
    // alert('assa');
});

$(document).on('click', '#btn-edit-nasabah', function(){
    $('.modal-body #id-nasabah').val($(this).data('id-nasabah'));
    $('.modal-body #kode-cabang').val($(this).data('kode-cabang'));
    $('.modal-body #nama').val($(this).data('nama'));
    $('.modal-body #telpon').val($(this).data('telpon'));
    $('.modal-body #alamat').val($(this).data('alamat'));
    $('.modal-body #nik').val($(this).data('nik'));
    $('#formNasabah').attr('action','/nasabah/update/'+$(this).data('id-nasabah'));
// console.log(data_row);
// alert('assa');
});

$(document).on('click', '#btn-edit-user', function(){
    $('.modal-body #id-user').val($(this).data('id-user'));
    $('.modal-body #cabang').val($(this).data('cabang'));
    $('.modal-body #nama-user').val($(this).data('nama-user'));
    $('.modal-body #username').val($(this).data('username'));
    $('.modal-body #password').val($(this).data('password'));
    $('.modal-body #level').val($(this).data('level'));
    $('#formUser').attr('action','/user/update/'+$(this).data('id-user'));
// console.log(data_row);
// alert('assa');
});


$(document).on('click', '#btn-edit-aturan', function(){
    $('.modal-body #id-peraturan').val($(this).data('id-peraturan'));
    $('.modal-body #bunga').val($(this).data('bunga'));
    $('.modal-body #denda').val($(this).data('denda'));
    $('#formAturan').attr('action','/aturan/update/'+$(this).data('id-peraturan'));
// console.log(data_row);
// alert('assa');
});

$(document).ready(function() {
    $('.delete-btn').click(function(e) {
        e.preventDefault();
        var id = $(this).data('idbarang');

        swal({
                title: "Yakin Ingin Hapus Data?",
                text: "Data yang dihapus tidak bisa dikembalikan !",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "/barang/delete/" + id,
                        success: function(response) {
                            swal({
                                    title: response.status,
                                    text: response.status_text,
                                    icon: response.status_icon,
                                    button: "OK",
                                })
                                .then((confirmed) => {
                                    window.location.reload();
                                });
                        }
                    });
                }
            });

    });

});

$(document).ready(function() {
    $('.Ndelete-btn').click(function(e) {
        e.preventDefault();
        var id = $(this).data('id-nasabah');

        swal({
                title: "Yakin Ingin Hapus Data?",
                text: "Data yang dihapus tidak bisa dikembalikan !",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "/nasabah/delete/" + id,
                        success: function(response) {
                            swal({
                                    title: response.status,
                                    text: response.status_text,
                                    icon: response.status_icon,
                                    button: "OK",
                                })
                                .then((confirmed) => {
                                    window.location.reload();
                                });
                        }
                    });
                }
            });

    });

});

$(document).ready(function() {
    $('.Udelete-btn').click(function(e) {
        e.preventDefault();
        var id = $(this).data('id-user');

        swal({
                title: "Yakin Ingin Hapus Data?",
                text: "Data yang dihapus tidak bisa dikembalikan !",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "/user/delete/" + id,
                        success: function(response) {
                            swal({
                                    title: response.status,
                                    text: response.status_text,
                                    icon: response.status_icon,
                                    button: "OK",
                                })
                                .then((confirmed) => {
                                    window.location.reload();
                                });
                        }
                    });
                }
            });

    });

});

$(document).ready(function() {
    $('.Pdelete-btn').click(function(e) {
        e.preventDefault();
        var id = $(this).data('id-peraturan');

        swal({
                title: "Yakin Ingin Hapus Data?",
                text: "Data yang dihapus tidak bisa dikembalikan !",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "/aturan/delete/" + id,
                        success: function(response) {
                            swal({
                                    title: response.status,
                                    text: response.status_text,
                                    icon: response.status_icon,
                                    button: "OK",
                                })
                                .then((confirmed) => {
                                    window.location.reload();
                                });
                        }
                    });
                }
            });

    });

});

$(document).ready(function() {
    $('.Cdelete-btn').click(function(e) {
        e.preventDefault();
        var id = $(this).data('kode-cabang');

        swal({
                title: "Yakin Ingin Hapus Data?",
                text: "Data yang dihapus tidak bisa dikembalikan !",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "/cabang/delete/" + id,
                        success: function(response) {
                            swal({
                                    title: response.status,
                                    text: response.status_text,
                                    icon: response.status_icon,
                                    button: "OK",
                                })
                                .then((confirmed) => {
                                    window.location.reload();
                                });
                        }
                    });
                }
            });

    });

});

$(document).ready(function() {
    $('.Gdelete-btn').click(function(e) {
        e.preventDefault();
        var id = $(this).data('kode-pinjaman');

        swal({
                title: "Yakin Ingin Hapus Data?",
                text: "Data yang dihapus tidak bisa dikembalikan !",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "/pegadaian/delete/" + id,
                        success: function(response) {
                            swal({
                                    title: response.status,
                                    text: response.status_text,
                                    icon: response.status_icon,
                                    button: "OK",
                                })
                                .then((confirmed) => {
                                    window.location.reload();
                                });
                        }
                    });
                }
            });

    });

});


})