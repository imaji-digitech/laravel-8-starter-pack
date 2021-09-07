<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Tambah data UMKM') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{__('dashboard')}}</a></div>
            <div class="breadcrumb-item"><a href="{{ route('admin.product-type.index') }}">{{__('Data UMKM')}}</a></div>
            <div class="breadcrumb-item"><a href="#">{{__('Tambah data UMKM')}}</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:form-product-type action="create"/>
    </div>
</x-app-layout>
