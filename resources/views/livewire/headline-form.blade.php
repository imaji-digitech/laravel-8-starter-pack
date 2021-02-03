<div id="form-create" class=" card p-4">
    <form wire:submit.prevent="{{$action}}">
        <div class="form-group col-span-6 sm:col-span-5">
            <label for="name">{{__('Judul Headline')}}</label>
            <input type="text" class="mt-1 block w-full form-control shadow-none" wire:model.defer="data.title"
                   required/>
        </div>

        <div class="form-group col-span-6 sm:col-span-5">
            <label for="name">{{__('Link Headline')}}</label>
            <input type="text" class="mt-1 block w-full form-control shadow-none" wire:model.defer="data.slug"
                   required/>
        </div>


        <div class="form-group col-span-6 sm:col-span-5">
            <label for="name">{{__('Foto Headline')}}</label>
            <input type="file" class="mt-1 block w-full form-control shadow-none" wire:model="file"
                {{$action=="update"?'':'required'}}/>
            <br>
            @if($file)
                <img src="{{$file->temporaryUrl()}}" alt="" style="max-height: 300px">
            @else
                <img src="{{ asset('storage/content/'.$this->data['thumbnail']) }}" alt="" style="max-height: 300px">
            @endif
        </div>

        <div class="form-group col-span-6 sm:col-span-5"></div>
        <button type="submit" id="submit" class="btn btn-primary">Submit</button>

    </form>
    {{--    console.log({{$data['content']}})--}}
    <script>

        document.addEventListener('livewire:load', function () {
            window.livewire.on('redirect', () => {
                setTimeout(function () {
                    window.location.href = "{{route('admin.headline.index')}}"; //will redirect to your data page (an ex: data.html)
                }, 2000); //will call the function after 2 secs.
            })
        });
    </script>
</div>
