<!-- Header -->
<div class="header-container">
    <header class="text-white py-4">
        <div class="container mx-auto flex items-center justify-between px-4">
            <a href="/" class="text-2xl font-bold">LIMOWIDE</a>
            <nav>
                <ul class="flex items-center space-x-8">
                    <li><a href="/" class="hover:text-gray-300">Home</a></li>
                    <li><a href="/about" class="hover:text-gray-300">About us</a></li>
                    <li><a href="/services" class="hover:text-gray-300">Services</a></li>

                    @guest
                        <li><a href="/register" class="hover:text-gray-300">Register</a></li>
                        <li>
                            <a href="/login">
                                <button class="text-black px-6 py-2 rounded-full hover:bg-yellow-600" style="background-color:#FFD476">
                                    Sign In
                                </button>
                            </a>
                        </li>
                    @endguest

                    @auth
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="text-black px-6 py-2 rounded-full hover:bg-red-600" style="background-color:#FFD476">
                                    Log Out
                                </button>
                            </form>
                        </li>
                    @endauth
                </ul>
            </nav>
        </div>
    </header>
</div>
