<div>
    <x-data-table :data="$data" :model="$cashNotes">
        <x-slot name="head">
            <tr>
                <th style="width: 200px !important;">
                    <a wire:click.prevent="sortBy('title')" role="button" href="#">
                        Tanggal Rekap @include('components.sort-icon', ['field' => 'created_at'])
                    </a>
                </th>
                <th style="width: 120px !important;">
                    <a wire:click.prevent="sortBy('balance')" role="button" href="#">
                        Kas Awal @include('components.sort-icon', ['field' => 'balance'])
                    </a>
                </th>
                <th style="width: 170px !important;">
                    <a wire:click.prevent="sortBy('updated_at')" role="button" href="#">
                        Perubahan terakhir @include('components.sort-icon', ['field' => 'updated_at'])
                    </a>
                </th>
                <th style="width: 70px">
                    Action
                </th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @foreach ($cashNotes as $cashNote)
                <tr x-data="window.__controller.dataTableController({{ $cashNote->id }})">

                    <td>{{ $cashNote->created_at->format('H:i d/M/Y') }}</td>
                    <td>Rp {{ number_format($cashNote->balance,0,",",".") }}</td>
                    <td>{{ $cashNote->updated_at->format('H:i d/M/Y') }}</td>
                    <td>
                        @if($cashNote->cashBook->code_cash_book_id!=999)
                            <a role="button" href="{{ route('admin.cash-note.show',[$dataId,$cashNote->id]) }}" class="mr-3">
                                <i class="fa fa-16px fa-eye text-blue-500"></i>
                            </a>
                            <a role="button" href="{{ route('admin.cash-note.export',[$dataId,$cashNote->id]) }}" class="mr-3">
                                <i class="fa fa-16px fa-download text-blue-500"></i>
                            </a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </x-slot>
    </x-data-table>

</div>
