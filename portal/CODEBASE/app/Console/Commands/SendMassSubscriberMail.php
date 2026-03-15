<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mail;
use DB;

use App\Mail\SubscriberMail;

class SendMassSubscriberMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mass-mail:registration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $mailArrs = DB::table('temp_subscribers')->where('sent', 0)->select('email')->take(100)->get();
        $emails = [];
        if(count($mailArrs) > 1) {
            foreach($mailArrs as $mailArr) {
                $emails[] = $mailArr->email;
            }
    
            if(!empty($emails)) {
                Mail::to('info@ubidindia.com')
                    ->bcc($emails)
                    ->send(new SubscriberMail());
    
                if(!Mail::failures()) {
                    DB::table('temp_subscribers')->whereIn('email', $emails)->update(['sent'=>1]);
                }
                DB::table('temp_subscribers')->where('email', 'ranjanm@mirakitech.com')->update(['sent'=>0]);
            }
        }
        
        return 1;
    }
}
