<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePembelianRequest;
use App\Models\Item;
use App\Models\Purchase;
use App\Models\PurchaseDetail;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembelianController extends Controller
{
    public function index()
    {

        $lastId = Purchase::select('kode_masuk')->orderBy('created_at', 'desc')->first();
        $data['kode'] = ($lastId == null ? 'P00000001' : sprintf('P%08d', substr($lastId->kode_masuk, 1) + 1));
        $data['pemasok'] = Supplier::get();
        $data['barang'] = Item::get();

        return view('app.transaction.pembelian.index')->with($data);
    }

    public function store(StorePembelianRequest $request)
    {


        $data['kode_masuk'] = $request["kode_masuk"];
        $data['tanggal_masuk'] = $request['tanggal_masuk'];
        $data['total'] = $request['total'];
        $data['supplier_id'] = $request['supplier_id'];
        $data['user_id'] = Auth::user()->id;

        $input_pembelian = Purchase::create($data);

        //input detail pembelian
        $item_id = $request->item_id;
        $harga_beli = $request->harga_beli;
        $jumlah = $request->jumlah;
        $sub_total = $request->sub_total;


        foreach ($item_id as $i => $v) {
            $data2['purchase_id'] = $input_pembelian->id;
            $data2['item_id'] = $item_id[$i];
            $data2['harga_beli'] = $harga_beli[$i];
            $data2['jumlah'] = $jumlah[$i];
            $data2['sub_total'] = $sub_total[$i];
            $inputPembelianDetail = PurchaseDetail::create($data2);
        }


        return $this->invoiceCreate($data['kode_masuk']);
    }


    public function invoiceCreate($data)
    {

        $pembelian = Purchase::with('supplier', 'purchaseDetails')->where('kode_masuk', $data)->first();

        return view('app.transaction.invoice', compact('pembelian'));
    }
}
