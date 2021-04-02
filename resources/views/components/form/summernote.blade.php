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
                    onImageUpload: function(files) {
                        for(let i=0; i < files.length; i++) {
                            $.upload(files[i]);
                        }
                        console.log('file loading');
                    },
                    onChange: function (content, $editable) {
                    @this.set('{{$model}}', content)
                    },

                }
            });
            $.upload = function (file) {
                let out = new FormData();
                out.append('file', file, file.name);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
                    }
                });
                $.ajax({
                    method: 'POST',
                    url: '{{route('admin.summernote_upload')}}',
                    contentType: false,
                    cache: false,
                    processData: false,
                    data: out,
                    success: function (img) {
                        // var image = $('<img>').attr('src', 'http://' + img);
                        {{--$('#{{str_replace(".", "", $model)}}').summernote('insertImage', img);--}}
                            image='<img src="'+window.location.protocol+'//'+window.location.host+'/storage/'+img+ '" alt=\"Italian Trulli\">'
                        $("textarea#{{str_replace('.', '', $model)}}").summernote('code',@this.get('{{$model}}')+image);
console.log(img)
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.error(textStatus + " " + errorThrown);
                    }
                });
            };
        });
    </script>
</div>
