<?php

namespace App\Http\Controllers\Admin;

use App\Models\PropertyCondition;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PropertyConditionController extends Controller
{
    public function index(Request $request)
    {
        // البحث
        $search = $request->get('search');
        
        // جلب جميع الحالات أو تطبيق البحث
        $conditions = PropertyCondition::where('deleted', 0)
                                        ->when($search, function($query, $search) {
                                            return $query->where('name', 'like', "%{$search}%")
                                                         ->orWhere('description', 'like', "%{$search}%");
                                        })
                                        ->orderBy('id', 'desc') // ترتيب من الأقدم إلى الأحدث

                                        ->paginate(10); // التصفح، 10 حالات في الصفحة

        return view('admin.property_condition.index', compact('conditions'));
    }

    public function create()
    {
        // عرض صفحة إضافة حالة جديدة
        return view('admin.property_condition.create');
    }

    public function store(Request $request)
    {
        // التحقق من الإدخالات وحفظ الحالة الجديدة
        $request->validate([
            'name' => 'required|string|max:191',
            'description' => 'nullable|string',
        ]);
        \Log::info($request->all());  // تسجيل جميع البيانات القادمة


        // حفظ الشرط الجديد مع تحديد قيمة 'deleted' كـ 0
        PropertyCondition::create([
            'name' => $request->name,
            'description' => $request->description,
            'deleted' => 0, // نحدد أنه غير محذوف
        ]);

        return redirect()->route('admin.property_condition.index')->with('message', 'Condition Added Successfully');
    }

    public function edit($id)
    {
        // جلب الحالة للتعديل
        $condition = PropertyCondition::findOrFail($id);

        return view('admin.property_condition.edit', compact('condition'));
    }

    public function update(Request $request, $id)
    {
        // التحقق من الإدخالات وتحديث الحالة
        $request->validate([
            'name' => 'required|string|max:191',
            'description' => 'nullable|string',
        ]);

        $condition = PropertyCondition::findOrFail($id);
        $condition->update($request->all());

        return redirect()->route('admin.property_condition.index')->with('message', 'Condition Updated Successfully');
    }

    public function destroy($id)
    {
        // جلب الـ PropertyCondition بناءً على الـ ID
        $condition = PropertyCondition::findOrFail($id);
    
        // تحديث الحقل `deleted` ليصبح 1 (محذوف)
        $condition->update(['deleted' => 1]);
    
        // إعادة التوجيه مع رسالة تأكيد
        return redirect()->route('admin.property_condition.index')->with('message', 'Condition Deleted Successfully');
    }
    
    public function show($id)
    {
        // محاولة العثور على الحالة أو إعادة التوجيه في حال عدم وجودها
        $condition = PropertyCondition::find($id);
        
        // إذا كانت الحالة موجودة، اعرض التفاصيل، وإذا لم تكن موجودة، اعرض رسالة خطأ
        if ($condition) {
            return view('admin.property_condition.show', compact('condition'));
        } else {
            return redirect()->route('admin.property.index')->with('error', 'Condition not found');
        }
    }
}
