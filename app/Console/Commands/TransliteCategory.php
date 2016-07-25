<?php

    namespace App\Console\Commands;

    use App\Models\Category;
    use Illuminate\Console\Command;
    use Illuminate\Support\Str;

    class TransliteCategory extends Command
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
        protected $signature = 'translate:category';
        /**
         * The console command description.
         *
         * @var string
         */
        protected $description = 'Перевод slug категорий.';

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
            Category::chunk(100, function ($category) {
                foreach ($category as $value) {
                    $engname = str_slug($value->name, '-');
                    $value->slug = $engname;
                    $value->save();
                }
            });
        }
    }
