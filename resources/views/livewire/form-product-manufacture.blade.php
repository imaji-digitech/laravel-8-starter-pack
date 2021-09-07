<div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-body p-0">
                    <div class="table-responsive table-invoice">
                        <table class="table table-striped">
                            <tr>
                                <th>Nama Item</th>
                                <th>Jumlah Item</th>
                                <th>Harga Item</th>
                                <th>Output produk</th>
                                <th>HPP/produk</th>
                                <th>Aksi</th>
                            </tr>

                            @foreach($productManufacture as $f)
                                <tr>
                                    <td class="font-weight-600">{{$f->title}}</td>
                                    <td>{{$f->amount}}</td>
                                    <td>Rp {{number_format($f->price,0,'.','.')}}</td>
                                    <td>{{$f->amount_product}}</td>
                                    <td>Rp {{number_format($f->amount*$f->price/$f->amount_product,0,'.',',')}}</td>
                                    <td>
                                        <a href="#" wire:click="delete({{$f->id}})" class="btn btn-danger">Hapus</a>
                                    </td>

                                </tr>
                            @endforeach
                            <tr>
                                <td class="font-weight-600"><b>Total HPP produk</b></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><b>Rp {{number_format($total,0,'.',',')}}</b></td>
                                <td></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div id="form-create" class=" card p-4">
                <form wire:submit.prevent="create">

                    <x-input type="text" title="Nama Item " model="data.title"/>
                    <x-input type="number" title="Jumlah Item " model="data.amount"/>
                    <x-input type="number" title="Harga Item " model="data.price"/>
                    <x-input type="number" title="Output produk " model="data.amount_product"/>

                    <div class="form-group col-span-6 sm:col-span-5"></div>
                    <button type="submit" id="submit" class="btn btn-primary">Submit</button>

                </form>
            </div>
        </div>
    </div>
</div>
