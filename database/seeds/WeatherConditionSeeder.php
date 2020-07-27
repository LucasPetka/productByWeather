<?php

use Illuminate\Database\Seeder;

class WeatherConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('weather_conditions')->insert(['name' => 'clear']);
        DB::table('weather_conditions')->insert(['name' => 'isolated-clouds']);
        DB::table('weather_conditions')->insert(['name' => 'scattered-clouds']);
        DB::table('weather_conditions')->insert(['name' => 'overcast']);
        DB::table('weather_conditions')->insert(['name' => 'light-rain']);
        DB::table('weather_conditions')->insert(['name' => 'moderate-rain']);
        DB::table('weather_conditions')->insert(['name' => 'heavy-rain']);
        DB::table('weather_conditions')->insert(['name' => 'sleet']);
        DB::table('weather_conditions')->insert(['name' => 'light-snow']);
        DB::table('weather_conditions')->insert(['name' => 'moderate-snow']);
        DB::table('weather_conditions')->insert(['name' => 'heavy-snow']);
        DB::table('weather_conditions')->insert(['name' => 'fog']);
        DB::table('weather_conditions')->insert(['name' => 'na']);
    }
}
