<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $limit = 50;

        $week = 12;

        for ($i = 0; $i < $limit; $i++) {
            DB::table('students')->insert([ //,
                'name'=>$faker->unique()->name,
                'nickname'=>$faker->unique()->word,
                'kattis'=>$faker->unique()->word,
                'country' => $faker->countryCode,
                'comment' => $faker->text($maxNbChars = 100),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'created_by' => 1,
                'updated_by'=> 1,
                'latest_score_id' => $week * $i+1,
            ]);
        }

        for ($i = 0; $i < $limit; $i++) {
            for ($j = 0; $j < $week; $j++) {
                DB::table('scores')->insert([ //,
                    'student_id' => $i+1,
                    'mc' => $this->generate_mc($week-$j),
                    'tc' => $this->generate_tc($week-$j),
                    'hw' => $this->generate_hw($week-$j),
                    'bs' => $this->generate_bs($week-$j),
                    'ks' => $this->generate_ks($week-$j),
                    'ac' => $this->generate_ac($week-$j),
                    'effective_from' => Carbon::now()->subWeeks($j),
                    'created_at' => Carbon::now()->subWeeks($j),
                    'updated_at' => Carbon::now()->subWeeks($j),
                    'created_by' => 1,
                    'updated_by'=> 1,
                ]);
            }
        }
    }

    private function generate_mc($j)
    {
        $faker = Faker\Factory::create();
        $min = 0;
        $max = 4;
        $n = 9;
        $arr = [];
        $z = min($j, $n);
        for ($i=0;$i<$n;$i++){
            if($i > $z){
                $arr[] = 'x';
            } else {
                $arr[] = $faker->numberBetween($min*2, $max*2)/2;
            }
        }
        return implode(",", $arr);
    }

    private function generate_tc($j)
    {
        $faker = Faker\Factory::create();
        $x_min = 0;
        $x_max = 10.5;
        $y_min = 0;
        $y_max  = 13.5;
        $arr = [];
        $arr[] = $faker->numberBetween($x_min*2, $x_max*2)/2;
        $arr[] = $faker->numberBetween($y_min*2, $y_max*2)/2;
        return implode(",", $arr);
    }
    private function generate_hw($j)
    {
        $faker = Faker\Factory::create();
        $min = 0;
        $max = 1.5;
        $n = 10;
        $arr = [];
        $z = min($j, $n);
        for ($i=0;$i<$n;$i++){
            if($i > $z){
                $arr[] = 'x';
            } else {
                $arr[] = $faker->numberBetween($min*2, $max*2)/2;
            }
        }
        return implode(",", $arr);
    }
    private function generate_bs($j)
    {
        $faker = Faker\Factory::create();
        $min = 0;
        $max = 1;
        $n = 9;
        $arr = [];
        $z = min($j, $n);
        for ($i=0;$i<$n;$i++){
            if($i > $z){
                $arr[] = 'x';
            } else {
                $arr[] = $faker->numberBetween($min, $max);
            }
        }
        return implode(",", $arr);
    }
    private function generate_ks($j)
    {
        $faker = Faker\Factory::create();
        $min = 0;
        $max = 1;
        $n = 12;
        $arr = [];
        $z = min($j, $n);
        for ($i=0;$i<$n;$i++){
            if($i > $z){
                $arr[] = 'x';
            } else {
                $arr[] = $faker->numberBetween($min, $max);
            }
        }
        return implode(",", $arr);
    }
    private function generate_ac($j)
    {
        $faker = Faker\Factory::create();
        $x_min = 0;
        $x_max = 1;
        $y_min = 0;
        $y_max = 3;
        $z_min = 0;
        $z_max = 6;
        $arr = [];
        $arr[] = $faker->numberBetween($x_min, $x_max);
        $arr[] = $faker->numberBetween($x_min, $x_max);
        $arr[] = $faker->numberBetween($y_min, $y_max);
        $arr[] = $faker->numberBetween($y_min, $y_max);
        $arr[] = $faker->numberBetween($x_min, $x_max);
        $arr[] = $faker->numberBetween($x_min, $x_max);
        $arr[] = $faker->numberBetween($z_min, $z_max);
        $arr[] = $faker->numberBetween($x_min, $x_max);        
        return implode(",", $arr);
    }

}
