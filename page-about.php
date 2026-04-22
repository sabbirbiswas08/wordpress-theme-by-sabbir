<?php
/**
 * Template Name: About Page
 */
get_header(); ?>

<!-- ABOUT HERO -->
<div class="about-page-hero">
    <div class="container">
        <span class="bio-tag">Founder &amp; CEO, CiviClick</span>
        <h1>About <span class="gradient-text">Chazz Clevinger</span></h1>
        <p>A career built at the intersection of technology, politics, and public service — from the White House to the leading edge of AI-powered advocacy.</p>
    </div>
</div>

<!-- FULL BIO -->
<section class="bio" style="padding: 7rem 0;">
    <div class="container">
        <div class="bio-grid">
            <div class="bio-image-wrap">
                <div class="bio-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/chazz_portrait.webp" alt="Chazz Clevinger Portrait">
                </div>
            </div>
            <div class="bio-content">
                <span class="bio-tag">The Full Story</span>
                <h2>From Wilmington to Washington</h2>
                <p>Born and raised in Wilmington, North Carolina, Chazz Clevinger developed an early fascination with the mechanics of political power and the structures that connect citizens to their elected representatives. He pursued that interest at the University of North Carolina at Chapel Hill, where he graduated Phi Beta Kappa with a Bachelor of Arts in Political Science and Ancient History.</p>
                <p>His senior honors thesis, <em>"Machiavelli, Livy, and the Political Uses of Religion,"</em> examined the strategic deployment of belief systems in statecraft — a theme that would echo throughout his later work in political technology and persuasion architecture.</p>
                <p>After Chapel Hill, Clevinger moved to Washington, D.C., where he secured an internship in the Office of Strategic Initiatives at the White House during the Bush Administration. Working 16-hour days in the West Wing, he gained a firsthand understanding of how policy is shaped at the highest levels of government.</p>
                <p>Clevinger subsequently served as a Veterans Affairs staffer in the office of U.S. Senator Richard Burr, where he worked directly with constituents navigating the complexities of federal benefits and services. The role reinforced his belief that effective advocacy requires not just passion but infrastructure — systems that translate individual concerns into collective political pressure.</p>
                <p>He went on to hold positions at CQ Roll Call, SevenTwenty Strategies, and other organizations before founding his own political consulting firm, Coastal Political Strategies, where he began experimenting with digital tools to enhance grassroots engagement — and eventually, founding <strong style="color:var(--text-primary)">CiviClick</strong>.</p>
            </div>
        </div>
    </div>
</section>

<!-- CAREER TIMELINE -->
<section class="timeline">
    <div class="container">
        <div class="section-header">
            <h2>Career <span class="gradient-text">Timeline</span></h2>
            <p>Key milestones that shaped a career defined by innovation and public service.</p>
        </div>
        <div class="timeline-grid">
            <div class="timeline-item">
                <div class="timeline-year">Early Career</div>
                <h3>University of North Carolina at Chapel Hill</h3>
                <p>Graduated Phi Beta Kappa with a B.A. in Political Science and Ancient History. Senior thesis on Machiavelli and the political uses of belief systems.</p>
            </div>
            <div class="timeline-item">
                <div class="timeline-year">Bush Administration</div>
                <h3>White House — Office of Strategic Initiatives</h3>
                <p>Internship in the West Wing during the Bush Administration. Gained firsthand understanding of how policy is shaped at the highest levels of government.</p>
            </div>
            <div class="timeline-item">
                <div class="timeline-year">U.S. Senate</div>
                <h3>Veterans Affairs Staffer — Senator Richard Burr</h3>
                <p>Worked directly with constituents navigating federal benefits, reinforcing the belief that advocacy requires infrastructure, not just passion.</p>
            </div>
            <div class="timeline-item">
                <div class="timeline-year">Industry</div>
                <h3>CQ Roll Call &amp; SevenTwenty Strategies</h3>
                <p>Held senior positions at leading political intelligence and strategy firms, deepening expertise in legislative affairs and stakeholder communication.</p>
            </div>
            <div class="timeline-item">
                <div class="timeline-year">Consulting</div>
                <h3>Founder — Coastal Political Strategies</h3>
                <p>Founded his own political consulting firm, pioneering the use of digital tools to enhance grassroots engagement and advocacy measurement.</p>
            </div>
            <div class="timeline-item">
                <div class="timeline-year">Today</div>
                <h3>Founder &amp; CEO — CiviClick</h3>
                <p>Built the first AI-powered stakeholder mobilization platform, transforming how advocacy campaigns are conceived, executed, and measured nationally.</p>
            </div>
        </div>
    </div>
</section>

<!-- PHILOSOPHY -->
<section class="about-philosophy">
    <div class="container">
        <div class="section-header">
            <h2>Core <span class="gradient-text">Philosophy</span></h2>
            <p>The beliefs that drive everything Chazz builds and advocates for.</p>
        </div>
        <div class="philosophy-grid">
            <div class="philosophy-card">
                <div class="philosophy-icon">
                    <svg width="28" height="28" fill="none" stroke="#fff" stroke-width="2" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
                </div>
                <h3>Citizen Amplification</h3>
                <p>Technology must amplify the voice of every citizen. The gap between public intent and legislative action is a design problem — one we can solve.</p>
            </div>
            <div class="philosophy-card">
                <div class="philosophy-icon">
                    <svg width="28" height="28" fill="none" stroke="#fff" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M19.07 4.93a10 10 0 010 14.14M16.24 7.76a6 6 0 010 8.49M4.93 4.93a10 10 0 000 14.14M7.76 7.76a6 6 0 000 8.49"/></svg>
                </div>
                <h3>Infrastructure First</h3>
                <p>Passion without infrastructure is noise. Effective advocacy requires systematic, scalable platforms that convert individual concerns into political pressure.</p>
            </div>
            <div class="philosophy-card">
                <div class="philosophy-icon">
                    <svg width="28" height="28" fill="none" stroke="#fff" stroke-width="2" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                </div>
                <h3>Technology as a Force for Good</h3>
                <p>AI and data can make democracy more accessible, not less. The goal is to ensure the most sophisticated tools are available to every advocacy organization.</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section style="padding: 6rem 0; text-align: center; background: var(--bg-primary);">
    <div class="container">
        <h2 style="font-size:clamp(2rem,5vw,3rem); margin-bottom: 1rem;">Ready to Connect?</h2>
        <p style="margin-bottom: 2.5rem; max-width: 500px; margin-left: auto; margin-right: auto;">Whether you're interested in CiviClick, looking for a speaker, or want to discuss political technology — let's talk.</p>
        <div style="display:flex; gap:1rem; justify-content:center; flex-wrap:wrap;">
            <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn">Get In Touch</a>
            <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts')) ?: home_url('/blog')); ?>" class="btn-outline">Read the Blog</a>
        </div>
    </div>
</section>

<?php get_footer(); ?>
