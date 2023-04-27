@extends('layouts.admin.master')
@section('title', 'Data Kategori')
@section('link')
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{ asset('assets/AdminLTE/plugins/iCheck/all.css') }}">

  <link rel="stylesheet" href="{{ asset('assets/AdminLTE/plugins/select2/select2.min.css') }}">
@endsection
@section('content')
	<!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">@yield('title')</h3>
          <div class="box-tools pull-right">
          <button data-url="{{route('admin.category.create')}}" data-title="Buat Kategori" class="btn btn-success btn-xs btn-show-modal" data-toggle="modal" data-target="#myModal">
              <i class="fa fa-plus"></i> Buat
          </button>

            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            
          </div>
        </div>
        <div class="box-body">
          <div class="table-responsive">
            <button class="btn btn-info" id="btnRefreshData"><i class="glyphicon glyphicon-refresh"></i> Refresh Data</button>
            <table class="table table-hover" id="datatables">
                <thead>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Keterangan</th>
                    <th>Dibuat pada</th>
                    <th>Diubah pada</th>
                    <th>Aksi</th>
                </thead>
                <tbody></tbody>
                <tfoot>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Keterangan</th>
                    <th>Dibuat pada</th>
                    <th>Diubah pada</th>
                    <th>Aksi</th>
                </tfoot>
            </table>
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          Footer
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->
@endsection

@section('script')
<!-- iCheck 1.0.1 -->
<script src="{{ asset('assets/AdminLTE/plugins/iCheck/icheck.min.js') }}"></script>

<!-- Select2 -->
<script src="{{ asset('assets/AdminLTE/plugins/select2/select2.full.min.js') }}"></script>
<script>
  
  //iCheck for checkbox and radio inputs
  $('input[type="checkbox"].minimal,input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });

$(document).on('click', '#btnRefreshData', function(){
  $('#datatables').DataTable().ajax.reload();
});

$('#datatables').DataTable({
    processing: true,
    serverSide: true,
    order: [[3, 'DESC']],
    ajax: "{{route('admin.category.data')}}",
    columns: [
        {data: "DT_RowIndex"},
        {data: "name"},
        {data: "description"},
        {data: "created_at"},
        {data: "updated_at"},
        {
          data: null,
          render: function(data) {
            return `
            <button data-url="`+data.action.edit+`" data-title="Edit - `+data.name+`" class="btn btn-warning btn-xs btn-show-modal" data-toggle="modal" data-target="#myModal">
              <i class="fa fa-pencil"></i> Edit
          </button>
          <button data-url="`+data.action.destroy+`" data-title="`+data.name+`" data-slug="`+data.name+`" class="btn btn-danger btn-xs btn-delete">
              <i class="fa fa-trash"></i> Hapus
          </button>`;
          }
        },
    ]
});

$(document).on('click', '.btn-show-modal', function(event) {
  event.preventDefault();
  
  var title = $(this).data('title')
  $('.modal-title').text(title);
  var url = $(this).data('url');
  
  $.ajax({
        url: url,
        method: 'GET',
        beforeSend: function() {
          $('.modal-body').html(`
            <div class="panel panel-default panel-body text-center">
              <i class="glyphicon glyphicon-refresh"></i><br>
              <p>Loading . . . </p>
            </div>
          `);
        },
        success: function(res) {
          
            $('.modal-body').html(res)
            $(".modal-body .input-content").addClass('ckeditor').ckeditor({
                filebrowserUploadUrl: "{{route('admin.uploadFileCKEditor', ['_token' => csrf_token() ])}}",
                filebrowserUploadMethod: 'form'
            });
            $(".modal-body .multiple").addClass('select2').select2();
            $('.modal-body input[type="checkbox"],.modal-body input[type="radio"]').addClass('minimal').iCheck({
              checkboxClass: 'icheckbox_minimal-blue',
              radioClass: 'iradio_minimal-blue'
            });
        },
        error: function(xhr) {
            var err = xhr.responseJSON
            $('.modal-body').html(`
            <div class="alert alert-danger text-center">
              <p><b>Oops ...</b></p>
              <p><tt>`+err.message+`</tt></p>
            </div>
          `);
        }
    });
}) 

$(document).on('change', '.checkboxOnTable', function(event) {
  event.preventDefault()
  var dataPublished = $(this).data('published');
  var title = $(this).data('title');
  let slug = $(this).data('slug');
  var url = "{{route('admin.post.checkboxPublish', ':slug')}}";
  urlFix = url.replace(':slug', slug)
  $(this).prop('checked', dataPublished)
  
  swal({
      title: $(this).data('published') == true ? "Apakah anda yakin akan Unpublish '"+title+"'":"Apakah anda yakin akan Publish '"+title+"'",
      type: "question",
      showCancelButton: true,
    }).then((result) => {
      if (result.value) {
        $.ajax({
          url: urlFix,
          method: "PUT",
          dataType: "json",
          data: {
            published: dataPublished
          }, 
          beforeSend: function() {
            swal({
              title: "Loading . . .",
              type: "warning",
              showCancelButton: false,
            })
          },
          success: function(res) {
            $('#myModal').modal('hide');

            $('#datatables').DataTable().ajax.reload();
            swal({
              title: "Success !",
              type: "success",
              text: res.message,
              showCancelButton: false,
            })
          },
          error: function(xhr) {
            var err = xhr.responseJSON;
            
            swal({
              title: "Error !",
              type: "error",
              text: err.message,
              showCancelButton: false,
            })
          }
        });
      }
    })
})

$(document).on('submit', '.form-submit', function(event) {
    event.preventDefault();
    $("#alert-validation").addClass('hide');
    $('.btn-submit').html('<i class="glyphicon glyphicon-floppy-disk"></i> Simpan')

    var url = $(this).attr('action');
    var method = $(this).attr('method');  
    var form_data = new FormData($(this)[0]); 

    swal({
      title: "Data yang diisi sudah sesuai ?",
      type: "question",
      showCancelButton: true,
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
              showCancelButton: false,
            })
            $("#alert-validation").addClass('hide');
          },
          success: function(res) {
            $('#myModal').modal('hide');

            $('#datatables').DataTable().ajax.reload();
            swal({
              title: "Success !",
              type: "success",
              showCancelButton: false,
            })
          },
          error: function(xhr) {
            var err = xhr.responseJSON;
            var statusCode = xhr.status;
            if (statusCode == 400) {
                swal({
                    title: "Wrong Input !",
                    type: "warning",
                    text: err.message,
                    showCancelButton: false,
                });
                $("#alert-validation").removeClass('hide');
                $("#alert-validation").find("ul").html('');
                    $.each( err.message, function( key, value ) {
                        $("#alert-validation").find("ul").append('<li>'+value+'</li>');
                    });
            }else{
                swal({
                    title: "Error !",
                    type: "error",
                    text: err.message,
                    showCancelButton: false,
                })
            }
            
          }
        });
      }
    });
})

$(document).on('click', '.btn-delete', function() {
  var title = $(this).data('title');
  var url = $(this).data('url');

  swal({
      title: "Data '"+title+"' akan dihapus ?",
      type: "question",
      showCancelButton: true,
    }).then((result) => {
      if (result.value) {
        $.ajax({
          url: url,
          method: 'DELETE',
          dataType: "json",
          beforeSend: function() {
            swal({
              title: "Loading . . .",
              type: "warning",
              showCancelButton: false,
            })
          },
          success: function(res) {

            $('#datatables').DataTable().ajax.reload();
            swal({
              title: "Success !",
              type: "success",
              text: res.message,
              showCancelButton: false,
            })
          },
          error: function(xhr) {
            var err = xhr.responseJSON;
            
            swal({
              title: "Error !",
              type: "error",
              text: err.message,
              showCancelButton: false,
            })
          }
        });
      }
    })
})
</script>
@endsection