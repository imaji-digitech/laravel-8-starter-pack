<?php

namespace Database\Seeders;

use App\Models\CodeCashBook;
use App\Models\PaymentStatus;
use App\Models\Status;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Status::create(['title' => 'Belum terbayar']);
        Status::create(['title' => 'Sebagian terbayar']);
        Status::create(['title' => 'Sudah terbayar']);

        PaymentStatus::create(['title' => 'Transfer']);
        PaymentStatus::create(['title' => 'Tunai']);
        PaymentStatus::create(['title' => 'Piutang Usaha']);

        CodeCashBook::create(['title' => 'Kas Awal']);
        CodeCashBook::create(['title' => 'Pendanaan']);
        CodeCashBook::create(['title' => 'Pendapatan']);
        CodeCashBook::create(['title' => 'Biaya Produksi']);
        CodeCashBook::create(['title' => 'Pembelian']);
        CodeCashBook::create(['title' => 'Hutang']);
        CodeCashBook::create(['title' => 'Piutang']);
        CodeCashBook::create(['title' => 'Biaya Pemasaran']);
        CodeCashBook::create(['title' => 'Biaya Packing']);
        CodeCashBook::create(['title' => 'Biaya Transportasi']);
        CodeCashBook::create(['title' => 'Biaya Listrik']);
        CodeCashBook::create(['title' => 'Biaya Air']);
        CodeCashBook::create(['title' => 'Biaya Upah']);
        CodeCashBook::create(['title' => 'Prive']);
        CodeCashBook::create(['title' => 'Musibah']);
        CodeCashBook::create(['title' => 'Lainnya']);
        CodeCashBook::create(['id' => 999, 'title' => 'Pembukaan toko']);

//        User::create('')
    }
}
