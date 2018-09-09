@extends('dashboard.layout') @section('content') {{-- NAVBAR RIGHT --}}
@php
$kode_pesawat='PSW2222';
@endphp
<h4>Pilih Kursi Pesawat</h4>
<div class="dashboarad-content">
    <table class="pesawat">
        <tr>
            @php
            $no = '4';
            @endphp
            <td class="text-right pr-2">{{$no}}</td>
            <td class="box-seat">
                <div class="seat" id="{{$kode_pesawat.$no.'A'}}" onclick="action_seat('{{$no}}A')">{{$no}}A</div>
            </td>
            <td class="box-seat">
                <div class="seat" id="{{$kode_pesawat.$no.'B'}}" onclick="action_seat('{{$no}}B')">{{$no}}B</div>
            </td>
            <td class="box-seat">
                <div class="seat" id="{{$kode_pesawat.$no.'C'}}" onclick="action_seat('{{$no}}C')">{{$no}}C</div>
            </td>
            <td class="box-seat">
                <div class="coridor"></div>
            </td>
            <td class="box-seat">
                <div class="seat-null"></div>
            </td>
            <td class="box-seat">
                <div class="seat-null"></div>
            </td>
            <td class="box-seat">
                <div class="seat-null"></div>
            </td>
            <td class="box-seat">
                <div class="coridor"></div>
            </td>
            <td class="box-seat">
                <div class="seat" id="{{$kode_pesawat.$no.'H'}}" onclick="action_seat('{{$no}}H')">{{$no}}H</div>
            </td>
            <td class="box-seat">
                <div class="seat" id="{{$kode_pesawat.$no.'J'}}" onclick="action_seat('{{$no}}J')">{{$no}}J</div>
            </td>
            <td class="box-seat">
                <div class="seat" id="{{$kode_pesawat.$no.'K'}}" onclick="action_seat('{{$no}}K')">{{$no}}K</div>
            </td>
            @php
            $no = 0;
            @endphp
        </tr>
        @for($no = 5; $no <= 7; $no++)
        <tr>
            <td class="text-right pr-2">{{$no}}</td>
            <td class="box-seat">
                <div class="seat" id="{{$kode_pesawat.$no.'A'}}" onclick="action_seat('{{$no}}A')">{{$no}}A</div>
            </td>
            <td class="box-seat">
                <div class="seat" id="{{$kode_pesawat.$no.'B'}}" onclick="action_seat('{{$no}}B')">{{$no}}B</div>
            </td>
            <td class="box-seat">
                <div class="seat" id="{{$kode_pesawat.$no.'C'}}" onclick="action_seat('{{$no}}C')">{{$no}}C</div>
            </td>
            <td class="box-seat">
                <div class="coridor"></div>
            </td>
            <td class="box-seat">

                <div class="seat" id="{{$kode_pesawat.$no.'D'}}" onclick="action_seat('{{$no}}D')">{{$no}}D</div>
            </td>
            <td class="box-seat">
                <div class="seat" id="{{$kode_pesawat.$no.'F'}}" onclick="action_seat('{{$no}}F')">{{$no}}F</div>
            </td>
            <td class="box-seat">
                <div class="seat" id="{{$kode_pesawat.$no.'G'}}" onclick="action_seat('{{$no}}G')">{{$no}}G</div>
            </td>
            <td class="box-seat">
                <div class="coridor"></div>
            </td>
            <td class="box-seat">
                <div class="seat" id="{{$kode_pesawat.$no.'H'}}" onclick="action_seat('{{$no}}H')">{{$no}}H</div>
            </td>
            <td class="box-seat">
                <div class="seat" id="{{$kode_pesawat.$no.'J'}}" onclick="action_seat('{{$no}}J')">{{$no}}J</div>
            </td>
            <td class="box-seat">
                <div class="seat" id="{{$kode_pesawat.$no.'K'}}" onclick="action_seat('{{$no}}K')">{{$no}}K</div>
            </td>
        </tr>
        @endfor
        @for($no = 8; $no <= 10; $no++)
        <tr>
            <td class="text-right pr-2">{{$no}}</td>
            <td class="box-seat">
                <div class="seat-null"></div>
            </td>
            <td class="box-seat">
                <div class="seat-null"></div>
            </td>
            <td class="box-seat">
                <div class="seat-null"></div>
            </td>
            <td class="box-seat">
                <div class="coridor"></div>
            </td>
            <td class="box-seat">
                <div class="seat" id="{{$kode_pesawat.$no.'D'}}" onclick="action_seat('{{$no}}D')">{{$no}}D</div>
            </td>
            <td class="box-seat">
                <div class="seat" id="{{$kode_pesawat.$no.'F'}}" onclick="action_seat('{{$no}}F')">{{$no}}F</div>
            </td>
            <td class="box-seat">
                <div class="seat" id="{{$kode_pesawat.$no.'G'}}" onclick="action_seat('{{$no}}G')">{{$no}}G</div>
            </td>
            <td class="box-seat">
                <div class="coridor"></div>
            </td>
            <td class="box-seat">
                <div class="seat-null"></div>
            </td>
            <td class="box-seat">
                <div class="seat-null"></div>
            </td>
            <td class="box-seat">
                <div class="seat-null"></div>
            </td>
        </tr>
        @endfor
        @for($no = 14; $no <= 32; $no++)
        <tr>
            <td class="text-right pr-2">{{$no}}</td>
            <td class="box-seat">
                <div class="seat" id="{{$kode_pesawat.$no.'A'}}" onclick="action_seat('{{$no}}A')">{{$no}}A</div>
            </td>
            <td class="box-seat">
                <div class="seat" id="{{$kode_pesawat.$no.'B'}}" onclick="action_seat('{{$no}}B')">{{$no}}B</div>
            </td>
            <td class="box-seat">
                <div class="seat" id="{{$kode_pesawat.$no.'C'}}" onclick="action_seat('{{$no}}C')">{{$no}}C</div>
            </td>
            <td class="box-seat">
                <div class="coridor"></div>
            </td>
            <td class="box-seat">
                <div class="seat" id="{{$kode_pesawat.$no.'D'}}" onclick="action_seat('{{$no}}D')">{{$no}}D</div>
            </td>
            <td class="box-seat">
                <div class="seat" id="{{$kode_pesawat.$no.'F'}}" onclick="action_seat('{{$no}}F')">{{$no}}F</div>
            </td>
            <td class="box-seat">
                <div class="seat" id="{{$kode_pesawat.$no.'G'}}" onclick="action_seat('{{$no}}G')">{{$no}}G</div>
            </td>
            <td class="box-seat">
                <div class="coridor"></div>
            </td>
            <td class="box-seat">
                <div class="seat" id="{{$kode_pesawat.$no.'H'}}" onclick="action_seat('{{$no}}H')">{{$no}}H</div>
            </td>
            <td class="box-seat">
                <div class="seat" id="{{$kode_pesawat.$no.'J'}}" onclick="action_seat('{{$no}}J')">{{$no}}J</div>
            </td>
            <td class="box-seat">
                <div class="seat" id="{{$kode_pesawat.$no.'K'}}" onclick="action_seat('{{$no}}K')">{{$no}}K</div>
            </td>
        </tr>
        @endfor
        <tr>
            @php
            $no = '33';
            @endphp
            <td class="text-right pr-2">{{$no}}</td>
            <td class="box-seat">
                <div class="seat-null"></div>
            </td>
            <td class="box-seat">
                <div class="seat-null"></div>
            </td>
            <td class="box-seat">
                <div class="seat-null"></div>
            </td>
            <td class="box-seat">
                <div class="coridor"></div>
            </td>
            <td class="box-seat">
                <div class="seat" id="{{$kode_pesawat.$no.'D'}}" onclick="action_seat('{{$no}}D')">{{$no}}D</div>
            </td>
            <td class="box-seat">
                <div class="seat" id="{{$kode_pesawat.$no.'F'}}" onclick="action_seat('{{$no}}F')">{{$no}}F</div>
            </td>
            <td class="box-seat">
                <div class="seat" id="{{$kode_pesawat.$no.'G'}}" onclick="action_seat('{{$no}}G')">{{$no}}G</div>
            </td>
            <td class="box-seat">
                <div class="coridor"></div>
            </td>
            <td class="box-seat">
                <div class="seat-null"></div>
            </td>
            <td class="box-seat">
                <div class="seat-null"></div>
            </td>
            <td class="box-seat">
                <div class="seat-null"></div>
            </td>
            @php
            $no = 0;
            @endphp
        </tr>
        @for($no = 36; $no <= 43; $no++)
        <tr>
            <td class="text-right pr-2">{{$no}}</td>
            <td class="box-seat">
                <div class="seat" id="{{$kode_pesawat.$no.'A'}}" onclick="action_seat('{{$no}}A')">{{$no}}A</div>
            </td>
            <td class="box-seat">
                <div class="seat" id="{{$kode_pesawat.$no.'B'}}" onclick="action_seat('{{$no}}B')">{{$no}}B</div>
            </td>
            <td class="box-seat">
                <div class="seat" id="{{$kode_pesawat.$no.'C'}}" onclick="action_seat('{{$no}}C')">{{$no}}C</div>
            </td>
            <td class="box-seat">
                <div class="coridor"></div>
            </td>
            <td class="box-seat">
                <div class="seat" id="{{$kode_pesawat.$no.'D'}}" onclick="action_seat('{{$no}}D')">{{$no}}D</div>
            </td>
            <td class="box-seat">
                <div class="seat" id="{{$kode_pesawat.$no.'F'}}" onclick="action_seat('{{$no}}F')">{{$no}}F</div>
            </td>
            <td class="box-seat">
                <div class="seat" id="{{$kode_pesawat.$no.'G'}}" onclick="action_seat('{{$no}}G')">{{$no}}G</div>
            </td>
            <td class="box-seat">
                <div class="coridor"></div>
            </td>
            <td class="box-seat">
                <div class="seat" id="{{$kode_pesawat.$no.'H'}}" onclick="action_seat('{{$no}}H')">{{$no}}H</div>
            </td>
            <td class="box-seat">
                <div class="seat" id="{{$kode_pesawat.$no.'J'}}" onclick="action_seat('{{$no}}J')">{{$no}}J</div>
            </td>
            <td class="box-seat">
                <div class="seat" id="{{$kode_pesawat.$no.'K'}}" onclick="action_seat('{{$no}}K')">{{$no}}K</div>
            </td>
        </tr>
        @endfor
        @for($no=44; $no <= 49; $no++)
        <tr>
            <td class="text-right pr-2">{{$no}}</td>
            <td class="box-seat">
                <div class="seat" id="{{$kode_pesawat.$no.'A'}}" onclick="action_seat('{{$no}}A')">{{$no}}A</div>
            </td>
            <td class="box-seat">
                <div class="seat" id="{{$kode_pesawat.$no.'B'}}" onclick="action_seat('{{$no}}B')">{{$no}}B</div>
            </td>
            <td class="box-seat">
                <div class="seat-null"></div>
            </td>
            <td class="box-seat">
                <div class="coridor"></div>
            </td>
            <td class="box-seat">
                <div class="seat" id="{{$kode_pesawat.$no.'D'}}" onclick="action_seat('{{$no}}D')">{{$no}}D</div>
            </td>
            <td class="box-seat">
                <div class="seat" id="{{$kode_pesawat.$no.'F'}}" onclick="action_seat('{{$no}}F')">{{$no}}F</div>
            </td>
            <td class="box-seat">
                <div class="seat" id="{{$kode_pesawat.$no.'G'}}" onclick="action_seat('{{$no}}G')">{{$no}}G</div>
            </td>
            <td class="box-seat">
                <div class="coridor"></div>
            </td>
            <td class="box-seat">
                <div class="seat-null"></div>
            </td>
            <td class="box-seat">
                <div class="seat" id="{{$kode_pesawat.$no.'J'}}" onclick="action_seat('{{$no}}J')">{{$no}}J</div>
            </td>
            <td class="box-seat">
                <div class="seat" id="{{$kode_pesawat.$no.'K'}}" onclick="action_seat('{{$no}}K')">{{$no}}K</div>
            </td>
        </tr>
        @endfor
        <tr>
            @php
            $no = '50';
            @endphp
            <td class="text-right pr-2">{{$no}}</td>
            <td class="box-seat">
                <div class="coridor"></div>
            </td>
            <td class="box-seat">
                <div class="coridor"></div>
            </td>
            <td class="box-seat">
                <div class="seat-null"></div>
            </td>
            <td class="box-seat">
                <div class="coridor"></div>
            </td>
            <td class="box-seat">
                <div class="seat" id="{{$kode_pesawat.$no.'D'}}" onclick="action_seat('{{$no}}D')">{{$no}}D</div>
            </td>
            <td class="box-seat">
                <div class="seat" id="{{$kode_pesawat.$no.'F'}}" onclick="action_seat('{{$no}}F')">{{$no}}F</div>
            </td>
            <td class="box-seat">
                <div class="seat" id="{{$kode_pesawat.$no.'G'}}" onclick="action_seat('{{$no}}G')">{{$no}}G</div>
            </td>
            <td class="box-seat">
                <div class="coridor"></div>
            </td>
            <td class="box-seat">
                <div class="seat-null"></div>
            </td>
            <td class="box-seat">
                <div class="coridor"></div>
            </td>
            <td class="box-seat">
                <div class="coridor"></div>
            </td>
            @php
            $no = 0;
            @endphp
        </tr>
    </table>
</div>

{{-- Modal --}}
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" id="link-seat">
        <form class="modal-content bg-content" action="{{url('api/pesawat/book-seat/'.$kode_pesawat)}}$kode_kursi" data-replace="$kode_kursi" method="post" id="dom-link-seat">
            {{csrf_field()}}
            <div class="modal-header border-0">
                <h5 class="modal-title" id="exampleModalLabel">Pemilihan seat <span class="h4 text-danger" id="number-seat"></span></h5>
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
                </div>
                <div class="form-group">
                    {{-- <label class="col-form-label">PIN</label> --}}
                    <input type="password" name="pin" class="form-control" placeholder="PIN">
                    <small id="emailHelp" class="form-text text-muted">Masukan PIN</small>
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
@section('header')
    <style type="text/css">
        .table-book{
            position: fixed;
            width: 100%;
            height: auto;
            bottom: 0;
            color: #FFF;
            background-color: #16191C !important;
        }

        .table-responsive{
            width: 95%;
            display: inline-block;
        }

        .table-list td{
            padding: 10px;
            color: #FFF;
            background-color: #4CAF50;
            border-left: 2px solid #16191C;
            border-right: 2px solid #16191C;
            width: 45px;
            height: 45px;
            text-align: center;
        }

        .table-list td:hover{
            background-color: #F44336;
            cursor: pointer;
        }

        .submit-button{
            display: inline-block;
            float: right;
            background-color: #424250;
            height: 45px;
            width: 5%;
            padding: 13px 0px;
            text-align: center;
        }

        .placeholder{
            height: 45px;
            margin: 0;
            padding: 13px;
        }
    </style>
@endsection
@section('footer')
    {{-- LIST BOOK --}}
    <div class="table-book">
        <div class="table-responsive">
            <table class="table-list" style="display: none;">
                <tr class="seat-box">
                </tr>
            </table>
            <h6 class="text-center placeholder">Tidak ada seat yang dipilih.</h6>
        </div>
        <a href="{{url('kursi-pesawat-form')}}" class="submit-button text-white">
            lanjut
        </a>
    </div>
    <script>
        function action_seat(seat_id) {
            // $('#myModal').modal('toggle');
            // $('#number-seat').html(seat_id);
            // var replace_html = $('#link-seat').html().replace($('#dom-link-seat').data('replace'), seat_id);
            // $('#link-seat').html(replace_html);
            // $('#dom-link-seat').data('replace', seat_id);
            $('.table-list').show();
            $('.placeholder').hide();
            $('.seat-box').append('<td class="book-seat" data-seat="'+seat_id+'">'+seat_id+'</td>')
            $('#{{$kode_pesawat}}'+seat_id).removeAttr('onclick');

            localStorage.clear();
            var number_book_seat = $('.seat-box').children('td').length;
            $('.book-seat').map(function(i){
                localStorage.setItem('seatnumb', i);
                localStorage.setItem('seat'+i, $(this).data('seat'));
                $(this).data('number', number_book_seat);
            });
        }

        $(document).on('click', '.book-seat', function(){
            $('#{{$kode_pesawat}}'+$(this).data('seat')).attr('onclick', 'action_seat("'+$(this).data('seat')+'")');
            $(this).remove();

            localStorage.clear();
            var number_book_seat = $('.seat-box').children('td').length;
            $('.book-seat').map(function(){
                localStorage.setItem('seatnumb', number_book_seat);
                localStorage.setItem('seat'+number_book_seat, $(this).data('seat'));
                $(this).data('number', number_book_seat);
            });
        });

        function get_seat() {
            for (var i = 0; i <= localStorage.getItem('seatnumb'); i++) {
                console.log(localStorage.getItem('seat'+i));
            }
        }

        function shuffle(array) {
            var currentIndex = array.length, temporaryValue, randomIndex;

            // While there remain elements to shuffle...
            while (0 !== currentIndex) {

            // Pick a remaining element...
            randomIndex = Math.floor(Math.random() * currentIndex);
            currentIndex -= 1;

            // And swap it with the current element.
            temporaryValue = array[currentIndex];
            array[currentIndex] = array[randomIndex];
            array[randomIndex] = temporaryValue;
            }

            return array;
        }

        // skeleton_4array = 

        var array = [
            '4A', '4B', '4C', '4H', '4J', '4K',
            '5A', '5B', '5C', '5D', '5F', '5G', '5H', '5J', '5K',
            '6A', '6B', '6C', '6D', '6F', '6G', '6H', '6J', '6K',
            '7A', '7B', '7C', '7D', '7F', '7G', '7H', '7J', '7K',
            '8D', '8F', '8G',
            '9D', '9F', '9G',
            '10D', '10F', '10G',
            '14A', '14B', '14C', '14D', '14F', '14G', '14H', '14J', '14K',
            '15A', '15B', '15C', '15D', '15F', '15G', '15H', '15J', '15K',
            '16A', '16B', '16C', '16D', '16F', '16G', '16H', '16J', '16K',
            '17A', '17B', '17C', '17D', '17F', '17G', '17H', '17J', '17K',
            '18A', '18B', '18C', '18D', '18F', '18G', '18H', '18J', '18K',
            '19A', '19B', '19C', '19D', '19F', '19G', '19H', '19J', '19K',
            '20A', '20B', '20C', '20D', '20F', '20G', '20H', '20J', '20K',
            '21A', '21B', '21C', '21D', '21F', '21G', '21H', '21J', '21K',
            '22A', '22B', '22C', '22D', '22F', '22G', '22H', '22J', '22K',
            '23A', '23B', '23C', '23D', '23F', '23G', '23H', '23J', '23K',
            '24A', '24B', '24C', '24D', '24F', '24G', '24H', '24J', '24K',
            '25A', '25B', '25C', '25D', '25F', '25G', '25H', '25J', '25K',
            '26A', '26B', '26C', '26D', '26F', '26G', '26H', '26J', '26K',
            '27A', '27B', '27C', '27D', '27F', '27G', '27H', '27J', '27K',
            '28A', '28B', '28C', '28D', '28F', '28G', '28H', '28J', '28K',
            '29A', '29B', '29C', '29D', '29F', '29G', '29H', '29J', '29K',
            '30A', '30B', '30C', '30D', '30F', '30G', '30H', '30J', '30K',
            '31A', '31B', '31C', '31D', '31F', '31G', '31H', '31J', '31K',
            '32A', '32B', '32C', '32D', '32F', '32G', '32H', '32J', '32K',
            '33D', '33F', '33G',
            '36A', '36B', '36C', '36D', '36F', '36G', '36H', '36J', '36K',
            '37A', '37B', '37C', '37D', '37F', '37G', '37H', '37J', '37K',
            '38A', '38B', '38C', '38D', '38F', '38G', '38H', '38J', '38K',
            '39A', '39B', '39C', '39D', '39F', '39G', '39H', '39J', '39K',
            '40A', '40B', '40C', '40D', '40F', '40G', '40H', '40J', '40K',
            '41A', '41B', '41C', '41D', '41F', '41G', '41H', '41J', '41K',
            '42A', '42B', '42C', '42D', '42F', '42G', '42H', '42J', '42K',
            '43A', '43B', '43C', '43D', '43F', '43G', '43H', '43J', '43K',
            '44A', '44B', '44C', '44D', '44F', '44G', '44H', '44J', '44K',
            '45A', '45B', '45D', '45F', '45G', '45J', '45K',
            '46A', '46B', '46D', '46F', '46G', '46J', '46K',
            '47A', '47B', '47D', '47F', '47G', '47J', '47K',
            '48A', '48B', '48D', '48F', '48G', '48J', '48K',
            '49A', '49B', '49D', '49F', '49G', '49J', '49K',
            '50A', '50B', '50D', '50F', '50G', '50J', '50K',
            ]

        var r_array = shuffle(array);
        function load_seat(array){

            $.post( "{{url('api/pesawat/availabel-seat/')}}", {
                '_token': '{{csrf_token()}}',
                'array' : array,
                'kode_pesawat' : '{{$kode_pesawat}}'
            })
            .done(function(data){
                $.each(data, function( index, value ) {
                    if (value == 'true') {
                        $('#'+index).addClass('off');
                        $('#'+index).removeAttr('onclick');
                    } else {
                        $('#'+index).addClass('on');
                    }
                });
                // console.log(data);
            });
        }
        load_seat(r_array);

        function replacement(text) {
            $("input[name='nomor_peserta']").val(text.replace("UMHPS", ''));
        }
    </script>
@endsection