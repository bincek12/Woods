@extends('layout.woodo')

@section('content2')
    <div class="layout_padding about_section " style="margin-bottom: 60px;">
        <div class="container">
        <h1 class="about_taital">Dashboard</h1>
    </div>

    <div class="container">
        <div class="mb-3">
            <h3 class="text-dark">Jadwal Booking</h3>
            @if (session('message_success'))
                <ol class="breadcrumb" style="background-color: green; color: #fff;">
                    <li class="">{{ session('message_success') }}</li>
                </ol>
            @endif
            
            @if (session('message_fail'))
                <ol class="breadcrumb" style="background-color: #ff5d56; color: #fff;">
                    <li class="">{{ session('message_fail') }}</li>
                </ol>
            @endif

            @foreach ($errors->all() as $error)
                <ol class="breadcrumb" style="background-color: #ff5d56; color: #fff;">
                    <li class="">{{ $error }}</li>
                </ol>
            @endforeach

            <div class="bs-docs-example">
                <table class="table table-striped" style="box-shadow: rgba(0, 0, 0, 0.25) 0px 14px 28px, rgba(0, 0, 0, 0.22) 0px 10px 10px;">
                    <thead>
                        <tr>
                            <th>ID Booking</th>
                            <th>ID Lapangan</th>
                            <th>Jam Pesan</th>
                            <th>Tanggal Main</th>
                            <th>Lama Main</th>
                            <th>Jam Mulai</th>
                            <th>Jam Selesai</th>
                            <th>Harga / Jam</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($booking_data[0] == Null)
                            <tr>
                                <td colspan="11" style="text-align:center">Kosong.</td>
                            </tr>
                        @else    
                            @foreach ($booking_data as $row)	
                                <tr>
                                    <td>{{ $row->booking_id }}</td>
                                    <td>{{ $row->lapangan_id }}</td>
                                    <td>{{ date('d-m-Y', strtotime($row->created_at)) }}</td>
                                    <td>{{ date('d-m-Y', strtotime($row->tanggal)) }}</td>
                                    <td>{{ $row->lama_mulai }}</td>
                                    <td>{{ date('H:i A', strtotime($row->jam_mulai)) }}</td>
                                    <td>{{ date('H:i A', strtotime($row->jam_habis)) }}</td>
                                    <td>Rp. {{ number_format($row->harga_lapangan) }}</td>
                                    <td>Rp. {{ number_format($row->total) }}</td>
                                    <td>{{ $row->status }}</td>
                                    <td>
                                        @if ( $row->status == 'Belum Bayar' )
                                            <a data-toggle="modal" href="#bayarModal" id="bayar-btn" class="btn btn-dark" data-booking_id="{{ $row->booking_id }}" data-tanggal="{{ date('d M Y', strtotime($row->tanggal)) }}" data-lama_main="{{ $row->lama_mulai }}" data-jam_mulai="{{ date('H:i A', strtotime($row->jam_mulai)) }}" data-jam_habis="{{ date('H:i A', strtotime($row->jam_habis)) }}" data-harga_total="Rp. {{ number_format($row->total) }}"><span class="label label-default">Bayar</span></a>
                                            <a href="javascript:void(0);" class="batal-btn btn btn-warning" data-id="{{ $loop->iteration }}"><span class="label label-primary">Batal</span></a>
                                            <form action="{{ route('booking.delete', [$row->booking_id]) }}" method="POST" id="batal{{ $loop->iteration }}">
                                                @csrf
                                                @method('PATCH')
                                            </form>
                                        @elseif ($row->status == 'Pending')
                                            @php
                                                $bukti_tf = collect(DB::select("select * from user__bayars where booking_id = '" . $row->booking_id . "'"))->first();
                                            @endphp
                                            <a href="{{ asset($bukti_tf->bukti_tf) }}" class="btn btn-secondary" target="__blank"><span class="label label-primary">Lihat</span></a>
                                        @elseif ($row->status == 'Sudah Bayar')
                                            <a data-toggle="modal" href="#cetakModal" id="cetak-btn" class="btn btn-info" data-booking_id="{{ $row->booking_id }}" data-lapangan_id="{{ $row->lapangan_id }}" data-tanggal_pesan="{{ date('d M Y', strtotime($row->created_at)) }}" data-tanggal_main="{{ date('d M Y', strtotime($row->tanggal)) }}" data-lama_main="{{ $row->lama_mulai }}" data-jam_mulai="{{ date('H:i A', strtotime($row->jam_mulai)) }}" data-jam_habis="{{ date('H:i A', strtotime($row->jam_habis)) }}" data-harga_lapangan="Rp. {{ number_format($row->harga_lapangan) }}" data-harga_total="Rp. {{ number_format($row->total) }}" data-status="{{ $row->status }}"><span class="label label-primary"><i class="fa fa-print"></i> Cetak</span></a>
                                        @elseif ($row->status == 'Error')
                                            <a data-toggle="modal" href="#bayarModal" id="bayar-btn" class="btn btn-dark" data-booking_id="{{ $row->booking_id }}" data-tanggal="{{ date('d M Y', strtotime($row->tanggal)) }}" data-lama_main="{{ $row->lama_mulai }}" data-jam_mulai="{{ date('H:i A', strtotime($row->jam_mulai)) }}" data-jam_habis="{{ date('H:i A', strtotime($row->jam_habis)) }}" data-harga_total="Rp. {{ number_format($row->total) }}"><span class="label label-default">Bayar</span></a>
                                            <a href="javascript:void(0);" class="batal-btn btn btn-warning" data-id="{{ $loop->iteration }}"><span class="label label-primary">Batal</span></a>
                                            <form action="{{ route('booking.delete', [$row->booking_id]) }}" method="POST" id="batal{{ $loop->iteration }}">
                                                @csrf
                                                @method('PATCH')
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <div>
            <h3 class="text-dark">Catatan Booking</h3>

            <div class="bs-docs-example">
                <table class="table table-striped" style="box-shadow: rgba(0, 0, 0, 0.25) 0px 14px 28px, rgba(0, 0, 0, 0.22) 0px 10px 10px;">
                    <thead>
                        <tr>
                            <th>ID Booking</th>
                            <th>ID Lapangan</th>
                            <th>Jam Pesan</th>
                            <th>Tanggal Main</th>
                            <th>Lama Main</th>
                            <th>Jam Mulai</th>
                            <th>Jam Selesai</th>
                            <th>Harga / Jam</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($history_booking_data[0] == Null)
                            <tr>
                                <td colspan="11" style="text-align:center">Kosong.</td>
                            </tr>
                        @else       
                            @foreach ($history_booking_data as $row)	
                                <tr>
                                    <td>{{ $row->booking_id }}</td>
                                    <td>{{ $row->lapangan_id }}</td>
                                    <td>{{ date('d-m-Y', strtotime($row->created_at)) }}</td>
                                    <td>{{ date('d-m-Y', strtotime($row->tanggal)) }}</td>
                                    <td>{{ $row->lama_mulai }}</td>
                                    <td>{{ date('H:i A', strtotime($row->jam_mulai)) }}</td>
                                    <td>{{ date('H:i A', strtotime($row->jam_habis)) }}</td>
                                    <td>Rp. {{ number_format($row->harga_lapangan) }}</td>
                                    <td>Rp. {{ number_format($row->total) }}</td>
                                    <td>{{ $row->status }}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
  </div>

	{{-- Pesan --}}
    <div class="modal fade" id="bayarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pesan Lapangan</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

				<ol class="breadcrumb" style="background-color: #ebc634; color: #fff;">
					<li class="">Perhatikan baik-baik Nama dan Nomer Rekening saat mentransfer!</li>
				</ol>

                <div class="modal-body">

					<div class="register" style="width: auto !important; margin: 0 !important;">
						<form action="{{ route('booking.payment') }}" enctype="multipart/form-data" method="POST" id="booking-form">
							@csrf
							@method('PATCH')
							<div class="mation">
								<input type="text" name="booking_id" id="booking_id" style="display: none !important;">
								<div class="mb-1">
									<span>Tanggal Main</span>
									<input type="text" class="form-control @error('tanggal_main') is-invalid @enderror" name="tanggal_main" id="tanggal_main" readonly>
									@error('tanggal_main')
										<div class="invalid-feedback">{{ $message }}</div>
									@enderror
								</div>
								<div class="mb-1">
									<span>Lama Main</span>
									<input type="text" class="form-control @error('lama_main') is-invalid @enderror" name="lama_main" id="lama_main" readonly>
									@error('lama_main')
										<div class="invalid-feedback">{{ $message }}</div>
									@enderror
								</div>
								<div class="mb-1">
									<span>Jam Main</span>
									<input type="text" class="form-control @error('jam_main') is-invalid @enderror" name="jam_main" id="jam_main" readonly>
									@error('jam_main')
										<div class="invalid-feedback">{{ $message }}</div>
									@enderror
								</div>
								<div class="mb-1">
									<span>Total Harga</span>
									<input type="text" class="form-control @error('total_harga') is-invalid @enderror" name="total_harga" id="total_harga" readonly>
									@error('total_harga')
										<div class="invalid-feedback">{{ $message }}</div>
									@enderror
								</div>
								@php
									$rekening_check = collect(DB::select('select * from rekenings'));
								@endphp
								<div class="mb-1">
									<span>Metode Pembayaran</span>
									@error('nama_rekening')
										<div class="invalid-feedback">{{ $message }}</div>
									@enderror
									<select style="font-family: Arial, Helvetica, sans-serif" class="form-control @error('nama_rekening') is-invalid @enderror" name="nama_rekening" id="nama_rekening">
										@foreach ($rekening_check as $row)
											<option value="{{ $row->nama_rekening }} - {{ $row->nomer_rekening }}">{{ $row->nama_rekening }} - {{ $row->nomer_rekening }}</option>
										@endforeach
									</select>
								</div>
								<div class="mb-1">
									<span>Bukti Pembayaran</span>
									<input type="file" class="form-control @error('bukti_pembayaran') is-invalid @enderror" name="bukti_pembayaran" id="bukti_pembayaran" style="border:none !important;" readonly>
									@error('bukti_pembayaran')
										<div class="invalid-feedback">{{ $message }}</div>
									@enderror
								</div>
							</div>
						</form>
					</div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{ route('booking.payment') }}" onclick="event.preventDefault(); document.getElementById('booking-form').submit();">Submit</a>
                </div>
            </div>
        </div>
    </div>

	{{-- Cetak --}}
    <div class="modal fade" id="cetakModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" style="width: 25% !important;" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cetak Bukti Pembayaran!</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body" id="cetakBody">
					<div class="register" id="content">
						<form action="{{ route('booking.payment') }}" enctype="multipart/form-data" method="POST" id="booking-form">
							@csrf
							@method('PATCH')
							<div class="mation">
								<table>
									<tr>
										<td style="font-weight: 600;">ID Booking</td>
										<td style="padding: 5px !important;">:</td>
										<td id="booking_id-cetak"></td>
									</tr>
									<tr>
										<td style="font-weight: 600;">ID Lapangan</td>
										<td style="padding: 5px !important;">:</td>
										<td id="lapangan_id-cetak"></td>
									</tr>
									<tr>
										<td style="font-weight: 600;">Tanggal Pesan</td>
										<td style="padding: 5px !important;">:</td>
										<td id="tanggal_pesan-cetak"></td>
									</tr>
									<tr>
										<td style="font-weight: 600;">Tanggal Main</td>
										<td style="padding: 5px !important;">:</td>
										<td id="tanggal_main-cetak"></td>
									</tr>
									<tr>
										<td style="font-weight: 600;">Lama Main</td>
										<td style="padding: 5px !important;">:</td>
										<td id="lama_main-cetak"></td>
									</tr>
									<tr>
										<td style="font-weight: 600;">Jam Main</td>
										<td style="padding: 5px !important;">:</td>
										<td id="jam_main-cetak"></td>
									</tr>
									<tr>
										<td style="font-weight: 600;">Harga / Jam</td>
										<td style="padding: 5px !important;">:</td>
										<td id="harga_lapangan-cetak"></td>
									</tr>
									<tr>
										<td style="font-weight: 600;">Total Harga</td>
										<td style="padding: 5px !important;">:</td>
										<td id="total_harga-cetak"></td>
									</tr>
									<tr>
										<td style="font-weight: 600;">Status</td>
										<td style="padding: 5px !important;">:</td>
										<td><span class="label label-success" id="status-cetak"></span></td>
									</tr>
								</table>
							</div>
						</form>
					</div>

                </div>
                <div class="modal-footer">
                    <a class="btn btn-dark text-light" id="cetak_btn">Cetak</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
	
	<script>

        document.getElementById("cetak_btn").addEventListener("click", function() {
            
            html2canvas(document.querySelector('#cetakBody')).then(function(canvas) {

                saveAs(canvas.toDataURL(), 'bukti-tf.png');
            });
        });


        function saveAs(uri, filename) {

            var link = document.createElement('a');

            if (typeof link.download === 'string') {

                link.href = uri;
                link.download = filename;

                //Firefox requires the link to be in the body
                document.body.appendChild(link);

                //simulate click
                link.click();

                //remove the link when done
                document.body.removeChild(link);

            } else {

                window.open(uri);

            }
        }

		$(document).on('click', '#bayar-btn', function () {
			var booking_id = $(this).data('booking_id')
			var tanggal = $(this).data('tanggal')
			var lama_main = $(this).data('lama_main')
			var jam_mulai = $(this).data('jam_mulai')
			var jam_habis = $(this).data('jam_habis')
			var harga_total = $(this).data('harga_total')

			$('#booking_id').val(booking_id)
			$('#tanggal_main').val(tanggal)
			$('#lama_main').val(lama_main)
			$('#jam_main').val(jam_mulai + "-" + jam_habis)
			$('#total_harga').val(harga_total)
		})

		$(document).on('click', '#cetak-btn', function () {
			var booking_id = $(this).data('booking_id')
			var lapangan_id = $(this).data('lapangan_id')
			var tanggal_pesan = $(this).data('tanggal_pesan')
			var tanggal_main = $(this).data('tanggal_main')
			var lama_main = $(this).data('lama_main')
			var jam_mulai = $(this).data('jam_mulai')
			var jam_habis = $(this).data('jam_habis')
			var harga_lapangan = $(this).data('harga_lapangan')
			var harga_total = $(this).data('harga_total')
			var status = $(this).data('status')

			$('#booking_id-cetak').text(booking_id)
			$('#lapangan_id-cetak').text(lapangan_id)
			$('#tanggal_pesan-cetak').text(tanggal_pesan)
			$('#tanggal_main-cetak').text(tanggal_main)
			$('#lama_main-cetak').text(lama_main)
			$('#jam_main-cetak').text(jam_mulai + "-" + jam_habis)
			$('#harga_lapangan-cetak').text(harga_lapangan)
			$('#total_harga-cetak').text(harga_total)
			$('#status-cetak').text(status)
		})

		$(".batal-btn").click(function () {
            var id = $(this).data('id')

            swal({
                title: "Yakin mau batalin?",
                text: "jika anda membatalkan pesanan, maka anda harus pesan ulang lagi!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    swal("berhasil! Kamu berhasil membatalkan pesanan!", {
                        icon: "success",
                    });
                    $("#batal" + id).submit();
                }
            });
        })
	</script>

@endsection