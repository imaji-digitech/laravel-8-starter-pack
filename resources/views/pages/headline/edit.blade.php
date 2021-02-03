<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Edit Headline') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Headline</a></div>
            <div class="breadcrumb-item"><a href="{{ route('admin.headline.index') }}">Edit headline</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:headline-form action="update" :dataId="request()->faq" :type="1"/>
    </div>
</x-app-layout>
