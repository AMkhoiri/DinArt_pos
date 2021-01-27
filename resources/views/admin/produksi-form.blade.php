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

</style>


@endsection

@section('content')
<div class="mr-2 ml-2">

 <div class="card border border-bottom-0 border-left-0 border-right-0  border-success">
      <div class="card-header text-success mb-0">
        <div class="row">
          <div class="col-md-6"><h3 class="card-title font-weight-bold">{{-- <a class="fas fa-arrow-left text-info mr-3" href="{{ route('admin-produksi') }}">  </a> --}} Invoice Transaksi</h3></div>
          <div class="col-md-6"><span class="text-success font-weight-bold float-right" > {{$order->kode_transaksi}} </span></div>
        </div>
        
      </div>
        <div class="card-body pt-1">

          <div class="row">
            <div class="col-md-4 create-detail "> 
              <b> Customer Service :<span> {{$order->nama_cs}} </span>  </b> <br>
              <b> Kode Box:  <span> {{$kode_box}} </span>   </b>
            </div>   

            <div class="col-md-4 create-detail text-center">
              {{-- <b>Nama Customer :  <span>{{$pelanggan->nama}}  </span></b><br>
              <b>No. Telepon Customer: <span>{{$pelanggan->telepon}}  </span></b>  --}}
            </div>

            <div class="col-md-4 create-detail ">
              <b class="float-right"> Waktu_Transaksi : <span> {{\Carbon\Carbon::parse ($order->created_at)->format('d-m-Y / h:i')}}</span> </b><br>
              <b class="float-right">Waktu Pengambilan : <span>{{\Carbon\Carbon::parse ($order->tanggal_pengambilan)->format('d-m-Y')}} / {{\Carbon\Carbon::parse ($order->waktu_pengambilan)->format('H:i')}}</span></b>
            </div>
          </div>
          <div class=" create-detail  ">
            <b> Catatan :<span> {{$order->catatan}} </span>  </b>
          </div>
        </div>
      </div>

{{-- <div class="row">
  <div class="col-md-9"> --}}
      <div class="card border border-bottom-0 border-left-0 border-right-0  border-success">
    <div class="card-header text-success">
      @if ($order->status_produksi=="done")
      <h3 class="card-title font-weight-bold"> Informasi Status Produksi Item</h3>
        
       @else 
        <h3 class="card-title font-weight-bold"> Update Proses Produksi!</h3>
      @endif
      
    </div>
    <div class="card-body">
          <div class="table-responsive pb-0">
            <table class="table mb-0 pb-0" id="table-item" style="font-size: 13px;">
              <thead>
                <tr> 
                  @if ($order->status_produksi=="waiting" || $order->status_produksi=="in process")
                  <th class="" style="width: 12%;">Produksi Selesai?</th>
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
                    
                      @if ($order->status_produksi=="waiting" || $order->status_produksi=="in process")
                        <td class="mb-0 mt-0" id="action{{$oi->id}}">
                            @if ($oi->status_produksi=="done")
                            <button class="btn " id="send{{$oi->id}}" onclick="checkItem({{$oi->id}})"> <span style="font-size: 22px;" class="fas fa-check-square text-success" ></span> </button>
                          @elseif($oi->status_produksi=="sent")  
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
                        @if ($oi->status_produksi=="done" && $order->status_produksi !==null)
                        
                        <b class="text-success font-weight-bold done" id="done{{$oi->id}}">{{$oi->status_produksi}} <span class="fas fa-check" ></span></b>
                        @endif
                    </td>

                  </tr>
                @endforeach

              </tbody>
            </table>
          </div>
         <hr class="mb-0" >
        </div>
        <div class="card-footer text-right ">
           
           <a href="{{ route('admin-produksi-save',$order->id) }}" class="btn btn-sm btn-success pl-3 pr-3">Save Update <span class="fas fa-check ml-1" ></span></a>
         
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
            url:"{{ url('admin/produksi/proses') }}"+'/'+id+'/check',
            type:"POST",
            data: {
                '_method':'POST',
                '_token':csrf_token 
            },


            success: function(response){

              if(response.status_produksi=='sent')
              {
                // $('#status'+response.id).append('<span class="fas fa-check text-info" id="check'+response.id+'" style="font-size: 20px;" ></span>');
                $('#send'+response.id).remove();
                 $('#action'+response.id).append('<button class="btn " id="undo'+response.id+'" onclick="checkItem('+response.id+')"> <span style="font-size: 20px;" class="far fa-square text-secondary"  ></span> </button>');

                 $('#done'+response.id).remove();

                 Toast.fire({
                     icon: 'info',
                     title: 'Status Item diubah!'
                    });
              }
              else if(response.status_produksi=='done')
              {
                // $('#check'+response.id).remove();
                $('#undo'+response.id).remove();
                 $('#action'+response.id).append('<button class="btn " id="send'+response.id+'" onclick="checkItem('+response.id+')"> <span style="font-size: 22px;" class="fas fa-check-square text-success" ></span> </button>');

                 $('#done'+response.id).remove();
                 $('#status'+response.id).append('<b class="text-success font-weight-bold done" id="done'+response.id+'">'+response.status_produksi+' <span class="fas fa-check" ></span></b> ')

                 Toast.fire({
                     icon: 'info',
                     title: '1 item selesai diproduksi!'
                    });
              }

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