<div id="form-create" class=" card p-4">
    <form wire:submit.prevent="create">

{{--        <x-input type="text" title="title" model="blog.title"/>--}}
        <x-date type="text" title="title" model="blog.title" type="datetimepicker"/>

{{--        {{$blog['time']}}--}}
        <x-time title="sa" model="blog.time" :time="$blog['time']"/>

        <x-daterange title="sa" model="blog.timeaaa" />

        <x-summernote title="contents" model="blog.contents"/>

        <x-select2 :options="$optionTags" :selected="$blogTags" title="Yoski" model="blogTags"/>

        <x-select :options="$optionStatus" :selected="$blog['status']" title="Yoski" model="blog.status"/>

        <div class="form-group col-span-6 sm:col-span-5"></div>
        <button type="submit" id="submit" class="btn btn-primary">Submit</button>

    </form>
    {{--    console.log({{$data['content']}})--}}

</div>
