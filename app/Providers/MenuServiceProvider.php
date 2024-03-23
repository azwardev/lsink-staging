<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;

class MenuServiceProvider extends ServiceProvider
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
    view()->composer('*', function ($view) {
      // Check if a user is authenticated
      if (Auth::check() && Auth::user()->hasRole('Administrator')) {
          $verticalMenuJson = file_get_contents(base_path('resources/menu/AdminVerticalMenu.json'));
          $verticalMenuData = json_decode($verticalMenuJson);
          $horizontalMenuJson = file_get_contents(base_path('resources/menu/AdminHorizontalMenu.json'));
          $horizontalMenuData = json_decode($horizontalMenuJson);

          // Share menuData to all views
          $view->with('menuData', [$verticalMenuData, $horizontalMenuData]);
      }
      else {
        $verticalMenuJson = file_get_contents(base_path('resources/menu/UserVerticalMenu.json'));
        $verticalMenuData = json_decode($verticalMenuJson);
        $horizontalMenuJson = file_get_contents(base_path('resources/menu/UserHorizontalMenu.json'));
        $horizontalMenuData = json_decode($horizontalMenuJson);

        // Share menuData to all views
        $view->with('menuData', [$verticalMenuData, $horizontalMenuData]);
      }
  });
  }
}
