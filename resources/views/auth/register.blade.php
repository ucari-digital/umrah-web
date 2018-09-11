@extends('auth.logister_layout') @section('content')
<div class="col-md-10 logister">
    <div class="form-logister">
        <div class="card bg-content">
            <div class="card-body">
                <div class="logister-title">Data diri peserta umrah</div>
                <form action="{{url('api/register')}}" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Nama Lengkap (Sesuai dengan PASPOR)</label>
                                        <input name="nama" type="text" class="form-control" placeholder="Nama Lengkap" required="">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Jenis Kelamin</label>
                                        <select name="jk" class="form-control" required="">
                                            <option value="L">Laki - Laki</option>
                                            <option value="P">Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>NIK (Nomor Induk Kependudukan)</label>
                                <input name="nik" type="text" class="form-control" placeholder="NIK" pattern=".{16,16}" required title="Nik harus 16 karakter">
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="kode_perusahaan" value="{{session('brand')['kode_perusahaan']}}">
                            </div>
                            <div class="form-group">
                                <label>NIP (Nomor Induk Pegawai)</label>
                                <input name="nip" type="text" class="form-control" placeholder="NIP" required="">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Travel Umrah</label>
                                        <select name="travel" class="form-control" required="">
                                            <option>Pilih</option>
                                            @foreach($travel as $item)
                                            <option value="{{$item['kode_travel']}}">{{$item['nama_travel']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Bank</label>
                                        <select name="bank" class="form-control" required="">
                                            <option>Pilih</option>
                                            @foreach($bank as $item)
                                            <option value="{{$item['kode_bank']}}">{{$item['nama_bank']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Departemen / Dinas</label>
                                <select name="departemen" class="form-control">
                                    <option>PILIH</option>
                                    @foreach($departemen as $departemen)
                                    <option value="{{$departemen->departemen}}">{{$departemen->departemen}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Jabatan / Eselon</label>
                                <input type="text" name="jabatan" class="form-control" placeholder="Jabatan">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input name="email" type="email" class="form-control" placeholder="Email" required="">
                            </div>
                            <div class="form-group">
                                <label>No. HP</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text input-color border-0">+62</span>
                                    </div>
                                    <input name="telephone" type="number" class="form-control input-color" placeholder="No. HP" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Hubungan Keluarga</label>
                                <select name="hub_keluarga" id="" class="form-control">
                                    <option value="">Diri sendiri</option>
                                    <option value="anak">Anak</option>
                                    <option value="istri / suami">Istri / Suami</option>
                                    <option value="orang tua">Orang Tua</option>
                                    <option value="mertua">Mertua</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input name="password" type="password" class="form-control" placeholder="Password" required>
                            </div>
                            <div class="form-group">
                                <label>Konfirmasi Password</label>
                                <input name="confirm_password" type="password" class="form-control" placeholder="Konfirmasi Password">
                                <small class="form-text d-none text-confirm text-danger" style="color: #dc3545!important;">Konfirmasi password tidak sama.</small>
                            </div>
                            <div class="form-group">
                                <label class="d-block">Sudah memiliki akun <a href="{{url('login')}}"><u>Masuk sekarang</u></a></label>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block btn-confirm" disabled>Daftar</button>
                        </div>
                    </div>
                    {{-- MODAL --}}
                    <div class="modal fade" id="setDp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content bg-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Besaran Uang Muka</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input class="form-control" placeholder="Besaran uang muka"></input>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    <button type="button" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@section('footer')
<script>
    $(document).ready(function(){
        $("input[name='telephone']").keyup(function(){
            var myNumber = $(this).val();
            var phonenumber = myNumber.substr(0);
            if(phonenumber == 0){
                $(this).val('');
            }
        });


        $("input[name='confirm_password']").keyup(function(){
            // Validator password
            var password = $("input[name='password']").val();
            var password_confirm = $("input[name='confirm_password']").val();

            if (password == password_confirm){
                $('.btn-confirm').removeAttr('disabled');
                $('.text-confirm').addClass('d-none');
            } else {
                $('.text-confirm').removeClass('d-none');
                $('.btn-confirm').attr('disabled', true);
            }
        });

        $("select[name='metode_pembayaran']").change(function(){
            if ($(this).val() == 'DP') {
                $('#setDp').modal('show');
            }
        })
    });
</script>
@endsection