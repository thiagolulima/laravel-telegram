<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\telegram\TelegramBot;

class commandBot extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'telegram:bot';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Responde Mensagens Recebidas Pelo Bot';

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
        $bot = new TelegramBot();
        $bot->getMensagensTelegram();
    }
}
