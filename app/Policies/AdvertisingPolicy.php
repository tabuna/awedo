<?php

    namespace App\Policies;


    use App\Models\Advertising;
    use App\Models\User;

    class AdvertisingPolicy
    {
        /**
         * Create a new policy instance.
         *
         * @return void
         */
        public function __construct()
        {
            //
        }

        /**
         * @param User        $user
         * @param Advertising $advertising
         *
         * @return bool
         */
        public function update(User $user, Advertising $advertising)
        {
            return $user->id === $advertising->user_id;
        }

        public function edit(User $user, Advertising $advertising)
        {
            return $user->id === $advertising->user_id;
        }


        public function destroy(User $user, Advertising $advertising)
        {
            dd($user->id, $advertising->user_id);

            return $user->id === $advertising->user_id;
        }


    }
