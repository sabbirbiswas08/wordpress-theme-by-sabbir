const WP_URL = 'https://wordpress.sabbirbiswas.com';
const WP_USER = 'admin';
const WP_APP_PASS = 'BJdt LnuE j9Mw HWv1 y0zv CY1U';

async function createPost(title, content, excerpt) {
    console.log(`Creating post: ${title}...`);
    try {
        const response = await fetch(`${WP_URL}/wp-json/wp/v2/posts`, {
            method: 'POST',
            headers: {
                'Authorization': 'Basic ' + Buffer.from(`${WP_USER}:${WP_APP_PASS}`).toString('base64'),
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                title: title,
                content: content,
                excerpt: excerpt,
                status: 'publish'
            })
        });

        const result = await response.json();
        if (response.ok) {
            console.log(`Successfully created post! Link: ${result.link}`);
        } else {
            console.error(`Failed to create post:`, result);
        }
    } catch (error) {
        console.error(`Error:`, error);
    }
}

async function main() {
    await createPost(
        'The Future of AI in Grassroots Advocacy',
        'Artificial intelligence is not just a buzzword; it is a fundamental shift in how we mobilize stakeholders. By analyzing patterns in civic engagement, we can now predict which messages will resonate most with specific demographics...',
        'Discover how AI is revolutionizing the way organizations connect with their supporters and drive legislative change.'
    );
    await createPost(
        'Bridging the Gap: Citizen Intent vs Legislative Action',
        'One of the greatest challenges in modern democracy is the disconnect between what the public wants and what representatives hear. Our mission at CiviClick is to build the digital infrastructure that closes this gap...',
        'Exploring the technological solutions that translate individual passion into collective political pressure.'
    );
}

main();
