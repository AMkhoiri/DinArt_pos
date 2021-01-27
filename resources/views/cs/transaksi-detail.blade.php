@extends('cs.cs-master')

@section('title','DinArt - Transaksi')
@section('page-title','Transaksi / Detail')


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

  .dtl b{
    font-size: 11px !important;
    font-style: italic;
     font-weight: normal !important;

  }
  .dtl span{
    font-size: 15px;
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

</style>
 

@endsection

@section ("content") 

    <div class="card border border-left-0 border-right-0  border-info">
      <div class="card-header text-info mb-0 ">
        <div class="row">
          <div class="col-md-6"><h3 class="card-title font-weight-bold"> <a class="fas fa-arrow-left text-info mr-3" href="{{ route('cs-transaksi') }}">  </a> Detail Transaksi</h3></div>
          <div class="col-md-6"><span class="text-info font-weight-bold float-right" > {{$order->kode_transaksi}} </span></div>
        </div>
        
      </div>
        <div class="card-body mt-0 pt-1">
          <div class="row">
            <div class="col-md-4 create-detail "> 
              <b> Customer Service :<span> {{$order->nama_cs}} </span>  </b> <br>
              <b> Kode Box:  <span> {{$kode_box}} </span>   </b>
            </div>   

            <div class="col-md-4 create-detail text-center">
              <b>Nama Customer :  <span>{{$pelanggan->nama}}  </span></b><br>
              <b>No. Telepon Customer: <span>{{$pelanggan->telepon}}  </span></b> 
            </div>

            <div class="col-md-4 create-detail ">
              <b class="float-right"> Waktu_Transaksi : <span> {{\Carbon\Carbon::parse ($order->created_at)->format('d-m-Y / h:i')}}</span> </b><br>
              <b class="float-right">Waktu Pengambilan : <span>{{\Carbon\Carbon::parse ($order->tanggal_pengambilan)->format('d-m-Y')}} / {{\Carbon\Carbon::parse ($order->waktu_pengambilan)->format('H:i')}}</span></b>
            </div>
          </div>

          <hr>
      <div class="table-responsive pb-0">
        <table class="table  mb-0 pb-0" id="table-item" style="font-size: 13px;">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Item</th>
            <th>Ukuran (PxL)</th>
            <th>Qty</th>
            <th>Harga awal</th>
            <th>Diskon</th>
            <th>Harga Item</th>
            <th style="max-width: 160px !important;">Catatan</th>
            
          </tr>
        </thead>
        <tbody>
          <?php $no = 0;?>
          @foreach ($order_item as $oi)
           <?php $no++ ;?>
            <tr>
              <td>{{$no}}</td>
              <td>{{$oi->nama_barang}} </td>
              <td>{{$oi->panjang}} x {{$oi->lebar}}</td>
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
              <td>Rp. {{$oi->harga_item}} </td>
              <td style="max-width: 160px !important;"> {{$oi->catatan_item}} </td>
            </tr>
          @endforeach

        </tbody>
        
          <tfoot class="mt-0 mb-0 pb-0 ">
          <tr>
            <th></th>
            <th>Jumlah Total</th>
            <th></th>
            <th></th>
            <th> </th>
            <th></th>
            <th class="font-weight-bold" >Rp. {{$order->harga_total}} </th>
            <th></th>
          </tr>
        </tfoot>
      </table>
    </div>
     <hr class="mb-0" >
      <div class=" create-detail "><b > Catatan Transaksi : <br><span>{{$order->catatan}}</span></b></div>
    </div>

    <div class="card-footer">
      <div class="row">
        <div class="col-md-3 dtl">

          <b>Total Tagihan :  <br><span>Rp.  {{$order->tagihan}} </span></b>
        </div>
        <div class="col-md-3 dtl">

          <b>DP :  <br><span>Rp. {{$order->dp}} </span></b>
        </div>
        
        <div class="col-md-3 dtl">

          <b>Status Pembayaran :  <br>
            @if ($order->status_pembayaran=="paid")
              <span class="badge badge-success pl-2 pr-2" style="font-size: 12px" >Lunas <span style="font-size: 12px"  class="fas fa-check-circle" ></span></span>
            @elseif($order->status_pembayaran=="DP")
               <span class="badge badge-primary pl-3 pr-3" style="font-size: 12px" >DP</span>
            @elseif($order->status_pembayaran==null)
                 <span class="badge badge-warning pl-2 pr-2" style="font-size: 12px" >Belum Dibayar</span>
            @else
              <span>{{$order->status_pembayaran}} </span>
            @endif
          </b>
        </div>

        <div class="col-md-3 dtl">
          <b>Status Produksi :  <br>
           @if ($order->status_produksi=="waiting")
              <span class="badge badge-secondary pl-2 pr-2" style="font-size: 12px" >{{$order->status_produksi}} <span style="font-size: 12px"  class="fas fa-spinner" ></span> </span>
            @elseif($order->status_produksi=="in process")
               <span class="badge badge-info pl-2 pr-2" style="font-size: 12px" >{{$order->status_produksi}} <span style="font-size: 12px"  class="fas fa-hourglass-half" ></span></span>
            @elseif($order->status_produksi=="done")
                 <span class="badge badge-success pl-2 pr-2" style="font-size: 12px" >{{$order->status_produksi}} <span style="font-size: 12px"  class="fas fa-check-circle" ></span></span>
            @else
              <span>{{$order->status_produksi}} </span>
            @endif
          </b>
        </div>
        


      </div>
        
    </div>
  </div>

@endsection


