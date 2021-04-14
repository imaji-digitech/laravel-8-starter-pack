<div class="form-group col-span-6 sm:col-span-5">
    <label for="{{$title}}">{{$title}}</label>
    <input type="{{$type}}" class="mt-1 block w-full form-control shadow-none @error($model) border-danger @enderror" wire:model.defer="{{$model}}" @if($accept!=null) accept="{{$accept}}"@endif/>
    @error($model) <span class="error text-danger">{{ $message }}</span> @enderror
</div>
