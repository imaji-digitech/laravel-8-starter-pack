<div id="form-create" class=" card p-4">
    <form wire:submit.prevent="create">

        <x-input type="text" title="Title" model="content.title"/>

        <x-summernote title="Contents" model="content.content"/>
        {{--        <x-textarea title="Contents" model="content.contents"/>--}}

        <x-select :options="$optionStatus" :selected="$content['status_id']" title="Status" model="content.status_id"/>

        <x-select2 :options="$optionTags" :selected="$contentTags" title="Tag content" model="contentTags"/>

        <x-date type="datepicker" title="Time publish" model="content.created_at"/>
        {{--        <x-date type="datetimepicker" title="Time publish" model="content.created_at"/>--}}
        {{--        <x-time title="Time publish" model="content.time" />--}}
        {{--        <x-daterange title="Time publish" model="content.timeaaa" />--}}

        <x-input type="file" title="Thumbnail" model="thumbnail" accept="image/*"/>
        <div wire:loading wire:target="thumbnail">
            Proses upload
        </div>
        {{--    start optional image showing    --}}
        @if($action=='create')
            @if($thumbnail)
                <img src="{{$thumbnail->temporaryUrl()}}" alt="" style="max-height: 300px">
            @endif
        @else
            @if($thumbnail)
                <img src="{{$thumbnail->temporaryUrl()}}" alt="" style="max-height: 300px">
            @else
                <img src="{{asset('storage/'.$this->content['thumbnail'])}}" alt="" style="max-height: 300px">
            @endif
        @endif
        {{--    end optional image showing    --}}

        <div class="form-group col-span-6 sm:col-span-5"></div>
        <button type="submit" id="submit" class="btn btn-primary">Submit</button>

    </form>
</div>
