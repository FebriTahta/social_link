@extends('layouts.master')

@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        @media screen and (max-width: 800px){
            .link {
                margin-right: 100px;
            }
        }
    </style>
@endsection

@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Application</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Tautan Links Social Media</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="ms-auto">
        </div>
        <!--end breadcrumb-->
        {{-- <div class="row"> --}}
            <div class="col">
                {{-- <h6 class="mb-0 text-uppercase">TAUTAN LINKS</h6> --}}
                
                <hr/>
                <div id="errList" class="text-uppercase">
                
                </div>
                <br>
                <div class="row">
                    <div class="col-xl-8" id="field_tautan">
                        <div class="card card-body" style="border-radius: 10px">
                            <h5 class="text-uppercase">Nama & Image Aplikasi</h5>
                            <form id="formaplikasi" method="POST" enctype="multipart/form-data" class="was-validated">@csrf
                                <div class="p-4 border rouunded">
                                    <div class="row">
                                        <div class="mb-1 col-xl-5">
                                            <input type="hidden" name="user_id" value="{{auth()->user()->id}}" required>
                                            <input type="text" name="name" class="form-control" placeholder="nama aplikasi.." required>
                                            <div class="invalid-feedback">nama aplikasi harus diisi</div>
                                        </div>
                                        <div class="mb-1 col-xl-12"></div>
                                        <div class="mb-1 col-xl-10">
                                            <input type="file" onchange="showPreview(event)" name="img" class="form-control">
                                            <div class="invalid-feedback">untuk gambar aplikasi</div>
                                        </div>
                                        <div class="mb-1 col-xl-2 text-right" style="text-align: right">
                                            <input type="submit" value="SUMBIT" id="btnaplikasi" style="max-width: 100px" class="btn btn-primary">
                                        </div>
                                        <div class="mb-1 col-xl-6">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card card-body" style="border-radius: 10px" >
                            <h5>LINK TAUTAN</h5>
                            <form id="formsubmit" class="was-validated" enctype="multipart/form-data" method="post">@csrf
                                <input type="hidden" name="id" value="">
                                <div class="p-4 border rounded">
                                    <div class="row">
                                        <div class="mb-1 col-xl-6">
                                            <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                                            <input value="" type="text" name="name" class="form-control" placeholder="name.." required>
                                            <div class="invalid-feedback">harus diisi</div>
                                        </div>
                                        <div class="mb-1 col-xl-6">
                                            <input value="" type="text" name="link" class="form-control" placeholder="https://link-tautan.com.." required>
                                            <div class="invalid-feedback">harus diisi</div>
                                        </div>
                                        <div class="mb-1 col-xl-6">
                                            
                                        </div>
                                        <div class="md-1 col-xl-6" style="text-align: right">
                                            <input type="submit" id="btnsubmit" style="max-width: 100px" class="btn btn-info text-white" value="SUBMIT"><br>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="btn-group">
                            <button type="button" disabled class="btn btn-primary">PILIH SOCIAL MEDIA</button>
                            <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">	<span class="visually-hidden">Toggle Dropdown</span></button>
                            <div style="text-align: right" class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">	
                                @foreach ($datas_sosmed as $item)
                                    <a class="dropdown-item " data-bs-toggle="modal" data-bs-target="#modalsosmed" id="{{$item->id}}"
                                        data-name="{{$item->name}}" data-sosmed_id="{{$item->id}}" data-icon="{{$item->icon}}" href="javascript:;">{{$item->name}}</a>
                                    <div class="dropdown-divider"></div>
                                @endforeach
                            </div>
                        </div>
                        <hr>
                        <div class="row text-center" id="card_sosmed" style="text-align: center">
                            @foreach ($sub_sosmed as $item)
                            <a href="#0" data-bs-toggle="modal" type="button" data-bs-target="#modalupdatesosmed" data-id="{{$item->id}}" data-link="{{$item->link}}"
                                 data-icon="{{$item->sosmed->icon}}" data-sosmed_id="{{$item->sosmed->id}}" class="col-xl-2 col-4">
                                <div class="card card-body" id="" style="border-radius: 10px" >
                                    <div class="p-3 border rounded">
                                        <div class="">
                                            <i class="lni lni-{{$item->sosmed->icon}}" id="icon" style="font-size: 30px"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                    
                    <div class="col-xl-4">
                        <div class="card card-body text-center;" style="border-radius: 10px; background: transparent; width: 320px">
                            <div style="background-repeat: no-repeat;height: 560px;background-image: url({{asset('pngegg.png')}});">
                                <div id="head_aplikasi">
                                    <div>
                                        <img id="preview"
                                        @if (auth()->user()->aplikasi->img !== null)
                                            src="{{asset('be_img_aplikasi/'.auth()->user()->aplikasi->img)}}" 
                                        @else
                                            src="{{asset('assets/images/avatars/avatar-1.png')}}" 
                                        @endif
                                        style="margin-left: 103px; margin-top:60px" alt="Admin" class="rounded-circle p-1" width="80">
                                        <p style="text-align: center; font-size: 12px; margin-top: 10px" id="nama_aplikasi">
                                            @if (auth()->user()->aplikasi->name !== null)
                                                {{auth()->user()->aplikasi->name}}
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <p style="text-align: center; font-size: 20px; margin-top: 10px" id="card_icon_app">
                                    @foreach ($sub_sosmed as $item)
                                        <i class="lni lni-{{$item->sosmed->icon}}" style="margin: 5px"></i>    
                                    @endforeach
                                </p>
                                <div style="margin-top: 5px"></div>
                                <div style="overflow-y: scroll; height: 270px">
                                    <div style="margin-top: 20px" id="card_link">
                                        @foreach (auth()->user()->link as $key=> $data)
                                        <a href="#{{$data->link}}" data-bs-toggle="modal" data-bs-target="#exampleVerticallycenteredModal"
                                            data-name="{{$data->name}}"  data-link="{{$data->link}}" data-id="{{$data->id}}" data-update="val{{$data->id}}" id="get_val{{$key}}" type="button" style="width: 100%" data-name="{{$data->name}}">
                                            <div class="card card-body link" style="margin-left: 40px; margin-right: 26px; border-radius: 5px">
                                                <div style="text-align: right; font-size: 12px">
                                                    {{$data->name}}
                                                </div>
                                            </div>
                                        </a>    
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        {{-- </div> --}}
        <!--end row-->
    </div>
</div>
<!--end page wrapper -->

<!--Modal-->
<div class="modal fade" id="exampleVerticallycenteredModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">UPDATE LINK</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formupdate" class="was-validated" enctype="multipart/form-data" method="post">@csrf
                <div class="modal-body">
                    <div class="p-4 border rounded">
                        <div class="mb-3">
                            
                            <input type="hidden" name="id" id="id" required>
                            <label for="validationServer01" class="form-label">Name</label>
                            <input type="text" id="name" name="name" class="form-control is-invalid" placeholder="-" required>
                        </div>
                        <div class="mb-3">
                            <label for="validationServer01" class="form-label">Links</label>
                            <input type="text" id="link" name="link" class="form-control is-invalid" placeholder="-" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="button" id="btnconfirmdel" class="btn btn-danger" value="Delete">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <input type="submit" id="btnupdate" class="btn btn-primary" value="Update">
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalsosmed" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">ADD NEW SOCIAL MEDIA</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formsubmitsosmed" class="was-validated" enctype="multipart/form-data" method="post">@csrf
                <div class="p-4 border rounded">
                    <div class="row">
                        <div class="mb-1 col-xl-1">
                            <i id="icon" style="font-size: 40px"></i>
                        </div>
                        <div class="mb-1 col-xl-9">
                            <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                            <input type="hidden" name="sosmed_id" id="sosmed_id">
                            <input value="" type="text" name="link" class="form-control" placeholder="https://link-tautan.com.." required>
                            <div class="invalid-feedback">harus diisi</div>
                        </div>
                        <div class="md-1 col-xl-2" style="text-align: right">
                            <input type="submit" id="btnsubmitsosmed" style="max-width: 100px" class="btn btn-primary text-white" value="SUBMIT"><br>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalupdatesosmed" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">UPDATE LINK SOCIAL MEDIA</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formupdatesosmed" class="was-validated" enctype="multipart/form-data" method="post">@csrf
                <div class="p-4 border rounded">
                    <div class="row">
                        <div class="mb-1 col-xl-1">
                            <i id="icon" style="font-size: 40px"></i>
                        </div>
                        <div class="mb-1 col-xl-7">
                            <input type="hidden" name="id" id="id">
                            <input type="hidden" name="sosmed_id" id="sosmed_id">
                            <input value="" type="text" id="link" name="link" class="form-control" placeholder="https://link-tautan.com.." required>
                            <div class="invalid-feedback">harus diisi</div>
                        </div>
                        <div class="md-1 col-xl-4" style="text-align: right">
                            <input type="button" id="btndelsosmed" data-bs-toggle="modal" data-bs-target="#modaldelsosmed" class="btn btn-danger text-white" value="DELETE">
                            <input type="submit" id="btnupdatesosmed"  class="btn btn-primary text-white" value="UPDATE">
                        </div>
                    </div>
                </div>
            </form>
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

<div id="modaldelsosmed" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">DELETE ITEM</h5>
            </div>
            <form id="formdelsosmed" class="was-validated" enctype="multipart/form-data" method="post">@csrf
                <div class="modal-body">
                    <input type="hidden" name="id" id="id_del">
                    <div class="p-4 border rounded">
                        <p>YAKIN AKAN MENGHAPUS ITEM INI ?</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="delclosesosmed" data-dismiss="modal">Close</button>
                    <input type="submit" id="btndelsosmedok" class="btn btn-danger" value="Yes Delete">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    function showPreview(event){
        if(event.target.files.length > 0){
            var src = URL.createObjectURL(event.target.files[0]);
            var preview = document.getElementById("preview");
            preview.src = src;
            console.log(src);
        }
    }

    $('#btnconfirmdel').click(function(){
        $('#exampleVerticallycenteredModal').modal('toggle');
        $('#modaldel').modal('show');
    });

    $('#delclose').click(function(){
        $('#modaldel').modal('hide');        
    });

    $('#delclosesosmed').click(function(){
        $('#modaldelsosmed').modal('hide');        
    });

    $('#btndelsosmed').click(function() {
        $('#modalupdatesosmed').modal('toggle');
        $('#modaldelsosmed').modal('show');
    })

    $(document).ready(function(){
        $("body").bind("ajaxSend", function(elm, xhr, s){
            if (s.type == "POST") {
                xhr.setRequestHeader('X-CSRF-Token', csrf_token);
            }
        });
    })

    $('#modalsosmed').on('show.bs.modal',function(event) {
        var button      = $(event.relatedTarget)
        var icon        = button.data('icon')
        var name        = button.data('name')
        var sosmed_id   = button.data('sosmed_id')
        var modal       = $(this)
        $(this).find('#sosmed_id').val(sosmed_id);
        $(this).find("i").removeClass();
        $(this).find("i").addClass('lni lni-'+icon);
        console.log(name);
    })

    var id;

    $('#modalupdatesosmed').on('show.bs.modal',function(event) {
        var button      = $(event.relatedTarget)
        var icon        = button.data('icon')
        var link        = button.data('link')
        id              = button.data('id')
        var sosmed_id   = button.data('sosmed_id')
        var modal       = $(this)
        $(this).find('#link').val(link);
        $(this).find('#id').val(id);
        $(this).find('#sosmed_id').val(sosmed_id);
        $(this).find("i").removeClass();
        $(this).find("i").addClass('lni lni-'+icon);
        console.log(icon);
        console.log(id);
    })

    
    $('#exampleVerticallycenteredModal').on('show.bs.modal', function(event) {
        var button  = $(event.relatedTarget)
        id          = button.data('id')
        var name    = button.data('name')
        var link    = button.data('link')
        var modal   = $(this)
        modal.find('.modal-body #name').val(name);
        modal.find('.modal-body #link').val(link);
        modal.find('.modal-body #id').val(id);
    })

    $('#modaldel').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var modal = $(this)
        modal.find('.modal-body #id_del').val(id);
    })

    $('#modaldelsosmed').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var modal = $(this)
        modal.find('.modal-body #id_del').val(id);
    })

    $('#formsubmit').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type:'POST',
            url: "{{ route('be_link.store')}}",
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
                    $('#btnsubmit').val('Submit');
                    $('#btnsubmit').attr('disabled',false);
                    toastr.success(response.message);
                    $('#errList').removeClass('alert alert-danger');
                    $('#card_link a').remove();
                    $('#exampleVerticallycenteredModal').modal('hide');
                    $.ajax({
                        url:"{{ route('be_link.data')}}",
                        type: 'get',
                        dataType: 'json',
                            success:function(datas) {
                                for (let index = 0; index < datas.length; index++) {
                                    card_link = '<a href="#0" data-bs-toggle="modal" data-bs-target="#exampleVerticallycenteredModal" data-name='+datas[index].name+' data-link="'+datas[index].link+'" data-update="val'+datas[index].id+'" data-id="'+datas[index].id+'" id="get_val'+datas[index]+'"><div class="card card-body link" style="margin-left: 40px; margin-right: 26px; border-radius: 5px"><div style="text-align: right; font-size: 12px">'+datas[index].name+'</div></div></a>'
                                    $('#card_link').append(card_link);
                                }
                            }
                    });
                }else{
                    $('#exampleVerticallycenteredModal').modal('toggle');
                    $('#btnsubmit').val('Submit');
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

    $('#formupdate').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        var card_link='';
        $.ajax({
            type:'POST',
            url: "{{ route('be_link.store')}}",
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
            beforeSend:function(){
                $('#btnupdate').attr('disabled','disabled');
                $('#btnupdate').val('Process');
            },
            success: function(response){
                if(response.status == 200)
                {
                    $('#btnupdate').val('Update');
                    $('#btnupdate').attr('disabled',false);
                    $('#exampleVerticallycenteredModal').modal('toggle');
                    toastr.success(response.message);
                    $('#errList').removeClass('alert alert-danger');
                    $('#card_link a').remove();
                    console.log(response.datas.id);
                    $.ajax({
                        url:"{{ route('be_link.data')}}",
                        type: 'get',
                        dataType: 'json',
                            success:function(datas) {
                                for (let index = 0; index < datas.length; index++) {
                                    card_link = '<a href="#0" data-bs-toggle="modal" data-bs-target="#exampleVerticallycenteredModal" data-name='+datas[index].name+' data-link="'+datas[index].link+'" data-update="val'+datas[index].id+'" data-id="'+datas[index].id+'" id="get_val'+datas[index]+'"><div class="card card-body link" style="margin-left: 40px; margin-right: 26px; border-radius: 5px"><div style="text-align: right; font-size: 12px">'+datas[index].name+'</div></div></a>'
                                    $('#card_link').append(card_link);
                                }
                            }
                    });
                }else{

                    $('#btnupdate').val('Update');
                    $('#btnupdate').attr('disabled',false);
                    $('#errList').html("");
                    $('#errList').addClass('alert alert-danger');
                    $('#exampleVerticallycenteredModal').modal('toggle');
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
    // submit subsosmed
    $('#formsubmitsosmed').submit(function(e) {
        e.preventDefault();
        var card_sosmed='';
        var card_icon_app='';
        var formData = new FormData(this);
        $.ajax({
            type:'POST',
            url: "{{ route('be_subsosmed.store')}}",
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
            beforeSend:function(){
                $('#btnsubmitsosmed').attr('disabled','disabled');
                $('#btnsubmitsosmed').val('Process');
            },
            success: function(response){
                if(response.status == 200)
                {
                    $('#formsubmitsosmed')[0].reset();
                    $('#btnsubmitsosmed').val('Submit');
                    $('#btnsubmitsosmed').attr('disabled',false);
                    toastr.success(response.message);
                    $('#errList').removeClass('alert alert-danger');
                    $('#card_sosmed a').remove();
                    $('#card_icon_app i').remove();
                    $('#modalsosmed').modal('hide');
                    $.ajax({
                        url:"{{ route('be_subsosmed.data')}}",
                        type: 'get',
                        dataType: 'json',
                            success:function(datas) {
                                for (let index = 0; index < datas.length; index++) {
                                    card_sosmed = '<a href="#" data-bs-toggle="modal" data-bs-target="#modalupdatesosmed" data-id="'+datas[index].id+'" data-sosmed_id="'+datas[index].sosmed.id+'" data-icon="lni lni-'+datas[index].sosmed.icon+'" data-link="'+datas[index].link+'" class="col-xl-2 col-4"><div class="card card-body" id="" style="border-radius: 10px" ><div class="was-validated"><div class="p-3 border rounded text-center"><div class="col-xl-1"><i class="lni lni-'+datas[index].sosmed.icon+'" id="icon" style="font-size: 30px"></i></div></div></div></div></a>';
                                    card_icon_app = '<i class="lni lni-'+datas[index].sosmed.icon+'" style="margin: 5px"></i>';
                                    $('#card_sosmed').append(card_sosmed);
                                    $('#card_icon_app').append(card_icon_app);
                                }
                            }
                    });
                }else{
                    $('#modalsosmed').modal('hide');
                    $('#btnsubmitsosmed').val('Submit');
                    $('#btnsubmitsosmed').attr('disabled',false);
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

    // form update sosmed
    $('#formupdatesosmed').submit(function(e) {
        e.preventDefault();
        var card_sosmed='';
        var card_icon_app='';
        var formData = new FormData(this);
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type:'POST',
            url: "{{ route('be_subsosmed.store')}}",
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
            beforeSend:function(){
                $('#btnupdatesosmed').attr('disabled','disabled');
                $('#btnupdatesosmed').val('Process');
            },
            success: function(response){
                if(response.status == 200)
                {
                    $('#btnupdatesosmed').val('UPDATE');
                    $('#btnupdatesosmed').attr('disabled',false);
                    toastr.success(response.message);
                    $('#errList').removeClass('alert alert-danger');
                    $('#card_sosmed a').remove();
                    $('#card_icon_app i').remove();
                    $('#modalupdatesosmed').modal('hide');
                    $.ajax({
                        url:"{{ route('be_subsosmed.data')}}",
                        type: 'get',
                        dataType: 'json',
                            success:function(datas) {
                                for (let index = 0; index < datas.length; index++) {
                                    card_sosmed = '<a href="#" data-bs-toggle="modal" data-bs-target="#modalupdatesosmed" data-id="'+datas[index].id+'" data-sosmed_id="'+datas[index].sosmed.id+'" data-icon="lni lni-'+datas[index].sosmed.icon+'" data-link="'+datas[index].link+'" class="col-xl-2 col-4"><div class="card card-body" id="" style="border-radius: 10px" ><div class="was-validated"><div class="p-3 border rounded text-center"><div class="col-xl-1"><i class="lni lni-'+datas[index].sosmed.icon+'" id="icon" style="font-size: 30px"></i></div></div></div></div></a>';
                                    card_icon_app = '<i class="lni lni-'+datas[index].sosmed.icon+'" style="margin: 5px"></i>';
                                    $('#card_sosmed').append(card_sosmed);
                                    $('#card_icon_app').append(card_icon_app);
                                }
                            }
                    });
                }else{
                    $('#btnupdatesosmed').val('UPDATE');
                    $('#modalupdatesosmed').modal('hide');
                    $('#btnupdatesosmed').attr('disabled',false);
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

    // form delete link
    $('#formdel').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        var card_link='';
        $.ajax({
            type:'POST',
            url: "{{ route('be_link.dell')}}",
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
                    $('#btndel').val('Ya Delete');
                    $('#btndel').attr('disabled',false);
                    toastr.success(response.message);
                    $('#errList').removeClass('alert alert-danger');
                    $('#card_link a').remove();
                    $('#modaldel').modal('hide');
                    console.log(response.datas.id);
                    $.ajax({
                        url:"{{ route('be_link.data')}}",
                        type: 'get',
                        dataType: 'json',
                            success:function(datas) {
                                for (let index = 0; index < datas.length; index++) {
                                    card_link = '<a href="#0" data-bs-toggle="modal" data-bs-target="#exampleVerticallycenteredModal" data-name='+datas[index].name+' data-link="'+datas[index].link+'" data-update="val'+datas[index].id+'" data-id="'+datas[index].id+'" id="get_val'+datas[index]+'"><div class="card card-body link" style="margin-left: 40px; margin-right: 26px; border-radius: 5px"><div style="text-align: right; font-size: 12px">'+datas[index].name+'</div></div></a>';
                                    $('#card_link').append(card_link);
                                }
                            }
                    });
                }else{

                    $('#btndel').val('Update');
                    $('#btndel').attr('disabled',false);
                    $('#errList').html("");
                    $('#errList').addClass('alert alert-danger');
                    $('#exampleVerticallycenteredModal').modal('toggle');
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

    // dell sosmed
    $('#formdelsosmed').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        var card_sosmed='';
        card_icon_app='';
        $.ajax({
            type:'POST',
            url: "{{ route('be_subsosmed.dell')}}",
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
            beforeSend:function(){
                $('#btndelsosmedok').attr('disabled','disabled');
                $('#btndelsosmedok').val('Process');
            },
            success: function(response){
                if(response.status == 200)
                {
                    $('#btndelsosmedok').val('Ya Delete');
                    $('#btndelsosmedok').attr('disabled',false);
                    toastr.success(response.message);
                    $('#errList').removeClass('alert alert-danger');
                    $('#card_sosmed a').remove();
                    $('#card_icon_app i').remove();
                    $('#modaldelsosmed').modal('hide');
                    console.log(response.datas.id);
                    $.ajax({
                        url:"{{ route('be_subsosmed.data')}}",
                        type: 'get',
                        dataType: 'json',
                            success:function(datas) {
                                for (let index = 0; index < datas.length; index++) {
                                    card_sosmed = '<a href="#" data-bs-toggle="modal" data-bs-target="#modalupdatesosmed" data-id="'+datas[index].id+'" data-sosmed_id="'+datas[index].sosmed.id+'" data-icon="lni lni-'+datas[index].sosmed.icon+'" data-link="'+datas[index].link+'" class="col-xl-2 col-4"><div class="card card-body" id="" style="border-radius: 10px" ><div class="was-validated"><div class="p-3 border rounded text-center"><div class="col-xl-1"><i class="lni lni-'+datas[index].sosmed.icon+'" id="icon" style="font-size: 30px"></i></div></div></div></div></a>';
                                    card_icon_app = '<i class="lni lni-'+datas[index].sosmed.icon+'" style="margin: 5px"></i>';
                                    $('#card_sosmed').append(card_sosmed);
                                    $('#card_icon_app').append(card_icon_app);
                                }
                            }
                    });
                }else{

                    $('#btndelsosmedok').val('DELETE');
                    $('#btndelsosmedok').attr('disabled',false);
                    $('#errList').html("");
                    $('#errList').addClass('alert alert-danger');
                    $('#modaldelsosmed').modal('toggle');
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

    $('#formaplikasi').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type:'POST',
            url: "{{ route('be_aplikasi.store')}}",
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
            beforeSend:function(){
                $('#btnaplikasi').attr('disabled','disabled');
                $('#btnaplikasi').val('Process');
            },
            success: function(response){
                if(response.status == 200)
                {
                    $('#btnaplikasi').val('SUBMIT');
                    $('#btnaplikasi').attr('disabled',false);
                    toastr.success(response.message);
                    $('#errList').removeClass('alert alert-danger');

                    $.ajax({
                        url:"{{ route('be_aplikasi.data')}}",
                        type: 'get',
                        dataType: 'json',
                            success:function(data) {
                                document.getElementById('head_aplikasi').innerHTML = data;
                                console.log(data);
                        }
                    });
                    
                }else{
                    $('#btnaplikasi').val('SUBMIT');
                    $('#btnaplikasi').attr('disabled',false);
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