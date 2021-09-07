<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Data UMKM') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{__('Dashboard')}}</a></div>
            <div class="breadcrumb-item"><a href="#">{{__('Data UMKM')}}</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:table.product-type name="product-type" :model="$productType" />
    </div>
</x-app-layout>
