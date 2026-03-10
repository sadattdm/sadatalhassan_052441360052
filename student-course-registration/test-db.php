* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: sans-serif;
  scroll-behavior: smooth;
}

.header {
  width: 100vw;
  height: 70px;
  padding: 10px 20px;
  display: flex;
  justify-content: space-between;
  align-items: center;

  position: sticky;
  top: 10px;
  margin-top: 10px;
  transition: all 0.5s;
  z-index: 100;
}
.scroll-header {
  backdrop-filter: blur(20px);
  background-color: #ffffff50;
  width: 90vw;
  border: 0.1px solid grey;
  border-radius: 200px;
  margin: 0 auto;
}

.header .logo {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 5px;
}
.header .logo .logo-icon {
  width: 30px;
  height: 30px;
  color: #69db7c;
}
.header .logo h1 {
  font-size: 20px;
  font-weight: 900;
  color: #555;
}
.header .logo h1 span {
  color: #69db7c;
}
.nav-container .nav-links {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 15px;
}
.nav-container .nav-links .nav-link {
  list-style: none;
  font-size: 18px;
}
.nav-container .nav-links .nav-link a {
  text-decoration: none;
  color: #555;
  transition: all 0.4s;
}
.nav-container .nav-links .nav-link a:hover {
  color: #69db7c;
}

.actions {
  padding: 9px 15px;
  border-radius: 200px;
  background-color: #69db7c;
  box-shadow: 1px 2px 10px rgb(225, 222, 222);
  cursor: pointer;
  transition: all 0.4s;
}
.actions:hover {
  background-color: #27bb40;
  box-shadow: 1px 2px 5px #69db7c;
}
.actions a {
  text-decoration: none;
  color: #fff;
  font-weight: 900;
}

.humburger {
  display: none;
  width: 40px;
  height: 40px;
  background-color: transparent;
  border: none;
}
.humburger .hum-icon {
  color: #27bb40;
  stroke-width: 3px;
}
.mobile-nav {
  position: fixed;
  top: 100px;
  left: 10px;
  padding: 15px 10px;
  display: none;
  flex-direction: column;
  justify-content: center;
  align-items: flex-start;
  gap: 10px;

  border-radius: 15px;
  backdrop-filter: blur(20px);
  background-color: #ffffff50;
  animation: slide-in ease-in-out 0.9s forwards;
  z-index: 1000;
}
.show-mn {
  display: flex;
}
@keyframes slide-in {
  0% {
    transform: translateX(-100%);
  }
  100% {
    transform: translateX(0%);
  }
}
.mobile-nav ul {
  display: flex;
  flex-direction: column;
  gap: 10px;
}
.mobile-nav ul li {
  list-style: none;
  padding: 5px;
  color: #555;

  border-radius: 10px;
  transition: all 0.4s;
}
.mobile-nav ul li:hover {
  background-color: #27bb40;
  color: #fff;
}
.mobile-nav ul li a {
  font-size: 18px;
  font-weight: 700;
  text-decoration: none;
  color: inherit;
}

/*HERO SECTION CSS*/
.hero-section {
  width: 100vw;
  height: auto;
  padding: 50px 20px;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 20px;
  justify-content: center;
  background-image: linear-gradient(to right, #ebfbee, #ffffff);
}

.hero-section .hero-content {
  width: 80%;
  display: flex;
  flex-direction: column;
  gap: 15px;
  align-items: center;
  justify-content: center;
  text-align: center;
}

.hero-content .sub-head {
  padding: 5px 10px;
  border-radius: 200px;
  background-color: #087f5b50;
  backdrop-filter: blur(20px);
  font-size: 14px;
  color: #333;
  font-weight: 500;
  animation: bounce ease-in-out 0.3s infinite;
  text-align: center;
}
@keyframes bounce {
  0% {
    transform: translateY(10px);
  }
  100% {
    transform: translateY(0px);
  }
}

.content-head {
  font-size: clamp(40px, 8vw, 70px);
  font-weight: 900;
  color: transparent;
  background-image: linear-gradient(to right, #37b24d, #8ce99a);
  background-clip: text;
}
.content-desc {
  font-size: clamp(16px, 8vw, 18px);
  line-height: 1.7;
  color: #555;
  font-weight: 600;
  width: 70%;
}
.hero-action {
  display: flex;
  gap: 10px;
}
.hero-action a:first-child {
  text-decoration: none;
  color: #fff;
  font-weight: 600;
  padding: 10px 15px;
  border-radius: 10px;
  background-color: #27bb40;
  text-align: center;
}
.hero-action a:last-child {
  text-decoration: none;
  color: #fff;
  font-weight: 600;
  padding: 10px 15px;
  border-radius: 10px;
  background-color: #6ca376;
  text-align: center;
}
.mini {
  font-size: 14px;
  color: #888;
}
:root {
  --emerald: #065f46;
  --mint: #10b981;
  --soft-mint: #f0fdf4;
  --glass: rgba(255, 255, 255, 0.8);
}

.preview-section {
  position: relative;
  padding: 120px 5%;
  background: #ffffff; /* Clean white for elegance */
  overflow: hidden;
}

/* --- Refined Animated Background --- */
.blob-1,
.blob-2 {
  position: absolute;
  width: 700px;
  height: 700px;
  filter: blur(120px);
  opacity: 0.15;
  z-index: 0;
  border-radius: 50%;
}
.blob-1 {
  background: var(--mint);
  top: -10%;
  left: -10%;
  animation: float 20s infinite alternate;
}
.blob-2 {
  background: var(--emerald);
  bottom: -10%;
  right: -5%;
  animation: float 25s infinite alternate-reverse;
}

@keyframes float {
  from {
    transform: translate(0, 0) rotate(0deg);
  }
  to {
    transform: translate(100px, 50px) rotate(15deg);
  }
}

/* --- Header Styling --- */
.header-content {
  text-align: center;
  margin-bottom: 80px;
  position: relative;
  z-index: 1;
}

.badge {
  background: var(--soft-mint);
  color: var(--emerald);
  padding: 8px 20px;
  border-radius: 100px;
  font-size: 0.75rem;
  font-weight: 700;
  letter-spacing: 2px;
  text-transform: uppercase;
  border: 1px solid rgba(16, 185, 129, 0.2);
}

.header-content h3 {
  font-size: clamp(2.5rem, 5vw, 4rem);
  color: #064e3b;
  margin: 25px 0;
  letter-spacing: -3px;
  font-weight: 800;
}

/* --- The Architectural Gallery --- */
.gallery-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  grid-auto-rows: 300px;
  gap: 24px;
  position: relative;
  z-index: 1;
}

.gallery-item {
  position: relative;
  border-radius: 40px; /* Super rounded for modern feel */
  overflow: hidden;
  background: var(--glass);
  border: 1px solid rgba(6, 95, 70, 0.05);
  transition: all 0.8s cubic-bezier(0.2, 1, 0.3, 1);
}

.item-lg {
  grid-column: span 2;
  grid-row: span 2;
}
.item-md {
  grid-column: span 2;
}

.gallery-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 1.2s cubic-bezier(0.2, 1, 0.3, 1);
  filter: saturate(0.9); /* Artistic desaturation */
}

/* --- High-End Hover Overlay --- */
.img-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(to top, rgba(6, 95, 70, 0.4), transparent);
  opacity: 0;
  transition: opacity 0.5s ease;
}

.gallery-item:hover {
  transform: scale(0.97); /* "Inward" click effect */
  box-shadow: 0 40px 80px rgba(6, 95, 70, 0.1);
}

.gallery-item:hover .gallery-img {
  transform: scale(1.15); /* Image zooms while container shrinks */
  filter: saturate(1.1);
}

.gallery-item:hover .img-overlay {
  opacity: 1;
}

/* Responsive Mobile */
@media (max-width: 1024px) {
  .gallery-grid {
    grid-template-columns: repeat(2, 1fr);
  }
}
@media (max-width: 600px) {
  .gallery-grid {
    grid-template-columns: 1fr;
    grid-auto-rows: 350px;
  }
  .item-lg,
  .item-md {
    grid-column: span 1;
    grid-row: span 1;
  }
}

@media (max-width: 720px) {
  .humburger {
    display: block;
  }
  .header .actions {
    display: none;
  }
  .header .nav-container {
    display: none;
  }
  .hero-section {
    padding: 30px 20px;
  }
  .hero-content {
    width: 100% !important;
  }
  .content-desc {
    width: 100% !important;
  }
  .hero-content {
    align-items: start !important;
    text-align: left !important;
  }
}
@media (min-width: 721px) {
  .mobile-nav {
    display: none !important;
  }
}

:root {
  --emerald-deep: #064e3b;
  --emerald-mid: #10b981;
  --mint-light: #ecfdf5;
  --text-main: #022c22;
  --glass-border: rgba(16, 185, 129, 0.2);
}

.why-section {
  padding: 140px 5%;
  background: #ffffff;
  position: relative;
  overflow: hidden;
  font-family: "Inter", sans-serif;
}

/* --- Sophisticated Typography --- */
.header-stack {
  text-align: center;
  margin-bottom: 80px;
}

.eyebrow {
  font-size: 0.8rem;
  letter-spacing: 3px;
  text-transform: uppercase;
  color: var(--emerald-mid);
  font-weight: 700;
}

.title {
  font-size: clamp(2.5rem, 5vw, 4rem);
  color: var(--text-main);
  letter-spacing: -2px;
  margin: 20px 0;
  font-weight: 800;
}

.text-italic {
  font-family: "Playfair Display", serif; /* Or any serif font */
  font-style: italic;
  color: var(--emerald-mid);
}

/* --- The Elegant Bento Grid --- */
.bento-layout {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  grid-auto-rows: 260px;
  gap: 24px;
}

.bento-card {
  position: relative;
  background: #ffffff;
  border-radius: 40px;
  padding: 2px; /* For the gradient border effect */
  background: linear-gradient(135deg, var(--glass-border), transparent);
  transition: all 0.6s cubic-bezier(0.2, 1, 0.3, 1);
}

.card-inner {
  background: #ffffff;
  height: 100%;
  width: 100%;
  border-radius: 38px;
  padding: 40px;
  display: flex;
  flex-direction: column;
  justify-content: flex-end;
  position: relative;
  overflow: hidden;
}

/* Bento Sizing */
.hero {
  grid-row: span 2;
}
.wide {
  grid-column: span 2;
}

/* Interactive Elements */
.badge-icon {
  position: absolute;
  top: 40px;
  left: 40px;
  font-size: 0.9rem;
  font-weight: 900;
  color: var(--emerald-mid);
  opacity: 0.4;
}

.bento-card h3 {
  font-size: 1.5rem;
  color: var(--text-main);
  margin-bottom: 12px;
  letter-spacing: -0.5px;
}

.bento-card p {
  color: #4b5563;
  line-height: 1.6;
  font-size: 1rem;
}

/* --- Elegant Hover State --- */
.bento-card:hover {
  transform: translateY(-10px) scale(1.02);
  box-shadow: 0 40px 80px rgba(6, 78, 59, 0.08);
}

.bento-card:hover .card-inner {
  background: var(--mint-light);
}

/* --- Ambient Animation --- */
.glow-sphere {
  position: absolute;
  width: 800px;
  height: 800px;
  background: radial-gradient(
    circle,
    rgba(16, 185, 129, 0.08) 0%,
    transparent 70%
  );
  top: -200px;
  right: -200px;
  filter: blur(100px);
  animation: drift 20s infinite alternate;
}

@keyframes drift {
  from {
    transform: translate(0, 0);
  }
  to {
    transform: translate(-100px, 100px);
  }
}

/* Mobile Responsive */
@media (max-width: 900px) {
  .bento-layout {
    grid-template-columns: 1fr;
    grid-auto-rows: auto;
  }
  .hero,
  .wide {
    grid-column: span 1;
    grid-row: span 1;
  }
}

:root {
  --emerald: #064e3b;
  --mint-accent: #10b981;
  --mint-bg: #f0fdf4;
}

.about-section {
  padding: 150px 5%;
  background: #ffffff;
  position: relative;
  overflow: hidden;
}

/* Background Watermark */
.watermark-text {
  position: absolute;
  font-size: 15vw;
  font-weight: 900;
  color: rgba(6, 78, 59, 0.03);
  bottom: -50px;
  right: -20px;
  user-select: none;
  z-index: 0;
}

.about-grid {
  display: grid;
  grid-template-columns: 1.1fr 0.9fr;
  gap: 80px;
  align-items: center;
  position: relative;
  z-index: 2;
}

/* --- Visual Side (Left) --- */
.image-wrapper {
  position: relative;
  border-radius: 40px;
  box-shadow: 0 50px 100px rgba(6, 78, 59, 0.1);
}

.main-img {
  width: 100%;
  border-radius: 40px;
  display: block;
}

.glass-stat-card {
  position: absolute;
  bottom: -30px;
  right: -30px;
  background: rgba(255, 255, 255, 0.8);
  backdrop-filter: blur(20px);
  padding: 30px 40px;
  border-radius: 30px;
  border: 1px solid rgba(16, 185, 129, 0.2);
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.05);
}

.stat-num {
  display: block;
  font-size: 2.5rem;
  font-weight: 800;
  color: var(--emerald);
  line-height: 1;
}

.stat-desc {
  font-size: 0.9rem;
  color: var(--mint-accent);
  font-weight: 600;
}

/* --- Content Side (Right) --- */
.eyebrow {
  color: var(--mint-accent);
  text-transform: uppercase;
  letter-spacing: 4px;
  font-weight: 700;
  font-size: 0.8rem;
}

.about-title {
  font-size: clamp(2rem, 4vw, 3.5rem);
  color: var(--emerald);
  margin: 20px 0;
  line-height: 1.1;
  letter-spacing: -2px;
}

.green-highlight {
  color: var(--mint-accent);
  position: relative;
}

.about-p {
  color: #4b5563;
  line-height: 1.8;
  font-size: 1.1rem;
  margin-bottom: 30px;
}

/* Elegant List */
.feature-list {
  list-style: none;
  padding: 0;
  margin-bottom: 40px;
}
.feature-list li {
  display: flex;
  align-items: center;
  gap: 15px;
  margin-bottom: 15px;
  color: #374151;
  font-weight: 500;
}
.dot {
  width: 8px;
  height: 8px;
  background: var(--mint-accent);
  border-radius: 50%;
}

/* Button with Arrow Animation */
.btn-elegant {
  background: var(--emerald);
  color: #fff;
  border: none;
  padding: 18px 40px;
  border-radius: 100px;
  font-weight: 600;
  display: flex;
  align-items: center;
  gap: 12px;
  cursor: pointer;
  transition: 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.btn-elegant:hover {
  background: var(--mint-accent);
  transform: scale(1.05);
}

.btn-elegant:hover .arrow {
  transform: translateX(5px);
}

/* Responsive */
@media (max-width: 992px) {
  .about-grid {
    grid-template-columns: 1fr;
    gap: 60px;
  }
  .glass-stat-card {
    right: 10px;
    bottom: -20px;
  }
}

:root {
  --forest: #022c22;
  --emerald: #064e3b;
  --mint: #10b981;
  --off-white: rgba(255, 255, 255, 0.7);
}

.main-footer {
  background: var(--forest);
  padding: 100px 5% 40px;
  position: relative;
  overflow: hidden;
  color: #ffffff;
}

/* Background Ambient Glow */
.footer-glow {
  position: absolute;
  top: -200px;
  right: -100px;
  width: 600px;
  height: 600px;
  background: radial-gradient(
    circle,
    rgba(16, 185, 129, 0.1) 0%,
    transparent 70%
  );
  filter: blur(80px);
  z-index: 1;
}

.container {
  position: relative;
  z-index: 2;
  max-width: 1400px;
  margin: 0 auto;
}

/* --- Footer CTA Area --- */
.footer-cta {
  background: rgba(255, 255, 255, 0.03);
  backdrop-filter: blur(10px);
  border: 1px solid rgba(255, 255, 255, 0.1);
  padding: 60px;
  border-radius: 40px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 80px;
}

.cta-text h2 {
  font-size: 2.5rem;
  letter-spacing: -2px;
  margin-bottom: 10px;
}
.cta-text p {
  color: var(--off-white);
  font-size: 1.1rem;
}

.btn-mint {
  background: var(--mint);
  color: var(--forest);
  border: none;
  padding: 20px 45px;
  border-radius: 100px;
  font-weight: 700;
  cursor: pointer;
  transition: 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.btn-mint:hover {
  transform: scale(1.05) translateY(-5px);
  box-shadow: 0 20px 40px rgba(16, 185, 129, 0.3);
}

/* --- Footer Grid --- */
.footer-grid {
  display: grid;
  grid-template-columns: 1.5fr 1fr 1fr 1fr;
  gap: 60px;
  padding-bottom: 60px;
  border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.logo-text {
  font-size: 1.8rem;
  font-weight: 800;
  letter-spacing: -1px;
  margin-left: 10px;
}
.brand-desc {
  color: var(--off-white);
  line-height: 1.6;
  margin: 20px 0;
  max-width: 300px;
}

.footer-links h4 {
  font-size: 1.1rem;
  margin-bottom: 25px;
  color: var(--mint);
}
.footer-links ul {
  list-style: none;
  padding: 0;
}
.footer-links li {
  margin-bottom: 12px;
}
.footer-links a {
  color: var(--off-white);
  text-decoration: none;
  transition: 0.3s;
}
.footer-links a:hover {
  color: #ffffff;
  padding-left: 5px;
}

/* --- Bottom Bar --- */
.footer-bottom {
  padding-top: 40px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-size: 0.9rem;
  color: rgba(255, 255, 255, 0.4);
}

.status {
  display: flex;
  align-items: center;
  gap: 8px;
  color: var(--mint);
  font-weight: 600;
}
.status-dot {
  width: 8px;
  height: 8px;
  background: var(--mint);
  border-radius: 50%;
  box-shadow: 0 0 10px var(--mint);
}

/* Responsive */
@media (max-width: 992px) {
  .footer-cta {
    flex-direction: column;
    text-align: center;
    gap: 30px;
  }
  .footer-grid {
    grid-template-columns: 1fr 1fr;
  }
}
@media (max-width: 600px) {
  .footer-grid {
    grid-template-columns: 1fr;
  }
}
