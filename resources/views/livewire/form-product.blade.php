<div id="form-create" class=" card p-4">
    <form wire:submit.prevent="{{$action}}">
        <x-select :options="$optionType" :selected="$data['product_type_id']" title="Jenis product" model="data.product_type_id"/>
        <x-input type="text" title="Nama produk" model="data.title" defer="false"/>
        <x-input type="text" title="Kode produk" model="data.code"/>
        <x-input type="number" title="Harga produk" model="data.price"/>
        <div class="form-group col-span-6 sm:col-span-5"></div>
        <button type="submit" id="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
