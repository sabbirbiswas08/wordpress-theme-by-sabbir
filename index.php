<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chazz Clevinger | CEO, CiviClick</title>
    <meta name="description" content="Chazz Clevinger is the Founder & CEO of CiviClick, transforming grassroots advocacy with AI-powered stakeholder mobilization.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Outfit:wght@700;800&display=swap" rel="stylesheet">
    <!-- Load Theme Stylesheet -->
    <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" onerror="this.onerror=null;this.href='style.css';">
</head>
<body>

    <header>
        <div class="container nav-content">
            <div class="logo">Chazz Clevinger</div>
            <nav>
                <ul>
                    <li><a href="#about">About</a></li>
                    <li><a href="#insights">Insights</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <!-- Hero Section -->
        <section class="hero" id="home">
            <div class="container">
                <div class="hero-content">
                    <span class="hero-subtitle">Washington, D.C.</span>
                    <h1>Founder & Chief Executive Officer,<br>CiviClick</h1>
                    <p>Building the first artificial intelligence-powered stakeholder mobilization platform to fundamentally change how grassroots advocacy campaigns are conceived, executed, and measured.</p>
                    <a href="#about" class="btn">Discover My Work</a>
                </div>
            </div>
        </section>

        <!-- Bio Section -->
        <section class="bio" id="about">
            <div class="container">
                <div class="bio-grid">
                    <div class="bio-image">
                        <!-- We use the provided portrait image -->
                        <img src="https://wordpress.sabbirbiswas.com/wp-content/uploads/2026/04/chazz_portrait.webp" alt="Chazz Clevinger Portrait">
                    </div>
                    <div class="bio-content">
                        <h2>A Career Defined by Innovation and Public Service</h2>
                        <p>Chazz Clevinger stands at the forefront of a transformation reshaping how organizations, advocacy groups, and civic institutions engage with the public. From his earliest days as an intern at the White House to his current role leading one of the most decorated advocacy technology companies in the United States, his career reflects a singular commitment to the principle that technology can and should amplify the voice of every citizen.</p>
                        <p>Born and raised in Wilmington, North Carolina, Clevinger developed an early fascination with the mechanics of political power. He pursued that interest at the University of North Carolina at Chapel Hill, where he graduated Phi Beta Kappa with a Bachelor of Arts in Political Science and Ancient History. His senior honors thesis examined the strategic deployment of belief systems in statecraft — a theme that echoes throughout his later work.</p>
                        <p>Working 16-hour days in the West Wing during the Bush Administration, he gained a firsthand understanding of how policy is shaped. That gap — between what people want and what their government hears — became the central problem of his professional life. Clevinger subsequently served as a Veterans Affairs staffer in the office of U.S. Senator Richard Burr, and went on to hold positions at CQ Roll Call, SevenTwenty Strategies, before founding Coastal Political Strategies and eventually CiviClick.</p>
                        
                        <div class="bio-stats">
                            <div class="stat">
                                <h4>UNC Chapel Hill</h4>
                                <p>Phi Beta Kappa, B.A. Political Science & Ancient History</p>
                            </div>
                            <div class="stat">
                                <h4>White House Alum</h4>
                                <p>Office of Strategic Initiatives</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Blog Section (Dynamic via REST API) -->
        <section class="blog" id="insights">
            <div class="container">
                <div class="section-header">
                    <h2>Latest Insights</h2>
                    <p>Thoughts on political technology, persuasion architecture, and grassroots engagement.</p>
                </div>
                <!-- This grid will be populated by app.js fetching from /wp-json/wp/v2/posts?_embed -->
                <div class="blog-grid" id="blog-grid">
                    <!-- Loading Skeleton -->
                    <div class="blog-card" style="opacity: 0.5;">
                        <div class="card-image"></div>
                        <div class="card-content">
                            <div class="card-title">Loading posts...</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section class="contact" id="contact">
            <div class="container">
                <div class="section-header">
                    <h2>Get In Touch</h2>
                    <p>Connect with Chazz for speaking engagements, consulting, or media inquiries.</p>
                </div>
                <div class="contact-container">
                    <form id="contact-form" class="contact-form">
                        <!-- CF7 Hidden Fields Required by Rules -->
                        <input type="hidden" name="_wpcf7" value="5">
                        <input type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f5-p1-o1">
                        <input type="hidden" name="your-subject" value="New Inquiry from Chazz Clevinger Website">

                        <div class="form-group">
                            <input type="text" name="your-name" id="your-name" class="form-control" placeholder="Your Name" required>
                        </div>
                        <div class="form-group">
                            <input type="email" name="your-email" id="your-email" class="form-control" placeholder="Your Email" required>
                        </div>
                        <div class="form-group">
                            <textarea name="your-message" id="your-message" class="form-control" placeholder="Your Message" required></textarea>
                        </div>
                        <button type="submit" class="btn" id="submit-btn">Send Message</button>
                        <div id="form-status" class="form-status"></div>
                    </form>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> Chazz Clevinger. All Rights Reserved.</p>
        </div>
    </footer>

    <!-- Load App JS -->
    <script src="app.js"></script>
    <?php wp_footer(); ?>
</body>
</html>
