<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;
use App\Models\Admin;
use App\Models\User;
class PasswordResetLinkAdminController extends Controller
{
    public function create(): View
    {
        return view('auth.admin-forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);
        $admin = Admin::where('email', $request->email)->first();
        $user = User::where('email', $request->email)->first();
        if ($admin) {
            \Illuminate\Auth\Notifications\ResetPassword::createUrlUsing(function ($notifiable, $token) {
                return url('reset-passwordAdmin/' . $token . '?email=' . urlencode($notifiable->getEmailForPasswordReset()));
            });

            Password::broker('admins')->sendResetLink($request->only('email'));

            return back()->with('status', __('El enlace de restablecimiento de contraseña ha sido enviado a tu correo'));
        }

        if ($user) {
            $status = Password::sendResetLink(
                $request->only('email')
            );
    
            return $status == Password::RESET_LINK_SENT
                        ? back()->with('status', __('El enlace de restablecimiento de contraseña ha sido enviado a tu correo'))
                        : back()->withInput($request->only('email'))
                            ->withErrors(['email' => __($status)]);
        }
        return back()->withErrors(['email' => __('Correo electrónico no encontrado.')]);
    }
}
