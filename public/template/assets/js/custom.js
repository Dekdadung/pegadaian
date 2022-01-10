/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";

$(document).ready(function(){
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
    })
})