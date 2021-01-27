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


class produksiController extends Controller
{
    



// fungsi produksi................................................................................................................................



public function dataProduksi()
{
    $order = DB::table( 'pelanggan')
             ->rightjoin ('orders' , 'orders.id', '=' , 'pelanggan.id_order')
             ->where('status_produksi','=',"waiting")
             ->orWhere('status_produksi','=',"in process")
             ->orWhere('status_produksi','=',"done")
             ->select('pelanggan.nama', 'orders.*')
             ->orderBy('orders.status_produksi','desc')
             ->orderBy('orders.created_at','desc')
             ->get();

    $jumlah_order=orders::where('status_produksi','!=', null)->count();
    $order_waiting=orders::where('status_produksi', 'waiting')->count();
    $order_process=orders::where('status_produksi', 'in process')->count();
    $order_done=orders::where('status_produksi', 'done')->count();

    // dd($order_waiting);

    return view('produksi.produksi',['order'=>$order,'jumlah_order'=>$jumlah_order,'order_waiting'=>$order_waiting,'order_process'=>$order_process,'order_done'=>$order_done]);
} 

public function formProsesProduksi($id)
    {
        $order=orders::find($id);

        $box=box::find($order->id_box);
        $kode_box=$box->kode_box;
        $pelanggan=pelanggan::where('id_order',$id)->first();

        $order_item=order_item::where('id_order',$id)->where('status_produksi','!=',null) ->get();

        return view('produksi.produksi-form',['order'=>$order,'order_item'=>$order_item,'kode_box'=>$kode_box,'pelanggan'=>$pelanggan]);
    }

    public function checkItemProsesProduksi($id)
    {
        $order_item=order_item::find($id);
        if ($order_item->status_produksi=='sent') {
            $order_item->status_produksi='done';
        }
        elseif($order_item->status_produksi=='done')
        {
            $order_item->status_produksi='sent';
        }
        else{}
        $order_item->save();
         return response()->json($order_item); 
    }

    public function saveUpdateProduksi($id)
    {
        $order=orders::find($id);

        $order_item=order_item::where('id_order',$id)->where('status_produksi','sent')->first();
// dd($order_item);
        if (empty($order_item)) {
            $order->status_produksi="done";
            $order->save();
            
            // Alert::alert('Semua item selesai produksi', 'Data diteruskan ke customer service', 'success');
            alert()->success('Semua item selesai produksi','Data diteruskan ke customer service');
            return redirect('produksi');
        }
        else{
            $order->status_produksi="in process";
            $order->save();
            
            Alert::toast('Status produksi berhasil diperbarui', 'info')->width(350);
            return redirect('produksi');
        }

    }

    public function kirimProduksi($id)
    {
        $order=orders::find($id);
        $order->status_pengiriman='dikirim';
        $order->save();

        Alert::toast('Produksi Selesai, Item telah dikirim ke box', 'success')->width(350);
            return redirect('produksi');
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
        return view('produksi.databarang',['barang'=>$barang, 'jumlah_barang_onsale'=>$jumlah_barang_onsale, 'jumlah_barang_notsale'=>$jumlah_barang_notsale, 'jumlah_barang'=>$jumlah_barang]);
    }

    public function detailBarang($id)
    {
        $barang=barang::find($id);
        return response()->json($barang); 
    }



}
