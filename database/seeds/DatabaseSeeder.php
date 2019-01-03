<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use \Carbon\Carbon;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $request = json_decode(file_get_contents('https://raw.githubusercontent.com/pricesearcher/web-developer-code-test/master/test_data.json'), true);

        if(empty($request)){
            die("Could not seed from external file. ");
        }
        foreach ($request as $action) {

            DB::table('action_items')->insert([
                'id' => (int)$action['id'],
                'descr' => $action['descr']
            ]);

        }

    }
}
