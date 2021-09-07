<div>
    <x-data-table :data="$data" :model="$productTypes">
        <x-slot name="head">
            <tr>
                <th style="width: 300px !important;">
                    <a wire:click.prevent="sortBy('title')" role="button" href="#">
                        Nama UMKM @include('components.sort-icon', ['field' => 'title'])
                    </a>
                </th>
                <th style="width: 200px">
                    Action
                </th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @foreach ($productTypes as $productType)
                <tr x-data="window.__controller.dataTableController({{ $productType->id }})">
                    <td>{{ $productType->title }}</td>
                    <td class="whitespace-no-wrap row-action--icon">
                        <a role="button" href="{{ route('admin.product-type.edit',$productType->id) }}" class="mr-3">
                            <i class="fa fa-16px fa-pen text-blue-500"></i>
                        </a>
                        <a role="button" wire:click="exportCSVUMKM({{$productType->id}})" class="mr-3">
                            <i class="fa fa-16px fa-download text-blue-500">CSV</i>
                        </a>
                        <a role="button" href="{{ route('admin.product-type.export',$productType->id) }}" class="mr-3">
                            <i class="fa fa-16px fa-download text-danger">PDF</i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </x-slot>
    </x-data-table>
</div>
