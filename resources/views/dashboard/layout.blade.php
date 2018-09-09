<html lang="en">
@php
use App\Helper\AuthTracker;
@endphp
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{url('css/bootstrap/bootstrap.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500" rel="stylesheet">
    <link rel="stylesheet" href="{{url('css/design.css')}}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.12/css/all.css" integrity="sha384-G0fIWCsCzJIMAVNQPfjH08cyYaUtMwjJwqiRKxxE/rx96Uroj1BtIQ6MLJuheaO9"
        crossorigin="anonymous">
    <link rel="stylesheet" href="{{url('css/fullcalendar/fullcalendar.min.css')}}">
    @yield('header')
</head>

<body>
    @include('component.navbar')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="navbar-right col-md-3">
                    <div class="card bg-content">
                        <div class="card-body">
                            <ul class="nav flex-column">
                                <li class="mb-3">
                                    <div class="profil">
                                        <div class="profil-avatar">
                                            @if(AuthTracker::info()->users['jk'] == 'L')
                                                @php
                                                    $avatar = url('image/asset/users-man.png');
                                                @endphp
                                            @else
                                                @php
                                                    $avatar = url('image/asset/users-woman.png')
                                                @endphp
                                            @endif
                                            <img src="{{App\Helper\Validator::null(AuthTracker::info()->users['foto'], $avatar)}}" alt="..." class="rounded-circle">
                                        </div>
                                        <div class="profil-info">
                                            <div class="pi-nama">{{AuthTracker::info()->users['nama']}}</div>
                                            <div class="pi-u-id">{{App\Helper\Str::rmUMHPS(AuthTracker::info()->users['nomor_peserta'])}}</div>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-12">
                                            <a href="{{url('profil')}}" class="btn btn-primary btn-block btn-sm">Profil</a>
                                        </div>
                                    </div>
                                </li>
                                <li class="nav-item mb-3">
                                    <a href="{{url('dashboard')}}" class="list-item-label white">Ringkasan Akun</a>
                                </li>
                                <li class="nav-item">
                                    <span class="list-item-label">KEBERANGKATAN</span>
                                </li>
                                <li class="nav-item">
                                    <a href="{{url('tanggal-berangkat')}}" class="list-item active">Pilih Tanggal Berangkat</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{url('kursi-pesawat')}}" class="list-item">Pilih Kursi Pesawat</a>
                                </li>
                                <li class="nav-item mb-3">
                                    <a href="{{url('kamar-hotel')}}" class="list-item">Pilih Kamar Hotel</a>
                                </li>
                                <li class="nav-item">
                                    <span class="list-item-label">DOKUMEN</span>
                                </li>
                                <li class="nav-item mb-3">
                                    <a href="{{url('upload-dokumen')}}" class="list-item">Upload Dokumen</a>
                                </li>
                                <li class="nav-item">
                                    <span class="list-item-label">Pembayaran</span>
                                </li>
                                <li class="nav-item mb-3">
                                    <a href="{{url('upload-bukti-pembayaran')}}" class="list-item">Upload Bukti Pembayaran</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="content-dashboard col-md-9">
                    <div class="card border-0">
                        <div class="card-body bg-content">
                            @yield('content')
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="{{url('js/popper.min.js')}}"></script>
<script src="{{url('js/bootstrap.min.js')}}"></script>
<script src="{{url('js/moment/moment.min.js')}}"></script>
<script src="{{url('js/fullcalendar/fullcalendar.min.js')}}"></script>
<script src="{{url('js/maskmoney/jquery.maskMoney.js')}}"></script>
<script>
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    });
    $(document).ready(function () {
        $('.rupiah').maskMoney({prefix: 'Rp. ', thousands: '.', decimal: ',', precision: 0});
        $('.number').maskMoney({thousands: '.', decimal: ',', precision: 0});
    });
</script>
@yield('footer')
</html>