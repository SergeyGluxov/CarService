<?php

use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call([
            factory(App\User::class, 10)->create(),
           //Предопределенные данные
            factory(App\User::class)->create([
                'name'=>'Сергей',
                'email'=>'gluxov-serega@mail.ru',
                'password'=>'$2y$10$4f8Q7ScRR.RWl/0kRsfYLOMDXB2Sv6MMEyPIBNIhYJXSynvOXYVM.'
            ]),
            factory(App\Car::class,50)->create()
        ]);
    }
}
