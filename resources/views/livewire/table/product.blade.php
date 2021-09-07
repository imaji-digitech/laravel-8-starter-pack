<div>
    <form action="{{route('admin.product.graph')}}" method="post">
        @csrf
    <x-data-table :data="$data" :model="$products">
        <x-slot name="head">
            <tr>
                <th style="width: 20px">#</th>
                <th style="width: 300px !important;">
                    <a wire:click.prevent="sortBy('title')" role="button" href="#">
                        Nama Produk @include('components.sort-icon', ['field' => 'title'])
                    </a>
                </th>
                <th style="width: 170px !important;">
                    <a wire:click.prevent="sortBy('product_type_id')" role="button" href="#">
                        UMKM
                        @include('components.sort-icon', ['field' => 'product_type_id'])
                    </a>
                </th>
                <th style="width: 170px !important;">
                    <a wire:click.prevent="sortBy('status_id')" role="button" href="#">
                        Kode Produk @include('components.sort-icon', ['field' => 'code'])
                    </a>
                </th>
                <th style="width: 170px !important;">
                    <a wire:click.prevent="sortBy('price')" role="button" href="#">
                        Harga Produk
                        @include('components.sort-icon', ['field' => 'price'])
                    </a>
                </th>
                <th style="width: 170px !important;">
                    <a wire:click.prevent="sortBy('hpp')" role="button" href="#">
                        HPP Produk
                        @include('components.sort-icon', ['field' => 'hpp'])
                    </a>
                </th>
                <th style="width: 170px !important;">
                    <a wire:click.prevent="sortBy('hpp')" role="button" href="#">
                        Profit Produk
                        @include('components.sort-icon', ['field' => 'hpp'])
                    </a>
                </th>
                <th style="width: 170px !important;">
                    <a wire:click.prevent="sortBy('stock')" role="button" href="#">
                        Stock Produk
                        @include('components.sort-icon', ['field' => 'stock'])
                    </a>
                </th>
                <th style="width: 230px !important;">
                    <a wire:click.prevent="sortBy('updated_at')" role="button" href="#">
                        Terakhir diperbarui
                        @include('components.sort-icon', ['field' => 'updated_at'])
                    </a>
                </th>

                <th style="width: 200px">
                    Action
                </th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @foreach ($products as $product)
                <tr x-data="window.__controller.dataTableController({{ $product->id }})">
                    <td>
                        <input type="checkbox" value="{{$product->id}}" name="productId[]">
                    </td>
                    <td>{{ $product->title }}</td>
                    <td>{{ $product->productType->title }}</td>
                    <td>{{ $product->code }}</td>
                    <td>Rp {{ number_format($product->price,0,",",".") }}</td>
                    <td>Rp {{ number_format($product->hpp,0,",",".") }}</td>
                    <td>Rp {{ number_format($product->price-$product->hpp,0,",",".") }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->updated_at->format('d M Y') }}</td>
                    <td class="whitespace-no-wrap row-action--icon">
                        <a role="button" href="{{ route('admin.product.manufacture',$product->id) }}" class="mr-3">
                            <i class="fa fa-16px fa-money text-blue-500"></i>
                        </a>
                        <a role="button" href="{{ route('admin.product.edit',$product->id) }}" class="mr-3">
                            <i class="fa fa-16px fa-pen text-blue-500"></i>
                        </a>
                        <a role="button" href="{{ route('admin.product.show',$product->id) }}" class="mr-3">
                            <i class="fa fa-16px fa-bar-chart text-blue-500"></i>
                        </a>
                        <a role="button" href="{{ route('admin.product.export',$product->id) }}" class="mr-3">
                            <i class="fa fa-16px fa-download text-danger">PDF</i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </x-slot>
    </x-data-table>
    <br>
    <button class="btn btn-primary">Bandingkan</button>
    </form>


</div>
