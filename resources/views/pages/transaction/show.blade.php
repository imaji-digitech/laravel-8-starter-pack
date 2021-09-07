<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Lihat detail transaksi') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{__('dashboard')}}</a></div>
            <div class="breadcrumb-item"><a href="">{{__('Lihat detail transaksi')}}</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:detail-transaction :dataId="$id"/>
    </div>

</x-app-layout>
