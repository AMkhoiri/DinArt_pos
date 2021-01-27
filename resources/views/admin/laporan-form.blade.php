@extends('admin.admin-master')

@php

use App\box;

@endphp

@section('title','DinArt - Laporan ')
@section('page-title',' Laporan Penjualan')
{{-- @section('breadcrumb','Data Barang') --}}
@section('css')
<style>



  .card-title {
  font-size: 16px;
}



  .btnn{
    font-size: 10px;
    font-weight: bold;
  }

.border{
  border-width:3px !important;
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

  #tabelku tbody tr { cursor: pointer; }




</style>

@endsection



@section ("content")



{{-- modal detail transaksi --}}
   <div class="modal  border-0 fade p-0 " style="border: 0;" id="detailModal">
        <div class="modal-dialog modal-xl p-0">
          <div class="modal-content p-0 m-0">
            <div class="modal-body m-0 p-0">
              
    <div class="card border border-info border-left-0 border-right-0 border-bottom-0 m-0 pt-2">
      <div class="card-header text-info mb-0 border-info">
        <div class="row">
          <div class="col-md-6"><h3 class="card-title font-weight-bold"> Detail Transaksi</h3></div>
          <div class="col-md-6"><span class="text-info font-weight-bold float-right" id="kode_transaksi" > </span></div>
        </div>
        
      </div>
        <div class="card-body m-0">
          <div class="row">
            <div class="col-md-4 create-detail "> 
              <b> Customer Service :<span id="nama_cs">  </span>  </b> <br>
              <b> Kode Box:  <span id="kode_box">  </span>   </b>
            </div>   

            <div class="col-md-4 create-detail text-center">
              <b>Nama Customer :  <span id="nama_pelanggan">  </span></b><br>
              <b>No. Telepon Customer: <span id="telepon_pelanggan">  </span></b> 
            </div>

            <div class="col-md-4 create-detail ">
              <b class="float-right"> Waktu Order : <span id="waktu_transaksi"> </span> </b><br>
              <b class="float-right">Transaksi Selesai : <span id="pengambilan"></span></b>
            </div>
          </div>

          
      <div class="table-responsive pb-0 mt-3 ">
        <table class="table  mb-0 pb-0" id="table-item" style="font-size: 13px;">
        <thead>
          <tr>
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

        </tbody>
          <tfoot class="mt-0 mb-0 pb-0 ">
          <tr>
            <th>Jumlah Total</th>
            <th></th>
            <th></th>
            <th> </th>
            <th></th>
            <th class="font-weight-bold" id="harga_total">Rp.  </th>
            <th></th>
          </tr>
        </tfoot>
      </table>
    </div>
     <hr class="mb-0" >
      <div class=" create-detail "><b > Catatan Transaksi : <br><span id="catatan_transaksi" ></span></b></div>
    </div>
  </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
    </div>

{{-- /modal detail transaksi --}}









   <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1 " ><i class="fas fa-shopping-cart "></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Transaksi Hari Ini</span>
                <span class="info-box-number">{{$transaksi_hari_ini}} <small> Orders</small> </span> 
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-money-bill-alt"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Pendapatan Hari Ini</span>
                <span class="info-box-number" id="pendapatan_hari_ini">
                  @php
                    $hasil_rupiah_hari_ini = number_format($pendapatan_hari_ini,2,',','.');
                  @endphp
                 <small>Rp. </small> {{$hasil_rupiah_hari_ini}}
                  
                </span>
              </div>
            </div>
          </div>

          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1 " style="color: white !important" ><i class="fas fa-shopping-cart"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Transaksi Bulan Ini</span>
                <span class="info-box-number">{{$transaksi_bulan_ini}} <small> orders</small></span>
              </div>
            </div>
          </div>

          

           <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-money-bill-alt"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Pendapatan Bulan Ini</span>
                @php
                    $hasil_pendapatan_bulan_ini = number_format($pendapatan_bulan_ini,2,',','.');
                  @endphp
                <span class="info-box-number" id="pendapatan_bulan_ini"> <small> Rp. </small> {{$hasil_pendapatan_bulan_ini}}</span>
              </div>
            </div>
          </div>


        </div>
        <!-- /.row -->












<div class="card mb-4 border border-bottom-0 border-left-0 border-right-0  border-info">
      
        
      <div class="card-header">
        <div class="row">
          <div class="col-md-6"> <h3 class="card-title font-weight-bold text-info ">DATA PENJUALAN</h3></div>
          <div class="col-md-6 text-info"><span class="float-right font-weight-bold" style="font-size: 16px;">{{$filter}} </span> </div>
        </div>
       
      </div>
        <div class="card-body pt-1">
         <div class="row mt-2 mb-2">
           <div class="col-md-2 text-info font-weight-bold" style="font-size: 14px;"> Jumlah Data : {{$orders_count}} </div> 
           <div class="col-md-10">

          <form  method="post" action="{{ route('admin-laporan-search-data') }} "  enctype="multipart/form-data">  
           @csrf 
            <div class="row" >
              <div class="col-md-2 mb-1">
                <div class=" input-group input-group-sm">
                <div class="input-group-prepend">
                    <span class="input-group-text">Box</span>
                </div>
                  <select class="form-control form-control-sm " id="" name="box" style="width: 100%;" required>
                    <option selected   value="all">All</option>
                    @foreach($box as $b)
                    <option  value="{{$b->id}}">Box {{$b->kode_box}}</option>
          
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="col-md-4 pl-1 pr-1 mb-1">
                 <div class=" input-group input-group-sm">
                  <div class="input-group-prepend">
                      <span class="input-group-text by">By Month</span>
                  </div>
                  <input type="month" class="form-control " id="by-month" name="by_month" >
                </div>
              </div>

              <div class="col-md-4 pl-1 pr-1 mb-1">
                <div class=" input-group input-group-sm">
                  <div class="input-group-prepend">
                      <span class="input-group-text by">By Date</span>
                  </div>
                  <input type="date" class="form-control " id="by-date" name="by_date" >
                </div>
              </div>

              <div class="col-md-2 pl-1 pr-1">
                <button  type="submit" class="btn btn-sm btn-info btn-block font-weight-bold" >Search Data <span class="fas fa-search" style="font-size: 11px;" ></span></button>
              </div>
            </div>
        </form>
             
           </div>
           
         </div> 


<hr style="box-shadow: 0 4px 2px -2px gray;">


 

        <table id="tabelku" class="table  table-hover {{-- border --}} border-info border-left-0 border-bottom-0 border-right-0" style="font-size: 13px;">

          <thead>
          <tr>
            <th>No</th>
            <th>Invoice</th>
            <th>Box </th>
            <th class="pr-1">CS</th>
            <th class="pr-1">Pelanggan</th>
            <th>Order</th>
            <th>Selesai</th>
            <th >Total Transaksi</th>
          
          </tr>
          </thead>

          <tbody>
           
           <?php $no = 0;?>
          @foreach($orders_report as $or)
            <?php $no++ ;?>
          <tr onclick="detailModal({{$or->id}} ) ">
            <td style="width: 4%;">{{$no}} </td>
            <td >{{$or->kode_transaksi}} </td>
            <td style="width: 8%;">
              
              @php
                $box=box::find($or->id_box);
                $kode_box=$box->kode_box;
              @endphp
              Box {{$kode_box}} 

            </td>
            <td class="pr-1">{{$or->nama_cs}} </td>
            <td class="pr-1">{{$or->nama_pelanggan}} </td>
            <td> {{\Carbon\Carbon::parse ($or->tanggal_transaksi)->format('d-m-Y / H:i')}}</td>
            <td> {{\Carbon\Carbon::parse ($or->tanggal_terima)->format('d-m-Y / H:i')}}</td>
              @php
                    $harga_total_rupiah = number_format($or->harga_total,2,',','.');
                  @endphp
            <td>Rp. {{$harga_total_rupiah}} </td>

          </tr>

          @endforeach
       
          </tbody>

          <tfoot>
          <tr>
            <th>No</th>
            <th>Invoice</th>
            <th>Box </th>
            <th class="pr-1">CS</th>
            <th class="pr-1">Pelanggan</th>
            <th>Order</th>
            <th>Selesai</th>
            <th >Total Transaksi</th>
          
          </tr>
          </tfoot>

        </table>
      </div>


    </div>


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
  
$(document).on('input', '#by-month', function()
{
  
    $('#by-date').prop('disabled', true);

});

$(document).on('input', '#by-date', function()
{
    $('#by-month').prop('disabled', true);

});

$(document).on('click', '.by', function()
{
  $('#by-month').val(0);
  $('#by-date').val(0);
   $('#by-month').prop('disabled', false);
    $('#by-date').prop('disabled', false);

});

</script>




<script>
  
  // tampil modal detail


  function detailModal(id) 
  {
    
     $('#detailModal .data').empty();

    // $('#detailModal')[0].reset();
    $.ajax({
      url: "{{ url('admin/laporan')}}"+'/'+id+"/detail",
      type: "GET",
      dataType: "JSON",

      success: function(data) {
console.log(data);
        var order=data.order_report;
        var kode_box=data.kode_box;
        // var pelanggan=data.pelanggan;
        var order_item=data.order_item_report;
        
         console.log(kode_box);
// 
        // clear data sebeelumya
        $('#nama_cs').empty();
        $('#kode_transaksi').empty();
        $('#kode_box').empty();
        $('#nama_pelanggan').empty();
        $('#telepon_pelanggan').empty();
        $('#waktu_transaksi').empty();
        $('#pengambilan').empty();

        // show modal
        $('#detailModal').modal('show');

        // menampilkan data
        $('#nama_cs').append(order.nama_cs);
        $('#kode_transaksi').append(order.kode_transaksi) ;
        $('#kode_box').append(kode_box);
        $('#nama_pelanggan').append(order.nama_pelanggan);
        $('#telepon_pelanggan').append(order.telepon_pelanggan);
        $('#waktu_transaksi').append(order.created_at);
        $('#pengambilan').append(order.tanggal_terima);
        // $('#tanggal_pengambilan').append();
        

        $('#table-item tbody').empty();

         order_item.forEach(function(oi) {
            $("#table-item tbody").append('<tr><td>'+oi.nama_barang  +'</td><td>'+oi.panjang +'x'+ oi.lebar  +'</td><td>'+oi.qty +'</td><td>'+'Rp. '+oi.harga_barang +'</td><td id="diskon_itemm" ><span id="diskon_item"> '+ oi.diskon_barang +'</span> %' +'</td><td >'+'Rp. <span class="harga-item" >'+ oi.harga_item +'</span></td><td id="catatan_itemm" ><span id="catatan_item">'+ oi.catatan_item+'</span></td></tr>');
        });

         // clear data sebelumnnya
         $('#harga_total').empty();
         $('#catatan_transaksi').empty();
         $('#tagihan').empty();
         $('#dp').empty();

         // menampilkan data
         $('#harga_total').append(order.harga_total);
         $('#catatan_transaksi').append(order.catatan);
        //  $('#tagihan').append('Rp. '+order.tagihan);
        //  $('#dp').append('Rp. '+order.dp);


// cek apakah null
        if(order_item.diskon_barang==null){
          $('#diskon_item').remove();
          $('#diskon_itemm').prepend('<span id="diskon_item"> 0 </span>');
        }

        if(order_item.catatan_item==null){
          $('#catatan_item').remove();
          $('#catatan_itemm').append('<span> </span>');
        }
        
      },
      error : function(){
        
         Toast.fire({
                   icon: 'error',
                   title: 'Gagal menampilkan data'
                  })
      }
    });
  }


// ........

</script>

{{-- <script>

  $("#tabelku tbody tr").hover(function()
  {
      $(this).addClass('borderside');
  }, 
  function()
  {
    $(this).removeClass('borderside');
  });
</script> --}}




@endsection