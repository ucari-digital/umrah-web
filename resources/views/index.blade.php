<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{!empty($title) ? $title: session('brand')['nama']}}</title>
    <link rel="stylesheet" href="{{url('css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{url('css/design.css')}}">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.12/css/all.css" integrity="sha384-G0fIWCsCzJIMAVNQPfjH08cyYaUtMwjJwqiRKxxE/rx96Uroj1BtIQ6MLJuheaO9"
	    crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
</head>

<body>
    <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-dark nav-bg-dark">
        <a class="navbar-brand" href="#"><img src="{{session('brand')['logo']}}" alt="" style="width: 100px; max-height: 40px"></a>
        <div><img src="{{session('brand')['slogan']}}" style="width: 250px;"></div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>
    <div class="container">
        <div class="row justify-content-md-center">
        	<div class="col-md-10 logister mb-0">
        		<h1 class="text-center text-white" style="font-size: 38px;">Selamat Datang di Aplikasi <br>{{session('brand')['nama']}}</h1>
        	</div>
            <div class="col-md-10 logister mt-3">
			    <div class="logo" style="width: 350px;">
			        <img src="{{session('brand')['slogan']}}" alt="" style="width: 350px; height: auto;">
			    </div>
			</div>
			<div class="col-md-4 mt-5">
				<div class="row">
					<div class="col-md-12">
						<a href="{{url('login')}}" class="main-button">Masuk Akun</a>
					</div>
				</div>
			</div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="{{url('js/bootstrap.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>

</script>
</html>