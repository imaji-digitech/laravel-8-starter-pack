<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Menambahkan transaksi baru') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{__('dashboard')}}</a></div>
            <div class="breadcrumb-item"><a href="#">{{__('Menambahkan transaksi baru')}}</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:form-transaction action="create"/>
    </div>
</x-app-layout>
