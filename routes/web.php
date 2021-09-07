<?php

use App\Http\Controllers\Admin\CashBookController;
use App\Http\Controllers\Admin\CashNoteController;
use App\Http\Controllers\Admin\ContentController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductTypeController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\UserController;
use App\Models\CashBook;
use App\Models\CashNote;
use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Laravel\Jetstream\Http\Controllers\CurrentTeamController;
use Laravel\Jetstream\Http\Controllers\Livewire\ApiTokenController;
use Laravel\Jetstream\Http\Controllers\Livewire\TeamController;
use Laravel\Jetstream\Http\Controllers\Livewire\UserProfileController;
use Laravel\Jetstream\Jetstream;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|

*/


Route::get('/dashboard', function () {
    return redirect(route('admin.dashboard'));
});

Route::get('simple-qr-code', function () {
    return view('pdf.product');
});

Route::name('admin.')->prefix('admin')->middleware(['auth:sanctum', 'web', 'verified'])->group(function () {
    Route::post('/summernote-upload', [SupportController::class, 'upload'])->name('summernote_upload');
    Route::view('/dashboard', "dashboard")->name('dashboard');
    Route::resource('content', ContentController::class)->only(['index', 'create', 'edit']);
    Route::resource('product-type', ProductTypeController::class)->only(['index', 'create', 'edit']);
    Route::get('product-type/export/{id}', function ($id) {
        $umkm = ProductType::find($id);
        $turnover = 0;
        foreach ($umkm->products as $u) {
            $turnover += $u->transactionPaymentDetails->sum('total');
        }
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('pdf.umkm', compact('umkm', 'turnover'));
        return $pdf->stream();
    })->name('product-type.export');

    Route::resource('product', ProductController::class)->only(['index', 'create', 'show', 'edit']);
    Route::get('product/export/{id}', function ($id) {
        $product = Product::find($id);
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('pdf.product', compact('product'));
        return $pdf->stream();
    })->name('product.export');

//    Route::resource('cash-book', CashBookController::class)->only(['index', 'create', 'edit']);
    Route::get('/cash-book/{umkm}', [CashBookController::class, 'index'])->name('cash-book.index');
    Route::get('/cash-book/{umkm}/create', [CashBookController::class, 'create'])->name('cash-book.create');
    Route::get('/cash-book/{umkm}/edit/{id}', [CashBookController::class, 'edit'])->name('cash-book.edit');

//    Route::resource('cash-note', CashNoteController::class)->only(['index', 'create', 'edit', 'show']);
    Route::get('/cash-note/{umkm}', [CashNoteController::class, 'index'])->name('cash-note.index');
    Route::get('/cash-note/{umkm}/create', [CashNoteController::class, 'create'])->name('cash-note.create');
    Route::get('/cash-note/{umkm}/edit/{id}', [CashNoteController::class, 'edit'])->name('cash-note.edit');
    Route::get('/cash-note/{umkm}/show/{id}', [CashNoteController::class, 'show'])->name('cash-note.show');
    Route::get('/cash-note/{umkm}/export{id}', function ($umkm,$id) {
        $umkm = ProductType::find($umkm);
        $c1 = CashNote::find($id);
        $c = CashNote::whereProductTypeId($umkm->id)->where('id', '<', $id)->orderByDesc('id')->first();
        $cashBooks = CashBook::whereProductTypeId($umkm->id)
            ->where('id', '<=', $c1->cash_book_id)
            ->where('id', '>=', $c->cash_book_id)->get();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('pdf.cash-note', compact('cashBooks','c1','c','umkm'));
        return $pdf->stream();
    })->name('cash-note.export');

    Route::get('/product/manufacture/{id}', [ProductController::class, 'manufacture'])->name('product.manufacture');
    Route::post('/product', [ProductController::class, 'graph'])->name('product.graph');
    Route::get('/transaction/create', [TransactionController::class, 'create'])->name('transaction.create');
    Route::get('/transaction/history', [TransactionController::class, 'history'])->name('transaction.history');
    Route::get('/transaction/active', [TransactionController::class, 'active'])->name('transaction.active');
    Route::get('/transaction/payment/{id}', [TransactionController::class, 'payment'])->name('transaction.payment');
    Route::get('/transaction/return/{id}', [TransactionController::class, 'return'])->name('transaction.return');
    Route::get('/transaction/show/{id}', [TransactionController::class, 'show'])->name('transaction.show');

    Route::get('/user', [UserController::class, "index"])->name('user');
    Route::view('/user/new', "pages.user.create")->name('user.new');
    Route::view('/user/edit/{userId}', "pages.user.edit")->name('user.edit');

    Route::group(['middleware' => config('jetstream.middleware', ['web'])], function () {
        Route::group(['middleware' => ['auth', 'verified']], function () {
            // User & Profile...
            Route::get('/user/profile', [UserProfileController::class, 'show'])
                ->name('profile.show');

            // API...
            if (Jetstream::hasApiFeatures()) {
                Route::get('/user/api-tokens', [ApiTokenController::class, 'index'])->name('api-tokens.index');
            }

            // Teams...
            if (Jetstream::hasTeamFeatures()) {
                Route::get('/teams/create', [TeamController::class, 'create'])->name('teams.create');
                Route::get('/teams/{team}', [TeamController::class, 'show'])->name('teams.show');
                Route::put('/current-team', [CurrentTeamController::class, 'update'])->name('current-team.update');
            }
        });
    });

});
