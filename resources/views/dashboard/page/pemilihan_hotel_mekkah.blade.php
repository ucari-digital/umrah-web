@extends('dashboard.layout') @section('content')
@php
use App\Helper\AuthTracker;
@endphp
<h4>Kamar Hotel</h4>
<div class="dashboarad-content">
	<div class="striped-navigation-hotel row no-gutters">
		<div class="col-md-6">
			<a href="{{url('kamar-hotel')}}" class="striped">Madinah</a>
		</div>
		<div class="col-md-6">
			<a href="{{url('kamar-hotel-mekkah')}}" class="striped active">mekkah</a>
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
			<input type="hidden" name="hotel" value="mekkah">
			<input type="hidden" name="type" id="type" value="{{$total_user}}">
			@if($total_user == '2')
			<input type="hidden" name="nomor_peserta1" value="{{substr($peserta[1]['nomor_peserta'], 5)}}">
			@else
			<input type="hidden" name="nomor_peserta2" value="{{substr($peserta[2]['nomor_peserta'], 5)}}">
			<input type="hidden" name="nomor_peserta3" value="{{substr($peserta[3]['nomor_peserta'], 5)}}">
			@endif
			<div class="modal-header">
				<h5 class="modal-title">Hotel Madinah.</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div id="default" class="rombongan">
					<div class="form-group">
						<ul class="list-unstyled">
							<li><h6>Anda akan memilih hotel Madinah dengan no kamar <span class="badge badge-dark no_kamar">149</span></h6></li>
							{{-- <li>- Pemilihan hotel tidak dapat dibatalkan.</li>
							<li>- Hotel yang Anda pilih akan berpengaruh pada anggota yang lain.</li> --}}
							<li>- Anggota yang akan bersama anda dalam satu ruangan : </li>
							<ul>
								@foreach($peserta as $pesertas)
								<li>{{$pesertas['nama']}}</li>
								@endforeach
							</ul>
						</ul>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-md-12">
						<input name="pin" type="password" class="form-control" placeholder="PIN Anda" required="">
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
				<button type="submit" class="btn btn-primary">Konfirmasi</button>
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

			$.post( "{{url('api/hotel/get-hotel-availabel')}}", {
	            '_token': '{{csrf_token()}}',
	            'kode_hotel' : '{{request('h')}}',
	            'lantai' : '{{request('l')}}',
	            'hotel' : 'mekkah'
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

		$(document).on('click', '.availabel', function(){
			$('#myModal').modal('toggle');
			$('#kode-kamar').val($(this).data('rcode'));
			$('.no_kamar').html($(this).html());
		})
	</script>
@endsection