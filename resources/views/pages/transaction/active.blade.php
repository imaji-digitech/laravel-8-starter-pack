<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Traksaksi Aktif') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{__('Dashboard')}}</a></div>
            <div class="breadcrumb-item"><a href="#">{{__('Traksaksi Aktif')}}</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:table.main name="transaction-active" :model="$transaction" />
    </div>
</x-app-layout>
