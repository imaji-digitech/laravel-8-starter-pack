<x-app-layout>
<div id="form-create" class=" card p-4">
    <form>
        <x-input type="text" title="title" model="model"/>
        <x-textarea title="title" model="model"/>
        <x-summernote title="title" model="model"/>
{{--        @php($a=array([]))--}}
        <x-select :options="$options" selected="waiting" title="title" model="model"/>
    </form>
</div>
</x-app-layout>
