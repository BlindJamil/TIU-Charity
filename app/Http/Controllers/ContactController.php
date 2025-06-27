<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display the contact page.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('contact');
    }

    /**
     * Store a newly created contact message in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'privacy' => 'required|accepted',
        ]);

        ContactMessage::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'subject' => $validated['subject'],
            'message' => $validated['message'],
            'privacy_accepted' => true,
            'read' => false,
        ]);

        return redirect()->route('contact')->with('success', 'Your message has been sent successfully! We will get back to you soon.');
    }

    /**
     * Display a listing of the contact messages.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function adminIndex()
    {
        // Get messages with unread first, then most recent
        $messages = ContactMessage::orderBy('read', 'asc')
                                  ->orderBy('created_at', 'desc')
                                  ->paginate(10);
        
        // Count unread messages
        $unreadCount = ContactMessage::where('read', false)->count();
        
        return view('admin.messages.index', compact('messages', 'unreadCount'));
    }
    
    /**
     * Mark a message as read.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function markAsRead($id)
    {
        // Check if user has permission to manage messages (not just view)
        if (!auth('admin')->user()->hasPermission('manage_messages')) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized action. You can only view messages.'
            ], 403);
        }
        
        $message = ContactMessage::findOrFail($id);
        $message->read = true;
        $message->save();
        
        return response()->json(['success' => true]);
    }
}