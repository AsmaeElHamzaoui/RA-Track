<footer class="text-gray-300 py-4 md:py-6" style="border-radius:20px 20px 0 0; background-color:#162238;">
    <div class="container mx-auto px-4">
        <!-- Logo & Socials Row (reste inchangé pour la visibilité, juste la disposition change) -->
        <div class="flex flex-col md:flex-row items-center justify-between mx-4 md:mx-8 lg:mx-12 mb-2 md:mb-2 space-y-6 md:space-y-0">
            <a href="/">
                <img src="/placeholder.svg?height=60&width=225" alt="LimoWide Logo" class="h-10 md:h-12">
            </a>
            <div class="flex space-x-4">
                <a href="#" class="hover:text-white" style="color:#FFD476"><i class="fab fa-linkedin-in text-xl"></i></a>
                <a href="#" class="hover:text-white" style="color:#FFD476"><i class="fab fa-twitter text-xl"></i></a>
                <a href="#" class="hover:text-white" style="color:#FFD476"><i class="fab fa-facebook-f text-xl"></i></a>
                <a href="#" class="hover:text-white" style="color:#FFD476"><i class="fab fa-pinterest text-xl"></i></a>
                <a href="#" class="hover:text-white" style="color:#FFD476"><i class="fab fa-whatsapp text-xl"></i></a>
            </div>
        </div>

        <!-- Grid principale - Mise à jour avec visibilité conditionnelle -->
        <!-- grid-cols-1 (Mobile) -> md:grid-cols-2 (Tablet) -> lg:grid-cols-6 (Desktop) -->
        <div class="grid grid-cols-1 mx-20 md:grid-cols-2 lg:grid-cols-6  gap-4 md:gap-6 lg:gap-8 mb-2 md:mb-10 px-4 md:px-0">

            <!-- Company: Visible seulement sur lg et plus -->
            <div class="hidden lg:block text-center md:text-left">
                <h4 class="font-semibold mb-3 text-base" style="color:#FFD476;">COMPANY</h4>
                <ul class="space-y-2">
                    <li><a href="#" class="hover:text-white text-xs">How it works</a></li>
                    <li><a href="#" class="hover:text-white text-xs">Newsletter</a></li>
                    <li><a href="#" class="hover:text-white text-xs">Careers</a></li>
                    <li><a href="#" class="hover:text-white text-xs">Investors</a></li>
                    <li><a href="#" class="hover:text-white text-xs">Blogs</a></li>
                    <li><a href="#" class="hover:text-white text-xs">Destinations</a></li>
                </ul>
            </div>

            <!-- Services: Visible sur md et plus -->
            <div class="hidden md:block text-center md:text-left">
                <h4 class="font-semibold mb-3 text-base" style="color:#FFD476;">SERVICES</h4>
                <ul class="space-y-2">
                    <li><a href="#" class="hover:text-white text-xs">Airport Transfer</a></li>
                    <li><a href="#" class="hover:text-white text-xs">Limousine Service</a></li>
                    <li><a href="#" class="hover:text-white text-xs">Private Taxi</a></li>
                    <li><a href="#" class="hover:text-white text-xs">Chauffeur Service</a></li>
                    <li><a href="#" class="hover:text-white text-xs">City tour</a></li>
                </ul>
            </div>

            <!-- Contact: Visible sur toutes les tailles -->
            <div class="block text-center md:text-left"> <!-- 'block' est implicite mais peut être mis pour la clarté -->
                <h4 class="font-semibold mb-3 text-base" style="color:#FFD476;">CONTACT</h4>
                <ul class="space-y-2">
                    <li class="text-xs leading-relaxed">Address: 1 Peach Place, <br>Wokingham, RG40 1LY,<br> UK</li>
                    <li class="text-xs">Phone: +44 7458 148595</li>
                    <li class="text-xs">Email: support@limowide.com</li>
                </ul>
            </div>

            <!-- Partnership: Visible seulement sur lg et plus -->
            <div class="hidden lg:block text-center md:text-left">
                <h4 class="font-semibold mb-3 text-base" style="color:#FFD476;">PARTNERSHIP</h4>
                <ul class="space-y-2">
                    <li><a href="#" class="hover:text-white text-xs">Business Solutions</a></li>
                    <li><a href="#" class="hover:text-white text-xs">Travel Agencies</a></li>
                    <li><a href="#" class="hover:text-white text-xs">Affiliate & Webmasters</a></li>
                    <li><a href="#" class="hover:text-white text-xs">Drive with Us</a></li>
                    <li><a href="#" class="hover:text-white text-xs">Become A Partner</a></li>
                    <li><a href="#" class="hover:text-white text-xs">Register as Guide</a></li>
                </ul>
            </div>

            <!-- Legal: Visible seulement sur lg et plus -->
            <div class="hidden lg:block text-center md:text-left">
                <h4 class="font-semibold mb-3 text-base" style="color:#FFD476;">LEGAL</h4>
                <ul class="space-y-2">
                    <li><a href="#" class="hover:text-white text-xs">Privacy Policy</a></li>
                    <li><a href="#" class="hover:text-white text-xs">Terms & Conditions</a></li>
                    <li><a href="#" class="hover:text-white text-xs">Cookie Policy</a></li>
                </ul>
            </div>

            <!-- Help: Visible seulement sur lg et plus -->
            <div class="hidden lg:block text-center md:text-left">
                <h4 class="font-semibold mb-3 text-base" style="color:#FFD476;">HELP</h4>
                <ul class="space-y-2">
                    <li><a href="#" class="hover:text-white text-xs">Help Center</a></li>
                    <li><a href="#" class="hover:text-white text-xs">Get Support</a></li>
                </ul>
            </div>
        </div>

        <!-- Copyright & Payment Methods (reste inchangé pour la visibilité) -->
        <div class="flex flex-col md:flex-row items-center justify-between mx-4 mt-6 border-t border-gray-700 pt-4 space-y-4 md:space-y-0">
            <p class="text-xs text-center md:text-left">© 2024 Limowide. All rights reserved</p>
            <div class="flex items-center space-x-3">
                <img class="h-3 w-auto" src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2a/Mastercard-logo.svg/1280px-Mastercard-logo.svg.png" alt="Mastercard">
                <img class="h-3 w-auto" src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5e/Visa_Inc._logo.svg/1280px-Visa_Inc._logo.svg.png" alt="Visa">
                <img class="h-3 w-auto" src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b5/PayPal.svg/1280px-PayPal.svg.png" alt="PayPal">
                <img class="h-3 w-auto" src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/f2/American_Express_logo_%282018%29.svg/1280px-American_Express_logo_%282018%29.svg.png" alt="American Express">
            </div>
        </div>
    </div>
</footer>