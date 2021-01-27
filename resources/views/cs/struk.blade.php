
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Struk - {{$order->kode_transaksi}}</title>

	 <link rel="stylesheet" href="{{asset('dinart/dist/css/adminlte.min.css')}}"> 
	 <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('dinart/plugins/fontawesome-free/css/all.min.css')}}"> 


	 <style>
	 	.logo-brand{
	 		font-size: 36px;
	 		font-weight: bold;
	 		color: #017932;
	 	}

	 	.profile{
	 		font-size: 14px;
	 		letter-spacing: 1px;
	 	}

	 	.invoicee{
	 		font-size: 20px;
	 		font-weight: bold;
	 		color: #017932;
	 	}

	 	.titlee{
	 		font-size: 18px;
	 		font-weight: bold;
	 		color: #017932;
	 	}

	 	.titleee{
	 		font-size: 16px;
	 		font-weight: bold;
	 		
	 	}

	 	.line{
	 		line-height: 1.4;
	 		text-transform: capitalize;
	 		font-size: 14px;
	 	}

	 	.linee{
	 		line-height: 1.2;
	 		text-transform: capitalize;
	 		font-size: 12px;
	 	}

	 	.noborder th{
	 		border: none !important;
	 		padding-top: 0px !important;
	 	}
	 </style>



</head>
<body>
	
<div class="container">
	
	<div class="row mt-4 mb-2">
		<div class="col-md-6 ">
			<b class="logo-brand " >DINART PRINTING</b><br>
			<div class="profile text-muted mt-2">
				<span class="fas fa-map-marker-alt mr-2  line"> </span> Jl. Raya Sugio-Kembangbahu, Kembangbahu Lamongan (62282) <br>
				<span class="fas fa-phone mr-2 line"> </span> 085708110056<br>
				<span class="fas fa-envelope mr-2 line"> </span> dinartprinting@gmail.com
			</div> 
			
		</div>
		<div class="col-md-6 ">
			<img src=" {{asset('dinart/dinart.png')}}" style="max-width: 100px; height: auto;" alt="AdminLTE Logo" class="float-right  mb-0">
		</div>
	</div>	
	
<br>

	<div class="row " style="font-size: 18px !important ;">
		<div class="col-md-4 font-weight-normal">
			<div>
				<span class="titlee">CUSTOMER SERVICE</span>
				
				<hr class=" mt-0 pt-0 mb-2 mr-4">
				<span class="line text-muted"> {{$order->nama_cs}} </span><br>
				<span class="line text-muted"> {{$order->telepon_cs}} </span><br>
				<span class="line text-muted"> Box {{$kode_box}} </span>
			</div>
		</div>
		{{-- <div class="col-md-1"></div> --}}
		<div class="col-md-4">
			<div>
				<span class="titlee">CUSTOMER </span>
				
				<hr class=" mt-0 pt-0 mb-2 mr-4">
				<span class="line text-muted"> {{$pelanggan->nama}} </span><br>
				<span class="line text-muted"> {{$pelanggan->telepon}} </span><br>
				<span class="line text-muted"> {{$pelanggan->alamat}} </span>
			</div>
		</div>
		{{-- <div class="col-md-1"></div> --}}
		<div class="col-md-4  pl-4 pb-3">
			<div class="float-right" >
					<span class="text-muted ml-3" style="font-size: 20px;">INVOICE : </span>  
					<span class="invoicee " > {{$order->kode_transaksi}} </span>
				</div><br>
			<div class="text-right mt-2">

				<span class="line font-weight-bold ml-2"> Transaksi :  </span><span class=" text-muted line" >{{\Carbon\Carbon::parse ($order->created_at)->format('l, d-m-Y / H:i')}}</span><br>

				<span class="line font-weight-bold ml-2"> Pengambilan :  </span><span class=" text-muted line">{{\Carbon\Carbon::parse ($order->tanggal_pengambilan)->format('l, d-m-Y')}} / {{\Carbon\Carbon::parse ($order->waktu_pengambilan)->format('H:i')}}</span>

			</div>
		</div>
	</div>

<br>
	
        <table class="table  mt-1  mb-0 "  style="font-size: 14px;">
        <thead class="" style="">
          <tr>
            <th>No</th>
            <th>Nama Item</th>
            <th>Ukuran (PxL)</th>
            <th>Qty</th>
            <th>Harga Item</th>
            <th>Diskon</th>
            <th>Sub Total</th>
           
            
          </tr>
        </thead>
        <tbody>
          <?php $no = 0;?>
          @foreach ($items as $oi)
           <?php $no++ ;?>
            <tr>
              <td>{{$no}}</td>
              <td>{{$oi->nama_barang}} </td>
              <td>
              	@if ($oi->panjang==0 && $oi->lebar==0)
              		-
              	@else
              		{{$oi->panjang}} x {{$oi->lebar}}
              	@endif
              	
              </td>
              <td>{{$oi->qty}} </td>
             	 
              <td>Rp. {{$oi->harga_barang}} </td>
              <td>
                @if ($oi->diskon_barang==null)
                0
                @else
                  {{$oi->diskon_barang}} 
                @endif
                 %
             </td>
             	@php
                    $item_rupiah = number_format($oi->harga_item,2,',','.');
                  @endphp
              <td>Rp. {{$item_rupiah}} </td>
              
            </tr>
          @endforeach

        </tbody>
        
          <tfoot class="">
          <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th>Grand Total <span class="float-right" >:</span></th>
            <th></th>
            	@php
                    $harga_total_rupiah = number_format($order->harga_total,2,',','.');
                  @endphp
            <th>Rp. {{$harga_total_rupiah}}</th>
            
          </tr>
          <tr class="noborder pt-3" style=" ">
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th>Uang Muka <span class="float-right" >:</span></th>
            <th></th>
            	@php
                    $dp_rupiah = number_format($order->dp,2,',','.');
                  @endphp
            <th>Rp. {{$dp_rupiah}}</th>
            
          </tr>

         
          <tr class="noborder" style=" ">
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th>Bayar <span class="float-right" >:</span></th>
            <th></th>
            	@php
                    $bayar_rupiah = number_format($order->bayar,2,',','.');
                  @endphp
            <th>Rp. {{$bayar_rupiah}}</th>
            
          </tr>
          <tr class="noborder" style=" ">
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th>Kembali <span class="float-right" >:</span></th>
            <th></th>
            	@php
                    $kembalian_rupiah = number_format($order->kembalian,2,',','.');
                  @endphp
            <th>Rp. {{$kembalian_rupiah}}</th>
           
          </tr>
        </tfoot>
      </table>


<div class="footerr mt-4">
	<span class="titleee text-muted">TERMS & CONDITIONS </span><br>
				
	{{-- <hr class=" mt-0 pt-0 mb-2 mr-4"> --}}
	<li class="linee text-muted"> Jika ada Item yang tidak sesuai dengan pesanan, segera hubungi customer service di hari yang sama.  </li>
	
	<li class="linee text-muted"> Order yang sudah di DP tidak dapat dibatalkan. </li><br>
	
	<span class="linee text-muted">  </span><br>
</div>


</div>

<script src="{{asset('dinart/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('dinart/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- AdminLTE App -->
<script src="{{asset('dinart/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dinart/dist/js/demo.js')}}"></script>




<script>
	
 $( document ).ready(function() { 
    window.print()
});


</script>


</body>
</html>

