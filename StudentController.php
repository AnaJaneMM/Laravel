namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\student;
use Illuminate\Http\Request;

class StudentController extends Controller
{

public function index()
{
	return student::all();
}

public function store(Request $request)
{
	$student = student::create($request->all());
	return response()->json($student,201);
}

public function show(student $student)
{
	return $student;
}

public function update(Request $request, student $student)
{
	$student->update($request->all());
	return response()->json($student);
}

public function destroy (student $student)
{
$student->delete();
return response()->json(null,204);
}
}
