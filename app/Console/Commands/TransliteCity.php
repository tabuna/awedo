<?php

    namespace App\Console\Commands;

    use App\Models\City;
    use Illuminate\Console\Command;
    use Illuminate\Support\Str;

    class TransliteCity extends Command
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
        protected $signature = 'translate:city';
        /**
         * The console command description.
         *
         * @var string
         */
        protected $description = 'Перевод городов.';

        /**
         * Create a new command instance.
         *
         * @return void
         */
        public function __construct()
        {
            $this->str = new Str();

            parent::__construct();
        }

        /**
         * Execute the console command.
         *
         * @return mixed
         */
        public function handle()
        {
            City::chunk(100, function ($city) {
                foreach ($city as $value) {
                    $engname = $this->str->ascii($value->name);

                    if (strripos($engname, '(')) {
                        $engname = substr($engname, 0, strpos($engname, '('));
                        $engname = trim($engname);
                    }
                    $value->ascii_name = $engname;
                    $value->save();
                }
            });
        }
    }
