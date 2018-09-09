@extends('dashboard.layout') @section('content') {{-- NAVBAR RIGHT --}}
<h4>Pilih Tanggal Berangkat</h4>
<div class="dashboarad-content">
<div class="col-md-6">
	<form>
		<div class="form-group">
            <label>Nama Lengkap</label>
            <input name="" type="text" class="form-control" placeholder="Nama Lengkap">
            <small class="form-text text-muted">Nama harus sesuai dengan KTP.</small>
        </div>
		<div class="form-group">
			<label for="">Total Tagihan</label>
			<input type="text" class="form-control" disabled>
		</div>
		<div class="form-group">
			<label>Upload Bukti
				<b class="text-danger">*</b>
			</label>
			<input type="file" class="form-control">
		</div>
		<div class="form-group">
			<label>Jumlah Pembayaran
				<b class="text-danger">*</b>
			</label>
			<input type="text" class="form-control" placeholder="Rp. 0">
		</div>
		<div class="form-group">
			<label>Tanggal Pembayaran
				<b class="text-danger">*</b>
			</label>
			<input type="text" class="form-control">
		</div>
		<div class="form-group">
			<label>Dari Rekening
				<b class="text-danger">*</b>
			</label>
			<select class="form-control">
				<option>PILIH</option>
			</select>
		</div>
		<button type="submit" class="btn btn-primary">Simpan</button>
	</form>
</div>
@endsection
@section('footer')
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/locale/id.js"></script>
<script>
	$(document).ready(function(){
		$.get( "{{url('api/umrah/jadwal')}}", {
        })
        .done(function(data){
        	// Calendar 1
            $('#calendar-1').fullCalendar({
	            selectable: true,
	            aspectRatio: 2,
	            events: data
	        })
	        $('#calendar-1').fullCalendar('gotoDate', '{{date('Y-m')}}-01');
	        var calendar = $('#calendar-1').fullCalendar('getCalendar');
	        calendar.on('dayClick', function(date, jsEvent, view) {
	            $('#tgl-berangkat').val(date.format());
	            $('#myModal').modal('toggle');
	        });

	        // Calendar 2
	        $('#calendar-2').fullCalendar({
	            selectable: true,
	            aspectRatio: 2,
	            events: data
	        })
	        @php
	        $date = new DateTime(date('Y-m').'-01');
	        $date->modify('+1 month');
	        @endphp
	        $('#calendar-2').fullCalendar('gotoDate', '{{$date->format('Y-m-d')}}');
	        var calendar2 = $('#calendar-2').fullCalendar('getCalendar');
	        
	        calendar2.on('dayClick', function(date, jsEvent, view) {
	            console.log('clicked on ' + date.format());
	        });
        });
    });
</script>
@endsection