<?php
require_once "Widget.php";
class DarkSkyWidget extends Widget {

	protected $apiURI = "https://api.darksky.net/forecast";
	protected $defaultApiUnit = "k";
	protected $apiCall;
	protected $cacheFile;
	public $options = array(
		"appid" => "", // Api Key

		//location options
		"lat" => "",
		"lon" => "",

		"round" => "nearest", //opts: nearest, floor, ceil

		"unit" => "f",
	);

	public function __construct($options) {
		parent::__construct($options);

		// Set location
		$location = "";
		if( !empty($this->options["lat"]) || !empty($this->options["lon"]) ){
			$location =  $this->options["lat"] . "," . $this->options["lon"];
		} else {
			throw new Exception('Lat or Lon Not defined in request.');
		}

		// Offload temp conversion to the api - default F
		$unit = "";
 		if( strtolower($this->options["unit"]) === "c" ){
			$unit = "?units=si";
		}

		// check for necessary options to be set
		$apiKey = $this->options['apiKey'];
		if( $location === "" )
			throw new Exception("Location Not Found or Not Specified", 1);
		if( $apiKey === "" )
			throw new Exception("Api Key Not Specified", 1);

		// set the api call and cachefile for the call.
		$this->apiCall = $this->apiURI . "/" . $apiKey . "/" . $location . "/" . $unit;
		$this->cacheFile = 'cache' . DIRECTORY_SEPARATOR . md5($this->apiCall);

	}

	protected function hasApiError($response) {

		if( !empty($this->curlError) ) {
			return $this->curlError;
		}

		// if( !empty($response["darksky-unavailable"]) ) {
		// 	return $response["darksky-unavailable"];
		// }

		return false;
	}

	protected function dataToCommonJSON($response) {

		$common = $response;

		if( $this->options === 'ceil' ) {
			$common->temp = isset($response->currently->temperature) ? ceil($response->currently->temperature) : "";
		} else if( $this->options === 'floor' ) {
			$common->temp = isset($response->currently->temperature) ? floor($response->currently->temperature) : "";
		} else {
			$common->temp = isset($response->currently->temperature) ? round($response->currently->temperature) : "";
		}
		$common->desc = isset($response->currently->summary) ? $response->currently->summary : "";
		$common->icon = isset($response->currently->icon) ? $this->mapIcon($response->currently->icon) : "";

		return $common;
	}

	protected function mapIcon($code){
		switch ($code) {
			// clear day
			case 'clear-day':
				return "icon-32";
			case 'clear-night':
				return "icon-33";

			// few clouds
			case 'rain':
				return "icon-28";

			// broken clouds
			case 'partly-cloudy-day':
				return "icon-28";
			case 'partly-cloudy-night':
				return "icon-27";

			// cloudy
			case 'cloudy':
				return "icon-26";

			// rain
			case 'rain':
				return "icon-40";

			// thunderstorm
			case 'thunderstorm':
				return "icon-3";

			// snow
			case 'snow':
				return "icon-9";

			// snow
			case 'sleet':
				return "icon-16";

			// snow
			case 'fog':
				return "icon-20";

			// windy
			case 'wind':
				return "icon-24";

			default:
				return "icon-27";
		}
	}

}

/*********************************************************

	API response JSON

**********************************************************
{"latitude":34.7711,"longitude":-112.0579,"timezone":"America/Phoenix","currently":{"time":1529942383,"summary":"Clear","icon":"clear-day","nearestStormDistance":673,"nearestStormBearing":52,"precipIntensity":0,"precipProbability":0,"temperature":28.39,"apparentTemperature":28.39,"dewPoint":2.35,"humidity":0.19,"pressure":1012.54,"windSpeed":0.56,"windGust":1.69,"windBearing":168,"cloudCover":0,"uvIndex":4,"visibility":16.09,"ozone":292.87},"minutely":{"summary":"Clear for the hour.","icon":"clear-day","data":[{"time":1529942340,"precipIntensity":0,"precipProbability":0},{"time":1529942400,"precipIntensity":0,"precipProbability":0},{"time":1529942460,"precipIntensity":0,"precipProbability":0},{"time":1529942520,"precipIntensity":0,"precipProbability":0},{"time":1529942580,"precipIntensity":0,"precipProbability":0},{"time":1529942640,"precipIntensity":0,"precipProbability":0},{"time":1529942700,"precipIntensity":0,"precipProbability":0},{"time":1529942760,"precipIntensity":0,"precipProbability":0},{"time":1529942820,"precipIntensity":0,"precipProbability":0},{"time":1529942880,"precipIntensity":0,"precipProbability":0},{"time":1529942940,"precipIntensity":0,"precipProbability":0},{"time":1529943000,"precipIntensity":0,"precipProbability":0},{"time":1529943060,"precipIntensity":0,"precipProbability":0},{"time":1529943120,"precipIntensity":0,"precipProbability":0},{"time":1529943180,"precipIntensity":0,"precipProbability":0},{"time":1529943240,"precipIntensity":0,"precipProbability":0},{"time":1529943300,"precipIntensity":0,"precipProbability":0},{"time":1529943360,"precipIntensity":0,"precipProbability":0},{"time":1529943420,"precipIntensity":0,"precipProbability":0},{"time":1529943480,"precipIntensity":0,"precipProbability":0},{"time":1529943540,"precipIntensity":0,"precipProbability":0},{"time":1529943600,"precipIntensity":0,"precipProbability":0},{"time":1529943660,"precipIntensity":0,"precipProbability":0},{"time":1529943720,"precipIntensity":0,"precipProbability":0},{"time":1529943780,"precipIntensity":0,"precipProbability":0},{"time":1529943840,"precipIntensity":0,"precipProbability":0},{"time":1529943900,"precipIntensity":0,"precipProbability":0},{"time":1529943960,"precipIntensity":0,"precipProbability":0},{"time":1529944020,"precipIntensity":0,"precipProbability":0},{"time":1529944080,"precipIntensity":0,"precipProbability":0},{"time":1529944140,"precipIntensity":0,"precipProbability":0},{"time":1529944200,"precipIntensity":0,"precipProbability":0},{"time":1529944260,"precipIntensity":0,"precipProbability":0},{"time":1529944320,"precipIntensity":0,"precipProbability":0},{"time":1529944380,"precipIntensity":0,"precipProbability":0},{"time":1529944440,"precipIntensity":0,"precipProbability":0},{"time":1529944500,"precipIntensity":0,"precipProbability":0},{"time":1529944560,"precipIntensity":0,"precipProbability":0},{"time":1529944620,"precipIntensity":0,"precipProbability":0},{"time":1529944680,"precipIntensity":0,"precipProbability":0},{"time":1529944740,"precipIntensity":0,"precipProbability":0},{"time":1529944800,"precipIntensity":0,"precipProbability":0},{"time":1529944860,"precipIntensity":0,"precipProbability":0},{"time":1529944920,"precipIntensity":0,"precipProbability":0},{"time":1529944980,"precipIntensity":0,"precipProbability":0},{"time":1529945040,"precipIntensity":0,"precipProbability":0},{"time":1529945100,"precipIntensity":0,"precipProbability":0},{"time":1529945160,"precipIntensity":0,"precipProbability":0},{"time":1529945220,"precipIntensity":0,"precipProbability":0},{"time":1529945280,"precipIntensity":0,"precipProbability":0},{"time":1529945340,"precipIntensity":0,"precipProbability":0},{"time":1529945400,"precipIntensity":0,"precipProbability":0},{"time":1529945460,"precipIntensity":0,"precipProbability":0},{"time":1529945520,"precipIntensity":0,"precipProbability":0},{"time":1529945580,"precipIntensity":0,"precipProbability":0},{"time":1529945640,"precipIntensity":0,"precipProbability":0},{"time":1529945700,"precipIntensity":0,"precipProbability":0},{"time":1529945760,"precipIntensity":0,"precipProbability":0},{"time":1529945820,"precipIntensity":0,"precipProbability":0},{"time":1529945880,"precipIntensity":0,"precipProbability":0},{"time":1529945940,"precipIntensity":0,"precipProbability":0}]},"hourly":{"summary":"Clear throughout the day.","icon":"clear-day","data":[{"time":1529938800,"summary":"Clear","icon":"clear-day","precipIntensity":0,"precipProbability":0,"temperature":25.39,"apparentTemperature":25.39,"dewPoint":2.24,"humidity":0.22,"pressure":1012.81,"windSpeed":0.17,"windGust":1.65,"windBearing":15,"cloudCover":0,"uvIndex":2,"visibility":16.09,"ozone":292.98},{"time":1529942400,"summary":"Clear","icon":"clear-day","precipIntensity":0,"precipProbability":0,"temperature":28.41,"apparentTemperature":28.41,"dewPoint":2.35,"humidity":0.19,"pressure":1012.54,"windSpeed":0.56,"windGust":1.69,"windBearing":168,"cloudCover":0,"uvIndex":4,"visibility":16.09,"ozone":292.87},{"time":1529946000,"summary":"Clear","icon":"clear-day","precipIntensity":0.0051,"precipProbability":0.01,"precipType":"rain","temperature":31.68,"apparentTemperature":31.68,"dewPoint":2.56,"humidity":0.16,"pressure":1012.02,"windSpeed":1.34,"windGust":2.05,"windBearing":187,"cloudCover":0,"uvIndex":7,"visibility":16.09,"ozone":292.79},{"time":1529949600,"summary":"Clear","icon":"clear-day","precipIntensity":0,"precipProbability":0,"temperature":34.96,"apparentTemperature":34.96,"dewPoint":2.54,"humidity":0.13,"pressure":1011.55,"windSpeed":1.63,"windGust":2.22,"windBearing":196,"cloudCover":0,"uvIndex":11,"visibility":16.09,"ozone":292.76},{"time":1529953200,"summary":"Clear","icon":"clear-day","precipIntensity":0,"precipProbability":0,"temperature":37.57,"apparentTemperature":37.57,"dewPoint":2.23,"humidity":0.11,"pressure":1010.82,"windSpeed":1.76,"windGust":2.47,"windBearing":202,"cloudCover":0,"uvIndex":14,"visibility":16.09,"ozone":292.64},{"time":1529956800,"summary":"Clear","icon":"clear-day","precipIntensity":0.0356,"precipProbability":0.01,"precipType":"rain","temperature":39.25,"apparentTemperature":39.25,"dewPoint":1.85,"humidity":0.1,"pressure":1009.93,"windSpeed":1.89,"windGust":2.65,"windBearing":201,"cloudCover":0,"uvIndex":14,"visibility":16.09,"ozone":292.51},{"time":1529960400,"summary":"Clear","icon":"clear-day","precipIntensity":0,"precipProbability":0,"temperature":40.44,"apparentTemperature":40.44,"dewPoint":1.46,"humidity":0.09,"pressure":1008.9,"windSpeed":2.15,"windGust":2.78,"windBearing":211,"cloudCover":0,"uvIndex":11,"visibility":16.09,"ozone":292.37},{"time":1529964000,"summary":"Clear","icon":"clear-day","precipIntensity":0.0406,"precipProbability":0.01,"precipType":"rain","temperature":40.92,"apparentTemperature":40.92,"dewPoint":1.14,"humidity":0.09,"pressure":1008.25,"windSpeed":2.61,"windGust":2.98,"windBearing":214,"cloudCover":0,"uvIndex":7,"visibility":16.09,"ozone":292.15},{"time":1529967600,"summary":"Clear","icon":"clear-day","precipIntensity":0.0051,"precipProbability":0.01,"precipType":"rain","temperature":40.92,"apparentTemperature":40.92,"dewPoint":0.94,"humidity":0.08,"pressure":1007.64,"windSpeed":2.93,"windGust":3.27,"windBearing":213,"cloudCover":0,"uvIndex":4,"visibility":16.09,"ozone":292.03},{"time":1529971200,"summary":"Clear","icon":"clear-day","precipIntensity":0.0102,"precipProbability":0.01,"precipType":"rain","temperature":40.41,"apparentTemperature":40.41,"dewPoint":0.73,"humidity":0.09,"pressure":1007.29,"windSpeed":3.24,"windGust":3.51,"windBearing":228,"cloudCover":0,"uvIndex":2,"visibility":16.09,"ozone":291.72},{"time":1529974800,"summary":"Clear","icon":"clear-day","precipIntensity":0.0152,"precipProbability":0.01,"precipType":"rain","temperature":39.05,"apparentTemperature":39.05,"dewPoint":0.5,"humidity":0.09,"pressure":1007.39,"windSpeed":3.38,"windGust":3.97,"windBearing":235,"cloudCover":0,"uvIndex":1,"visibility":16.09,"ozone":291.41},{"time":1529978400,"summary":"Clear","icon":"clear-day","precipIntensity":0,"precipProbability":0,"temperature":36.41,"apparentTemperature":36.41,"dewPoint":0.19,"humidity":0.1,"pressure":1007.85,"windSpeed":3.4,"windGust":4.58,"windBearing":234,"cloudCover":0,"uvIndex":0,"visibility":16.09,"ozone":291.19},{"time":1529982000,"summary":"Clear","icon":"clear-night","precipIntensity":0.0356,"precipProbability":0.01,"precipType":"rain","temperature":32.92,"apparentTemperature":32.92,"dewPoint":0.21,"humidity":0.12,"pressure":1008.53,"windSpeed":2.15,"windGust":3.97,"windBearing":244,"cloudCover":0,"uvIndex":0,"visibility":16.09,"ozone":290.77},{"time":1529985600,"summary":"Clear","icon":"clear-night","precipIntensity":0,"precipProbability":0,"temperature":29.55,"apparentTemperature":29.55,"dewPoint":0.21,"humidity":0.15,"pressure":1009.48,"windSpeed":2.19,"windGust":2.8,"windBearing":186,"cloudCover":0,"uvIndex":0,"visibility":16.09,"ozone":290.21},{"time":1529989200,"summary":"Clear","icon":"clear-night","precipIntensity":0,"precipProbability":0,"temperature":26.96,"apparentTemperature":26.96,"dewPoint":0.38,"humidity":0.18,"pressure":1010.46,"windSpeed":2.02,"windGust":3.21,"windBearing":76,"cloudCover":0,"uvIndex":0,"visibility":16.09,"ozone":289.43},{"time":1529992800,"summary":"Clear","icon":"clear-night","precipIntensity":0,"precipProbability":0,"temperature":23.35,"apparentTemperature":23.35,"dewPoint":1.56,"humidity":0.24,"pressure":1012.59,"windSpeed":1.22,"windGust":1.66,"windBearing":341,"cloudCover":0,"uvIndex":0,"visibility":16.09,"ozone":288.84},{"time":1529996400,"summary":"Clear","icon":"clear-night","precipIntensity":0,"precipProbability":0,"temperature":22.08,"apparentTemperature":22.08,"dewPoint":1.53,"humidity":0.26,"pressure":1012.82,"windSpeed":1.15,"windGust":1.57,"windBearing":322,"cloudCover":0,"uvIndex":0,"visibility":16.09,"ozone":288.31},{"time":1530000000,"summary":"Clear","icon":"clear-night","precipIntensity":0,"precipProbability":0,"temperature":21.15,"apparentTemperature":21.15,"dewPoint":1.42,"humidity":0.27,"pressure":1012.91,"windSpeed":1.08,"windGust":1.54,"windBearing":328,"cloudCover":0,"uvIndex":0,"visibility":16.09,"ozone":287.85},{"time":1530003600,"summary":"Clear","icon":"clear-night","precipIntensity":0,"precipProbability":0,"temperature":20.32,"apparentTemperature":20.32,"dewPoint":1.28,"humidity":0.28,"pressure":1013.08,"windSpeed":0.95,"windGust":1.53,"windBearing":339,"cloudCover":0,"uvIndex":0,"visibility":16.09,"ozone":287.76},{"time":1530007200,"summary":"Clear","icon":"clear-night","precipIntensity":0,"precipProbability":0,"temperature":19.26,"apparentTemperature":19.26,"dewPoint":1.21,"humidity":0.3,"pressure":1013.43,"windSpeed":0.9,"windGust":1.52,"windBearing":8,"cloudCover":0.01,"uvIndex":0,"visibility":16.09,"ozone":288.09},{"time":1530010800,"summary":"Clear","icon":"clear-night","precipIntensity":0,"precipProbability":0,"temperature":18.51,"apparentTemperature":18.51,"dewPoint":1.14,"humidity":0.31,"pressure":1013.73,"windSpeed":0.97,"windGust":1.51,"windBearing":352,"cloudCover":0.01,"uvIndex":0,"visibility":16.09,"ozone":288.82},{"time":1530014400,"summary":"Clear","icon":"clear-night","precipIntensity":0,"precipProbability":0,"temperature":18.64,"apparentTemperature":18.64,"dewPoint":0.99,"humidity":0.31,"pressure":1014.01,"windSpeed":0.96,"windGust":1.45,"windBearing":341,"cloudCover":0.02,"uvIndex":0,"visibility":16.09,"ozone":289.17},{"time":1530018000,"summary":"Clear","icon":"clear-day","precipIntensity":0,"precipProbability":0,"temperature":20.89,"apparentTemperature":20.89,"dewPoint":0.69,"humidity":0.26,"pressure":1014.21,"windSpeed":0.99,"windGust":1.22,"windBearing":39,"cloudCover":0.01,"uvIndex":0,"visibility":16.09,"ozone":289.17},{"time":1530021600,"summary":"Clear","icon":"clear-day","precipIntensity":0,"precipProbability":0,"temperature":25.46,"apparentTemperature":25.46,"dewPoint":0.29,"humidity":0.19,"pressure":1014.26,"windSpeed":0.91,"windGust":0.99,"windBearing":77,"cloudCover":0.01,"uvIndex":1,"visibility":16.09,"ozone":288.83},{"time":1530025200,"summary":"Clear","icon":"clear-day","precipIntensity":0,"precipProbability":0,"temperature":29.41,"apparentTemperature":29.41,"dewPoint":-0.04,"humidity":0.15,"pressure":1014.1,"windSpeed":0.8,"windGust":0.91,"windBearing":147,"cloudCover":0.01,"uvIndex":2,"visibility":16.09,"ozone":288.71},{"time":1530028800,"summary":"Clear","icon":"clear-day","precipIntensity":0,"precipProbability":0,"temperature":32.18,"apparentTemperature":32.18,"dewPoint":-0.14,"humidity":0.13,"pressure":1013.71,"windSpeed":1.18,"windGust":1.51,"windBearing":147,"cloudCover":0.01,"uvIndex":4,"visibility":16.09,"ozone":288.57},{"time":1530032400,"summary":"Clear","icon":"clear-day","precipIntensity":0,"precipProbability":0,"temperature":34.8,"apparentTemperature":34.8,"dewPoint":-0.14,"humidity":0.11,"pressure":1013.16,"windSpeed":1.7,"windGust":2.45,"windBearing":161,"cloudCover":0.01,"uvIndex":7,"visibility":16.09,"ozone":288.37},{"time":1530036000,"summary":"Clear","icon":"clear-day","precipIntensity":0,"precipProbability":0,"temperature":37.36,"apparentTemperature":37.36,"dewPoint":-0.15,"humidity":0.09,"pressure":1012.52,"windSpeed":2.33,"windGust":3.26,"windBearing":175,"cloudCover":0.01,"uvIndex":11,"visibility":16.09,"ozone":288.15},{"time":1530039600,"summary":"Clear","icon":"clear-day","precipIntensity":0,"precipProbability":0,"temperature":39.36,"apparentTemperature":39.36,"dewPoint":-0.24,"humidity":0.08,"pressure":1011.75,"windSpeed":2.96,"windGust":3.77,"windBearing":183,"cloudCover":0,"uvIndex":14,"visibility":16.09,"ozone":287.93},{"time":1530043200,"summary":"Clear","icon":"clear-day","precipIntensity":0,"precipProbability":0,"temperature":41.13,"apparentTemperature":41.13,"dewPoint":-0.38,"humidity":0.08,"pressure":1010.94,"windSpeed":3.69,"windGust":4.17,"windBearing":187,"cloudCover":0,"uvIndex":14,"visibility":16.09,"ozone":287.53},{"time":1530046800,"summary":"Clear","icon":"clear-day","precipIntensity":0,"precipProbability":0,"temperature":41.92,"apparentTemperature":41.92,"dewPoint":-0.65,"humidity":0.07,"pressure":1010.31,"windSpeed":4.29,"windGust":4.52,"windBearing":188,"cloudCover":0,"uvIndex":11,"visibility":16.09,"ozone":287.29},{"time":1530050400,"summary":"Clear","icon":"clear-day","precipIntensity":0,"precipProbability":0,"temperature":42.02,"apparentTemperature":42.02,"dewPoint":-1.23,"humidity":0.07,"pressure":1009.73,"windSpeed":4.58,"windGust":4.78,"windBearing":191,"cloudCover":0,"uvIndex":7,"visibility":16.09,"ozone":287.05},{"time":1530054000,"summary":"Clear","icon":"clear-day","precipIntensity":0,"precipProbability":0,"temperature":41.39,"apparentTemperature":41.39,"dewPoint":-1.93,"humidity":0.07,"pressure":1009.24,"windSpeed":4.59,"windGust":4.78,"windBearing":193,"cloudCover":0,"uvIndex":4,"visibility":16.09,"ozone":286.86},{"time":1530057600,"summary":"Clear","icon":"clear-day","precipIntensity":0,"precipProbability":0,"temperature":40.31,"apparentTemperature":40.31,"dewPoint":-2.37,"humidity":0.07,"pressure":1008.93,"windSpeed":4.31,"windGust":4.6,"windBearing":195,"cloudCover":0,"uvIndex":2,"visibility":16.09,"ozone":286.65},{"time":1530061200,"summary":"Clear","icon":"clear-day","precipIntensity":0,"precipProbability":0,"temperature":38.32,"apparentTemperature":38.32,"dewPoint":-2.37,"humidity":0.08,"pressure":1009.17,"windSpeed":3.66,"windGust":4,"windBearing":200,"cloudCover":0,"uvIndex":1,"visibility":16.09,"ozone":286.55},{"time":1530064800,"summary":"Clear","icon":"clear-day","precipIntensity":0,"precipProbability":0,"temperature":35.1,"apparentTemperature":35.1,"dewPoint":-2.1,"humidity":0.09,"pressure":1009.78,"windSpeed":2.68,"windGust":3.19,"windBearing":202,"cloudCover":0,"uvIndex":0,"visibility":16.09,"ozone":286.57},{"time":1530068400,"summary":"Clear","icon":"clear-night","precipIntensity":0,"precipProbability":0,"temperature":31.05,"apparentTemperature":31.05,"dewPoint":-1.81,"humidity":0.12,"pressure":1010.53,"windSpeed":1.83,"windGust":2.43,"windBearing":203,"cloudCover":0,"uvIndex":0,"visibility":16.09,"ozone":286.58},{"time":1530072000,"summary":"Clear","icon":"clear-night","precipIntensity":0,"precipProbability":0,"temperature":27.81,"apparentTemperature":27.81,"dewPoint":-1.5,"humidity":0.15,"pressure":1011.54,"windSpeed":1.5,"windGust":2.01,"windBearing":178,"cloudCover":0,"uvIndex":0,"visibility":16.09,"ozone":286.57},{"time":1530075600,"summary":"Clear","icon":"clear-night","precipIntensity":0,"precipProbability":0,"temperature":25.12,"apparentTemperature":25.12,"dewPoint":-1.18,"humidity":0.18,"pressure":1012.56,"windSpeed":0.88,"windGust":1.75,"windBearing":113,"cloudCover":0,"uvIndex":0,"visibility":16.09,"ozone":286.55},{"time":1530079200,"summary":"Clear","icon":"clear-night","precipIntensity":0,"precipProbability":0,"temperature":23.17,"apparentTemperature":23.17,"dewPoint":-1.13,"humidity":0.2,"pressure":1013.28,"windSpeed":0.95,"windGust":1.6,"windBearing":336,"cloudCover":0,"uvIndex":0,"visibility":16.09,"ozone":286.54},{"time":1530082800,"summary":"Clear","icon":"clear-night","precipIntensity":0,"precipProbability":0,"temperature":21.82,"apparentTemperature":21.82,"dewPoint":-1.47,"humidity":0.21,"pressure":1013.53,"windSpeed":0.9,"windGust":1.6,"windBearing":332,"cloudCover":0,"uvIndex":0,"visibility":16.09,"ozone":286.5},{"time":1530086400,"summary":"Clear","icon":"clear-night","precipIntensity":0,"precipProbability":0,"temperature":20.89,"apparentTemperature":20.89,"dewPoint":-2.05,"humidity":0.21,"pressure":1013.5,"windSpeed":0.88,"windGust":1.72,"windBearing":358,"cloudCover":0,"uvIndex":0,"visibility":16.09,"ozone":286.42},{"time":1530090000,"summary":"Clear","icon":"clear-night","precipIntensity":0,"precipProbability":0,"temperature":19.95,"apparentTemperature":19.95,"dewPoint":-2.52,"humidity":0.22,"pressure":1013.59,"windSpeed":1.27,"windGust":1.79,"windBearing":356,"cloudCover":0,"uvIndex":0,"visibility":16.09,"ozone":286.53},{"time":1530093600,"summary":"Clear","icon":"clear-night","precipIntensity":0,"precipProbability":0,"temperature":18.93,"apparentTemperature":18.93,"dewPoint":-2.78,"humidity":0.23,"pressure":1013.69,"windSpeed":1.28,"windGust":1.81,"windBearing":4,"cloudCover":0.01,"uvIndex":0,"visibility":16.09,"ozone":286.95},{"time":1530097200,"summary":"Clear","icon":"clear-night","precipIntensity":0,"precipProbability":0,"temperature":18.1,"apparentTemperature":18.1,"dewPoint":-2.99,"humidity":0.24,"pressure":1013.76,"windSpeed":1.29,"windGust":1.84,"windBearing":13,"cloudCover":0.03,"uvIndex":0,"visibility":16.09,"ozone":287.53},{"time":1530100800,"summary":"Clear","icon":"clear-night","precipIntensity":0,"precipProbability":0,"temperature":18.26,"apparentTemperature":18.26,"dewPoint":-3.07,"humidity":0.23,"pressure":1013.75,"windSpeed":1.28,"windGust":1.77,"windBearing":29,"cloudCover":0.06,"uvIndex":0,"visibility":16.09,"ozone":288.21},{"time":1530104400,"summary":"Clear","icon":"clear-day","precipIntensity":0,"precipProbability":0,"temperature":20.65,"apparentTemperature":20.65,"dewPoint":-3.03,"humidity":0.2,"pressure":1013.76,"windSpeed":1.06,"windGust":1.42,"windBearing":39,"cloudCover":0.09,"uvIndex":0,"visibility":16.09,"ozone":288.99},{"time":1530108000,"summary":"Clear","icon":"clear-day","precipIntensity":0,"precipProbability":0,"temperature":25.24,"apparentTemperature":25.24,"dewPoint":-2.91,"humidity":0.15,"pressure":1013.65,"windSpeed":0.81,"windGust":0.98,"windBearing":46,"cloudCover":0.13,"uvIndex":1,"visibility":16.09,"ozone":289.88},{"time":1530111600,"summary":"Clear","icon":"clear-day","precipIntensity":0,"precipProbability":0,"temperature":29.36,"apparentTemperature":29.36,"dewPoint":-2.92,"humidity":0.12,"pressure":1013.47,"windSpeed":0.8,"windGust":0.88,"windBearing":93,"cloudCover":0.15,"uvIndex":2,"visibility":16.09,"ozone":290.55}]},"daily":{"summary":"No precipitation throughout the week, with high temperatures peaking at 42°C on Wednesday.","icon":"clear-day","data":[{"time":1529910000,"summary":"Clear throughout the day.","icon":"clear-day","sunriseTime":1529929064,"sunsetTime":1529981201,"moonPhase":0.43,"precipIntensity":0,"precipIntensityMax":0,"precipProbability":0,"temperatureHigh":40.92,"temperatureHighTime":1529964000,"temperatureLow":18.51,"temperatureLowTime":1530010800,"apparentTemperatureHigh":40.92,"apparentTemperatureHighTime":1529964000,"apparentTemperatureLow":18.51,"apparentTemperatureLowTime":1530010800,"dewPoint":1.42,"humidity":0.18,"pressure":1010.48,"windSpeed":1.03,"windGust":4.58,"windGustTime":1529978400,"windBearing":217,"cloudCover":0,"uvIndex":14,"uvIndexTime":1529953200,"visibility":16.09,"ozone":292.37,"temperatureMin":20.16,"temperatureMinTime":1529931600,"temperatureMax":40.92,"temperatureMaxTime":1529964000,"apparentTemperatureMin":20.16,"apparentTemperatureMinTime":1529931600,"apparentTemperatureMax":40.92,"apparentTemperatureMaxTime":1529964000},{"time":1529996400,"summary":"Clear throughout the day.","icon":"clear-day","sunriseTime":1530015483,"sunsetTime":1530067606,"moonPhase":0.46,"precipIntensity":0,"precipIntensityMax":0,"precipProbability":0,"temperatureHigh":42.02,"temperatureHighTime":1530050400,"temperatureLow":18.1,"temperatureLowTime":1530097200,"apparentTemperatureHigh":42.02,"apparentTemperatureHighTime":1530050400,"apparentTemperatureLow":18.1,"apparentTemperatureLowTime":1530097200,"dewPoint":-0.37,"humidity":0.16,"pressure":1012.07,"windSpeed":1.34,"windGust":4.78,"windGustTime":1530050400,"windBearing":189,"cloudCover":0,"uvIndex":14,"uvIndexTime":1530039600,"visibility":16.09,"ozone":287.69,"temperatureMin":18.51,"temperatureMinTime":1530010800,"temperatureMax":42.02,"temperatureMaxTime":1530050400,"apparentTemperatureMin":18.51,"apparentTemperatureMinTime":1530010800,"apparentTemperatureMax":42.02,"apparentTemperatureMaxTime":1530050400},{"time":1530082800,"summary":"Partly cloudy overnight.","icon":"partly-cloudy-night","sunriseTime":1530101903,"sunsetTime":1530154009,"moonPhase":0.49,"precipIntensity":0,"precipIntensityMax":0,"precipProbability":0,"temperatureHigh":42.34,"temperatureHighTime":1530136800,"temperatureLow":18.9,"temperatureLowTime":1530183600,"apparentTemperatureHigh":42.34,"apparentTemperatureHighTime":1530136800,"apparentTemperatureLow":18.9,"apparentTemperatureLowTime":1530183600,"dewPoint":-3.42,"humidity":0.13,"pressure":1011.5,"windSpeed":1.11,"windGust":5.3,"windGustTime":1530140400,"windBearing":209,"cloudCover":0.1,"uvIndex":13,"uvIndexTime":1530126000,"visibility":16.09,"ozone":289.03,"temperatureMin":18.1,"temperatureMinTime":1530097200,"temperatureMax":42.34,"temperatureMaxTime":1530136800,"apparentTemperatureMin":18.1,"apparentTemperatureMinTime":1530097200,"apparentTemperatureMax":42.34,"apparentTemperatureMaxTime":1530136800},{"time":1530169200,"summary":"Partly cloudy until afternoon.","icon":"partly-cloudy-day","sunriseTime":1530188324,"sunsetTime":1530240411,"moonPhase":0.52,"precipIntensity":0,"precipIntensityMax":0,"precipProbability":0,"temperatureHigh":38.7,"temperatureHighTime":1530219600,"temperatureLow":18.27,"temperatureLowTime":1530270000,"apparentTemperatureHigh":38.7,"apparentTemperatureHighTime":1530219600,"apparentTemperatureLow":18.27,"apparentTemperatureLowTime":1530270000,"dewPoint":-2.42,"humidity":0.14,"pressure":1009.33,"windSpeed":2.91,"windGust":9.42,"windGustTime":1530219600,"windBearing":196,"cloudCover":0.3,"uvIndex":11,"uvIndexTime":1530212400,"visibility":16.09,"ozone":289.01,"temperatureMin":18.9,"temperatureMinTime":1530183600,"temperatureMax":38.7,"temperatureMaxTime":1530219600,"apparentTemperatureMin":18.9,"apparentTemperatureMinTime":1530183600,"apparentTemperatureMax":38.7,"apparentTemperatureMaxTime":1530219600},{"time":1530255600,"summary":"Clear throughout the day.","icon":"clear-day","sunriseTime":1530274747,"sunsetTime":1530326811,"moonPhase":0.55,"precipIntensity":0.0762,"precipIntensityMax":0.2921,"precipIntensityMaxTime":1530320400,"precipProbability":0.02,"precipType":"rain","temperatureHigh":36.27,"temperatureHighTime":1530302400,"temperatureLow":16.72,"temperatureLowTime":1530356400,"apparentTemperatureHigh":36.27,"apparentTemperatureHighTime":1530302400,"apparentTemperatureLow":16.72,"apparentTemperatureLowTime":1530356400,"dewPoint":6.23,"humidity":0.28,"pressure":1009.2,"windSpeed":3,"windGust":10.37,"windGustTime":1530313200,"windBearing":190,"cloudCover":0.04,"uvIndex":13,"uvIndexTime":1530298800,"visibility":16.09,"ozone":302.63,"temperatureMin":18.27,"temperatureMinTime":1530270000,"temperatureMax":36.27,"temperatureMaxTime":1530302400,"apparentTemperatureMin":18.27,"apparentTemperatureMinTime":1530270000,"apparentTemperatureMax":36.27,"apparentTemperatureMaxTime":1530302400},{"time":1530342000,"summary":"Clear throughout the day.","icon":"clear-day","sunriseTime":1530361171,"sunsetTime":1530413209,"moonPhase":0.58,"precipIntensity":0.0076,"precipIntensityMax":0.0711,"precipIntensityMaxTime":1530349200,"precipProbability":0.01,"precipType":"rain","temperatureHigh":35.96,"temperatureHighTime":1530396000,"temperatureLow":15.77,"temperatureLowTime":1530442800,"apparentTemperatureHigh":35.96,"apparentTemperatureHighTime":1530396000,"apparentTemperatureLow":15.77,"apparentTemperatureLowTime":1530442800,"dewPoint":5.02,"humidity":0.29,"pressure":1010.23,"windSpeed":1.72,"windGust":4.88,"windGustTime":1530385200,"windBearing":165,"cloudCover":0,"uvIndex":13,"uvIndexTime":1530385200,"visibility":16.09,"ozone":309.69,"temperatureMin":16.72,"temperatureMinTime":1530356400,"temperatureMax":35.96,"temperatureMaxTime":1530396000,"apparentTemperatureMin":16.72,"apparentTemperatureMinTime":1530356400,"apparentTemperatureMax":35.96,"apparentTemperatureMaxTime":1530396000},{"time":1530428400,"summary":"Clear throughout the day.","icon":"clear-day","sunriseTime":1530447596,"sunsetTime":1530499606,"moonPhase":0.61,"precipIntensity":0,"precipIntensityMax":0,"precipProbability":0,"temperatureHigh":37.75,"temperatureHighTime":1530486000,"temperatureLow":16.41,"temperatureLowTime":1530529200,"apparentTemperatureHigh":37.75,"apparentTemperatureHighTime":1530486000,"apparentTemperatureLow":16.41,"apparentTemperatureLowTime":1530529200,"dewPoint":1.89,"humidity":0.22,"pressure":1011.45,"windSpeed":0.71,"windGust":3.58,"windGustTime":1530489600,"windBearing":214,"cloudCover":0,"uvIndex":13,"uvIndexTime":1530471600,"visibility":16.09,"ozone":314.22,"temperatureMin":15.77,"temperatureMinTime":1530442800,"temperatureMax":37.75,"temperatureMaxTime":1530486000,"apparentTemperatureMin":15.77,"apparentTemperatureMinTime":1530442800,"apparentTemperatureMax":37.75,"apparentTemperatureMaxTime":1530486000},{"time":1530514800,"summary":"Clear throughout the day.","icon":"clear-day","sunriseTime":1530534022,"sunsetTime":1530586001,"moonPhase":0.64,"precipIntensity":0,"precipIntensityMax":0,"precipProbability":0,"temperatureHigh":40.07,"temperatureHighTime":1530568800,"temperatureLow":18.13,"temperatureLowTime":1530615600,"apparentTemperatureHigh":40.07,"apparentTemperatureHighTime":1530568800,"apparentTemperatureLow":18.13,"apparentTemperatureLowTime":1530615600,"dewPoint":0.34,"humidity":0.18,"pressure":1011.18,"windSpeed":0.84,"windGust":3.29,"windGustTime":1530576000,"windBearing":271,"cloudCover":0,"uvIndex":13,"uvIndexTime":1530558000,"visibility":16.09,"ozone":308.45,"temperatureMin":16.41,"temperatureMinTime":1530529200,"temperatureMax":40.07,"temperatureMaxTime":1530568800,"apparentTemperatureMin":16.41,"apparentTemperatureMinTime":1530529200,"apparentTemperatureMax":40.07,"apparentTemperatureMaxTime":1530568800}]},"flags":{"sources":["nearest-precip","nwspa","cmc","gfs","hrrr","icon","isd","madis","nam","sref","darksky"],"nearest-station":5.011,"units":"si"},"offset":-7}
**********************************************************

 End API Docs

*********************************************************/