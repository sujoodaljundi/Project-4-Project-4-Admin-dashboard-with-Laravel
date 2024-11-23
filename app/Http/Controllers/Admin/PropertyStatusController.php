<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\PropertyStatus;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\PropertyStatusController;

class PropertyStatusController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $statuses = PropertyStatus::where('deleted', 0)
            ->when($search, function($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                             ->orWhere('description', 'like', "%{$search}%");
            })
            ->orderBy('id', 'desc') // ترتيب من الأقدم إلى الأحدث

            ->paginate(10);

        return view('admin.property_status.index', compact('statuses'));
    }

    public function create()
    {
        return view('admin.property_status.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:191',
            'description' => 'nullable|string',
        ]);

        PropertyStatus::create([
            'name' => $request->name,
            'description' => $request->description,
            'deleted' => 0,
        ]);

        return redirect()->route('admin.property_status.index')->with('message', 'Property Status Added Successfully');
    }

    public function edit($id)
    {
        // جلب الحالة للتعديل
        $status = PropertyStatus::findOrFail($id);
    
        // عرض صفحة التعديل مع تمرير البيانات
        return view('admin.property_status.edit', compact('status'));
    }
    public function update(Request $request, $id)
{
    // التحقق من البيانات المدخلة
    $request->validate([
        'name' => 'required|string|max:191',
        'description' => 'nullable|string',
    ]);

    // تحديث الحالة
    $status = PropertyStatus::findOrFail($id);
    $status->update($request->only(['name', 'description']));

    // إعادة التوجيه مع رسالة نجاح
    return redirect()->route('admin.property_status.index')->with('message', 'Status Updated Successfully');
}

public function destroy($id)
{
    // جلب الـ PropertyStatus بناءً على الـ ID
    $status = PropertyStatus::findOrFail($id);

    // تحديث الحقل `deleted` ليصبح 1 (محذوف)
    $status->update(['deleted' => 1]);

    // إعادة التوجيه مع رسالة تأكيد
    return redirect()->route('admin.property_status.index')->with('message', 'Property Status Deleted Successfully');
}

}
