@extends('dashboard.layout') @section('content')
<h4>Upload Bukti Pembayaran</h4>
<div class="dashboarad-content row">
    <div class="col-md-6">
        <form action="{{url('api/bukti-pembayaran/upload')}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="form-group">
                <label>Jumlah Pembayaran
                    <b class="text-danger">*</b>
                </label>
                <input name="jumlah_pembayaran" type="text" class="form-control rupiah" placeholder="Rp. 0">
            </div>
            <div class="form-group">
                <label>Jenis Pembayaran
                    <b class="text-danger">*</b>
                </label>
                <select name="jenis_pembayaran" class="form-control">
                    <option>PILIH</option>
                    <option value="dp">Uang muka</option>
                    <option value="pelunasan">Pelunasan</option>
                </select>
            </div>
            <div class="form-group">
                <label>Tanggal Pembayaran
                    <b class="text-danger">*</b>
                </label>
                <input name="tgl_pembayaran" type="date" class="form-control">
            </div>
            <div class="form-group">
                <label>Upload Bukti
                    <b class="text-danger">*</b>
                </label>
                <input name="file_bukti" type="file" class="form-control">
            </div>
            <div class="form-group">
                <label>PIN
                    <b class="text-danger">*</b>
                </label>
                <input name="pin" type="text" class="form-control" placeholder="PIN">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
    <div class="col-md-6">
        <div class="history">
            <table class="table table-borderless">
                <tr>
                    <th>Tgl Upload</th>
                    <th>Nominal</th>
                    <th>Jenis</th>
                </tr>
                @foreach($history_pembayaran['data'] as $item)
                <tr>
                    <td>{{App\Helper\TimeFormat::formatId($item['created_at'])}}</td>
                    <td>{{App\Helper\Number::rupiah($item['jumlah_pembayaran'])}}</td>
                    @if($item['jenis_pembayaran'] == 'dp')
                    <td>Uang Muka</td>
                    @elseif($item['jenis_pembayaran'] == 'pelunasan')
                    <td>Pelunasan</td>
                    @endif
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection