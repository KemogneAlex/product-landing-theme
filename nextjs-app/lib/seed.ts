import { getDb } from './db'

export function seedDatabase() {
  const db = getDb()

  // Check if already seeded
  const count = (db.prepare('SELECT COUNT(*) as c FROM products').get() as any).c
  if (count > 0) return

  // Categories
  const insertCat = db.prepare(
    'INSERT OR IGNORE INTO categories (name, slug, description) VALUES (?, ?, ?)'
  )
  insertCat.run('Electronics', 'electronics', 'Latest electronic gadgets')
  insertCat.run('Accessories', 'accessories', 'Premium accessories')
  insertCat.run('Clothing', 'clothing', 'Fashion and style')
  insertCat.run('Home & Living', 'home-living', 'Home decor and furniture')

  // Products
  const insertProd = db.prepare(`
    INSERT OR IGNORE INTO products (name, slug, description, price, sale_price, stock, images, category_id, featured)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
  `)

  const products = [
    {
      name: 'Premium Wireless Headphones',
      slug: 'premium-wireless-headphones',
      desc: 'High-quality wireless headphones with noise cancellation and 30-hour battery life.',
      price: 149.99,
      sale: 119.99,
      stock: 25,
      images: JSON.stringify(['/images/products/headphones.jpg']),
      cat: 1,
      featured: 1,
    },
    {
      name: 'Smart Watch Pro',
      slug: 'smart-watch-pro',
      desc: 'Advanced smartwatch with health monitoring, GPS, and 7-day battery.',
      price: 299.99,
      sale: null,
      stock: 15,
      images: JSON.stringify(['/images/products/smartwatch.jpg']),
      cat: 1,
      featured: 1,
    },
    {
      name: 'Leather Laptop Bag',
      slug: 'leather-laptop-bag',
      desc: 'Premium genuine leather laptop bag, fits up to 15.6 inch laptops.',
      price: 89.99,
      sale: 69.99,
      stock: 30,
      images: JSON.stringify(['/images/products/laptop-bag.jpg']),
      cat: 2,
      featured: 0,
    },
    {
      name: 'Mechanical Keyboard',
      slug: 'mechanical-keyboard',
      desc: 'Compact TKL mechanical keyboard with RGB backlight and Cherry MX switches.',
      price: 129.99,
      sale: null,
      stock: 20,
      images: JSON.stringify(['/images/products/keyboard.jpg']),
      cat: 1,
      featured: 1,
    },
    {
      name: 'Minimalist Sneakers',
      slug: 'minimalist-sneakers',
      desc: 'Clean and comfortable everyday sneakers in premium canvas.',
      price: 79.99,
      sale: 59.99,
      stock: 50,
      images: JSON.stringify(['/images/products/sneakers.jpg']),
      cat: 3,
      featured: 0,
    },
    {
      name: 'Wireless Charging Pad',
      slug: 'wireless-charging-pad',
      desc: 'Fast 15W wireless charging pad compatible with all Qi devices.',
      price: 39.99,
      sale: null,
      stock: 40,
      images: JSON.stringify(['/images/products/charger.jpg']),
      cat: 2,
      featured: 0,
    },
    {
      name: 'Bluetooth Speaker',
      slug: 'bluetooth-speaker',
      desc: '360° sound portable speaker with 20-hour playtime and waterproof design.',
      price: 99.99,
      sale: 79.99,
      stock: 18,
      images: JSON.stringify(['/images/products/speaker.jpg']),
      cat: 1,
      featured: 1,
    },
    {
      name: 'Ceramic Coffee Mug Set',
      slug: 'ceramic-coffee-mug-set',
      desc: 'Set of 4 handcrafted ceramic mugs, microwave and dishwasher safe.',
      price: 34.99,
      sale: null,
      stock: 60,
      images: JSON.stringify(['/images/products/mugs.jpg']),
      cat: 4,
      featured: 0,
    },
  ]

  for (const p of products) {
    insertProd.run(p.name, p.slug, p.desc, p.price, p.sale, p.stock, p.images, p.cat, p.featured)
  }

  // Reviews
  const insertReview = db.prepare(
    'INSERT INTO reviews (rating, comment, author, product_id) VALUES (?, ?, ?, ?)'
  )
  insertReview.run(5, 'Absolutely love these headphones! Sound quality is incredible.', 'Sarah M.', 1)
  insertReview.run(4, 'Great product, fast delivery. Highly recommended!', 'John D.', 1)
  insertReview.run(5, 'Best smartwatch I\'ve ever owned. The GPS is super accurate.', 'Mike T.', 2)
  insertReview.run(5, 'Beautiful bag, perfect for work. Very professional look.', 'Emma L.', 3)

  // Blog posts
  const insertPost = db.prepare(`
    INSERT OR IGNORE INTO posts (title, slug, content, excerpt, image, category_id, tags)
    VALUES (?, ?, ?, ?, ?, ?, ?)
  `)

  insertPost.run(
    'Top 10 Tech Gadgets of 2024',
    'top-10-tech-gadgets-2024',
    `<p>Technology keeps evolving at a rapid pace, and 2024 has brought us some truly remarkable gadgets that are changing the way we live and work.</p>
    <h2>1. AI-Powered Earbuds</h2>
    <p>The latest generation of earbuds now feature real-time translation and noise cancellation powered by on-device AI chips.</p>
    <h2>2. Foldable Smartphones</h2>
    <p>Foldable phones have matured significantly, with improved durability and thinner profiles making them mainstream.</p>
    <p>Whether you're a tech enthusiast or just looking to upgrade your daily carry, 2024 has something exciting for everyone.</p>`,
    'Discover the most innovative tech gadgets that defined 2024 and changed how we interact with technology.',
    '/images/blog/tech-gadgets.jpg',
    1,
    JSON.stringify(['tech', 'gadgets', 'review'])
  )

  insertPost.run(
    'How to Choose the Right Laptop Bag',
    'how-to-choose-laptop-bag',
    `<p>Choosing the perfect laptop bag is more than just finding something that fits your laptop. It's about finding a companion for your daily commute.</p>
    <h2>Consider the Material</h2>
    <p>Leather bags are premium and durable. Canvas bags are lightweight and casual. Nylon bags are waterproof and practical.</p>
    <h2>Check the Padding</h2>
    <p>Always ensure your bag has adequate padding to protect your device from bumps and drops.</p>`,
    'A comprehensive guide to selecting the perfect laptop bag for your lifestyle and work needs.',
    '/images/blog/laptop-bag-guide.jpg',
    2,
    JSON.stringify(['accessories', 'guide', 'laptop'])
  )

  insertPost.run(
    'The Future of Wireless Audio',
    'future-of-wireless-audio',
    `<p>Wireless audio technology has come a long way from the choppy Bluetooth connections of the early 2010s.</p>
    <h2>Lossless Wireless Audio</h2>
    <p>New codecs like LC3 and aptX Lossless are bringing CD-quality audio to wireless headphones.</p>
    <h2>Spatial Audio</h2>
    <p>Spatial audio is creating immersive 3D soundscapes that make you feel like you're in the room with the musicians.</p>`,
    'Exploring the cutting-edge technologies shaping the next generation of wireless audio experiences.',
    '/images/blog/wireless-audio.jpg',
    1,
    JSON.stringify(['audio', 'technology', 'wireless'])
  )

  // Admin user
  const insertUser = db.prepare(
    'INSERT OR IGNORE INTO users (name, email, password, role) VALUES (?, ?, ?, ?)'
  )
  // password: admin123 (hashed below — using a pre-hashed value for seed)
  insertUser.run('Admin', 'admin@jupi.com', '$2b$10$rBnqB.BfI6ZpWKJb/MbqMeDQ0YJZ3TzGhSWFEjXFNR8qU2YnMYi0i', 'admin')

  console.log('✅ Database seeded')
}
