$(document).ready(function() {
  // ---------------------------------------------------
	// ----------------  datatable setting ---------------
	// ---------------------------------------------------
	var base_url = $('#base_url').val();
	var list_url = $('#list_url').val();
	var actionJSON = $("#table_action").html() != "" ? jQuery.parseJSON($("#table_action").html()) : "";
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
      if (actionJSON.detail != undefined) body += '<a href="#" class="dropdown-item btn-edit-inline btn-detail" data-kdpinjaman="'+data.kode_pinjaman+'" title="Detail" '+(((actionJSON.detail != undefined) && (actionJSON.detail))? '':'style="display:none"')+'>\
				<i class="far fa-eye"></i> Detail\
			</a>\
			'
      if (actionJSON.edit != undefined) body += '<a href="'+((data.update_url != undefined) ? data.update_url:"javascript:;")+'" data-idbtn="'+data.id+'" class="dropdown-item btn-edit-inline" title="Edit" '+(((actionJSON.edit != undefined) && (actionJSON.edit))? '':'style="display:none"')+'>\
				<i class="far fa-edit"></i> Edit\
			</a>\
			'
      if (actionJSON.delete != undefined) body += '<a href="'+((data.delete_url != undefined) ? data.delete_url:"javascript:;")+'" class="dropdown-item btn-deletes" title="Delete" '+(((actionJSON.delete != undefined) && (actionJSON.delete))? '':'style="display:none"')+'>\
				<i class="far fa-trash-alt"></i> Hapus\
			</a>\
			'
      if (actionJSON.pembayaran != undefined) body += '<a href="'+((data.pembayaran_url != undefined) ? data.pembayaran_url:"javascript:;")+'" class="dropdown-item btn-edit-inline" title="pembayaran" '+(((actionJSON.pembayaran != undefined) && (actionJSON.pembayaran))? '':'style="display:none"')+'>\
				<i class="fas fa-hand-holding-usd"></i> Pembayaran\
			</a>\
			'
      if (actionJSON.perpanjangan != undefined) body += '<a href="'+((data.perpanjangan_url != undefined) ? data.perpanjangan_url:"javascript:;")+'" class="dropdown-item btn-edit-inline" title="perpanjangan" '+(((actionJSON.perpanjangan != undefined) && (actionJSON.perpanjangan))? '':'style="display:none"')+'>\
				<i class="far fa-calendar-plus"></i> Perpanjangan\
			</a>\
			'
      if (actionJSON.denda != undefined) body += '<a href="'+((data.denda_url != undefined) ? data.denda_url:"javascript:;")+'" class="dropdown-item btn-edit-inline" title="Denda" '+(((actionJSON.denda != undefined) && (actionJSON.denda))? '':'style="display:none"')+'>\
				<i class="fas fa-money-check-alt"></i> Denda\
			</a>\
			'
      if (actionJSON.lelang != undefined) body += '<a href="'+((data.lelang_url != undefined) ? data.lelang_url:"javascript:;")+'" class="dropdown-item btn-edit-inline" title="Lelang" '+(((actionJSON.lelang != undefined) && (actionJSON.lelang))? '':'style="display:none"')+'>\
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
				responsive: true,
				searchDelay: 500,
				processing: true,
				serverSide: true,
				ordering: true,
				lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
				pageLength: 10,
				dom : '<"top datatable_top"i>rt<"bottom row mt-3 mb-2"<"col-md-3"><"col-md-6 text-center"p><"col-md-3 text-right">><"clear">',
				ajaxSource:list_url,
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
            $(row).addClass('bg-dark text-danger');
          }
					// $(row).attr('id','post-');
				},
				footerCallback: function(row, data, start, end, display) {

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
    }


	var elementEditUser = function(thisId,data){
		var elements = '<tr id="postEdit-'+thisId+'" class="edited_tbl_element">\
				<td colspan="5">\
					<div class="row">\
						<form action="'+base_url+'user/update" id="edit_data_form" method="pos" data-editbox="'+thisId+'">\
							<div class="col-12">\
								<div class="form-row">\
									<div class="col-3">\
										<input type="hidden" name="id" class="form-control" placeholder="Name" value="'+data.id+'">\
										<input type="text" name="name" class="form-control" placeholder="Name" value="'+data.name+'">\
									</div>\
									<div class="col">\
										<input type="text" name="username" class="form-control" placeholder="Username" value="'+data.username+'">\
									</div>\
									<div class="col">\
										<select class="form-control" value="'+data.level+'" name="level">\
											<option value="admin" '+ ((data.level == 'admin')?'selected':'') +'>Admin</option>\
											<option value="editor" '+ ((data.level == 'editor')?'selected':'') +'>Editor</option>\
											<option value="contributor" '+ ((data.level == 'contributor')?'selected':'') +'>Contributor</option>\
										</select>\
									</div>\
									<div class="col">\
										<button class="btn btn-danger btn-sm close_edit_tbl" data-editbox="'+thisId+'">Cencel</button>\
										<button class="btn btn-primary btn-sm " data-editbox="'+thisId+'" id="save_edit" type="submit">Save</button>\
									</div>\
								</div>\
							</div>\
						</form>\
					</div>\
				</td>\
			</tr>';

		return elements;
	}


	$("#data_user").on('click','.btn-edit-inline', function(){
		$('.edited_tbl_element').remove();
		$('.TdData').children('.first_child').removeClass('border-left-tbl');
		var thisId = $(this).data('idbtn');
		var get_data = $(this).siblings('textarea').val();
		var parse_data = JSON.parse(get_data);
		$('#post-'+thisId).after(elementEditUser(thisId,parse_data));
		$('#post-'+thisId).children('.first_child').addClass('border-left-tbl');
	});
	$("#data_user").on('click','.close_edit_tbl', function(){
		var thisId = $(this).data('editbox');
		clode_formEdit(thisId);
	});
	$('#data_user,#data_texonomy').on('click','.btn-deletes',function(e){
		var json = $(this).siblings('textarea').val();
		var data = JSON.parse(json);
		var route = data.delete_url;
		e.preventDefault(0);
		Swal.fire({
		title: 'Are you sure?',
		text: "You won't be able to revert this!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes, delete it!'
		}).then((result) => {
		if (result.isConfirmed) {
			$.ajax({
				url: route,
				type: "delete",
				beforeSend: function () {
					// $('.wrapper-loading').hide().removeClass('hidden').fadeIn();
				},
				success: function (response) {
					var data = jQuery.parseJSON(response);
					// console.log(data);
					if (data.stataus){
						if($('.datatable').length > 0){
							table.ajax.reload();
							GrowlNotification.notify({
								title: 'Berhasil',
								description: 'Data Berhasil Dihapus',
								type: 'warning',
								position: 'top-right',
								closeTimeout: 3500,
								showProgress: true
							});
							// Swal.fire(
							// 'Deleted!',
							// 'Your file has been deleted.',
							// 'success'
							// )
						}
					}else {
						swal.fire({
							type: 'error',
							text:data.msg,
							showConfirmButton: false,
							timer: 1500
						});
					}
				},
				error: function(request) {
					swal.fire({
						title: "Ada yang Salah",
						html: request.responseJSON.message,
						type: "warning"
					});
				}
			});
		}
		})
	})
	function clode_formEdit(thisId){
		$('#postEdit-'+thisId).remove();
		$('#post-'+thisId).children('.first_child').removeClass('border-left-tbl');
	}
	// ---------------------------------------------------
	// ------------  END datatable setting -------
	// ---------------------------------------------------
})
