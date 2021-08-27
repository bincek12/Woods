@extends('layout.woodo')

@section('content2')
    <div class="our_furniture_section layout_padding">
        <div class="container">
        <h1 class="about_taital">Booking</h1>
        <p class="market_text">Booking Lapangan BuluTangkis</p>
        </div>
    </div>

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
    <div class="container" style="margin-bottom: 60px;">
        <div class="row">
  
          @foreach ($lapangan as $row)
              <div class="col-xs-12 col-sm-4">
  
                  <div class="card" style="box-shadow: rgba(0, 0, 0, 0.25) 0px 14px 28px, rgba(0, 0, 0, 0.22) 0px 10px 10px;">
                      <img src="{{ asset($row->foto1) }}" style="height: 200px; width: 100%;" class="card-img-top" alt="...">
                      <div class="card-body" style="padding: 10px">
                          <ul class="list-group list-group-flush">
                              <li class="list-group-item" style="font-family: Arial, Helvetica, sans-serif">
                                  <table>
                                      <tr>
                                          <td style="font-weight: 700;">ID Lapangan</td>
                                          <td style="padding: 2px 10px;">:</td>
                                          <td>{{ $row->lapangan_id }}</td>
                                      </tr>
                                      <tr>
                                          <td style="font-weight: 700;">Nama</td>
                                          <td style="padding: 2px 10px;">:</td>
                                          <td>{{ $row->nama }}</td>
                                      </tr>
                                      <tr>
                                          <td style="font-weight: 700;">Keterangan</td>
                                          <td style="padding: 2px 10px;">:</td>
                                          <td>{{ $row->keterangan }}</td>
                                      </tr>
                                      <tr>
                                          <td style="font-weight: 700;">Harga Siang / Jam</td>
                                          <td style="padding: 2px 10px;">:</td>
                                          <td>Rp. {{ number_format($row->harga_siang) }}</td>
                                      </tr>
                                      <tr>
                                          <td style="font-weight: 700;">Harga Malam / Jam</td>
                                          <td style="padding: 2px 10px;">:</td>
                                          <td>Rp. {{ number_format($row->harga_malam) }}</td>
                                      </tr>
                                  </table>
                              </li>
                          </ul>
                        <a data-toggle="modal" href="#pesanModal" id="pesan" data-lapangan_id="{{ $row->lapangan_id }}" data-nama="{{ $row->nama }}" data-harga_siang="{{ $row->harga_siang }}" data-harga_malam="{{ $row->harga_malam }}" class="btn btn-dark btn-block">Pesan</a>
                      </div>
                  </div>
              </div>
          @endforeach
  
      </div>
      </div>

      {{-- Pesan --}}
    <div class="modal fade" id="pesanModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
    
                    <div class="register" style="width: auto !important; margin: 0 !important;">
                        <form action="{{ route('booking.store') }}" method="POST" id="booking-form">
                            @csrf
                            <input type="text" class="input @error('lapangan_id') is-invalid @enderror" name="lapangan_id" id="lapangan_id" hidden>
                            
                            <div class="mb-1">
                                <label for="jenis" style="font-size: 1em">Waktu</label>
                                <select name="jenis" id="jenis" class="form-control">
                                    @if ( old('jenis') == 'Siang' )
                                        <option value="">-- Waktu --</option>
                                        <option value="Siang" selected>Siang</option>
                                        <option value="Malam">Malam</option>
                                    @elseif ( old('jenis') == 'Malam' )
                                        <option value="">-- Waktu --</option>
                                        <option value="Siang">Siang</option>
                                        <option value="Malam" selected>Malam</option>
                                    @else
                                        <option value="" selected disabled>-- Waktu --</option>
                                        <option value="Siang">Siang</option>
                                        <option value="Malam">Malam</option>
                                    @endif
                                </select>
                            </div>
    
                            <div class="mb-1">
                                <label for="harga" style="font-size: 1em">Harga</label>
                                <input type="text" class="form-control @error('harga') is-invalid @enderror" value="{{ old('harga') }}" name="harga" id="harga" readonly>
                                @error('harga')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
    
                            <div class="mb-1">
                                <label for="tanggal_pesan" style="font-size: 1em">Tanggal Main</label>
                                <input type="date" class="form-control @error('tanggal_pesan') is-invalid @enderror" value="{{ old('tanggal_pesan') }}" name="tanggal_pesan">
                                @error('tanggal_pesan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
    
                            <div class="mb-1">
                                <label for="jam_mulai" style="font-size: 1em">Jam Main</label>
                                <input type="time" class="form-control @error('jam_mulai') is-invalid @enderror" value="{{ old('jam_mulai') }}" name="jam_mulai" id="jam_mulai">
                                @error('jam_mulai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
    
                            <div class="mb-1">
                                <label for="lama_bermain" style="font-size: 1em">Lama Bermain / Jam</label>
                                <input type="number" min="1" max="10" class="form-control @error('lama_bermain') is-invalid @enderror" value="{{ old('lama_bermain') }}" id="lama_bermain" name="lama_bermain">
                                @error('lama_bermain')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
    
                            <div class="mb-1">
                                <label for="total_harga" style="font-size: 1em">Total Harga</label>
                                <input type="text" readonly class="form-control @error('total_harga') is-invalid @enderror" value="{{ old('total_harga') }}" id="total_harga" name="total_harga">
                                @error('total_harga')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </form>
                    </div>
    
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-dark" href="{{ route('booking.store') }}" onclick="event.preventDefault(); document.getElementById('booking-form').submit();">Pesan</a>
                </div>
            </div>
        </div>
        </div>
@endsection

@section('js')
	
	<script>

		$(document).on('click', '#pesan', function () {
			var lapangan_id = $(this).data('lapangan_id')
			var nama = $(this).data('nama')
			var harga_siang = $(this).data('harga_siang')
			var harga_malam = $(this).data('harga_malam')

			$('#exampleModalLabel').text('Pesan ' + nama)
			$('#lapangan_id').val(lapangan_id)
            
			$(function () {
				$('#jenis').change(function () {
					var displayHarga = $('#jenis option:selected').val();
					if (displayHarga == 'Siang') {
						var harga = harga_siang

						var number_string 	= harga.toString(),
						sisa  				= number_string.length % 3,
						rupiah				= number_string.substr(0, sisa),
						ribuan				= number_string.substr(sisa).match(/\d{3}/gi)

						if (ribuan) {
							separator = sisa ? '.' : ''
							rupiah += separator + ribuan.join('.')
						}
						$('#harga').val("Rp. " + rupiah)

						$('#lama_bermain').click(function () {
							var total = 0
							var x = harga_siang
							var y = Number($('#lama_bermain').val())
							var total = x * y

							var harga = total

							var number_string 	= harga.toString(),
							sisa  				= number_string.length % 3,
							rupiah				= number_string.substr(0, sisa),
							ribuan				= number_string.substr(sisa).match(/\d{3}/gi)

							if (ribuan) {
								separator = sisa ? '.' : ''
								rupiah += separator + ribuan.join('.')
							}

							$('#total_harga').val("Rp. " + rupiah)
						})
						
						$('#lama_bermain').keyup(function () {
							var total = 0
							var x = harga_siang
							var y = Number($('#lama_bermain').val())
							var total = x * y

							var harga = total

							var number_string 	= harga.toString(),
							sisa  				= number_string.length % 3,
							rupiah				= number_string.substr(0, sisa),
							ribuan				= number_string.substr(sisa).match(/\d{3}/gi)

							if (ribuan) {
								separator = sisa ? '.' : ''
								rupiah += separator + ribuan.join('.')
							}

							$('#total_harga').val("Rp. " + rupiah)
						})
						
					} else if (displayHarga == 'Malam') {
						var harga = harga_malam
						
						var number_string 	= harga.toString(),
						sisa  				= number_string.length % 3,
						rupiah				= number_string.substr(0, sisa),
						ribuan				= number_string.substr(sisa).match(/\d{3}/gi)
						
						if (ribuan) {
							separator = sisa ? '.' : ''
							rupiah += separator + ribuan.join('.')
						}
						$('#harga').val("Rp. " + rupiah)

						$('#lama_bermain').click(function () {
							var total = 0
							var x = harga_malam
							var y = Number($('#lama_bermain').val())
							var total = x * y

							var harga = total

							var number_string 	= harga.toString(),
							sisa  				= number_string.length % 3,
							rupiah				= number_string.substr(0, sisa),
							ribuan				= number_string.substr(sisa).match(/\d{3}/gi)

							if (ribuan) {
								separator = sisa ? '.' : ''
								rupiah += separator + ribuan.join('.')
							}

							$('#total_harga').val("Rp. " + rupiah)
						})
						
						$('#lama_bermain').keyup(function () {
							var total = 0
							var x = harga_malam
							var y = Number($('#lama_bermain').val())
							var total = x * y

							var harga = total

							var number_string 	= harga.toString(),
							sisa  				= number_string.length % 3,
							rupiah				= number_string.substr(0, sisa),
							ribuan				= number_string.substr(sisa).match(/\d{3}/gi)

							if (ribuan) {
								separator = sisa ? '.' : ''
								rupiah += separator + ribuan.join('.')
							}

							$('#total_harga').val("Rp. " + rupiah)
						})
					}
				})
			})
		})
	</script>

@endsection