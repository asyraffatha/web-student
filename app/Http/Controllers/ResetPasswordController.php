<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\User; // Sesuaikan dengan model User Anda

class ResetPasswordController extends Controller
{
    /**
     * Verify if email exists in database
     */
    public function verifyEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $email = $request->email;
        
        // Cek apakah email ada di database
        $user = User::where('email', $email)->first();
        
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Email tidak ditemukan dalam sistem.'
            ], 404);
        }

        // Generate token untuk reset password
        $token = Str::random(60);
        
        // Simpan token ke database password_resets
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $email],
            [
                'token' => Hash::make($token),
                'created_at' => Carbon::now()
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Email terverifikasi.',
            'token' => $token
        ]);
    }

    /**
     * Reset password
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $email = $request->email;
        $token = $request->token;
        $password = $request->password;

        // Cek apakah token valid
        $passwordReset = DB::table('password_reset_tokens')
            ->where('email', $email)
            ->first();

        if (!$passwordReset || !Hash::check($token, $passwordReset->token)) {
            return response()->json([
                'success' => false,
                'message' => 'Token tidak valid atau sudah kedaluwarsa.'
            ], 400);
        }

        // Cek apakah token sudah kedaluwarsa (misalnya 60 menit)
        $tokenCreatedAt = Carbon::parse($passwordReset->created_at);
        if ($tokenCreatedAt->addMinutes(60)->isPast()) {
            return response()->json([
                'success' => false,
                'message' => 'Token sudah kedaluwarsa. Silakan ulangi proses reset password.'
            ], 400);
        }

        // Update password user
        $user = User::where('email', $email)->first();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User tidak ditemukan.'
            ], 404);
        }

        $user->password = Hash::make($password);
        $user->save();

        // Hapus token dari database
        DB::table('password_reset_tokens')->where('email', $email)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Password berhasil diperbarui.'
        ]);
    }
}