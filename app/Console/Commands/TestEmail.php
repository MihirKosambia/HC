<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Message;

class TestEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a test email to verify mail configuration';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Sending test email...');
        
        try {
            Mail::raw('This is a test email from your Laravel application to verify mail configuration.', function (Message $message) {
                $message->to(config('mail.admin_address'))
                        ->subject('Test Email from Laravel App');
            });
            
            $this->info('Test email sent successfully!');
        } catch (\Exception $e) {
            $this->error('Failed to send test email!');
            $this->error($e->getMessage());
        }
    }
}
