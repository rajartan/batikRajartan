<x-app-layout>
    <x-container>
        <div class="text-sm breadcrumbs -mb-6 mt-4">
            <ul>
                <li><a href="{{ route('dashboard') }}">Home</a></li>
                <li><a href="{{ route('dashboard') }}">Kembali</a></li>
            </ul>
        </div>
        <div class="grid grid-cols-1 px-4 sm:px-0">
            <div class="card lg:card-side bg-base-100 shadow-xl mt-12">
                <figure><img src="{{ asset('images/' . $barang->gambar_barang) }}" alt="Album" class="w-full sm:w-96" />
                </figure>
                <div class="card-body bg-white">
                    <h2 class="card-title text-3xl text-indigo-500 mb-5">{{ $barang->nama_barang }}</h2>
                    <div class="grid grid-cols-2">
                        <div>
                            <p>Harga</p>
                        </div>
                        <div>
                            <p class="text-red-500">Rp. {{ number_format($barang->harga_barang) }}</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-2">
                        <div>
                            <p>Stok</p>
                        </div>
                        <div>
                            <p>{{ $barang->stok_barang }}</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-2">
                        <div>
                            <p>Keterangan</p>
                        </div>
                        <div>
                            <p>{{ $barang->keterangan }}</p>
                        </div>
                    </div>
                    <div class="grid grid-col-1 mt-3">
                        <form action="{{ route('pesan.store', $barang->id) }}" method="post">
                            @csrf
                            <div class="grid grid-cols-2">
                                <p>Jumlah Pesan</p>
                                <input type="text" name="jumlah_pesanan" class="input w-full bg-white border border-indigo-400">
                            </div>
                            <div class="text-end mt-4">
                                <button type="submit" class="btn btn-primary">Masukkan Keranjang</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-container>
</x-app-layout>
