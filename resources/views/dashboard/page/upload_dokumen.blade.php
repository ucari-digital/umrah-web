@extends('dashboard.layout') @section('content')
<h4>Upload Dokumen</h4>
<div class="dashboarad-content row">
    <div class="col-md-12">
        <form class="row" action="{{url('api/dokumen/upload/passpor')}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="col-md-6">
                <div class="form-group">
                    <label>Passpor <b class="text-danger">*</b></label>
                    @if($status_file['passpor'])
                    <input name="file" type="file" class="form-control-file" required="" disabled="">
                    @else
                    <input name="file" type="file" class="form-control-file" required="">
                    @endif
                </div>
            </div>
            <div class="col-md-3">
                <label class="d-block">&nbsp;</label>
                @if($status_file['passpor'])
                    <button type="button" class="btn btn-primary btn-block btn-sm"><i class="far fa-check-circle icon-alert success"></i></button>
                @else
                    <button type="submit" class="btn btn-primary btn-block btn-sm">Upload</button>
                @endif
            </div>
        </form>
        <form class="row" action="{{url('api/dokumen/upload/foto')}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="col-md-6">
                <div class="form-group">
                    <label>Foto Berwarna <b class="text-danger">*</b></label>
                    @if($status_file['foto'])
                    <input name="file" type="file" class="form-control-file" required="" disabled="">
                    @else
                    <input name="file" type="file" class="form-control-file" required="">
                    @endif
                </div>
            </div>
            <div class="col-md-3">
                <label class="d-block">&nbsp;</label>
                @if($status_file['foto'])
                    <button type="button" class="btn btn-primary btn-block btn-sm"><i class="far fa-check-circle icon-alert success"></i></button>
                @else
                    <button type="submit" class="btn btn-primary btn-block btn-sm">Upload</button>
                @endif
            </div>
        </form>
        <form class="row" action="{{url('api/dokumen/upload/ktp')}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="col-md-6">
                <div class="form-group">
                    <label>KTP</label>
                    @if($status_file['ktp'])
                    <input name="file" type="file" class="form-control-file" required="" disabled="">
                    @else
                    <input name="file" type="file" class="form-control-file" required="">
                    @endif
                </div>
            </div>
            <div class="col-md-3">
                <label class="d-block">&nbsp;</label>
                @if($status_file['ktp'])
                    <button type="button" class="btn btn-primary btn-block btn-sm"><i class="far fa-check-circle icon-alert success"></i></button>
                @else
                    <button type="submit" class="btn btn-primary btn-block btn-sm">Upload</button>
                @endif
            </div>
        </form>
        <form class="row" action="{{url('api/dokumen/upload/kartu-keluarga')}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="col-md-6">
                <div class="form-group">
                    <label>Kartu Keluarga <b class="text-danger">*</b></label>
                    @if($status_file['kartu_keluarga'])
                    <input name="file" type="file" class="form-control-file" required="" disabled="">
                    @else
                    <input name="file" type="file" class="form-control-file" required="">
                    @endif
                    <small class="form-text text-muted">bagi suami istri dan keluarga</small>
                </div>
            </div>
            <div class="col-md-3">
                <label class="d-block">&nbsp;</label>
                @if($status_file['kartu_keluarga'])
                    <button type="button" class="btn btn-primary btn-block btn-sm"><i class="far fa-check-circle icon-alert success"></i></button>
                @else
                    <button type="submit" class="btn btn-primary btn-block btn-sm">Upload</button>
                @endif
            </div>
        </form>
        <form class="row" action="{{url('api/dokumen/upload/buku-nikah')}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="col-md-6">
                <div class="form-group">
                    <label>Buku Nikah / Surat Nikah</label>
                    @if($status_file['buku_nikah'])
                    <input name="file" type="file" class="form-control-file" required="" disabled="">
                    @else
                    <input name="file" type="file" class="form-control-file" required="">
                    @endif
                    <small class="form-text text-muted">bagi suami istri yang usia istrinya dibawah 45 tahun</small>
                </div>
            </div>
            <div class="col-md-3">
                <label class="d-block">&nbsp;</label>
                @if($status_file['buku_nikah'])
                    <button type="button" class="btn btn-primary btn-block btn-sm"><i class="far fa-check-circle icon-alert success"></i></button>
                @else
                    <button type="submit" class="btn btn-primary btn-block btn-sm">Upload</button>
                @endif
            </div>
        </form>
        <form class="row" action="{{url('api/dokumen/upload/akta-kelahiran')}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="col-md-6">
                <div class="form-group">
                    <label>Akta kelahiran ASLI</label>
                    @if($status_file['akta'])
                    <input name="file" type="file" class="form-control-file" required="" disabled="">
                    @else
                    <input name="file" type="file" class="form-control-file" required="">
                    @endif
                    <small class="form-text text-muted">bagi jamaah yang membawa putrinya</small>
                </div>
            </div>
            <div class="col-md-3">
                <label class="d-block">&nbsp;</label>
                @if($status_file['akta'])
                    <button type="button" class="btn btn-primary btn-block btn-sm"><i class="far fa-check-circle icon-alert success"></i></button>
                @else
                    <button type="submit" class="btn btn-primary btn-block btn-sm">Upload</button>
                @endif
            </div>
        </form>
        <form class="row" action="{{url('api/dokumen/upload/kartu-kuning')}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="col-md-6">
                <div class="form-group">
                    <label>Kartu Kuning Vaksin Maningitis <b class="text-danger">*</b></label>
                    @if($status_file['kartu_kuning'])
                    <input name="file" type="file" class="form-control-file" required="" disabled="">
                    @else
                    <input name="file" type="file" class="form-control-file" required="">
                    @endif
                </div>
            </div>
            <div class="col-md-3">
                <label class="d-block">&nbsp;</label>
                @if($status_file['kartu_kuning'])
                    <button type="button" class="btn btn-primary btn-block btn-sm"><i class="far fa-check-circle icon-alert success"></i></button>
                @else
                    <button type="submit" class="btn btn-primary btn-block btn-sm">Upload</button>
                @endif
            </div>
        </form>
        <form class="row" action="{{url('api/dokumen/upload/id-karyawan')}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="col-md-6">
                <div class="form-group">
                    <label>Kartu ID Karyawan <b class="text-danger">*</b></label>
                    @if($status_file['kartu_karyawan'])
                    <input name="file" type="file" class="form-control-file" required="" disabled="">
                    @else
                    <input name="file" type="file" class="form-control-file" required="">
                    @endif
                </div>
            </div>
            <div class="col-md-3">
                <label class="d-block">&nbsp;</label>
                @if($status_file['kartu_karyawan'])
                    <button type="button" class="btn btn-primary btn-block btn-sm"><i class="far fa-check-circle icon-alert success"></i></button>
                @else
                    <button type="submit" class="btn btn-primary btn-block btn-sm">Upload</button>
                @endif
            </div>
        </form>
{{--         <div class="form-group">
            <label>PIN <b class="text-danger">*</b></label>
            <input name="pin" type="password" class="form-control" required="">
            <small class="form-text text-muted">Masukan 4 digit pin.</small>
        </div>  --}}         
    </div>

</div>
@endsection