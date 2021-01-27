@extends('admin.admin-master')

@section('title','DinArt - Produksi')
@section('page-title','Transaksi / Produksi')

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

  .border{
  border-width:3px !important;
}

</style>


@endsection

@section('content')

<div class="mr-2 ml-2">
 <div class="card border border-bottom-0 border-left-0 border-right-0  border-success">
      <div class="card-header text-success">
        <div class="row">
          <div class="col-md-6"><h3 class="card-title font-weight-bold"><a class="fas fa-arrow-left text-success mr-3" href="{{ route('admin-transaksi') }}">  </a>Invoice Transaksi</h3></div>
          <div class="col-md-6"><span class="text-success font-weight-bold float-right" > {{$order->kode_transaksi}} </span></div>
        </div>
        
      </div>
        <div class="card-body">

          <div class="row">
            <div class="col-md-4 create-detail "> 
              <b> Customer Service :<span> {{$order->nama_cs}} </span>  </b> <br>
              <b> Kode Box:  <span> {{$kode_box}} </span>   </b>
            </div>   

            <div class="col-md-4 create-detail text-center">
              <b>Nama Customer :  <span>{{$pelanggan->nama}}  </span></b><br>
              {{-- <b>Alamat Customer:  <span>{{$pelanggan->alamat}}  </span></b><br> --}}
              <b>No. Telepon Customer: <span>{{$pelanggan->telepon}}  </span></b> 
            </div>

            <div class="col-md-4 create-detail ">
              <b class="float-right"> Waktu_Transaksi : <span> {{\Carbon\Carbon::parse ($order->created_at)->format('d-m-Y / H:i')}}</span> </b><br>
              <b class="float-right">Waktu Pengambilan : <span>{{\Carbon\Carbon::parse ($order->tanggal_pengambilan)->format('d-m-Y')}} / {{\Carbon\Carbon::parse ($order->waktu_pengambilan)->format('H:i')}}</span></b>
            </div>
          </div>
        </div>
      </div>

{{-- <div class="row">
  <div class="col-md-9"> --}}
      <div class="card border border-bottom-0 border-left-0 border-right-0  border-success">
    <div class="card-header text-success border-none">
      @if ($order->status_produksi==null)
        <h3 class="card-title font-weight-bold "> Pilih item yang akan dikirim ke produksi!</h3>
       @else 
        <h3 class="card-title font-weight-bold "> Informasi Status Produksi Item</h3>
      @endif
      
    </div>
    <div class="card-body">
          <div class="table-responsive pb-0">
            <table class="table mb-0 pb-0" id="table-item" style="font-size: 13px;">
              <thead>
                <tr> 
                  @if ($order->status_produksi==null)
                  <th class="" style="width: 12%;">(Select/Unselect)</th>
                  @else 
                  @endif
                  <th >Nama Item</th>
                  <th>Ukuran (PxL)</th>
                  <th>Qty</th>
                  <th style="max-width: 160px !important;">Catatan</th>
                  <th class="text-center">Status</th> 
                   
                </tr>
              </thead>
              <tbody>
               
                @foreach ($order_item as $oi)       
                  <tr>
                    
                      @if ($order->status_produksi==null)
                        <td class="mb-0 mt-0" id="action{{$oi->id}}">
                            @if ($oi->status_produksi=="sent")
                            <button class="btn " id="send{{$oi->id}}" onclick="checkItem({{$oi->id}})"> <span style="font-size: 22px;" class="fas fa-check-square text-success" ></span> </button>
                          @elseif($oi->status_produksi==null)  
                             <button class="btn " id="undo{{$oi->id}}" onclick="checkItem({{$oi->id}})"> <span style="font-size: 20px;" class="far fa-square text-secondary" ></span> </button>
                          @endif
                        </td>
                       @else 
                      @endif
                      
                        
                    
                    <td class="font-weight-bold">{{$oi->nama_barang}} </td>
                    <td>{{$oi->panjang}} x {{$oi->lebar}}</td>
                    <td>{{$oi->qty}} </td>
                    <td style="max-width: 190px !important;"> {{$oi->catatan_item}} </td>
                     <td class="text-center " id="status{{$oi->id}}" style="font-size: 13px">
                        @if ($oi->status_produksi=="sent" && $order->status_produksi !==null)
                         <b class="text-success font-weight-bold">{{$oi->status_produksi}} <span class="fas fa-paper-plane" ></span></b>
                        @elseif($oi->status_produksi=="done" && $order->status_produksi !==null)
                          <b class="text-success font-weight-bold">{{$oi->status_produksi}} <span class="fas fa-check" ></span></b>
                        @endif
                    </td>

                  </tr>
                @endforeach

              </tbody>
            </table>
          </div>
         <hr class="mb-0" >
        </div>
        <div class="card-footer  ">
          <div class="row">
            <div class="col-md-6">
               @if ($order->status_produksi==null)
              <a href="{{ route('admin-transaksi-skip-produksi',$order->id) }}" class="btn btn-sm btn-success pl-4 pr-4 mb-2" data-toggle="tooltip" data-placement="right" title="Tidak ada item yang perlu dikirim ke produksi">Skip <span class="fas fa-angle-right pl-2 " ></span><span class="fas fa-angle-right " ></span><span class="fas fa-angle-right " ></span> </a>
              @endif
            </div>
            <div class="col-md-6 text-right">
               @if ($order->status_produksi==null)
                <a href="{{ route('admin-transaksi-submit-produksi',$order->id) }}" class="btn btn-sm btn-success">Send Item Selected <span class="fas fa-check" ></span></a>
                <a href="{{ route('admin-transaksi-submit-all-produksi',$order->id) }}" class="btn btn-sm btn-outline-success pl-2 pr-2">Send All Item <span class="fas fa-paper-plane " ></span> </a> 
               @endif
            </div>
          </div>
         
        </div>
       
      </div>

</div>
@endsection


@section('js')

<script>
  
   function checkItem(id) 
   {
      csrf_token= $('meta[name="csrf-token"]').attr('content') ;

         $.ajax({
            url:"{{ url('admin/transaksi/form-produksi') }}"+'/'+id+'/check',
            type:"POST",
            data: {
                '_method':'POST',
                '_token':csrf_token 
            },


            success: function(response){

              if(response.status_produksi==null)
              {
                // $('#status'+response.id).append('<span class="fas fa-check text-success" id="check'+response.id+'" style="font-size: 20px;" ></span>');
                $('#send'+response.id).remove();
                 $('#action'+response.id).append('<button class="btn " id="undo'+response.id+'" onclick="checkItem('+response.id+')"> <span style="font-size: 20px;" class="far fa-square text-secondary"  ></span> </button>');
              }
              else if(response.status_produksi=='sent')
              {
                // $('#check'+response.id).remove();
                $('#undo'+response.id).remove();
                 $('#action'+response.id).append('<button class="btn " id="send'+response.id+'" onclick="checkItem('+response.id+')"> <span style="font-size: 22px;" class="fas fa-check-square text-success" ></span> </button>');
              }

                    // Toast.fire({
                    //     icon: 'info',
                    //     title: 'Berhasil menghapus item!'
                    //   });

                  },

                  error: function(xhr) {
                    Toast.fire({
                              icon: 'error',
                              title: 'something error!'
                            })
                  }

                })
   }

</script>








@endsection