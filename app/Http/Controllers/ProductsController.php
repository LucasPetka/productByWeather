<?php

namespace App\Http\Controllers;
use App\WeatherCondition;
use App\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    function getRecommended($city){

        $rUrl = 'https://api.meteo.lt/v1/places/'. $city .'/forecasts/long-term';

        if (!$data = json_decode(@file_get_contents($rUrl), true)) {
            $data = ['input' => $city,'error' => "Wrong Input" ];
            return $data;
        } else {
            $data = json_decode(file_get_contents($rUrl), true);
        }

        $currentTime = (date('i') > 30) ? date("Y-m-d H:00:00") : date('Y-m-d H:00:00', strtotime('1 hour'));
        $forecastAtExactHour = null;
        foreach($data['forecastTimestamps'] as $forecast) {
            if ($currentTime == $forecast['forecastTimeUtc']) {
                $forecastAtExactHour = $forecast;
                break;
            }
        }

        $conditionId = WeatherCondition::where('name', $forecastAtExactHour['conditionCode'])->first();
        $products = Product::select('sku', 'name', 'price')->whereJsonContains('weather_conditions', $conditionId->id)->get();

        $returnData = [
            'city' => $data['place']['name'],
            'current_weather' => $forecastAtExactHour['conditionCode'],
            'recommended_products' => $products,
        ];

        return $returnData;
    }
}
