<div id="form-create" class=" card p-4">
    <form wire:submit.prevent="{{$action}}">
        <div class="form-group col-span-6 sm:col-span-5">
            <label for="name">{{__('Pertanyaan')}}</label>
            <input type="text" class="mt-1 block w-full form-control shadow-none" wire:model.defer="data.question"
                   required/>
        </div>

        <div class="form-group col-span-6 sm:col-span-5" wire:ignore>
            <label for="name">{{__('Jawaban')}}</label>
            <textarea type="text" input="description" id="summernote" class="form-control summernote" required>
                {{$data['answer']}}
            </textarea>
        </div>

        <div class="form-group col-span-6 sm:col-span-5"></div>
        <button type="submit" id="submit" class="btn btn-primary">Submit</button>

    </form>

    <script>

        document.addEventListener('livewire:load', function () {
            window.livewire.on('redirect', () => {
                setTimeout(function () {
                    window.location.href = "{{route('admin.faq.index')}}"; //will redirect to your data page (an ex: data.html)
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
                    @this.set('data.answer', content);
                    }
                }
            });
        });
    </script>
</div>
