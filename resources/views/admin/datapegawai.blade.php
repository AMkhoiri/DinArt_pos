@extends('admin.admin-master')

@section('title','DinArt - Data Pegawai')
@section('page-title','Data Pegawai')
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


 {{-- modal tambah pegawai --}}
   <div class="modal fade" id="modal-default" >
        <div class="modal-dialog" >
          <div class="modal-content">
            <div class="modal-header mb-2" {{-- style="background-color: #0276d7; color: white; "  --}}>
              <h5 class="modal-title font-weight-bold text-info"><span style="font-size: 16px;" class="fas fa-pencil-alt mr-2" > </span> Tambah Pegawai Baru</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body ml-2 mr-2">
              

             <form  method="post" action="{{ route('admin-tambahpegawai') }} "  enctype="multipart/form-data">  
               @csrf        

                 <div class="form-group row">
                    <label for="nama" class="col-sm-4 col-form-label text-muted">Nama Lengkap</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="nama" name="nama" spellcheck="false"  placeholder="Input nama pegawai" required>
                    </div>
                  </div>

                   <div class="form-group row">
                    <label for="nama" class="col-sm-4 col-form-label text-muted">Jenis Kelamin</label>
                    <div class="col-sm-8">
                       <select class="form-control" id="jk" name="jk" required>
                          <option  value="" >Pilih </option>
                          <option value="laki-laki" >Laki-laki</option>
                          <option value="perempuan" >Perempuan</option> 

                        </select>  
                    </div>
                  </div>

                 <div class="form-group row">
                    <label for="nama" class="col-sm-4 col-form-label text-muted">Alamat</label>
                    <div class="col-sm-8">
                      {{-- <input type="text" class="form-control" id="alamat" name="alamat" spellcheck="false"  placeholder="Input nama barang" required> --}}
                      <textarea class="form-control" rows="3" spellcheck="false" id="alamat" name="alamat" placeholder="Tulis alamat"></textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="nama" class="col-sm-4 col-form-label text-muted">Telepon</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="telepon" name="telepon" spellcheck="false"  placeholder="Tulis nomor telepon" required>
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

{{-- /modal tambah pegawai --}}





 {{-- modal edit pegawai --}}
   <div class="modal fade" id="editModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header mb-3" {{-- style="background-color: #0276d7; color: white; "  --}}>
              <h5 class="modal-title font-weight-bold text-info"><span style="font-size: 16px;" class="fas fa-edit mr-2" > </span> Edit Data Pegawai</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body ml-3 mr-3">
              

             <form  method="post" action=" "  enctype="multipart/form-data">  
               @csrf        

                 <div class="form-group row">
                    <label for="nama" class="col-sm-4 col-form-label text-muted">Nama Lengkap</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="editnama" name="nama" spellcheck="false"  placeholder="Input nama pegawai" required>
                    </div>
                  </div>

                   <div class="form-group row">
                    <label for="nama" class="col-sm-4 col-form-label text-muted">Jenis Kelamin</label>
                    <div class="col-sm-8">
                       <select class="form-control" id="editjk" name="jk" required>
                          <option  value="" >Pilih </option>
                          <option value="laki-laki" >Laki-laki</option>
                          <option value="perempuan" >Perempuan</option> 

                        </select>  
                    </div>
                  </div>

                 <div class="form-group row">
                    <label for="nama" class="col-sm-4 col-form-label text-muted">Alamat</label>
                    <div class="col-sm-8">
                      {{-- <input type="text" class="form-control" id="alamat" name="alamat" spellcheck="false"  placeholder="Input nama barang" required> --}}
                      <textarea class="form-control" rows="3" spellcheck="false" id="editalamat" name="alamat" placeholder="Tulis alamat"></textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="nama" class="col-sm-4 col-form-label text-muted">Telepon</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="edittelepon" name="telepon" spellcheck="false"  placeholder="Tulis nomor telepon" required>
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




{{-- modal register pegawai--}}
   <div class="modal border-0 fade"  id="registerModal">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header mb-3 text-success" >
              <h5 class="modal-title font-weight-bold"><span style="font-size: 16px;" class=" fas fa-user-cog mr-2" > </span> Registrasi Pegawai <span > </span> </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body ml-2 mr-2">
              

             <form  method="post" action="{{ route('admin-register-pegawai') }} "  enctype="multipart/form-data">  
               @csrf        

                  <input type="hidden" name="idpegawai" id="idpegawai">
                  <div class="form-group">
                  
                      <input type="text" class="form-control" id="namapegawai"  spellcheck="false"   disabled="true">
                  </div>
                 <div class="form-group">
                      <input type="text" class="form-control" id="username" name="username" spellcheck="false"  placeholder="Username" required>
                  </div>

                  <div class="form-group">
                      <input type="password" class="form-control" id="password" name="password" spellcheck="false"  placeholder="Password" required>
                  </div>
                  <div class="form-group">
                      <input type="password" class="form-control" id="confirmpass" name="password_confirm" spellcheck="false" oninput="check(this)"  placeholder="Confirm Password" required>
                  </div>

                            <script language='javascript' type='text/javascript'>
                                function check(input) {
                                    if (input.value != document.getElementById('password').value) {
                                        input.setCustomValidity('Password yang anda masukkan tidak sama!');
                                    } else {
                                        // input is valid -- reset the error message
                                        input.setCustomValidity('');
                                    }
                                }
                            </script>

                  <div class="form-group ">           
                        <select class="form-control" id="role" name="role" required>
                          <option  value="">pilih role user</option>
                          <option value="admin" >admin</option>
                          <option value="cs" >cs</option> 
                            <option value="produksi" >produksi</option> 
                        </select>  
                  </div>

                  <div class="form-group ">           
                        <select class="form-control" id="id_box" name="id_box" disabled>
                          <option  value="">pilih box</option>
                          @foreach($box as $b)
                          <option value="{{$b->id}}" >{{$b->kode_box}} </option>
                          @endforeach
                        </select>  
                  </div>

            <div class="modal-footer justify-content-right">
                <button type="submit" class="btn btn-sm btn-success">Simpan</button>
              <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
            
            </div>
          </form>


          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
    </div>

{{-- /modal register pegawai --}}

  <div class="card border border-bottom-0 border-left-0 border-right-0  border-info">
    <div class="card-header  border-0">
      <h3 class="card-title font-weight-bold text-info">DATA PEGAWAI</h3>

      <div class="card-tools">
      	<button class="btn  font-weight-bold bg-gradient-info pr-3 pl-3 mr-3" style="font-size: 13px;" data-toggle="modal" data-target="#modal-default" > <span class="fa fa-plus" ></span> Tambah Pegawai </button>

    </div>
	 </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
      <table class="table table-hover text-nowrap" style="font-size: 13px;">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama</th>
             <th>Janis Kelamin</th>
            <th>Alamat</th>
            <th>Telepon</th>
            <th>Di-Registrasi?</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        	<?php $no = 0;?>
    @foreach($pegawai as $p)
      <?php $no++ ;?>
          <tr>
            <td>{{$no}} </td>
            <td>{{$p->nama}}  </td>
            <td>{{$p->jenis_kelamin}}	</td>
            <td>{{$p->alamat}}	</td>
            <td>{{$p->telepon}}	</td>
            <td class="text-center pr-4">
              @if ($p->status_akun=="registered" )
                <i class="fas fa-check text-success " style="font-size: 18px;" > </i>
              @endif

            </td>
            <td class="text-right" >	
            	<button class="btn btn-sm btn-info btnn"data-toggle="tooltip" onclick="editForm({{$p->id}})" data-placement="top" title="Edit Pegawai" ><span class="fas fa-edit" > </span> </button>

            	 

               @if ($p->status_akun=="registered" )
                <button class="btn btn-sm btn-danger btnn " disabled="true"> <span class="fas fa-trash" ></span></button>

               <button class="btn btn-sm btn-success btnn" disabled="true" > <span class="fas fa-user-cog" ></span> Create account</button>
               @else
                <button onclick="" class="btn btn-sm btn-danger btnn btn-delete"  data-toggle="tooltip" data-placement="top" title="Hapus Pegawai" data-token="{{ csrf_token() }}" nama="{{$p->nama}}" id="{{$p->id}}" > <span class="fas fa-trash" ></span></button>

               <button class="btn btn-sm btn-success btnn" onclick="registerForm({{$p->id}})" data-toggle="tooltip" data-placement="top" title="Create user account" > <span class="fas fa-user-cog" ></span> Create account</button>
               @endif

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


{{-- see password register --}}
<script>
  function seePassword() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>






{{-- modal --}}
<script>

  // tampil modal edit
    function editForm(id) 

    {
      $('#editModal form')[0].reset();
      $.ajax({
        url: "{{ url('admin/datapegawai')}}"+'/'+id+"/edit",
        type: "GET",
        dataType: "JSON",

        success: function(data) {

        	console.log(data);
          
          $('#editModal').modal('show');

          $('#id').val(data.id);
          $('#editnama').val(data.nama);
          $('#editjk').val(data.jenis_kelamin);
          $('#edittelepon').val(data.telepon);
          $('#editalamat').val(data.alamat);
         
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
                        url : "{{ url('admin/datapegawai')}}"+'/'+id+'/update',
                        type : "PUT",
                        data : $('#editModal form').serialize(),
                        success : function($data) {
                            window.location.href = "{{ url('admin/datapegawai') }}"

                              Toast.fire({
                                   icon: 'success',
                                   title: 'Berhasil mengedit data pegawai!'
                                  })
                        },
                        error : function(){

                              Toast.fire({
                                   icon: 'error',
                                   title: 'Gagal mengedit data pegawai!'
                                  })
                        }
                    });
                    return false;
                }
            });
        });

// .............



// tampil modaal register
    function registerForm(id) 

    {
      $('#registerModal form')[0].reset();
      $.ajax({
        url: "{{ url('admin/datapegawai')}}"+'/'+id+"/register",
        type: "GET",
        dataType: "JSON",

        success: function(data) {

          console.log(data.id);
          
          $('#registerModal').modal('show');

          $('#idpegawai').val(data.id);
          $('#namapegawai').val(data.nama);
         
        },
        error : function(){
          alert("nothing data");
        }
      });
    }
// ........

 

// mmengaktifkan field "box" jika role yang dipilih adalah "cs". gooodddd.

$('#role').on('change', function() {
    
    var role = $(this).val();

    if (role == "cs") {
      console.log(role);
      $('#id_box').removeAttr( "disabled");
       $('#id_box').prop('required',true);
    } 

    else {
      console.log(role);
      $('#id_box').prop('disabled', true); 
    }

});

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
        text: 'Anda yakin untuk menghapus data pegawai ini ?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
      
      if (result.value) {  

        window.location.href = "{{ url('admin/datapegawai') }}"+'/'+id+'/delete'
          
      }
  })

});

</script>




@endsection