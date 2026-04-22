const fs = require('fs');
const path = require('path');

const WP_URL = 'https://wordpress.sabbirbiswas.com';
const WP_USER = 'admin';
const WP_APP_PASS = 'BJdt LnuE j9Mw HWv1 y0zv CY1U';

async function uploadMedia(filePath) {
    if (!fs.existsSync(filePath)) {
        console.error(`File not found: ${filePath}`);
        process.exit(1);
    }

    const fileName = path.basename(filePath);
    const fileBuffer = fs.readFileSync(filePath);
    
    // Determine mime type
    const ext = path.extname(fileName).toLowerCase();
    let mimeType = 'image/jpeg';
    if (ext === '.png') mimeType = 'image/png';
    if (ext === '.webp') mimeType = 'image/webp';
    if (ext === '.gif') mimeType = 'image/gif';

    console.log(`Uploading ${fileName} to ${WP_URL}...`);

    try {
        const response = await fetch(`${WP_URL}/wp-json/wp/v2/media`, {
            method: 'POST',
            headers: {
                'Authorization': 'Basic ' + Buffer.from(`${WP_USER}:${WP_APP_PASS}`).toString('base64'),
                'Content-Disposition': `attachment; filename="${fileName}"`,
                'Content-Type': mimeType
            },
            body: fileBuffer
        });

        const result = await response.json();

        if (response.ok) {
            console.log('Successfully uploaded!');
            console.log('Image ID:', result.id);
            console.log('Image URL:', result.source_url);
            return result.source_url;
        } else {
            console.error('Upload failed:', result.message || result);
            process.exit(1);
        }
    } catch (error) {
        console.error('Error during upload:', error);
        process.exit(1);
    }
}

const targetFile = process.argv[2];
if (!targetFile) {
    console.log('Usage: node wp-media-upload.js <path-to-file>');
    process.exit(1);
}

uploadMedia(targetFile);
