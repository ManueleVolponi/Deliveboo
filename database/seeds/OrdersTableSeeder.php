<?php

use Illuminate\Database\Seeder;
use App\Order;

use Faker\Generator as Faker;

class OrdersTableSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create();
        $faker->addProvider(new \Faker\Provider\it_IT\Person($faker));

        //array temporaneo che contiene i possibili status per l'ordine
        $temp_status_array = [ 
            0=>'waiting for payment',
            1=>'payment rejected',
            2=>'pending',
            3=>'accepted',
            4=>'cooking',
            5=>'completed'
        ];

        for ($i=0; $i < 100; $i++) { 

            $new_order = new Order();

            //customer personal infos
            $new_order->name = $faker->firstName(); 
            $new_order->last_name = $faker->lastName();
            $new_order->email = $faker->safeEmail();
            $new_order->phone = '3' . $faker->shuffle('012345678');
            //address infos
            $new_order->delivery_address = $faker->address();
            $new_order->status = $temp_status_array[$faker->numberBetween(0,5)];
            $new_order->price = $faker->randomFloat(2, 1, 50);
         
            $new_order->save();
        }
    }
}
