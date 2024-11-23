<?php

namespace App\Http\Controllers\Admin;

use App\Models\PriceRange;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PriceRangeController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');

        $ranges = PriceRange::where('deleted', 0)
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            })
            ->orderBy('id', 'desc') // ترتيب من الأقدم إلى الأحدث

            ->paginate(10);

        return view('admin.price_range.index', compact('ranges'));
    }

    public function create()
    {
        return view('admin.price_range.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:191',
            'description' => 'nullable|string',
        ]);

        PriceRange::create([
            'name' => $request->name,
            'description' => $request->description,
            'deleted' => 0,
        ]);

        return redirect()->route('admin.price_range.index')->with('message', 'Price Range Added Successfully');
    }

    public function edit($id)
    {
        $range = PriceRange::findOrFail($id);

        return view('admin.price_range.edit', compact('range'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:191',
            'description' => 'nullable|string',
        ]);

        $range = PriceRange::findOrFail($id);
        $range->update($request->all());

        return redirect()->route('admin.price_range.index')->with('message', 'Price Range Updated Successfully');
    }

    public function destroy($id)
    {
        // جلب الـ price range بناءً على الـ ID
        $range = PriceRange::findOrFail($id);
    
        // تحديث الحقل `deleted` ليصبح 1 (محذوف)
        $range->update(['deleted' => 1]);
    
        // إعادة التوجيه مع رسالة تأكيد
        return redirect()->route('admin.price_range.index')->with('message', 'Price Range Deleted Successfully');
    }
    
}
