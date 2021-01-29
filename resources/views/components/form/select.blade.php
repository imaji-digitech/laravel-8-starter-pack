<div class="form-group col-span-6 sm:col-span-5">
    <label for="name">{{$title}}</label>
    <select class="form-control" wire:model.defer="{{$model}}">
        @for($i=0;$i<count($options) ;$i++)
            <option value="{{$options[$i]['value']}}" {{ $isSelected($options[$i]['value']) ? 'selected="selected"' : '' }}>
                {{$options[$i]['title']}}
            </option>
        @endfor
        @error($model) <span class="error">{{ $message }}</span> @enderror
    </select>
</div>
