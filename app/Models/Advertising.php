<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;
    use Nicolaslopezj\Searchable\SearchableTrait;
    use Session;

    class Advertising extends Model
    {

        use SoftDeletes, SearchableTrait;
        /**
         * The database table used by the model.
         *
         * @var string
         */
        protected $table = 'advertising';

        /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
        protected $fillable = [
            'category_id',
            'type',
            'title',
            'description',
            'price',
            'name',
            'email',
            'phone',
            'country_id',
            'city_id',
            'user_id',
            'visits',
        ];

        /**
         * Searchable rules.
         *
         * @var array
         */
        protected $searchable = [
            'columns' => [
                'title'       => 3,
                'description' => 10,
                //'city_id' => 1,
                //'category_id' => 1,
            ],
        ];


        /**
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */

        public function getCategory()
        {
            return $this->belongsTo('App\Models\Category', 'category_id');
        }

        public function getImages()
        {
            return $this->hasMany('App\Models\Images');
        }

        public function getUser()
        {
            return $this->belongsTo('App\Models\User');
        }

        public function getCity()
        {
            return $this->belongsTo(City::class, 'city_id');
        }


        public function scopePopularCategory($query)
        {
            return $query
                ->join('category', 'category.id', '=', 'advertising.category_id')
                ->selectRaw('category.name, category.slug ,advertising.category_id, count(advertising.id) as count')
                ->where('city_id', Session::get('GeoCity')->id)
                ->groupBy('category_id')
                ->orderBy('count', 'desc')
                ->limit(10);
        }


    }