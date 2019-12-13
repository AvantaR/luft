# luft
Airly PHP API client. 

![](https://github.com/avantar/luft/workflows/build/badge.svg)
[![codecov](https://codecov.io/gh/AvantaR/luft/branch/master/graph/badge.svg)](https://codecov.io/gh/AvantaR/luft)
[![Maintainability](https://api.codeclimate.com/v1/badges/d9e734016ed9ffe9c3b3/maintainability)](https://codeclimate.com/github/AvantaR/luft/maintainability)


## How to use

#### Create new instance of Luft library:

To use Luft library You need to create new instance of Client class and pass API key in its constructor.
```
$luft = new Client($apiKey);
```
```$apiKey``` variable is your private api key provided by Airly (https://developer.airly.eu/api).

#### Changing language
You can change default language of API responses. Airly API currently supports only two languages – English (en - and it's default option) and Polish (pl). To change language use ```setLanguage()``` method.

```
$luft->setLanguage('pl');
```

#### Coordinates
All coordinates used in Airly API **MUST** be accorded to **WGS 84 standard**. 

#### Available methods

**getInstallationsNearest** – gets installations available in given range from selected point.

Required params:
* float $latitude
* float $longitude

Optional params
* float $maxDistanceKM
* int $maxResults

```
getInstallationsNearest(float $latitude, float $longitude [,float $maxDistanceKM, int $maxResults]): array
```
It should return array of ```Installation``` objects.

### Available objects

#### Installation
Available methods:
* getId(): int
* getLocation(): Coordinates
* getAddress(): Address
* getElevation(): float
* getAirly(): boolean
* getSponsor(): Sponsor