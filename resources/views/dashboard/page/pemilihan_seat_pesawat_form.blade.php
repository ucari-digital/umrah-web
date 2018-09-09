@extends('dashboard.layout')
@section('header')
@php
$kode_pesawat='PSW2222';
@endphp
<style type="text/css">
	.seat-form th, .seat-form td{
		padding: 5px 10px;
	}
</style>
@endsection
@section('content')
<h4>Form Kursi Pesawat</h4>
<div class="dashboarad-content">
	<form action="{{url('api/pesawat/book-seat')}}" method="post">
		{{csrf_field()}}
		<div class="seat-form">
			<table>
				<tr>
					<th style="width: 50px">Seat</th>
					<th style="width: 200px">No. Peserta</th>
					<th style="width: 150px">PIN</th>
					<th style="width: 120px"></th>
					<th>Keterangan</th>
				</tr>		
			</table>
		</div>
		<table>
			<tr>
				<td style="width: 50px"></td>
				<td style="width: 200px"></td>
				<td style="width: 150px"></td>
				<td style="width: 120px"></td>
				<td></td>
			</tr>
			<tr>
				<td colspan="4" style="padding: 5px 10px">
					<button class="btn btn-primary btn-block">Pesan semua seat</button>
				</td>
			</tr>
			<tr>
				<td colspan="4" style="padding: 5px 10px">
					<small class="form-text text-muted">* Pastikan semua keterangan berisikan nama peserta. Jika tidak berisikan nama peserta maka seat yang telah dipilih tidak akan diproses / dibatalkan.</small>
					<small class="form-text text-muted">* Pemilihan kursi akan dibatalkan jika kursi dari salah satu peserta tidak tersedia.</small>
				</td>
			</tr>
		</table>
	</form>
</div>
<div class="d-none">
	<div class="template">
		<table>
			<tr>
				<td style="width: 50px"><input type="hidden" name="no_seat[]" value="{{$kode_pesawat}}{$number_seat}">{$number_seat}</td>
				<td style="width: 200px">
					<input type="text" name="nomor_peserta[]" id="seat_ps_{$number_seat}" class="form-control" onkeyup="replacement(this)" placeholder="No. Peserta">
				</td>
				<td style="width: 150px">
					<input type="text" name="pin[]" id="seat_pin_{$number_seat}" class="form-control" placeholder="PIN">
				</td>
				<td style="width: 120px">
					<button type="button" class="btn btn-primary" id="seat_btn_{$number_seat}" onclick="check_user('{$number_seat}')">Cek Peserta</button>
				</td>
				<td>
					<small id="seat_msg_{$number_seat}" class="form-text text-muted"></small>
				</td>
			</tr>
		</table>
	</div>
</div>
@endsection
@section('footer')
<script>
	var numb_seat = localStorage.getItem('seatnumb');


	for (var i = 0; i <= numb_seat; i++) {
		var replacement_element = $('.template').html().replace(/{\$number_seat}/g, localStorage.getItem('seat'+i));
		$('.seat-form').append(replacement_element);
	}

	function check_user(ns) {
		var seat_pesawat = $('#seat_ps_'+ns).val();
		var pin = $('#seat_pin_'+ns).val();

		$.post( "{{url('api/hotel/check-add-user')}}", {
            '_token': '{{csrf_token()}}',
            'nomor_peserta' : seat_pesawat,
  			'pin' : pin
        }).done(function(data){
        	console.log(data);
        	if (data['data'] == true) {
        		$('#seat_msg_'+ns).html("peserta '"+data['msg']['nama']+"' berhasil ditambahkan");
        	} else {
        		$('#seat_msg_'+ns).html('Peserta tidak ditemukan / Belum memilih tgl keberangkatan');
        	}
        });
	}

	function replacement(data) {
        $(data).val(data.value.replace("UMHPS", ''));
    }
</script>
@endsection