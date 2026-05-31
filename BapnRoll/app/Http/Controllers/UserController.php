<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use App\Models\Orders;
use App\Models\Products;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('login.login');
    }
    
    public function dashboard(Request $request){

        $products = Products::where('stock', '<', 5)->where('stock', '>', 0)->get();
        $product = Products::where('stock', 0)->get();

        $year = $request->year ?? now()->year;
        $years = now()->year;

        // Sales per month for the current year only
        $salesPerMonth = Orders::where('status', 'Completed')
            ->whereYear('created_at', $year)
            ->selectRaw('MONTH(created_at) as month, SUM(total) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month');

        
        $monthlySales = collect(range(1, 12))->map(fn($m) => $salesPerMonth->get($m, 0));

        
        $topProducts = OrderItem::selectRaw('products_id, SUM(quantity) as total_qty')
            ->groupBy('products_id')
            ->orderByDesc('total_qty')
            ->limit(5)
            ->with('products')
            ->get()
            ->map(fn($item) => [
                'name' => $item->products->name ?? 'Unknown',
                'qty'  => $item->total_qty,
            ]);

        $userquery = Auth::user();
        $user = $userquery->role;

        return view($user.'.dashboard', compact(
            'products', 'product', 'monthlySales', 'topProducts', 'year', 'years'
        ));
    }
    
    public function UserLoginValidation(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|min:3|exists:users,username',
            'password' => 'required|string|min:6',
        ], [
            'username.required' => "The Username is Required",
            'username.min' => 'User Must be atleast 3 Characters',
            'username.exists' => 'Username does not exist',
            'password.required' => 'Password is Required',
            'password.min' => 'Password must be atleast 6 characters',
        ]);

        

        if(Auth::attempt([
            'username' => $request->username,
            'password' => $request->password,
        ])){

            $request->session()->regenerate();
            $user = Auth::user();

            if($user->role === 'admin'){
                return redirect()->route('admin.dashboard');
            }elseif($user->role === 'manager'){
                return redirect()->route('manager.dashboard');
            }else{
                return redirect()->route('staff.products');
            }
        }

        return back()->withErrors([
            'password' => 'Incorrect Password',
        ])->withInput();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeUser(Request $request)
    {
        $request->validate([
            'username' => 'required|string|min:3|unique:users,username',
            'password' => 'required|string|min:6',
            'role' => 'required|string'
        ]);

        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->back()->with('success', 'User created Successfully');
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();;
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    /**
     * Display the specified resource.
     */

    public function showUsers()
    {
        $users = User::all();

        return view('admin.users', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateUser(Request $request, $id)
    {
        $users = User::findOrFail($id);

        $request->validate([
            'username' => 'required|string|min:3|unique:users,username,'.$id,
            'password' => 'required|string|min:6',
            'role' => 'required|string'
        ]);

        $users->username = $request->username;
        $users->role = $request->role;

        if($request->filled('password')){
            $users->password = Hash::make($request->password);
        }

        $users->save(); 

        return redirect()->back()->with('success', 'User Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteUser($id)
    {
        $users = User::findOrFail($id);
        $users->delete();

        return back()->with('success', 'User Deleted Successfully!');
    }
}
