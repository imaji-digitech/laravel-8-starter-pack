<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Data Tag') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Tag</a></div>
            <div class="breadcrumb-item"><a href="{{ route('admin.tag.index') }}">Data Tag</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:table.main name="tag" :model="$tag" />
    </div>
</x-app-layout>
