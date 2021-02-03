<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Data Headline') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Headline</a></div>
            <div class="breadcrumb-item"><a href="{{ route('admin.headline.index') }}">Data Headline</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:table.main name="headline" :model="$headline" />
    </div>
</x-app-layout>
