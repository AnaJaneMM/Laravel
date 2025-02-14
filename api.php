use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StudentController;


Route::apiResource('students', StudentController::class);

Route::get('/user', function (Request $request) {

return $request->user();

});
