@extends('layout.woodo')

@section('content2')
    <div class="testi_monial_section layout_padding" style="margin-bottom: 60px;">
        <div class="container">
        <div id="my_carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
            <div class="carousel-item active">
                <h1 class="testi_monila_text">Tata Cara Pemesanan</h1>
                <div class="testimonila_inner">
                <div class="testing_img"><img src="{{asset('woodo/images/lapangan.jpg')}}"></div>
                <p class="dolor_text">Cara Pemesanan : </p>
                <h2 class="dolor_text"> 1. Jika belom memiliki akun untuk login, silahkan melakukan pendaftaran.</h2>
                <h2 class="dolor_text"> 2. Setelah login, pilih bagian booking dan pesan lapangan yang sudah tersedia.</h2>
                <h2 class="dolor_text"> 3. Lalu, isi form waktu, tanggal main, jam main, dan lama bermain. Setelah mengisi form tersebut, klik pesan.</h2>
                <h2 class="dolor_text"> 4.  Setelah form pemesanan sudah terisi, maka user akan melihat pesanan yang sudah dilakukan. Jika kalian ingin melanjutkan pemesanan, klik bayar pada list booking kalian, sedangkan jika kalian ingin membatalkan pemesanan, klik batal.</h2>
                <h2 class="dolor_text"> 5. Apabila kalian melanjutkan pemesanan, kalian akan melihat form total biaya lapangan dan nomor rekening tujuannya. Jika kalian sudah melakukan pembayaran, silahkan kirim bukti pembayaran.</h2>
                <h2 class="dolor_text"> 6. Jika kalian sudah mengirim bukti pembayaran, status pembayaran kalian menjadi pending menunggu konfirmasi dari admin. Dan jika admin sudah menerima pembayaran kalian, status pembayaran kalian menjadi sudah terbayar.</h2>
            </div>
            </div>

            </div>
        </div>
        </div>
    </div>
@endsection