@extends('admin.admin-master')

@php

use App\box;

@endphp

@section('title','DinArt - Transaksi')
@section('page-title','Data Transaksi')
{{-- @section('breadcrumb','Data Barang') --}}
@section('css')
<style>
  .btn{
    font-size: 11px;
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

</style>

  

@endsection

@section ("content")


{{-- modal detail transaksi --}}
   <div class="modal  border-0 fade p-0 " style="border: 0;" id="detailModal">
        <div class="modal-dialog modal-xl p-0">
          <div class="modal-content p-0 m-0">
            <div class="modal-body m-0 p-0">
              
    <div class="card border border-success border-left-0 border-right-0 border-bottom-0 m-0 pt-2">
      <div class="card-header text-success mb-0 border-success">
        <div class="row">
          <div class="col-md-6"><h3 class="card-title font-weight-bold"> Detail Transaksi</h3></div>
          <div class="col-md-6"><span class="text-success font-weight-bold float-right" id="kode_transaksi" > </span></div>
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
              <b class="float-right">Waktu Pengambilan : <span id="pengambilan"></span></b>
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
            <th class="font-weight-bold">Rp. <span  id="harga_total"></span>  </th>
            <th></th>
          </tr>
        </tfoot>
      </table>
    </div>
     <hr class="mb-0" >
      <div class=" create-detail "><b > Catatan Transaksi : <br><span id="catatan_transaksi" ></span></b></div>
    </div>

    <div class="card-footer">
      <div class="row">
        <div class="col-md-3 dtl">

          <b>Total Tagihan :  <br><span id="tagihan" >Rp.  </span></b>
        </div>
        <div class="col-md-3 dtl">

          <b>DP :  <br><span id="dp" >Rp. </span></b>
        </div>
        
        <div class="col-md-3 dtl">

          <b>Status Pembayaran :  <br>  <span  id="status_pembayaran"></span>
           
          </b>
        </div>

        <div class="col-md-3 dtl">
          <b >Status Produksi :  <br>  <span id="status_produksi"></span>
          </b>
        </div>
      </div>
        
    </div>
  </div>


          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
    </div>

{{-- /modal detail transaksi --}}






 <div class="card">
      <div class="card-header border border-bottom-0 border-left-0 border-right-0  border-success">
        <div class="row">
          <div class="col-md-6"> <h3 class="card-title text-success font-weight-bold ">SEMUA TRANSAKSI</h3> </div>
          <div class="col-md-6 text-success"><span class="float-right font-weight-bold" style="font-size: 13px;">Jumlah transaksi : {{$jumlah_order}}
           ( Aktif: {{$order_aktif}} , Selesai: {{$order_selesai}} )  </span> </div>
        </div>
       
      </div>
      <!-- /.card-header -->
      <div class="card-body pt-1">
        <a href="{{ route('admin-newtransaksi') }}" class="btn  pr-4 pl-4 bg-gradient-success float-right " style="font-size: 13px;" ><span class="fa fa-cart-plus" style="font-size: 14px;" > </span> Transaksi Baru</a>

          <a href="#" class="btn mr-2 pr-3 pl-3 btn-outline-success float-right btn-report" style="font-size: 12px;" ><span class="fa fa-book" style="font-size: 14px;" > </span> Laporan</a>

        <table id="tabelku" class="table  table-hover" style="font-size: 13px;">

          <thead>
          <tr>
            <th>No</th>
            <th>Box </th>
            <th class="pr-1">Pelanggan</th>
            <th>Waktu Transaksi</th>
            <th style="max-width: 15%;" >Waktu Pengambilan</th>
            <th style="width: 12%;">Pembayaran</th>
            <th>Produksi</th>
           	<th>Action</th>
          </tr>
          </thead>

          <tbody>
          	 <?php $no = 0;?>
          @foreach($order as $o)
            <?php $no++ ;?>
          <tr  >
            @if ($o->status_order=="selesai")
              <td class="border border-secondary  border-bottom-0 border-top-0 border-right-0 " style="width: 4%;">{{$no}} </td>
            @else
              <td style="width: 4%;">{{$no}} </td>
            @endif
            
            <td style="width: 8%;">
              @php
                $box=box::find($o->id_box);
                $kode_box=$box->kode_box;
              @endphp
              Box {{$kode_box}} 
            </td>
            <td class="pr-1">{{$o->nama}} </td>
            <td>{{\Carbon\Carbon::parse ($o->created_at)->format('d-m-Y/H:i')}}</td>
            <td>{{\Carbon\Carbon::parse ($o->tanggal_pengambilan)->format('d-m-Y')}}/{{\Carbon\Carbon::parse ($o->waktu_pengambilan)->format('H:i')}} </td>
            <td class="text-center" style="font-size: 13px;">
              @if ($o->tagihan==0)
                  <span class="btn btn-xs btn-outline-success no-hover pr-2 pl-2" > {{$o->status_pembayaran}} </span>
              @elseif($o->dp!==0)
                  <span class="btn btn-xs btn-outline-info no-hover pr-2 pl-2" >{{$o->status_pembayaran}}</span>
              @else
                  <span class="btn btn-xs btn-outline-secondary no-hover"style="" > unpaid </span>
              @endif
            </td>

            <td class="text-center" style="font-size: 13px;">
              @if ($o->status_produksi=="in process")
                <span class="btn btn-xs btn-outline-info no-hover"style="" >{{$o->status_produksi}} </span>
              
              @elseif($o->status_produksi=="waiting")  
                <span class="btn btn-xs btn-outline-secondary no-hover"style="" >{{$o->status_produksi}} </span>
              
              @elseif($o->status_produksi=="done")
                <span class="btn btn-xs btn-outline-success no-hover"style="" >{{$o->status_produksi}} </span>

              @elseif($o->status_produksi=="skipped")
                <span class="btn btn-xs btn-outline-warning no-hover"style="" >{{$o->status_produksi}} </span>  

              @else  
              
              @endif



            </td>

{{-- menambahkan border jika status order selesai --}}
        @if ($o->status_order=="selesai")
          <td class="border border-secondary  border-bottom-0 border-top-0 border-left-0 "> 
              <button onclick="detailModal({{$o->id}} ) "class="btn btn-sm btn-info " data-toggle="tooltip" data-placement="top" title="Lihat detail transaksi"><span class="fas fa-info-circle" ></span></button>

              <a href="#" class="btn btn-sm btn-cetak btn-success" style="padding-left: 10px; padding-right: 10px;" idd="{{$o->id}}" target="_blank" data-toggle="tooltip" data-placement="top" title="Cetak struk transaksi"> <span class="fas fa-file-invoice" > Struk </span></a>
          </td>
        @else

            <td class="">	
              @if ($o->status_order!=='selesai')
                <button onclick="detailModal({{$o->id}} ) "class="btn btn-sm btn-info " data-toggle="tooltip" data-placement="top" title="Lihat detail transaksi"><span class="fas fa-info-circle" ></span></button>

                 {{-- struk bukti --}}
                 <a href="#" class="btn btn-sm btn-cetak btn-success" idd="{{$o->id}}" style="padding-left: 10px; padding-right: 10px;"  target="_blank" data-toggle="tooltip" data-placement="top" title="Cetak struk transaksi"> <span class="fas fa-file-invoice" > Struk</span></a>

                 @php
                  $id_o_hash= \Crypt::encrypt($o->id) ; 
                  @endphp

                 {{-- produksi --}}
                @if ( $o->status_pembayaran !== null && $o->status_produksi == null)
                    <a href="{{ route('admin-transaksi-form-produksi',$id_o_hash) }}" class="btn btn-sm btn-info " data-toggle="tooltip" data-placement="top" title="Kirim ke produksi"  {{-- style="color: white; background-color: #008080" --}} ><span class="fas fa-print" ></span></a>
                @elseif($o->status_pembayaran !== null && $o->status_produksi !== null)
                    <a href="{{ route('admin-transaksi-form-produksi',$id_o_hash) }}" class="btn btn-sm btn-info " data-toggle="tooltip" data-placement="top" title="Lihat Detail produksi"  {{-- style="color: white; background-color: #008080" --}} ><span class="fas fa-print" ></span></a>    
                @else
                    <button onclick="  "class="btn btn-sm btn-info  disabled" {{-- style="color: white; background-color: #008080" --}} ><span class="fas fa-print" ></span></button>
                @endif



                {{-- bayar --}}
                @if ($o->status_pembayaran=="paid")
                    <button class="btn btn-sm btn-warning disabled" ><span class="fas fa-money-bill-alt" ></span></button>

                @else
                    <a href="{{ route('admin-transaksi-bayar',$id_o_hash) }}" class="btn btn-sm btn-warning " data-toggle="tooltip" data-placement="top" title="Lanjutkan pembayaran"><span class="fas fa-money-bill-alt" ></span></a>
                @endif


               


                {{-- check --}}
                @if ($o->status_pembayaran=="paid" && $o->status_produksi=="done")
                   <button onclick="  "class="btn btn-sm btn-success btn-done  " nama_pelanggan="{{$o->nama}}" id="{{$o->id}}" data-token="{{ csrf_token() }}" data-toggle="tooltip" data-placement="top" title="Selesaikan Transaksi"><span class="fas fa-check" > </span></button>
                @elseif($o->status_pembayaran=="paid" && $o->status_produksi=="skipped")    
                    <button onclick="  "class="btn btn-sm btn-success btn-done " nama_pelanggan="{{$o->nama}}" id="{{$o->id}}" data-token="{{ csrf_token() }}" data-toggle="tooltip" data-placement="top" title="Selesaikan Transaksi"><span class="fas fa-check" > </span></button>
                @endif


              @elseif($o->status_order=='selesai')
                <button onclick="detailModal({{$o->id}} ) "class="btn btn-sm btn-info " data-toggle="tooltip" data-placement="top" title="Lihat detail transaksi"><span class="fas fa-info-circle" ></span></button>

              @endif

              @if ($o->status_pembayaran==null )
                <a href="#" class="btn btn-sm btn-danger btn-cancel" data-token="{{ csrf_token() }}" nama="{{$o->nama}}" id="{{$o->id}}" data-toggle="tooltip" data-placement="top" title="Batalkan Transaksi"> <span class="fas fa-times" > </span> </a>
              @endif
            </td>
        @endif

        


          </tr>
          @endforeach
          </tbody>

          <tfoot>
          <tr>
            <th>No</th>
            <th>Box </th>
            <th class="pr-1">Pelanggan</th>
            <th>Waktu Transaksi</th>
            <th>Waktu Pengambilan</th>
            <th>Pembayaran</th>
            <th>Produksi</th>
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
  
  // tampil modal detail


  function detailModal(id) 
  {
    
     $('#detailModal .data').empty();

    // $('#detailModal')[0].reset();
    $.ajax({
      url: "{{ url('admin/transaksi')}}"+'/'+id+"/detail",
      type: "GET",
      dataType: "JSON",

      success: function(data) {
console.log(data);
        var order=data.order;
        var kode_box=data.kode_box;
        var pelanggan=data.pelanggan;
        var order_item=data.order_item;
        
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
        $('#nama_pelanggan').append(pelanggan.nama);
        $('#telepon_pelanggan').append(pelanggan.telepon);
        $('#waktu_transaksi').append(order.created_at);
        $('#pengambilan').append(order.tanggal_pengambilan+' / '+order.waktu_pengambilan);
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
         $('#tagihan').append('Rp. '+order.tagihan);
         $('#dp').append('Rp. '+order.dp);


        $('#status_pembayaran').empty();
        $('#status_produksi').empty();


// status pembayaran               
         if(order.status_pembayaran=="paid")
         {
            $('#status_pembayaran').append('<span class="badge badge-success pl-2 pr-2" style="font-size: 12px" >Lunas <span style="font-size: 12px"  class="fas fa-check-circle" ></span></span>');
         }
         else if(order.status_pembayaran=="DP")
         {
            $('#status_pembayaran').append('<span class="badge badge-primary pl-3 pr-3" style="font-size: 12px" >DP</span>');
         }
         else if(order.status_pembayaran==null)
         {
            $('#status_pembayaran').append('<span class="badge badge-warning pl-2 pr-2" style="font-size: 12px" >Belum Dibayar</span>');
         }
         else
         {
            $('#status_pembayaran').append(order.status_pembayaran);
         }

// status produksi
         if(order.status_produksi=="waiting")
         {
            $('#status_produksi').append(' <span class="badge badge-secondary pl-2 pr-2" style="font-size: 12px" >'+order.status_produksi+' <span style="font-size: 12px"  class="fas fa-spinner" ></span> </span>');
         }
         else if(order.status_produksi=="in process")
         {
            $('#status_produksi').append('<span class="badge badge-info pl-2 pr-2" style="font-size: 12px" >'+order.status_produksi+'  <span style="font-size: 12px"  class="fas fa-hourglass-half" ></span></span>');
         }
         else if(order.status_produksi=="done")
         {
            $('#status_produksi').append(' <span class="badge badge-success pl-2 pr-2" style="font-size: 12px" >'+order.status_produksi+' <span style="font-size: 12px"  class="fas fa-check-circle" ></span></span>');
         }
         else if(order.status_produksi=="skipped")
         {
            $('#status_produksi').append(' <span class="badge badge-warning pl-2 pr-2" style="font-size: 12px; color:white;" >'+order.status_produksi+' <span style="font-size: 12px"  class="fas fa-angle-right" ></span><span style="font-size: 12px"  class="fas fa-angle-right" ></span></span>');
         }
         else
         {
            $('#status_produksi').append(order.status_produksi);
         }


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

// sweetalert confirm selesai transaksi
 
$('body').on('click', '.btn-done', function(event) {
  event.preventDefault();

  var me = $(this),
      title=me.attr('nama_pelanggan'),
      id=me.attr('id'),
      csrf_token= $('meta[name="csrf-token"]').attr('content') ;


  Swal.fire({
        title:'Selesaikan Transaksi?',
        text: 'Pastikan barang telah diterima oleh pelanggan!',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: ' #5cb85c',
        cancelButtonColor: '#868e96',
        confirmButtonText: 'Ya, Sudah selesai!',
         cancelButtonText:'Belum'
  }).then((result) => {
      
      if (result.value) {  
        // window.location.href = "{{ url('admin/transaksi') }}"+'/'+id+'/done'

        $.ajax({
            url:"{{ url('admin/transaksi') }}"+'/'+id+'/done',
           type: "GET",
           dataType: "JSON",

        success: function(data) {

          if (result.value) {

            Swal.fire({
                title:'Transaction success',
                text: 'Data dapat dialihkan ke laporan penjualan, Dan anda dapat mencetak struk transaksi',
                icon: 'success',
                showCancelButton: true,
                confirmButtonColor: ' #5cb85c',
                cancelButtonColor: '#868e96',
                confirmButtonText: 'Cetak Struk Transaksi',
                 cancelButtonText:'Nanti Saja'
          
           }).then((result) => { 

                // window.location.href = "{{ url('admin/transaksi') }}"+'/'+id+'/cetak'
                if (result.value) {
                      window.open(
                              "{{ url('admin/transaksi') }}"+'/'+id+'/cetak',
                              '_blank' 
                              );
                      
                }
                location.reload();

           });
          }

        },
        error : function(){
          
          Toast.fire({
                   icon: 'error',
                   title: ' Something Wrong'
                  })
          
        }

          })
      }
  })

});

</script>


 --}}










<script>

// sweetalert confirm selesai transaksi // tidak jadi with choice struk
 
$('body').on('click', '.btn-done', function(event) {
  event.preventDefault();

  var me = $(this),
      title=me.attr('nama_pelanggan'),
      id=me.attr('id'),
      csrf_token= $('meta[name="csrf-token"]').attr('content') ;


  Swal.fire({
        title:'Selesaikan Transaksi?',
        text: 'Pastikan barang telah diterima oleh pelanggan!',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: ' #5cb85c',
        cancelButtonColor: '#868e96',
        confirmButtonText: 'Ya, Sudah selesai!',
         cancelButtonText:'Belum'
  }).then((result) => {
      
      if (result.value) { 

        $.ajax({
            url:"{{ url('admin/transaksi') }}"+'/'+id+'/done',
           type: "GET",
           dataType: "JSON",

        success: function(data) {

          if (result.value) {

               Swal.fire({
                title:'Transaction success',
                text: 'Data dapat dialihkan ke laporan penjualan',
                icon: 'success',
                showConfirmButton: false,
          
           }).then(location.reload());

          }

          else{}

        },
        error : function(){
          
          Toast.fire({
                   icon: 'error',
                   title: ' Something Wrong'
                  })
          
        }

          })
      }
  })

});

</script>





<script>
  

  // sweetalert pilih struk transaksi
 
$('body').on('click', '.btn-cetak', function(event) {
  event.preventDefault();

    var idd=$(this).attr('idd'),
        csrf_token= $('meta[name="csrf-token"]').attr('content');

    Swal.fire({
                title:'Pilih Jenis Struk!',
                text: ' ',
                icon: 'question',
                showDenyButton: true,
                confirmButtonColor: ' #5cb85c',
                cancelButtonColor: '#868e96',
                denyButtonColor: '#17a2b8',
                confirmButtonText: 'Cetak A4 ',
                denyButtonText: 'Thermal',
                cancelButtonText:'Cancel'
            }).then((result) => { 

         
          if (result.isConfirmed) {
              window.open(
                        "{{ url('admin/transaksi') }}"+'/'+idd+'/cetak',
                        '_blank' 
                        );

               

          }
          else if (result.isDenied) {
             window.open(
                        "{{ url('admin/transaksi') }}"+'/'+idd+'/cetak/thermal',
                        '_blank' 
                        );

             
          }
          else{}
        });

});

</script>





<script>

// sweetalert confirm laporan transaksi
 
$('body').on('click', '.btn-report', function(event) {
  event.preventDefault();

  Swal.fire({
        title:'Laporkan Transaksi?',
        text: 'Semua data transaksi yang telah selesai akan dialihkan ke laporan penjualan',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: ' #5cb85c',
        cancelButtonColor: '#868e96',
        confirmButtonText: 'Ya, Lanjutkan...',
         cancelButtonText:'Batal'
  }).then((result) => {
      
      if (result.value) {  

        $.ajax({
            url:"{{ url('admin/transaksi/laporan') }}",
           type: "GET",
           dataType: "JSON",

        success: function(data) {

          if (result.value) {


            Swal.fire({
                title:'Completed',
                text: data +' Data transaksi selesai telah dialihkan ke laporan penjualan',
                icon: 'success',
                confirmButtonColor: ' #5cb85c',
                confirmButtonText: 'Great...'
          
           }).then((result) => { 

                location.reload();

           });
          }

        },
        error : function(){
          
          Toast.fire({
                   icon: 'error',
                   title: ' Something Wrong'
                  })
          
        }

          })
      }
  })

});

</script>



<script>

// sweetalert delete confirmation

$('body').on('click', '.btn-cancel', function(event) {
  event.preventDefault();

  var me = $(this),
      title=me.attr('nama'),
      id=me.attr('id'),
      csrf_token= $('meta[name="csrf-token"]').attr('content') ;

  Swal.fire({
        title:'Batalkan transaksi '+ title + ' ?',
        text: ' Stok item akan dikembalikan ke semula',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, batalkan transaksi!',
        cancelButtonText: ' Kembali ',

  }).then((result) => {
      
      if (result.value) {  

        window.location.href = "{{ url('admin/transaksi') }}"+'/'+id+'/cancel'
          
      }
  })

});

</script>


@endsection