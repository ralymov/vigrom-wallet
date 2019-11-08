<?php

use App\Currency;
use App\Models\Wallet;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $wallet = new Wallet();
        $wallet->currency()->associate(Currency::whereCode(Currency::RUB)->first()->id);
        $wallet->save();
        $user = User::create([
            'name' => 'Roman',
            'email' => 'romanalym@gmail.com',
            'password' => '123456',
            'wallet_id' => $wallet->id
        ]);

        $wallet = new Wallet();
        $wallet->currency()->associate(Currency::whereCode(Currency::USD)->first()->id);
        $wallet->save();
        $user = User::create([
            'name' => 'Alex',
            'email' => 'alex@gmail.com',
            'password' => 'qwerty',
            'wallet_id' => $wallet->id
        ]);
    }
}
