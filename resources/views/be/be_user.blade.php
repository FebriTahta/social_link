@extends('layouts.master')

@section('head')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"/>
<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Authentication</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Data User</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="ms-auto">
        </div>
        <hr/>
        <div class="row">
            <div class="col col-xl-6 col-12">
                <input type="hidden" id="login_id" value="{{auth()->user()->role}}">
                <div class="card border-top border-0 border-4 border-danger">
                    <div class="card-body p-5">
                        <div class="card-title d-flex align-items-center">
                            <div><i class="bx bxs-user me-1 font-22 text-danger"></i>
                            </div>
                            <h5 class="mb-0 text-danger">User Registration</h5>
                        </div>
                        <hr>
                        <form id="formsubmit" class="row g-3" method="POST" > @csrf
                            <div class="col-md-12">
                                <label for="inputLastName1" class="form-label">Username</label>
                                <div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-user'></i></span>
                                    <input type="text" name="name" class="form-control border-start-0" id="inputLastName1" placeholder="Username" required/>
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="inputChoosePassword" class="form-label">Password</label>
                                <div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-lock-open' ></i></span>
                                    <input type="text" name="password" id="password" class="form-control border-start-0 @error('password') is-invalid @enderror" id="inputChoosePassword" placeholder="Choose Password" required/>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <input type="submit" id="btnsubmit" class="btn btn-danger px-5" value="Register">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-6">
                <div class="card card-body">
                    <div id="errList" class="text-uppercase">
    
                    </div>
                    <div class="table-responsive">
                        <table id="example" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; ">
                            <thead class="text-uppercase ">
                                <tr>
                                    <th>Name</th>
                                    @if (auth()->user()->role == 'admin')
                                    @else
                                    <th>Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>    
    </div>
</div>

<div id="modaldel" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">DELETE ITEM</h5>
            </div>
            <form id="formdel" class="was-validated" enctype="multipart/form-data" method="post">@csrf
                <div class="modal-body">
                    <input type="hidden" name="id" id="id_del">
                    <div class="p-4 border rounded">
                        <p>YAKIN AKAN MENGHAPUS ITEM INI ?</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="delclose" data-dismiss="modal">Close</button>
                    <input type="submit" id="btndel" class="btn btn-danger" value="Yes Delete">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function () {
            var log_id = $('#login_id').val();
            console.log(log_id);
            if (log_id !== 'admin') {
                // view data table
                $(document).ready(function(){
                    var table = $('#example').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: "{{ route('be_user.data') }}",
                        columns: [
                            {data: 'name', name: 'name'},
                            {
                                data: 'action', 
                                name: 'action', 
                                orderable: true, 
                                searchable: true
                            },
                        ]
                    });
                });
            }else{
                $(document).ready(function(){
                    var table = $('#example').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: "{{ route('be_user.data') }}",
                        columns: [
                            {data: 'name', name: 'name'},
                        ]
                    });
                });
            }
        })
        $('#modaldel').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var modal = $(this)
            modal.find('.modal-body #id_del').val(id);
        })

        $('#formdel').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
            type:'POST',
            url: "{{ route('be_user.dell')}}",
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
            beforeSend:function(){
                $('#btndel').attr('disabled','disabled');
                $('#btndel').val('Process');
            },
            success: function(response){
                if(response.status == 200)
                {
                    // $("#formupdateproduct")[0].reset();
                    var oTable = $('#example').dataTable();
                    oTable.fnDraw(false);
                    $('#btndel').val('Delete');
                    $('#btndel').attr('disabled',false);
                    $('#modaldel').modal('hide');
                    toastr.success(response.message);
                }else{
                        $('#btndel').val('Delete');
                        $('#btndel').attr('disabled',false);
                        $('#modaldel').modal('hide');
                        toastr.error(response.message);
                        $('#errList').html("");
                        $('#errList').addClass('alert alert-danger');
                        $.each(response.errors, function(key, err_values) {
                            $('#errList').append('<div>'+err_values+'</div>');
                        });
                    }
            },
            error: function(data)
            {
                console.log(data);
            }
            });
        });

    $('#formsubmit').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type:'POST',
            url: "{{ route('be_user.store')}}",
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
            beforeSend:function(){
                $('#btnsubmit').attr('disabled','disabled');
                $('#btnsubmit').val('Process');
            },
            success: function(response){
                if(response.status == 200)
                {
                    var oTable = $('#example').dataTable();
                    oTable.fnDraw(false);
                    $('#formsubmit')[0].reset();
                    $('#btnsubmit').val('Register');
                    $('#btnsubmit').attr('disabled',false);
                    toastr.success(response.message);
                    $('#errList').removeClass('alert alert-danger');
                    $('#card_link a').remove();

                }else{
                    
                    $('#btnsubmit').val('Register');
                    $('#btnsubmit').attr('disabled',false);
                    $('#errList').html("");
                    $('#errList').addClass('alert alert-danger');
                    $.each(response.errors, function(key, err_values) {
                        $('#errList').append('<div>'+err_values+'</div>');
                    });
                    toastr.error(response.message);
                }
            },
            error: function(data)
            {
                console.log(data);
            }
        });
    });

    
    </script>
@endsection