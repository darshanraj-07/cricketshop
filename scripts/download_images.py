import os
import requests
from PIL import Image
from io import BytesIO

# Create necessary directories
def create_directories():
    dirs = [
        'images/products',
        'images/categories',
        'images/brands',
        'images/banners'
    ]
    for dir in dirs:
        os.makedirs(dir, exist_ok=True)

# Update the product_images dictionary with more cricket equipment URLs
product_images = {
    'bats': [
        ('mrf_genius.webp', 'https://www.mrf.in/content/dam/mrf/products/cricket-bats/genius-limited-edition.webp'),
        ('kookaburra_ghost.jpg', 'https://www.kookaburra.com.au/media/catalog/product/ghost-pro-players.jpg'),
        ('sg_player.jpg', 'https://www.sgcricket.com/wp-content/uploads/2023/04/player-edition.jpg')
    ],
    'balls': [
        ('kookaburra_red.webp', 'https://www.kookaburra.com.au/media/catalog/product/turf-ball-red.webp'),
        ('sg_white.jpg', 'https://www.sgcricket.com/wp-content/uploads/2023/04/white-ball.jpg'),
        ('duke_pink.webp', 'https://www.dukes-cricket.com/wp-content/uploads/2023/pink-ball.webp')
    ],
    'jerseys': [
        ('india_home.webp', 'https://www.nike.com/in/india-cricket-jersey-2024.webp'),
        ('csk_jersey.jpg', 'https://www.chennaisuperkings.com/media/jersey-2024.jpg'),
        ('worldcup_jersey.webp', 'https://shop.icc-cricket.com/wc2023-jersey.webp')
    ],
    'shoes': [
        ('nike_spikes.webp', 'https://www.nike.com/in/cricket-spikes-2024.webp'),
        ('adidas_shoes.jpg', 'https://www.adidas.com/cricket-shoes-2024.jpg'),
        ('puma_bowling.webp', 'https://www.puma.com/cricket-bowling-spikes.webp')
    ]
}

# Add category images
category_images = {
    'bats': 'https://m.media-amazon.com/images/I/71ERy0D3AEL._AC_SL1500_.jpg',
    'balls': 'https://m.media-amazon.com/images/I/61YCRxnJoCL._AC_SL1500_.jpg',
    'protection': 'https://m.media-amazon.com/images/I/71yt3f23yHL._AC_SL1500_.jpg',
}

# Update the download function to handle errors better
def download_image(url, filename):
    try:
        response = requests.get(url, timeout=10)
        response.raise_for_status()  # Raise an error for bad status codes
        
        img = Image.open(BytesIO(response.content))
        # Convert RGBA to RGB if needed
        if img.mode in ('RGBA', 'LA'):
            background = Image.new('RGB', img.size, (255, 255, 255))
            background.paste(img, mask=img.split()[-1])
            img = background
        
        img.save(filename, 'JPEG', quality=85)
        print(f"Successfully downloaded: {filename}")
        return True
    except Exception as e:
        print(f"Error downloading {url}: {e}")
        return False

# Download category images
for category, url in category_images.items():
    filename = f"images/categories/{category}.jpg"
    download_image(url, filename)

# Create category folders
for category in product_images.keys():
    os.makedirs(f'images/products/{category}', exist_ok=True)

# Download images
for category, images in product_images.items():
    for filename, url in images:
        filepath = f'images/products/{category}/{filename}'
        download_image(url, filepath) 