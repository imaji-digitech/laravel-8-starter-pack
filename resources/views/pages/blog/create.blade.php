<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Buat Blog Baru') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Blog</a></div>
            <div class="breadcrumb-item"><a href="{{ route('admin.blog.index') }}">Buat Blog Baru</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:form-blog action="create" :type="1"/>
    </div>
</x-app-layout>
