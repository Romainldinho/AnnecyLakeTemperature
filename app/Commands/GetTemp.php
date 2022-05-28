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



        $updateInSeconds = 20;
        $temp = $this->getTemp();

        // live(function () use (&$updateInSeconds, &$temp) {
        //     if ($updateInSeconds === 0) {
        //         $temp = $this->getTemp();
        //         $updateInSeconds = 20;
        //     }

        //     return view('dashboard', [
        //         'temp' => $temp,
        //     ]);
        // })->refreshEvery(seconds: 1);

        // return View::make('temp', ['foo' => 'bar']);


        render(

        view('dashboard', [
            'temp' => $temp,        ]));


        // render(<<<'HTML'
        //     <div class="py-1 ml-2">
        //         <div class="px-1 bg-blue-300 text-black">Annecy Lake Temperature 🌡</div>
        //         <em class="ml-1">
         
        //         </em>
        //     </div>
        // HTML);
        // dump($temp);
    }

    /**
     * Define the command's schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    public function schedule(Schedule $schedule): void
    {
        // $schedule->command(static::class)->everyMinute();
    }

    private function getTemp(): string
    {
        $url = "http://annecy-meteo.com/temperature-du-lac/";
        $response = Http::get($url);
        $crawler = new Crawler($response->body());
        $temp = $crawler->filter('div#sonde-eau .temperature');
        return $temp->text();
    }

}
