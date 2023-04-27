@extends('layouts.admin.master')
@section('title', 'Settings')
@section('link')
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{ asset('assets/AdminLTE/plugins/iCheck/all.css') }}">

  <link rel="stylesheet" href="{{ asset('assets/AdminLTE/plugins/select2/select2.min.css') }}">
@endsection
@section('content')
<div class="row">
    @include('pages.admin.settings.tampilan.index')
    @include('pages.admin.settings.akun.index')
    @include('pages.admin.settings.library.konten.index')
</div>
@endsection

@section('script')

<script>


$("#formStoreContentAboutUs #input-content").addClass('ckeditor').ckeditor({
        filebrowserUploadUrl: "{{route('admin.uploadFileCKEditor', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });

$('#formStoreContentAboutUs').on('submit', function(e) {
    e.preventDefault()
    var form = $(this);
    var url = form.attr('action')
    var title = form.attr('title')
    var method = form.attr('method')

    var form_data = new FormData(form[0]);
    form_data.append('konten', form.find('#input-content').val())

    swal({
        title: 'Apakah anda akan menyimpan '+title+' ?',
        text: 'Setelah disimpan maka isi konten dari halaman About us akan berubah !',
        showCancelButton: true,
        type: 'question'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: url,
                method: method,
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                beforeSend: function() {
                    swal({
                        title: "Loading . . .",
                        text: "Please wait !",
                        type: "warning",
                        showConfirmButton: false,
                        allowOutsideClick: false
                    })
                },
                success: function(res) {
                    $('#datatables').DataTable().ajax.reload();
                    swal({
                        title: 'Data '+title+' berhasil disimpan !',
                        text: 'Silahkan untuk lihat perubahan di halaman About Us !',
                        type: 'success'
                    })
                },
                error: function(xhr) {
                    err = xhr.resposeJSON;
                    swal({
                        title: 'Data '+title+' gagal disimpan !',
                        text: err.message,
                        type: 'error'
                    })
                }
            })
        }
    });
})

$('#datatables').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{route('admin.settings.library')}}",
    columns: [
        {data: 'DT_RowIndex'},
        {
            data: null,
            render: function(data) {
                return '<a href="'+data.path+'" target="_blank"><img src="'+data.path+'" width="100%" height="100px"></a>';
            }
        },
        {
            data: null,
            render: function(data) {
                if(!$.isEmptyObject(data.content)){
                    if (!$.isEmptyObject(data.content.published_at)) {
                        var published_at = "<p class='badge bg-green'>Telah dipublikasi</p>"
                    }else{
                        var published_at = "<p class='badge bg-yellow'>Belum dipublikasi</p>"

                    }
                    return "<a href='"+data.content.link_show+"' class='text-link'>"+data.content.title+"</a> <br>"+published_at;
                }else{
                    return "<p class='badge bg-red'>Data tidak tersedia!</p>";
                }
            }
        },
        {
            data: null,
            render: function(data) {
                if(!$.isEmptyObject(data.content)){
                    return data.content.type;
                }else{
                    return "<p class='badge bg-red'>Data tidak tersedia!</p>";
                }
            }
        },
        {
            data: null,
            render: function(data) {
                return data.created_at;
            }
        },
        {
            data: null,
            render: function(data) {
                return '<a href="'+data.action.link_delete+'" class="btn btn-danger btn-xs btn-destroy-file-ckeditor"><i class="fa fa-trash"></i></a>';
            }
        }
    ]
});

$('#datatables-ourClients').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{route('admin.settings.tampilan.ourClients.data')}}",
    columns: [
        {data: 'DT_RowIndex'},
        {
            data: null,
            render: function(data) {
                return '<img src="'+data.path+'" class="img-responsive" alt="'+data.title+'" title="'+data.title+'">'
            }
        },
        {data: 'title'},
        {data: 'created_at'},
        {
            data: null,
            render: function(data) {
                return '<a href="#ourClients-panel" class="btn btn-warning btn-show-ourClient"  data-get="'+data.action.show+'" data-urlupdate="'+data.action.update+'"><i class="fa fa-edit"></i></a> <a href="'+data.action.destroy+'" class="btn btn-danger btn-delete-ourclient"><i class="fa fa-trash"></i></a>';
            }
        }
    ]
});

$(document).on('click', '.btn-show-ourClient', function(e) {
    e.preventDefault()
    var btn = $(this)
    var urlGet = btn.data('get')

    $.ajax({
        url: urlGet,
        method: 'GET',
        success: function(res) {
            $('input[name="nama_client"]').val(res.title)
            $('form#formStoreOurClient').attr('action', btn.data('urlupdate'))
            $('form#formStoreOurClient').attr('data-formtype', 'update')
            btnNewData = `<a href="javascript:void('New Data Our Client')" class="btn btn-primary btn-flat pull-left" id="btnDataBaruOurClient"><i class="fa fa-plus"></i> Data Baru</a>`;
            btnSubmit = `<button type="submit" class="btn btn-success btn-flat pull-right btn-submit-form-ourclient"><i class="fa fa-save"></i> Update</button>`;
            $('.btnGroup').html(btnNewData+btnSubmit)
        }
    })

})

$(document).on('click', '#btnDataBaruOurClient', function(e) {
    e.preventDefault();
    
    $('#formStoreOurClient').attr('action', '{{route("admin.settings.tampilan.ourClients.store")}}');
    $('#formStoreOurClient').attr('data-formtype', 'store')
    $('#formStoreOurClient').trigger('reset');
    $('.btnGroup').html(`<button type="submit" class="btn btn-success btn-flat pull-right btn-submit-form-ourclient"><i class="fa fa-save"></i> Save</button>`)
})

$(document).on('submit', '#formStoreOurClient', function(e) {
    e.preventDefault()
    var form = $(this)
    var url = form.attr('action')
    

    let form_data = new FormData(form[0])

    if (form.attr('data-formtype') == 'store') {
        var method = form.attr('method')
    }else if(form.attr('data-formtype') == 'update'){
        var method = 'post'
        
    form_data.append('_method', 'PUT');

    }else{
        var method = null

    }
    var title = form.attr('title')
    $.ajax({
        url: url,
        method: method,
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        beforeSend: function() {
            swal({
                title: "Loading . . .",
                text: "Please wait !",
                type: "warning",
                showConfirmButton: false,
                allowOutsideClick: false
            })
        },
        success: function(res) {
            if (form.attr('data-formtype') == 'store') {
                form.trigger('reset')
            }

                swal({
                    title: "Success !",
                    text: "Success !",
                    type: "success",
                    showConfirmButton: true
                })

            $('#datatables-ourClients').DataTable().ajax.reload();
        }
    })

    
})

$(document).on('click', '.btn-delete-ourclient', function(e) {
    e.preventDefault()
    var url = $(this).attr('href')

    swal({
        title: 'Apakah anda yakin akan menghapus data ini ?',
        text: 'Hapus Data Our Client',
        type: 'question',
        showCancelButton: true
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: url,
                method: 'post',
                data: {
                    '_method': 'DELETE'
                },
                beforeSend: function() {
                    swal({
                        title: "Loading . . .",
                        text: "Please wait !",
                        type: "warning",
                        showConfirmButton: false,
                        allowOutsideClick: false
                    })
                },
                success: function(res) {
                    $('#datatables-ourClients').DataTable().ajax.reload();
                    swal({
                        title: 'Data berhasil dihapus !',
                        text: 'Success',
                        type: 'success'
                    })
                },
                error: function(xhr) {
                    err = xhr.responseJSON
                    swal({
                        title: 'Oops.. !',
                        text: err.message,
                        type: 'error'
                    })
                }
            }) 
        }
    })

})

$(document).on('click', '.btn-destroy-file-ckeditor', function(e) {
   e.preventDefault();
   var url = $(this).attr('href');
   swal({
            title: "Apakah anda yakin akan menghapus file ini? Jika dihapus maka anda harus kembali cek konten anda dan untuk memperbaikinya !",        
            text: "Menghapus File dari inputan konten",
            type: "question",
            showCancelButton: true
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: url,
                    method: 'delete',
                    beforeSend: function () {
                        swal({
                            title: "Loading . . .",
                            text: "Please wait !",
                            type: "warning",
                            showConfirmButton: false,
                            allowOutsideClick: false
                        })
                    },
                    success: function(res) {
                        $('#datatables').DataTable().ajax.reload();
                        swal({
                            title: 'Success',
                            text: 'Success',
                            type: 'success'
                        })
                    },error: function(xhr) {
                        var err = xhr.responseJSON;

                        swal({
                            title: 'Oops.. !',
                            text: err.message,
                            type: 'error'
                        })
                    }
                })
            }
        });
})

$(document).on('click', '#btnRefreshData', function(){
  $('#datatables').DataTable().ajax.reload();
});
$(document).on('click', '#btnRefreshDataOurClient', function(){
  $('#datatables-ourClients').DataTable().ajax.reload();
});

    $(document).on('submit', '#form-update-data-account', function(e){
        e.preventDefault();
        var form = $(this); 
        var url = form.attr('action');
        var method = form.attr('method');
        var form_data = new FormData(form[0]); 

        swal({
            title: "Apakah anda akan mengubah data ?",
            type: "question",
            showCancelButton: true
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: url,
                    method: method,
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data, 
                    beforeSend: function() {
                        swal({
                        title: "Loading . . .",
                        type: "warning",
                        showConfirmButton: false,
                        allowOutsideClick: false
                        })
                    },
                    success: function(res) {
                        swal({
                            title: "Success !",
                            type: "success",
                            text: res.message,
                            showCancelButton: false,
                        })
                        $('p#admin_name').text(res.account.name)
                        $('a#admin_email').text(res.account.email)
                    },
                    error: function(xhr) {
                        var err = xhr.responseJSON;
                        var statusCode = xhr.status;
                        if(statusCode == '500'){
                        swal({
                            title: "Error !",
                            type: "error",
                            text: err.message,
                            showCancelButton: false,
                        })
                        }else if(statusCode == '400'){
                        swal({
                            title: "Harap cek kembali !",
                            type: "warning",
                            text: err.message,
                            showCancelButton: false,
                        })
                        }
                    }
                    });
            }
        });
    })
    $(document).on('submit', '#form-change-password', function(e){
        e.preventDefault();
        var form = $(this); 
        var url = form.attr('action');
        var method = form.attr('method');
        var form_data = new FormData(form[0]); 

        swal({
            title: "Apakah anda akan mengubah password ?",
            type: "question",
            showCancelButton: true
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: url,
                    method: method,
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data, 
                    beforeSend: function() {
                        swal({
                        title: "Loading . . .",
                        type: "warning",
                        showConfirmButton: false,
                        allowOutsideClick: false
                        })
                    },
                    success: function(res) {
                        form.trigger('reset')
                        swal({
                            title: "Success !",
                            type: "success",
                            text: res.message,
                            showCancelButton: true,
                        })
                    },
                    error: function(xhr) {
                        var err = xhr.responseJSON;
                        var statusCode = xhr.status;
                        if(statusCode == '500'){
                        swal({
                            title: "Error !",
                            type: "error",
                            text: err.message,
                            showCancelButton: false,
                        })
                        }else if(statusCode == '400'){
                        swal({
                            title: "Harap cek kembali !",
                            type: "warning",
                            text: err.message,
                            showCancelButton: false,
                        })
                        }
                    }
                    });
            }
        });
    });

    {{--
    $("body").on('click', 'button#btn-checked-delete-all', function(e){
        e.preventDefault();
        swal({
            title: "Apakah anda akan menghapus semua yang dipilih pada data ini ?",
            type: "question",
            showCancelButton: true
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: "{{route('admin.settings.library.deleteAllChecked')}}",
                    method: "POST",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: {
                        
                    }
                    beforeSend: function() {
                        swal({
                        title: "Loading . . .",
                        type: "warning",
                        showConfirmButton: false,
                        allowOutsideClick: false
                        })
                    },
                    success: function(res) {
                        swal({
                            title: "Success !",
                            type: "success",
                            text: res.message,
                            showCancelButton: false,
                        })
                    },
                    error: function(xhr) {
                        var err = xhr.responseJSON;
                        var statusCode = xhr.status;
                        if(statusCode == '500'){
                        swal({
                            title: "Error !",
                            type: "error",
                            text: err.message,
                            showCancelButton: false,
                        })
                        }else if(statusCode == '400'){
                        swal({
                            title: "Harap cek kembali !",
                            type: "warning",
                            text: err.message,
                            showCancelButton: false,
                        })
                        }
                    }
                    });
            }
        });
    })
    --}}

    $(document).on('click', '#btn_add_slide', function(e) {
        e.preventDefault();
        var url = $(this).attr('href')
        $.ajax({
            url: url,
            method: 'POST',
            beforeSend: function(){
                swal({
                    title: 'Loading ...',
                    text: 'Please Wait !',
                    type: 'warning',
                    showConfirmButton: false,
                    allowOutsideClick: false
                })
            },
            success: function(res) {
                swal({
                    title: 'Berhasil menambah Slide !',
                    type: 'success',
                    showConfirmButton: true
                })
                location.reload()
            },
            error: function(xhr) {
                err = xhr.responseJSON;
                swal({
                        title: 'Oops.. !',
                        text: err.message,
                        type: 'error'
                    })
            }
        })
    })

    $(document).on('submit', '.formSaveSlide', function(e) {
        e.preventDefault();
        var form = $(this)
        var url = form.attr('action')
        var title = form.attr('title')
        var method = form.attr('method')
        
        var file_data = $('input.imgSlide').prop('files')[0];   
        var form_data = new FormData(form[0]); 

        swal({
            title: 'Apakah anda akan menyimpan '+title+' ini?',
            type: 'question',
            showCancelButton: true
        }).then((result) => {
            if (result.value) {
                
                $.ajax({
                    url: url,
                    method: method,
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    beforeSend: function(){
                        swal({
                            title: 'Loading ...',
                            text: 'Please Wait !',
                            type: 'warning',
                            showConfirmButton: false,
                            allowOutsideClick: false
                        })
                    },
                    success: function(res) {
                        swal({
                            title: 'Data '+title+' berhasil disimpan !',
                            type: 'success',
                            showConfirmButton: true
                        })
                        location.reload()
                    },
                    error: function(xhr) {
                        err = xhr.responseJSON;
                        statusCode = xhr.status;
                        if(statusCode == 500){
                            swal({
                                title: 'Oops !',
                                type: 'error',
                                text: err.message
                            })
                        }else if(statusCode == 400){
                            swal({
                                title: 'Harap cek kembali inputan anda !',
                                type: 'warning',
                                text: err.message
                            })
                        }
                    }
                })
            }
        });
        
    })

    
    $(document).on('click', '.btn_delete', function(e) {
        e.preventDefault();
        var url = $(this).data('url')
        var title = $(this).attr('title')
        swal({
            title: 'Apakah anda yakin akan menghapus '+title+' ?',
            type: 'question',
            showCancelButton: true
        }).then((result)=>{
            if (result.value) {
                $.ajax({
                    url: url,
                    method: 'DELETE',
                    beforeSend: function() {
                        swal({
                            title: 'Loading ...',
                            text: 'Please Wait !',
                            type: 'warning',
                            showConfirmButton: false,
                            allowOutsideClick: false
                        })  
                    },
                    success: function(res) {
                        swal({
                            title: 'Data '+title+' berhasil dihapus !',
                            type: 'success',
                            showConfirmButton: false
                        })
                        location.reload()
                    },
                    error: function(xhr) {
                        err = xhr.responseJSON;
                        swal({
                            title: 'Oops.. !',
                            text: err.message,
                            type: 'error'
                        })
                    }
                })
            }
        });
    })

</script>
@endsection