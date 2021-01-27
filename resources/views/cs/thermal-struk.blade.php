<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="style.css">
       <title>Struk - {{$order->kode_transaksi}}</title>

        <style>
            * {
    font-size: 12px;
    font-family: 'Times New Roman';
}

td,
th,
tr,
table {
    border-top: 1px solid black;
    border-collapse: collapse;
    font-size: 11px;
}

td.description,
th.description {
    width: 155px;
    max-width: 155px;
    padding-top: 5px !important;
            padding-bottom: 5px !important;
}

td.quantity,
th.quantity {
    width: 30px;
    max-width: 30px;
    word-break: break-all;
}

th.quantityy {
    width: 40px;
    max-width: 40px;
    text-align: left;
   
}

td.quantity{
    width: 40px;
    max-width: 40px;
    padding-top: 5px !important;
            padding-bottom: 5px !important;
    
   
}

td.price,
th.price {
    width: 50px;
    max-width: 50px;
    /*word-break: break-all;*/
    padding-top: 5px !important;
            padding-bottom: 5px !important;
}

.centered {
    text-align: center;
    align-content: center;
}

.tot{
    text-align: right;
}

.ticket {
    width: 235px;
    max-width: 235px;
    margin-top: 20px;
    /*padding-top: 20px;*/
}

img {
    max-width: 80px;
    width: 80px;
}

@media print {
    .hidden-print,
    .hidden-print * {
        display: none !important;
    }
}


    .noborder th{
            border-top: none !important;
            padding-top: 5px !important;
            padding-bottom: 5px !important;
        }
</style>
    </head>
    <body>
        <div class="ticket">
            <div style="text-align: center; margin-bottom: 14px;">
                <img src="{{ asset('dinartbw.png') }}" alt="Logo">
            </div>
            
            <p class="centered" style="font-size: 10px;"> <span style="font-size: 16px; font-weight: bold;">DINART PRINTING</span>
                <br> Jl. Raya Sugio-Kembangbahu, Kembangbahu Lamongan
                <br>085708110056</p>
                <hr style="border-top: 1px dashed #8c8b8b;">
                <div style="margin-top: 14px;">
                    
                    <span style="">Invoice: <span style="font-weight: bold; font-size: 11px; ">{{$order->kode_transaksi}}</span></span>
                    <br>
                   
                    <span>Customer:  <span  style="font-size: 11px; font-weight: bold;">{{$pelanggan->nama}} </span> </span> <br>
                    <span>CS:  <span  style="font-size: 11px; font-weight: bold;">{{$order->nama_cs}} </span> </span> 
                </div>
                
           <br>
            <table>
                <thead>
                    <tr>
                        <th class="quantity">Qty</th>
                        <th class="description">Product</th>
                        <th class="price">Sub Total</th>
                    </tr>
                </thead>
                <tbody>

                    
                @foreach ($items as $oi)
                    <tr>
                        <td class="quantity" style="text-align: center;">{{$oi->qty}}</td>
                        <td class="description">{{$oi->nama_barang}}</td>
                            @php
                             $item_rupiah = number_format($oi->harga_item,2,',','.');
                            @endphp
                        <td class="price" style="text-align: right;">{{$item_rupiah}}</td>
                    </tr>
                @endforeach

                    <tr class="noborder">
                        <th class="quantityy">Total:</th>
                        <th style="text-align: right;" >Rp.</th>
                            @php
                                $harga_total_rupiah = number_format($order->harga_total,2,',','.');
                              @endphp
                        <th class="tot">{{$harga_total_rupiah}}</th>
                      </tr>
                     <tr class="noborder pt-3" style=" ">
                        <th class="quantityy">DP:</th>
                        <th style="text-align: right;" >Rp.</th>
                            @php
                                $dp_rupiah = number_format($order->dp,2,',','.');
                              @endphp
                        <th class="tot" > {{$dp_rupiah}}</th>
                       
                      </tr>
                      <tr class="noborder" style=" ">
                       
                        <th class="quantityy">Bayar:</th>
                        <th style="text-align: right;" >Rp.</th>
                            @php
                                $bayar_rupiah = number_format($order->bayar,2,',','.');
                              @endphp
                        <th class="tot">{{$bayar_rupiah}}</th>
                       
                      </tr>
                      <tr class="noborder" style=" ">
                        
                        
                        <th class="quantityy">Kembali:</th>
                        <th style="text-align: right;" >Rp.</th>
                            @php
                                $kembalian_rupiah = number_format($order->kembalian,2,',','.');
                              @endphp
                        <th class="tot"> {{$kembalian_rupiah}}</th>
                       
                      </tr>
                </tbody>       
            </table>
            <br>
            <div>
                <span style="font-size: 10px; margin-bottom: 16px;">Waktu Transaksi: <span style="float: right; font-size: 10px"> {{\Carbon\Carbon::parse ($order->tanggal_terima)->format('d-m-Y / H:i')}}</span> </span><br>

                 <span style="font-size: 10px ">Waktu Pengambilan: <span style="float: right; font-size: 10px"> {{\Carbon\Carbon::parse ($order->tanggal_pengambilan)->format('d-m-Y')}} / {{\Carbon\Carbon::parse ($order->waktu_pengambilan)->format('H:i')}}</span> </span>
            </div>
            <br><br><hr style="border-top: 1px dashed #8c8b8b;">
            <p class="centered" style="font-size: 10px;">Thanks for your transaction & have a nice day :)
                <br>dinartprinting@gmail.com</p>
            
        </div>

    </body>


<script src="{{asset('dinart/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('dinart/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- AdminLTE App -->
<script src="{{asset('dinart/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dinart/dist/js/demo.js')}}"></script>



</html>


<script>
    
 $( document ).ready(function() {
    window.print()
});


</script>


















{{-- https://parzibyte.me/blog/en/2019/10/10/print-receipt-thermal-printer-javascript-css-html/ --}}