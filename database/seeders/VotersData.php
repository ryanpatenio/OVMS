<?php

namespace Database\Seeders;


use App\Models\Ballot;
use App\Models\Voters;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VotersData extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataBallot = [
            'ballot_name'=>'SUNs Company',
            'details'=>'lorem2 2',
            'ballot_key'=>bcrypt(123456),
            'publish_status'=>'0',
            'id'=>'1'


           ];
           Ballot::create($dataBallot);

        $data = [
            'name'=>'James Bond',
            'email'=>'jameswong@gmail.com',
            'password'=>bcrypt(123456),
            'ballot_id'=>'1',

           ];
           Voters::create($data);



    }
}
