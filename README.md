# Introduction

This is application which recommends products by the current weather in the city you choose.

For this application LHMT API was used  [API](https://api.meteo.lt/)

[Hosted Application link on Google Cloud](https://letsgo-249009.ey.r.appspot.com/)

## Installation if you want to launch application on your device

Firstly you need to pull the repository to your computer and in that folder terminal write:

```bash
composer install
```
to install all added packages.

Then for edit .env file to access Database. And write to console:

```bash
php artisan migrate
```
to install all tables to your DB.

After that you can use re-prepared seed'ers who will going to fill you DB tables with data.

```bash
php artisan db:seed 
php artisan db:seed --class=ProductSeeder
```

Then you can just launch application by typing:

```bash
php artisan serve
```

## Usage

When you are you going to open application you will see 4 different cities. When you click one of them they are going to transfer you to API result page.

And you as example going to see this view:
```json
{
 city: "Klaipėda",
 current_weather: "clear",
 recommended_products: [
   {
     sku: "fg-gv",
     name: "Fugit.",
     price: 43.9
   },
   {
     sku: "rw-cb",
     name: "Explicabo.",
     price: 134.18
   },
   {
     sku: "sr-ah",
     name: "Quisquam.",
     price: 161.85
     }
 ]
}
```
