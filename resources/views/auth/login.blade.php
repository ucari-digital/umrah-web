@extends('auth.logister_layout') @section('content')
<div class="col-md-5 logister">
    <div class="form-logister">
        <div class="card bg-content">
            <div class="card-body">
                <div class="logister-title">Masuk</div>
                <form action="{{url('api/login')}}" method="post">
                    {{ csrf_field() }}
                    @if(session('status') == 'failed')
                    <div class="alert alert-danger" role="alert">
                        Email atau password salah.
                    </div>
                    @endif
                    <div class="form-group">
                        <label>Email/No. Hp</label>
                        <input type="text" name="ephone" class="form-control" placeholder="Email atau No. HP">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password">
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Belum memiliki akun <a href="{{url('register')}}"><u>Daftar sekarang</u></a></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><a href="{{url('reset-password-check')}}">Lupa Password</a></label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Masuk</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer')
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $("input[name='ephone']").keydown(function(){
            var myNumber = $(this).val();
            var phonenumber = myNumber.substr(0);
            if(phonenumber == 0){
                $(this).val('');
            }
        });
    });
</script>
@endsection