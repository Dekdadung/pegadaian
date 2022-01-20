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
        rupiah.addEventListener('keyup', function(e)
        {
            rupiah.value = formatRupiah(this.value);
        });
    
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

    $('.btn-detail').on('click',function(e){
        e.preventDefault();
        var idpinjam = $(this).data('kdpinjaman');
        var data_row = $('.datarow-'+idpinjam).val();
        var convert_row = $.parseJSON(data_row);
        $('#modalDetail').modal('show');
        $.each(convert_row, function(key, val){
            $('.row_'+key).text(val);
        });
        // console.log(data_row);
        // alert('assa');
    });
    // $("#mytable").dataTable();
    
    // document.getElementById('myForm').onsubmit = function() {
    //     var valInDecimals = document.getElementById('myPercent').value / 100;
    // } 
    
})