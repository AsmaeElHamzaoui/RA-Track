<!-- Header -->
<div class="header-container "> 
    <header class="text-white py-4 relative"> <!-- Ajout de relative -->
        <div class="container mx-auto flex items-center justify-between px-4">
            <a href="/" ><img class="h-10 w-32" src="{{ asset('images/logo.png') }}" alt=""></a>

            <!-- Desktop Navigation -->
            <nav id="desktop-nav" class="hidden md:block">
                <ul class="flex items-center space-x-6 lg:space-x-8"> <!-- Espace réduit pour les écrans moyens -->
                    <li><a href="/" class="hover:text-gray-300">Home</a></li>
                    <li><a href="/about" class="hover:text-gray-300">About us</a></li>
                    <li><a href="/services" class="hover:text-gray-300">Services</a></li>

                    @guest
                        <li><a href="/register" class="hover:text-gray-300">Register</a></li>
                        <li>
                            <a href="/login">
                                <button class="text-black px-6 py-2 rounded-full hover:bg-yellow-600" style="color: #162238; border: 1px solid #FFD476;background: #FFD476;
                                    box-shadow: -5px -5px 15px rgba(255, 255, 255, 0.1),
                                    5px 5px 15px rgba(0, 0, 0, 0.35),
                                    inset -5px -5px 15px rgba(255, 255, 255, 0.1),
                                    inset 5px 5px 15px rgba(0, 0, 0, 0.35);">
                                    Sign In
                                </button>
                            </a>
                        </li>
                    @endguest

                    @auth
                        <li><a href="/myreservations" class="hover:text-gray-300">Reservations</a></li>
                        <li>
                            <form method="POST" action="/logout">
                                @csrf
                                <button type="submit" class="text-black px-6 py-2 rounded-full hover:bg-red-600" style="color: #162238; border: 1px solid #FFD476;background: #FFD476;
                                    box-shadow: -5px -5px 15px rgba(255, 255, 255, 0.1),
                                    5px 5px 15px rgba(0, 0, 0, 0.35),
                                    inset -5px -5px 15px rgba(255, 255, 255, 0.1),
                                    inset 5px 5px 15px rgba(0, 0, 0, 0.35);">
                                    Log Out
                                </button>
                            </form>
                        </li>
                    @endauth
                </ul>
            </nav>

            <!-- Burger Button -->
            <button id="burger-button" class="md:hidden focus:outline-none">
                <svg class="w-6 h-6 text-white" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                    <path d="M4 6h16M4 12h16m-7 6h7"></path>
                 </svg>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-gray-800 absolute top-full left-0 w-full z-20">
             <ul class="flex flex-col items-center space-y-4 py-4">
                 <li><a href="/" class="block py-2 px-4 hover:text-gray-300 hover:bg-gray-700 rounded">Home</a></li>
                 <li><a href="/about" class="block py-2 px-4 hover:text-gray-300 hover:bg-gray-700 rounded">About us</a></li>
                 <li><a href="/services" class="block py-2 px-4 hover:text-gray-300 hover:bg-gray-700 rounded">Services</a></li>

                 @guest
                     <li><a href="/register" class="block py-2 px-4 hover:text-gray-300 hover:bg-gray-700 rounded">Register</a></li>
                     <li>
                         <a href="/login">
                             <button class="text-black px-6 py-2 rounded-full hover:bg-yellow-600 w-full mt-2" style="background-color:#FFD476">
                                 Sign In
                             </button>
                         </a>
                     </li>
                 @endguest

                 @auth
                     <li><a href="/myreservations" class="block py-2 px-4 hover:text-gray-300 hover:bg-gray-700 rounded">Reservations</a></li>
                     <li>
                         <form method="POST" action="/logout" class="w-full px-4">
                             @csrf
                             <button type="submit" class="text-black px-6 py-2 rounded-full hover:bg-red-600 w-full mt-2" style="background-color:#FFD476">
                                 Log Out
                             </button>
                         </form>
                     </li>
                 @endauth
             </ul>
        </div>
    </header>
</div>

<!-- Script pour le Burger Menu -->
<script>
    const burgerButton = document.getElementById('burger-button');
    const mobileMenu = document.getElementById('mobile-menu');

    burgerButton.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });
</script>