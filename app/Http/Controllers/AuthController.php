<?php

namespace App\Http\Controllers;

use App\Services\ImageService;
use Illuminate\Http\Request;
use App\Models\Position;
use App\Models\User;
use App\Http\Requests\RegistrationRequest;
use Illuminate\Validation\ValidationException;
use Tinify\Tinify;
use Tinify\Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    
   public function showRegistrationForm()
    {
        $positions = Position::all();
        return view('registration', compact('positions'));
    }

     public function generateRegistrationToken()
    {
        // Generating a unique token for registration
        $registrationToken = Str::random(32);

        // We save the token in the cache for 40 minutes
        Cache::put('registration_token:' . $registrationToken, true, 40);

        return $registrationToken;
    }

 public function register(RegistrationRequest $request, ImageService $imageService)
    {
        try {
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'position_id' => $request->input('position_id'),
                'token' => $this->generateRegistrationToken(),
            ]);

            // Processing an image using ImageService
            $imageService->optimizeAndSave($user, $request->file('photo'));

            Auth::login($user);

            return redirect()->route('users');
        } catch (\Exception $e) {
            return back()->withErrors([$e->getMessage()])->withInput();
        }
    }

}
