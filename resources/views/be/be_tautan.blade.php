@extends('layouts.master')

@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        @media screen and (max-width: 800px){
            .link {
                margin-right: 100px;
            }
        }
        .fab .fa-tiktok {
        color: #111111;
        filter: drop-shadow(-5px -5px 0 #24f6f0) contrast(150%) brightness(110%);
        z-index: -1;
        }

        .fab .fa-tiktok::after {
        filter: drop-shadow(5px 5px 0 #F70250) contrast(150%) brightness(110%);
        z-index: -1;
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
        
        <!--end breadcrumb-->
        {{-- <div class="row"> --}}
            <div class="col">
                {{-- <h6 class="mb-0 text-uppercase">TAUTAN LINKS</h6> --}}
                
                <hr/>
                <div id="errList" class="text-uppercase">
                
                </div>
                <div class="ms-auto">
                    <button class="btn btn-info text-white" data-bs-toggle="modal" data-bs-target="#modalsocialink">MY MEDIA LINK</button>
                </div>
                <br>
                <div class="row">
                    <div class="col-xl-7" id="field_tautan">
                        <div class="card card-body" style="border-radius: 10px">
                            <h5 class="text-uppercase">Nama & Image Aplikasi</h5>
                            <form id="formaplikasi" method="POST" enctype="multipart/form-data" class="was-validated">@csrf
                                <div class="p-4 border rouunded">
                                    <div class="row">
                                        <div class="mb-2 col-xl-7">
                                            <input type="hidden" name="user_id" value="{{auth()->user()->id}}" required>
                                            <input type="text" name="name" class="form-control"
                                            @if (auth()->user()->aplikasi !== null)
                                            value="{{auth()->user()->aplikasi->name}}"    
                                            @else
                                            placeholder="nama aplikasi.."
                                            @endif
                                            required>
                                            <div class="invalid-feedback">nama aplikasi harus diisi</div>
                                        </div>
                                        <div class="mb-2 col-xl-5">
                                            <input type="text" name="slug" class="form-control"
                                            @if (auth()->user()->aplikasi !== null)
                                                value="{{auth()->user()->aplikasi->slug}}"
                                            @else
                                                placeholder="nama belakang link.."
                                            @endif
                                            required>
                                            <div class="invalid-feedback">tentukan nama belakang link</div>
                                        </div>
                                        <div class="mb-2 col-xl-12">
                                            <input type="text" name="deskripsi" class="form-control" 
                                            @if (auth()->user()->aplikasi !== null)
                                            value="{{auth()->user()->aplikasi->deskripsi}}"    
                                            @else
                                            placeholder="deskripsi singkat.."
                                            @endif    
                                            >
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
                                            <input value="" type="text" id="linktautan" name="link" class="form-control" placeholder="https://link-tautan.com.." required>
                                            <div id="tautanlink" class="invalid-feedback">harus diisi</div>
                                        </div>
                                        <div class="mb-1 col-xl-6">
                                            
                                        </div>
                                        <div class="md-1 col-xl-6" style="text-align: right">
                                            <input type="submit" id="btnsubmit" class="btn btn-info text-white" value="SUBMIT"><br>
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
                                            <i 
                                            @if ($item->sosmed->icon == 'tiktok' || $item->sosmed->icon == 'Tiktok' || $item->sosmed->icon == 'TikTok')
                                            @section('head')
                                                
                                                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
                                                
                                            @endsection
                                            class="fab fa-{{$item->sosmed->icon}}"
                                            @else
                                            class="fa fa-{{$item->sosmed->icon}}"
                                            @endif  id="icon" style="font-size: 30px"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-xl-2">
                        <div class="card card-body" id="card_bg_preview" style="background-color: transparent">
                            <p> 
                                <button class="btn btn-sm mb-2 btn-success text-white" data-bs-toggle="modal" data-bs-target="#modalbg">GANTI BACKGROUND</button>
                                <img style="width: 100%" 
                                @if (auth()->user()->aplikasi == null)
                                    src="{{asset('corak/5.jpg')}}"    
                                @else
                                    @if (auth()->user()->aplikasi->bg->first() !== null)
                                        <?php $background = auth()->user()->aplikasi->bg->first()?>
                                        src="{{asset('bg_img_thumb/'.$background->bg)}}"
                                    @else
                                        src="{{asset('corak/5.jpg')}}"    
                                    @endif
                                @endif
                                alt="img">
                                
                            </p>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="card card-body text-center;" style="border-radius: 10px; background: transparent; width: 320px">
                            <div style="background-repeat: no-repeat;height: 560px;background-image: url({{asset('pngegg.png')}});">
                                <div id="head_aplikasi">
                                    <div>
                                        <img id="preview"
                                        @if (auth()->user()->aplikasi !== null)
                                            @if (auth()->user()->aplikasi->img !== null)
                                                src="{{asset('be_img_aplikasi/'.auth()->user()->aplikasi->img)}}"     
                                            @else
                                                src="{{asset('corak/nf.png')}}" 
                                            @endif
                                        @else
                                            src="{{asset('corak/nf.png')}}" 
                                        @endif
                                        style="margin-left: 103px; margin-top:60px" alt="Admin" class="rounded-circle p-1" width="80">
                                        <h5 style="text-align: center; font-size: 14px; margin-top: 10px" id="nama_aplikasi">
                                            @if (auth()->user()->aplikasi !== null)
                                                {{auth()->user()->aplikasi->name}}
                                            @endif
                                        </h5>
                                        <p style="text-align: center; font-size: 12px; margin-top: 10px" id="nama_aplikasi">
                                            @if (auth()->user()->aplikasi !== null)
                                                {{auth()->user()->aplikasi->deskripsi}}
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <p style="text-align: center; font-size: 20px; margin-top: 10px" id="card_icon_app">
                                    @foreach ($sub_sosmed as $item)
                                        <i 
                                        @if ($item->sosmed->icon == 'tiktok' || $item->sosmed->icon == 'Tiktok' || $item->sosmed->icon == 'TikTok')
                                        class="fab fa-{{$item->sosmed->icon}}" 
                                        @else
                                        class="fa fa-{{$item->sosmed->icon}}"
                                        @endif 
                                        style="margin: 5px"> </i>
                                    @endforeach
                                </p>
                                <div style="margin-top: 5px"></div>
                                <div style="height: 270px;">
                                    <div style="margin-top: 20px;text-align: center;" id="card_link">
                                        @foreach (auth()->user()->link as $key=> $data)
                                        <a href="#{{$data->link}}" data-bs-toggle="modal" data-bs-target="#exampleVerticallycenteredModal"
                                            data-name="{{$data->name}}"  data-link="{{$data->link}}" data-id="{{$data->id}}" data-update="val{{$data->id}}" id="get_val{{$key}}" type="button" style="width: 200px;" data-name="{{$data->name}}">
                                            <div class="card card-body link" style="border-radius: 25px; width: 200px">
                                                <div style="text-align: center; font-size: 12px">
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
                            <input type="text" id="linktautanup" name="link" class="form-control is-invalid" placeholder="-" required>
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
                            <input value="" type="text" name="link" id="linksosmed" class="form-control" placeholder="https://link-tautan.com.." required>
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
                            <input value="" type="text" id="socialinkup" name="link" class="form-control" placeholder="https://link-tautan.com.." required>
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

<div id="modalsocialink" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">LINK ANDA</h5>
            </div>
            <form id="#" class="was-validated" enctype="multipart/form-data" method="post">@csrf
                <div class="modal-body">
                    {{-- <input type="text" name="id" id="id_del"> --}}
                    <div class="p-4 border rounded">
                        <input type="text" id="mylink" class="form-control" readonly disabled>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <input class="btn btn-info text-white" onclick="copyLink()" id="btncopy" type="button" value="Copy">
                    <a href="" id="openlink" target="_blank" class="btn btn-primary text-white" type="button">Open Link</a>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="modalbg" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">PILIH BACKGROUND</h5>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            <div class="modal-header">
                @if (auth()->user()->aplikasi == null)
                <code>BUAT NAMA APLIKASI ANDA DULU KEMUDIAN PILIH BACKGROUND ANDA</code>
                @endif
            </div>
            <div class="row modal-body">
                @foreach ($bg as $item)
                    <form action="/be-bg-add" method="POST" class="card col-6 col-md-4" enctype="multipart/form-data">@csrf
                        <input type="hidden" name="bg_id" value="{{$item->id}}">
                        <img src="{{asset('bg_img_thumb/'.$item->bg_thumb)}}" alt="">
                        @if (auth()->user()->aplikasi !== null)
                        <input type="hidden" name="aplikasi_id" value="{{auth()->user()->aplikasi->id}}">
                        <input type="submit" id="pilih_bg" class="btn btn-sm btn-info text-white" value="PILIH">
                        @endif
                    </form>
                @endforeach
            </div>
        </div>
    </div>
</div>


@endsection

@section('script')
<script>

    function copyLink() {
    /* Get the text field */
    var copyText = document.getElementById("mylink");
    /* Select the text field */
    copyText.select();
    copyText.setSelectionRange(0, 99999); /* For mobile devices */
    /* Copy the text inside the text field */
    navigator.clipboard.writeText(copyText.value);
    /* Alert the copied text */
    alert("Copied the text: " + copyText.value);
    }

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
        // get bg img
                
        // validasi social media link dan tautan
        $(function() {
            $('#linktautan').keyup(function() {
                formatlink = $(this).val().substr(0,8);
                if (formatlink !== 'https://') {
                    $('#btnsubmit').val('Diawali https://' );
                    $('#btnsubmit').attr('disabled','disabled');
                    $('#btnsubmit').addClass('btn btn-danger');
                }if(formatlink  == 'https://') {
                    $('#btnsubmit').val('SUBMIT' );
                    $('#btnsubmit').attr('disabled',false);
                    $('#btnsubmit').removeClass('btn btn-danger');
                    $('#btnsubmit').addClass('btn btn-info');
                }
            });

            $('#linktautanup').keyup(function() {
                formatlink = $(this).val().substr(0,8);
                if (formatlink !== 'https://') {
                    $('#btnupdate').val('Diawali https://' );
                    $('#btnupdate').attr('disabled','disabled');
                    $('#btnupdate').addClass('btn btn-danger');
                }if(formatlink  == 'https://') {
                    $('#btnupdate').val('Update' );
                    $('#btnupdate').attr('disabled',false);
                    $('#btnupdate').removeClass('btn btn-danger');
                    $('#btnupdate').addClass('btn btn-primary');
                }
            });

            $('#linksosmed').keyup(function() {
                formatlink = $(this).val().substr(0,8);
                if (formatlink !== 'https://') {
                    $('#btnsubmitsosmed').val('https://' );
                    $('#btnsubmitsosmed').attr('disabled','disabled');
                    $('#btnsubmitsosmed').addClass('btn btn-danger');
                }if(formatlink  == 'https://') {
                    $('#btnsubmitsosmed').val('Update' );
                    $('#btnsubmitsosmed').attr('disabled',false);
                    $('#btnsubmitsosmed').removeClass('btn btn-danger');
                    $('#btnsubmitsosmed').addClass('btn btn-primary');
                }
            });

            $('#socialinkup').keyup(function() {
                formatlink = $(this).val().substr(0,8);
                if (formatlink !== 'https://') {
                    $('#btnupdatesosmed').val('https://' );
                    $('#btnupdatesosmed').attr('disabled','disabled');
                    $('#btnupdatesosmed').addClass('btn btn-danger');
                }if(formatlink  == 'https://') {
                    $('#btnupdatesosmed').val('Update' );
                    $('#btnupdatesosmed').attr('disabled',false);
                    $('#btnupdatesosmed').removeClass('btn btn-danger');
                    $('#btnupdatesosmed').addClass('btn btn-primary');
                }
            });
        });

        $("body").bind("ajaxSend", function(elm, xhr, s){
            if (s.type == "POST") {
                xhr.setRequestHeader('X-CSRF-Token', csrf_token);
            }
        });

        $.ajax({
            url:"{{ route('be_get.link')}}",
            type: 'get',
            dataType: 'json',
                success:function(datas) {
                    if (datas !== 'kosong') {
                        $('#mylink').val('http://media.tilawatipusat.com/'+datas);
                        var a = document.getElementById('openlink');
                        a.href = 'http://media.tilawatipusat.com/'+datas;
                        $('#btncopy').val('Copy');
                        $('#btncopy').attr('disabled',false);
                    }else{
                        $('#mylink').val('Buat Nama Aplikasi Terlebih Dahulu');
                        var a = document.getElementById('openlink');
                        a.href = 'http://media.tilawatipusat.com/'+datas;
                        $('#btncopy').attr('disabled','disabled');
                        $('#btncopy').val('Not Valid');
                    }
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
        $(this).find("i").addClass('fa fa-'+icon);
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
        $(this).find('#socialinkup').val(link);
        $(this).find('#id').val(id);
        $(this).find('#sosmed_id').val(sosmed_id);
        $(this).find("i").removeClass();
        $(this).find("i").addClass('fa fa-'+icon);
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
        modal.find('.modal-body #linktautanup').val(link);
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
                                    card_link = '<a href="#" data-bs-toggle="modal" data-bs-target="#exampleVerticallycenteredModal" data-name='+datas[index].name+' data-link="'+datas[index].link+'" data-update="val'+datas[index].id+'" data-id="'+datas[index].id+'" id="get_val'+datas[index]+'" type="button" style="width: 200px;" data-name="{{$data->name}}"><div class="card card-body link" style="border-radius: 25px; width: 200px"><div style="text-align: center; font-size: 11px">'+datas[index].name+'</div></div></a>'
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
                                    card_link = '<a href="#" data-bs-toggle="modal" data-bs-target="#exampleVerticallycenteredModal" data-name='+datas[index].name+' data-link="'+datas[index].link+'" data-update="val'+datas[index].id+'" data-id="'+datas[index].id+'" id="get_val'+datas[index]+'" type="button" style="width: 200px;" data-name="{{$data->name}}"><div class="card card-body link" style="border-radius: 25px; width: 200px"><div style="text-align: center; font-size: 11px">'+datas[index].name+'</div></div></a>'
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
                                    card_sosmed = '<a href="#" data-bs-toggle="modal" data-bs-target="#modalupdatesosmed" data-id="'+datas[index].id+'" data-sosmed_id="'+datas[index].sosmed.id+'" data-icon="fa fa-'+datas[index].sosmed.icon+'" data-link="'+datas[index].link+'" class="col-xl-2 col-4"><div class="card card-body" id="" style="border-radius: 10px" ><div class="was-validated"><div class="p-3 border rounded text-center"><div class="col-xl-1"><i class="fa fa-'+datas[index].sosmed.icon+'" id="icon" style="font-size: 30px"></i></div></div></div></div></a>';
                                    card_icon_app = '<i class="fa fa-'+datas[index].sosmed.icon+'" style="margin: 5px"></i>';
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
                                    card_sosmed = '<a href="#" data-bs-toggle="modal" data-bs-target="#modalupdatesosmed" data-id="'+datas[index].id+'" data-sosmed_id="'+datas[index].sosmed.id+'" data-icon="fa fa-'+datas[index].sosmed.icon+'" data-link="'+datas[index].link+'" class="col-xl-2 col-4"><div class="card card-body" id="" style="border-radius: 10px" ><div class="was-validated"><div class="p-3 border rounded text-center"><div class="col-xl-1"><i class="fa fa-'+datas[index].sosmed.icon+'" id="icon" style="font-size: 30px"></i></div></div></div></div></a>';
                                    card_icon_app = '<i class="fa fa-'+datas[index].sosmed.icon+'" style="margin: 5px"></i>';
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
                                    card_link = '<a href="#" data-bs-toggle="modal" data-bs-target="#exampleVerticallycenteredModal" data-name='+datas[index].name+' data-link="'+datas[index].link+'" data-update="val'+datas[index].id+'" data-id="'+datas[index].id+'" id="get_val'+datas[index]+'" type="button" style="width: 200px;" data-name="{{$data->name}}"><div class="card card-body link" style="border-radius: 25px; width: 200px"><div style="text-align: center; font-size: 11px">'+datas[index].name+'</div></div></a>'
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
                                    card_sosmed = '<a href="#" data-bs-toggle="modal" data-bs-target="#modalupdatesosmed" data-id="'+datas[index].id+'" data-sosmed_id="'+datas[index].sosmed.id+'" data-icon="fa fa-'+datas[index].sosmed.icon+'" data-link="'+datas[index].link+'" class="col-xl-2 col-4"><div class="card card-body" id="" style="border-radius: 10px" ><div class="was-validated"><div class="p-3 border rounded text-center"><div class="col-xl-1"><i class="fa fa-'+datas[index].sosmed.icon+'" id="icon" style="font-size: 30px"></i></div></div></div></div></a>';
                                    card_icon_app = '<i class="fa fa-'+datas[index].sosmed.icon+'" style="margin: 5px"></i>';
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

                    $.ajax({
                        url:"{{ route('be_get.link')}}",
                        type: 'get',
                        dataType: 'json',
                            success:function(datas) {
                                if (datas !== 'kosong') {
                                    $('#mylink').val('http://media.tilawatipusat.com/'+datas);
                                    var a = document.getElementById('openlink');
                                    a.href = 'http://media.tilawatipusat.com/'+datas;
                                    $('#btncopy').val('Copy');
                                    $('#btncopy').attr('disabled',false);
                                }else{
                                    $('#mylink').val('Buat Nama Aplikasi Terlebih Dahulu');
                                    var a = document.getElementById('openlink');
                                    a.href = 'http://media.tilawatipusat.com/'+datas;
                                    $('#btncopy').attr('disabled','disabled');
                                    $('#btncopy').val('Not Valid');
                                }
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

    $('#formaddbg').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type:'POST',
            url: "{{ route('be_bg.add')}}",
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
            beforeSend:function(){
                $('#pilih_bg').attr('disabled','disabled');
                $('#pilih_bg').val('Process');
            },
            success: function(response){
                if(response.status == 200)
                {
                    $('#formaddbg')[0].reset();
                    $('#pilih_bg').val('Pilih');
                    $('#pilih_bg').attr('disabled',false);
                    toastr.success(response.message);
                    $('#errList').removeClass('alert alert-danger');
                }else{
                    $('#modalbg').modal('toggle');
                    $('#pilih_bg').val('Submit');
                    $('#pilih_bg').attr('disabled',false);
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