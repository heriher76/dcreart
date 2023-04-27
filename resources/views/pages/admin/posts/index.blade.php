@extends('layouts.admin.master')
@section('title', 'Data Postingan')
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
          <button data-url="{{route('admin.post.create')}}" data-title="Buat Postingan" class="btn btn-success btn-xs btn-show-modal" data-toggle="modal" data-target="#myModal">
              <i class="fa fa-plus"></i> Buat Postingan
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
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Published</th>
                    <th>Dibuat pada</th>
                    <th>Aksi</th>
                </thead>
                <tbody></tbody>
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
    order: [[4, 'DESC']],
    ajax: "{{route('admin.post.data')}}",
    columns: [
        {data: "DT_RowIndex"},
        {data: "title"},
        {
          data: "category",
          render: function(data, type, row) {
            
            var categoryData = '';
            if (!$.isEmptyObject(data)) {
              for (i = 0; i < data.length; i++) {
                categoryData += `<a href="#" class="badge bg-green text-xs badge-xs">`+data[i].name+`</a>`;
              }
            }
            

            return categoryData
          }
        },
        {
          data: null,
          render: function(data) {
            return data.published == true ? 
            `<label class="btn btn-primary text-center">
                <input type="checkbox" data-slug=`+data.slug+` name="publish" class="minimal checkboxOnTable" data-published="`+data.published+`" id="publish`+data.id+`" data-title="`+data.title+`" checked>
            </label>`:
            `<label class="btn btn-primary text-center">
                <input type="checkbox" data-slug=`+data.slug+` name="publish" class="minimal checkboxOnTable" data-published="`+data.published+`" id="publish`+data.id+`" data-title="`+data.title+`" data-slug="`+data.slug+`">
            </label>`;
          }
        },
        {data: "created_at"},
        {
          data: null,
          render: function(data) {
            return `
            <a href="`+data.action.previewAsReader+`" class="btn btn-info btn-xs" target="_blank">
              <i class="fa fa-eye"></i> Lihat Sebagai Pembaca
            </a>
            <button data-url="`+data.action.edit+`" data-title="Edit - `+data.title+`" class="btn btn-warning btn-xs btn-show-modal" data-toggle="modal" data-target="#myModal">
              <i class="fa fa-pencil"></i> Edit
          </button>
          <button data-url="`+data.action.delete+`" data-title="`+data.title+`" data-slug="`+data.slug+`" class="btn btn-danger btn-xs btn-delete">
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

    $('.btn-submit').html('<i class="glyphicon glyphicon-floppy-disk"></i> Simpan')

    var url = $(this).attr('action');
    var method = $(this).attr('method');

    var file_data = $('input#uploadFile').prop('files')[0];   
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
            
            swal({
              title: "Error !",
              type: "error",
              text: err.message,
              showCancelButton: false,
            })
          }
        });
      }
    });
})

$(document).on('click', '.btn-delete', function() {
  var title = $(this).data('title');
  var slug = $(this).data('slug');
  var url = $(this).data('url');

  swal({
      title: "Data '"+title+"' akan dihapus ?",
      type: "question",
      showCancelButton: true,
    }).then((result) => {
      if (result.value) {
        $.ajax({
          url: url,
          method: 'PUT',
          dataType: "json",
          data: {
            "_method": "DELETE",
            "slug": slug
          },
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