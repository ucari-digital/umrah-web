@extends('auth.logister_layout') @section('content')
<div class="col-md-5 logister">
    <div class="form-logister">
        <div class="card bg-content">
            <div class="card-body">
                <div class="logister-title">Reset Password</div>
                <form action="{{url('reset-password-check/send')}}" method="post">
                    {{ csrf_field() }}
                    @if(session('status') == 'failed')
                    <div class="alert alert-danger" role="alert">
                        No. Handphone tidak terdaftar
                    </div>
                    @endif
                    <div class="form-group">
                        <label>No. Hp</label>
                        <input type="text" name="ephone" class="form-control" placeholder="No. Handphone">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Kirim</button>
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