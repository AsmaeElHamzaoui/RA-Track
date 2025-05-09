<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Agencies - LimoWide Partnership</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
        }

        .hero-section {
            /* L'image de fond et les styles associés restent les mêmes */
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://images.unsplash.com/photo-1493246507139-91e8fad9978e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80');
            background-size: cover;
            background-position: center;
            position: relative;
            /* Needed for absolute positioning of the attribution */
            /* La hauteur est maintenant gérée par les classes Tailwind ci-dessous */
        }

        .hero-section .attribution {
            position: absolute;
            bottom: 10px;
            right: 10px;
            color: white;
            font-size: 0.8rem;
            opacity: 0.7;
        }

        .hero-section .attribution a {
            color: white;
            text-decoration: none;
            /* Optional: Remove underline from the link */
        }

        .benefit-image {
            transform: rotate(3deg);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .benefit-number {
            font-weight: 700;
            color: #1a202c;
        }

        .polaroid {
            background: #fff;
            padding: 0.5rem;
            /* Reduced padding */
            box-shadow: 0 0.2rem 0.6rem rgba(0, 0, 0, 0.1);
            text-align: center;
            margin-bottom: 1rem;
            /* Added margin */
        }

        .polaroid.rotate-right {
            transform: rotate(3deg);
        }

        .polaroid.rotate-left {
            transform: rotate(-3deg);
        }

        .polaroid img {
            border: 0.2rem solid white;
            /* Reduced border size */
            border-bottom: none;
            display: block;
        }

        .polaroid p {
            margin-top: 0.5rem;
            font-family: 'Shadows Into Light', cursive;
            font-size: 1.2rem;
        }

        @media (max-width: 1024px) {

            #img3,
            #text03,
            #text04 {
                display: none;
            }
        }

        @media (max-width: 1090px) {
            .hero-section {
                max-height: 500px;
            }
        }

        @media (max-width: 767px) {

            #img2,
            #img1 {
                display: none;
            }

            #text03,
            #text04 {
                display: flex;
            }
        }
    </style>
</head>

<body class="bg-gray-50">

    <!-- Navigation -->
    <!-- MODIFICATION ICI: Remplacement de h-screen par h-[70vh] md:h-screen -->
    <div class="hero-section text-white h-[70vh] md:h-screen">

        @include('layouts.header')
        <!-- Hero Content -->
        <div class="container mx-auto px-6 py-32 text-center flex flex-col justify-center items-center h-full">
            <div>
                <h1 class="text-4xl md:text-5xl font-bold mb-4">
                    <span class="text-white">TRAVEL</span>
                    <span class="text-yellow-500">AGENCIES</span>
                </h1>
                <p class="text-lg max-w-2xl mx-auto mb-8">
                    Choose your travel experience and let your customers enjoy premium chauffeur services worldwide
                </p>
            </div>
        </div>
        <div class="attribution">
            Photo by <a href="https://unsplash.com/@jrkorpa?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">jr Korpa</a> on <a href="https://unsplash.com/photos/a-view-of-a-city-at-night-from-a-mountain-top-91e8fad9978e?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">Unsplash</a>
        </div>
    </div>

    <!-- Main Content -->
    <main class="container mx-auto px-6 py-12" style="background-color:#F1F0E9;">

        <!-- Benefits Section -->
        <section class="mb-16">
            <h2 class="text-3xl font-bold text-center mb-2" style="color:#162238;">
                BENEFITS OF PARTNERING WITH<br>
                LIMOWIDE FOR TRAVEL AGENCIES
            </h2>
            <p class="text-center text-gray-600 max-w-3xl mx-auto mb-16">
                Travel agencies rely on partnerships to be successful in today's fast-paced world. A partnership with LimoWide can enhance your service offerings significantly. Here are the key benefits of partnering with us:
            </p>

            <!-- Benefits Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-10">
                <!-- Left Column -->
                <div class="space-y-6 mx-4">
                    <!-- Benefit 1 -->
                    <div class="flex">
                        <div class="mr-6">
                            <span class="benefit-number text-2xl font-bold" style="color:#162238;">01</span>
                        </div>
                        <div>
                            <h3 class="text-2xl font-semibold mb-2" style="color:#162238;">B2B Account Management</h3>
                            <p class="text-gray-600">
                                Establishing a B2B account with LimoWide allows travel agencies to manage their bookings efficiently. Our dedicated account managers ensure you receive the support you need to provide outstanding service to your clients.
                            </p>
                        </div>
                    </div>

                    <!-- Benefit 2 -->
                    <div class="flex">
                        <div class="mr-6">
                            <span class="benefit-number text-2xl font-bold" style="color:#162238;">02</span>
                        </div>
                        <div>
                            <h3 class="text-2xl font-semibold mb-2" style="color:#162238;">Flexible Invoice Options</h3>
                            <p class="text-gray-600">
                                We understand that travel agencies have different financial requirements. Our selection of invoice options can be tailored to your specific business needs, including payment receipt management and easy tracking.
                            </p>
                        </div>
                    </div>

                    <!-- Benefit 3 -->
                    <div class="flex" id="text03">
                        <div class="mr-6">
                            <span class="benefit-number text-2xl font-bold" style="color:#162238;">03</span>
                        </div>
                        <div>
                            <h3 class="text-2xl font-semibold mb-2" style="color:#162238;">Customer Vouchers</h3>
                            <p class="text-gray-600">
                                Provide your customers with easy-to-use vouchers and clear instructions enhancing the booking experience. These vouchers can be customized with your branding, making them a valuable tool for promotions and special offers.
                            </p>
                        </div>
                    </div>

                    <!-- Benefit 4 -->
                    <div class="flex" id="text04">
                        <div class="mr-6">
                            <span class="benefit-number text-2xl font-bold" style="color:#162238;">04</span>
                        </div>
                        <div>
                            <h3 class="text-2xl font-semibold mb-2" style="color:#162238;">Personal Interaction Support</h3>
                            <p class="text-gray-600">
                                Our dedicated support team is available for personal interaction, ensuring quick assistance whenever needed. Travel agencies can contact us directly for urgent needs or inquiries, ensuring that essential requirements are met.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-12 mx-8 relative">
                    <!-- First Image - positioned to align with benefits 2-3 -->
                    <div class="absolute top-24 right-0 w-full max-w-sm" id="img1">
                        <div class="polaroid rotate-right">
                            <img src="https://images.unsplash.com/photo-1506929562872-bb421503ef21?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1368&q=80" alt="Scenic mountain lake view" class="benefit-image rounded-lg w-full h-48 object-cover">
                        </div>
                    </div>

                    <!-- Second Image - positioned to align with benefit 4 -->
                    <div class="absolute top-64 mt-32 right-0 w-full max-w-sm" id="img2">
                        <div class="polaroid rotate-left">
                            <img src="https://images.unsplash.com/photo-1470770841072-f978cf4d019e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Mountain landscape with lake" class="benefit-image rounded-lg w-full h-48 object-cover">
                        </div>
                    </div>

                    <!-- Third Image - positioned to align below -->
                    <div class="absolute top-[75%] mt-[50px] right-0 w-full max-w-sm" id="img3">
                        <div class="polaroid rotate-right">
                            <img src="{{ asset('images/airplan1.jpg') }}" class="benefit-image rounded-lg w-full h-48 object-cover">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Second Row of Benefits -->
            <div class="mt-64 md:mt-32 grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-10">

                <!-- Left Column - Small Gallery -->
                <div class="grid grid-cols-1 gap-6 relative">
                    <div class="polaroid rotate-right">
                        <img src="https://images.unsplash.com/photo-1501785888041-af3ef285b470?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Mountain landscape" class="rounded-lg h-64 w-full object-cover">
                    </div>
                    <div class="polaroid rotate-left">
                        <img src="https://images.unsplash.com/photo-1439853949127-fa647821eba0?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80" alt="Mountain peaks" class="rounded-lg h-64 w-full object-cover">
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-6">

                    <!-- Benefit 5 -->
                    <div class="flex">
                        <div class="mr-6">
                            <span class="benefit-number text-2xl font-bold" style="color:#162238;">05</span>
                        </div>
                        <div>
                            <h3 class="text-2xl font-semibold mb-2" style="color:#162238;">Custom Requirement Quote</h3>
                            <p class="text-gray-600">
                                Every journey is unique, and we understand that some trips require a more tailored approach. Our team immediately attends to each request, even those that fall outside our regular service offerings.
                            </p>
                        </div>
                    </div>

                    <!-- Benefit 6 -->
                    <div class="flex">
                        <div class="mr-6">
                            <span class="benefit-number text-2xl font-bold" style="color:#162238;">06</span>
                        </div>
                        <div>
                            <h3 class="text-2xl font-semibold mb-2" style="color:#162238;">Flexible Booking Amendments and Cancellations</h3>
                            <p class="text-gray-600">
                                We understand that travel plans can change. That's why we offer flexible booking amendment and cancellation policies, allowing you to make changes when necessary. This flexibility enables you to handle customer service requests happily.
                            </p>
                        </div>
                    </div>

                    <!-- Benefit 7 -->
                    <div class="flex">
                        <div class="mr-6">
                            <span class="benefit-number text-2xl font-bold" style="color:#162238;">07</span>
                        </div>
                        <div>
                            <h3 class="text-2xl font-semibold mb-2" style="color:#162238;">Hourly Car Booking and City Tour Options</h3>
                            <p class="text-gray-600">
                                Adding an hourly rate option with the convenience of hourly car bookings and custom city tours. This flexibility allows travelers to explore destinations at their own pace, enhancing their overall experience.
                            </p>
                        </div>
                    </div>

                </div>
            </div>

        </section>

        <!-- Section travel -->
        <section class="py-12">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                <div>
                    <p class="text-gray-700 mb-6">
                        Partnering with LimoWide empowers travel agencies to provide exceptional services to their customers. Our comprehensive booking platform and seamless user experience can enhance their offerings, ultimately giving them the competitive edge they need to succeed.
                    </p>
                    <a href="#" class="inline-block hover:bg-blue-800 px-6 py-3 rounded-full font-small" style="background-color:#162238;color:#FFD476">SEE HOW IT WORKS</a>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="polaroid rotate-right">
                        <img src="https://images.unsplash.com/photo-1464037866556-6812c9d1c72e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="People enjoying travel" class="rounded-lg h-full w-full object-cover">
                    </div>
                    <div class="polaroid rotate-left">
                        <img src="https://images.unsplash.com/photo-1530521954074-e64f6810b32d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Luxury travel experience" class="rounded-lg h-full w-full object-cover">
                    </div>
                </div>
            </div>
        </section>
    </main>
    @include('layouts.footer')

</body>

</html>