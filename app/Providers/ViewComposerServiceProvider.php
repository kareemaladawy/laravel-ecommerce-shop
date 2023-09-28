<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Offer;
use App\Models\Product;
use Illuminate\Support\Facades\View;
use Monarobase\CountryList\CountryListFacade as Countries;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Navigation & header
        View::composer('site.partials.nav', function ($view) {
            $view->with('categories', Category::orderBy('parent_id')->get()->nest());
        });
        View::composer('site.partials.cart_widget', function ($view) {
            if (auth()->check()) {
                $view->with('cart_count', \Cart::session(auth()->id())->getContent()->count());
            } else {
                $view->with('cart_count', 0);
            }
        });

        // Billing form
        View::composer('site.partials.billing_form', function ($view) {
            $view->with('countries', Countries::getList(app()->getLocale()));
        });

        // Home page
        View::composer('site.partials.slider', function ($view) {
            $view->with('offers', Offer::with('product')->get())
                ->with('featured_products', Product::featured()->with(['ratings', 'offer'])->limit(3)->get());
        });
        View::composer('site.partials.featured_categories', function ($view) {
            $view->with('featured_categories', Category::featured()->limit(3)->get());
        });
        View::composer('site.partials.featured_products', function ($view) {
            $view->with('featured_products', Product::featured()->with(['ratings', 'offer'])->get());
        });
        View::composer('site.partials.recently_added_products', function ($view) {
            $view->with('recently_added_products', Product::recentlyAdded()->with(['ratings', 'offer'])->get());
        });
    }
}
