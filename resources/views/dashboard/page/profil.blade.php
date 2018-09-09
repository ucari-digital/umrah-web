@extends('dashboard.layout') @section('content')
@if(session('status') == 'success')
    <div class="alert alert-success" role="alert">
        {{session('message')}}
    </div>
@elseif(session('status') == 'failed')
    <div class="alert alert-danger" role="alert">
        {{session('message')}}
    </div>
@endif
<h4>Profil</h4>
<form action="{{url('profil/save/'.$data->nomor_pendaftar)}}" method="post" enctype="multipart/form-data">
    {{csrf_field()}}
    <div class="dashboarad-content row">
        <div class="col-md-5">
            <div class="form-group">
                <label>Nama Lengkap (Sesuai dengan PASPOR)
                </label>
                <input type="text" class="form-control" placeholder="Nama" disabled="" value="{{$data->nama}}">
            </div>                
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>Jenis Kelamin
                </label>
                @php
                    if ($data->jk == 'L') {
                        $jk = 'Laki - Laki';
                    } else {
                        $jk = 'Perempuan';
                    }
                @endphp
                <input type="text" class="form-control" placeholder="Jenis Kelamin" disabled="" value="{{$jk}}">
            </div>
        </div>
        <div class="col-md-4">
             <div class="form-group">
                <label>NIK (Nomor Induk Kependudukan)
                </label>
                <input type="text" class="form-control" placeholder="NIK" disabled="" value="{{$data->nik}}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label>NIP (Nomor Induk Pegawai)
                </label>
                <input name="nip" type="text" class="form-control" value="{{$data->nip}}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Departemen / Dinas
                </label>
                <input name="departemen" type="text" class="form-control" value="{{$data->departemen}}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Jabatan / Eselon
                </label>
                <input name="jabatan" type="text" class="form-control" value="{{$data->jabatan}}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Email
                </label>
                <input name="email" type="email" class="form-control" disabled="" value="{{$data->email}}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>No. HP
                </label>
                <input name="no_hp" type="text" class="form-control" disabled="" value="{{$data->telephone}}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label>Password
                </label>
                <input name="password" type="password" class="form-control" placeholder="Password">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Konfirmasi Password
                </label>
                <input name="c_password" type="password" class="form-control" placeholder="Password">
            </div>
        </div>
        <div class="col-md-4">
            <label for="">&nbsp;</label>
            <button class="btn btn-primary btn-block">Simpan</button>
        </div>
    </div>
</form>
@endsection