<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::latest()->paginate(20);
        $newCount = ContactMessage::where('status', 'new')->count();
        
        return view('layouts.admin.contacts.index', compact('messages', 'newCount'));
    }

    public function show($id)
    {
        $message = ContactMessage::findOrFail($id);
        
        // Mark as read
        if ($message->status === 'new') {
            $message->update(['status' => 'read']);
        }
        
        return view('layouts.admin.contacts.show', compact('message'));
    }

    public function destroy($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->delete();
        
        return redirect()->route('admin.contacts.index')->with('success', 'Message deleted successfully');
    }
}