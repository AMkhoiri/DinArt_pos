@extends('admin.admin-master')

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

  {{-- modal tambah barang --}}
   <div class="modal border-0 fade " style="border: 0;" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header mb-3 text-info" {{-- style="background-color: #0276d7; color: white; " --}} >
              <h5 class="modal-title font-weight-bold"><span class="fas fa-pencil-alt mr-2" style="font-size: 18px;" > </span> Tambah Barang Baru</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body ml-3 mr-3">
              

             <form  method="post" action="{{ route('admin-tambahbarang') }} "  enctype="multipart/form-data">  
               @csrf        

                 <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="nama" name="nama" spellcheck="false"  placeholder="Input nama barang" required>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="jenis" class="col-sm-2 col-form-label">Jenis</label>
                      <div class="col-sm-10">             
                        <select class="form-control" id="jenis" name="jenis" required>
                          <option  value="">pilih jenis barang</option>
                          <option value="satuan" >satuan</option>
                          <option value="meteran" >meteran</option> 
                              
                        </select>  
                     </div>
                  </div>
       
                  <div class="form-group row">
                    <label for="stok" class="col-sm-2 col-form-label">Stok</label>
                    <div class="col-sm-10">
                       <input type="number" class="form-control" min=0 spellcheck="false" id="stok" name="stok" placeholder="tulis stok, misal: 30" >
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="harga" class="col-sm-2 col-form-label">Harga</label>
                    <div class="col-sm-10">
                      <div class="input-group-append">
                          <input type="text" class="form-control" min=0 placeholder="tulis harga (Rupiah)" id="harga" spellcheck="false" name="harga" required>
                         <span class="input-group-text">.00</span>
                    </div>
                    </div>
                  </div>

                 {{--  <div class="form-group row">
                    <label for="harga" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                      
                    </div>
                  </div>
 --}}
                  <div class="form-group row">
                    <label for="diskon" class="col-sm-2 col-form-label">Diskon</label>
                    <div class="col-sm-10">
                    <div class="input-group-append">
                     <input type="number" class="form-control" id="diskon" min=0 name="diskon" spellcheck="false" placeholder="tulis diskon, misal: 20" >
                      <span class="input-group-text">&ensp;%</span>
                    </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
                    <div class="col-sm-10">
                     <textarea class="form-control" rows="3" spellcheck="false" id="deskripsi" name="deskripsi" placeholder="Tulis deskripsi/keterangan"></textarea>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="deskripsi" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                     <span style="font-size: 12px; " class="text-muted">
                          *Penulisan harga untuk barang meteran, gunakan titik (.) jangan menggunakan koma (,) <br>
                          *Misal penulisan yang benar: 1.5 / 2 / 2.1 dst.
                      </span>
            
                    </div>
                  </div>
                   
            <div class="modal-footer justify-content-right">
                <button type="submit" class="btn btn-sm btn-info">Simpan</button>
              <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
            
            </div>
          </form>

          </div>
          <!-- /.modal-content -->

        </div>
        <!-- /.modal-dialog -->
      </div>
    </div>

{{-- /modal tambah barang --}}



  {{-- modal edit barang --}}
   <div class="modal fade" id="editModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header mb-3 text-info" style="/*background-color: #0276d7; color: white;*/ " >
              <h5 class="modal-title font-weight-bold"> <span class="fas fa-edit mr-2" style="font-size: 18px;" > </span> Edit Data Barang</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body ml-3 mr-3">
              

             <form  method="post" action="{{-- {{ route('admin-updatebarang') }} --}} "  enctype="multipart/form-data">  
               @csrf        

                 <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="editnama" name="nama" spellcheck="false"  placeholder="Input nama barang" required>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="jenis" class="col-sm-2 col-form-label">Jenis</label>
                      <div class="col-sm-10">             
                        <select class="form-control" id="editjenis" name="jenis" required>
                          <option  value="">pilih jenis barang</option>
                          <option value="satuan" >satuan</option>
                          <option value="meteran" >meteran</option> 

                        </select>  
                     </div>
                  </div>
       
                  <div class="form-group row">
                    <label for="stok" class="col-sm-2 col-form-label">Stok</label>
                    <div class="col-sm-10">
                       <input type="number" class="form-control" min=0 spellcheck="false" id="editstok" name="stok" placeholder="tulis stok, misal: 30" >
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="harga" class="col-sm-2 col-form-label">Harga</label>
                    <div class="col-sm-10">
                      <div class="input-group-append">
                          <input type="text" class="form-control" min=0 placeholder="tulis harga (Rupiah)" id="editharga" spellcheck="false" name="harga" required>
                         <span class="input-group-text">.00</span>
                    </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="diskon" class="col-sm-2 col-form-label">Diskon</label>
                    <div class="col-sm-10">
                    <div class="input-group-append">
                     <input type="number" class="form-control" id="editdiskon" min=0 name="diskon" spellcheck="false" placeholder="tulis diskon, misal: 20" >
                      <span class="input-group-text">&ensp;%</span>
                    </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
                    <div class="col-sm-10">
                     <textarea class="form-control" rows="3" spellcheck="false" id="editdeskripsi" name="deskripsi" placeholder="Tulis deskripsi/keterangan"></textarea>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="deskripsi" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                     <span style="font-size: 12px; " class="text-muted">
                          *Penulisan harga untuk barang meteran, gunakan titik (.) jangan menggunakan koma (,) <br>
                          *Misal penulisan yang benar: 1.5 / 2 / 2.1 dst.
                      </span>
            
                    </div>
                  </div>

                <input type="hidden" name="id" id="id" >
                <input type="hidden" name="_method" value="PUT">
            
            <div class="modal-footer justify-content-right">
                <button type="submit" class="btn btn-sm btn-info">Simpan</button>
              <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
            
            </div>
          </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
    </div>

{{-- /modal edit barang --}}



{{-- modal detail barang --}}

   <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-info mb-1">
              <h5 class="modal-title font-weight-normal"> <span style="color: white; font-size: 18px;" class="fas fa-info-circle mr-2" > </span> Detail Barang/Product</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body ml-3 mr-3" >


            <div class="">
              {{-- <img src="{{ asset('dinart/dist/img/photo3.jpg') }} " class="rounded mx-auto d-block img-fluid max-width: 100%;" alt="..."> --}}
              <span class="text-sm text-muted">Product Name </span>
              <h3 class=" data font-weight-bold text-muted mb-2" id="detailnama"> </h3>

              

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


                <hr>  
                <div class="row"> 
                  <div class="col-md-6"> 
                      <p class="text-sm">Tanggal Input :
                        <b class="d-block font-weight-normal" >
                          <span  id="created_at" class="data"> </span> 
                        </b>
                      </p>    
                  </div>
                 <div class="col-md-6"> 
                     
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
        	<a href="#" class="btn  pr-4 pl-4 font-weight-bold  bg-gradient-info float-right d-inline" style="font-size: 13px;" data-toggle="modal" data-target="#modal-default" ><span class="fa fa-plus" style="font-size: 14px;" > </span> Tambah Barang </a>
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

              <button  class="btn btn-sm btn-warning btnn btn-swipe" nama="{{$b->nama}}" id="{{$b->id}}" data-token="{{ csrf_token() }}" data-toggle="tooltip" data-placement="top" title="Swipe (Sale/NotSale)"> <span style="color: white;" class="fas fa-exchange-alt" ></span></button>

              <button onclick="editForm({{$b->id}})" class="btn btn-sm btn-success btnn"  data-toggle="tooltip" data-placement="top" title="Edit barang"> <span class="fas fa-edit" ></span></button>

              	

            	<button  nama="{{$b->nama}}" id="{{$b->id}}" class="btn btn-sm btn-danger btnn btn-delete" data-toggle="tooltip" data-placement="top" title="Hapus barang" data-token="{{ csrf_token() }}" > <span class="fas fa-trash-alt" ></span></button>

            {{--   <a href=" {{ route('admin-deletebarang', $b->id) }}" class="btn btn-sm btn-danger btnn " data-toggle="tooltip" data-placement="top" title="Hapus barang" > <span class="fas fa-trash-alt" ></span></a> --}}

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


{{-- men disable field stok jika jenis yang dipilih adalah meteran --}}
<script>
  $('#jenis').on('change', function() {
    
    var jenis = $(this).val();

    if (jenis == "meteran") {
  
       $('#stok').prop('disabled',true);
       $('#stok').removeAttr('required');
    } 

    else
      $('#stok').prop('disabled',false);
       $('#stok').prop('required',true);
  
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
        url: "{{ url('admin/databarang')}}"+'/'+id+"/detail",
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

  // tampil modal edit
    function editForm(id) 

    {
      $('#editModal form')[0].reset();
      $.ajax({
        url: "{{ url('admin/databarang')}}"+'/'+id+"/edit",
        type: "GET",
        dataType: "JSON",

        success: function(data) {
          
          $('#editModal').modal('show');

          $('#id').val(data.id);
          $('#editnama').val(data.nama);
          $('#editjenis').val(data.jenis);
          $('#editharga').val(data.harga);
          $('#editstok').val(data.stok);
          $('#editdiskon').val(data.diskon);
           $('#editdeskripsi').val(data.deskripsi);
        },
        error : function(){
          alert("nothing data");
        }
      });
    }
// ........

// update data
 $(function(){
            $('#editModal form').on('submit', function (e) {
                if (!e.isDefaultPrevented()){
                    var id = $('#id').val();
                  
                    $.ajax({
                        url : "{{ url('admin/databarang')}}"+'/'+id+"/update",
                        type : "PUT",
                        data : $('#editModal form').serialize(),
                        success : function($data) {
                          $('#editModal').modal('hide');
                            window.location.href = "{{ url('admin/databarang') }}"

                              Toast.fire({
                                   icon: 'success',
                                   title: 'Berhasil mengedit data barang!'
                                  })
                        },
                        error : function(){

                              Toast.fire({
                                   icon: 'error',
                                   title: 'Gagal mengedit data barang!'
                                  })
                        }
                    });
                    return false;
                }
            });
        });

// .............

</script>




<script>

// sweetalert swipe confirmation
 
$('body').on('click', '.btn-swipe', function(event) {
  event.preventDefault();

  var me = $(this),
      title=me.attr('nama'),
      id=me.attr('id'),
      csrf_token= $('meta[name="csrf-token"]').attr('content') ;


  Swal.fire({
        title:' '+ title,
        text: 'Anda yakin untuk mengubah status barang ini ?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#ffc107',
        cancelButtonColor: '#868e96',
        confirmButtonText: 'Yes, swipe it!'
  }).then((result) => {
      
      if (result.value) {  

        window.location.href = "{{ url('admin/databarang') }}"+'/'+id+'/change'
          
      }
  })

});

</script>



<script>


// $.ajaxSetup({
//   headers: {
//     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//   }
// });



// sweetalert delete confirmation

$('body').on('click', '.btn-delete', function(event) {
  event.preventDefault();

  var me = $(this),
      title=me.attr('nama'),
      id=me.attr('id'),
      csrf_token= $('meta[name="csrf-token"]').attr('content') ;

  Swal.fire({
        title:' '+ title,
        text: 'Anda yakin untuk menghapus data barang ini ?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
      
      if (result.value) {  

        window.location.href = "{{ url('admin/databarang') }}"+'/'+id+'/delete'



// ajax delete, gagal reload datatable Anjingg...

          // $.ajax({
          //   url:"{{ url('admin/databarang') }}"+'/'+id+'/delete',
          //   type:"POST",
          //   data: {
          //       '_method':'DELETE',
          //       '_token':csrf_token 
          //   },


          //   success: function(response){
          //     // $('#tabelku').DataTable().ajax.reload();

          //       // $('#tabelku').DataTable().ajax.refresh();
          //     // tabelku.api().ajax.reload();
          //     location.reload();

          //           Toast.fire({
          //               icon: 'success',
          //               title: 'Berhasil menghapus data barang!'
          //             })
          //   },

          //   error: function(xhr) {
          //     Toast.fire({
          //               icon: 'error',
          //               title: 'gagal menghapus data barang!'
          //             })
          //   }

          // })

          
      }
  })

});



</script>


<script>
  $('#harga').on('change, keyup', function() {
    var currentInput = $(this).val();
    var fixedInput = currentInput.replace(/[A-Za-z!@#$%^&*()]/g, '');
    $(this).val(fixedInput);
    console.log(fixedInput);
});
</script>



@endsection