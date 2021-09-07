<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Perbandingan produk') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{__('dashboard')}}</a></div>
            <div class="breadcrumb-item"><a href="{{ route('admin.product.index') }}">{{__('Produk')}}</a></div>
            <div class="breadcrumb-item"><a href="#">{{__('Perbandingan produk')}}</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:graph-product :dataId="$data"/>
    </div>
</x-app-layout>
