<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProfileController extends Controller
{

    /**
     * Display the user's profile form.
     */
//    public function edit(Request $request): View
//    {
////        $users = Auth::user()->isAdmin() ? User::all() : collect();
//        $user=User::where('status',1)->first();
//        return view('profile.edit', [
////            'user' => $request->user(),
//            'user' => $user,
//        ]);
//    }

    public function edit(Request $request): View
    {
        $user = $request->user(); // کاربر فعلی
        $users = Auth::user()->isAdmin() ? User::all() : collect(); // فقط برای ادمین
        return view('profile.edit', [
            'user' => $user,
            'users' => $users,
        ]);
    }
    /**
     * Update the user's profile information.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $user = User::findOrFail($id);

        // Check if user exists and is active
        if ($user && $user->status == 1) {
            // Validate the request
            $request->validate([
                'name' => ['nullable', 'string', 'max:255'],
                'username' => ['nullable', 'string', 'max:255', 'unique:users,username,' . $user->id],
                'current_password' => ['required', 'string'],
                'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            ]);

            // Verify current password
            if (!Hash::check($request->current_password, $user->password)) {
                return Redirect::route('profile.edit')->withErrors(['current_password' => 'رمز عبور فعلی اشتباه است.']);
            }

            // Prepare data for update
            $updateData = [
                'name' => $request->name ?? $user->name,
                'username' => $request->username ?? $user->username,
            ];

            // Update password if provided
            if ($request->filled('password')) {
                $updateData['password'] = Hash::make($request->password);
            }

            // Update user
            $user->update($updateData);

            return Redirect::route('profile.edit')->with('success', 'پروفایل با موفقیت به‌روزرسانی شد.');
        }

        return Redirect::route('profile.edit')->withErrors(['error' => 'کاربر یافت نشد یا غیرفعال است.']);
    }



//    public function update(Request $request,string $id): RedirectResponse
//    {
//
//        $user=User::findorFail($id);
//        if ($user && $user->status==1) {
//            $request->validate([
//                'name'=>['nullable','string'],
//                'username'=>['nullable','string'],
//                'current_password'=>['required', 'string'],
//                'password'=>['nullable', 'string','min:8','confirmed'],
//            ]);
//            if ($user->password==$request->current_password){
//                $user->update([
//                    'name' => $request->name,
//                    'username' => $request->username,
//
//                ]);
//            }
//
//
//
//        }
//        return Redirect::route('profile.edit')->with('status', 'وضعیت کاربر به‌روزرسانی شد.');
//        // به‌روزرسانی پروفایل کاربر فعلی
//
////        $validated = $request->validate([
////            'name' => ['required', 'string', 'max:255'],
////            'username' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z0-9_]+$/'],
//////            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
////        ]);
//
////        $updateRequest = app(ProfileUpdateRequest::class);
////        $updateRequest->merge($request->all());
////        $validated = $updateRequest->validate([
////            'name' => ['required', 'string', 'max:255'],
////            'username' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z0-9_]+$/', Rule::unique('users')->ignore($request->user()->id)],
////        ]);
////
////        $user = $request->user();
////        $user->fill($validated);
////        $user->save();
////        return Redirect::route('profile.edit')->with('status', 'profile-updated');
//    }



    public function blockUser(Request $request, User $user): RedirectResponse
    {
        if (!Auth::user()->isAdmin()) {
            return redirect()->route('profile.edit')->with('error', 'دسترسی غیرمجاز');
        }

        $request->validate([
            'status' => ['required', 'in:-1,0'],
        ]);

        $user->update([
            'status' => $request->status,
        ]);

        return Redirect::route('profile.edit')->with('success', 'وضعیت کاربر به‌روزرسانی شد.');
    }

//    public function update(ProfileUpdateRequest $request): RedirectResponse
//    {
//
//        $validated = $request->validated();
//
//        // اگر رمز عبور وارد شده، آن را هش کنیم
//        if (!empty($validated['password'])) {
//            $validated['password'] = Hash::make($validated['password']);
//        } else {
//            unset($validated['password']); // رمز را از آپدیت حذف کنیم
//        }
//
//        $request->user()->fill($validated);
//        $request->user()->save();
//
//        return Redirect::route('profile.edit')->with('update', 'پروفایل با موفقیت به‌روزرسانی شد.');
//    }

    /**
     * Delete the user's account.
     */
//    public function destroy(Request $request): RedirectResponse
//    {
//        $request->validateWithBag('userDeletion', [
//            'password' => ['required', 'current_password'],
//        ]);
//
//        $user = $request->user();
//
//        Auth::logout();
//
//        $user->delete();
//
//        $request->session()->invalidate();
//        $request->session()->regenerateToken();
//
//        return Redirect::to('/');
//    }

//    public function changeStatus(Request $request, User $user) : RedirectResponse
//    {
//        if ($user && Auth::user()->isAdmin()) {
//            $request->validate([
//                'status' => ['required', 'in:-1,0,1'],
//            ]);
//
//            $user->update([
//                'status' => $request->status,
//            ]);
//            return Redirect::route('profile.edit')->with('success', 'وضعیت کاربر به‌روزرسانی شد.');
//        }
//    }


    public function deleteUser(User $user): RedirectResponse
    {
        if (! Auth::user()->isAdmin()) {
            return redirect()->route('profile.edit')->with('error', 'دسترسی غیرمجاز');
        }

        $user->delete();

        return redirect()->route('profile.edit')->with('success', 'کاربر با موفقیت حذف شد.');
    }


    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
