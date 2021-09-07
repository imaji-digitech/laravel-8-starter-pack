<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Laporan Kas - ').$umkm->title }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{__('Dashboard')}}</a></div>
            <div class="breadcrumb-item"><a href="#">{{__('Laporan Kas')}}</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:table.product name="cash-note" :model="$cashNote" :dataId="$umkm->id"/>
    </div>
</x-app-layout>
