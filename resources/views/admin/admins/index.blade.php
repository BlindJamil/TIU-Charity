@extends('admin.layout')

@section('title', 'Manage Admins')

@section('content')
<div class="py-6 sm:py-12 bg-gray-900 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-4 sm:p-6 text-white">
                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6 space-y-4 sm:space-y-0">
                    <h1 class="text-xl sm:text-2xl font-bold">Manage Admin Users</h1>
                    <a href="{{ route('admin.admins.create') }}" class="w-full sm:w-auto text-center bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md transition">
                        + Add New Admin
                    </a>
                </div>

                @if(session('success'))
                    <div class="bg-green-900 text-green-200 p-4 mb-6 rounded-md shadow-md flex items-center">
                        <svg class="h-5 w-5 mr-3 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                        <span class="text-sm">{{ session('success') }}</span>
                    </div>
                @endif
                 @if(session('error'))
                    <div class="bg-red-900 text-red-200 p-4 mb-6 rounded-md shadow-md flex items-center">
                         <svg class="h-5 w-5 mr-3 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" /></svg>
                        <span class="text-sm">{{ session('error') }}</span>
                    </div>
                @endif
                 @if(session('warning'))
                     <div class="bg-yellow-900 text-yellow-200 p-4 mb-6 rounded-md shadow-md flex items-center">
                          <svg class="h-5 w-5 mr-3 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M8.485 3.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 3.495zM10 6a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 6zm0 9a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" /></svg>
                          <span class="text-sm">{{ session('warning') }}</span>
                     </div>
                 @endif

                <!-- Mobile Cards View -->
                <div class="block lg:hidden space-y-4">
                    @forelse($admins as $admin)
                        <div class="bg-gray-700 rounded-lg shadow border border-gray-600 overflow-hidden">
                            <div class="p-4">
                                <div class="flex items-start justify-between mb-3">
                                    <div class="flex-1">
                                        <h3 class="text-lg font-medium text-white">{{ $admin->name }}</h3>
                                        <p class="text-sm text-gray-400">{{ $admin->email }}</p>
                                        <p class="text-xs text-gray-500 mt-1">Created: {{ $admin->created_at->format('M d, Y') }}</p>
                                    </div>
                                </div>
                                
                                <div class="mb-4">
                                    <p class="text-sm text-gray-400 mb-2">Roles:</p>
                                    @php $roles = $admin->roles; @endphp
                                    @if($roles->count() > 0)
                                        <div class="flex flex-wrap gap-1">
                                            <span class="inline-block bg-blue-900 text-blue-200 px-2 py-1 rounded-full text-xs">
                                                {{ $roles[0]->display_name }}
                                            </span>
                                            @if($roles->count() > 1)
                                                <span class="inline-block bg-gray-600 text-gray-300 px-2 py-1 rounded-full text-xs">+{{ $roles->count() - 1 }} more</span>
                                            @endif
                                        </div>
                                    @else
                                        <span class="text-gray-500 italic text-sm">No roles assigned</span>
                                    @endif
                                </div>
                                
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.admins.edit', $admin->id) }}" class="flex-1 text-center bg-yellow-600 hover:bg-yellow-700 text-white px-3 py-2 rounded text-sm transition">
                                        Edit
                                    </a>
                                    @if(auth('admin')->id() !== $admin->id)
                                        <form action="{{ route('admin.admins.destroy', $admin->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this admin user?');" class="flex-1">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded text-sm transition">
                                                Delete
                                            </button>
                                        </form>
                                    @else
                                        <button disabled class="flex-1 bg-gray-600 text-gray-400 px-3 py-2 rounded text-sm cursor-not-allowed opacity-50">
                                            Cannot Delete Self
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="bg-gray-700 rounded-lg p-6 text-center">
                            <p class="text-gray-400 mb-2">No admin users found.</p>
                            <a href="{{ route('admin.admins.create') }}" class="text-yellow-500 hover:text-yellow-300 font-medium">Add one now</a>.
                        </div>
                    @endforelse
                </div>

                <!-- Desktop Table View -->
                <div class="hidden lg:block bg-gray-700 rounded-lg shadow overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-600">
                            <thead class="bg-gray-800">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Roles</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Created At</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-gray-700 divide-y divide-gray-600">
                                @forelse($admins as $admin)
                                    <tr class="hover:bg-gray-650 transition">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-white">{{ $admin->name }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-300">{{ $admin->email }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                            @php $roles = $admin->roles; @endphp
                                            @if($roles->count() > 0)
                                                <span class="inline-block bg-blue-900 text-blue-200 px-2 py-0.5 rounded-full text-xs mr-1">
                                                    {{ $roles[0]->display_name }}
                                                </span>
                                                @if($roles->count() > 1)
                                                    <span class="inline-block bg-gray-700 text-gray-300 px-2 py-0.5 rounded-full text-xs">+{{ $roles->count() - 1 }} more</span>
                                                @endif
                                            @else
                                                <span class="text-gray-500 italic">No roles</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-400">{{ $admin->created_at->format('Y-m-d') }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex items-center space-x-3">
                                                <a href="{{ route('admin.admins.edit', $admin->id) }}" class="text-yellow-400 hover:text-yellow-300" title="Edit">
                                                     <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" /><path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" /></svg>
                                                </a>
                                                @if(auth('admin')->id() !== $admin->id)
                                                    <form action="{{ route('admin.admins.destroy', $admin->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this admin user?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-400 hover:text-red-300" title="Delete">
                                                             <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" /></svg>
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-12 text-center text-sm text-gray-400">
                                            No admin users found. <a href="{{ route('admin.admins.create') }}" class="text-yellow-500 hover:text-yellow-300 font-medium">Add one now</a>.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mt-6">
                    {{ $admins->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection