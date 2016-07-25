<?php

    namespace App\Http\Requests\Account;

    use App\Http\Requests\Request;
    use Auth;

    class AdvertisingRequest extends Request
    {
        /**
         * Determine if the user is authorized to make this request.
         *
         * @return bool
         */
        public function authorize()
        {
            return Auth::check();
        }

        /**
         * Get the validation rules that apply to the request.
         *
         * @return array
         */
        public function rules()
        {
            $rules = [
                'category_id' => 'required|exists:category,id',
                'type'        => 'required|boolean',
                'title'       => 'required|max:255',
                'description' => 'required',
                'price'       => 'required|numeric',
                'country_id'  => 'required|exists:country,id',
                'city_id'     => 'required|exists:city,id',
                'images'      => 'array',
            ];

            foreach ($this->file('images') as $key => $val) {
                $rules['images.' . $key] = 'image|image_size:<=1000';
            }

            return $rules;

        }
    }
