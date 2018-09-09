@extends('dashboard.layout') @section('content')
@php
use App\Helper\AuthTracker;
@endphp
<h4>Dashboard</h4>
<div class="dashboarad-content">
	<div class="row info-pemberangkatan">
		<div class="col-md-6">
			<div class="card bg-content border-0">
				<div class="card-body">
					<div class="row">
						<div class="col-md-8">
							<h6 class="card-title">Tanggal Keberangkatan</h6>
						</div>
						@if(isset($tanggal_keberangkatan['data']['tanggal_keberangkatan']))
						<div class="col-md-4">
							<button class="btn btn-danger float-right btn-sm popoover-produk text-right d-block" data-toggle="popover" title="Yakin untuk membatalkan ?">Batalkan</button>
						</div>
						@endif
					</div>
					<hr>
					@if(isset($tanggal_keberangkatan['data']['tanggal_keberangkatan']))
					<h4 class="">{{App\Helper\TimeFormat::timeId($tanggal_keberangkatan['data']['tanggal_keberangkatan'])}}</h4>
					@else
					<h4>Belum dipilih</h4>
					@endif
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="card bg-content border-0">
				<div class="card-body">
					<h6 class="card-title">
						<span class="h6">Anggota Kamar Hotel</span>
					</h6>
					<hr>
					@if($peserta_room)
					@foreach($peserta_room as $item)
					<h5 class="d-inline-block"><span class="badge badge-dark" data-toggle="tooltip" data-placement="top" title="{{$item['hubungan_keluarga']}}">{{$item['nama']}}</span></h5>
					@endforeach
					@else
					<h4>Belum dipilih</h4>
					@endif
				</div>
			</div>
		</div>
	</div>
	<div class="row mt-3">
		<div class="col-md-6">
			<div class="card bg-content border-0">
				<div class="card-body">
					<div class="row">
						<div class="col-md-6">
							<h5 class="card-title">Pesawat</h5>	
						</div>
						@if($getPesawatInformasi[0]['nama_pesawat'] != 'Belum dipilih')
						<div class="col-md-6">
							<button class="btn btn-danger float-right btn-sm popoover-pesawat text-right d-block" data-toggle="popover" title="Yakin untuk membatalkan ?">Batalkan</button>
						</div>
						@endif
					</div>
					<table class="table">
						<tr>
							<td><h6>Type</h6></td>
							<td>{{$getPesawatInformasi[0]['nama_pesawat']}}</td>
						</tr>
						<tr>
							<td><h6>Kursi</h6></td>
							<td>{{$getPesawatInformasi[0]['kursi']}}</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="card bg-content border-0">
				<div class="card-body">
					<h5 class="card-title">Hotel</h5>
					<table class="table">
						<tr>
							<td>
								<h6>Madinah</h6>
								<p><h6>Kamar</h6></p>
							</td>
							<td>
								<p>{{$hotel['madinah']['nama_hotel']}}</p>
								<span>{{$hotel['madinah']['lantai'].$hotel['madinah']['nomor_kamar']}}</span>
							</td>
						</tr>
						<tr>
							<td>
								<h6>Mekkah</h6>
								<p><h6>Kamar</h6></p>
							</td>
							<td>
								<p>{{$hotel['mekkah']['nama_hotel']}}</p>
								<span>{{$hotel['mekkah']['lantai'].$hotel['mekkah']['nomor_kamar']}}</span>
							</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<h5 class="card-title text-center mb-3">Dokumen</h5>
			<table class="table table-dokumen">
				<tr>
					<th>Paspor</th>
					<th>KTP</th>
					<th>Foto</th>
					<th>Kartu Keluarga</th>
					<th>Kartu Vaksin Maningitis</th>
					<th>Kartu Karyawan</th>
					<th>Buku Nikah</th>
					<th>Alkta Kelahiran</th>
				</tr>
				<tr>
					<td>
						@if($file_upload['passpor'])
						<i class="fas fa-check"></i>
						@else
						<i class="fas fa-times"></i>
						@endif
					</td>
					<td>
						@if($file_upload['ktp'])
						<i class="fas fa-check"></i>
						@else
						<i class="fas fa-times"></i>
						@endif
					</td>
					<td>
						@if($file_upload['foto'])
						<i class="fas fa-check"></i>
						@else
						<i class="fas fa-times"></i>
						@endif
					</td>
					<td>
						@if($file_upload['kartu_keluarga'])
						<i class="fas fa-check"></i>
						@else
						<i class="fas fa-times"></i>
						@endif
					</td>
					<td>
						@if($file_upload['kartu_kuning'])
						<i class="fas fa-check"></i>
						@else
						<i class="fas fa-times"></i>
						@endif
					</td>
					<td>
						@if($file_upload['kartu_karyawan'])
						<i class="fas fa-check"></i>
						@else
						<i class="fas fa-times"></i>
						@endif
					</td>
					<td>
						@if($file_upload['buku_nikah'])
						<i class="fas fa-check"></i>
						@else
						<i class="fas fa-times"></i>
						@endif
					</td>
					<td>
						@if($file_upload['akta'])
						<i class="fas fa-check"></i>
						@else
						<i class="fas fa-times"></i>
						@endif
					</td>
				</tr>
			</table>
		</div>
	</div>
</div>
@endsection
@section('footer')
<script>
	$('.popoover-pesawat').popover({
    	container: 'body',
    	html: true,
    	trigger: 'focus',
    	content: '<div class="row"><div class="col-md-6"><a href="{{url('api/cancel/pesawat')}}" class="btn btn-danger btn-sm btn-block">Ya</a></div><div class="col-md-6"><a href="#" class="btn btn-primary btn-sm btn-block">Tidak</a></div></div>'
  	});
  	$('.popoover-produk').popover({
    	container: 'body',
    	html: true,
    	trigger: 'focus',
    	content: '<div class="row"><div class="col-md-6"><a href="{{url('api/cancel/produk')}}" class="btn btn-danger btn-sm btn-block">Ya</a></div><div class="col-md-6"><a href="#" class="btn btn-primary btn-sm btn-block">Tidak</a></div></div>'
  	});
</script>
@endsection