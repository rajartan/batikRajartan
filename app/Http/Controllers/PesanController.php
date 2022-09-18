<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pesanan;
use App\Models\PesananDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PesanController extends Controller
{
    public function index(Barang $barang) {
        return view('pesan.index', [
            "barang" => $barang,
        ]);
    }

    public function store(Request $request, Barang $barang) {


        $dataPesanan['user_id'] = auth()->user()->id;
        $dataPesanan['tanggal_pesanan'] = Carbon::now();
        $dataPesanan['status'] = 0;
        $dataPesanan['jumlah_harga_pesanan'] = $barang->harga_barang * $request->jumlah_pesanan;

        Pesanan::create($dataPesanan);

        $idPesanan = Pesanan::where('user_id', auth()->user()->id)->where('status', 0)->first();

        $dataPesananDetail = $request->validate([
            "jumlah_pesanan" => "required|integer",
        ]);
        $dataPesananaDetail['barang_id'] = $barang->id;
        $dataPesananaDetail['pesanan_id'] = $idPesanan->id;
        $dataPesananaDetail['jumlah_pesanan'] = $request->jumlah_pesanan;
        $dataPesananaDetail['jumlah_harga'] = $barang->harga_barang * $request->jumlah_pesanan;
        PesananDetail::create($dataPesananaDetail);

        return redirect('pesan/' . $barang->id);
    }
}
