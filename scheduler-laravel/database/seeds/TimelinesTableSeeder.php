<?php

use Illuminate\Database\Seeder;

class TimelinesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('timelines')->insert([
            ['id'         => 1, 'text'=>'Event #1', 'start_date'=>'2019-12-05 08:00:00',
                'end_date'=> '2019-12-05 12:00:00', 'subject'=> 'meeting', ],
            ['id'         => 2, 'text'=>'Event #2', 'start_date'=>'2019-12-06 15:00:00',
                'end_date'=> '2019-12-06 16:30:00', 'subject'=> 'meeting', ],
            ['id'         => 3, 'text'=>'Event #3', 'start_date'=>'2019-12-04 00:00:00',
                'end_date'=> '2019-12-20 00:00:00', 'subject'=> 'delivery', ],
            ['id'         => 4, 'text'=>'Event #4', 'start_date'=>'2019-12-01 08:00:00',
                'end_date'=> '2019-12-01 12:00:00', 'subject'=> 'meeting', ],
            ['id'         => 5, 'text'=>'Event #5', 'start_date'=>'2019-12-20 08:00:00',
                'end_date'=> '2019-12-20 12:00:00', 'subject'=> 'crucial', ],
            ['id'         => 6, 'text'=>'Event #6', 'start_date'=>'2019-12-25 08:00:00',
                'end_date'=> '2019-12-25 12:00:00', 'subject'=> 'delivery', ],
        ]);
    }
}
