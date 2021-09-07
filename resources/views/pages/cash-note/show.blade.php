<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Detail Laporan - ').$umkm->title }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{__('dashboard')}}</a></div>
            <div class="breadcrumb-item"><a href="{{ route('admin.product.index') }}">{{__('Produk')}}</a></div>
            <div class="breadcrumb-item"><a href="#">{{__('Detail produk')}}</a></div>
        </div>
    </x-slot>

    <div>
        <div class="bg-gray-100 text-gray-900 tracking-wider leading-normal">
            <div class="p-3 pt-4 mt-2 bg-white">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped text-sm text-gray-600" style="table-layout: fixed; ">
                        <thead>
                        <th style="width: 200px !important;">
                            Tanggal
                        </th>
                        <th style="width: 120px !important;">
                            Kode
                        </th>
                        <th style="width: 170px !important;">
                            Keterangan
                        </th>
                        <th style="width: 170px !important;">
                            Masuk
                        </th>
                        <th style="width: 170px !important;">
                            Keluar
                        </th>
                        <th style="width: 170px !important;">
                            Saldo
                        </th>
                        <th style="width: 100px">
                            Action
                        </th>
                        </thead>
                        <tbody>

                        @foreach ($cashBooks as $cashBook)
                            <tr x-data="window.__controller.dataTableController({{ $cashBook->id }})">

                                <td style="height: 10px !important;">{{ $cashBook->created_at->format('H:m d/M/Y') }}</td>
                                <td style="height: 10px !important;">{{ str_pad($cashBook->code_cash_book_id, 3, '0', STR_PAD_LEFT) }}</td>
                                <td style="height: 10px !important;">{{ $cashBook->note }}</td>
                                <td style="height: 10px !important;">Rp {{ number_format($cashBook->income,0,",",".") }}</td>
                                <td style="height: 10px !important;">Rp {{ number_format($cashBook->outcome,0,",",".") }}</td>
                                <td style="height: 10px !important;">
                                    Rp {{ number_format($c->balance=$c->balance+$cashBook->income-$cashBook->outcome,0,",",".") }}</td>
                                <td style="height: 10px !important;">
                                    @if($cashBook->code_cash_book_id!=1)
                                        <a role="button" href="{{ route('admin.cash-book.edit',[$umkm->id,$cashBook->id]) }}"
                                           class="mr-3">
                                            <i class="fa fa-16px fa-pencil text-blue-500"></i>
                                        </a>
                                    @endif
                                </td>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
