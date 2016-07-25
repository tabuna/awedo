<?php

    namespace App\Models;

    use Cache;
    use Illuminate\Database\Eloquent\Model;
    use Session;

    class Category extends Model
    {
        /**
         * The database table used by the model.
         *
         * @var string
         */
        protected $table = 'category';

        /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
        protected $fillable = ['name', 'icons', 'category_id', 'slug'];

        public function getParrentCategory()
        {
            return $this->belongsTo('App\Models\Category', 'category_id', 'id');
        }

        public function scopeMainCategory($query)
        {
            return $query->whereCategory_id(0);
        }

        public function getAdvertising()
        {
            return $this->hasMany('App\Models\Advertising');
        }

        public function getAdvertisingCount()
        {

            $categorySub = $this->getSubCategory()->get();

            $WhereCategory = [];
            foreach ($categorySub as $value) {
                $WhereCategory[] = $value->id;
            }
            $count_separated = implode(",", $WhereCategory);


            return $CountAdvListAll = Cache::remember('CountAdvListAll' . $count_separated . 'City' . Session::get('GeoCity'),
                60, function () use ($WhereCategory) {
                    return Advertising::where('city_id', Session::get('GeoCity')->id)
                        ->whereIn('category_id', $WhereCategory)
                        ->orderBy('id', 'DESC')
                        ->count();
                });

        }

        public function getSubCategory()
        {
            return $this->hasMany('App\Models\Category');
        }


    }