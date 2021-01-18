<div class="form-group col-span-6 sm:col-span-5">
    <label for="name">{{$title}}</label>
    <div class="input-group">
        <div class="input-group-prepend">
            <div class="input-group-text">
                <i class="fas fa-calendar"></i>
            </div>
        </div>
        <input type="text" name="date" class="form-control {{str_replace(".", "", $model)}}"
               id="{{str_replace(".", "", $model)}}"
               wire:model.defer="{{$model}}">
    </div>
    @error($model) <span class="error">{{ $message }}</span> @enderror
    <script>
        document.addEventListener('livewire:load', function () {
            $("#{{str_replace(".", "", $model)}}").daterangepicker({
                    locale: {format: 'YYYY-MM-DD'},
                    drops: 'down',
                    opens: 'right',
                },
                function (start, end, label) {
                @this.set('{{$model}}', start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'))
                }
            )
        });
    </script>
</div>