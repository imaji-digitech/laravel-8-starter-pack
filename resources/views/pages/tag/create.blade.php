<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Buat Tag Baru') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">tag</a></div>
            <div class="breadcrumb-item"><a href="{{ route('admin.tag.index') }}">Buat tag Baru</a></div>
        </div>
        
    </x-slot>

    <div>
        <livewire:tag-form action="create" :type="1"/>
    </div>
</x-app-layout>
