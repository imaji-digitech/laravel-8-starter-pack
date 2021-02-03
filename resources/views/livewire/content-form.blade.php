<div id="form-create" class=" card p-4">
    <form wire:submit.prevent="{{$action}}">
        <div class="form-group col-span-6 sm:col-span-5">
            <label for="name">{{__('Judul Tulisan')}}</label>
            <input type="text" class="mt-1 block w-full form-control shadow-none" wire:model.defer="data.title" required/>
        </div>

        <div class="form-group col-span-6 sm:col-span-5" wire:ignore>
            <label for="name">{{__('Isi Tulisan')}}</label>
            <textarea type="text" input="description" id="summernote" class="form-control summernote" required>
                {{$data['contents']}}
            </textarea>
        </div>

        <div class="form-group col-span-6 sm:col-span-5" wire:ignore>
            <label for="name">{{__('Tag Tulisan')}}</label>
            <select id="tags" class="form-control select2" multiple="" required>    //multiol
                @foreach($tags as $t)
                    <option
                        value="{{$t->id}}" @if($action=="update") @foreach($tag as $t1) {{($t->id==$t1) ? "selected":""}} @endforeach @endif >{{$t->tag}}</option>
                @endforeach
            </select>
        </div>

        @if(Auth::user()->role==1 or Auth::user()->role==2) {{--antar role nya puya beda tampilan create content/form content nya--}}
            <div class="form-group col-span-6 sm:col-span-5">
                <label for="name">{{__('Status')}}</label>
                <select class="form-control" wire:model.defer="data.status" required>
                    <option value="waiting" {{ $data['status']=='waiting' ? 'selected="selected"' : '' }}>Waiting</option>
                    <option value="accepted" {{ $data['status']=='accepted' ? 'selected="selected"' : '' }}>Accepted</option>
                    <option value="decline" {{ $data['status']=='decline' ? 'selected="selected"' : '' }}>Decline</option>
                </select>
            </div>
            <div class="form-group col-span-6 sm:col-span-5">
                <label for="name">{{__('Note')}}</label>
                <textarea type="text" class="mt-1 block w-full form-control shadow-none" wire:model.defer="data.note">
                </textarea>
            </div>
        @else
            @isset($data['note'])
                <div class="form-group col-span-6 sm:col-span-5">
                    <label for="name">{{__('Note')}}</label>
                    <textarea type="text" class="mt-1 block w-full form-control shadow-none" wire:model="data.note"
                              disabled>

                </textarea>

                </div>
            @endif
        @endif


        <div class="form-group col-span-6 sm:col-span-5">
            <label for="name">{{__('Foto Tulisan')}}</label>
            <input type="file" class="mt-1 block w-full form-control shadow-none" wire:model="file"
                {{$action=="update"?'':'required'}}/> {{--kalo edit, foto nya gamesti required/wajib--}}
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
        {{--nambahin js di livewire--}}
        document.addEventListener('livewire:load', function () {
            window.livewire.on('redirect', () => {
                setTimeout(function () {
                    window.location.href = "{{route('admin.blog.index')}}"; //will redirect to your data page (an ex: data.html)
                }, 2000); //will call the function after 2 secs.
            })

            $('#summernote').summernote({
                tabsize: 2,
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ],
                callbacks: {
                    onChange: function (content, $editable) {
                    @this.set('data.contents', content);
                    }
                }
            });

            $('#tags').select2();
            $('#tags').on('change', function (e) {
                data = $('#tags').select2("val");
            @this.set('tag', data);
            })
        });
    </script>
</div>
