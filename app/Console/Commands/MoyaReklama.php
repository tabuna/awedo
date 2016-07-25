<?php

    namespace App\Console\Commands;

    use GuzzleHttp\Client;
    use Illuminate\Console\Command;

    class MoyaReklama extends Command
    {
        /**
         *
         */
        public $str;
        /**
         * The name and signature of the console command.
         *
         * @var string
         */
        protected $signature = 'upload:MoyaReklama';
        /**
         * The console command description.
         *
         * @var string
         */
        protected $description = 'Выгрузка объявлений с моей рекламы';

        /**
         * Create a new command instance.
         *
         * @return void
         */
        public function __construct()
        {
            parent::__construct();
        }

        /**
         * Execute the console command.
         *
         * @return mixed
         */
        public function handle()
        {

            $jar = new \GuzzleHttp\Cookie\CookieJar(false, [
                'bid'  => '34d180c4fb73bc8210d91331b7007cdc',
                'SID'  => 'hemho7d3hs4eehq6b8p3uh50f1',
                'city' => '6',
            ]);

            $client = new Client([
                'base_uri'       => 'http://www.moyareklama.ru/single_ad_new.php',
                'form_params'    => [
                    'id' => '206535830',
                ],
                'headers'        => ['Accept-Encoding' => 'gzip'],
                'decode_content' => true,
                'timeout'        => 5.0,
                'stream'         => false,
                'cookies'        => $jar,
            ]);


            $result = $client->request('GET');


            dd($result->getBody()->getContents());


        }

    }
