<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Buat Headline Baru') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Headline</a></div>
            <div class="breadcrumb-item"><a href="{{ route('admin.headline.index') }}">Buat headline Baru</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:headline-form action="create" :type="1"/>
    </div>
</x-app-layout>
