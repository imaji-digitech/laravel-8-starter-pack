<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Edit User') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">User</a></div>
            <div class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">Edit User</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:create-user action="updateUser" :userId="request()->user" />
    </div>
</x-app-layout>
