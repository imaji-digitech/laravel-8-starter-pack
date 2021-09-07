<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Riwayat traksaksi') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{__('Dashboard')}}</a></div>
            <div class="breadcrumb-item"><a href="#">{{__('Riwayat traksaksi')}}</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:table.main name="transaction-history" :model="$transaction" />
    </div>
</x-app-layout>
