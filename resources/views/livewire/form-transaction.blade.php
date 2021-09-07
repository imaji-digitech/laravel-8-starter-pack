<div id="form-create" class=" card p-4">
    <form wire:submit.prevent="{{$action}}">
        <x-select :options="$optionUser" :selected="$data['user_id']" title="Customer" model="data.user_id"/>
        <x-select :options="$optionStatus" :selected="$data['payment_status_id']" title="Customer"
                  model="data.payment_status_id"/>
        <x-select2 :options="$optionProduct" :selected="$product" title="list product" model="product"/>
        @foreach($product as $p)
            <div class="mt-2 p-2" style="border-radius:10px; border: 1px transparent solid; background-color: #d0d0d0; overflow: hidden">
                <h1 style="font-size: 18px">{{$listProduct->find($p)->title}}</h1>
                <x-input type="number" title="Jumlah (harga {{$listProduct->find($p)->price}}/pcs)"
                         model="detailTransaction.{{$listProduct->find($p)->id}}" defer="true"/>
                <x-input type="number" title="Diskon dalam persen"
                         model="detailTransactionDiscount.{{$listProduct->find($p)->id}}" defer="true"/>
            </div>
        @endforeach
        <br><br>
        <h2>Total : {{number_format($total,0,'.',',')}}</h2>
        <div class="form-group col-span-6 sm:col-span-5"></div>
        <button type="submit" id="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
