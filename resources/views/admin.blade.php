<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Data Barang</title>
        <link rel="stylesheet" href="{{ asset('bootstrap-5.0.2-dist/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('bootstrap-5.0.2-dist/css/datatables.min.css') }}">
        <link rel="stylesheet" href="{{ asset('bootstrap-5.0.2-dist/css/sweetalert2.min.css') }}">
        <style>
            .card{
                box-shadow: 0px 2px 30px rgb(0 0 0 / 10%);
                border: none;
                border-radius: 50px;
            }
            .card-header:first-child {
                border-radius: 50px 50px 0px 0px;
                padding-left: 2rem; padding-right: 2rem;
            }
            tbody, td, tfoot, th, thead, tr {
                border-style: none;
            }
            tbody, thead{
                font-size: 14px;
            }
            div.dataTables_wrapper div.dataTables_length label, div.dataTables_wrapper div.dataTables_filter label{
                font-size: 14px;
            }
            .form-select-sm, .form-control-sm, div.dataTables_wrapper div.dataTables_info, .pagination, .btn-group-sm>.btn, .btn-sm{
                font-size: .75rem;
            }
            .btn-group-sm>.btn, .btn-sm{
                font-size: .85rem;
            }
            .center{
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <p>
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6"><p class="h5">Data Barang</p></div>
                        <div class="col-6"><button type="button" class="btn btn-primary float-end btn-sm" data-bs-toggle="modal" data-bs-target="#add-data-modal">Add Data</button></div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="container">
                        <p>
                        <table class="table table-striped" id="data">
                            <thead>
                                <tr>
                                    {{-- <th>No</th> --}}
                                    <th>Nama Barang</th>
                                    <th>Harga Jual</th>
                                    <th>Stock</th>
                                    <th>Foto</th>
                                    <th align="center" style="text-align: center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Add Data -->
        <div class="modal fade" id="add-data-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title_modal">Add Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="wrapper_alert">
                        <div class="alert alert-danger d-flex align-items-center" role="alert">
                            <div id="msg_error">
                              An example alert with an icon
                            </div>
                        </div>
                    </div>
                    <div id="wrapper_alert_success">
                        <div class="alert alert-success d-flex align-items-center" role="alert">
                            <div id="msg_success">
                              An example alert with an icon
                            </div>
                        </div>
                    </div>
                    <form method="post" action="" enctype="multipart/form-data" id="form_data">
                        <div class="mb-3 row">
                            <label for="nm_brg" class="col-sm-3 col-form-label">Nama Barang</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" id="nm_brg" placeholder="Nama Barang">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="hrg_jual" class="col-sm-3 col-form-label">Harga Jual</label>
                            <div class="col-sm-9">
                            <input type="number" class="form-control" id="hrg_jual" placeholder="Harga Jual">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="stock" class="col-sm-3 col-form-label">Stock</label>
                            <div class="col-sm-9">
                            <input type="number" class="form-control" id="stock" placeholder="Stock">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="foto" class="col-sm-3 col-form-label">Foto</label>
                            <div class="col-sm-9">
                            <input type="file" class="form-control" id="file" placeholder="Foto">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn_simpan"><i data-feather="save"></i> Simpan</button>
                </div>
            </div>
            </div>
        </div>

        <!-- Modal Edit Data -->
        <div class="modal fade" id="edit-data-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title_modal">Edit Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="wrapper_alert_edit">
                        <div class="alert alert-danger d-flex align-items-center" role="alert">
                            <div id="msg_error_edit">
                              An example alert with an icon
                            </div>
                        </div>
                    </div>
                    <div id="wrapper_alert_success_edit">
                        <div class="alert alert-success d-flex align-items-center" role="alert">
                            <div id="msg_success_edit">
                              An example alert with an icon
                            </div>
                        </div>
                    </div>
                    <form method="post" action="" enctype="multipart/form-data" id="form_data_edit">
                        <input type="hidden" id="id_edit">
                        <div class="mb-3 row">
                            <label for="nm_brg" class="col-sm-3 col-form-label">Nama Barang</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" id="nm_brg_edit" placeholder="Nama Barang">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="hrg_jual" class="col-sm-3 col-form-label">Harga Jual</label>
                            <div class="col-sm-9">
                            <input type="number" class="form-control" id="hrg_jual_edit" placeholder="Harga Jual">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="stock" class="col-sm-3 col-form-label">Stock</label>
                            <div class="col-sm-9">
                            <input type="number" class="form-control" id="stock_edit" placeholder="Stock">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="foto" class="col-sm-3 col-form-label">Foto</label>
                            <div class="col-sm-9">
                            <input type="file" class="form-control" id="file_edit" placeholder="Foto">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn_simpan_edit"><i data-feather="save"></i> Simpan</button>
                </div>
            </div>
            </div>
        </div>

    </body>
    <script src="{{ asset('jquery/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('bootstrap-5.0.2-dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('jquery/datatables.min.js') }}"></script>
    <script src="{{ asset('jquery/sweetalert2.all.min.js') }}"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script>
        $(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            feather.replace();
            $('#wrapper_alert').css({'display':'none'});
            $('#wrapper_alert_success').css({'display':'none'});
            $('#wrapper_alert_edit').css({'display':'none'});
            $('#wrapper_alert_success_edit').css({'display':'none'});

            createData();
            $('#file').on('change', function(){
                let size  =  $('#file')[0].files[0].size / 1024;
                let ext = $('#file')[0].files[0].type;
                // if((ext == 'image/png' || ext =='image/jpeg' || ext =='image/jpg') && size < 100){
                if( size < 100){
                    $('#wrapper_alert').fadeOut('fast');
                    $('#msg_error').text('');
                    $('.btn_simpan').prop('disabled',false);
                }
                else{
                    $('#wrapper_alert').fadeIn('slow');
                    $('#msg_error').text('Oopss file yang di izinkan tidak boleh lebih dari 100kb');
                    $('.btn_simpan').prop('disabled',true);
                }
            });

            $('#file_edit').on('change', function(){
                let size  =  $('#file_edit')[0].files[0].size / 1024;
                let ext = $('#file_edit')[0].files[0].type;
                if((ext == 'image/png' || ext =='image/jpeg' || ext =='image/jpg') && size < 100){
                    $('#wrapper_alert').fadeOut('fast');
                    $('#msg_error').text('');
                    $('.btn_simpan_edit').prop('disabled',false);
                }
                else{
                    $('#wrapper_alert').fadeIn('slow');
                    $('#msg_error').text('Oopss file yang di izinkan hanya .jpg atau .png dan tidak boleh lebih dari 100kb');
                    $('.btn_simpan_edit').prop('disabled',true);
                }
            });

            $('.btn_simpan').on('click', function(){
                if($('#nm_brg').val() == '' || $('#hrg_jual').val() == '' || $('#stock').val() == ''){
                    Swal.fire('Oopss','Nama Barang, Harga Beli, Harga Jual, dan Stock Tidak Boleh Kosong!','error')
                }
                else{
                    let data = new FormData($('#form_data')[0]);
                        data.append('foto', $('input[type=file]')[0].files[0]);
                        data.append('nm_brg', $('#nm_brg').val());
                        data.append('hrg_jual', $('#hrg_jual').val());
                        data.append('stock', $('#stock').val());
                    $.ajax({
                        type:'POST',
                        url:'/save',
                        data:data,
                        enctype:"multipart/form-data",
                        contentType: false,
                        cache: false,
                        processData: false,
                        beforeSend:function(){

                        },
                        success:function(data){
                            // let json = JSON.parse(data);
                            if(data.msg == 'exist'){
                                $('#wrapper_alert').slideDown('fast');
                                $('#msg_error').text('Oopss nama barang sudah ada');
                                setTimeout(function(){
                                    $('#wrapper_alert').slideUp('fast');
                                    $('#msg_error').text();
                                }, 3000);
                            }
                            else if(data.msg == 'success'){
                                clear();
                                $('#data').DataTable().destroy();
                                $('#wrapper_alert_success').slideDown('fast');
                                $('#msg_success').text('Barang berhasil ditambah');
                                createData();
                                setTimeout(function(){
                                    $('#wrapper_alert_success').slideUp('fast');
                                    $('#msg_success').text();
                                    $('#add-data-modal').modal('hide');
                                }, 3000);
                            }
                            else if(data.msg == 'error'){
                                $('#wrapper_alert').slideDown('fast');
                                $('#msg_error').text('Oopss gagal menyimpan data');
                                setTimeout(function(){
                                    $('#wrapper_alert').slideUp('fast');
                                    $('#msg_error').text();
                                }, 3000);
                            }
                        }
                    })
                }
            });

            $('.btn_simpan_edit').on('click', function(){
                if($('#nm_brg_edit').val() == '' || $('#hrg_jual_edit').val() == '' || $('#stock_edit').val() == '') {
                    Swal.fire('Oopss','Nama Barang, Harga Beli, Harga Jual, dan Stock Tidak Boleh Kosong!','error')
                }
                else{
                    let data = new FormData($('#form_data_edit')[0]);
                        data.append('foto1', $('#file_edit')[0].files[0]);
                        data.append('nm_brg', $('#nm_brg_edit').val());
                        data.append('hrg_jual', $('#hrg_jual_edit').val());
                        data.append('stock', $('#stock_edit').val());
                        data.append('id', $('#id_edit').val());
                    $.ajax({
                        type:'POST',
                        url:'/update',
                        data:data,
                        enctype:"multipart/form-data",
                        contentType: false,
                        cache: false,
                        processData: false,
                        beforeSend:function(){

                        },
                        success:function(res){
                            if(res.msg == 'success'){
                                clear();
                                $('#data').DataTable().destroy();
                                $('#wrapper_alert_success_edit').slideDown('fast');
                                $('#msg_success_edit').text('Barang berhasil di update');
                                createData();
                                setTimeout(function(){
                                    $('#wrapper_alert_success_edit').slideUp('fast');
                                    $('#msg_success').text();
                                    $('#edit-data-modal').modal('hide');
                                }, 3000);
                            }
                            else if(res.msg == 'error'){
                                $('#wrapper_alert_success_edit').slideDown('fast');
                                $('#msg_error_edit').text('Oopss gagal update data');
                                setTimeout(function(){
                                    $('#wrapper_alert_success_edit').slideUp('fast');
                                    $('#msg_error_edit').text();
                                }, 3000);
                            }
                        }
                    })
                }
            });

            $('#data').on('click', '.delete', function(){
            let id = $(this).data('id');
                Swal.fire({
                    title: 'Hapus data ini ?',
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: `Ya`,
                    denyButtonText: `Tidak`,
                    icon:`warning`
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.post( "/delete", { id: id }, function( data ) {
                            if(data.msg=='success'){
                                $('#data').DataTable().destroy();
                                Swal.fire('Berhasil!','Data berhasil di hapus' , 'success');
                                createData();
                            }
                            else{
                                Swal.fire('Gagal!','Data gagal di hapus' , 'error');
                            }
                        },"json");
                    }
                })
            });

            $('#data').on('click', '.edit', function(){
                let id = $(this).data('id');
                let foto = $(this).data('img');
                $('#edit-data-modal').modal('show');

                var row = $(this).closest("tr");
                $('#nm_brg_edit').prop ('disabled',true);
                $('#nm_brg_edit').val(row.find("td:nth-child(1)").text());
                $('#hrg_jual_edit').val(row.find("td:nth-child(3)").text());
                $('#stock_edit').val(row.find("td:nth-child(4)").text());
                $('#id_edit').val(id);
                // $('#file_edit').val(foto);
            })

        })

        function clear(){
            $('#nm_brg').val('');
            $('#hrg_jual').val('');
            $('#stock').val('');
            $('#file').val('');

            $('#nm_brg_edit').val('');
            $('#hrg_jual_edit').val('');
            $('#stock_edit').val('');
            $('#file_edit').val('');
        }

        function createData(){
            $('#data').DataTable({
                processing: true,
                serverSide: true,
                ajax: '/getData',
                "drawCallback": function( settings ) {
                    feather.replace();
                },
                columns: [
                    { data: 'nm_brg', name: 'nm_brg' },
                    { data: 'hrg_jual', name: 'hrg_jual' },
                    { data: 'stock', name: 'stock' },
                    // { data: 'foto', name: 'foto' },
                    {
                        bSortable: false,
                        data: null,
                        className: "center",
                        render: function(d) {
                            return `<img src="/gambar/${d.foto}" style="max-width:30px;" alt="${d.foto}">`;
                        },
                    },
                    {
                        bSortable: false,
                        data: null,
                        className: "center",
                        render: function(d) {
                            return `<button class="btn btn-success btn-sm edit" data-id="${d.id}" data-img="${d.foto}"><i data-feather="edit" width="13"></i> Edit</button>
                                    <button class="btn btn-danger btn-sm delete" data-id="${d.id}"><i data-feather="trash" width="15"></i> Delete</button>`;
                        },
                    }
                ]
            });
        }


    </script>
</html>
