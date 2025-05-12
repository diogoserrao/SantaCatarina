<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Propriedade para definir para onde redirecionar após login
    protected $redirectTo = '/admin';
    
    // Mostrar formulário de login
    public function showLoginForm()
    {
        return view('auth.login');
    }
    
    // Processar tentativa de login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            // Redirecionar para a rota pretendida ou para o dashboard admin
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors([
            'email' => 'As credenciais fornecidas não correspondem aos nossos registros.',
        ])->withInput($request->only('email', 'remember'));
    }
    
    // Processar logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Limpar todos os cookies de sessão
        $cookieNames = ['laravel_session', 'XSRF-TOKEN'];
        
        foreach ($cookieNames as $name) {
            $cookie = cookie($name, '', -1); // expira imediatamente
            Cookie::queue($cookie);
        }

        if ($request->has('redirect_to') && $request->redirect_to === 'login') {
            return redirect('/login');
        }

        return redirect('/');
    }
}