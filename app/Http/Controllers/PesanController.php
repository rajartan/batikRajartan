<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pesanan;
use Alert;
use App\Models\PesananDetail;
use Carbon\Carbon;
use Illuminate\Console\View\Components\Alert as ComponentsAlert;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert as FacadesAlert;

class PesanController extends Controller
{
    public function index(Barang $barang)
    {
        return view('pesan.index', [
            "barang" => $barang,
        ]);
    }

    public function store(Request $request, Barang $barang)
    {

        // validasi apakah stok melebihi request
        if ($request->jumlah_pesanan > $barang->stok_barang) {
            FacadesAlert::error('Gagal', 'Jumlah pesanan melebihi stok');
            return redirect('pesan/' . $barang->id);
        }

        // cek psanan
        $cek_pesanan = Pesanan::where('user_id', auth()->user()->id)->where('status', 0)->first();

        // simpan ke database pesanan

        // harga pesanan baru
        $hargaPesananBaru = $barang->harga_barang * $request->jumlah_pesanan;

        // cek jika sudah ada
        if (empty($cek_pesanan)) {
            $dataPesanan['user_id'] = auth()->user()->id;
            $dataPesanan['tanggal_pesanan'] = Carbon::now();
            $dataPesanan['status'] = 0;
            $dataPesanan['jumlah_harga_pesanan'] = $barang->harga_barang * $request->jumlah_pesanan;;
            Pesanan::create($dataPesanan);
        }else {
            $dataPesananBaru['jumlah_harga_pesanan'] = $cek_pesanan->jumlah_harga_pesanan + $hargaPesananBaru;
            Pesanan::where('id', $cek_pesanan->id)->update($dataPesananBaru);
        }

        // ambil id pesanan terbaru
        $idPesanan = Pesanan::where('user_id', auth()->user()->id)->where('status', 0)->first();

        // cek pesanan detail

        $cek_pesanan_detail = PesananDetail::where('barang_id', $barang->id)->where('pesanan_id', $idPesanan->id)->first();

        if (empty($cek_pesanan_detail)) {
            $dataPesananDetail = $request->validate([
                "jumlah_pesanan" => "required|integer",
            ]);
            $dataPesananaDetail['barang_id'] = $barang->id;
            $dataPesananaDetail['pesanan_id'] = $idPesanan->id;
            $dataPesananaDetail['jumlah_pesanan'] = $request->jumlah_pesanan;
            $dataPesananaDetail['jumlah_harga'] = $barang->harga_barang * $request->jumlah_pesanan;
            PesananDetail::create($dataPesananaDetail);
        }else {
            $dataPesananaDetailBaru['jumlah_pesanan'] = $cek_pesanan_detail->jumlah_pesanan + $request->jumlah_pesanan;

            $hargaPesananDetailBaru = $barang->harga_barang * $request->jumlah_pesanan;

            $dataPesananaDetailBaru['jumlah_harga'] = $cek_pesanan_detail->jumlah_harga + $hargaPesananDetailBaru;
            PesananDetail::where('pesanan_id', $idPesanan->id)->update($dataPesananaDetailBaru);
        }

        FacadesAlert::success('Berhasil', 'Data berhasil di tambahkan ke keranjang');

        return redirect('checkout');
    }

    public function checkout() {
        $pesanan = Pesanan::where('user_id', auth()->user()->id)->where('status', 0)->first();
        if (!empty($pesanan)) {
            $pesanan_details = PesananDetail::where('pesanan_id', $pesanan->id)->get();
        }else{
            $pesanan_details = PesananDetail::get();
        }

        return view('pesan.checkout', [
            "pesanan" => $pesanan,
            "pesanan_details" => $pesanan_details
        ]);
    }

    public function destroy(PesananDetail $pesananDetail, Barang $barang){

        $pesanan = Pesanan::where('id', $pesananDetail->pesanan_id)->first();
        $dataPesanan['jumlah_harga_pesanan'] = $pesanan->jumlah_harga_pesanan - $pesananDetail->jumlah_harga;
        Pesanan::where('id', $pesanan->id)->update($dataPesanan);

        $barang = Barang::where('id', $pesananDetail->barang_id)->first();
        $dataBarang['stok_barang'] = $barang->stok_barang + $pesananDetail->jumlah_pesanan;
        Barang::where('id', $pesananDetail->barang_id)->update($dataBarang);

        PesananDetail::destroy('id', $pesananDetail->id);

        FacadesAlert::success('Success', 'Pesanan has been deleted!');

        return redirect('checkout');
    }

    public function konfirmasi() {
        $pesanan = Pesanan::where('user_id', auth()->user()->id)->where('status', 0)->first();
        $dataPesanan['status'] = 1;
        Pesanan::where('id', $pesanan->id)->update($dataPesanan);

        $pesanan_details = PesananDetail::where('pesanan_id', $pesanan->id)->get();
        foreach ($pesanan_details as $pesanan_detail) {
            $barang = Barang::where('id', $pesanan_detail->barang_id)->first();
            $dataBarang['stok_barang'] = $barang->stok_barang - $pesanan_detail->jumlah_pesanan;
            Barang::where('id', $barang->id)->update($dataBarang);
        }

        FacadesAlert::success('Success', 'Pesanan has been checkout');

        return redirect('checkout');
    }
}
