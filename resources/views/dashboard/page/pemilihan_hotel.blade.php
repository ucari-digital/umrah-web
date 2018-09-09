@extends('dashboard.layout') @section('content')
@php
use App\Helper\AuthTracker;
@endphp
<h4>Kamar Hotel</h4>
<div class="dashboarad-content">
	<div class="striped-navigation-hotel row no-gutters">
		<div class="col-md-6">
			<a href="{{url('kamar-hotel')}}" class="striped active">Madinah</a>
		</div>
		<div class="col-md-6">
			<a href="{{url('kamar-hotel-mekkah')}}" class="striped">makkah</a>
		</div>
	</div>
	<div class="row mt-4">
		<div class="col-md-12">
			<form class="row">
				<div class="form-group col-md-4">
					<label for="">Hotel</label>
					<select name="h" class="form-control">
						@foreach($hotel['data'] as $hotel)
						<option value="{{$hotel['kode_hotel']}}">{{$hotel['nama_hotel']}}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group col-md-4">
					<label for="">Lantai</label>
					<select name="l" class="form-control">
						@for($i=1;$i<=30;$i++)
						<option value="{{$i}}">Lantai {{$i}}</option>
						@endfor
					</select>
				</div>
				<div class="form-group col-md-4">
					<label class="d-block">&nbsp;</label>
					<button type="submit" class="btn btn-primary">Pilih Hotel</button>
				</div>
			</form>
		</div>
	</div>
	@if(request('h'))
	<div class="kamar-hotel row mt-4">
		<div class="col-md-12 text-center">
			<h5 id="nama-hotel">Hotel</h5> <h5 id="nomor-lantai">Lantai</h5>
		</div>
		<div class="col-md-12 mt-2">
			<table>
				<tr>
					<td class="room undefined" data-rcode="ROOM{{request('h').request('l')}}01">{{request('l')}}01</td>
					<td class="room undefined" data-rcode="ROOM{{request('h').request('l')}}03">{{request('l')}}03</td>
					<td class="room undefined" data-rcode="ROOM{{request('h').request('l')}}05">{{request('l')}}05</td>
					<td class="room undefined" data-rcode="ROOM{{request('h').request('l')}}07">{{request('l')}}07</td>
					<td class="room undefined" data-rcode="ROOM{{request('h').request('l')}}09">{{request('l')}}09</td>
					<td class="room undefined" data-rcode="ROOM{{request('h').request('l')}}11">{{request('l')}}11</td>
					<td class="room undefined" data-rcode="ROOM{{request('h').request('l')}}13">{{request('l')}}13</td>
					<td class="room undefined" data-rcode="ROOM{{request('h').request('l')}}15">{{request('l')}}15</td>
					<td class="room undefined" data-rcode="ROOM{{request('h').request('l')}}17">{{request('l')}}17</td>
					<td class="room"></td>
					<td class="room undefined" data-rcode="ROOM{{request('h').request('l')}}19">{{request('l')}}19</td>
					<td class="room undefined" data-rcode="ROOM{{request('h').request('l')}}21">{{request('l')}}21</td>
					<td class="room undefined" data-rcode="ROOM{{request('h').request('l')}}23">{{request('l')}}23</td>
					<td class="room undefined" data-rcode="ROOM{{request('h').request('l')}}25">{{request('l')}}25</td>
					<td class="room undefined" data-rcode="ROOM{{request('h').request('l')}}27">{{request('l')}}27</td>
					<td class="room undefined" data-rcode="ROOM{{request('h').request('l')}}29">{{request('l')}}29</td>
					<td class="room undefined" data-rcode="ROOM{{request('h').request('l')}}31">{{request('l')}}31</td>
					<td class="room undefined" data-rcode="ROOM{{request('h').request('l')}}33">{{request('l')}}33</td>
				</tr>
				<tr>
					<td class="coridor"></td>
				</tr>
				<tr>
					<td class="room undefined" data-rcode="ROOM{{request('h').request('l')}}02">{{request('l')}}02</td>
					<td class="room undefined" data-rcode="ROOM{{request('h').request('l')}}04">{{request('l')}}04</td>
					<td class="room undefined" data-rcode="ROOM{{request('h').request('l')}}06">{{request('l')}}06</td>
					<td class="room undefined" data-rcode="ROOM{{request('h').request('l')}}08">{{request('l')}}08</td>
					<td class="room undefined" data-rcode="ROOM{{request('h').request('l')}}10">{{request('l')}}10</td>
					<td class="room undefined" data-rcode="ROOM{{request('h').request('l')}}12">{{request('l')}}12</td>
					<td class="room undefined" data-rcode="ROOM{{request('h').request('l')}}14">{{request('l')}}14</td>
					<td class="room undefined" data-rcode="ROOM{{request('h').request('l')}}16">{{request('l')}}16</td>
					<td class="room undefined" data-rcode="ROOM{{request('h').request('l')}}18">{{request('l')}}18</td>
					<td class="room"></td>
					<td class="room undefined" data-rcode="ROOM{{request('h').request('l')}}20">{{request('l')}}20</td>
					<td class="room undefined" data-rcode="ROOM{{request('h').request('l')}}22">{{request('l')}}22</td>
					<td class="room undefined" data-rcode="ROOM{{request('h').request('l')}}24">{{request('l')}}24</td>
					<td class="room undefined" data-rcode="ROOM{{request('h').request('l')}}26">{{request('l')}}26</td>
					<td class="room undefined" data-rcode="ROOM{{request('h').request('l')}}28">{{request('l')}}28</td>
					<td class="room undefined" data-rcode="ROOM{{request('h').request('l')}}30">{{request('l')}}30</td>
					<td class="room undefined" data-rcode="ROOM{{request('h').request('l')}}32">{{request('l')}}32</td>
					<td class="room undefined" data-rcode="ROOM{{request('h').request('l')}}34">{{request('l')}}34</td>
				</tr>
			</table>
		</div>
		<hr>
		<div class="col-md-12 mt-2">
			<table>
				<tr>
					<td colspan="2">
						<h6 style="padding: 5px;">Keterangan</h6>
					</td>
				</tr>
				<tr>
					<td class="bg-green" style="width: 20px; height: 20px; border: 5px solid #2C343A;"></td>
					<td>Kamar masih tersedia</td>
				</tr>
				<tr>
					<td class="bg-red" style="width: 20px; height: 20px; border: 5px solid #2C343A;"></td>
					<td>Kamar tidak tersedia</td>
				</tr>
				<tr>
					<td class="bg-tcolor" style="width: 20px; height: 20px; border: 5px solid #2C343A;"></td>
					<td>Ruangan tidak tersedia</td>
				</tr>
			</table>
		</div>
	</div>
	@endif
	<div class="informasi d-none">
	</div>
</div>
{{-- MODAL --}}
<div class="modal" id="myModal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<form action="{{url('api/hotel/book')}}" method="post" class="modal-content bg-content">
			{{csrf_field()}}
			<input type="hidden" name="kode_kamar" id="kode-kamar">
			<input type="hidden" name="hotel" value="madinah">
			<input type="hidden" name="type" id="type">
			<div class="modal-header">
				<h5 class="modal-title">Hotel Madinah.</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="question row">
					<div class="col-md-6">
						<button type="button" class="btn btn-primary btn-block" onclick="formPost('suami-istri')">Suami Istri</button>
					</div>
					<div class="col-md-6">
						<button type="button" class="btn btn-primary btn-block" onclick="formPost('rombongan')">Group</button>
					</div>
				</div>
				<div id="default" class="rombongan" style="display: none;">
					<div class="form-group">
						<ul class="list-unstyled">
							<li><h6>Anda akan memilih hotel Madinah dengan no kamar <span class="badge badge-dark no_kamar">149</span></h6></li>
						</ul>
					</div>
					<div class="form-group row">
						<div class="col-md-5">
							<input name="nomor_peserta1" type="text" class="form-control" placeholder="No Peserta" id="one-numb" required="">
						</div>
						<div class="col-md-4">
							<input name="pin1" type="password" class="form-control" placeholder="PIN Peserta" id="one-pin" required="">
						</div>
						<div class="col-md-3">
							<button type="button" class="btn btn-primary" onclick="checkPeserta('one')" id="one-btn">Cek Peserta</button>
						</div>
						<small class="form-text text-muted col-md-12" id="one-message"></small>
					</div>
					<div class="form-group row">
						<div class="col-md-5">
							<input name="nomor_peserta2" type="text" class="form-control" placeholder="No Peserta" id="two-numb" required="">
						</div>
						<div class="col-md-4">
							<input name="pin2" type="password" class="form-control" placeholder="PIN Peserta" id="two-pin" required="">
						</div>
						<div class="col-md-3">
							<button type="button" class="btn btn-primary" onclick="checkPeserta('two')" id="two-btn">Cek Peserta</button>
						</div>
						<small class="form-text text-muted col-md-12" id="two-message"></small>
					</div>
					<div class="form-group row">
						<div class="col-md-5">
							<input name="nomor_peserta3" type="text" class="form-control" placeholder="No Peserta" id="three-numb" required="">
						</div>
						<div class="col-md-4">
							<input name="pin3" type="password" class="form-control" placeholder="PIN Peserta" id="three-pin" required="">
						</div>
						<div class="col-md-3">
							<button type="button" class="btn btn-primary" onclick="checkPeserta('three')" id="three-btn">Cek Peserta</button>
						</div>
						<small class="form-text text-muted col-md-12" id="three-message"></small>
					</div>
					<div class="form-group row">
						<div class="col-md-12">
							<input name="pin" type="password" class="form-control" placeholder="PIN Anda">
						</div>
					</div>
				</div>

				<div id="default" class="suami-istri" style="display: none;">
					<div class="form-group">
						<ul class="list-unstyled">
							<li><h6>Anda akan memilih hotel Madinah dengan no kamar <span class="badge badge-dark no_kamar">149</span></h6></li>
							{{-- <li>- Peserta Haruslah Suami Istri</li>
							<li>- Pemilihan hotel tidak dapat dibatalkan.</li>
							<li>- Hotel yang Anda pilih akan berpengaruh pada anggota yang lain.</li>
							<li>- Anggota yang akan bersama anda dalam satu ruangan : </li> --}}
						</ul>
					</div>
					<div class="form-group row">
						<div class="col-md-5">
							<input name="nomor_peserta1" type="text" class="form-control" placeholder="No Peserta" id="onesu-numb" required="">
						</div>
						<div class="col-md-4">
							<input name="pin1" type="password" class="form-control" placeholder="PIN Peserta" id="onesu-pin" required="">
						</div>
						<div class="col-md-3">
							<button type="button" class="btn btn-primary" onclick="checkPeserta('onesu')" id="onesu-btn">Cek Peserta</button>
						</div>
						<small class="form-text text-muted col-md-12" id="onesu-message"></small>
					</div>
					<div class="form-group row">
						<div class="col-md-12">
							<input name="pin" type="password" class="form-control" placeholder="PIN Anda">
						</div>
					</div>
				</div>
				
				<div class="row justify-content-md-center" id="success">
					<div class="col-md-7">
						<div class="h4 text-center"><i class="far fa-check-circle icon-alert success"></i> Berhasil memilih hotel</div>
						<span class="text-center d-block">Silahkan klik tombol dibawah ini untuk memilih hotel Mekkah</span>
						<a href="{{url('kamar-hotel-mekkah')}}" class="btn btn-primary btn-block mt-3">Hotel Mekkah</a>
					</div>
				</div>
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
				<button type="submit" class="btn btn-primary" onclick="postMadinah()">Konfirmasi</button>
			</div>
			<div class="informasi d-none">
				<div id="one-peserta"></div>
				<div id="onesu-peserta"></div>
				<div id="two-peserta"></div>
				<div id="three-peserta"></div>
			</div>
		</form>
	</div>
</div>
@endsection
@section('footer')
	<script>
		$(document).ready(function(){
			$('#success').hide();
			// Cek Kamar Hotel Availabel
			$.post( "{{url('api/hotel/get-hotel-availabel')}}", {
	            '_token': '{{csrf_token()}}',
	            'kode_hotel' : '{{request('h')}}',
	            'lantai' : '{{request('l')}}',
	            'hotel' : 'madinah'
	        })
	        .done(function(data){
	        	console.log(data);
	        	$('#nama-hotel').html('Hotel '+data[0]['nama_hotel']);
	        	$('#nomor-lantai').html('Lantai '+data[0]['lantai']);
	        	$.each(data, function(numb, item){
	        		if (item['status'] == true) {
	        			$("[data-rcode="+item['kode_kamar']+"]").removeClass('undefined').addClass('availabel');
	        		}
	        		if (item['status'] == false){
	        			$("[data-rcode="+item['kode_kamar']+"]").removeClass('undefined').addClass('unavailabel');
	        		}
	        	});
	        });
		});
		function formPost(cond) {
			if (cond == 'suami-istri') {
				$('.suami-istri').show();
				$('.question').hide();
				$('.rombongan').remove();
				$('#type').val('2');
			}
			if (cond == 'rombongan') {
				$('.rombongan').show();
				$('.question').hide();
				$('.suami-istri').remove();
				$('#type').val('4');
			}
		}
		function checkPeserta(id) {
			$.post( "{{url('api/hotel/check-add-user')}}", {
	            '_token': '{{csrf_token()}}',
	            'nomor_peserta' : $('#'+id+'-numb').val(),
	  			'pin' : $('#'+id+'-pin').val()
	        })
	        .done(function(data){
	        	console.log(data);
	        	if (data['data'] == true) {
	        		$('#'+id+'-btn').html('<i class="far fa-check-circle icon-alert success"></i>');
	        		$('#'+id+'-message').html('Peserta "'+data['msg']['nama']+'" berhasil ditambahkan');
	        		$('#'+id+'-peserta').html($('#'+id+'-numb').val());
	        	} else {
	        		$('#'+id+'-message').html('Peserta tidak ditemukan / Belum lengkap');
	        		$('#'+id+'-numb').val('');
	        		$('#'+id+'-pin').val('');
	        	}
	        });
	  		// console.log($('#'+id+'-numb').val());
		}

		$(document).on('click', '.availabel', function(){
			$('#myModal').modal('toggle');
			$('#kode-kamar').val($(this).data('rcode'));
			$('.no_kamar').html($(this).html());
		})
	</script>
@endsection