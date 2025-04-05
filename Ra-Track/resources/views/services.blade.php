<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Travel Agencies - LimoWide Partnership</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  
</head>

<body class="bg-gray-50">
  <!-- Navigation -->
  <div class="hero-section text-white h-screen">

    @include('layouts.header')
    <!-- Hero Content -->
    <div class="container mx-auto px-6 py-32 text-center">
      <h1 class="text-4xl md:text-5xl font-bold mb-4">
        <span class="text-white">TRAVEL</span>
        <span class="text-yellow-500">AGENCIES</span>
      </h1>
      <p class="text-lg max-w-2xl mx-auto mb-8">
        Choose your travel experience and let your customers enjoy premium chauffeur services worldwide
      </p>
    </div>
    <div class="attribution">
      Photo by <a
        href="https://unsplash.com/@jrkorpa?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">jr
        Korpa</a> on <a
        href="https://unsplash.com/photos/a-view-of-a-city-at-night-from-a-mountain-top-91e8fad9978e?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">Unsplash</a>
    </div>
  </div>

  <div class="container">
    <div class="main-wrapper">

      <!-- direction -->
      <section class="featured-posts">
        <div class="featured-posts-container">
          <div class="main-post">
            <img
              src="https://storage.googleapis.com/jpn-new-wp/uploads/2021/08/ae67a5a6-image_kyoto.jpg"
              alt="Tokyo Tales" />
            <div class="post-content">
              <div class="post-category">Travel</div>
              <h2 class="post-title">Tokyo Tales: A Journey through Tradition and Innovation</h2>
              <p class="post-description">
                Explore over a million flight options with our comprehensive search
                tool, offering endless possibilities for your next adventure.
                Explore over a million flight options with our comprehensive
                search tool, offering endless possibil....
              </p>
              <p class="post-author">by Limowide • Nov 20, 2023</p>
              <a href="#" class="read-more">Read More >></a>
            </div>
          </div>

          <div class="right-column">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Featured Posts</h2>
            <div class="featured-posts-grid">

              <div>
                <img
                  src="https://hips.hearstapps.com/hmg-prod/images/passenger-airplane-landing-at-dusk-royalty-free-image-1569607365.jpg"
                  alt="Airport Transfer" />
                <div class="post-content">
                  <div class="post-category">Transportation</div>
                  <h3 class="post-title">
                    Arrive in Style: Luxury Airport Transfer Experiences
                  </h3>
                  <p class="post-date">Nov 20, 2023</p>
                </div>
              </div>

              <div>
                <img
                  src="https://www.shutterstock.com/image-illustration/business-people-traveling-airplane-airport-260nw-321885935.jpg"
                  alt="Machu Picchu" />
                <div class="post-content">
                  <div class="post-category">Travel</div>
                  <h3 class="post-title">Machu Picchu Marvels: Exploring Ancient Inca Ruins</h3>
                  <p class="post-date">Nov 20, 2023</p>
                </div>
              </div>

              <div>
                <img
                  src="https://www.igms.com/content/images/size/w2000/wordpress/2023/07/shutterstock_1017866470-scaled.jpg"
                  alt="Booking Flights" />
                <div class="post-content">
                  <div class="post-category">Booking</div>
                  <h3 class="post-title">Skyward Journeys: Insider Tips for Booking Flights</h3>
                  <p class="post-date">Nov 20, 2023</p>
                </div>
              </div>


            </div>
          </div>
        </div>
      </section>
    
      <!-- Tag & Catégories -->
      <section class="top-section">

        <div class="nature-travel-wrapper mx-10">
          <div class="post-grid-item">
            <img
              src="https://storage.googleapis.com/bd-app-dev-375714.appspot.com/itineraries/0191f77d-dadd-7fbb-ab86-e964830c04f0/location729.jpg"
              alt="Bali Bliss">
            <div class="post-content">
              <div class="post-category">Nature</div>
              <h3 class="post-title">Bali Bliss: Serenity Amidst Rice Terraces and Waterfalls</h3>
              <p class="post-description">Explore over a million flight options with our comprehensive search...</p>
              <p class="post-author">by Limowide • Nov 20, 2023</p>
              <a href="#" class="read-more">Read More >></a>

            </div>
          </div>
          <div class="post-grid-item">
            <img
              src="https://www.the-travel-bunny.com/wp-content/uploads/2021/05/best-flight-infographic.jpg"
              alt="Skyward Journeys">
            <div class="post-content">
              <div class="post-category">Travel</div>
              <h3 class="post-title">Skyward Journeys: Insider Tips for Booking Flights</h3>
              <p class="post-description">Explore over a million flight options with our comprehensive search...</p>
              <p class="post-author">by Limowide • Nov 20, 2023</p>
              <a href="#" class="read-more">Read More >></a>
            </div>
          </div>
        </div>


        <div class="category-tags-container w-[400px]">
          <div class="categories ">
            <h2>Categories</h2>
            <ul>
              <li><a href="#">Travel</a> <span class="count">(08)</span></li>
              <li><a href="#">Transportation</a> <span class="count">(09)</span></li>
              <li><a href="#">Booking</a> <span class="count">(05)</span></li>
              <li><a href="#">Travel Guide</a> <span class="count">(02)</span></li>
              <li><a href="#">Airport Transfer</a> <span class="count">(12)</span></li>
              <li><a href="#">Flight</a> <span class="count">(03)</span></li>
              <li><a href="#">Nature</a> <span class="count">(10)</span></li>
            </ul>
          </div>

          <div class="popular-tags">
            <h2>Popular Tags</h2>
            <div class="tags">
              <a href="#" class="tag">blog</a>
              <a href="#" class="tag">hotel</a>
              <a href="#" class="tag">tourism</a>
              <a href="#" class="tag">booking</a>
              <a href="#" class="tag">event</a>
              <a href="#" class="tag">summer</a>
              <a href="#" class="tag">winter</a>
              <a href="#" class="tag">travel</a>
              <a href="#" class="tag">fun</a>
              <a href="#" class="tag">flight</a>
              <a href="#" class="tag">ticket</a>
              <a href="#" class="tag">discount</a>
            </div>
          </div>
        </div>
      </section>
      

    </div>
  </div>

 

</body>

</html>