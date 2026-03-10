<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./styles/index.css" />
    <title>CourseLink | easy way to register your courses</title>
    <script defer src="./main.js"></script>
  </head>
  <body>
    <header class="header" id="header">
      <div class="logo">
        <span>🌿</span>
        <h1>Course<span>Link</span></h1>
      </div>

      <nav class="nav-container">
        <ul class="nav-links">
          <li class="nav-link"><a href="#home">Home</a></li>
          <li class="nav-link"><a href="#about">About</a></li>
          <li class="nav-link"><a href="#why">Why choose us</a></li>
        </ul>
      </nav>

      <div class="actions">
        <a href="login.php">Find Course</a>
      </div>
      <button class="humburger" id="humburger">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          stroke-width="1.5"
          stroke="currentColor"
          class="hum-icon"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M3.75 6.75h16.5M3.75 12H12m-8.25 5.25h16.5"
          />
        </svg>
      </button>
    </header>

    <!--Humburger navbar-->
    <div class="mobile-nav" id="mobile-nav">
      <ul>
        <li><a href="#home">Home</a></li>
        <li><a href="#about">About </a></li>
        <li><a href="#why">Why choose Us</a></li>
      </ul>
      <div class="actions">
        <a href="login.php">Find Course</a>
      </div>
    </div>
    <main>
      <section class="hero-section" id="home">
        <div class="hero-content">
          <p class="sub-head">
            CourseLink – Register & Manage Courses Easily 🎓
          </p>
          <h1 class="content-head">
            Your Simple Student Course Registration Dashboard
          </h1>
          <p class="content-desc">
            EnrollEasy makes course registration effortless. Log in to view your
            enrolled courses, check your profile, register for new ones, and
            manage your academic journey all from one secure, student-friendly
            dashboard.
          </p>

          <div class="hero-action">
            <a href="register.php">Register Now</a>
            <a href="#">Login to Your Dashboard</a>
          </div>
          <p class="mini">
            Quick enrollment • Personalized view • Profile with photo upload
          </p>
        </div>
        <div class="preview-section">
          <!-- Animated Background Elements -->
          <div class="blob-1"></div>
          <div class="blob-2"></div>

          <div class="container">
            <div class="header-content">
              <span class="badge">Community</span>
              <h3>Why Students Love CourseLink 😊</h3>
              <p class="preview-caption">
                Simple, secure, and enjoyable — just like these happy moments of
                learning and succeeding together.
              </p>
            </div>

            <div class="gallery-grid">
              <div class="gallery-item item-lg">
                <img
                  src="images/gallery-1.jpg"
                  alt="Student using laptop"
                  class="gallery-img"
                />
                <div class="img-overlay"></div>
              </div>
              <div class="gallery-item">
                <img
                  src="images/gallery-2.jpg"
                  alt="Group laughing"
                  class="gallery-img"
                />
                <div class="img-overlay"></div>
              </div>
              <div class="gallery-item">
                <img
                  src="images/gallery-3.jpg"
                  alt="Woman laughing"
                  class="gallery-img"
                />
                <div class="img-overlay"></div>
              </div>
              <div class="gallery-item item-md">
                <img
                  src="images/gallery-4.jpg"
                  alt="Thumbs up"
                  class="gallery-img"
                />
                <div class="img-overlay"></div>
              </div>
              <div class="gallery-item item-md">
                <img
                  src="images/gallery-5.jpg"
                  alt="Friends studying"
                  class="gallery-img"
                />
                <div class="img-overlay"></div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="why-section" id="why">
        <!-- Subtle moving green ambient glow -->
        <div class="glow-sphere"></div>

        <div class="container">
          <div class="header-stack">
            <span class="eyebrow">Academic Excellence</span>
            <h2 class="title">
              Built for the <span class="text-italic">Future</span> of Learning
            </h2>
            <p class="subtitle">
              A seamless course registration experience designed with precision
              and clarity.
            </p>
          </div>

          <div class="bento-layout">
            <!-- Feature 01: The Hero Card -->
            <div class="bento-card hero">
              <div class="card-inner">
                <div class="badge-icon">01</div>
                <h3>Smart Course Matching</h3>
                <p>
                  Our algorithm analyzes your degree path to suggest the most
                  relevant courses for your career goals.
                </p>
                <div class="glass-reflection"></div>
              </div>
            </div>

            <!-- Feature 02 -->
            <div class="bento-card">
              <div class="card-inner">
                <div class="badge-icon">02</div>
                <h3>Zero Latency</h3>
                <p>
                  Register in milliseconds with our high-concurrency cloud
                  infrastructure.
                </p>
              </div>
            </div>

            <!-- Feature 03 -->
            <div class="bento-card">
              <div class="card-inner">
                <div class="badge-icon">03</div>
                <h3>Secure Records</h3>
                <p>
                  Your academic data is encrypted with enterprise-level security
                  protocols.
                </p>
              </div>
            </div>

            <!-- Feature 04 -->
            <div class="bento-card wide">
              <div class="card-inner">
                <div class="badge-icon">04</div>
                <h3>Integrated Academic Dashboard</h3>
                <p>
                  Monitor credits, GPA, and schedules in one unified, beautiful
                  interface that adapts to your needs.
                </p>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="about-section" id="about">
        <!-- Subtle background branding -->
        <div class="watermark-text">COURSES</div>

        <div class="container">
          <div class="about-grid">
            <!-- Image Side with Glass Stats -->
            <div class="about-visual">
              <div class="image-wrapper">
                <img
                  src="images/campus.jpeg"
                  alt="Modern Campus"
                  class="main-img"
                />
                <div class="glass-stat-card">
                  <span class="stat-num">98%</span>
                  <span class="stat-desc">Enrollment Success</span>
                </div>
              </div>
            </div>

            <!-- Content Side -->
            <div class="about-content">
              <span class="eyebrow">Our Vision</span>
              <h2 class="about-title">
                Revolutionizing the
                <span class="green-highlight">Academic Pulse</span>
              </h2>
              <p class="about-p">
                CourseLink was born from a simple mission: to remove the
                friction between students and their ambitions. We believe
                registration shouldn't be a hurdle, but a seamless gateway to
                your future.
              </p>

              <ul class="feature-list">
                <li>
                  <div class="dot"></div>
                  <span>User-centric design for effortless navigation</span>
                </li>
                <li>
                  <div class="dot"></div>
                  <span>Real-time data synchronization across departments</span>
                </li>
              </ul>

              <button class="btn-elegant">
                Explore Our Story
                <svg class="arrow" width="18" height="18" viewBox="0 0 24 24">
                  <path
                    d="M5 12h14M12 5l7 7-7 7"
                    stroke="currentColor"
                    fill="none"
                    stroke-width="2"
                  />
                </svg>
              </button>
            </div>
          </div>
        </div>
      </section>
    </main>

    <footer class="main-footer">
      <div class="footer-glow"></div>

      <div class="container">
        <!-- Top Part: Elevated CTA -->
        <div class="footer-cta">
          <div class="cta-text">
            <h2>Ready to Shape Your Future?</h2>
            <p>Join 50,000+ students already using CourseLink.</p>
          </div>
          <button class="btn-mint">Get Started Now</button>
        </div>

        <!-- Middle Part: Links & Branding -->
        <div class="footer-grid">
          <div class="footer-brand">
            <div class="logo-wrap">
              <span class="logo-icon">🌿</span>
              <span class="logo-text">CourseLink</span>
            </div>
            <p class="brand-desc">
              Empowering the next generation of scholars through seamless
              digital infrastructure.
            </p>
            <div class="social-links">
              <a href="#" class="social-icon">In</a>
              <a href="#" class="social-icon">Tw</a>
              <a href="#" class="social-icon">Ig</a>
            </div>
          </div>

          <div class="footer-links">
            <h4>Platform</h4>
            <ul>
              <li><a href="#">Course Search</a></li>
              <li><a href="#">Registration</a></li>
              <li><a href="#">Academic Calendar</a></li>
            </ul>
          </div>

          <div class="footer-links">
            <h4>Support</h4>
            <ul>
              <li><a href="#">Help Center</a></li>
              <li><a href="#">Student Advisor</a></li>
              <li><a href="#">Contact Us</a></li>
            </ul>
          </div>

          <div class="footer-links">
            <h4>Legal</h4>
            <ul>
              <li><a href="#">Privacy Policy</a></li>
              <li><a href="#">Terms of Use</a></li>
            </ul>
          </div>
        </div>

        <!-- Bottom Part: Copyright -->
        <div class="footer-bottom">
          <p>&copy; 2026 CourseLink Systems. All rights reserved.</p>
          <div class="status">
            <span class="status-dot"></span> System Status: Operational
          </div>
        </div>
      </div>
    </footer>
  </body>
</html>
