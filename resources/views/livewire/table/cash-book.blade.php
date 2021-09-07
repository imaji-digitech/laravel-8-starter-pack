<div>
    <x-data-table :data="$data" :model="$cashBooks">
        <x-slot name="head">
            <tr>
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
            </tr>
        </x-slot>
        <x-slot name="body">
            @php
                $c=App\Models\CashNote::whereProductTypeId($dataId)->orderByDesc('id')->first();
            @endphp
            @foreach ($cashBooks as $cashBook)
                <tr x-data="window.__controller.dataTableController({{ $cashBook->id }})">
                    <td style="height: 10px !important;">{{ $cashBook->created_at->format('H:m d/M/Y') }}</td>
                    <td style="height: 10px !important;">{{ str_pad($cashBook->code_cash_book_id, 3, '0', STR_PAD_LEFT) }}</td>
                    <td style="height: 10px !important;">{{ $cashBook->note }}</td>
                    <td style="height: 10px !important;">Rp {{ number_format($cashBook->income,0,",",".") }}</td>
                    <td style="height: 10px !important;">Rp {{ number_format($cashBook->outcome,0,",",".") }}</td>
                    <td style="height: 10px !important;">Rp {{ number_format($c->balance=$c->balance+$cashBook->income-$cashBook->outcome,0,",",".") }}</td>
                    <td style="height: 10px !important;">
                        @if($cashBook->code_cash_book_id!=1 and $cashBook->code_cash_book_id!=999)
                            <a role="button" x-on:click.prevent="deleteItem" href="#" class="mr-3">
                                <i class="fa fa-16px fa-trash text-red-500"></i></a>
                            <a role="button" href="{{ route('admin.cash-book.edit',[$dataId,$cashBook->id]) }}" class="mr-3">
                                <i class="fa fa-16px fa-pencil text-blue-500"></i>
                            </a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </x-slot>
    </x-data-table>

</div>
