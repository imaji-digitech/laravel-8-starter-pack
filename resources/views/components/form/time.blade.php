<div class="form-group col-span-6 sm:col-span-5" wire:ignore>
    <label>{{$title}}</label>
    <div class="input-group">
        <div class="input-group-prepend">
            <div class="input-group-text">
                <i class="fas fa-clock"></i>
            </div>
        </div>
        <input id="{{str_replace(".", "", $model)}}" type="text" class="form-control timepicker" />
        @error($model) <span class="error">{{ $message }}</span> @enderror
    </div>

    <script>
        document.addEventListener('livewire:load', function () {
            if(@this.get('{{$model}}')!='') {
                var time = @this.get('{{$model}}');
                time = time.toString().match(/^([01]\d|2[0-3])(:)([0-5]\d)(:[0-5]\d)?$/) || [time];
                if (time.length > 1) {
                    time = time.slice(1);
                    time[5] = +time[0] < 12 ? 'AM' : 'PM'; // Set AM/PM
                    time[0] = +time[0] % 12 || 12; // Adjust hours
                }
                $("#{{str_replace(".", "", $model)}}").timepicker('setTime', time.join(''));
            }

            $("#{{str_replace(".", "", $model)}}").on("change.timepicker", () => {
                var time = $("#{{str_replace(".", "", $model)}}").val();
                var hours = Number(time.match(/^(\d+)/)[1]);
                var minutes = Number(time.match(/:(\d+)/)[1]);
                var AMPM = time.match(/\s(.*)$/)[1];
                if (AMPM === "PM" && hours < 12) hours = hours + 12;
                if (AMPM === "AM" && hours === 12) hours = hours - 12;
                var sHours = hours.toString();
                var sMinutes = minutes.toString();
                if (hours < 10) sHours = "0" + sHours;
                if (minutes < 10) sMinutes = "0" + sMinutes;
                time = sHours + ":" + sMinutes
            @this.set('{{$model}}', time)
            })
        })

    </script>
</div>
