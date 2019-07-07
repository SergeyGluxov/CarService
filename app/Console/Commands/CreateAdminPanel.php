<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateAdminPanel extends Command
{
    //Имя, по которому обращаемся к команде
    protected $signature = 'create:admin';
    //Описание
    protected $description = 'Команда, для создания vendor и config AdminLTE';

    //Конструктор
    public function __construct()
    {
        parent::__construct();
    }

    //Метод
    public function handle()
    {
        $this->call('vendor:publish',[
            '--provider'=>"JeroenNoten\LaravelAdminLte\ServiceProvider",
            '--tag=assets']);
        $this->call('vendor:publish',[
            '--provider'=>"JeroenNoten\LaravelAdminLte\ServiceProvider",
            '--tag=assets --force']);
    }
}
