@extends('admin.admin-master')

@section('title','DinArt - Pembayaran')
@section('page-title','Transaksi / Pembayaran')

@section('css')

<style>
  
  .detail-lable{
    font-size: 11px;
    font-weight: lighter;
  }
  .create-detail b{
    font-size: 10px !important;
    font-style: italic;
     font-weight: lighter !important;

  }
  .create-detail span{
    font-size: 13px;
    font-style: normal;
    font-weight: bold;
    line-height: normal !important;
  }

   textarea { font-size: 15px !important; }
    input{ font-size: 14px !important; }
    select { font-size: 14px !important; }
    label{ font-size: 14px !important; }

  .input-group-text{
    font-size: 14px;
  }

 .card-title{
    font-size: 18px;
  }
.border{
  border-width:3px !important;
}

</style>


@endsection

@section ("content") 
<div class="mr-2 ml-2">
    <div class="card border border-bottom-0 border-left-0 border-right-0  border-success">
      <div class="card-header text-success">
        <div class="row">
          <div class="col-md-6"><h3 class="card-title font-weight-bold"><a class="fas fa-arrow-left text-success mr-3" href="{{ route('admin-transaksi') }}">  </a>Invoice Transaksi</h3></div>
          <div class="col-md-6"><span class="text-success font-weight-bold float-right" > {{$order->kode_transaksi}} </span></div>
        </div>
        
      </div>
        <div class="card-body  mt-0 pt-1">

          <div class="row">
            <div class="col-md-4 create-detail "> 
              <b> Customer Service :<span> {{$order->nama_cs}} </span>  </b> <br>
              <b> Kode Box:  <span> {{$kode_box}} </span>   </b>
            </div>   

            <div class="col-md-4 create-detail text-center">
              <b> Customer :  <span>{{$pelanggan->nama}}  </span></b><br>
              {{-- <b>Alamat Customer:  <span>{{$pelanggan->alamat}}  </span></b><br> --}}
              <b>No. Telepon Customer: <span>{{$pelanggan->telepon}}  </span></b> 
            </div>

            <div class="col-md-4 create-detail ">
              <b class="float-right"> Waktu_Transaksi : <span> {{\Carbon\Carbon::parse ($order->created_at)->format('d-m-Y / H:i')}}</span> </b><br>
              <b class="float-right">Waktu Pengambilan : <span>{{\Carbon\Carbon::parse ($order->tanggal_pengambilan)->format('d-m-Y')}} / {{\Carbon\Carbon::parse ($order->waktu_pengambilan)->format('H:i')}}</span></b>
            </div>
          </div>

          
     {{--  --}}
    </div>
  </div>

<div class="row">
  <div class="col-md-6">
    

    <div class="card border border-bottom-0 border-left-0 border-right-0  border-success" >
      <div class="card-header text-success">
        <h3 class="card-title font-weight-bold">Detail Tagihan</h3>
      </div>
      <div class="card-body">
        <div class="form-group">
          <div class="row mb-2">
            <div class="col-md-4"><label for="" style="font-size: 13px;">Jumlah Total</label> </div>
            <div class="col-md-8 input-group">  <input style="font-size: 18px;" spellcheck="false" rows="1"class="form-control font-weight-bold" id="jumlah-total" value="Rp. {{$order->harga_total}}" disabled> 
               <div class="input-group-append">
                <span class="input-group-text "><span class="fas fa-money-bill-alt" ></span></span>
              </div>
            </div>
          </div>
          <div class="row mb-2 ">
            <div class="col-md-4"><label for="" style="font-size: 13px;">DP</label> </div>
            <div class="col-md-8 input-group">  <input style="font-size: 18px;" spellcheck="false" class="form-control font-weight-bold" id="dp"  value=" Rp. {{$order->dp}}" disabled>  
              <div class="input-group-append">
                <span class="input-group-text "><span class="fas fa-money-bill-alt" ></span></span>
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-4"><label for="" style="font-size: 13px;">Tagihan</label> </div>
            <div class="col-md-8">  <input style="font-size: 20px;" spellcheck="false" class="form-control form-control-lg  {{-- is-valid  --}}font-weight-bold" id="tagihan" value="{{$order->tagihan}} "  disabled> </div> 
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="card border border-bottom-0 border-left-0 border-right-0  border-success" >
      <div class="card-header text-success">
        <h3 class="card-title font-weight-bold">Pembayaran</h3>
      </div>
      <div class="card-body">
         @php
        $id_hash= \Crypt::encrypt($order->id) ; 
        @endphp
        <form  method="post" action="{{ route('admin-submit-pembayaran',$id_hash) }} "  enctype="multipart/form-data">  
      @csrf 

      @if ($order->dp==0)
        <div class="row mb-4">
          <div class="col-md-4"><label for="" style="font-size: 13px;">DP</label></div>
          <div class="col-md-8  input-group">
            <div class="input-group-prepend">
                    <span class="input-group-text">Rp.</span>
                  </div>
            <input style=""type="number"  class="form-control " id="bayar-dp" name="bayar_dp" placeholder="masukkan nominal" required>  
              <div class="input-group-append">
                <span class="input-group-text "><span class="fas fa-money-check-alt" ></span></span>
              </div>
          </div>
        </div>
      @endif
        

        <div class="row mb-2">
          <div class="col-md-4"><label for="" style="font-size: 13px;">Bayar Langsung</label></div>
          <div class="col-md-8  input-group">
            <div class="input-group-prepend">
                    <span class="input-group-text">Rp.</span>
                  </div>
            <input style="" type="number"  class="form-control" id="bayar-lunas" name="bayar_lunas" placeholder="masukkan nominal" required>  
              <div class="input-group-append">
                <span class="input-group-text "><span class="fas fa-money-check-alt" ></span></span>
              </div>
          </div>
        </div>

        <div class="row mb-4">
          <div class="col-md-4"><label for="" style="font-size: 13px;">Kembalian</label></div>
          <div class="col-md-8  input-group">
            <div class="input-group-prepend">
                    <span class="input-group-text">Rp.</span>
                  </div>
            <input style=""   class="form-control" id="bayar-kembali" name="bayar-kembali" value="" disabled>  
              <div class="input-group-append">
                <span class="input-group-text "><span class="fas fa-hand-holding-usd" ></span></span>
              </div>
          </div>
        </div>
        
        {{-- <div class="row mb-2">
          <div class="col-md-4"></div>
          <div class="col-md-8" style="font-size: 10px; font-style: normal;" ><p>*pilih dan isi salah satu form</p> </div>
        </div> --}}

        <div class="row">
          <div class="col-md-4"></div>
            <div class="col-md-8" > 
              <button type="Submit" class="btn btn-block bg-gradient-success" id="submit-bayar" > Submit Pembayaran <span class="fas fa-check-circle"></span> </button> 
            </div>
        </div>
        
        </form>
      </div>    
    </div>
        
  </div>
</div>
</div>
@endsection

@section('js')


<script>

// var dp ={{$order->dp}}
// if (dp == null) {
// }

$(document).on('input', '#bayar-dp', function(){

var tagihann={{$order->tagihan}};

 $('#submit-bayar').prop('disabled', false);
 $('#tagihan').removeClass('is-warning');
 $('#tagihan').removeClass('is-valid');

 var dpValue= $('#bayar-dp').val();
  
       
        if(dpValue==0)
        {
            $('#bayar-lunas').prop('disabled', false);
            $('#bayar-lunas').prop('placeholder', "masukkan nominal");
        } else
        {
            $('#bayar-lunas').prop('disabled', true);
            $('#bayar-lunas').removeAttr('placeholder');

            if(dpValue>=tagihann)
            {
              $('#bayar-dp').addClass('is-invalid');
              $('#submit-bayar').prop('disabled', true);
            }
            else
            {
              $('#bayar-dp').removeClass('is-invalid');
              $('#submit-bayar').prop('disabled', false);
            } 
        }
});



$(document).on('input', '#bayar-lunas', function(){

$('#bayar-dp').removeClass('is-invalid');
 var lunasValue= $('#bayar-lunas').val();
 var tagihan={{$order->tagihan}};

        if(lunasValue==0)
        {   
             $('#submit-bayar').prop('disabled', true);

            // me eneble field dp
            $('#bayar-dp').prop('disabled', false);
            $('#bayar-dp').prop('placeholder', "masukkan nominal");

            $('#tagihan').val("Rp. "+tagihan);

            $('#bayar-kembali').val("");

        } 
        else
        {
            
            $('#bayar-dp').prop('disabled', true);
            $('#bayar-dp').removeAttr('placeholder');

            var hitungtagihan=tagihan-lunasValue;
            $('#tagihan').val("Rp. "+hitungtagihan);

            if(lunasValue>=tagihan)
            {
              $('#tagihan').removeClass('is-warning');
              $('#tagihan').addClass('is-valid');
              $('#tagihan').val("0");

              // menampilkan kembalian
              var kembalian=lunasValue-tagihan;
              $('#bayar-kembali').val(kembalian);

              $('#submit-bayar').prop('disabled', false);
            }
            else
            {
              $('#tagihan').removeClass('is-valid');
              $('#tagihan').addClass('is-warning');
              $('#tagihan').val(hitungtagihan);
              
              $('#bayar-kembali').val("");

              $('#submit-bayar').prop('disabled', true);
            }
        }
});

</script>




@endsection