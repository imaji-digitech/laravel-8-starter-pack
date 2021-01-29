<div class="form-group col-span-6 sm:col-span-5">
    <label for="{{$title}}">{{$title}}</label>
    <textarea class="form-control" name="" id="" cols="100" rows="200" style="height: 150px" wire:model.defer="{{$model}}"></textarea>
    @error($model) <span class="error">{{ $message }}</span> @enderror
</div>
