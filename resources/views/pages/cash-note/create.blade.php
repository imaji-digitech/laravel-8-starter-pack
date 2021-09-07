<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Menambahkan data kas - ').$umkm->title }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{__('dashboard')}}</a></div>
            <div class="breadcrumb-item"><a href="{{ route('admin.cash-book.index',$umkm->id) }}">{{__('Buku kas')}}</a></div>
            <div class="breadcrumb-item"><a href="#">{{__('Menambahkan data kas')}}</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:form-cash-book :umkm="$umkm->id"/>
    </div>
</x-app-layout>
