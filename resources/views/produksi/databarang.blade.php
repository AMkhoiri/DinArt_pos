@extends('produksi.produksi-master') 

@section('title','DinArt - Data Barang ')
@section('page-title','Data Barang')
{{-- @section('breadcrumb','Data Barang') --}}
@section('css')

<style>
    
    .col-form-label{
      font-weight: normal !important;
    }

    .btnn{
      font-size: 11px;
    }
    .d-block{
      font-size: 18px;
    }

    .card-title {
  font-size: 16px;
}
.border{
  border-width:3px !important;
}

.no-hover{
  pointer-events: none;
}


    .fade-scale {
  transform: scale(0);
  opacity: 0;
  -webkit-transition: all .25s linear;
  -o-transition: all .25s linear;
  transition: all .25s linear;
}

.fade-scale.in {
  opacity: 1;
  transform: scale(1);
}

    textarea { font-size: 13px !important; }
    input{ font-size: 13px !important; }
    select { font-size: 13px !important; }

</style>
  

@endsection

@section('content')



{{-- modal --}}




{{-- modal detail barang --}}

   <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header text-info mb-1 border border-info border-left-0 border-right-0 border-bottom-0">
              <div class="modal-title font-weight-bold "> <span style=" font-size: 16px !important;  " class="fas fa-info-circle mr-2" > </span> Detail Barang / Product </div>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body ml-3 mr-3" >


            <div class="">
              {{-- <img src="{{ asset('dinart/dist/img/photo3.jpg') }} " class="rounded mx-auto d-block img-fluid max-width: 100%;" alt="..."> --}}
              <span class="text-sm text-muted">Product Name </span>
              <h4 class=" data font-weight-bold text-muted mb-2" id="detailnama" style="text-transform: capitalize;"> </h4>

              

              <span class="text-sm text-muted">Product Description </span>
              <p class=" data" id="detaildeskripsi"></p>

              <div class="row">
                <div class="col-md-6">
                  
                    <b class="d-block text-muted "><span class="fas fa-hashtag" > </span>  <span class="data"  id="detailjenis"> </span></b>
                  
                </div>
                <div class="col-md-6 text-info">
                  <i class="fas fa-info-circle mr-2" > </i>
                   <span class="font-weight-bold  d-inline mt-0 data" style="font-size: 14px;" id="detailstatus"  >   </span>
                </div>
              </div>

              
              <hr>
             <div class="text-muted">
                    
            <div class="row"> 
               <div class="col-md-6">  
                 <p class="text-sm"><span class="fas fa-money-bill-alt text-sm" > </span> Harga Satuan/per-cm
                  <b class="d-block ">Rp. <span class="data"  id="detailharga"> </span></b>
                </p>
              </div>
              <div class="col-md-6"> 
                <p class="text-sm"><span class="fa fa-tags text-sm" ></span> Diskon Saat Ini
                  <b class="d-block" > 
                    <span class="data" id="detaildiskon"> </span> %
                  </b>
                </p>
              </div>
            </div>

              <div class="row"> 
               <div class="col-md-6">  
                <p class="text-sm"><span class="fa fa-server text-sm" ></span> Jumlah Stok <br>
                  <b class="d-block d-sm-inline" >
                    <span  id="detailstok" class="data"> </span> unit
                  </b>
                </p>
               </div>
              <div class="col-md-6"> 
                <p class="text-sm"><span class="fab fa-dropbox text-sm" ></span> Product Terjual <br>
                  <b class="d-block d-sm-inline" >
                    <span  id="detailterjual" class="data"> </span> unit
                  </b>
                </p>
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

{{-- /modal detail barang --}}



{{-- tabel --}}
	
  <div class="card border border-bottom-0 border-left-0 border-right-0  border-info">
      <div class="card-header border-0 text-info">
        <div class="row">
          <div class="col-md-6"><h3 class="card-title font-weight-bold ">DATA BARANG/PRODUCT </h3> </div>
          <div class="col-md-6 text-info" style="font-size: 13px;"><span class="float-right font-weight-bold" >Jumlah Barang : {{$jumlah_barang}} (on sale: {{$jumlah_barang_onsale}} / not sale: {{$jumlah_barang_notsale}}  )</span></div>
        </div>
        
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="tabelku" class="table {{-- table-bordered  table-striped --}} table-hover" style="font-size: 13px;">
        	
          <thead>
          <tr>
            <th>No</th>
            <th>Nama Barang</th>
            <th>Jenis</th>
            <th>Stok</th>
            <th>Harga (Rp)</th>
            <th>Diskon (%)</th>
            <th>status</th>
            <th>Aksi</th>
          </tr>
          </thead>

          <tbody>
            <?php $no = 0;?>
          @foreach($barang as $b)
            <?php $no++ ;?>
          <tr>
            <td>{{$no}} </td>
            <td style="text-transform: capitalize;">{{$b->nama}} </td>
            <td>{{$b->jenis}}</td>
            <td>{{$b->stok}}</td>
            <td>{{$b->harga}}</td>
            <td> {{$b->diskon}}</td>
            <td style="font-size: 12px !important;" class="text-center" >  
              @if ($b->status=="on sale")
                {{-- <span  class="fas fa-check text-info" > </span> --}}
                 <span class="btn btn-xs btn-outline-warning  pr-2 pl-2 no-hover" > {{$b->status}} </span>
              @elseif($b->status=="not sale")
                {{-- <span  class="fas fa-close text-danger" > </span> --}}
                <span class="btn btn-xs btn-outline-danger  pr-2 pl-2 no-hover" > {{$b->status}} </span>
              @endif
              
            </td>
            <td  class="float-right">	

            	<button onclick="detailModal({{$b->id}})" class="btn btn-sm btn-info btnn" data-toggle="tooltip" data-placement="top" title="Detail barang"> <span class="fas fa-info-circle" ></span></button>

              

            </td>
          </tr>
          @endforeach

          </tbody> 
          <tfoot>
          <tr>
            <th>No</th>
            <th>Nama Barang</th>
            <th>Jenis</th>
            <th>Stok</th>
            <th>Harga</th>
            <th>Diskon</th>
            <th>Status</th>
            <th>Aksi</th>
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




{{-- modal --}}
<script>

  // tampil modal detail
    function detailModal(id) 

    {
       $('#detailModal .data').empty();


      // $('#detailModal')[0].reset();
      $.ajax({
        url: "{{ url('produksi/databarang')}}"+'/'+id+"/detail",
        type: "GET",
        dataType: "JSON",

        success: function(data) {

          console.log(data);
          
          $('#detailModal').modal('show');

          $('#detailid').append(data.id);
          $('#detailnama').append(data.nama) ;
          $('#detailjenis').append(data.jenis);
          $('#detailharga').append(data.harga);
          $('#detailstok').append(data.stok);
          $('#detaildiskon').append(data.diskon);
          $('#detailterjual').append(data.terjual);
           $('#detaildeskripsi').append(data.deskripsi);
           $('#detailstatus').append(data.status);
           $('#created_at').append(data.created_at);
           $('#updated_at').append(data.updated_at);
        },
        error : function(){
          
           Toast.fire({
                     icon: 'warning',
                     title: 'Gagal menampilkan data'
                    })
        }
      });
    }
// ........

 
</script>



@endsection