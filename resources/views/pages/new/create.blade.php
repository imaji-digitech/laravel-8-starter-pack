<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Buat Berita Baru') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Berita</a></div>
            <div class="breadcrumb-item"><a href="{{ route('admin.news.index') }}">Buat Berita Baru</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:content-form action="create" :type="3"/>
    </div>
</x-app-layout>
