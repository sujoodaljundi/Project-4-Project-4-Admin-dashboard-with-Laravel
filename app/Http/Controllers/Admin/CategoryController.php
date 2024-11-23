<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\CategoryFormRequest;

class CategoryController extends Controller
{
    public function index(Request $request) {
        // جلب قيمة البحث من الاستعلام
        $search = $request->get('search');

        // استرجاع الفئات بناءً على البحث وبتقنية الباجنيشن
        $categories = Category::where('deleted', 0)
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                             ->orWhere('description', 'like', "%{$search}%");
            })
            ->orderBy('id', 'desc') // ترتيب من الأقدم إلى الأحدث
            ->paginate(10);  // 10 فئات لكل صفحة

        return view('admin.category.index', compact('categories')); // تمرير المتغير إلى الواجهة
    }

    public function create() {
        return view('admin.category.create');
    }

    public function store(CategoryFormRequest $request) {
        $data = $request->validated();

        // إضافة الكاتيجوري الجديد
        $category = new Category;
        $category->name = $data['name'];
        $category->description = $data['description'];
        $category->created_at = now();  // إضافة تاريخ الإنشاء بشكل تلقائي
        $category->updated_at = now();  // إضافة تاريخ التحديث بشكل تلقائي

        // حفظ الكاتيجوري في قاعدة البيانات
        $category->save();

        return redirect()->route('admin.category')->with('message', 'Category Added Successfully');
    }

    public function edit($category_id) {
        // جلب الكاتيجوري بناءً على الـ id
        $category = Category::find($category_id);
        return view('admin.category.edit', compact('category'));
    }

    public function update(CategoryFormRequest $request, $category_id) {
        $data = $request->validated();

        // تحديث الكاتيجوري
        $category = Category::find($category_id);
        $category->name = $data['name'];
        $category->description = $data['description'];
        $category->updated_at = now();  // تحديث تاريخ التحديث بشكل تلقائي

        // حفظ التعديلات في قاعدة البيانات
        $category->update();

        return redirect()->route('admin.category')->with('message', 'Category Updated Successfully');
    }

    public function softDelete($category_id) {
        // جلب الفئة بناءً على الـ id
        $category = Category::find($category_id);

        if ($category) {
            // تحديث العمود 'deleted' إلى 1 (محذوف)
            $category->deleted = 1;
            $category->save();

            return redirect()->route('admin.category')->with('message', 'Category Soft Deleted Successfully');
        }

        return redirect()->route('admin.category')->with('error', 'Category Not Found');
    }
}
