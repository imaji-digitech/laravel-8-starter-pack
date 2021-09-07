<div id="form-create" class=" card p-4">
    <form wire:submit.prevent="payment">
        @foreach($dataCredit as $dc)
            <div class="mt-2 p-2" style="border-radius:10px; border: 1px transparent solid; background-color: #d0d0d0; overflow: hidden">
                    <h1 style="font-size: 18px">{{$dc->product->title}}</h1>
                    <h1 style="font-size: 12px">Jumlah yang masih belum terbayar : {{$dc->quantity}}</h1>
                    <x-input type="number" title="Jumlah (harga {{$dc->total/$dc->quantity}}/pcs termasuk potongan harga)"
                             model="creditTransaction.{{$dc->id}}" defer="true"/>
            </div>
        @endforeach
            <br><br>
        <h2>Total : {{number_format($total,0,'.',',')}}</h2>
        <div class="form-group col-span-6 sm:col-span-5"></div>
        <button type="submit" id="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
