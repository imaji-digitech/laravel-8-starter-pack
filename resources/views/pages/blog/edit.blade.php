<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Edit Blog') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Blog</a></div>
            <div class="breadcrumb-item"><a href="{{ route('admin.blog.index') }}">Edit Blog</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:content-form action="update" :dataId="request()->blog" :type="1"/>
    </div>
</x-app-layout>
