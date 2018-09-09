<!DOCTYPE html>
<html>
<head>
	<title>UPLOAD DOKUMEN</title>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{url('css/bootstrap/bootstrap.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500" rel="stylesheet">
    <link rel="stylesheet" href="{{url('css/design.css')}}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.12/css/all.css" integrity="sha384-G0fIWCsCzJIMAVNQPfjH08cyYaUtMwjJwqiRKxxE/rx96Uroj1BtIQ6MLJuheaO9"
        crossorigin="anonymous">
</head>
<body>
	<div class="container">
		<h4 class="text-center text-white mt-5">Lengkapi Dokumen Untuk Melanjutkan ke Tahap Selanjutnya</h4>
		<div class="row mt-5">
			<div class="col-md-3">
				@if($status_file['passpor'])
					<input name="file" type="file" class="form-control" placeholder="pas" disabled="" />
					<button type="submit" class="btn btn-primary btn-block mt-3 disabled">Berhasil diupload</button>
				@else
				<form action="{{url('api/dokumen/upload/passpor/dumper')}}" method="post" enctype="multipart/form-data">
					{{csrf_field()}}
					<input name="file" type="file" class="form-control" placeholder="pas" />
					<button type="submit" class="btn btn-primary btn-block mt-3">Upload Paspor</button>
				</form>
				@endif
			</div>
			<div class="col-md-3">
				@if($status_file['foto'])
					<input name="file" type="file" class="form-control" placeholder="pas" disabled="" />
					<button type="submit" class="btn btn-primary btn-block mt-3 disabled">Berhasil diupload</button>
				@else
				<form action="{{url('api/dokumen/upload/foto')}}" method="post" enctype="multipart/form-data">
					{{csrf_field()}}
					<input name="file" type="file" class="form-control" placeholder="pas" />
					<button class="btn btn-primary btn-block mt-3">Upload Foto</button>
				</form>
				@endif
			</div>
			<div class="col-md-3">
				@if($status_file['ktp'])
					<input name="file" type="file" class="form-control" placeholder="pas" disabled="" />
					<button type="submit" class="btn btn-primary btn-block mt-3 disabled">Berhasil diupload</button>
				@else
				<form action="{{url('api/dokumen/upload/ktp')}}" method="post" enctype="multipart/form-data">
					{{csrf_field()}}
					<input name="file" type="file" class="form-control" placeholder="pas" />
					<button class="btn btn-primary btn-block mt-3">Upload KTP</button>
				</form>
				@endif
			</div>
			<div class="col-md-3">
				@if($status_file['kartu_keluarga'])
					<input name="file" type="file" class="form-control" placeholder="pas" disabled="" />
					<button type="submit" class="btn btn-primary btn-block mt-3 disabled">Berhasil diupload</button>
				@else
				<form action="{{url('api/dokumen/upload/kartu-keluarga')}}" method="post" enctype="multipart/form-data">
					{{csrf_field()}}
					<input name="file" type="file" class="form-control" placeholder="pas" />
					<button class="btn btn-primary btn-block mt-3">Upload Kartu Keluarga</button>
				</form>
				@endif
			</div>
		</div>
		<div class="row mt-5">
			<div class="col-md-3">
				@if($status_file['buku_nikah'])
					<input name="file" type="file" class="form-control" placeholder="pas" disabled="" />
					<button type="submit" class="btn btn-primary btn-block mt-3 disabled">Berhasil diupload</button>
				@else
				<form action="{{url('api/dokumen/upload/buku-nikah')}}" method="post" enctype="multipart/form-data">
					{{csrf_field()}}
					<input name="file" type="file" class="form-control" placeholder="pas" />
					<button class="btn btn-primary btn-block mt-3">Upload Buku Nikah</button>
				</form>
				@endif
			</div>
			<div class="col-md-3">
				@if($status_file['akta'])
					<input name="file" type="file" class="form-control" placeholder="pas" disabled="" />
					<button type="submit" class="btn btn-primary btn-block mt-3 disabled">Berhasil diupload</button>
				@else
				<form action="{{url('api/dokumen/upload/akta-kelahiran')}}" method="post" enctype="multipart/form-data">
					{{csrf_field()}}
					<input name="file" type="file" class="form-control" placeholder="pas" />
					<button class="btn btn-primary btn-block mt-3">Upload Akta Kelahiran</button>
				</form>
				@endif
			</div>
			<div class="col-md-3">
				@if($status_file['kartu_kuning'])
					<input name="file" type="file" class="form-control" placeholder="pas" disabled="" />
					<button type="submit" class="btn btn-primary btn-block mt-3 disabled">Berhasil diupload</button>
				@else
				<form action="{{url('api/dokumen/upload/kartu-kuning')}}" method="post" enctype="multipart/form-data">
					{{csrf_field()}}
					<input name="file" type="file" class="form-control" placeholder="pas" />
					<button class="btn btn-primary btn-block mt-3">Upload Kartu Kuning</button>
				</form>
				@endif
			</div>
			<div class="col-md-3">
				@if($status_file['kartu_karyawan'])
					<input name="file" type="file" class="form-control" placeholder="pas" disabled="" />
					<button type="submit" class="btn btn-primary btn-block mt-3 disabled">Berhasil diupload</button>
				@else
				<form action="{{url('api/dokumen/upload/id-karyawan')}}" method="post" enctype="multipart/form-data">
					{{csrf_field()}}
					<input name="file" type="file" class="form-control" placeholder="pas" />
					<button class="btn btn-primary btn-block mt-3">Upload ID Karyawan</button>
				</form>
				@endif
			</div>
		</div>
		<div class="row mt-5 text-white">
			<div class="col-md-12">
				<h6>Keterangan</h6>
				<span style="font-size: 12px;">- Setelah dokumen berhasil diupload, mohon untuk menunggu konfirmasi dari admin kami.</span>
			</div>
		</div>
	</div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="{{url('js/dropzone.js')}}"></script>
<script type="text/javascript">
	$('#passpor').dropzone({
		dictDefaultMessage: 'Upload Passpor',
		accept: function(file, done){
			$('#passpor span').html(file.name);
		}
	});
	$('#foto').dropzone({
		dictDefaultMessage: 'Upload Foto',
		accept: function(file, done){
			$('#foto span').html(file.name);
		}
	});

	$('#ktp').dropzone({
		dictDefaultMessage: 'Upload KTP',
		accept: function(file, done){
			$('#ktp span').html(file.name);
		}
	});
	$('#kartu_keluarga').dropzone({
		dictDefaultMessage: 'Upload Kartu Keluarga',
		accept: function(file, done){
			$('#kartu_keluarga span').html(file.name);
		}
	});
	$('#buku_nikah').dropzone({
		dictDefaultMessage: 'Upload Buku Nikah',
		accept: function(file, done){
			$('#buku_nikah span').html(file.name);
		}
	});
	$('#akta').dropzone({
		dictDefaultMessage: 'Upload Akta',
		accept: function(file, done){
			$('#akta span').html(file.name);
		}
	});
	$('#kartu_kuning').dropzone({
		dictDefaultMessage: 'Upload Kartu Kuning',
		accept: function(file, done){
			$('#kartu_kuning span').html(file.name);
		}
	});
	$('#kartu_karyawan').dropzone({
		dictDefaultMessage: 'Upload Kartu Karyawan',
		accept: function(file, done){
			$('#kartu_karyawan span').html(file.name);
		}
	});
</script>
</html>