@extends('admin.admin-master')

@section('title','DinArt - Data Users')
@section('page-title','Data Users')

@section('css')

<style>
	 .btnn{
      font-size: 11px;
    }

    .card-title {
  font-size: 16px;
}

    /*.hidetext { -webkit-text-security: none; }*/
.hidetext { -webkit-text-security: circle; }
/*.hidetext { -webkit-text-security: square; }*/

 input{ font-size: 13px !important; }

 .border{
  border-width:3px !important;
}
</style>

@endsection


@section('content')






{{-- modal register pegawai--}}
   <div class="modal border-0 fade"  id="editUserModal">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header mb-3 text-info" >
              <h5 class="modal-title font-weight-bold"><span style="font-size: 16px;" class=" fas fa-user-cog mr-2" > </span> Edit Account <span > </span> </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body ml-2 mr-2">
              

             <form  method="post" action="{{ route('admin-user-update') }} "  enctype="multipart/form-data">  
               @csrf        

                  <input type="hidden" name="id_user" id="id_user">
                  <div class="form-group">
                      <input type="text" class="form-control" id="namapegawai"  spellcheck="false"   disabled="true">
                  </div>
                  <div class="form-group">
                      <input type="password" class="form-control" id="old_password" name="old_password" spellcheck="false"  placeholder="Old Password" required>
                  </div>


                 <div class="form-group">
                      <input type="text" class="form-control" id="username" name="username" spellcheck="false"  placeholder="New Username" required>
                  </div>
                  <div class="form-group">
                      <input type="password" class="form-control" id="password" name="password" spellcheck="false"  placeholder="New Password" required>
                  </div>
                  <div class="form-group">
                      <input type="password" class="form-control" id="confirmpass" name="password_confirm" spellcheck="false" oninput="check(this)"  placeholder="Confirm New Password" required>
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

{{-- /modal register pegawai --}}






<div class="card border border-bottom-0 border-left-0 border-right-0  border-info">
  <div class="card-header border-0">
    <h3 class="card-title font-weight-bold text-info">DATA USERS</h3>

    <div class="card-tools">
    	{{-- <button class="btn btn-sm bg-gradient-primary" style="font-size: 13px;" data-toggle="modal" data-target="#modal-default" > <span class="fa fa-plus" ></span> Tambah Pegawai </button>
 --}}
  </div>
	 </div>
  <!-- /.card-header -->
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap" style="font-size: 13px;">
      <thead>
        <tr>
          <th>No</th>
          <th>Lokasi Box (kode)</th>
          <th>Nama</th>
           <th>Username</th>
          <th>Password</th>
          <th>Role</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
      	<?php $no = 0;?>
      @foreach($user as $u)
        <?php $no++ ;?>
        <tr>
          <td>{{$no}} </td>
          <td>{{$u->kode_box}}  </td>
          <td>{{$u->nama}}  </td>
          <td>	{{$u->username}}  </td>
          <td>
          	{{-- @if ($u->role =="admin")
          		<span class="fas fa-eye-slash" ></span>
          	@else
          		  {{$u->pass}} 
          	@endif --}}

            <input type="password" value="{{$u->pass}}"  class="border-0" id="pass{{$u->id}}" disabled>
          
       	  </td>
          <td> {{$u->role}}  </td>

          <td>
          <button class="btn btn-sm btn-warning btnn"data-toggle="tooltip" style="color: white;" onclick="seePassword({{$u->id}})" data-placement="top" id="sh{{$u->id}}" title="See password" ><span id="seepass{{$u->id}}" class="fas fa-eye" > </span> </button>

          <button class="btn btn-sm btn-info btnn" onclick="editUser({{$u->id}})"><span class="fas fa-user-cog"  ></span> Edit Account </button>

          {{-- <a href="{{ route('admin-user-edit',$u->id) }}" class="btn btn-sm btn-info btnn" ><span class="fas fa-user-cog"  ></span> Edit Account </a> --}}

          	<button class="btn btn-sm btn-danger btnn btn-delete"data-toggle="tooltip" onclick="" data-placement="top" title="Hapus User" data-token="{{ csrf_token() }}" nama="{{$u->nama}}" id="{{$u->id}}"><span class="fas fa-trash" > </span> </button>

          	 
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

<script>

// sweetalert delete confirmation

$('body').on('click', '.btn-delete', function(event) {
  event.preventDefault();

  var me = $(this),
      title=me.attr('nama'),
      id=me.attr('id'),
      csrf_token= $('meta[name="csrf-token"]').attr('content') ;

  Swal.fire({
        title:'Anda yakin untuk menghapus '+ title+' ?',
        text: 'pastikan transaksi/produksi yang melibatkan user ini telah selesai!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
      
      if (result.value) {  

        window.location.href = "{{ url('admin/datauser') }}"+'/'+id+'/delete'
          
      }
  })

});

</script>


{{-- see password --}}

<script>
  
 function seePassword(id)
 {
  // alert($('#pass'+id));
  if ( $('#pass'+id).attr('type')=="password") 
  {
    $('#pass'+id).prop('type', 'text');

    $('#seepass'+id).removeClass('fa-eye');
    $('#seepass'+id).addClass('fa-eye-slash');

    $('#sh'+id).prop('title', 'Hide Password');
  }
  else
  {
    $('#pass'+id).prop('type', 'password');

    $('#seepass'+id).removeClass('fa-eye-slash');
    $('#seepass'+id).addClass('fa-eye');

     $('#sh'+id).prop('title', 'See Password');
  }
  
 }


</script>



<script>
  
    // tampil modal edit
    function editUser(id) 

    {
      $('#editUserModal form')[0].reset();
      $.ajax({
        url: "{{ url('admin/datauser')}}"+'/'+id+"/edit",
        type: "GET",
        dataType: "JSON",

        success: function(data) {

          console.log(data);
          
          $('#editUserModal').modal('show');

          $('#id_user').val(data.id);
          $('#namapegawai').val(data.name);
          
         
        },
        error : function(){
          alert("nothing data");
        }
      });
    }
// ........



</script>

@endsection