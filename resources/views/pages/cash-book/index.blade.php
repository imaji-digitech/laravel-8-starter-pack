<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Buku Kas - '.$umkm->title) }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{__('Dashboard')}}</a></div>
            <div class="breadcrumb-item"><a href="#">{{__('Buku Kas')}}</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:table.product name="cash-book" :model="$cashBook" :dataId="$umkm->id"/>
    </div>
</x-app-layout>
