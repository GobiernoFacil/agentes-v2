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
        Commands\AssignAspirants::Class,
        Commands\SendAspirantReminder::Class,
        Commands\AttachPreDataToProgram::Class,
        Commands\AllowAspirantsUpload::Class,
        Commands\CreateAspirantsCsv::Class,
        Commands\ExportAspirantsResults::Class,
        Commands\SendAspirantInterviewNotification::Class,
        Commands\ExportAspirantInterviews::Class,
        Commands\ImportInterviewQuestionnaire::Class,
        Commands\ImportSelectedAspirantToProgram::Class,
        Commands\SendFinalEmailToAspirants::Class,
        Commands\UpdateFellowProgress::Class
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


        $today   = date('Y-m-d');
        if($today <= '2018-03-25'){
          $schedule->command('command:send-aspirants-reminder')
                              ->dailyAt('07:00')
                              ->emailOutputTo('carlos@gobiernofacil.com');
          $schedule->command('command:aspirant-count 0')
                              ->dailyAt('20:00');
          $schedule->command('command:aspirant-count 1')
                              ->weekly()
                              ->fridays()->at('08:00');
          $schedule->command('command:aspirant-count 1')
                              ->weekly()
                              ->mondays()->at('20:00');
        }
      /*
      $schedule->command('command:send-aspirants-reminder')
                          ->weekly()
                          ->fridays()->at('08:00')
                          ->emailOutputTo('carlos@gobiernofacil.com');

      $schedule->command('command:update-averages')
                ->dailyAt('10:00')
                ->emailOutputTo('carlos@gobiernofacil.com');
        $schedule->command('command:create-csv-fac-survey')
                        ->dailyAt('17:00')
                        ->emailOutputTo('carlos@gobiernofacil.com');
                        $schedule->command('command:create-diagnostic-files')
                                ->dailyAt('08:00')
                                ->emailOutputTo('carlos@gobiernofacil.com');*/
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
