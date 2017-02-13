<?php

use Illuminate\Database\Seeder;

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

        for ($i = 0; $i < $limit; $i++) {
            DB::table('student')->insert([ //,
                'name'=>$faker->unique()->name,
                'nickname'=>$faker->unique()->word,
                'kattis'=>$faker->unique()->word,
                'country' => $faker->countryCode,
                'mc' => $this->generate_mc(),
                'tc' => $this->generate_tc(),
                'hw' => $this->generate_hw(),
                'bs' => $this->generate_bs(),
                'ks' => $this->generate_ks(),
                'ac' => $this->generate_ac(),
                'comment' => $faker->text($maxNbChars = 100),
            ]);
        }
    }

    private function generate_mc()
    {
        $faker = Faker\Factory::create();
        $min = 0;
        $max = 4;
        $n = 9;
        $arr = [];
        $z = min($faker->randomDigit, $n);
        for ($i=0;$i<$n;$i++){
            if($i > $z){
                $arr[] = 'x';
            } else {
                $arr[] = $faker->numberBetween($min*2, $max*2)/2;
            }
        }
        return implode(",", $arr);
    }

    private function generate_tc()
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
    private function generate_hw()
    {
        $faker = Faker\Factory::create();
        $min = 0;
        $max = 1.5;
        $n = 10;
        $arr = [];
        $z = min($faker->randomDigit, $n);
        for ($i=0;$i<$n;$i++){
            if($i > $z){
                $arr[] = 'x';
            } else {
                $arr[] = $faker->numberBetween($min*2, $max*2)/2;
            }
        }
        return implode(",", $arr);
    }
    private function generate_bs()
    {
        $faker = Faker\Factory::create();
        $min = 0;
        $max = 1;
        $n = 9;
        $arr = [];
        $z = min($faker->randomDigit, $n);
        for ($i=0;$i<$n;$i++){
            if($i > $z){
                $arr[] = 'x';
            } else {
                $arr[] = $faker->numberBetween($min, $max);
            }
        }
        return implode(",", $arr);
    }
    private function generate_ks()
    {
        $faker = Faker\Factory::create();
        $min = 0;
        $max = 1;
        $n = 12;
        $arr = [];
        $z = min($faker->randomDigit, $n);
        for ($i=0;$i<$n;$i++){
            if($i > $z){
                $arr[] = 'x';
            } else {
                $arr[] = $faker->numberBetween($min, $max);
            }
        }
        return implode(",", $arr);
    }
    private function generate_ac()
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
