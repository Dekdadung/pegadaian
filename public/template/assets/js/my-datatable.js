$(document).ready(function() {
  function numberString(nStr){
      nStr += '';
      var x = nStr.split('.');
      var x1 = x[0];
      var x2 = x.length > 1 ? '.' + x[1] : '';
      var rgx = /(\d+)(\d{3})/;
      while (rgx.test(x1)) {
          x1 = x1.replace(rgx, '$1' + ',' + '$2');
      }
      return x1 + x2;
  }
  // ---------------------------------------------------
	// ----------------  datatable setting ---------------
	// ---------------------------------------------------
	var base_url = $('#base_url').val();
	var list_url = $('#list_url').val();
	var type_data = $('#type_data').val();
  var current_page = $('#current_page').val();
  if($("#table_action").length > 0){
    var actionJSON = $("#table_action").html() != "" ? jQuery.parseJSON($("#table_action").html()) : "";
  }
  var sumColumn = []
  if($("#sumColumn").length > 0 && $("#sumColumn").html() != ""){
      sumColumn = jQuery.parseJSON($("#sumColumn").html());
  }
	var actionInTitle = {
		targets: -1,
		responsivePriority: 2,
		title: 'Action',
		orderable: false,
		render: function(data, type, full, meta) {
      var container = '<div class="btn-group">';
      var headerDop = '<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button><div class="dropdown-menu">';
			var body = '<div class="mt-2 action_btn_post_list"><textarea style="display:none">'+JSON.stringify(data)+'</textarea>\
			'
      if (actionJSON.notifWa != undefined) body += '<a href="javascript:;" class="dropdown-item btn-notifWa" title="Kirim Notifikasi" '+(((actionJSON.notifWa != undefined) && (actionJSON.notifWa))? '':'style="display:none"')+'>\
				<i class="far fa-paper-plane"></i>Kirim Notifikasi\
			</a>\
			'
      if (actionJSON.print != undefined) body += '<a href="javascript:;" class="dropdown-item btn-cetakNota" data-urlnota="'+data.urlNota+'" title="Cetak Nota" '+(((actionJSON.print != undefined) && (actionJSON.print))? '':'style="display:none"')+'>\
				<i class="fas fa-print"></i>Cetak Nota\
			</a>\
			'
      if (actionJSON.detail != undefined) body += '<a href="#" class="dropdown-item btn-edit-inline btn-detail" data-kdpinjaman="'+data.kode_pinjaman+'" title="Detail" '+(((actionJSON.detail != undefined) && (actionJSON.detail))? '':'style="display:none"')+'>\
				<i class="far fa-eye"></i> Detail\
			</a>\
			'
      if (actionJSON.edit != undefined) body += '<a href="'+((data.update_url != undefined) ? data.update_url:"javascript:;")+'" data-idbtn="'+data.id+'" class="dropdown-item btn-edit-inline" title="Edit" '+(((actionJSON.edit != undefined) && (actionJSON.edit))? '':'style="display:none"')+'>\
				<i class="far fa-edit"></i> Edit\
			</a>\
			'
      if (actionJSON.delete != undefined) body += '<a href="'+((data.delete_url != undefined) ? data.delete_url:"javascript:;")+'" class="dropdown-item btn-deletes" onclick="" title="Delete" '+(((actionJSON.delete != undefined) && (actionJSON.delete))? '':'style="display:none"')+'>\
				<i class="far fa-trash-alt"></i> Hapus\
			</a>\
			'
      if (actionJSON.pembayaran != undefined) body += '<a href="'+((data.pembayaran_url != undefined) ? data.pembayaran_url:"javascript:;")+'" class="dropdown-item btn-edit-inline" title="pembayaran" '+(((actionJSON.pembayaran != undefined) && (actionJSON.pembayaran))? '':'style="display:none"')+'>\
				<i class="fas fa-hand-holding-usd"></i> Pembayaran\
			</a>\
			'
      if (actionJSON.penebusan != undefined) body += '<a href="'+((data.penebusan_url != undefined) ? data.penebusan_url:"javascript:;")+'" class="dropdown-item btn-edit-inline" title="penebusan" '+(((actionJSON.penebusan != undefined) && (actionJSON.penebusan))? '':'style="display:none"')+'>\
				<i class="fas fa-money-bill"></i> Penebusan\
			</a>\
			'
      if (actionJSON.perpanjangan != undefined) body += '<a href="'+((data.perpanjangan_url != undefined) ? data.perpanjangan_url:"javascript:;")+'" class="dropdown-item btn-edit-inline" title="perpanjangan" '+(((actionJSON.perpanjangan != undefined) && (actionJSON.perpanjangan))? '':'style="display:none"')+'>\
				<i class="far fa-calendar-plus"></i> Perpanjangan\
			</a>\
			'
      if (actionJSON.denda != undefined && data.sudah_jatuh_tempo == true) body += '<a href="'+((data.denda_url != undefined) ? data.denda_url:"javascript:;")+'" class="dropdown-item btn-edit-inline" title="Denda" '+(((actionJSON.denda != undefined) && (actionJSON.denda))? '':'style="display:none"')+'>\
				<i class="fas fa-money-check-alt"></i> Perpanjang\
			</a>\
			'
      if (actionJSON.lelang != undefined && data.sudah_jatuh_tempo == true) body += '<a href="'+((data.lelang_url != undefined) ? data.lelang_url:"javascript:;")+'" class="dropdown-item btn-edit-inline" title="Lelang" '+(((actionJSON.lelang != undefined) && (actionJSON.lelang))? '':'style="display:none"')+'>\
				<i class="fas fa-people-carry"></i> Lelang\
			</a>\
			'
      ;
			var footer = '</div></div></div>';
      var combine = container+headerDop+body+footer;
			return combine;
		},
	}
	var columnDef = [];
	var columnsTemp = [];
	var bagdeObject = {};
	var badgeTemplate = function(target){
		return {
				targets: target,
				responsivePriority: 1,
				render: function(data, type, full, meta) {
					var status = {
						"contributor": {'title': 'Contributor', 'class': 'badge-danger'},
						"editor": {'title': 'Editor', 'class': 'badge-success'},
						"admin": {'title': 'Admin', 'class': ' badge-info'},
					};
					return '<span class="badge ' + status[full[bagdeObject["field_"+target]]].class + '">' + status[full[bagdeObject["field_"+target]]].title + '</span>';
				}
		}
	}
	if ($("#table_columnDef").html()!=null || $("#table_columnDef").html()!=""){
		var temp = jQuery.parseJSON($("#table_columnDef").html());
		columnDef.push(temp);
	}
	if ($("#table_column").html()!=null || $("#table_column").html()!=""){
		columnsTemp = jQuery.parseJSON($("#table_column").html());
		if (actionJSON != ""){
			if($('.datatable').length>0){
				var actionColumn = {data:null,mData:null}
				columnsTemp.push(actionColumn);
				columnDef.push(actionInTitle);
			}
			if($('.datatable-post').length>0){
				columnsTemp.push(action);
			}
		}
	}
	$.each(columnsTemp,function(key,value){
		if(value.template != undefined){
			if(value.template == "badgeTemplate"){
				columnDef.push(badgeTemplate(key));
				bagdeObject["field_"+key] = value.data;
			}
		}
	});
	if ($('.datatable').length > 0){
		var table = $('.datatable').DataTable({
        // paging:   false,
        // ordering: false,
        // info:     false,
				responsive: true,
				searchDelay: 500,
				processing: true,
				serverSide: true,
				ordering: false,
				lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
				pageLength: 10,
				dom : '<"top datatable_top"i>rt<"bottom row mt-3 mb-2"<"col-md-3"><"col-md-6 text-center"p><"col-md-3 text-right">><"clear">',
				// ajaxSource:list_url,
        // fnServerParams: function ( aoData ) {
				// 	aoData.push( { "name": "type_data", "value": type_data } );
				// },
				ajax:{
          url : list_url,
          type: "GET",
          data:{
            "type_data" : type_data
          }
        },
        // ajax:list_url,
        // data:function(d){
        //   d.type_data = type_data
        // },
				columns:columnsTemp,
				columnDefs:columnDef,
				sScrollX: false,
				scrollY: true,
  				scrollCollapse: true,
				language: {
					info : "Total _TOTAL_ Data",
                    paginate: {
                        next: '<i class="fas fa-chevron-right"></i>',
                        previous: '<i class="fas fa-chevron-left"></i>'
                    }
                },
				createdRow: function( row, data, dataIndex ) {
          if(data.jatuh_tempo_hari_ini || data.jatuh_tempo_hari_ini == true ){
            $(row).addClass('bg-danger text-white');
          }
          if(data.jatuh_tempo_besok || data.jatuh_tempo_besok == true ){
            $(row).addClass('bg-warning text-white');
          }
          if(data.sudah_jatuh_tempo || data.sudah_jatuh_tempo == true){
            $(row).addClass('bg-dark text-white');
          }
          if(data.sudah_harus_lelang || data.sudah_harus_lelang == true){
            $(row).addClass('bg-dark text-dangerbanget');
          }
          // if(data.sudah_bisa_lelang || data.sudah_bisa_lelang == true){
          //   $(row).addClass('bg-dark text-warningbanget');
          // }
					// $(row).attr('id','post-');
				},
				footerCallback: function(row, data, start, end, display) {
          var api = this.api(), data;
          // Remove the formatting to get integer data for summation
          var intVal = function(i) {
              var rplc =  typeof i === 'string' ? i.replace('Rp ','') : i;
              var temp  = typeof rplc === 'string' ? rplc.replace(/[\$,]/g, '') * 1 : typeof rplc === 'number' ? rplc : 0;
              return temp
          };
          // console.log(sumColumn)
          $.each(sumColumn,function(i,value){
              var column = value;
              var currency = false;
              // Total over all pages
              var total = api.column(column).data().reduce(function(a, b) {
                  return intVal(a) + intVal(b);
              }, 0);
              // Total over this page
              var pageTotal = api.column(column, {page: 'current'}).data().reduce(function(a, b) {
                  currency = b.indexOf('Rp. ') !== -1 ? true : false
                  return intVal(a) + intVal(b);
              }, 0);
              // Update footer
              $(api.column(column).footer()).html(
                  (currency?'Rp. ':'')+numberString(pageTotal.toFixed(0)),
              );
          })
				},

			});
      // table.ajax.reload();
      $(".searchInput").on('keyup', function(e){
          var searchType = $('.searchType').val();
          table.search($(".searchInput").val()+'_'+searchType);
          var params = {};
          $.each(params, function(i, val) {
              // apply search params to datatable
              table.column(i).search(val ? val : '', false, false);
          });
          table.draw();
      });

      $(".searchInputRange").change(function(){
            table.search($(".searchInputRange").val());
            var params = {};
            // $("#akses-pdf").attr('href',current_page+"pdf?key="+$("#generalSearch").val());
            var generalSearch = '';
            if($('#generalSearch').length > 0){
              generalSearch = $("#generalSearch").val();
            }
            $("#akses-excel").attr('href',"excel/export?key="+generalSearch);
            $('.searchInputRange').each(function() {

                var i = $(this).data('col-index');
                if (params[i]) {
                    params[i] += '|' + $(this).val();
                }
                else {
                    params[i] = $(this).val();
                }
                // var url = $("#akses-pdf").attr('href');
                // $("#akses-pdf").attr('href',url+"&"+$(this).data('field')+"="+$(this).val())
                var url = $("#akses-excel").attr('href');
                $("#akses-excel").attr('href',url+"&"+$(this).data('field')+"="+$(this).val())

            });
            $.each(params, function(i, val) {
                // apply search params to datatable
                table.column(i).search(val ? val : '', false, false);
            });
            table.table().draw();
        })

      // custom filter
      // function filterDataTahun() {
      //     $('.datatable').DataTable().search(
      //         $('.selectTahun').val()
      //       ).draw();
      // }
      $('.selectTahun').on('change', function () {
          var searchType = 'tgl_gadai';
          table.search($(this).val()+'_'+searchType);
          var params = {};
          $.each(params, function(i, val) {
              table.column(i).search(val ? val : '', false, false);
          });
          table.draw();
      });

      $('#dataGadai').on('click','.btn-cetakNota', function(){
        $('#modalPrintNota').modal('show');
        var srcNota = $(this).data('urlnota');
        $('#iframeNota').attr('src',srcNota);
      });

      $('#dataGadai').on('click','.btn-deletes', function(e){
        e.preventDefault();
        var action_hapus = $(this).attr('href');
        swal({
            title: "Yakin ingin menghapus data ini?",
            text: "Data yang dihapus tidak akan dapat dikembalikan lagi!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            buttons: ["Batal", "Ya, Hapus data ini"],
        }).then((confirmed) =>{
          if(confirmed){
            $.ajax({
                url: action_hapus,
                type: "GET",
                success: function(response) {
                  swal({
                      title: response.status,
                      text: response.status_text,
                      icon: response.status_icon,
                      button: "OK",
                  })
                  .then((confirmed) => {
                    table.ajax.reload();
                    // window.location.href = response.redirect_url;
                  });
                }
            });
          }else{
            // $('#button_submit').removeAttr('disabled');
            // $('#button_submit').text(btn_action_title);
          }
        })
      });

    }


	// ---------------------------------------------------
	// ------------  END datatable setting -------
	// ---------------------------------------------------
})
