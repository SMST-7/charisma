<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function redirect;
use function response;
use function view;

class WishlistController extends Controller
{
    public function toggle($id)
    {
        $user = auth()->user();
        $wishlistItem = $user->wishlists()->where('product_id', $id)->first();

        if ($wishlistItem) {
            // اگر موجود بود حذف کن
            $wishlistItem->delete();
            return back()->with('success', 'محصول از علاقه‌مندی‌ها حذف شد.');
        } else {
            // اگر نبود اضافه کن
            $user->wishlists()->create(['product_id' => $id]);
            return back()->with('success', 'محصول به علاقه‌مندی‌ها اضافه شد.');
        }
    }

    public function __construct()
    {
        $this->middleware('auth'); // اطمینان از لاگین بودن کاربر
    }

//    public function __construct()
//    {
//        $this->middleware('auth')->except(['somePublicMethod']);
//    }
    public function index()
    {
//        if (!Auth::check()) {
//            return redirect()->route('login');
//        }
        $wishlists = Auth::user()->wishlists()->with(['products.images', 'products.attributeValues.attribute'])->get();//        فقط wishlistهای کاربر فعلی (کسی که لاگین کرده) رو لود می‌کنه.
        return view('app.wishlist.index', compact('wishlists'));
    }
    public function store(Request $request, string $id)
    {
        $user = Auth::user();
        $product = Product::findOrFail($id);

        // بررسی وجود محصول در لیست علاقه‌مندی‌ها
        $exists = Wishlist::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'محصول قبلاً در لیست علاقه‌مندی‌ها وجود دارد');
        }

        // ایجاد رکورد جدید در لیست علاقه‌مندی‌ها
        Wishlist::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
        ]);

        return redirect()->back()->with('success', 'محصول به لیست علاقه‌مندی‌ها اضافه شد');
    }


    public function destroy(string $id)
    {
        $wishlist=Wishlist::findorFail($id);
        $user = Auth::user();
        $deleted = Wishlist::where('user_id', $user->id)
            ->where('id', $wishlist->id)
            ->delete();

        if ($deleted) {
            return redirect()->back()->with('success',' محصول از لیست علاقه‌مندی‌ها حذف شد');
        }
        return redirect()->back()->with('error','نا موفق');

//        return response()->json(['message' => 'محصول در لیست علاقه‌مندی‌ها یافت نشد'], 404);
    }

    public function create()
    {
        //
    }

    private function middleware(string $string)
    {
    }

}
