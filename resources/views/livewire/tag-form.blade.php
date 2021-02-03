<div id="form-create" class=" card p-4">
    <form wire:submit.prevent="{{$action}}">
        <div class="form-group col-span-6 sm:col-span-5">
            <label for="name">{{__('Tag')}}</label>
            <input type="text" class="mt-1 block w-full form-control shadow-none" wire:model.defer="data.tag" required/>
        </div>


        <div class="form-group col-span-6 sm:col-span-5"></div>
        <button type="submit" id="submit" class="btn btn-primary">Submit</button>

    </form>
    {{--    console.log({{$data['content']}})--}}
    <script>
        {{--nambahin js di livewire--}}
        document.addEventListener('livewire:load', function () {
            window.livewire.on('redirect', () => {
                setTimeout(function () {
                    window.location.href = "{{route('admin.tag.index')}}"; //will redirect to your data page (an ex: data.html)
                }, 2000); //will call the function after 2 secs.
            })
        });
    </script>
</div>
