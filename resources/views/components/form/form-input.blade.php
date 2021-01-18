<div class="form-group col-span-6 sm:col-span-5">
    <label for="{{$title}}">{{$title}}</label>
    <input type="{{$type}}" class="mt-1 block w-full form-control shadow-none" wire:model.defer="{{$model}}"/>
    @error($model) <span class="error">{{ $message }}</span> @enderror
</div>
