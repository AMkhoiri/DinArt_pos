@extends('admin.admin-master')

@section('title','DinArt - Data Box')
@section('page-title','Data Box')
{{-- @section('breadcrumb','Data Barang') --}}
@section('css')

<style>

 .btnn{
      font-size: 11px;
    }

    .card-title {
  font-size: 16px;
}

.border{
  border-width:3px !important;
}

    textarea { font-size: 13px !important; }
    input{ font-size: 13px !important; }
    select { font-size: 13px !important; }
</style>
  

@endsection

@section('content')



{{-- modal tambah box --}}
   <div class="modal fade" id="modal-default" >
        <div class="modal-dialog" >
          <div class="modal-content">
            <div class="modal-header mb-2">
              <h5 class="modal-title font-weight-bold text-info"><span style="font-size: 16px;" class="fas fa-pencil-alt" > </span> Tambah Box Baru</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body ml-2 mr-2">
              

             <form  method="post" action="{{ route('admin-tambahbox') }} "  enctype="multipart/form-data">  
               @csrf        

                 <div class="form-group row">
                    <label for="kode" class="col-sm-4 col-form-label text-muted">Kode Box</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="kode" name="kode_box" spellcheck="false"  placeholder="tulis kode box" required>
                    </div>
                  </div>


                 <div class="form-group row">
                    <label for="lokasi" class="col-sm-4 col-form-label text-muted">Lokasi Box</label>
                    <div class="col-sm-8">
                      <textarea class="form-control" rows="3" spellcheck="false" id="lokasi" name="lokasi" placeholder="tulis lokasi"></textarea>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="keterangan" class="col-sm-4 col-form-label text-muted">Keterangan</label>
                    <div class="col-sm-8">
                      <textarea class="form-control" rows="3" spellcheck="false" id="keterangan" name="keterangan" placeholder="tulis keterangan"></textarea>
                    </div>
                  </div>


            
            <div class="modal-footer justify-content-right">
                <button type="submit" class="btn btn-sm btn-info">Simpan</button>
              <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
            
            </div>
          </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
    </div>

{{-- /modal tambah box --}}





 {{-- modal edit pegawai --}}
   <div class="modal fade" id="editModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header mb-3">
              <h5 class="modal-title font-weight-bold text-info"><span style="font-size: 16px;" class="fas fa-edit" > </span> Edit Data Box</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body ml-3 mr-3">
              

             <form  method="post" action=" "  enctype="multipart/form-data">  
               @csrf        

                   <div class="form-group row">
                    <label for="kode" class="col-sm-4 col-form-label text-muted">Kode Box</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="editkode" name="kode_box" spellcheck="false"  placeholder="tulis kode box" required>
                    </div>
                  </div>


                 <div class="form-group row">
                    <label for="lokasi" class="col-sm-4 col-form-label text-muted">Lokasi Box</label>
                    <div class="col-sm-8">
                      <textarea class="form-control" rows="3" spellcheck="false" id="editlokasi" name="lokasi" placeholder="tulis lokasi"></textarea>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="keterangan" class="col-sm-4 col-form-label text-muted">Keterangan</label>
                    <div class="col-sm-8">
                      <textarea class="form-control" rows="3" spellcheck="false" id="editketerangan" name="keterangan" placeholder="tulis keterangan"></textarea>
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

{{-- /modal edit pegawai--}}



{{-- tabel data box --}}
    <div class="card border border-bottom-0 border-left-0 border-right-0  border-info">
      <div class="card-header border-0">
        <h3 class="card-title font-weight-bold text-info">DATA BOX/STAND</h3>

        <div class="card-tools">
        	<button class="btn btn-sm font-weight-bold bg-gradient-info pr-4 pl-4 " style="font-size: 13px;" data-toggle="modal" data-target="#modal-default" > <span class="fa fa-plus" ></span> Tambah Box  </button>

      </div>
 	 </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap" style="font-size: 13px;">
          <thead>
            <tr>
              <th>No</th>
              <th>Kode Box</th>
               <th>Lokasi Box</th>
              <th>Keterangan</th>

              <th>Action</th>
            </tr>
          </thead>
          <tbody>
          	<?php $no = 0;?>
          @foreach($box as $b)
            <?php $no++ ;?>
            <tr>
              <td>{{$no}} </td>
              <td><b>{{$b->kode_box}}</b>   </td>
              <td>{{$b->lokasi}}	</td>
              <td>{{$b->keterangan}}	</td>


              <td >	
              	<button class="btn btn-sm btn-info btnn"data-toggle="tooltip" onclick="editForm({{$b->id}})" data-placement="top" title="Edit Box" > 
              		<span class="fas fa-edit" > </span> 
              	</button>

              	 <button onclick="" class="btn btn-sm btn-danger btnn btn-delete"  data-toggle="tooltip" data-placement="top" title="Hapus Box" data-token="{{ csrf_token() }}" nama="{{$b->kode_box}}" id="{{$b->id}}" > <span class="fas fa-trash" ></span></button>

              </td>
            </tr>

            @endforeach
           
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>


@endsection








@section('js')

{{-- modal --}}
<script>

  // tampil modal edit
    function editForm(id) 

    {
      $('#editModal form')[0].reset();
      $.ajax({
        url: "{{ url('admin/databox')}}"+'/'+id+"/edit",
        type: "GET",
        dataType: "JSON",

        success: function(data) {

        	console.log(data);
          
          $('#editModal').modal('show');

          $('#id').val(data.id);
          $('#editkode').val(data.kode_box);
          $('#editlokasi').val(data.lokasi);
          $('#editketerangan').val(data.keterangan);
         
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
                    console.log(id);
                  
                    $.ajax({
                        url : "{{ url('admin/databox')}}"+'/'+id+'/update',
                        type : "PUT",
                        data : $('#editModal form').serialize(),
                        success : function($data) {
                            window.location.href = "{{ url('admin/databox') }}"

                              Toast.fire({
                                   icon: 'success',
                                   title: 'Berhasil mengedit data box!'
                                  })
                        },
                        error : function(){

                              Toast.fire({
                                   icon: 'error',
                                   title: 'Gagal mengedit data box!'
                                  })
                               $('#editModal').modal('hide');
                        }
                    });
                    return false;
                }
            });
        });

// .............
</script>



<script>

// sweetalert delete confirmation

$('body').on('click', '.btn-delete', function(event) {
  event.preventDefault();

  var me = $(this),
      title=me.attr('nama'),
      id=me.attr('id'),
      csrf_token= $('meta[name="csrf-token"]').attr('content') ;

  Swal.fire({
        title:' '+ title,
        text: 'Anda yakin untuk menghapus data Box ini ?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
      
      if (result.value) {  

        window.location.href = "{{ url('admin/databox') }}"+'/'+id+'/delete'
          
      }
  })

});

</script>









@endsection