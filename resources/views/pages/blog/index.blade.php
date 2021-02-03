<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Data Blog') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Blog</a></div>
            <div class="breadcrumb-item"><a href="{{ route('admin.blog.index') }}">Data Blog</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:table.main name="blog" :model="$content" />
    </div>
</x-app-layout>
