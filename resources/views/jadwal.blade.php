@extends('layout.woodo')

@section('content2')
    <div class="layout_padding about_section " style="margin-bottom: 60px;">
        <div class="container">
        <h1 class="about_taital">Jadwal</h1>
    </div>

    <div class="container">
        @foreach ($lapangan as $lapangan)
            <div class="mb-3">
                <h3 class="text-dark">Jadwal {{ $lapangan->nama }}</h3>
                <table class="table table-hover" style="box-shadow: rgba(0, 0, 0, 0.25) 0px 14px 28px, rgba(0, 0, 0, 0.22) 0px 10px 10px;">
                    <thead class="bg-dark text-light">
                        <tr>
                            <th>Tanggal Main</th>
                            <th>Lama Main</th>
                            <th>Jam Main</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $check = collect(DB::select("select * from user__bookings where lapangan_id = '". $lapangan->lapangan_id . "'"))->first();
                        @endphp
                        @if ($check == Null)
                            <tr>
                                <td colspan="11" style="text-align:center">Kosong.</td>
                            </tr>
                        @else
                            @foreach ($jadwal as $row)
                                @if ( $row->lapangan_id == $lapangan->lapangan_id )
                                    <tr>
                                        <td>{{ $row->tanggal }}</td> 
                                        <td>{{ $row->lama_mulai }}</td>  
                                        <td>{{ $row->jam_mulai . '-' . $row->jam_habis }}</td>  
                                    </tr>
                                @endif	
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        @endforeach
    </div>
  </div>
@endsection