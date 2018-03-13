<?php

use Illuminate\Database\Seeder;
use App\Models\Notice;
use App\Models\NoticeProgram;
use App\Models\Program;
use App\User;
class AddFirstProgram extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user   = User::where('institution','Gobierno Fácil')->where('enabled',1)->where('type','admin')->first();
        $notice = Notice::firstOrCreate([
          'title' => 'Convocatoria 2017',
          'slug'  => str_slug('Convocatoria 2017'),
          'user_id' => $user->id,
          'public' => 0
        ]);
        $notice->start = '2017-02-01';
        $notice->end = '2017-03-25';
        $notice->save();
        $program = Program::firstOrCreate([
          'title' => 'Programa 2017',
          'slug'  => str_slug('Programa 2017'),
        ]);
        $program->public = 1;
        $program->notice_id = $notice->id;
        $program->start = '2017-08-31';
        $program->end = '2017-11-25';
        $program->save();
        $noticeProgram = NoticeProgram::firstOrCreate(['notice_id'=>$notice->id,'program_id'=>$program->id]);
        $this->command->info('First program created');
    }
}
