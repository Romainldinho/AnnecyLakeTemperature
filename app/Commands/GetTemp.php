<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\View;
use LaravelZero\Framework\Commands\Command;
use Symfony\Component\DomCrawler\Crawler;
use function Termwind\{render};
use function Termwind\live;




class GetTemp extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'temp';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $temp = $this->getTemp();
        $view =  view('dashboard', [
            'temp' => $temp,
        ]);
        
        render($view);
    }


    private function getTemp(): string
    {
        $url = "http://annecy-meteo.com/temperature-du-lac/";
        $response = Http::get($url);
        $crawler = new Crawler($response->body());
        $node = $crawler->filter('div#sonde-eau .temperature');
        $temp = $node->text();
        return filter_var($temp, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    }
}
