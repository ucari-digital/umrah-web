@extends('dashboard.layout') @section('content')
@php
use App\Helper\AuthTracker;
@endphp
<h4>Kamar Hotel Booking Informasi</h4>
<div class="dashboarad-content">
	@foreach($status as $status)
	<div class="row mt-3">
		<div class="col-md-12">{{$status['peserta']['nama']}}</div>
		<div class="col-md-12"><h6 class="d-inline-block">Status : </h6> {{$status['status']['msg']}}</div>
	</div>
	@endforeach
</div>
@endsection
