<?php

use Illuminate\Database\Seeder;

class CreatorStatsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['record_date' => '2019-03-01', 'channel' => 'all', 'verified_creators' => 79000],
            ['record_date' => '2019-04-01', 'channel' => 'all', 'verified_creators' => 95000],
            ['record_date' => '2019-05-01', 'channel' => 'all', 'verified_creators' => 127000],
            ['record_date' => '2019-06-01', 'channel' => 'all', 'verified_creators' => 150000],
            ['record_date' => '2019-07-01', 'channel' => 'all', 'verified_creators' => 185000],
            ['record_date' => '2019-08-01', 'channel' => 'all', 'verified_creators' => 226000],
            ['record_date' => '2019-09-01', 'channel' => 'all', 'verified_creators' => 260000],
            ['record_date' => '2019-10-01', 'channel' => 'all', 'verified_creators' => 290000],
            ['record_date' => '2019-11-01', 'channel' => 'all', 'verified_creators' => 320000],
            ['record_date' => '2019-12-01', 'channel' => 'all', 'verified_creators' => 350000],
            ['record_date' => '2020-01-01', 'channel' => 'all', 'verified_creators' => 390000],
            ['record_date' => '2020-02-01', 'channel' => 'all', 'verified_creators' => 440000],
            ['record_date' => '2020-03-01', 'channel' => 'all', 'verified_creators' => 500000],
        ];
        foreach ($data as $record) {
            DB::table('creator_stats')->insert($record);
        }
    }
}
