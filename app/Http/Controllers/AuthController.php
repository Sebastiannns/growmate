<?php

// AuthController: handle custom auth flow (options, personal data, OTP)
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Tampilkan halaman pilih role (opsi.png)
    public function showOptions()
    {
        return view('auth.options');
    }

    // Tampilkan halaman data pribadi setelah register (data pribadi.png) — khusus student
    public function showPersonalData()
    {
        if (auth()->user()->role !== 'student') {
            return redirect()->route('dashboard');
        }

        if (auth()->user()->nim) {
            return redirect()->route('dashboard');
        }

        return view('auth.personal-data');
    }

    // Simpan data pribadi user — khusus student
    public function storePersonalData(Request $request)
    {
        if (auth()->user()->role !== 'student') {
            abort(403);
        }

        $request->validate([
            'nim' => ['required', 'string', 'max:20', 'unique:users,nim'],
            'jurusan' => ['required', 'string', 'max:100'],
            'fakultas' => ['required', 'string', 'max:100'],
            'semester' => ['required', 'integer', 'min:1', 'max:14'],
            'phone' => ['required', 'string', 'max:20'],
        ]);

        $user = Auth::user();
        $user->update($request->only(['nim', 'jurusan', 'fakultas', 'semester', 'phone']));

        return redirect()->route('otp.show');
    }

    // Tampilkan halaman OTP verification (otp.png)
    public function showOtp()
    {
        return view('auth.verify-otp');
    }

    // Verifikasi OTP
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => ['required', 'string', 'size:6'],
        ]);

        // Rate limiting: 5 percobaan per menit
        $key = 'otp-attempts-' . auth()->id();
        $attempts = (int) cache($key, 0);
        if ($attempts >= 5) {
            return back()->withErrors(['otp' => 'Terlalu banyak percobaan. Silakan coba lagi dalam 1 menit.']);
        }
        cache([$key => $attempts + 1], now()->addMinute());

        // Verifikasi OTP (sementara: apapun kode 6 digit diterima)
        return redirect()->route('dashboard');
    }
}
