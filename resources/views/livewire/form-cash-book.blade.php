<div id="form-create" class=" card p-4">
    <form wire:submit.prevent="{{$action}}">
        <x-select :options="$optionCode" :selected="$data['code_cash_book_id']" title="Kode Pembukuan" model="data.code_cash_book_id"/>
        <x-input title="pemasukan" model="data.income" type="number"/>
        <x-input title="pengeluaran" model="data.outcome" type="number"/>
        <x-textarea title="Keterangan" model="data.note"/>
        <div class="form-group col-span-6 sm:col-span-5"></div>
        <button type="submit" id="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
