<div id="form-create" class=" card p-4">
    <form wire:submit.prevent="{{$action}}">
        <x-select :options="$optionUser" :selected="$data['user_id']" title="Customer" model="data.user_id"/>
        {{--        <x-date type="datepicker" title="" model="a"/>--}}
        <x-select :options="$optionStatus" :selected="$data['payment_status_id']" title="Customer"
                  model="data.payment_status_id"/>
        <x-select2 :options="$optionProduct" :selected="$product" title="list product" model="product"/>
        @if($product!=null)
            @foreach($listProduct as $p)
                @if(in_array(intval($p->id),array_map('intval',$product)))
                    <div class="mt-2 p-2"
                         style="border-radius:10px; border: 1px transparent solid; background-color: #d0d0d0; overflow: hidden">
                        <h1 style="font-size: 18px">{{$p->title}}</h1>
                        <x-input type="number" title="Jumlah (harga {{$p->price}}/pcs)"
                                 model="detailTransaction.{{$p->id}}" defer="true"/>
                        <x-input type="number" title="Diskon dalam persen"
                                 model="detailTransactionDiscount.{{$p->id}}" defer="true"/>
                    </div>
                @endif
            @endforeach
        @endif
        @php
            $a=0;
            foreach ($product as $p) {
                if( isset($detailTransaction[$p]) and isset($detailTransactionDiscount[$p])){
                    $a += $listProduct->find($p)->price* intval($detailTransaction[$p])*(100-intval($detailTransactionDiscount[$p]))/100;
                }
            }
        @endphp
        <br><br>
        <h2>Total : {{number_format($a,0,'.',',')}}</h2>
        <div class="form-group col-span-6 sm:col-span-5"></div>
        <button type="submit" id="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
