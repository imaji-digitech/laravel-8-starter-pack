<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Create new content') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{__('dashboard')}}</a></div>
            <div class="breadcrumb-item"><a href="#">{{__('content')}}</a></div>
            <div class="breadcrumb-item"><a href="{{ route('admin.content.index') }}">{{__('Create new content')}}</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:form-content action="create"/>
    </div>
</x-app-layout>
