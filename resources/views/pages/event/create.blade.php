<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Buat Event Baru') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Event</a></div>
            <div class="breadcrumb-item"><a href="{{ route('admin.blog.index') }}">Buat Event Baru</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:content-form action="create" :type="2"/>
    </div>
</x-app-layout>
