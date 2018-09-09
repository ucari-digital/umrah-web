<html>
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="{{url('css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{url('css/design.css')}}">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.12/css/all.css" integrity="sha384-G0fIWCsCzJIMAVNQPfjH08cyYaUtMwjJwqiRKxxE/rx96Uroj1BtIQ6MLJuheaO9"
	    crossorigin="anonymous">
</head>
<body>
	@php
	$message_list = [
		'error' => 'Terjadi kesalahan pada sistem',
		'pin_failed' => 'PIN yang Anda masukan salah',
		'akses_umrah_failed' => 'Maaf, Anda belum bisa memilih tanggal keberangkatan',
		'akses_pesawat_failed' => 'Maaf, Anda belum bisa memilih kursi pesawat',
		'akses_upload_dokumen' => 'Maaf, Anda belum bisa mengupload dokumen',
		'refresh_login' => 'Anda memperbaharui datadengan cara logout',
		'reset_password_success' => 'Berhasil mengubah password',

		'register_success' => 'Berhasil melakukan pendaftaran',
		'register_failed' => 'Maaf, terjadi kesalahan saat pendaftaran',

		'pesawat_book_success' => 'Berhasil memilih kursi pesawat',
		'pesawat_book_failed' => 'Maaf, kursi pesawat tidak dapat dipilih',

		'tanggal_book_success' => 'Berhasil memilih tanggal keberangkatan',
		'tanggal_book_failed' => 'Maaf, tanggal tidak dapat dipilih',

		'hotel_book_success' => 'Berhasil memilih kamar hotel',
		'hotel_book_failed' => 'Maaf, kamar hotel tidak dapat dipilih',

		'upload_dokumen_success' => 'Berhasil upload dokumen',
		'upload_dokumen_failed' => 'Maaf, dokumen Anda telah di upload',

		'upload_pembayaran_success' => 'Berhasil upload bukti pembayaran',
		'upload_pembayaran_failed' => 'Maaf, bukti pembayaran Anda tidak dapat di upload',
	];
	$link_list = [
		'root' => '/',
 		'default' => 'dashboard',
		'pesawat' => 'kursi-pesawat',
		'tanggal' => 'tanggal-berangkat',
		'hotel' => 'kamar-hotel',
		'dokumen' => 'upload-dokumen',
		'pembayaran' => 'upload-bukti-pembayaran',
		'login' => 'login',
		'register'=> 'register',
	];
	$deskripsi_list = [
		'default' => '',
		'akses_umrah_failed' => "Akun anda belum diverifikasi oleh Admin.<br> mohon tunggu hingga akun anda aktif.",
		'akses_pesawat_failed' => "Anda belum memilih tanggal keberangkatan. <br> silahkan untuk memilih tanggal keberangkatan terlebih dahulu.",

		'tanggal_book_availabel' => 'Anda telah memilih tanggal keberangkatan sebelumnya.',
		'pesawat_book_availabel' => 'Anda telah memilih kursi pesawat sebelumnya.',
		'hotel_book_availabel' => 'Kamar hotel telah dipilih oleh teman rombongan Anda.',
	]
	@endphp
	<div class="container">
		<div class="row justify-content-md-center">
			<div class="col col-md-5 text-center mt-5 alert">
				<div class="card">
					<div class="card-body">
						@if($status == 'success')
						<i class="far fa-check-circle icon-alert success"></i>
						@elseif($status == 'failed')
						<i class="far fa-times-circle icon-alert danger"></i>
						@endif
						<h4 class="mt-3">{{$message_list[$message]}}</h4>
						<span class="mt-3 mb-3 text-center d-block">{!! $deskripsi_list[$deskripsi] !!}</span>
						<span class="mt-3 mb-3 text-center d-block">{{$custom_message}}</span>
						<a href="{{$link_list[$link]}}"><i class="far fa-arrow-alt-circle-left"></i> Kembali</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>