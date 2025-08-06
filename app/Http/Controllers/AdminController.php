<?php

namespace App\Http\Controllers;

use App\Models\EmpModel;
use App\Models\LoginActivityModel;
use Illuminate\Http\Request;
use App\Models\UserModel;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;

class AdminController extends Controller
{
    //Index Page
    public function index()
    {
        $adminCount = UserModel::where('role', 'admin')->count();
        $agentCount    = UserModel::where('role', 'agent')->count();
        $userCount = UserModel::count();
        $empCount = EmpModel::count();
        return view('admin.index', compact('adminCount', 'agentCount', 'userCount', 'empCount'));
    }

    //Register Page
    public function RegisterPage()
    {
        return view('admin.register');
    }
    public function RegisterCreate(Request $request)
    {
        $user = UserModel::create([
            'role' => $request->input('role'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'created_at' => now(),
        ]);
        if ($user) {
            $agent = new Agent();
            $ip = request()->ip();
            $device = $agent->isMobile() ? 'Mobile' : ($agent->isTablet() ? 'Tablet' : 'Desktop');
            $platform = $agent->platform();
            $browser = $agent->browser();
            $description = "Username: {$user->username},Table Id: {$user->id}, Table: User";
            LoginActivityModel::create([
                'role' => $user->role,
                'username' => $user->username,
                'status' => 'register',
                'ip' => $ip,
                'browser' => $browser,
                'device' => $device,
                'os' => $platform,
                'description' => $description,
                'created_at' => now()
            ]);
            return redirect()->route('login.page')->with('success', 'Register successfully!');
        } else {
            return redirect()->route('register.page')->with('error', 'Register failed!');
        }
    }

    //Login page
    public function LoginPage()
    {
        return view('admin.login');
    }
    public function LoginCreate(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $user = Auth::user();

            $agent = new Agent();
            $ip = request()->ip();
            $device = $agent->isMobile() ? 'Mobile' : ($agent->isTablet() ? 'Tablet' : 'Desktop');
            $platform = $agent->platform();
            $browser = $agent->browser();
            $description = $description = "Username: {$user->username},Table Id: {$user->id}, Table: User";
            LoginActivityModel::create([
                'role' => $user->role,
                'username' => $user->username,
                'status' => 'login',
                'ip' => $ip,
                'browser' => $browser,
                'device' => $device,
                'os' => $platform,
                'description' => $description,
                'created_at' => now()
            ]);


            $request->session()->put('username', $user->username);


            if ($user->role === 'admin') {
                return redirect()->route('user')->with('success', 'Welcome Admin!');
            } elseif ($user->role === 'agent') {
                return redirect()->route('emp.show')->with('success', 'Welcome Agent!');
            }

            return redirect()->route('index')->with('success', 'Login Successfully');
        }
    }

    //User
    public function User()
    {
        $user = UserModel::all();
        return view('admin.user', ['users' => $user]);
    }
    public function UserCreate(Request $request)
    {
        $users = Auth::user();
        $user = UserModel::create([
            'role' => $request->input('role'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'created_at' => now(),
        ]);
        if ($user) {
            $agent = new Agent();
            $ip = request()->ip();
            $device = $agent->isMobile() ? 'Mobile' : ($agent->isTablet() ? 'Tablet' : 'Desktop');
            $platform = $agent->platform();
            $browser = $agent->browser();
            $description = "Username: {$user->username},Table Id: {$user->id}, Table: User";
            LoginActivityModel::create([
                'role' => $users->role,
                'username' => $users->username,
                'status' => 'register',
                'ip' => $ip,
                'browser' => $browser,
                'device' => $device,
                'os' => $platform,
                'description' => $description,
                'created_at' => now()
            ]);
            return redirect()->route('user')->with('success', 'User created successfully!');
        } else {
            return redirect()->route('user')->with('error', 'User creation failed!');
        }
    }

    public function UserEdit($id)
    {
        $user = UserModel::find($id);
        return view('admin.user-edit', compact('user'));
    }

    public function UserUpdate(Request $request, $id)
    {
        $user = UserModel::find($id);
        $user->update([
            'role' => $request->input('role'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
        ]);

        if ($user) {
            return redirect()->route('user')->with('success', 'Data update successfully');
        } else {
            return redirect()->route('user')->with('error', 'Data update failed');
        }
    }

    public function UserDelete($id)
    {
        $user = UserModel::find($id);
        $user->delete();
        return redirect()->route('user')->with('success', 'Data delete successfully');
    }
    //Employee 
    public function EmpShow()
    {
        if (Auth::user()->role === 'agent') {
            $username = Auth::user()->username;
            $employees = EmpModel::where('emp_username', $username)->get();
        } else {
            $employees = EmpModel::all();
        }
        return view('admin.emp_form', compact('employees'));
    }
    public function Employee(Request $request)
    {
        $user = Auth::user();

        $image_name = null;
        $resume_name = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('image'), $image_name);
        }
        if ($request->hasFile('resume')) {
            $resume = $request->file('resume');
            $resume_name = time() . '.' . $resume->getClientOriginalExtension();
            $resume->move(public_path('resume'), $resume_name);
        }

        $emp = EmpModel::create([

            'emp_username' => $user->username,
            'emp_name' => $request->input('emp_name'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
            'qualification' => $request->input('qualification'),
            'certification' => $request->input('certification'),
            'achievement' => $request->input('achievement'),
            'skill' => $request->input('skill'),
            'image' =>  $image_name,
            'resume' => $resume_name,
            'created_at' => now(),

        ]);

        if ($emp) {
            $agent = new Agent();
            $ip = request()->ip();
            $device = $agent->isMobile() ? 'Mobile' : ($agent->isTablet() ? 'Tablet' : 'Desktop');
            $platform = $agent->platform();
            $browser = $agent->browser();
            $description = "Username: {$emp->emp_name},Table Id: {$emp->id}, Table Name: Employee";

            LoginActivityModel::create([
                'role' => $user->role,
                'username' => $user->username,
                'status' => 'insert',
                'ip' => $ip,
                'browser' => $browser,
                'device' => $device,
                'os' => $platform,
                'description' => $description,
                'created_at' => now()
            ]);


            return redirect()->route('emp.show')->with('success', 'Employee created successfully!');
        } else {
            return redirect()->route('emp.show')->with('error', 'Employee creation failed!');
        }
    }
    public function EmpEdit($id)
    {
        $employe = EmpModel::findOrFail($id);
        return view('admin.emp-edit', compact('employe'));
    }
    public function EmpUpdate(Request $request, $id)
    {
        $emp = EmpModel::find($id);
        $image_name = $emp->image;
        $resume_name = $emp->resume;

        if ($request->hasFile('image')) {
            if ($emp->image && file_exists(public_path('image/' . $emp->image))) {
                unlink(public_path('image/' . $emp->image));
            }
            $image = $request->file('image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('image'), $image_name);
        }

        if ($request->hasFile('resume')) {

            if ($emp->resume && file_exists(public_path('resume/' . $emp->resume))) {
                unlink(public_path('resume/' . $emp->resume));
            }
            $resume = $request->file('resume');
            $resume_name = time() . '.' . $resume->getClientOriginalExtension();
            $resume->move(public_path('resume'), $resume_name);
        }

        // Update employee data
        $emp->update([
            'emp_name' => $request->input('emp_name'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
            'qualification' => $request->input('qualification'),
            'certification' => $request->input('certification'),
            'achievement' => $request->input('achievement'),
            'skill' => $request->input('skill'),
            'image' => $image_name,
            'resume' => $resume_name,
        ]);

        if ($emp) {
            $user = Auth::user();

            $agent = new Agent();
            $ip = request()->ip();
            $device = $agent->isMobile() ? 'Mobile' : ($agent->isTablet() ? 'Tablet' : 'Desktop');
            $platform = $agent->platform();
            $browser = $agent->browser();
            $description = "Username: {$emp->emp_name},Table Id: {$emp->id}, Table Name: Employee";

            LoginActivityModel::create([
                'role' => $user->role,
                'username' => $user->username,
                'status' => 'update',
                'ip' => $ip,
                'browser' => $browser,
                'device' => $device,
                'os' => $platform,
                'description' => $description,
                'created_at' => now()
            ]);
        }

        return redirect()->route('emp.show')->with('success', 'Employee updated successfully!');
    }


    public function EmpDelete($id)
    {
        $emp = EmpModel::findOrFail($id);

        // Image & Resume Delete
        if ($emp->image) {
            $imagePath = public_path('image/' . $emp->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        if ($emp->resume) {
            $resumePath = public_path('resume/' . $emp->resume);
            if (file_exists($resumePath)) {
                unlink($resumePath);
            }
        }
        $emp->delete();
        if ($emp) {
            $user = Auth::user();

            $agent = new Agent();
            $ip = request()->ip();
            $device = $agent->isMobile() ? 'Mobile' : ($agent->isTablet() ? 'Tablet' : 'Desktop');
            $platform = $agent->platform();
            $browser = $agent->browser();
            $description = "Username: {$emp->emp_name},Table Id: {$emp->id}, Table Name: Employee";

            LoginActivityModel::create([
                'role' => $user->role,
                'username' => $user->username,
                'status' => 'Delete',
                'ip' => $ip,
                'browser' => $browser,
                'device' => $device,
                'os' => $platform,
                'description' => $description,
                'created_at' => now()
            ]);
        }
        return redirect()->route('emp.show')->with('success', 'Employee deleted successfully!');
    }

    //Login Details

    public function LoginDetails()
    {
        $login_details = LoginActivityModel::all();
        return view('admin.login_details', compact('login_details'));
    }

    //Logout
    public function Logout(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $agent = new Agent();
            $ip = request()->ip();
            $device = $agent->isMobile() ? 'Mobile' : ($agent->isTablet() ? 'Tablet' : 'Desktop');
            $platform = $agent->platform();
            $browser = $agent->browser();

            LoginActivityModel::create([
                'role' => $user->role,
                'username' => $user->username,
                'status' => 'logout',
                'ip' => $ip,
                'browser' => $browser,
                'device' => $device,
                'os' => $platform,
                'description' => 'register',
                'created_at' => now()
            ]);
            Auth::logout();
            $request->session()->flush();
            return redirect()->route('login.page')->with('success', 'Logout Successsfully');
        }
    }
}
