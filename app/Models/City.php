<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class City extends Model
    {
        /**
         * The database table used by the model.
         *
         * @var string
         */
        protected $table = 'city';

        /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
        protected $fillable = ['country_id', 'name', 'ascii_name'];


        public function getCountry()
        {
            return $this->belongsTo('App\Models\Country');
        }


    }