<x-app-layout>
    <x-container>
        <div class="text-sm breadcrumbs -mb-6 mt-4">
            <ul>
                <li><a href="{{ route('dashboard') }}">Home</a></li>
                <li><a href="{{ route('checkout') }}">Checkout</a></li>
            </ul>
        </div>

        <div class="grid grid-cols-1 px-4 sm:px-0 mt-12">
            <div class="card w-full bg-base-100 shadow-xl">
                <div class="card-body p-4">
                    <h3 class="text-xl mb-4">Checkout</h3>
                    @if (!empty($pesanan))
                        <p class="text-right">Tanggal Pesanan : {{ now() }}</p>
                        <div class="overflow-x-auto">
                            <table class="table w-full text-sm">
                                <!-- head -->
                                <thead>
                                    <tr class="text-base">
                                        <th width="5%">No</th>
                                        <th>Nama</th>
                                        <th>Jumlah</th>
                                        <th align="left">Harga</th>
                                        <th align="left">Total</th>
                                        <th width="15%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pesanan_details as $pesan)
                                        <tr>
                                            <th>{{ $loop->iteration }}</th>
                                            <td>{{ $pesan->barang->nama_barang }}</td>
                                            <td>{{ $pesan->jumlah_pesanan }}</td>
                                            <td align="left">Rp. {{ number_format($pesan->barang->harga_barang) }}
                                            </td>
                                            <td align="left">Rp. {{ number_format($pesan->jumlah_harga) }}</td>
                                            <td>
                                                <form action="{{ route('destroy', $pesan->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')

                                                    <button type="submit" class="btn btn-error btn-sm text-white">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor" class="bi bi-trash"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                            <path fill-rule="evenodd"
                                                                d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td align="right" colspan="4"><strong>Total Keseluruhan : </strong></td>
                                        <td align="left"><strong>Rp.
                                                {{ number_format($pesanan->jumlah_harga_pesanan) }}</strong>
                                            </td>
                                        <td>
                                            <form action="{{ route('konfirmasi') }}" method="post">
                                                @csrf
                                                <div class="flex items-center">
                                                    <button type="submit" class="btn btn-success text-slate-100"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-check mr-2" viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd" d="M10.854 8.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                                                        <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"/>
                                                    </svg> Checkout</button>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>

        </div>

    </x-container>
</x-app-layout>
