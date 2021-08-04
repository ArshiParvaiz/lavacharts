<?php
   //@linechart('Stocks', 'stocks-div')
namespace App\Http\Controllers;
use Khill\Lavacharts\Lavacharts;

use Illuminate\Http\Request;
use App\CountryUser;
use App\Routine;

class ChartsController extends Controller
{
    public function index(Request $rquest)
    {
		$lava = new Lavacharts; // See note below for Laravel

    	$data = $lava->DataTable();

	    $data->addDateColumn('Day of Month')
	                ->addNumberColumn('Projected')
	                ->addNumberColumn('Official');

	    // Random Data For Example
	    for ($a = 1; $a < 30; $a++)
	    {
	        $rowData = [
	          "2021-8-$a", rand(800,1000), rand(800,1000)
	        ];

	        $data->addRow($rowData);
	    }

	    $lava->LineChart('Stocks', $data, [
	      'title' => 'Stock Market Trends',
		  'axisTitlesPosition' => 'out',
		  'curveType'          => 'none',
		  'hAxis'              => ['title'=> 'Date', 'titleTextStyle' => [ 'color' => '#0000ff']],  //HorizontalAxis Options
		  'interpolateNulls'   => false,
		  'lineWidth'          => 2,
		  'pointSize'          => 5,
		  'series'             => [ 0 => ['targetAxisIndex' => 0],
									1 => ['targetAxisIndex' => 1],   
								   ],  
		  'vAxes'              => [ 	
		  							0 => ['title' => "Projected" , 'titleTextStyle' => ['color' => 'black']], 
									1 => ['title' => "Official"  , 'titleTextStyle' => ['color' => 'black']]
								   ],
		    'tooltip' =>            ['textStyle' => ['color'=> '#FF0000'], 'showColorCode' =>true]
									
	    ]);


	    return view('welcome' ,compact('lava'));
    }

	public function geoChart(Request $rquest)
    {
		$lava = new Lavacharts; // See note below for Laravel
		$popularity = $lava->DataTable();
		$data = CountryUser::select("name as 0","total_users as 1")->get()->toArray();
		$popularity->addStringColumn('Country')
		           ->addNumberColumn('Popularity')
		           ->addRows($data);
		
		$lava->GeoChart('Popularity', $popularity,  [
			'colorAxis'                 =>  [ 'minValue' => 0,  'colors' => ['#FF0000', '#00FF00']],   //ColorAxis Options
			'datalessRegionColor'       => '#81d4fa',
			'displayMode'               => 'auto',
			'enableRegionInteractivity' => true,
			'keepAspectRatio'           => true,
			'region'                    => 'world',
			'magnifyingGlass'           => ['enable' => true, 'zoomFactor' => 7.5],    //MagnifyingGlass Options
			'markerOpacity'             => 1.0,
			'resolution'                => 'countries',
			'sizeAxis'                  => null ,
			'backgroundColor'=> '#81d4fa',
			
		]);
        return view('geochart',compact('lava'));
	}

	public function donutChart(Request $rquest)
    {
		$lava = new Lavacharts; // See note below for Laravel
    	$data = $lava->DataTable();
	    $routine = Routine::select("work as 0","hours as 1")->get()->toArray();     
	    $data->addStringColumn('Task')
	          ->addNumberColumn('Hours per Day')
	          ->addRows($routine);

	    
	    
	    $lava->PieChart('Routine', $data, [
	      'title' => 'My Daily Activities',
	      'pieHole' => 0.4
	    ]);


	    return view('donutchart' ,compact('lava'));
    }
	
}
