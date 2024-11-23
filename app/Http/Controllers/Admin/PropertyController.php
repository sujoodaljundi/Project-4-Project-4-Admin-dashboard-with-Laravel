<?php

namespace App\Http\Controllers\Admin;

use App\Models\Property;
use App\Models\Category;  // تأكد من استيراد موديل الفئات
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        // البحث
        $search = $request->get('search');
        
        // جلب العقارات غير المحذوفة أو تطبيق البحث
        $properties = Property::where('deleted', 0)
                                ->when($search, function($query, $search) {
                                    return $query->where('name', 'like', "%{$search}%")
                                                 ->orWhere('address', 'like', "%{$search}%")
                                                 ->orWhere('summary', 'like', "%{$search}%");
                                })
                                ->orderBy('id', 'desc') // ترتيب من الأقدم إلى الأحدث

                                ->paginate(10); // التصفح، 10 عقارات في الصفحة
        
        return view('admin.property.index', compact('properties'));
    }

    public function create()
    {
        // جلب الفئات غير المحذوفة من قاعدة البيانات
        $categories = Category::where('deleted', 0)->get();

        // عرض صفحة إضافة عقار جديد مع تمرير الفئات
        return view('admin.property.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // التحقق من الإدخالات وحفظ العقار الجديد
        $request->validate([
            'name' => 'required|string|max:191',
            'type' => 'required|in:Apartment,House,Studio,Villa',
            'price' => 'required|numeric',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'address' => 'nullable|string|max:191',
            'description' => 'nullable|string',
            'category_id' => 'required|integer|exists:categories,id',
            'status' => 'required|in:Available,Reserved,Unavailable',
            'summary' => 'required|string|max:500', 
        ]);
    
        $propertyData = $request->all();
    
        // إذا تم رفع صورة الغلاف
        if ($request->hasFile('cover')) {
            $fileName = time() . '_' . $request->file('cover')->getClientOriginalName();
            $request->file('cover')->move(public_path('uploads'), $fileName);
            $propertyData['cover'] = $fileName;
        }
    
        Property::create($propertyData);
    
        return redirect()->route('admin.property.index')->with('message', 'Property Added Successfully');
    }

    public function edit($id)
    {
        // جلب العقار للتعديل
        $property = Property::findOrFail($id);

        // جلب الفئات غير المحذوفة لتمريرها إلى الـ view
        $categories = Category::where('deleted', 0)->get();

        return view('admin.property.edit', compact('property', 'categories'));
    }

    public function update(Request $request, $id)
    {
        // التحقق من الإدخالات وتحديث العقار
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string',
            'price' => 'required|numeric',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'address' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|string',
            'summary' => 'required|string|max:500', // تحقق من أن "Summary" هو نص
        ]);

        $property = Property::findOrFail($id);

        $propertyData = $request->all();

        // إذا تم رفع صورة الغلاف جديدة
        if ($request->hasFile('cover')) {
            $fileName = time() . '_' . $request->file('cover')->getClientOriginalName();
            $request->file('cover')->move(public_path('uploads'), $fileName);
            $propertyData['cover'] = $fileName;
        }

        $property->update($propertyData);

        return redirect()->route('admin.property.index')->with('message', 'Property Updated Successfully');
    }

    public function show($id)
    {
        // جلب العقار بناءً على الـ id
        $property = Property::findOrFail($id);
        
        // عرض التفاصيل
        return view('admin.property.show', compact('property'));
    }

    public function destroy($id)
    {
        // جلب العقار بناءً على الـ ID
        $property = Property::findOrFail($id);
    
        // تحديث الحقل `deleted` ليصبح 1 (محذوف)
        $property->update(['deleted' => 1]);
    
        // إعادة التوجيه مع رسالة تأكيد
        return redirect()->route('admin.property.index')->with('message', 'Property Deleted Successfully');
    }
    
}
