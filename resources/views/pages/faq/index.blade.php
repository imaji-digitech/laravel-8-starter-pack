<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Data FAQ') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">FAQ</a></div>
            <div class="breadcrumb-item"><a href="{{ route('admin.faq.index') }}">Data FAQ</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:table.main name="faq" :model="$faq" />
    </div>
</x-app-layout>
