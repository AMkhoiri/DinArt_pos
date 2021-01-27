<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Auth;
Use Exception;
Use Alert;
use Crypt;

Use \Carbon\Carbon;

use\App\box;
use\App\pegawai;
use\App\user;
use\App\barang;
use\App\orders;
use\App\order_item;
use\App\pelanggan;
use\App\orders_report;
use\App\order_item_report;

class csController extends Controller
{
   

//fungsi transaksi............................................................................................................................

    public function dataTransaksi()
    {
        // menghapus data transaksi yang tidak tuntas dan mengmbalikan stok barang
        $order_not_submited=orders::where('status_order',null)->where('nama_cs',Auth::user()->name)->get();

        foreach ($order_not_submited as $ord) 
        {
            $order_item=order_item::where('id_order',$ord->id)->get();

            foreach ($order_item as $oi)
            {
                // mengembalikan stok barang
                $barang=barang::find($oi->id_barang);
                $stokbarang=$barang->stok;
                if ($barang->jenis=="satuan") 
                {
                    $barang->stok=$stokbarang+$oi->qty;
                    $barang->save();
                }

                $oi->delete();
            }
            $ord->delete();
        }


        $order = DB::table( 'pelanggan')
             ->rightjoin ('orders' , 'orders.id', '=' , 'pelanggan.id_order')
             ->where('orders.id_box', Auth::user()->id_box)
             ->where('status_order','!=',null)
             ->select('pelanggan.nama', 'orders.*')
             ->orderBy('status_order','desc')
             ->orderBy('created_at','asc')
             ->get();
             // dd($order);

   $order_aktif=orders::where('status_order','!=','selesai')->where('id_box',Auth::user()->id_box)->count(); 
   $order_selesai=orders::where('status_order','=','selesai')->where('id_box',Auth::user()->id_box)->count();
        $jumlah_order=count($order);     
            
        return view('cs.transaksi',['order'=>$order, 'order_aktif'=>$order_aktif,'order_selesai'=>$order_selesai,'jumlah_order'=>$jumlah_order]);
    }

  
    public function buatTransaksi()
    {
        // $pegawai_id=Auth::user()->id_pegawai;

        // cari nama cs
        // $pegawai=pegawai::find($pegawai_id);
        $nama_cs=Auth::user()->name;


        // cari id box
        $box=box::find(Auth::user()->id_box);
        $id_box=$box->id;

        // mendapatkan telepon cs
        $pegawai=pegawai::find(Auth::user()->id_pegawai);
        $telepon_cs=$pegawai->telepon;

        // untuk menampilkan kode box
        $kode_box=$box->kode_box;

        // create transaksi
        $order= new orders;
        $order->nama_cs=$nama_cs;
        $order->id_box=$id_box;
        $order->telepon_cs=$telepon_cs; 
        $order->save();

        $waktu_transaksi=$order->created_at;

        // menampilkan data barang di select dropdown
        $barang=barang::where('status','on sale')->get();

        // get idorder
        $idorderr=$order->id;

        // get item list berdasarkan id_order
         $item=order_item::where('id_order',$order->id)->get();
        
        return view('cs.newtransaksi',['barang'=>$barang, 'nama_cs'=>$nama_cs, 'kode_box'=>$kode_box,'waktu_transaksi'=> $waktu_transaksi,'item'=>$item,'idorderr'=>$idorderr]); 
    }


    public function addItem(Request $request )
    {
        // mencegah menambahkan item dengan  barang yang sama 
        $item_sama=order_item::where('id_order',$request->idorder)
                                ->where('id_barang',$request->id_barang)
                                ->get();

        // mencari data barang
        $barang=barang::find($request->id_barang);

        // mencegah agar item berjenis "satuan" tidak di input 2 kali 
        if ($item_sama->isEmpty() || $barang->jenis=="meteran") 
        {
            // mengisi panjang lebar
            if ($barang->jenis=="satuan") 
            {   
                // cek stok
                if ($request->qty <= $barang->stok) 
                {
                    // add item baru
                    $item= new order_item;
                    $item->id_order=$request->idorder;
                    $item->id_barang=$request->id_barang;
                    $item->nama_barang=$barang->nama;
                    $item->harga_barang=$barang->harga;
                    $item->diskon_barang=$barang->diskon;
                    $item->qty=$request->qty;
                    $item->catatan_item=$request->catatan_item;

                    $item->panjang=0;
                    $item->lebar=0;

                    // mengurangi stok barang
                    $stokbarang=$barang->stok;
                    $barang->stok=$stokbarang-$request->qty;
                    $barang->save();
                }
                else{    } 
            }
            else
            {
                    // add item baru
                    $item= new order_item;
                    $item->id_order=$request->idorder;
                    $item->id_barang=$request->id_barang;
                    $item->nama_barang=$barang->nama;
                    $item->harga_barang=$barang->harga;
                    $item->diskon_barang=$barang->diskon;
                    $item->qty=$request->qty;
                    $item->catatan_item=$request->catatan_item;
                    
                    $item->panjang=$request->panjang;
                    $item->lebar=$request->lebar;
            }

            // perhitungan jumlah harga
            if ($barang->jenis == 'satuan')
            { 
              // get diskon
              $hargaxdiskon=$barang->harga*$barang->diskon/100;
              // jumlah harga
              $jmlHarga = ($barang->harga-$hargaxdiskon)*$request->qty;
              
              // memasukkan ke database
              $item->harga_item=$jmlHarga;
            }

            else if ($barang->jenis == 'meteran')
            {
              // get ukuran
              $ukuran=$request->panjang*$request->lebar;

              // get diskon
              $hargaxdiskon=$barang->harga*$barang->diskon/100;

              // get harga setelah diskon
              $ukuranxharga = $ukuran*$barang->harga-$hargaxdiskon;

              // get harga total
              $jmlHarga = $ukuranxharga*$request->qty;

              // memasukkan ke database
              $item->harga_item=intval($jmlHarga);
            }
            else{}

            $item->save();

            // dd($item);
            // // mengubah status order agar tidak terhapus otomatis saat load data transaksi
            // $order_status=orders::find($request->idorder);
            // $order_status->status_order="valid";
            // $order_status->save();

            return response()->json($item);
        }

        else 
        {
            // ini untuk response error nya
            return response()->json($item);
        }
    }


    public function showCatatanItem($id)
    {
        $item=order_item::find($id);
        return $item;
    }


    public function deleteItem($id)
    {
        $item=order_item::find($id);
        $itemtoreturn=$item;
        $item->delete();

        // mengembalikan stok barang
        $barang=barang::find($item->id_barang);
        $stokbarang=$barang->stok;
        if ($barang->jenis=="satuan") 
        {
            $barang->stok=$stokbarang+$itemtoreturn->qty;
            $barang->save();
        }
       

         return response()->json($itemtoreturn);
    }

    public function submitTransaksi(Request $request, $idd)
    {
        // dd($request);
        $id=Crypt::decrypt($idd);  //decrypt id

        $order=orders::find($id);

        // cek apakah tidak ada item pada orderan
        $cek_item=order_item::where('id_order', $order->id)->first();
        if (!$cek_item) {
           alert()->error('Hmmm...', 'Tidak ada item yang di-order');
            return redirect('/cs/transaksi');
        }

        $order->catatan=$request->catatan_transaksi;
        $order->waktu_pengambilan=$request->waktu_pengambilan;
        $order->tanggal_pengambilan=$request->tanggal_pengambilan;
        $order->harga_total=$request->jumlah_total;
        $order->tagihan=$request->jumlah_total;
        $order->dp=0;
        $order->status_order="submited";

        $box=box::find($order->id_box);
        $kode_box=$box->kode_box;



        // menghitung data order yang diinput hari ini
        $nr = orders::whereRaw('DATE(created_at) = CURDATE()')
                    // ->where('status_order','!=',null)
                    ->count('created_at');
        
        $no_urut=$nr+1;
        // tidak bisa karena nanti data akan bentrok ketika ada transaksi yang dibukukan
        // dd($no_urut);



        $year=\Carbon\Carbon::parse ($order->created_at)->format('y');
        $mount=\Carbon\Carbon::parse ($order->created_at)->format('m');
        $day=\Carbon\Carbon::parse ($order->created_at)->format('d');
        
        $order->kode_transaksi="DA".$kode_box.$year.$mount.$day.$order->id;
        // dd($order->kode_transaksi);

        // cek untuk mencegah resubmit data yang sama dengan sebelumnya
        $cek_order=orders::where('kode_transaksi',$order->kode_transaksi)->first();
        if ($cek_order) 
        {
            // Alert::alert('Tidak dapat me-refresh data', 'Silahkan mengakses melalui "Data Transaksi"', 'error');
            alert()->error('Tidak dapat me-refresh data', 'Silahkan mengakses melalui "Data Transaksi"');
            return redirect('/cs/transaksi');
        }
        else

        $order->save();

        $pelanggan= new pelanggan;
        $pelanggan->id_order=$id;
        $pelanggan->nama=$request->nama;
        $pelanggan->alamat=$request->alamat;
        $pelanggan->telepon=$request->telepon;
        $pelanggan->save();

        

        $order_item=order_item::where('id_order',$id)->get();

        Alert::toast('Data transaksi tersimpan! Silahkan Isi pembayaran', 'success')->width(350);
        return view("cs.newtransaksi-pembayaran",['order'=>$order,'kode_box'=>$kode_box, 'pelanggan'=>$pelanggan, 'order_item'=>$order_item] );
    }

    public function submitPembayaran(Request $request, $idd)
    {
        $id=Crypt::decrypt($idd);  //decrypt id

        $order=orders::find($id);

        if($request->bayar_dp !== null) {
            $order->dp = $request->bayar_dp;
            $order->status_pembayaran="DP";

            // mengupdate taguhan setelah di dp
            $tagihan=$order->tagihan-$order->dp;
            $order->tagihan=$tagihan;
            $order->save();

                alert()->info('DP Transaksi Berhasil', 'Anda dapat melanjutkan untuk mengirim ke produksi');
                // Alert::alert('DP Transaksi Berhasil', 'Anda dapat melanjutkan untuk mengirim ke produksi', 'info');
               $id_to_send=Crypt::encrypt($order->id);
                return redirect('/cs/transaksi/'.$id_to_send.'/form-produksi');
            
        }
        elseif($request->bayar_lunas !== null) {

            $order->bayar=$request->bayar_lunas;
            $order->status_pembayaran="paid";
            
        
            // menghitung kembalian
            $kembalian=$request->bayar_lunas-$order->tagihan;
            $order->kembalian=$kembalian;

            $order->tagihan=0;
            $order->save();
            // dd( $order);

            if ($order->status_produksi=="done") 
            {
                // Alert::alert('Transaksi Dilunasi', 'klik tombol "selesai" untuk menyelesaikan transaksi ', 'success');
                alert()->success('Transaksi Dilunasi','klik tombol "centang" untuk menyelesaikannya');
                 return redirect('cs/transaksi');
            }
            else if($order->status_produksi=="skipped")
            {
                // Alert::alert('Transaksi Dilunasi', 'klik tombol "selesai" untuk menyelesaikan transaksi ', 'success');
                alert()->success('Transaksi Dilunasi','klik tombol "centang" untuk menyelesaikannya');
                 return redirect('cs/transaksi');
            }
             else if($order->status_produksi=="waiting")
             {
                 alert()->success('Transaksi Dilunasi','Tunggu hingga proses produksi selesai');
                 return redirect('cs/transaksi');
             }
            else
            {
                // Alert::alert('Transaksi Dilunasi', 'Anda dapat melanjutkan untuk mengirim ke produksi', 'success');
                 alert()->success('Transaksi Dilunasi','Anda dapat melanjutkan untuk mengirim ke produksi');
                
                 $id_to_send=Crypt::encrypt($order->id);
                return redirect('/cs/transaksi/'.$id_to_send.'/form-produksi');
            }
            
        }
        else{}
    }

    public function detailTransaksi($id)
    {
        $order=orders::find($id);

        $box=box::find($order->id_box);
        $kode_box=$box->kode_box;

        $order_item=order_item::where('id_order',$id)->get();

        $pelanggan=pelanggan::where('id_order',$id)->first();

        return json_encode(array('order'=>$order, 'pelanggan'=>$pelanggan,'order_item'=>$order_item,'kode_box'=>$kode_box));
        // dd($e);

         // return view("cs.transaksi-detail",['kode_box'=>$kode_box,'order'=>$order, 'pelanggan'=>$pelanggan, 'order_item'=>$order_item] );
    }

    public function transaksiBayar($idd)
    {
        $id=Crypt::decrypt($idd);  //decrypt id

        $order=orders::find($id);

        $box=box::find($order->id_box);
        $kode_box=$box->kode_box;

        $order_item=order_item::where('id_order',$id)->get();

        $pelanggan=pelanggan::where('id_order',$id)->first();

        return view("cs.transaksi-bayar",['kode_box'=>$kode_box,'order'=>$order, 'pelanggan'=>$pelanggan, 'order_item'=>$order_item] );
    }

    public function tampilFormProduksi($idd)
    {
        $id=Crypt::decrypt($idd);  //decrypt id

        $order=orders::find($id);

        $box=box::find($order->id_box);
        $kode_box=$box->kode_box;
        $pelanggan=pelanggan::where('id_order',$id)->first();

        $order_item=order_item::where('id_order',$id)->get();

        return view('cs.transaksi-produksi',['order'=>$order,'order_item'=>$order_item,'kode_box'=>$kode_box,'pelanggan'=>$pelanggan]);
    }

    public function checkItemProduksi($id)
    {
        $order_item=order_item::find($id);
        if ($order_item->status_produksi==null) {
            $order_item->status_produksi='sent';
        }
        elseif($order_item->status_produksi=='sent')
        {
            $order_item->status_produksi=null;
        }
        else{}
        $order_item->save();
         return response()->json($order_item); 
    }

    public function submitProduksi($id)
    { 
        $order=orders::find($id);
        $order->status_produksi="waiting";
        $order->save();

        // Alert::alert('Item Berhasil Terkirim', 'Item Yang Dipilih Telah Dikirim Ke produksi', 'info');
                alert()->info('Item Berhasil Terkirim Ke Produksi',' Anda dapat mencetak struk sekarang');
 
            return redirect('cs/transaksi');
    }

    public function submitAllProduksi($id)
    {
        $order=orders::find($id);
    
        // mengubah status_produksi dari semua item menjadi "send"
        $order_item=order_item::where('id_order',$id)->get();
        foreach ($order_item as $oi)
        {
            $oi->status_produksi="sent";
            $oi->save();
        }

        $order->status_produksi="waiting";
        $order->save();

        // Alert::alert('Item Berhasil Terkirim', 'Semua Item Telah Dikirim Ke produksi', 'info');
        alert()->info('Item Berhasil Terkirim Ke Produksi','Anda dapat mencetak struk sekarang');
            return redirect('cs/transaksi');
    }

    public function skipProduksi($id)
    {

        $order=orders::find($id);
        
         $order_item=order_item::where('id_order',$id)->get();
        foreach ($order_item as $oi)
        {
            $oi->status_produksi="done";
            $oi->save();
        }

        $order->status_produksi="skipped";
        $order->save();

        // Alert::alert('Produksi selesai', 'Anda dapat menyelesaikan transaksi jika pembayaran telah dilunasi', 'info');
        alert()->info('Tidak Ada Item Yang Dikirim Ke Produksi','Anda dapat mencetak struk sekarang');
            return redirect('cs/transaksi');

    }

    public function selesaiTransaksi($id)
    {
        $order=orders::find($id);
        $order->status_order='selesai';

        $tgl_terima=Carbon::now();
        $order->tanggal_terima=$tgl_terima;
        $order->save();


        $order_item=order_item::where('id_order',$id)->get();

            foreach ($order_item as $oi)
            {
                // menambahkan jumlah barang terjual
                $barang=barang::find($oi->id_barang);
                $barang_terjual=$barang->terjual;
                
                    $barang->terjual=$barang_terjual+$oi->qty;
                    $barang->save();
                             
            }

        return $order;
    }

    public function cetakStrukTransaksi($id)
    {
        $order=orders::find($id);
        $pelanggan=pelanggan::where('id_order', $order->id)->first();
        $items=order_item::where('id_order', $order->id)->get();

        $box=box::find($order->id_box);
        $kode_box=$box->kode_box;

        return view('cs.struk',['order'=>$order,'pelanggan'=>$pelanggan,'items'=>$items,'kode_box'=>$kode_box]);
    }


    public function cetakStrukTransaksiThermal($id)
    {
        $order=orders::find($id);
        $pelanggan=pelanggan::where('id_order', $order->id)->first();
        $items=order_item::where('id_order', $order->id)->get();

        $box=box::find($order->id_box);
        $kode_box=$box->kode_box;

        return view('cs.thermal-struk',['order'=>$order,'pelanggan'=>$pelanggan,'items'=>$items,'kode_box'=>$kode_box]);
    }

    public function laporkanTransaksi()
    {
        $id_box=Auth::user()->id_box;

        // memindahkan data order ke order report
        $orders=orders::where('status_order','selesai')->where('id_box',$id_box)->get();
        $orders_count=count($orders);
        foreach ($orders as $ord)
        {
            $ord_report= new orders_report;
            $ord_report->id_box=$ord->id_box;
            $ord_report->kode_transaksi=$ord->kode_transaksi;
            $ord_report->nama_cs=$ord->nama_cs;
            $ord_report->telepon_cs=$ord->telepon_cs;
            $ord_report->catatan=$ord->catatan;
            $ord_report->tanggal_terima=$ord->tanggal_terima;
            $ord_report->harga_total=$ord->harga_total;
            $ord_report->dp=$ord->dp;
            $ord_report->bayar=$ord->bayar;
            $ord_report->kembalian=$ord->kembalian;
            $ord_report->tanggal_transaksi=$ord->created_at;
            
            $pelanggan=pelanggan::where('id_order',$ord->id)->first();

            $ord_report->nama_pelanggan=$pelanggan->nama;
            $ord_report->telepon_pelanggan=$pelanggan->telepon;

            $ord_report->save();

            // memindahkan data order item ke order item report
            $order_item=order_item::where('id_order',$ord->id)->get();
            foreach ($order_item as $oi)
            {
                $oir=new order_item_report;
                $oir->id_order_report=$ord_report->id;
                $oir->nama_barang=$oi->nama_barang;
                $oir->harga_barang=$oi->harga_barang;
                $oir->diskon_barang=$oi->diskon_barang;
                $oir->panjang=$oi->panjang;
                $oir->lebar=$oi->lebar;
                $oir->qty=$oi->qty;
                $oir->harga_item=$oi->harga_item;
                $oir->catatan_item=$oi->catatan_item;
                $oir->save();

                $oi->delete();
            }

            // menghapus data pelanggan
            $delete_pelanggan=pelanggan::where('id_order', $ord->id)->first();
            $delete_pelanggan->delete();
            $ord->delete();
        }

        return $orders_count;
    }


    public function batalkanTransaksi($id)
    {
         // menghapus data transaksi yang tidak tuntas dan mengmbalikan stok barang
        $order_cancel=orders::find($id);


        
            $order_item_cancel=order_item::where('id_order',$id)->get();

            foreach ($order_item_cancel as $oic)
            {
                // mengembalikan stok barang
                $barang=barang::find($oic->id_barang);
                $stokbarang=$barang->stok;
                if ($barang->jenis=="satuan") 
                {
                    $barang->stok=$stokbarang+$oic->qty;
                    $barang->save();
                }

                $oic->delete();
            }
            
            $pelanggan=pelanggan::where('id_order',$id)->first();
            $nama=$pelanggan->nama;

            $pelanggan->delete();
            $order_cancel->delete();

            alert()->info('Transaksi oleh '.$nama.' telah dibatalkan','Stok barang dikembalikan');

            return redirect('cs/transaksi');
        
    }








    // fungsi data barang.........................................................................................................................

    public function dataBarang()
    {
        $barang=barang::all();
        $jumlah_barang=count($barang);

        $barang_onsale=barang::where('status','on sale')->get();
        $jumlah_barang_onsale=count($barang_onsale);

        $barang_notsale=barang::where('status','not sale')->get();
        $jumlah_barang_notsale=count($barang_notsale);


        // dd($barang);
        return view('cs.databarang',['barang'=>$barang, 'jumlah_barang_onsale'=>$jumlah_barang_onsale, 'jumlah_barang_notsale'=>$jumlah_barang_notsale, 'jumlah_barang'=>$jumlah_barang]);
    }

    public function detailBarang($id)
    {
        $barang=barang::find($id);
        return response()->json($barang); 
    }

}