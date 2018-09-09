@extends('dashboard.layout') @section('content') {{-- NAVBAR RIGHT --}}
<h4>Pilih Tanggal Berangkat</h4>
<div class="dashboarad-content">
	<form class="row">
		<div class="form-group col-md-6">
			<label for="">Embarkasi</label>
			<select name="embk" id="" class="form-control">
				<option value="">Pilih</option>
				@foreach($embarkasi['data'] as $item)
					<option value="{{$item['kode_embarkasi']}}">{{$item['kota']}}</option>
				@endforeach
			</select>
		</div>
		<div class="form-group col-md-2">
			<label class="d-block">&nbsp;</label>
			<button type="submit" class="btn btn-primary btn-block">Pilih</button>
		</div>
	</form>
	<hr>
	<div id="carousel" class="carousel slide" data-ride="carousel" data-interval="false">
		<div class="carousel-inner">
			<div class="carousel-item active">
				<div class="row">
					<div class="col-md-6">
						<div id="calendar-0"></div>
					</div>
					<div class="col-md-6">
						<div id="calendar-1"></div>
					</div>
				</div>
			</div>
			<div class="carousel-item">
				<div class="row">
					<div class="col-md-6">
						<div id="calendar-2"></div>
					</div>
					<div class="col-md-6">
						<div id="calendar-3"></div>
					</div>
				</div>
			</div>
			<div class="carousel-item">
				<div class="row">
					<div class="col-md-6">
						<div id="calendar-4"></div>
					</div>
					<div class="col-md-6">
						<div id="calendar-5"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row justify-content-between tgl-nav" style="display: none;">
		<div class="col-md-6">
			<i class="fas fa-angle-left float-left prev" style="font-size: 24px;cursor: pointer;"></i>
			<h4 class="float-left prev"  style="cursor: pointer">&nbsp;PREV</h4>
		</div>
		<div class="col-md-6">
			<i class="fas fa-angle-right float-right next" style="font-size: 24px;cursor: pointer;"></i>
			<h4 class="float-right next" style="cursor: pointer">NEXT&nbsp;</h4>
		</div>
	</div>
</div>
<div class="modal" id="myModal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<form action="{{url('api/umrah/book')}}" method="post" class="modal-content bg-content">
			{{csrf_field()}}
			<input type="hidden" name="tgl-berangkat" id="tgl-berangkat">
			<input type="hidden" name="kode_embarkasi" value="{{request('embk')}}">
			<div class="modal-header border-0">
				<h5 class="modal-title">Pemilihan Tanggal Keberangkatan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-prepend">
	    					<span class="input-group-text input-color border-0" id="basic-addon1">NO. Peserta</span>
	    				</div>
						<input type="text" name="nomor_peserta" class="form-control" placeholder="{{App\Helper\Str::rmUMHPS(session('users')['nomor_peserta'])}}" onkeyup="replacement(this.value)">
					</div>
                    <small class="form-text text-muted">Masukan no peserta jika ingin booking untuk orang lain</small>
				</div>
				<div class="form-group">
					<input type="password" name="pin" class="form-control" placeholder="PIN">
                    <small class="form-text text-muted">Masukan PIN</small>
				</div>
			</div>
			<div class="modal-footer border-0">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
				<button type="submit" class="btn btn-primary">Pilih</button>
			</div>
		</form>
	</div>
</div>
@endsection
@section('footer')
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/locale/id.js"></script>
<script>
	$(document).ready(function(){
		$('.next').click(function(){
			$('#carousel').carousel('next');
			navigation_slide();
		});
		$('.prev').click(function(){
			$('#carousel').carousel('prev');
			navigation_slide();
		});
		$('#carousel').on('slid.bs.carousel', function () {
			navigation_slide();
		})
	});
	function navigation_slide() {
		if($('.carousel-inner .carousel-item:first').hasClass('active')) {
			$('.next').show();
			$('.prev').hide();
		} else if($('.carousel-inner .carousel-item:last').hasClass('active')) {
			$('.next').hide();
			$('.prev').show();
		} else {
			$('.next').show();
			$('.prev').show();
		}
	}
	@if(request('embk'))
	$(document).ready(function(){
		$.post( "{{url('api/umrah/jadwal')}}", {
			'_token': '{{csrf_token()}}',
            'kode_embarkasi' : '{{request('embk')}}',
        })
        .done(function(data){
        	console.log(data);
        	$('.tgl-nav').show();
        	navigation_slide();
        	@for($i = 0; $i <= 6; $i++)

	        @php
	        $date = new DateTime(date('Y-m').'-01');
	        $date->modify('+ '.$i.'month');
	        @endphp
        	// Calendar 1
            $('#calendar-{{$i}}').fullCalendar({
	            selectable: true,
	            aspectRatio: 2,
	            events: data['calendar'],
	        })
	        $('#calendar-{{$i}}').fullCalendar('gotoDate', '{{$date->format('Y-m-d')}}');
	        var calendar = $('#calendar-{{$i}}').fullCalendar('getCalendar');
	        calendar.on('dayClick', function(date, jsEvent, view) {
	        	if (data['availabel'][date.format()] == false) {
	        		alert('Tanggal keberangkatan sudah penuh');
	        	} 
	        	if (data['availabel'][date.format()] == true) {
		            $('#tgl-berangkat').val(date.format());
		            $('#myModal').modal('toggle');
	        	}
	        });
	        @endfor

	        // // Calendar 2
	        // $('#calendar-2').fullCalendar({
	        //     selectable: true,
	        //     aspectRatio: 2,
	        //     events: data
	        // })
	        // $('#calendar-2').fullCalendar('gotoDate', '{{$date->format('Y-m-d')}}');
	        // var calendar2 = $('#calendar-2').fullCalendar('getCalendar');
	        
	        // calendar2.on('dayClick', function(date, jsEvent, view) {
	        //     console.log('clicked on ' + date.format());
	        // });
        });
    });
    @endif
    function replacement(text) {
        $("input[name='nomor_peserta']").val(text.replace("UMHPS", ''));
    }
</script>
@endsection