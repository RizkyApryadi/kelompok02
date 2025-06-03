<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto" action="">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
        </ul>
    </form>
    <ul class="navbar-nav navbar-right">
        <!-- Messages Dropdown -->
        <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user relative" onclick="markMessagesAsRead()">
                <i class="fas fa-envelope"></i>
                @if ($unreadCount > 0)
                    <span id="unread-count" class="badge badge-danger badge-pill absolute top-1 right-1">
                        {{ $unreadCount }}
                    </span>
                @endif
            </a>
            <div class="dropdown-menu dropdown-menu-right w-[28rem] max-w-[28rem] p-2">
                <div class="dropdown-title font-semibold text-lg">Messages</div>
                <!-- Display success or error messages -->
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show m-2 p-2 text-sm" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show m-2 p-2 text-sm" role="alert">
                        {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                @endif

                <!-- Messages List -->
                <div class="dropdown-item max-h-72 overflow-y-auto">
                    <ul class="list-group space-y-2">
                        @forelse($messages as $message)
                            <li class="list-group-item p-3 {{ $message->sender_id === Auth::id() ? 'bg-gray-100' : 'bg-white' }} rounded-lg">
                                <div class="flex flex-col gap-2 w-full">
                                    <!-- Message Content -->
                                    <div class="{{ $message->sender_id === Auth::id() ? 'text-right' : 'text-left' }}">
                                        <small class="text-gray-500 block text-xs">{{ $message->created_at->diffForHumans() }}</small>
                                        <div class="text-sm">
                                            <strong>{{ $message->sender->name }}</strong> to <strong>{{ $message->receiver->name }}</strong>: 
                                            <span class="break-words line-clamp-2">{{ $message->message }}</span>
                                        </div>
                                    </div>
                                    <!-- Delete Button -->
                                    @if ($message->sender_id === Auth::id())
                                        <div class="{{ $message->sender_id === Auth::id() ? 'text-right' : 'text-left' }}">
                                            <form action="{{ route('message.delete', $message->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm px-3 py-1 text-xs rounded hover:bg-red-600 focus:outline-none" onclick="return confirm('Are you sure you want to delete this message?')">Delete</button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </li>
                        @empty
                            <li class="list-group-item p-2">No messages yet.</li>
                        @endforelse
                    </ul>
                </div>

                <!-- Send Message Form -->
                <div class="dropdown-divider my-2"></div>
                <div class="dropdown-item p-2">
                    <h6 class="font-semibold text-base">Send Message</h6>
                    <form action="{{ route('message.send') }}" method="POST" class="space-y-2">
                        @csrf
                        <div class="form-group">
                            <select name="receiver_id" class="form-control form-control-sm w-full p-2 border rounded">
                                <option value="">Select User</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->roles }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <textarea name="message" class="form-control form-control-sm w-full p-2 border rounded" placeholder="Type your message" rows="2" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-full p-2 rounded text-white">Send</button>
                    </form>
                </div>
            </div>
        </li>

        <!-- User Dropdown -->
        <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <div class="d-sm-none d-lg-inline-block">Hi, {{ auth()->user()->name }}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-title">Halo, {{ Auth::user()->name }}</div>
                <a href="{{ route('profile') }}" class="dropdown-item has-icon">
                    <i class="far fa-user"></i> Pengaturan Profil
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="nav-icon fas fa-sign-out-alt"></i>   Log Out
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</nav>

<!-- JavaScript for marking messages as read -->
<script>
    function markMessagesAsRead() {
        fetch('{{ route("message.markAsRead") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({})
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const badge = document.getElementById('unread-count');
                if (badge) {
                    badge.style.display = 'none';
                }
            }
        })
        .catch(error => console.error('Error marking messages as read:', error));
    }
</script>