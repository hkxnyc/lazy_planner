<?php

use App\Line;
use App\Station;
use Illuminate\Database\Seeder;

class StationSeeder extends Seeder
{
    private $csvFile = '/../../resources/assets/seeds/testing.csv';
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $this->grabData();
    }

    private function grabData(){
        $header = false;
        $i = 0;
        if(($fh = fopen(__DIR__.$this->csvFile,'r')) !== false){
            while(($line  = fgetcsv($fh,1000,','))){
                echo ++$i."\n";
                if(!$header){
                    $header = ! $header;
                }
                else {
                    $station = Station::firstOrNew([
                        'latitude' => $line[5],
                        'longitude' =>$line[6]
                    ]);
                    if(!isset($station->name)){
                        $station->name = $line[4];
//                        $station->save();
                    }

                    Line::where('name','LIKE',$line[1])->first()->stations()->save($station);
                }
            }
            fclose($fh);
        }
    }

}
