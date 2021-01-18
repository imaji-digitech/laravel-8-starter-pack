<x-app-layout>
<div id="form-create" class=" card p-4">
    <form>
        <x-form-input type="text" title="title" model="model"/>
        <x-form-textarea title="title" model="model"/>
        <x-form-summernote :summernote="$data" title="title" model="model"/>
{{--        @php($a=array([]))--}}
        <x-form-select :options="$options" selected="waiting" title="title" model="model"/>
    </form>
</div>
</x-app-layout>
