<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class WalletSeeder extends Seeder
{
    
    public function run()
    {
        $user = User::whereType(User::VENDOR)->get();
        
        $user->each(function (User $user) {

            $user->hasWallet('Vendor Wallet'); // bool(true)

            $wallet = $user->createWallet([
                'name' => 'Vendor Wallet',
                'slug' => 'vendor-default',
            ]);
            
            $user->hasWallet('Vendor Wallet'); // bool(true)
            
            $wallet->deposit(100); 
        });        
    }
}
