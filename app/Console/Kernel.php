<?php

namespace App\Console;

use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;

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
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */

    private function getPlus($value)
    {
        $now = Carbon::parse(date('Y-m-d H:i:s'));
        $pay = Carbon::parse($value);
        $interval = $now->diffInMinutes($pay) / 60;
        $total = 0;

        switch (true) {
            case $interval <= 1:
                $total = 0;
                break;
            case $interval >= 1 && $interval <= 2:
                $total = 20;
                break;
            case $interval >= 2 && $interval <= 3:
                $total = 60;
                break;
            case $interval >= 3 && $interval <= 4:
                $total = 240;
                break;
            case $interval > 4:
                $total = 300;
                break;
            default:
                # code...
                break;
        }

        return $total;
    }

    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            $allUnpaid = DB::table('books')->where('payment', 'unpaid')->get();
            foreach ($allUnpaid as $key => $value) {
                $bill = $this->getPlus($value->start_session);
                DB::table('books')->where('id', $value->id)->update(['bill' => $bill]);
            }
        })->hourly();
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
