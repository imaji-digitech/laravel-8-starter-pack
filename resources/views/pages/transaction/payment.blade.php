<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Pembayaran Traksaksi') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{__('Dashboard')}}</a></div>
            <div class="breadcrumb-item"><a href="#">{{__('Pembayaran Traksaksi')}}</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:form-payment :dataId="$id"/>
    </div>
</x-app-layout>
