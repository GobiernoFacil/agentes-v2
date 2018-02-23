<?php

namespace App\Console;

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
        Commands\DeleteExpiredCodes::class,
        Commands\SendMassiveEmails::class,
        Commands\SendAspirantsCount::class,
        Commands\AddAspirants::class,
        Commands\CreateFellows::Class,
        Commands\ForumLogs::Class,
        Commands\UpdateAverages::Class,
        Commands\CreateCsvFacSurvey::Class,
        Commands\CreateCsvFellowsSurvey::Class,
        Commands\CreateGraphs::Class,
        Commands\CreateFacGraphs::Class,
        Commands\CreateCustomQuestionnaire::Class,
        Commands\CreateDiagnosticFiles::Class,
        Commands\AddGenderToFellows::Class,
        Commands\AssignAspirants::Class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
      //  $schedule->command('command:delete-expired-codes')
      //           ->cron('30 12 01 */5 *');
        /*         $schedule->command('command:aspirant-count')
                          ->dailyAt('16:30');*/
      $schedule->command('command:update-averages')
              ->dailyAt('10:00')
              ->emailOutputTo('carlos@gobiernofacil.com');
    /*  $schedule->command('command:create-csv-fac-survey')
                      ->dailyAt('17:00')
                      ->emailOutputTo('carlos@gobiernofacil.com');*/
                      $schedule->command('command:create-diagnostic-files')
                              ->dailyAt('08:00')
                              ->emailOutputTo('carlos@gobiernofacil.com');
                              $schedule->command('command:assign-aspirant-to')
                                      ->dailyAt('10:00');
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
