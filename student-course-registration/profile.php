// main.js - Enhanced header & mobile nav

document.addEventListener("DOMContentLoaded", () => {
  const header = document.getElementById("header");
  const hamburger = document.getElementById("humburger");
  const mobileNav = document.getElementById("mobile-nav");

  // Scroll header effect
  window.addEventListener("scroll", () => {
    if (window.scrollY > 20) {
      header.classList.add("scroll-header");
    } else {
      header.classList.remove("scroll-header");
    }
  });

  // Hamburger toggle
  if (hamburger && mobileNav) {
    hamburger.addEventListener("click", (e) => {
      e.stopPropagation();
      mobileNav.classList.toggle("show-mn");

      // Toggle icon
      if (mobileNav.classList.contains("show-mn")) {
        hamburger.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                `;
      } else {
        hamburger.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12H12m-8.25 5.25h16.5" />
                    </svg>
                `;
      }
    });

    // Close mobile nav when clicking outside
    document.addEventListener("click", (e) => {
      if (!mobileNav.contains(e.target) && !hamburger.contains(e.target)) {
        mobileNav.classList.remove("show-mn");
        // Reset icon
        hamburger.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12H12m-8.25 5.25h16.5" />
                    </svg>
                `;
      }
    });
  }
});
