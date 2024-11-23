<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        // البحث
        $search = $request->get('search');
        
        $contacts = Contact::when($search, function($query, $search) {
                return $query->where('contact_email', 'like', "%{$search}%")
                             ->orWhere('message', 'like', "%{$search}%");
            })
            ->where('deleted', 0) // تأكد من أنك تعرض السطور التي لم تُحذف فقط

            ->orderBy('id', 'desc') // ترتيب من الأقدم إلى الأحدث

            ->paginate(10);


        return view('admin.contacts.index', compact('contacts'));

            $contacts = Contact::where('deleted', 0)->get();
    
    
    
    return view('admin.contacts.index', compact('contacts'));

    }

    public function show($id)
    {
        $contact = Contact::findOrFail($id);

        return view('admin.contacts.show', compact('contact'));
    }
    public function markAsRead($id)
{
    $contact = Contact::findOrFail($id);
    $contact->update(['is_read' => 1, 'read_at' => now()]);
    return redirect()->route('admin.contacts.index')->with('message', 'Message marked as read.');
}

public function destroy($id)
{
    // جلب السطر بناءً على الـ ID
    $contact = Contact::findOrFail($id);

    // تحديث الحقل `deleted` ليصبح 1
    $contact->update(['deleted' => 1]);

    // إرسال رسالة تنبيه بعد الحذف
    return redirect()->route('admin.contacts.index')->with('message', 'Contact has been deleted successfully.');
}




}
