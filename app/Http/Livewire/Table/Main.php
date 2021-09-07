<?php

namespace App\Http\Livewire\Table;

use Livewire\Component;
use Livewire\WithPagination;

class Main extends Component
{
    use WithPagination;

    public $model;
    public $name;
    public $dataId;

    public $perPage = 10;
    public $sortField = "id";
    public $sortAsc = false;
    public $search = '';

    protected $listeners = [ "deleteItem" => "delete_item" ];

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortAsc = ! $this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    public function get_pagination_data ()
    {
        switch ($this->name) {
            case 'user':
                $users = $this->model::search($this->search)
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);

                return [
                    "view" => 'livewire.table.user',
                    "users" => $users,
                    "data" => array_to_object([
                        'href' => [
                            'create_new' => route('admin.user.new'),
                            'create_new_text' => 'Buat User Baru',
                            'export' => '#',
                            'export_text' => 'Export'
                        ]
                    ])
                ];
                break;
            case 'cash-book':
                $cashBooks = $this->model::search($this->dataId)
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);

                return [
                    "view" => 'livewire.table.cash-book',
                    "cashBooks" => $cashBooks,
                    "data" => array_to_object([
                        'href' => [
                            'create_new' => route('admin.cash-book.create',$this->dataId),
                            'create_new_text' => 'Tambah data kas baru',
                        ]
                    ])
                ];
                break;
            case 'cash-note':
                $cashNotes = $this->model::search($this->search,$this->dataId)
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);

                return [
                    "view" => 'livewire.table.cash-note',
                    "cashNotes" => $cashNotes,
                    "data" => array_to_object([
                        'href' => [
                            'create_new' => route('admin.cash-note.create',$this->dataId),
                            'create_new_text' => 'Buka dan tutup buku',
                        ]
                    ])
                ];
                break;
            case 'product':
                $products = $this->model::search($this->search)
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);

                return [
                    "view" => 'livewire.table.product',
                    "products" => $products,
                    "data" => array_to_object([
                        'href' => [
                            'create_new' => route('admin.product.create'),
                            'create_new_text' => 'Tambah produk baru',
                        ]
                    ])
                ];
                break;
            case 'product-type':
                $productTypes = $this->model::search($this->search)
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);
                return [
                    "view" => 'livewire.table.product-type',
                    "productTypes" => $productTypes,
                    "data" => array_to_object([
                        'href' => [
                            'create_new' => route('admin.product-type.create'),
                            'create_new_text' => 'Tambah UMKM baru',
                        ]
                    ])
                ];
                break;
            case 'transaction-history':
                $transactions = $this->model::search($this->search,[3])
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);

                return [
                    "view" => 'livewire.table.transaction-history',
                    "transactions" => $transactions,
                    "data" => array_to_object([
                        'href' => [

                        ]
                    ])
                ];
                break;
            case 'transaction-active':
                $transactions = $this->model::search($this->search,[1,2])
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);

                return [
                    "view" => 'livewire.table.transaction-active',
                    "transactions" => $transactions,
                    "data" => array_to_object([
                        'href' => [

                        ]
                    ])
                ];
                break;
            case 'content':
                $contents = $this->model::search($this->search)
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);

                return [
                    "view" => 'livewire.table.content',
                    "contents" => $contents,
                    "data" => array_to_object([
                        'href' => [
                            'create_new' => route('admin.content.create'),
                            'create_new_text' => 'Create new content',
                            'export' => '#',
                            'export_text' => 'Export'
                        ]
                    ])
                ];
                break;

            default:
                # code...
                break;
        }
    }

    public function delete_item ($id)
    {
        $data = $this->model::find($id);

        if (!$data) {
            $this->emit("deleteResult", [
                "status" => false,
                "message" => "Gagal menghapus data " . $this->name
            ]);
            return;
        }

        $data->delete();
        $this->emit("deleteResult", [
            "status" => true,
            "message" => "Data " . $this->name . " berhasil dihapus!"
        ]);
    }

    public function render()
    {
        $data = $this->get_pagination_data();

        return view($data['view'], $data);
    }
}
