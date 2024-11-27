namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login.form');
        }
        return view('home');
    }

    public function loginForm()
    {
        return view('login');
    }

    public function registerForm()
    {
        return view('register');
    }

    public function registerProcess(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
            'email' => 'required|string|email|max:255|unique:users',
        ]);

        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'email' => $request->email,
        ]);

        return redirect()->route('login.form')->with('success', 'Registration successful. Please log in.');
    }

    public function loginProcess(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            return redirect()->route('home');
        }

        return redirect()->route('login.form')->withErrors(['login' => 'Invalid credentials.']);
    }

    public function logoutProcess()
    {
        Auth::logout();
        Session::flush();
        return redirect()->route('login.form');
    }
}