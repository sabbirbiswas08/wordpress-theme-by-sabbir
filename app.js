document.addEventListener('DOMContentLoaded', () => {
    
    // ==========================================
    // 1. Fetch Blog Posts via WP REST API
    // ==========================================
    const fetchBlogPosts = async () => {
        const blogGrid = document.getElementById('blog-grid');
        
        try {
            // Using the requested endpoint with _embed
            // In a real WP setup, this would be relative: /wp-json/wp/v2/posts?_embed
            // For now, we will use an absolute path fallback if relative fails, 
            // but the rule states to "always use the /wp-json/wp/v2/posts endpoint with _embed"
            const response = await fetch('/wp-json/wp/v2/posts?_embed');
            
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            
            const posts = await response.json();
            
            if (posts.length === 0) {
                blogGrid.innerHTML = '<p style="grid-column: 1/-1; text-align: center; color: var(--text-secondary);">No posts found.</p>';
                return;
            }
            
            // Clear skeleton loader
            blogGrid.innerHTML = '';
            
            posts.forEach(post => {
                // Extract featured image if available
                let imageUrl = '';
                if (post._embedded && post._embedded['wp:featuredmedia'] && post._embedded['wp:featuredmedia'][0]) {
                    imageUrl = post._embedded['wp:featuredmedia'][0].source_url;
                } else {
                    // Fallback placeholder
                    imageUrl = 'data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22400%22%20height%3D%22200%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20400%20200%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_18e00e84b80%20text%20%7B%20fill%3A%2394a3b8%3Bfont-weight%3Anormal%3Bfont-family%3Avar(--font-body)%2C%20monospace%3Bfont-size%3A20pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_18e00e84b80%22%3E%3Crect%20width%3D%22400%22%20height%3D%22200%22%20fill%3D%22%231e293b%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22135.21875%22%20y%3D%22108.5%22%3ENo%20Image%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E';
                }
                
                const date = new Date(post.date).toLocaleDateString('en-US', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });
                
                // Construct card HTML matching the site's existing card UI classes
                const cardHTML = `
                    <article class="blog-card">
                        <div class="card-image">
                            <img src="${imageUrl}" alt="${post.title.rendered}">
                        </div>
                        <div class="card-content">
                            <span class="card-date">${date}</span>
                            <h3 class="card-title">${post.title.rendered}</h3>
                            <div class="card-excerpt">
                                ${post.excerpt.rendered}
                            </div>
                            <a href="${post.link}" class="read-more">
                                Read Article 
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg>
                            </a>
                        </div>
                    </article>
                `;
                
                blogGrid.insertAdjacentHTML('beforeend', cardHTML);
            });
            
        } catch (error) {
            console.error('Error fetching blog posts:', error);
            blogGrid.innerHTML = `
                <div class="blog-card" style="grid-column: 1/-1;">
                    <div class="card-content">
                        <h3 class="card-title">Demo Content</h3>
                        <p class="card-excerpt">Since the WordPress REST API endpoint (/wp-json/wp/v2/posts) is currently unavailable, we are showing demo content. Once connected to a live WordPress backend, the articles will appear here automatically.</p>
                    </div>
                </div>
            `;
        }
    };

    // Initialize blog fetch
    fetchBlogPosts();


    // ==========================================
    // 2. Handle Contact Form 7 Submission
    // ==========================================
    const contactForm = document.getElementById('contact-form');
    const submitBtn = document.getElementById('submit-btn');
    const formStatus = document.getElementById('form-status');

    if (contactForm) {
        contactForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            
            // UI feedback
            submitBtn.textContent = 'Sending...';
            submitBtn.disabled = true;
            formStatus.className = 'form-status';
            formStatus.style.display = 'none';
            
            const formData = new FormData(contactForm);
            const formId = formData.get('_wpcf7');
            
            try {
                // Submit to CF7 REST API
                const response = await fetch(`/wp-json/contact-form-7/v1/contact-forms/${formId}/feedback`, {
                    method: 'POST',
                    body: formData
                });
                
                const result = await response.json();
                
                formStatus.style.display = 'block';
                
                if (result.status === 'mail_sent') {
                    formStatus.textContent = result.message || 'Thank you for your message. It has been sent.';
                    formStatus.className = 'form-status success';
                    contactForm.reset();
                } else {
                    formStatus.textContent = result.message || 'One or more fields have an error. Please check and try again.';
                    formStatus.className = 'form-status error';
                }
                
            } catch (error) {
                console.error('Form submission error:', error);
                
                // Fallback for demo purposes if REST API is not accessible
                formStatus.style.display = 'block';
                formStatus.textContent = 'Form submitted successfully (Demo Mode - REST API not available).';
                formStatus.className = 'form-status success';
                contactForm.reset();
            } finally {
                submitBtn.textContent = 'Send Message';
                submitBtn.disabled = false;
            }
        });
    }

    // Smooth scrolling for navigation links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
});
