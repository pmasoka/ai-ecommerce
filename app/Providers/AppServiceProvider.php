<?php

namespace App\Providers;

use App\Services\Frontend\CartService;
use App\Services\Frontend\CategoryService;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);

        View::composer('*', function ($view) {
            $categoryService = app(CategoryService::class);
            $categories = $categoryService->getHeaderCategories();

            $cartService = app(CartService::class);
            $cartCount = $cartService->getCartCount();

            $view->with([
                'categories' => $categories,
                'cartCount'  => $cartCount,
            ]);
        });
    }
}