<?php

namespace App\Http\Controllers;
use App\WeatherCondition;
use App\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    function getRecommended($city){

        $data = static::getApiContent('https://api.meteo.lt/v1/places/'. $city .'/forecasts/long-term', $city);

        if (is_array($data) && array_key_exists('error', $data)) {
            return $data;
        }

        $currentTime = (date('i') > 30) ? date("Y-m-d H:00:00") : date('Y-m-d H:00:00', strtotime('1 hour'));
        $forecastAtExactHour = null;

        //finds the current time forecast
        foreach($data['forecastTimestamps'] as $forecast) {
            if ($currentTime == $forecast['forecastTimeUtc']) {
                $forecastAtExactHour = $forecast;
                break;
            }
        }

        //finds weather condition ID by name and returns products thats contains that ID
        $conditionId = WeatherCondition::where('name', $forecastAtExactHour['conditionCode'])->first();
        $products = Product::select('sku', 'name', 'price')->whereJsonContains('weather_conditions', $conditionId->id)->get();


        $returnData = [
            'city' => $data['place']['name'],
            'current_weather' => $forecastAtExactHour['conditionCode'],
            'recommended_products' => $products,
        ];

        return $returnData;
    }

 

    function getApiContent($url, $input){

        //reading api
        if (!$data = json_decode(@file_get_contents($url), true)) {
            $data = [ 'error' => ['input' => $input, 'code' => 404, 'message' => "Not Found"] ];
            return $data;
        } else {
            $data = json_decode(file_get_contents($url), true);
        }

        return $data;
        
    }


    
}
