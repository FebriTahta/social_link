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
            <div class="breadcrumb-title pe-3">Application</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Data Background</li>
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
                    <div class="card-body">
                        <div class="card-title d-flex align-items-center">
                            <div><i class="bx bxs-image me-1 font-22 text-primary"></i>
                            </div>
                            <h5 class="mb-0 text-primary"></h5>
                        </div>
                        <hr>
                        <form id="formsubmit" class="row g-3" method="POST" enctype="multipart/form-data"> @csrf
                            <div class="col-md-12">
                                <label for="inputLastName1" class="form-label">Background Image</label>
                                <div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-image'></i></span>
                                    <input type="file" onchange="showPreview(event)" name="img" class="form-control border-start-0" required/>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <img id="preview"
                                src="{{asset('assets/images/avatars/prev.svg')}}" 
                                style="" alt="BG" width="100%">
                            </div>
                            <div class="col-12">
                                <input type="submit" id="btnsubmit" class="btn btn-primary px-5" value="ADD">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-6">
                <div class="row" id="errList" class="text-uppercase">
                    
                </div>
                <div class="row" id="card_img_preview">
                    @foreach ($background as $item)
                    <ul class="card card-body p-2 col-md-4 col-6">
                        <a  data-bs-toggle="modal" data-bs-target="#modaldel" data-id="{{$item->id}}" style="margin: 5px;" href="#{{$item->bg_thumb}}">
                            <img src="{{asset('bg_img_ori/'.$item->bg_thumb)}}" width="100%" style="max-height: 140px" alt="">
                        </a>
                    </ul>
                    @endforeach
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
                        <p>YAKIN MENGHAPUS ITEM INI ?</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="delclose" data-bs-dismiss="modal">Close</button>
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

        function showPreview(event){
            if(event.target.files.length > 0){
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("preview");
                preview.src = src;
                console.log(src);
            }
        }

        $(document).ready(function () {
            var log_id = $('#login_id').val();
            console.log(log_id);
                $('#card_img_preview ul').remove();
                    $.ajax({
                        url:"{{ route('be_bg.get')}}",
                        type: 'get',
                        dataType: 'json',
                            success:function(datas) {
                                for (let index = 0; index < datas.length; index++) {
                                    var card_img_preview = '<ul class="card card-body p-2 col-md-4 col-6"><a  data-bs-toggle="modal" data-bs-target="#modaldel" data-id="'+datas[index].id+'" style="margin: 5px;" href="#"><img  src="bg_img_thumb/'+datas[index].bg_thumb+'" width="100%" style="max-height: 140px" alt=""></a></ul>';
                                    $('#card_img_preview').append(card_img_preview);
                                }
                            }
                    });
                
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
            url: "{{ route('be_bg.dell')}}",
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
                    $('#btndel').val('Delete');
                    $('#btndel').attr('disabled',false);
                    $('#modaldel').modal('hide');
                    toastr.success(response.message);
                    $('#card_img_preview ul').remove();
                    $.ajax({
                        url:"{{ route('be_bg.get')}}",
                        type: 'get',
                        dataType: 'json',
                            success:function(datas) {
                                for (let index = 0; index < datas.length; index++) {
                                    var card_img_preview = '<ul class="card card-body p-2 col-md-4 col-6"><a  data-bs-toggle="modal" data-bs-target="#modaldel" data-id="'+datas[index].id+'" style="margin: 5px;" href="#"><img  src="bg_img_thumb/'+datas[index].bg_thumb+'" width="100%" style="max-height: 140px" alt=""></a></ul>';
                                    $('#card_img_preview').append(card_img_preview);
                                }
                            }
                    });
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
            url: "{{ route('be_bg.store')}}",
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
                    $('#formsubmit')[0].reset();
                    $('#btnsubmit').val('Add');
                    $('#btnsubmit').attr('disabled',false);
                    toastr.success(response.message);
                    $('#errList').removeClass('alert alert-danger');
                    $('#card_img_preview ul').remove();
                    $.ajax({
                        url:"{{ route('be_bg.get')}}",
                        type: 'get',
                        dataType: 'json',
                            success:function(datas) {
                                for (let index = 0; index < datas.length; index++) {
                                    var card_img_preview = '<ul class="card card-body p-2 col-md-4 col-6"><a  data-bs-toggle="modal" data-bs-target="#modaldel" data-id="'+datas[index].id+'" style="margin: 5px;" href="#"><img  src="bg_img_thumb/'+datas[index].bg_thumb+'" width="100%" style="max-height: 140px" alt=""></a></ul>';
                                    $('#card_img_preview').append(card_img_preview);
                                }
                            }
                    });

                }else{
                    
                    $('#btnsubmit').val('Add');
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