<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ 'HPP Produk - '.$product->title }}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{__('Dashboard')}}</a></div>
            <div class="breadcrumb-item"><a href="{{ route('admin.product.index') }}">{{__('Produk')}}</a></div>
            <div class="breadcrumb-item"><a href="#">{{__('HPP Produk')}}</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:form-product-manufacture :dataId="$product->id" />
    </div>
</x-app-layout>
