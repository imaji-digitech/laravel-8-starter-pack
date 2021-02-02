<div class="form-group col-span-6 sm:col-span-5" wire:ignore>
    <label for="name">{{$title}}</label>
    <textarea type="text" input="description" id="{{str_replace(".", "", $model)}}" class="form-control summernote"></textarea>
    @error($model) <span class="error">{{ $message }}</span> @enderror
    <script>
        document.addEventListener('livewire:load', function () {
            $("textarea#{{str_replace('.', '', $model)}}").val(@this.get('{{$model}}'));
            $('#{{str_replace(".", "", $model)}}').summernote({
                dialogsInBody: true,
                tabsize: 2,
                height: 200,

                callbacks: {
                    onChange: function (content, $editable) {
                    @this.set('{{$model}}', content)
                    }
                }
            });
        });
    </script>
</div>
