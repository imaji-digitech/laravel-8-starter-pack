<div class="form-group col-span-6 sm:col-span-5" wire:ignore>
    <label for="name">{{$title}}</label>
    <textarea type="text" input="description" id="{{str_replace(".", "", $model)}}" class="form-control summernote" >@isset($summernote){!! $summernote !!}@endisset</textarea>
    @error($model) <span class="error">{{ $message }}</span> @enderror
    <script>
        document.addEventListener('livewire:load', function () {
            $('#{{str_replace(".", "", $model)}}').summernote({
                dialogsInBody: true,
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
                    @this.set('{{$model}}', content)
                    }
                }
            });
        });
    </script>
</div>
