@extends('cs.cs-master')

@section('title','DinArt - Transaksi Baru')
@section('page-title','Transaksi / Transaksi Baru')
  <!-- Select2 -->

  <link rel="stylesheet" href="{{asset('dinart/plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('dinart/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">


@section('css')

<style>
  
  .detail-lable{
    font-size: 11px;
    font-weight: lighter;
  }
  .create-detail b{
    font-size: 10px;
    font-style: italic;
     font-weight: lighter !important;
  }
  .create-detail span{
    font-size: 12px;
    font-style: normal;
    font-weight: bold;
  }

  .card-title{
    font-size: 18px;

  }

  .cb{
    padding-top:  10px;
  }

  .form-group label{
    font-size: 13px !important;
  }

  .table {
    font-size: 13px !important;
  }


      textarea { font-size: 14px !important; }
    input{ font-size: 14px !important; }
    select { font-size: 14px !important; }
    label{ font-size: 14px !important; }


.border{
  border-width:3px !important;
}


.select2{
    font-size: 14px !important;
}

.select2-results__option{
 font-size: 14px;
 text-transform: capitalize;
}

.select2-results__option--highlighted{
  background-color: #5cb85c !important;
}



</style>


@endsection

@section ("content") 

<div class="mr-2 ml-2">




  {{-- modal catatan item--}}
   <div class="modal fade" id="detail_catatan">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-body m-0 p-0">
              <div class="card  border-success border-left-0 border-right-0 border-bottom-0 m-0 pt-2">
                <div class="card-header text-success mb-0 ">
                  <h3 class="card-title font-weight-bold"><span class="fas fa-sticky-note mr-3" style="font-size: 18px;" > </span>  Catatan Item</h3>
                </div>
                <div class="card-body m-0">
                  <div class="mb-3">
                    <b  class="mb-2" style="text-transform: capitalize;"> <span id="nama-item"> </span> : </b>
                    <p  id="cat_item" ></p>
                    
                  </div>
                </div>
              </div>
            </div>


            
        </div>
      </div>
    </div>

  {{-- /modal catatan item--}}


<div class="row">
  <div class="col-md-5">
    <div class="card border border-bottom-0 border-left-0 border-right-0  border-success">
      <div class="card-header border-0 text-success">
        <h4 class="card-title font-weight-bold">Informasi Pelanggan </h4>
      </div>

      @php
        $idorderr_hash= \Crypt::encrypt($idorderr) ; 
        @endphp

      {{-- <form  id="submit-transaksi"> --}}
        <form  method="post" action="{{ route('cs-continue-payment',$idorderr_hash) }} "  enctype="multipart/form-data">  
      @csrf 
        <div class="card-body pb-1 mb-2 cb">

              <div class="form-group">
                <div class="row">
                  <div class="col-md-3"><label for="panjang">Nama </label></div>
                  <div class="col-md-9"><input type="text" class="form-control " spellcheck="false" id="nama" name="nama" placeholder="tulis nama pelanggan" required></div>
                </div>
              </div>

             <div class="form-group">                 
              <div class="row">
                <div class="col-md-3"><label for="alamat">Alamat</label></div>
                <div class="col-md-9"> <textarea class="form-control " spellcheck="false" rows="1" spellcheck="false" id="alamat" name="alamat" placeholder="tulis alamat (opsional)" ></textarea>  </div>
              </div>
             </div>

            <div class="form-group">
              <div class="row">
                <div class="col-md-3"><label for="telepon">No Telepon</label></div>
                <div class="col-md-9"><input type="text" spellcheck="false"  class="form-control " id="telepon" name="telepon" placeholder="tulis no. telepon"  ></div>
              </div>
            </div>           
                
          </div>
 
    </div>
  </div>

  <div class="col-md-5">
    <div class="card border border-bottom-0 border-left-0 border-right-0  border-success pb-2">
      <div class="card-header border-0 text-success">
        <h4 class="card-title font-weight-bold">Informasi Tambahan </h4>
      </div>

        <div class="card-body pb-1 mb-1">

             <div class="form-group">                 
              <div class="row">
                <div class="col-md-3"><label for="catatan-transaksi">Catatan Transaksi</label></div>
                <div class="col-md-9"> <textarea class="form-control " rows="1" spellcheck="false" id="catatan-transaksi" name="catatan_transaksi" placeholder="tulis catatan (opsional)" ></textarea>  </div>
              </div>
             </div>

            <div class="form-group">
              <div class="row">
                <div class="col-md-3"><label for="tanggal_pengambilan">Waktu Pengambilan</label></div>
                <div class="col-md-9"><input type="date" class="form-control " id="tanggal_pengambilan" name="tanggal_pengambilan" required> </div>
              </div>
              <div class="row">
                <div class="col-md-3"><label for="waktu_pengambilan"></label></div>
                <div class="col-md-9"><input type="time" class="form-control " id="waktu_pengambilan" name="waktu_pengambilan" required> </div>
              </div>
            </div>           
               <input type="hidden" class="form-control " id="jumlah-total-send-to-controller" name="jumlah_total">
          </div>
      
    </div>
   </div>

   <div class="col-md-2 " >
     <button type="submit" class="btn btn-success  mb-2 font-weight-bold" style="font-size: 14px;">Continue Payment <span class="fas fa-arrow-right" ></span> </button>
     <a href="{{ route('cs-transaksi') }}" class="btn btn-outline-danger mb-3 font-weight-bold" style="font-size: 14px;"><span class="fa fa-arrow-left" ></span> Cancel Transaction</a>
   </div>
</form>
</div>





<div class="row">
  <div class="col-md-9">
        <div class="card mb-4 border border-bottom-0 border-left-0 border-right-0  border-success">
      <div class="card-header border-0 cb">
        <h3 class="card-title font-weight-bold text-success">Add Item </h3>
      </div>

      <form  id="form_add_list">

        {{-- <form  id="" action="{{ route('cs-additem',$idorderr) }}" method="post"> --}}
      @csrf 
        <div class="card-body pb-1 mb-1 cb">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="barang">Barang/product</label>
                 <select class="form-control select2" id="barang" name="id_barang" style="width: 100%;" required>
                  <option selected disabled  value="" >Choose</option>

                  @foreach($barang as $b)
                  <option value="{{$b->id}}" data-jenis="{{$b->jenis}}" data-diskon="{{$b->diskon}}" data-stok="{{$b->stok}}" data-harga="{{$b->harga}}" >{{$b->nama}}</option>
                  @endforeach

                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="panjang">Panjang</label>
                    <input type="number" min=0 class="form-control ukuran fild" id="panjang" name="panjang" placeholder="cm" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="lebar">Lebar</label>
                    <input type="number" min=0 class="form-control ukuran fild" id="lebar" name="lebar" placeholder="cm" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group" style="margin-bottom: 0px;" >
                    <label for="qty">Qty</label>
                    <input type="number" min=0 class="form-control fild" id="qty" name="qty" placeholder="" required>
                  </div>
                </div>
                <input type="hidden" id="idorder" name="idorder" value="{{$idorderr}}">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6"> </div>
            <div class="col-md-4">      
             <textarea class="form-control mt-2  mb-0" rows="1" spellcheck="false" id="catatan_item" name="catatan_item" placeholder="catatan item (opsional)"></textarea>  
            </div>
            <div class="col-md-2">
               <button type="submit" class="float-right btn  btn-success btn-block mt-2  mb-0 font-weight-bold" style="font-size: 14px;">  add List  <span style="font-size: 14px;" class="fas fa-angle-down ml-2" > </span></button>
            </div>
          </div>
        </div>
      </form>
    </div>

  </div>


  <div class="col-md-3">
    <div class="card border border-bottom-0 border-left-0 border-right-0  border-success">
      <div class="card-header border-0 cb">
        <h3 class="card-title font-weight-bold text-success">Detail Item</h3>
      </div>
        <div class="card-body pb-3 cb" id="detail-item" >
          <div class="row " style="margin-bottom: 2px;">
            <div class="col-md-6">
              <i class="detail-lable" >Stock Available :</i><br>
              <b id="detail-stok" class="data">-</b>
            </div>
            <div class="col-md-6 ">
              <i class="detail-lable " >Type Item:</i><br>
              <b id="detail-jenis" class="data">-</b>
            </div>
          </div>
          <div class="row" >
            <div class="col-md-6">
              <i class="detail-lable" >Harga :</i><br>
              <b style="font-size: 12px; " >Rp. <span style="font-size: 16px; "  id="detail-harga" class="data"> - </span> </b>
            </div>
            <div class="col-md-6 ">
              <i class="detail-lable  " >Discount :</i><br>
              <b style="font-size: 12px; "> <span style="font-size: 16px; "  id="detail-diskon" class="data"> - </span>  %</b>
            </div>
          </div>
        </div> 
        <div class="card-footer mt-0">
          <i class="detail-lable mr-3">Total Harga :</i>
            <b >Rp. <span id="harga-total" class="data" style="font-weight: bold; font-size: 20px;"  > - </span> </b>
        </div>
  </div>
</div>
</div>


  <div class="card mb-4 ">

    <div class="card-body table-responsive p-0">
      <table class="table table-hover  " id="table-item" style="font-size: 14px;">
        <thead>
          <tr>
            <th>Nama Item</th>
            <th>Ukuran (PxL)</th>
            <th>Qty</th>
            <th>Harga awal</th>
            <th>Diskon</th>
            <th style="width: 15% !important;">Harga Item</th>
            <th style="width: 11% !important;">Action</th>
          </tr>
        </thead>
        <tbody>
         
        </tbody>

      </table>
    </div>

    <div class="card-footer font-weight-bold" style="font-size: 14px;">
        <div class="row">
          <div class="col-md-9 " >Jumlah Total : </div>
          <div class="col-md-3 ">Rp. <b id="jumlah-total" class="" > </b></div>
        </div>
    </div>
  </div>






</div>
@endsection

<tr><td></td></tr>




@section('js')

{{--  --}}



<script>
  
 $(function () {
      //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

 });

//  $(function () {
//     $('.datetimepicker').datetimepicker();
// });

</script>



<script>
   
{{-- men disable field ukuran jika barang  berjenis "satuan" --}}
 $(document).on('change','#barang', function() {

  // clear data sebelumnya
   $('#harga-total').empty();
   $('#harga-total').append(" ,-");
  $('.fild').val(null);
  $('#catatan_item').val(null);
  
  var jenis = $('option:selected').attr('data-jenis');

    if (jenis === 'satuan') 
    {
       $('#panjang').prop('disabled', true);
       $('#lebar').prop('disabled', true); 
    }
    else 
    {
       $('#panjang').prop('disabled', false);
       $('#lebar').prop('disabled', false); 
    }
});


// menampilkan detail item
  $(document).on('input','#barang', function() {

    // clear data sebelumnya
    $('#detail-item .data').empty();

    var diskon = $('option:selected').attr('data-diskon');
    var harga = $('option:selected').attr('data-harga');
    var stok = $('option:selected').attr('data-stok');
    var jenis = $('option:selected').attr('data-jenis');

    $('#detail-harga').append(harga);
    $('#detail-diskon').append(diskon);
    $('#detail-stok').append(stok);
    $('#detail-jenis').append(jenis);


// menjumlahkan total harga item
    $(document).on('input','.fild', function() {

         var panjang = $('#panjang').val();
         var lebar = $('#lebar').val();
         var qty = $('#qty').val();

        $('#harga-total').empty();


        if (jenis === 'satuan')
        { 
          // get diskon
          var hargaxdiskon=harga*diskon/100;
          var jmlHarga = (harga-hargaxdiskon)*qty;
          
          // to currency format
          // var output = (jmlHarga/1000).toFixed(3);


          $('#harga-total').append(parseInt(jmlHarga));
        }

        else if (jenis === 'meteran')
        {
          // get ukuran
          var ukuran=panjang*lebar;

          // get diskon
          var hargaxdiskon=harga*diskon/100;

          // get harga setelah diskon
          var ukuranxharga = ukuran*harga-hargaxdiskon;

          // get harga total
          var jmlHarga = ukuranxharga*qty;

          // currency format
          // var output = (jmlHarga/1000).toFixed(3);

          // var output parseInt(jmlHarga);
           $('#harga-total').append(parseInt(jmlHarga));
        }
    }); 
  });

</script>

  


<script>
{{-- add list item --}}
$("#form_add_list").submit(function(event) {
  event.preventDefault();

  let no = 0;
  let id = $("#barang").val();
  let barang = $("#barang").val();
  let panjang = $("#panjang").val();
  let lebar = $("#lebar").val();
  let qty = $("#qty").val();
  let idorder = $("#idorder").val();
  let catatan_item = $("#catatan_item").val();
  let _token= $("input[name=_token]").val();

  console.log(id);

  $.ajax({
    url:"{{ url('cs/transaksi')}}"+'/'+id+'/additem',
    type:"POST",
    data:{
      id_barang:barang,
      panjang:panjang,
      lebar:lebar,
      qty:qty,
      idorder:idorder,
      catatan_item:catatan_item,
      _token:_token
    },

    success:function(response) 
    {
     
      if(response)
      {

        if(response.catatan_item==null)
        {
          $("#table-item tbody").append('<tr id="deleteitem'+response.id+'"><td>'+response.nama_barang  +'</td><td>'+response.panjang +'x'+ response.lebar  +'</td><td>'+response.qty +'</td><td>'+'Rp. '+response.harga_barang +'</td><td>'+ response.diskon_barang +' %' +'</td><td >'+'Rp. <span class="harga-item" >'+ response.harga_item +'</span></td><td>  <button  class="btn btn-sm "  onclick="deleteItem('+response.id+')"  data-token="'+_token+'" data-toggle="tooltip" data-placement="top" title="hapus item"> <span style="color: white;" class="fas fa-trash text-danger" ></span></button>   </td></tr>');
        }

        else
        {
          $("#table-item tbody").append('<tr id="deleteitem'+response.id+'"><td>'+response.nama_barang  +'</td><td>'+response.panjang +'x'+ response.lebar  +'</td><td>'+response.qty +'</td><td>'+'Rp. '+response.harga_barang +'</td><td>'+ response.diskon_barang +' %' +'</td><td >'+'Rp. <span class="harga-item" >'+ response.harga_item +'</span></td><td>  <button  class="btn btn-sm "  onclick="deleteItem('+response.id+')"  data-token="'+_token+'" data-toggle="tooltip" data-placement="top" title="hapus item"> <span style="color: white;" class="fas fa-trash text-danger" ></span></button>  <button  class="btn btn-sm "  onclick="showCatatan('+response.id+')"  data-token="'+_token+'" data-toggle="tooltip" data-placement="top" title="lihat catatan item"> <span style="color: white;" class="fas fa-sticky-note text-success" ></span></button> </td></tr>');
        }
          
          $("#form_add_list")[0].reset();
          $('#detail-item .data').empty();
          $('#harga-total').empty();

          $('#detail-item .data').prepend(" - ");
          $('#harga-total').prepend(" - ");
          // $('#barang').val(0).change();


          // menampilkan harga total
          var total = 0;
 
          $('.harga-item').each(function()
          {  
              total=total+parseInt($(this).text());
               console.log($(this).text());

                $('#jumlah-total').empty();
               $('#jumlah-total').append(total);

               // send harga total ke controller (agar tidak menghitung ulang)
                $('#jumlah-total-send-to-controller').val(null);
                $('#jumlah-total-send-to-controller').val(total);

                // $('#waktu_pengambilan').val(null);
                // $('#tanggal_pengambilan').val(null);
          });

          Toast.fire({
                     icon: 'info',
                     title: ' Satu Item berhasil ditambahkan!'
                    });

      }
    },

    error : function(response)
    {
        Toast.fire({
                   icon: 'error',
                   title: ' Stok tidak cukup! / item telah ditambahkan'
                  });

        console.log(response)
    }

  })

});

</script>


<script>
    // tampil detail catatan item
function showCatatan(id) 
{

  console.log(id);

  $.ajax({
        
        url: "{{ url('cs/transaksi/item')}}"+'/'+id+"/catatan",
        type: "GET",
        dataType: "JSON",

        success: function(data) {

         
       
       $('#cat_item').innerHTML = " ";
          $('#detail_catatan').modal('show');
          
          $('#detail_catatan #nama-item').empty();
            $('#detail_catatan #cat_item').empty();

          $('#detail_catatan #nama-item').append(data.nama_barang);
            $('#detail_catatan #cat_item').append(data.catatan_item);
        },
        error : function(){
          
           Toast.fire({
                     icon: 'error',
                     title: ' Gagal menampilkan data'
                    })
        }
      });      
  }

</script>


<script>
  
   function deleteItem(id) 
   {
      csrf_token= $('meta[name="csrf-token"]').attr('content') ;

         $.ajax({
            url:"{{ url('cs/transaksi/item') }}"+'/'+id+'/delete',
            type:"POST",
            data: {
                '_method':'DELETE',
                '_token':csrf_token 
            },


            success: function(response){

              var getId="deleteitem"+response.id;
              var itemdelete = document.getElementById(getId);
                  itemdelete.remove();

                    Toast.fire({
                        icon: 'info',
                        title: ' satu item dihapus!'
                      });

                 // menampilkan harga total
                var total = 0;
       
                $('.harga-item').each(function()
                {  
                    total=total+parseInt($(this).text());
                     console.log($(this).text());

                      $('#jumlah-total').empty();
                     $('#jumlah-total').append(total);

                     // send harga total ke controller (agar tidak menghitung ulang)
                    $('#jumlah-total-send-to-controller').val(null);
                    $('#jumlah-total-send-to-controller').val(total);
                });
                  },

                  error: function(xhr) {
                    Toast.fire({
                              icon: 'error',
                              title: ' gagal menghapus item!'
                            })
                  }

                })
   }

</script>



@endsection