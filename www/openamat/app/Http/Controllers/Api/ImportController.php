<?php

namespace App\Http\Controllers\Api;

use App\Services\FareRuleService;
use App\Services\FareService;
use App\Services\RouteService;
use App\Services\ServiceService;
use App\Services\ShapeService;
use App\Services\StopService;
use App\Services\TripService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\AgencyService;
use App\Http\Requests\AgencyRequest;

class ImportController extends Controller
{
    /**
     * @var RouteService
     */
    private $routeService;
    /**
     * @var FareService
     */
    private $fareService;
    /**
     * @var ServiceService
     */
    private $serviceService;
    /**
     * @var ShapeService
     */
    private $shapeService;
    /**
     * @var StopService
     */
    private $stopService;
    /**
     * @var FareRuleService
     */
    private $fareRuleService;
    /**
     * @var TripService
     */
    private $tripService;

    /**
     * ImportController constructor.
     * @param AgencyService $agencyService
     * @param RouteService $routeService
     * @param FareService $fareService
     * @param FareRuleService $fareRuleService
     * @param ServiceService $serviceService
     * @param ShapeService $shapeService
     * @param StopService $stopService
     * @param TripService $tripService
     */
    public function __construct(AgencyService $agencyService, RouteService $routeService, FareService $fareService, FareRuleService $fareRuleService, ServiceService $serviceService, ShapeService $shapeService, StopService $stopService, TripService $tripService)
    {
        $this->agencyService = $agencyService;
        $this->routeService = $routeService;
        $this->fareService = $fareService;
        $this->serviceService = $serviceService;
        $this->shapeService = $shapeService;
        $this->stopService = $stopService;
        $this->fareRuleService = $fareRuleService;
        $this->tripService = $tripService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //Temporary Feature, TODO: CSV Import Feature
        $agencies = json_decode(file_get_contents('http://95.85.8.145/data/201607/json/agency.txt.json'), JSON_NUMERIC_CHECK);

        $this->agencyService->truncate();

        foreach ($agencies['agency'] as $agency) {
            $this->agencyService->create($agency);
        }

        $fares = json_decode(file_get_contents('http://95.85.8.145/data/201607/json/fare_attributes.txt.json'), JSON_NUMERIC_CHECK);

        $this->fareService->truncate();

        foreach ($fares['fare_attributes'] as $fare) {
            $this->fareService->create($fare);
        }

        $fare_rules = json_decode(file_get_contents('http://95.85.8.145/data/201607/json/fare_rules.txt.json'), JSON_NUMERIC_CHECK);

        $this->fareRuleService->truncate();

        foreach ($fare_rules['fare_rules'] as $farerule) {
            $this->fareRuleService->create($farerule);
        }

        $routes = json_decode(file_get_contents('http://95.85.8.145/data/201607/json/routes.txt.json'), JSON_NUMERIC_CHECK);

        $this->routeService->truncate();

        foreach ($routes['routes'] as $route) {
            $this->routeService->create($route);
        }
        
        $shapes = json_decode(file_get_contents('http://95.85.8.145/data/201607/json/shapes.txt.json'), JSON_NUMERIC_CHECK);

        $this->shapeService->truncate();

        foreach ($shapes['shapes'] as $shape) {
            $this->shapeService->create($shape);
        }

        $stops = json_decode(file_get_contents('http://95.85.8.145/data/201607/json/stops.txt.json'), JSON_NUMERIC_CHECK);

        $this->stopService->truncate();

        foreach ($stops['stops'] as $stop) {
            $this->stopService->create($stop);
        }

        $trips = json_decode(file_get_contents('http://95.85.8.145/data/201607/json/trips.txt.json'), JSON_NUMERIC_CHECK);

        $this->tripService->truncate();

        foreach ($trips['trips'] as $trip) {
            $this->tripService->create($trip);
        }

        $services = json_decode(file_get_contents('http://95.85.8.145/data/201607/json/calendar.txt.json'), JSON_NUMERIC_CHECK);

        $this->serviceService->truncate();

        foreach ($services['calendar'] as $service) {
            $this->serviceService->create($service);
        }


//        $calendar = json_decode(file_get_contents('http://95.85.8.145/data/201607/json/calendar.txt.json'), JSON_NUMERIC_CHECK);
//        $calendar_dates = json_decode(file_get_contents('http://95.85.8.145/data/201607/json/calendar_dates.txt.json'), JSON_NUMERIC_CHECK);


//        $stop_times = json_decode(file_get_contents('http://95.85.8.145/data/201607/json/stop_times.txt.json'), JSON_NUMERIC_CHECK);

        $result = ['message' => 'ok', 'code' => 200];

        if ($result) {
            return response()->json($result);
        }

        return response()->json(['error' => 'Unable to create agency'], 500);
    }

}
