<?php

use Illuminate\Database\Seeder;
use App\BankAcount;

class SeedBankAcounts extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $listBankAcount = [
            ['bank_id' => 970405, 'bank_name' => 'AGRIBANK', 'acount_number' => '6606205200693', 'acount_name' => 'DOAN CHI THIEN'],
            ['bank_id' => 970415, 'bank_name' => 'VIETINBANK', 'acount_number' => '0816707949', 'acount_name' => 'DOAN CHI THIEN'],
            ['bank_id' => 970432, 'bank_name' => 'VPBANK', 'acount_number' => '0816707949', 'acount_name' => 'DOAN CHI THIEN'],
            ['bank_id' => 970418, 'bank_name' => 'BIDV', 'acount_number' => '65010003001338', 'acount_name' => 'DAM MINH KHANH']
        ];
        BankAcount::insert($listBankAcount);
    }
}
