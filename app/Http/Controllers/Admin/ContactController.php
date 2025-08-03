<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $query = Contact::query();

        if ($request->has('type') && $request->type !== 'all') {
            $query->where('type', $request->type);
        }

        if ($request->has('status')) {
            if ($request->status === 'read') {
                $query->where('is_read', true);
            } elseif ($request->status === 'unread') {
                $query->where('is_read', false);
            }
        }

        $contacts = $query->latest()->paginate(15);

        return view('admin.contacts.index', compact('contacts'));
    }

    public function show(Contact $contact)
    {
        $contact->markAsRead();
        return view('admin.contacts.show', compact('contact'));
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()->route('admin.contacts.index')
                        ->with('success', 'Contact supprimé avec succès.');
    }

    public function markAsReplied(Contact $contact)
    {
        $contact->update([
            'replied_at' => now(),
            'is_read' => true
        ]);

        return redirect()->back()->with('success', 'Message marqué comme répondu.');
    }

    public function markAsRead(Contact $contact)
    {
        $contact->markAsRead();

        return redirect()->back()
                        ->with('success', 'Contact marqué comme lu.');
    }
}
