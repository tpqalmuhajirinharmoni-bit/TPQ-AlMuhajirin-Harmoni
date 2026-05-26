<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Show login form
     */
    public function showLoginForm()
    {
        // Redirect to home and open login modal for consistent UX
        return redirect()->route('home', ['show_login' => 1]);
    }

    /**
     * Show registration form
     */
    public function showRegisterForm()
    {
        $roles = Role::whereIn('slug', ['santri', 'wali-santri'])->get();

        return view('auth.register', compact('roles'));
    }

    /**
     * Handle registration
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|exists:roles,slug',
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $role = Role::where('slug', $request->role)->first();
        if ($role) {
            $user->roles()->attach($role);
        }

        Auth::login($user);
        $request->session()->regenerate();

        Notification::createForAdmins(
            'new_user',
            'Pengguna baru terdaftar',
            'Akun baru telah dibuat: ' . $user->name . ' (' . $user->email . ')',
            ['user_id' => $user->id]
        );

        Notification::createForUser(
            $user,
            'welcome',
            'Selamat datang di TPQ Al Muhajirin Harmoni',
            'Akun Anda telah berhasil dibuat. Silakan lengkapi profil Anda jika diperlukan.',
            []
        );

        return redirect()->intended($this->roleRedirectPath($request->role));
    }

    /**
     * Handle login
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $loginField = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $credentials = [
            $loginField => $request->username,
            'password' => $request->password,
        ];

        $remember = $request->has('remember');

        if (!Auth::attempt($credentials, $remember)) {
            return back()->withErrors([
                'login' => 'Username/email atau password salah.',
            ])->onlyInput('username');
        }

        $request->session()->regenerate();
        $user = Auth::user();
        $role = $this->findLoginRole($user);

        return redirect()->intended($this->roleRedirectPath($role));
    }

    protected function findLoginRole(User $user): string
    {
        $priority = ['admin', 'bendahara', 'guru', 'wali-santri', 'santri', 'pembina', 'penanggung-jawab', 'ketua', 'sekretaris', 'tamu'];

        foreach ($priority as $slug) {
            if ($user->hasRole($slug)) {
                return $slug;
            }
        }

        return $user->roles()->pluck('slug')->first() ?? 'tamu';
    }

    /**
     * Redirect path based on role
     */
    protected function roleRedirectPath($role): string
    {
        $map = [
            'admin' => '/admin',
            'pembina' => '/dashboard',
            'penanggung-jawab' => '/dashboard',
            'ketua' => '/dashboard',
            'sekretaris' => '/dashboard',
            'bendahara' => '/dashboard',
            'guru' => '/dashboard',
            'wali-santri' => '/dashboard',
            'santri' => '/dashboard',
            'tamu' => '/',
        ];

        return $map[$role] ?? '/dashboard';
    }

    /**
     * Handle logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
