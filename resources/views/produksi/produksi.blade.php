@extends('produksi.produksi-master') 

@php


use App\box;
use App\order_item;
use App\orders;


 
@endphp

@section('title','DinArt - Produksi')
@section('page-title','Data Produksi')
{{-- @section('breadcrumb','Data Barang') --}}
@section('css')
<style>
  .btn{
    font-size: 11px;
    font-weight: bold;
  }


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

.card-title {
  font-size: 16px;
}

.no-hover{
  pointer-events: none;
}

.border{
  border-width:3px !important;
}



</style>

     



@endsection

@section ("content")



 <div class="card">
      <div class="card-header border border-bottom-0 border-left-0 border-right-0  border-success">
        <div class="row">
          <div class="col-md-6"> <h4 class="card-title text-success font-weight-bold ">DATA PRODUKSI</h4> </div>
          <div class="col-md-6 text-success"><span class="float-right  font-weight-bold" style="font-size: 13px;">Jumlah Produksi : {{$jumlah_order}} (waiting : {{$order_waiting}}, in process : {{$order_process}} , done : {{$order_done}} )</span> </div>
        </div>
       
      </div>
      <!-- /.card-header -->
      <div class="card-body pt-1">
        <table id="tabelku" class="table  table-hover  {{-- table-bordered table-striped --}}" style="font-size: 13px;">

          <thead>
          <tr>
            <th>No</th>
            <th>Box </th>
            <th  >Nama Pelanggan</th>
            <th>Waktu Transaksi</th>
            <th style="max-width: 15%;" >Waktu Pengambilan</th>
            <th>Produksi</th>
            <th>Pengiriman</th>
           	<th>Action</th>
          </tr>
          </thead>

          <tbody>
          	 <?php $no = 0;?>
          @foreach($order as $o)
            <?php $no++ ;?>
          <tr>
            <td style="width: 4%;">{{$no}} </td>
            <td style="width: 8%;">
              @php
                $box=box::find($o->id_box);
                $kode_box=$box->kode_box;
              @endphp
              Box {{$kode_box}} 
            </td>
             <td style="">{{$o->nama}} </td>
           
            <td>{{\Carbon\Carbon::parse ($o->created_at)->format('d-m-Y/H:i')}}</td>
            <td>{{\Carbon\Carbon::parse ($o->tanggal_pengambilan)->format('d-m-Y')}}/{{\Carbon\Carbon::parse ($o->waktu_pengambilan)->format('H:i')}} </td>
            

            <td class="text-center" style="font-size: 13px; width:14% !important;">

             @php
                  $item_total=order_item::where('id_order',$o->id)->where('status_produksi','!=',null)->count();
                  $item_done=order_item::where('id_order',$o->id)->where('status_produksi','=','done')->count();
                                     
                @endphp

              @if ($o->status_produksi=="in process")
                <span class="btn btn-xs btn-outline-info no-hover"style="" >{{$o->status_produksi}} ( {{$item_done}} / {{$item_total}} )</span>
              
              @elseif($o->status_produksi=="waiting")  
                <span class="btn btn-xs btn-outline-secondary no-hover"style="" >{{$o->status_produksi}} </span>
              
              @elseif($o->status_produksi=="done")
                <span class="btn btn-xs btn-outline-success no-hover"style="" >{{$o->status_produksi}} </span>

              @else   
              @endif

            </td>

            <td class="text-center" style="font-size: 13px; width:11% !important;">
              @if ($o->status_pengiriman=="dikirim")
               <span class="btn btn-xs btn-outline-success no-hover"style="" > {{$o->status_pengiriman}}  <span class="fas fa-check" ></span> </span>
               @endif
            </td>

            <td style="width:15%">	
              @if ($o->status_produksi=="done" && $o->status_pengiriman==null)
                <a href="#" class="btn btn-sm btn-info disabled" data-toggle="tooltip" data-placement="top">Produksi</a>

                 <botton class="btn btn-sm btn-success btn-done" nama_pelanggan="{{$o->nama}}" id="{{$o->id}}" data-token="{{ csrf_token() }}" data-toggle="tooltip" data-placement="top" title="Selesaikan proses produksi">Selesai {{-- <span class="fas fa-check" ></span> --}} </botton>

               @elseif($o->status_pengiriman=="dikirim")   
               <a href="#" class="btn btn-sm btn-info disabled" data-toggle="tooltip" data-placement="top">Produksi</a>
              @else
                <a href="{{ route('produksi-produksi-form',$o->id) }} " class="btn btn-sm btn-info " data-toggle="tooltip" data-placement="top" title="Update Proses produksi">Produksi</a>

               
              @endif
              

              
            </td>

          </tr>
          @endforeach
          </tbody>

          <tfoot>
          <tr>
            <th>No</th>
            <th>Box </th>
           <th>Nama Pelanggan</th>
            <th>Waktu Transaksi</th>
            <th>Waktu Pengambilan</th>
           
            <th>Produksi</th>
            <th>Pengiriman</th>
           	<th>Action</th>
          </tr>
          </tfoot>

        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->


@endsection





@section('js')

{{-- declare datatables --}}
<script>

  $(function () {
    $("#tabelku").DataTable({
      "responsive": true,
      "autoWidth": false,
      // "processing": true,
      // "serverSide": true
    //   "columns": [
    // { "data": "ChargebackCode" }]

    });
    $('#tabeldku').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>



<script>

// sweetalert confirm selesai produksi
 
$('body').on('click', '.btn-done', function(event) {
  event.preventDefault();

  var me = $(this),
      title=me.attr('nama_pelanggan'),
      id=me.attr('id'),
      csrf_token= $('meta[name="csrf-token"]').attr('content') ;


  Swal.fire({
        title:'Produksi Selesai?',
        text: 'Pastikan semua item telah dikirimkan ke box!',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: ' #5cb85c',
        cancelButtonColor: '#868e96',
        confirmButtonText: 'Ya, Sudah dikirim!',
        cancelButtonText:'Belum',
  }).then((result) => {
      
      if (result.value) {  

        window.location.href = "{{ url('produksi/produksi') }}"+'/'+id+'/kirim'
          
      }
  })

});

</script>





@endsection