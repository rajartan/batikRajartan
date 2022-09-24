<x-app-layout>
    <div class="pt-5">
        <x-container>
            <h1 class="text-indigo-500 text-7xl text-center font-bold"><span class="font-light">batik</span>Rajartan</h1>
            <p class="text-slate-500 text-center mt-2 text-sm tracking-widest">Toko Batik Terlengkap dan Terbesar di
                Indonesia</p>
        </x-container>
    </div>

    <div class="py-3">
        <x-container>
            <hr class="py-5">
            <div class="grid md:grid-cols-4 sm:grid-cols-2 px-4 sm:px-0 grid-cols-1 gap-4">
                @foreach ($barangs as $barang)
                    @if (!empty($barang->stok_barang))
                        <div class="card card-compact bg-base-100 shadow-xl">
                            <figure class="h-72"><img src="{{ asset('images/' . $barang->gambar_barang) }}"
                                    alt="{{ $barang->nama_barang }}" class="w-80" />
                            </figure>
                            <span
                                class="block absolute text-indigo-500 bg-gray-200 shadow-md p-2 rounded-b-xl rounded-bl-none">{{ $barang->stok_barang }}</span>
                            <div class="card-body bg-white">
                                <h2 class="card-title">{{ $barang->nama_barang }}</h2>
                                <p class="text-xs truncate">{{ $barang->keterangan }}</p>
                                <div class="card-actions justify-between items-center">
                                    <button class="btn btn-outline btn-error text-xs btn-sm">Rp.
                                        {{ $barang->harga_barang }}</button>
                                    <a href="{{ route('pesan.show', $barang->id) }}" class="btn btn-primary">Pesan</a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <div class="px-4 sm:px-0 my-4">
                {{ $barangs->links() }}
            </div>
        </x-container>
    </div>

</x-app-layout>
