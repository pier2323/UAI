<?

use Illuminate\Support\Facades\Route;

Route::group(
  [
      'prefix' => 'personalUai',
      'controller' => 'App\Http\Controllers\personalUaiController',
  ],
  Function () {
      Route::get('/', 'dashboard');
  }
);