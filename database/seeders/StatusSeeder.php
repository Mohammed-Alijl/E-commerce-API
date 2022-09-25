<?php

namespace Database\Seeders;

use App\Http\Controllers\Api\Traits\Api_Response;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Exception;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    use Api_Response;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            DB::table('statuses')->insert(['status'=>'Processing']);
            DB::table('statuses')->insert(['status'=>'ٍٍShipping']);
            DB::table('statuses')->insert(['status'=>'Completed']);
            DB::table('statuses')->insert(['status'=>'Rejected']);
        }catch (Exception $ex){
            return $this->apiResponse(null,500,$ex->getMessage());
        }
    }
}
