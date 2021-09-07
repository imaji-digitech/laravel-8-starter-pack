<div id="form-create" class=" card p-4">
    <form wire:submit.prevent="{{$action}}">

        <x-input type="text" title="Jenis produk" model="data.title"/>
        <x-select :options="$optionUser" :selected="$data['user_id']" title="Nama Pemilik" model="data.user_id"/>
        <div class="form-group col-span-6 sm:col-span-5"></div>
        <button type="submit" id="submit" class="btn btn-primary">Submit</button>

    </form>
</div>
