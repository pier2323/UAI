<?

use App\Http\Controllers\PersonalUaiController;
use Illuminate\Support\Facades\Route;

Route::controller(PersonalUaiController::class)->group(Function () {
      Route::get('/personal-uai/dashboard', 'dashboard')->name('personal-uai.dashboard');
  }
);