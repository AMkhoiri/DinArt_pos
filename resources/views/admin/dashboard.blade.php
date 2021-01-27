@extends('admin.admin-master')


@php

use App\orders_report;

@endphp

@section('title','DinArt - Dashboard')
@section('page-title','Welcome To DinArt App')
@section('breadcrumb','Dashboard')

@section('content')

<div class="container-fluid">
    <div class="card">
    	<div class="row pl-3 pr-3 pt-2 pb-2">
    		<div class="col-md-6"><span style="font-size: 16px;" class="m-0 text-muted font-weight-bold">Dashboard</span></div>
    		<div class="col-md-6 text-right text-muted" style="font-size: 14px;">
    			Data Real Time / {{carbon\carbon::now()->format('d F Y')}} 
    		</div>
    	</div>
    </div>
</div>

	
<div class="container-fluid pl-2 pr-2">


      <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{$orders_count}}</h3>

                <p>Transaksi Selesai</p>
              </div>
              <div class="icon">
                <i class="fas fa-shopping-cart"></i>
              </div>
              <a href="{{ route('admin-newtransaksi') }}" class="small-box-footer">Transaksi baru <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$produksi_count}} </h3>

                <p>Produksi Selesai</p>
              </div>
              <div class="icon">
                <i class="fas fa-print"></i>
              </div>
              <a href="{{ route('admin-produksi') }}" class="small-box-footer">Lihat detail <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning" style="color: white !important;">
              <div class="inner">
                <h3>{{$barang_sale}} </h3>

                <p>Product On Sale</p>
              </div>
              <div class="icon">
                <i class="fa fa-tags"></i>
              </div>
              <a href="{{ route('admin-databarang') }} " class="small-box-footer" style="color: white !important;">Lihat detail <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{$user_count}}</h3>

                <p>User Registered</p>
              </div>
              <div class="icon">
                <i class="fas fa-users"></i>
              </div>
              <a href="{{ route('admin-datauser') }} " class="small-box-footer">Lihat detail <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->




        <div class="row" style="font-size: 15px !important;">
        	<div class="col-lg-6">
        		
        	<div class="card">
              <div class="card-header border-0">
                <h3 class="card-title">Produk Terlaris</h3>
                <div class="card-tools">
                  <a href="#" class="btn btn-tool btn-sm">
                    <i class="fas fa-download"></i>
                  </a>
                  <a href="#" class="btn btn-tool btn-sm">
                    <i class="fas fa-bars"></i>
                  </a>
                </div>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-striped table-valign-middle">
                  <thead>
                  <tr>
                  	<th>Rank</th>
                    <th>Nama Product</th>
                    <th>Harga</th>
                    <th>Terjual</th>
                    
                  </tr>
                  </thead>
                  <tbody>
                  		<?php $no = 0;?>
                  	@foreach ($peringkat_product as $pp)
                  		<?php $no++ ;?>
                  <tr>
                    <td>
                       {{$no}}
                    </td>
                    <td>{{$pp->nama}} </td>
                    <td> Rp. 
                      {{$pp->harga}}
                    </td>
                      <td class=" font-weight-bold">
                      {{$pp->terjual}}
                    </td>
                  </tr>
                  	@endforeach
                 
                  </tbody>
                </table>
              </div>
            </div>
            <!-- /.card -->

        	</div>
        	<div class="col-lg-6">
        		<div class="card {{-- border --}} border-right-0 border-left-0 border-bottom-0 border-secondary">
              <div class="card-header border-0">
                <h3 class="card-title">Penjualan per box (bulan ini)</h3>
                <div class="card-tools">
                  <a href="#" class="btn btn-tool btn-sm">
                    <i class="fas fa-download"></i>
                  </a>
                  <a href="#" class="btn btn-tool btn-sm">
                    <i class="fas fa-bars"></i>
                  </a>
                </div>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-striped table-valign-middle">
                  <thead>
                  <tr>
                  	<th>No</th>
                    <th>Kode Box</th>
                    <th>Jumlah Transaksi</th>
                    <th>Pendapatan</th>
                    
                  </tr>
                  </thead>
                  <tbody>
                 		<?php $no = 0;?>
                  	@foreach ($peringkat_box as $pb)
                  		<?php $no++ ;?>
                  <tr>
                    <td>
                      {{$no}}
                    </td>
                    <td>{{$pb->kode_box}} </td>
                    <td>
                    	@php 
                    		$jumlah_transaksi=orders_report::where('id_box',$pb->id)->count();
                    	@endphp

                    	{{$jumlah_transaksi}}
                    </td>
                    <td class=" font-weight-bold">
                      @php
                      	$transaksi=orders_report::where('id_box',$pb->id)->get();
                      	$total_pendapatan=$transaksi->sum('harga_total');

                        $hasil_rupiah = number_format($total_pendapatan,2,',','.');
                      @endphp

                     {{-- <span class="fas fa-money-bill-alt text-success mr-2 " > </span  > --}}Rp.  {{$hasil_rupiah}}
                    </td>
                  </tr>
                  	@endforeach
                 
                  </tbody>
                </table>
              </div>
            </div>
            <!-- /.card -->

        	</div>


        </div>


</div>
	
@endsection

@section('js')


@endsection	