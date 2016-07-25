<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class Images extends Model
    {
        /**
         * The database table used by the model.
         *
         * @var string
         */
        protected $table = 'images';

        /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
        protected $fillable = ['advertising_id', 'path', 'name'];


        public function getAdvertising()
        {
            return $this->belongsTo('App\Models\Advertising');
        }

        public function scopeMainCategory($query)
        {
            return $query->whereCategory_id(0);
        }


    }