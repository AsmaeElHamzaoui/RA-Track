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
      background-color: #f3f4f6;
      /* Light Gray background */
    }

    .hero-section {
      background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://images.unsplash.com/photo-1493246507139-91e8fad9978e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80');
      background-size: cover;
      background-position: center;
      position: relative;
      /* Needed for absolute positioning of the attribution */
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

    .featured-posts-container {
      width: 100%;
      max-width: 7xl;
      /* Adjust for larger screens */
      margin-left: auto;
      margin-right: auto;
      padding-left: 1rem;
      padding-right: 1rem;
      display: flex;
      flex-direction: column;
      /* Stack vertically */
      gap: 20px;
    }

    .main-post {
      display: flex;
      flex-direction: column;
      border-radius: 0.5rem;
      overflow: hidden;
      background-color: #fff;
      box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px -1px rgba(0, 0, 0, 0.1);
      /* Added shadow */
      margin-bottom: 0.5rem;
      height: 50%;
    }

    .main-post img {
      width: 100%;
      height: 300px;
      object-fit: cover;
    }

    .main-post .post-content {
      padding: 1rem;
    }

    .main-post .post-category {
      font-size: 0.6rem;
      line-height: 0.8rem;
      font-weight: 500;
      letter-spacing: 0.05em;
      text-transform: uppercase;
      color: #6b7280;
      margin-bottom: 0.3rem;
    }

    .main-post .post-title {
      font-size: 1rem;
      line-height: 1.3rem;
      font-weight: 600;
      color: #111827;
      margin-bottom: 0.2rem;
    }

    .main-post .post-description {
      font-size: 0.75rem;
      line-height: 1rem;
      color: #4b5563;
      margin-bottom: 0.7rem;
    }

    .main-post .post-author {
      font-size: 0.6rem;
      line-height: 0.8rem;
      color: #6b7280;
    }

    .read-more {
      font-size: 0.75rem;
      line-height: 1rem;
      font-weight: 500;
      color: #3b82f6;
      /* Blue accent color */
    }

    .right-column {
      width: 100%;
      /* Full width on smaller screens */
    }

    .featured-posts-grid {
      display: flex;
      flex-direction: column;
      /* Stack vertically by default */
      gap: 1rem;
    }

    .featured-posts-grid>div {
      border-radius: 0.5rem;
      overflow: hidden;
      background-color: #fff;
      box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px -1px rgba(0, 0, 0, 0.1);
      margin-bottom: 0.8rem;
      display: flex;
      /* Image and text side by side */
      align-items: center;
      /* Vertically align items */
      margin-left: 0.5rem;
      /* Add left margin */
      margin-right: 0.5rem;
      /* Add right margin */
    }

    .featured-posts-grid img {
      width: 40%;
      /* Adjust as needed */
      height: auto;
      object-fit: cover;
      border-radius: 0.5rem 0 0 0.5rem;
      /* Round top-left and bottom-left */
    }

    .featured-posts-grid .post-content {
      padding: 0.7rem;
      width: 60%;
      /* Occupy remaining space */
    }

    .featured-posts-grid .post-category {
      font-size: 0.6rem;
      line-height: 0.8rem;
      font-weight: 500;
      letter-spacing: 0.05em;
      text-transform: uppercase;
      color: #6b7280;
      margin-bottom: 0.3rem;
    }

    .featured-posts-grid .post-title {
      font-size: 0.8rem;
      line-height: 1rem;
      font-weight: 600;
      color: #111827;
      margin-bottom: 0.2rem;
    }

    .featured-posts-grid .post-date {
      font-size: 0.6rem;
      line-height: 0.8rem;
      color: #6b7280;
    }

    .featured-posts {
      margin-top: 15px;
    }

    /* Adjustments for screens larger than 768px */
    @media (min-width: 768px) {
      .featured-posts-container {
        flex-direction: row;
        justify-content: space-between;
      }

      .main-post {
        width: 60%;
      }

      .right-column {
        width: 35%;
      }

      .featured-posts-grid {
        display: flex;
        /* Keep as flex for side-by-side */
        flex-direction: column;
      }
    }

    /* Styles for the New Section */
    .post-grid-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      /* Responsive columns */
      gap: 20px;
      /* Adjust as needed */
      margin-top: 20px;
      /* Add space above the grid */
    }

    .post-grid-item {
      background-color: #fff;
      border-radius: 0.5rem;
      overflow: hidden;
      box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px -1px rgba(0, 0, 0, 0.1);
    }

    .post-grid-item img {
      width: 100%;
      height: 200px;
      object-fit: cover;
    }

    .post-grid-item .post-content {
      padding: 1rem;
    }

    .post-grid-item .post-category {
      font-size: 0.7rem;
      color: #6b7280;
      margin-bottom: 0.3rem;
    }

    .post-grid-item .post-title {
      font-size: 1rem;
      font-weight: 600;
      color: #111827;
      margin-bottom: 0.5rem;
    }

    .post-grid-item .post-description {
      font-size: 0.8rem;
      color: #4b5563;
    }

    .post-grid-item .post-author {
      font-size: 0.7rem;
      color: #6b7280;
      margin-top: 0.5rem;
      /* Adjust position */
    }

    .read-more {
      font-size: 0.75rem;
      line-height: 1rem;
      font-weight: 500;
      color: #3b82f6;
      /* Blue accent color */
    }

    .category-tags-container {
      padding: 5px;
      width: 60%;
      background-color: #fff;
      border-radius: 0.5rem;
      box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px -1px rgba(0, 0, 0, 0.1);
    }

    .categories h2,
    .popular-tags h2 {
      font-size: 1.5rem;
      font-weight: 600;
      color: #111827;
      margin-bottom: 1rem;
    }

    .categories ul {
      list-style: none;
      padding: 0;
    }

    .categories li {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 0.5rem 0;
      border-bottom: 1px solid #e5e7eb;
    }

    .categories li:last-child {
      border-bottom: none;
    }

    .categories a {
      color: #374151;
      text-decoration: none;
      transition: color 0.2s;
    }

    .categories a:hover {
      color: #6b7280;
    }

    .categories .count {
      font-size: 0.8rem;
      color: #6b7280;
    }

    .popular-tags .tags {
      display: flex;
      flex-wrap: wrap;
      gap: 0.5rem;
    }

    .popular-tags .tag {
      background-color: #f9fafb;
      color: #374151;
      border: 1px solid #e5e7eb;
      padding: 0.25rem 0.5rem;
      border-radius: 0.25rem;
      font-size: 0.8rem;
      transition: background-color 0.2s, color 0.2s;
    }

    .popular-tags .tag:hover {
      background-color: #e5e7eb;
    }

    .container {
      max-width: 1200px;
      /* Adjust as needed */
      margin-left: auto;
      margin-right: auto;
      padding-left: 1rem;
      padding-right: 1rem;

    }

    /* New styles for positioning */
    .main-wrapper {
      display: flex;
      flex-direction: column;
      /* Stack on smaller screens */
      gap: 20px;
    }

    @media (min-width: 768px) {
      .main-wrapper {
        flex-direction: column;
        /* Still stack the two main sections */
      }
    }

    .top-section {
      display: flex;
      flex-direction: column;
      gap: 50px;
    }

    @media (min-width: 768px) {
      .top-section {
        flex-direction: row;
      }
    }

    .nature-travel-wrapper {
      display: flex;
      flex-direction: column;
      /* Stack nature and travel on small screens */
      gap: 20px;
      justify-content: center;
    }

    @media (min-width: 768px) {
      .nature-travel-wrapper {
        flex-direction: row;
        /* Nature and travel side by side on larger screens */
      }
    }

    /* Give each section a width, adjust as needed */
    .nature-travel-wrapper>div {
      width: 330px;
      /* Example width */
    }

    .category-tags-container {
      width: 70%;
      /* Take up full width on small screens */
    }

    @media (min-width: 768px) {
      .category-tags-container {
        width: 70%;
        /*Override to full width on larger screens, if needed*/
      }
    }

    /* Added margin to the last two sections */
    .featured-posts,
    .top-section {
      margin-bottom: 30px;
      /* Adjust as needed */
    }
  </style>
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

 
  @include('layouts.footer')

</body>

</html>