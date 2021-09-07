<?php

namespace App\Console;

use App\Models\CashBook;
use App\Models\CashNote;
use App\Models\TransactionPaymentDetail;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $total = TransactionPaymentDetail::whereDate('created_at', Carbon::today())->get();
            if ($total) {
                $data = [
                    'code_cash_book_id' => 2,
                    'note' => 'Pendapatan',
                    'income' => $total->sum('total'),
                    'outcome' => 0
                ];
                CashBook::create($data);
            }
        })->dailyAt('23.50');

//        $schedule->call(function () {
//            $cashNote=CashNote::orderByDesc('id')->first();
//            $cashbook = CashBook::where('id','<',$cashNote->cash_book_id)->get();
//            $data = [
//                'cash_book_id'=>$cashNote->cash_book_id+1,
//                'balance'=>$cashNote->balance+$cashbook->sum('income')-$cashbook->sum('outcome')
//            ];
//            CashNote::create($data);
//        })->lastDayOfMonth('23:55');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
