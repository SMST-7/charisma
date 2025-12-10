<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\ActivityLog;
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



    public function edit(Request $request): View
    {
        $user = $request->user(); // کاربر فعلی
        $users = Auth::user()->isAdmin() ? User::all() : collect(); // فقط برای ادمین
        return view('profile.edit', [
            'user' => $user,
            'users' => $users,
        ]);
    }


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

            ActivityLog::record('ویرایش', 'پروفایل', $user->id, 'Updated user titled: ' . $user->title);

            return Redirect::route('profile.edit')->with('success', 'پروفایل با موفقیت به‌روزرسانی شد.');
        }

        return Redirect::route('profile.edit')->withErrors(['error' => 'کاربر یافت نشد یا غیرفعال است.']);
    }



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
