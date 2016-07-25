<?php

    namespace App\Providers;

    use App\Models\Advertising;
    use App\Policies\AdvertisingPolicy;
    use Illuminate\Contracts\Auth\Access\Gate as GateContract;
    use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

    class AuthServiceProvider extends ServiceProvider
    {
        /**
         * The policy mappings for the application.
         *
         * @var array
         */
        protected $policies = [
            Advertising::class => AdvertisingPolicy::class,
        ];

        /**
         * Register any application authentication / authorization services.
         *
         * @param  \Illuminate\Contracts\Auth\Access\Gate $gate
         *
         * @return void
         */
        public function boot(GateContract $gate)
        {
            parent::registerPolicies($gate);

            //
        }
    }