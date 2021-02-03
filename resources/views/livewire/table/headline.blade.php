<div>
    <x-data-table :data="$data" :model="$headlines">
        <x-slot name="head">
            <tr>
                <th><a wire:click.prevent="sortBy('id')" role="button" href="#">
                        ID
                        @include('components.sort-icon', ['field' => 'id'])
                    </a></th>
                <th><a wire:click.prevent="sortBy('title')" role="button" href="#">
                        Title
                        @include('components.sort-icon', ['field' => 'Title'])
                    </a></th>

                <th><a wire:click.prevent="sortBy('created_at')" role="button" href="#">
                        Tanggal Dibuat
                        @include('components.sort-icon', ['field' => 'created_at'])
                    </a></th>
                <th>Action</th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @foreach ($headlines as $headline)
                <tr x-data="window.__controller.dataTableController({{ $headline->id }})">
                    <td>{{ $headline->id }}</td>
                    <td>{{ $headline->title }}</td>
                    <td>{{ $headline->created_at->format('d M Y H:i') }}</td>
                    <td class="whitespace-no-wrap row-action--icon">
                        <a role="button" href="{{ route('admin.headline.edit',$headline->id) }}" class="mr-3"><i
                                class="fa fa-16px fa-pen"></i></a>
                        <a role="button" x-on:click.prevent="deleteItem" href="#"><i
                                class="fa fa-16px fa-trash text-red-500"></i></a>
                    </td>
                </tr>
            @endforeach
        </x-slot>
    </x-data-table>
</div>
