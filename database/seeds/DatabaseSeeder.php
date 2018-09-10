<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(BbsUserTableSeeder::class);
		$this->call(BbsTopicsTableSeeder::class);
        $this->call(BbsReplysTableSeeder::class);
        $this->call(BbsLinksTableSeeder::class);
    }
}
