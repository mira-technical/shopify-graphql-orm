<?php

namespace MiraTech\ShopifyGraphqlOrm\Providers;

use Illuminate\Support\ServiceProvider;
use MiraTech\ShopifyGraphqlOrm\Console\MakeGraphqlOrm;

class OrmServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../../config/shopify_graphql_orm.php' => config_path('shopify_graphql_orm.php'),
        ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->commands(MakeGraphqlOrm::class);
    }
}
