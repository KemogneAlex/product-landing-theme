import Link from 'next/link'
import { getDb } from '@/lib/db'
import { seedDatabase } from '@/lib/seed'
import ProductCard from '@/components/ProductCard'
import type { Product, Category } from '@/lib/db'

function getHomeData() {
  const db = getDb()
  seedDatabase()
  const featured = db.prepare(`
    SELECT p.*, c.name as category_name, c.slug as category_slug
    FROM products p LEFT JOIN categories c ON p.category_id = c.id
    WHERE p.featured = 1 LIMIT 8
  `).all() as Product[]
  const categories = db.prepare('SELECT * FROM categories').all() as Category[]
  return { featured, categories }
}

export default function HomePage() {
  const { featured, categories } = getHomeData()

  return (
    <>
      {/* HERO */}
      <section className="hero">
        <div className="hero-bg-text">JUPI</div>
        <div className="container" style={{ width: '100%' }}>
          <div style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', alignItems: 'center', gap: '4rem' }}>
            <div className="hero-content">
              <div className="hero-tag">✦ New Collection 2024</div>
              <h1>
                Discover<br />
                <span>Premium</span><br />
                Products
              </h1>
              <p>
                Explore our carefully curated selection of high-quality products.
                From cutting-edge electronics to stylish accessories — find what inspires you.
              </p>
              <div style={{ display: 'flex', gap: '1rem', flexWrap: 'wrap' }}>
                <Link href="/shop" className="btn-primary">Shop Now</Link>
                <Link href="/about" className="btn-outline" style={{ borderColor: 'rgba(255,255,255,0.3)', color: 'rgba(255,255,255,0.8)' }}>
                  Learn More
                </Link>
              </div>
            </div>
            <div style={{ display: 'flex', justifyContent: 'center' }}>
              <div style={{
                width: '400px', height: '400px',
                background: 'radial-gradient(circle at center, rgba(138,25,250,0.3) 0%, transparent 70%)',
                borderRadius: '50%',
                display: 'flex', alignItems: 'center', justifyContent: 'center',
                fontSize: '8rem',
              }}>
                🛍️
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* CATEGORIES */}
      <section className="section" style={{ background: 'var(--bg-section)' }}>
        <div className="container">
          <div style={{ textAlign: 'center', marginBottom: '3rem' }}>
            <div className="section-tag">Collections</div>
            <h2 className="section-title">Shop by <span>Category</span></h2>
          </div>
          <div style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fit, minmax(200px, 1fr))', gap: '1.5rem' }}>
            {categories.map((cat) => (
              <Link
                key={cat.id}
                href={`/shop?cat=${cat.slug}`}
                style={{
                  background: 'white',
                  border: '1px solid var(--border)',
                  padding: '2rem',
                  textAlign: 'center',
                  transition: 'all 0.3s',
                  display: 'block',
                }}
                className="category-card"
              >
                <div style={{ fontSize: '2.5rem', marginBottom: '1rem' }}>
                  {cat.slug === 'electronics' ? '⚡' : cat.slug === 'accessories' ? '👜' : cat.slug === 'clothing' ? '👕' : '🏠'}
                </div>
                <h3 style={{ fontSize: '1rem', fontWeight: '700', color: 'var(--dark)', marginBottom: '0.3rem' }}>
                  {cat.name}
                </h3>
                <p style={{ fontSize: '0.8rem', color: 'var(--text)' }}>{cat.description}</p>
              </Link>
            ))}
          </div>
        </div>
      </section>

      {/* FEATURED PRODUCTS */}
      <section className="section">
        <div className="container">
          <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'flex-end', marginBottom: '3rem', flexWrap: 'wrap', gap: '1rem' }}>
            <div>
              <div className="section-tag">Featured</div>
              <h2 className="section-title">Best <span>Sellers</span></h2>
            </div>
            <Link href="/shop" className="btn-outline">View All</Link>
          </div>
          <div style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fill, minmax(250px, 1fr))', gap: '1.5rem' }}>
            {featured.map((p) => (
              <ProductCard
                key={p.id}
                id={p.id}
                name={p.name}
                slug={p.slug}
                price={p.price}
                sale_price={p.sale_price}
                images={p.images}
                category_name={p.category_name}
              />
            ))}
          </div>
        </div>
      </section>

      {/* PROMO BANNER */}
      <section style={{ background: 'var(--primary)', padding: '5rem 0' }}>
        <div className="container" style={{ textAlign: 'center' }}>
          <div style={{ fontSize: '0.8rem', fontWeight: '700', color: 'rgba(255,255,255,0.7)', textTransform: 'uppercase', letterSpacing: '0.2em', marginBottom: '1rem' }}>
            Limited Time Offer
          </div>
          <h2 style={{ fontSize: '3rem', fontWeight: '700', color: 'white', marginBottom: '1rem' }}>
            Get 20% Off Your First Order
          </h2>
          <p style={{ color: 'rgba(255,255,255,0.8)', marginBottom: '2rem', fontSize: '1.1rem' }}>
            Use code <strong>JUPI20</strong> at checkout
          </p>
          <Link href="/shop" style={{
            background: 'white',
            color: 'var(--primary)',
            padding: '0.9rem 2.5rem',
            fontWeight: '700',
            fontSize: '0.9rem',
            letterSpacing: '0.1em',
            textTransform: 'uppercase',
            display: 'inline-block',
          }}>
            Shop Now
          </Link>
        </div>
      </section>

      {/* WHY CHOOSE US */}
      <section className="section" style={{ background: 'var(--bg-section)' }}>
        <div className="container">
          <div style={{ textAlign: 'center', marginBottom: '3rem' }}>
            <div className="section-tag">Benefits</div>
            <h2 className="section-title">Why <span>Choose Us</span></h2>
          </div>
          <div style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fit, minmax(220px, 1fr))', gap: '2rem' }}>
            {[
              { icon: '🚚', title: 'Free Shipping', desc: 'On all orders over $50. Fast delivery worldwide.' },
              { icon: '↩️', title: 'Easy Returns', desc: '30-day hassle-free return policy.' },
              { icon: '🔒', title: 'Secure Payment', desc: 'Your payment information is always safe.' },
              { icon: '🎧', title: '24/7 Support', desc: 'Expert support team ready to help anytime.' },
            ].map((f) => (
              <div key={f.title} style={{
                background: 'white',
                padding: '2.5rem 1.5rem',
                textAlign: 'center',
                border: '1px solid var(--border)',
              }}>
                <div style={{ fontSize: '2.5rem', marginBottom: '1rem' }}>{f.icon}</div>
                <h3 style={{ fontSize: '1rem', fontWeight: '700', color: 'var(--dark)', marginBottom: '0.5rem' }}>{f.title}</h3>
                <p style={{ fontSize: '0.9rem', color: 'var(--text)' }}>{f.desc}</p>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* NEWSLETTER */}
      <section className="section" style={{ background: 'var(--dark)' }}>
        <div className="container" style={{ textAlign: 'center' }}>
          <h2 className="section-title" style={{ color: 'white' }}>
            Stay <span>Updated</span>
          </h2>
          <p style={{ color: 'rgba(255,255,255,0.6)', marginBottom: '2rem' }}>
            Subscribe to get exclusive deals, new arrivals and more.
          </p>
          <form style={{ display: 'flex', maxWidth: '500px', margin: '0 auto', gap: '0' }}>
            <input
              type="email"
              placeholder="Your email address"
              className="form-input"
              style={{ flex: 1, background: 'rgba(255,255,255,0.05)', color: 'white', border: '1px solid rgba(255,255,255,0.2)' }}
            />
            <button type="submit" className="btn-primary" style={{ borderRadius: 0, whiteSpace: 'nowrap' }}>
              Subscribe
            </button>
          </form>
        </div>
      </section>
    </>
  )
}
