<div>
    <x-data-table :data="$data" :model="$tags">
        <x-slot name="head">
            <tr>
                <th><a wire:click.prevent="sortBy('id')" role="button" href="#">
                        ID
                        @include('components.sort-icon', ['field' => 'id'])
                    </a></th>
                <th><a wire:click.prevent="sortBy('tag')" role="button" href="#">
                        Tag
                        @include('components.sort-icon', ['field' => 'tag'])
                    </a></th>
                <th>
                    Jumlah Digunakan
                </th>

                <th><a wire:click.prevent="sortBy('created_at')" role="button" href="#">
                        Tanggal Dibuat
                        @include('components.sort-icon', ['field' => 'created_at'])
                    </a></th>
                <th>Action</th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @foreach ($tags as $tag)
                <tr x-data="window.__controller.dataTableController({{ $tag->id }})">
                    <td>{{ $tag->id }}</td>
                    <td>{{ $tag->tag }}</td>
                    <td>{{$tag->contentTags->count()}}</td>


                    <td>{{ $tag->created_at->format('d M Y H:i') }}</td>
                    <td class="whitespace-no-wrap row-action--icon">
                        <a role="button" href="{{ route('admin.tag.edit',$tag->id) }}" class="mr-3"><i
                                class="fa fa-16px fa-pen"></i></a>
                        <a role="button" x-on:click.prevent="deleteItem" href="#"><i
                                class="fa fa-16px fa-trash text-red-500"></i></a>
                    </td>
                </tr>
            @endforeach
        </x-slot>
    </x-data-table>
</div>
