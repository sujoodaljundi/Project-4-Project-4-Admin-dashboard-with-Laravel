<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // إذا كان هناك نص بحث في الاستعلام، نقوم بتصفية المستخدمين
        $search = $request->input('search');

        // إذا كان هناك نص بحث، نقوم بفلترة النتائج، وإذا لا، نقوم بجلب جميع المستخدمين
        $users = User::where('name', 'like', "%$search%")
                     ->orWhere('email', 'like', "%$search%")
                     ->orWhere('country', 'like', "%$search%")
                     ->orderBy('id', 'desc') 
                     ->paginate(10);  // تغيير العدد حسب الحاجة

        // إعادة عرض صفحة الـ View مع المتغيرات
        return view('admin.users.index', compact('users'));
    }

    public function toggleDelete($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->deleted = $user->deleted == 1 ? 0 : 1;
            $user->save();
        }

        return redirect()->route('users.index');
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255', // تحقق من الحقل الجديد
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'country' => $request->country,
            'city' => $request->city, // أضف هذا السطر
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('users.index')->with('message', 'User added successfully!');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id); // جلب المستخدم بناءً على الـ ID
        return view('admin.users.edit', compact('user')); // تمرير البيانات إلى صفحة التعديل
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // التحقق من صحة البيانات
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'country' => 'required|string|max:255',
        ]);

        // تحديث بيانات المستخدم
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'country' => $request->country,
        ]);

        // إعادة التوجيه مع رسالة النجاح
        return redirect()->route('users.index')->with('message', 'User updated successfully!');
    }

    public function show($id)
    {
        // جلب المستخدم مع جميع البيانات المرتبطة
        $user = User::with(['properties', 'appointments', 'bookings', 'installments'])->findOrFail($id);

        // إعادة توجيه إلى صفحة العرض مع البيانات
        return view('admin.users.show', compact('user'));
    }
}
