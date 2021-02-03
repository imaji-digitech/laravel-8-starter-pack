<div>
    <x-data-table :data="$data" :model="$contents">
        <x-slot name="head">
            <tr>
                <th><a wire:click.prevent="sortBy('id')" role="button" href="#">
                    ID
                    @include('components.sort-icon', ['field' => 'id'])
                </a></th>
                <th><a wire:click.prevent="sortBy('title')" role="button" href="#">
                    Title
                    @include('components.sort-icon', ['field' => 'title'])
                </a></th>
                <th><a wire:click.prevent="sortBy('content_id')" role="button" href="#">
                    Author
                    @include('components.sort-icon', ['field' => 'content_id'])
                </a></th>
                <th><a wire:click.prevent="sortBy('status')" role="button" href="#">
                        Status
                        @include('components.sort-icon', ['field' => 'status'])
                    </a></th>
                <th><a wire:click.prevent="sortBy('created_at')" role="button" href="#">
                    Tanggal Dibuat
                    @include('components.sort-icon', ['field' => 'created_at'])
                </a></th>
                <th>Action</th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @foreach ($contents as $content)
                <tr x-data="window.__controller.dataTableController({{ $content->id }})">
                    <td>{{ $content->id }}</td>
                    <td>{{ $content->title }}</td>
                    <td>{{ $content->user->name }}</td>
                    <td>{{ $content->status }}</td>
                    <td>{{ $content->created_at->format('d M Y H:i') }}</td>
                    <td class="whitespace-no-wrap row-action--icon">
                        <a role="button" href="{{request()->segment(2)}}/{{$content->id }}/edit" class="mr-3"><i class="fa fa-16px fa-pen"></i></a>
                        <a role="button" x-on:click.prevent="deleteItem" href="#"><i class="fa fa-16px fa-trash text-red-500"></i></a>
                    </td>
                </tr>
            @endforeach
        </x-slot>
    </x-data-table>
</div>
