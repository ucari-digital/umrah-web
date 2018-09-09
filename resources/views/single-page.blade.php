<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Travel</title>
	<link rel="stylesheet" href="{{url('css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{url('css/design.css')}}">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.12/css/all.css" integrity="sha384-G0fIWCsCzJIMAVNQPfjH08cyYaUtMwjJwqiRKxxE/rx96Uroj1BtIQ6MLJuheaO9"
	    crossorigin="anonymous">
</head>

<body>
<div class="container">
	<div class="row justify-content-md-center">
		<div class="col col-lg-6 text-white" style="margin-top: 22%;">
			<input type="text" class="form-control" placeholder="Nama Perusahaan..." style="font-size: 32px;">
		</div>
	</div>
</div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="{{url('js/bootstrap.min.js')}}"></script>
<script>
	$('.carousel').carousel();
	$('input[type="text"]').keyup(function(e){
	    if(e.keyCode == 13)
	    {
	        window.location.href = window.location.href+$(this).val();
	    }
	});
</script>

</html>