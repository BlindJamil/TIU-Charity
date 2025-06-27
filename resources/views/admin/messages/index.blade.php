@extends('admin.layout')

@section('content')
<div class="py-12 bg-gray-900 min-h-screen">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Header section with title and stats -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-white">Contact Messages</h1>
                <p class="mt-1 text-sm text-gray-400">Manage and respond to messages from your contact form</p>
            </div>
            <div class="mt-4 md:mt-0 flex space-x-3">
                @if($unreadCount > 0)
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-500 bg-opacity-20 text-yellow-500">
                    <span class="w-2 h-2 bg-yellow-500 rounded-full mr-2"></span>
                    {{ $unreadCount }} unread
                </span>
                @endif
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-700 text-gray-300">
                    Total: {{ $messages->total() }} messages
                </span>
            </div>
        </div>

        <!-- Messages container -->
        <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden border border-gray-700">
            <!-- Table header -->
            <div class="bg-gray-900 py-3 px-6 border-b border-gray-700">
                <div class="grid grid-cols-12 gap-4 text-xs font-bold text-gray-400 uppercase tracking-wider">
                    <div class="col-span-3 sm:col-span-3">Sender</div>
                    <div class="col-span-5 sm:col-span-5">Subject</div>
                    <div class="col-span-2 hidden sm:block">Date</div>
                    <div class="col-span-4 sm:col-span-2 text-right">Actions</div>
                </div>
            </div>

            <!-- Message rows -->
            <div class="divide-y divide-gray-700">
                @forelse($messages as $message)
                    <div class="hover:bg-gray-700 transition duration-150 {{ $message->read ? '' : 'bg-yellow-900 bg-opacity-10' }}">
                        <!-- Message header -->
                        <div class="grid grid-cols-12 gap-4 py-4 px-6 cursor-pointer message-header" data-id="{{ $message->id }}">
                            <div class="col-span-3 sm:col-span-3">
                                <div class="flex flex-col">
                                    <span class="text-sm font-medium text-white truncate">
                                        @if(!$message->read)
                                            <span class="inline-block w-2 h-2 bg-yellow-500 rounded-full mr-2"></span>
                                        @endif
                                        {{ $message->name }}
                                    </span>
                                    <span class="text-xs text-gray-400 truncate">{{ $message->email }}</span>
                                </div>
                            </div>
                            <div class="col-span-5 sm:col-span-5">
                                <p class="text-sm {{ $message->read ? 'text-white' : 'font-semibold text-white' }} truncate">{{ $message->subject }}</p>
                            </div>
                            <div class="col-span-2 hidden sm:block">
                                <span class="text-xs text-gray-400">{{ $message->created_at->format('M d, Y') }}</span>
                            </div>
                            <div class="col-span-4 sm:col-span-2 text-right">
                                <button type="button" class="inline-flex items-center px-2.5 py-1.5 {{ $message->read ? 'bg-gray-700 text-gray-300' : 'bg-yellow-500 bg-opacity-20 text-yellow-500' }} hover:bg-opacity-50 text-xs font-medium rounded transition view-message" data-id="{{ $message->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                    </svg>
                                    View
                                </button>
                            </div>
                        </div>
                        
                        <!-- Message content (hidden by default) -->
                        <div class="px-6 py-4 hidden message-content" id="message-{{ $message->id }}">
                            <div class="p-5">
                                <div class="mb-4 pb-4 border-b border-gray-700">
                                    <div class="flex justify-between">
                                        <div>
                                            <h3 class="font-medium text-white text-lg">{{ $message->subject }}</h3>
                                            <p class="text-sm text-gray-400">From: {{ $message->name }} <span class="text-gray-500">&lt;{{ $message->email }}&gt;</span></p>
                                        </div>
                                        <div class="text-right">
                                            <span class="text-xs text-gray-400">{{ $message->created_at->format('F d, Y') }}</span>
                                            <p class="text-xs text-gray-500">{{ $message->created_at->format('h:i A') }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-gray-300 whitespace-pre-wrap text-sm">{{ $message->message }}</div>
                                <div class="mt-6 flex justify-end">
                                    <a href="mailto:{{ $message->email }}?subject=Re: {{ $message->subject }}" class="inline-flex items-center px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-black text-sm font-medium rounded-md transition duration-150 ease-in-out">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                                        </svg>
                                        Reply via Email
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="px-6 py-12 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-600 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <h3 class="text-xl font-medium text-gray-400 mb-1">No messages yet</h3>
                        <p class="text-gray-500">When visitors contact you, their messages will appear here.</p>
                    </div>
                @endforelse
            </div>
        </div>
        
        <!-- Pagination -->
        <div class="mt-6">
            {{ $messages->links() }}
        </div>
    </div>
</div>

<!-- CSRF Token for AJAX Requests -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Set up CSRF token for AJAX requests
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Select all view buttons and message headers
        const viewButtons = document.querySelectorAll('.view-message');
        const messageHeaders = document.querySelectorAll('.message-header');
        
        // Function to toggle message content and mark as read
        const toggleMessage = (messageId) => {
            const messageContent = document.getElementById('message-' + messageId);
            const messageRow = messageContent.closest('.hover\\:bg-gray-700');
            const viewButton = messageRow.querySelector('.view-message');
            
            // Check if this message is already open
            const isOpen = !messageContent.classList.contains('hidden');
            
            // If the message is open, just close it and return
            if (isOpen) {
                messageContent.classList.add('hidden');
                return;
            }
            
            // Otherwise, close all messages first
            document.querySelectorAll('.message-content').forEach(content => {
                content.classList.add('hidden');
            });
            
            // Then open the selected message
            if (messageContent) {
                messageContent.classList.remove('hidden');
                
                // Mark message as read via AJAX if not already read and user has manage permission
                @if(auth('admin')->user()->hasPermission('manage_messages'))
                if (viewButton.classList.contains('bg-yellow-500')) {
                    fetch(`/admin/messages/${messageId}/read`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({})
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Update visual indicators
                            viewButton.classList.remove('bg-yellow-500', 'bg-opacity-20', 'text-yellow-500');
                            viewButton.classList.add('bg-gray-700', 'text-gray-300');
                            
                            // Remove yellow background from row
                            messageRow.classList.remove('bg-yellow-900', 'bg-opacity-10');
                            
                            // Remove the yellow dot from the sender name
                            const senderDot = messageRow.querySelector('.bg-yellow-500.rounded-full');
                            if (senderDot) {
                                senderDot.remove();
                            }
                            
                            // Update the unread count in the header
                            const unreadBadge = document.querySelector('.bg-yellow-500.bg-opacity-20.text-yellow-500');
                            if (unreadBadge) {
                                const countText = unreadBadge.textContent.trim();
                                const countMatch = countText.match(/(\d+)\s+unread/);
                                if (countMatch && countMatch[1]) {
                                    const unreadCount = parseInt(countMatch[1]) - 1;
                                    if (unreadCount > 0) {
                                        unreadBadge.innerHTML = `<span class="w-2 h-2 bg-yellow-500 rounded-full mr-2"></span>${unreadCount} unread`;
                                    } else {
                                        unreadBadge.remove();
                                    }
                                }
                            }
                        }
                    })
                    .catch(error => console.error('Error marking message as read:', error));
                }
                @endif
            }
        };
        
        // Add click event to view buttons
        viewButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.stopPropagation(); // Prevent the row click event from triggering
                const messageId = this.getAttribute('data-id');
                toggleMessage(messageId);
            });
        });
        
        // Add click event to message headers (entire row)
        messageHeaders.forEach(header => {
            header.addEventListener('click', function() {
                const messageId = this.getAttribute('data-id');
                toggleMessage(messageId);
            });
        });
    });
</script>
@endsection