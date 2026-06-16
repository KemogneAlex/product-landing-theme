'use client'
import { useState, useEffect } from 'react'
import Link from 'next/link'
import { useCartStore } from '@/lib/cart-store'
import { useParams } from 'next/navigation'

type ProductData = {
  id: number; name: string; slug: string; description: string | null
  price: number; sale_price: number | null; stock: number; images: string
  category_name?: string; category_slug?: string; featured: number
  reviews: { id: number; rating: number; comment: string; author: string; created_at: string }[]
}

function Stars({ rating }: { rating: number }) {
  return (
    <div className="stars">
      {[1,2,3,4,5].map(i => (
        <span key={i} style={{ color: i <= rating ? '#ffc107' : '#ddd', fontSize: '1.1rem' }}>★</span>
      ))}
    </div>
  )
}

export default function ProductPage() {
  const params = useParams()
  const slug = params.slug as string
  const [product, setProduct] = useState<ProductData | null>(null)
  const [activeTab, setActiveTab] = useState('description')
  const [qty, setQty] = useState(1)
  const [activeImg, setActiveImg] = useState(0)
  const [loading, setLoading] = useState(true)
  const addItem = useCartStore((s) => s.addItem)

  useEffect(() => {
    fetch(`/api/products/${slug}`)
      .then(r => r.json())
      .then(d => { setProduct(d); setLoading(false) })
      .catch(() => setLoading(false))
  }, [slug])

  if (loading) return (
    <div className="section" style={{ textAlign: 'center' }}>
      <div style={{ fontSize: '0.9rem', color: 'var(--text)' }}>Loading product...</div>
    </div>
  )

  if (!product) return (
    <div className="section" style={{ textAlign: 'center' }}>
      <div style={{ fontSize: '2rem', marginBottom: '1rem' }}>😕</div>
      <p>Product not found. <Link href="/shop" style={{ color: 'var(--primary)' }}>Back to shop</Link></p>
    </div>
  )

  const imgs = (() => { try { return JSON.parse(product.images) } catch { return [] } })()
  const currentPrice = product.sale_price ?? product.price
  const discount = product.sale_price
    ? Math.round(((product.price - product.sale_price) / product.price) * 100)
    : null
  const avgRating = product.reviews.length
    ? Math.round(product.reviews.reduce((s, r) => s + r.rating, 0) / product.reviews.length)
    : 0

  return (
    <div className="section">
      <div className="container">
        {/* Breadcrumb */}
        <div style={{ marginBottom: '2rem', fontSize: '0.85rem', color: 'var(--text)' }}>
          <Link href="/">Home</Link> › <Link href="/shop">Shop</Link> › {product.name}
        </div>

        {/* Product detail */}
        <div style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '4rem', alignItems: 'start' }}>
          {/* Images */}
          <div>
            <div style={{
              background: 'var(--bg-light)',
              border: '1px solid var(--border)',
              aspectRatio: '1',
              display: 'flex',
              alignItems: 'center',
              justifyContent: 'center',
              marginBottom: '1rem',
              overflow: 'hidden',
            }}>
              {imgs[activeImg] ? (
                <img src={imgs[activeImg]} alt={product.name} style={{ width: '100%', height: '100%', objectFit: 'cover' }} />
              ) : (
                <div className="placeholder-img">🛍️</div>
              )}
            </div>
            {imgs.length > 1 && (
              <div style={{ display: 'flex', gap: '0.5rem' }}>
                {imgs.map((img: string, i: number) => (
                  <button
                    key={i}
                    onClick={() => setActiveImg(i)}
                    style={{
                      width: '70px', height: '70px',
                      border: `2px solid ${i === activeImg ? 'var(--primary)' : 'var(--border)'}`,
                      background: 'none', cursor: 'pointer', overflow: 'hidden', padding: 0,
                    }}
                  >
                    <img src={img} alt="" style={{ width: '100%', height: '100%', objectFit: 'cover' }} />
                  </button>
                ))}
              </div>
            )}
          </div>

          {/* Details */}
          <div>
            {product.category_name && (
              <Link href={`/shop?cat=${product.category_slug}`} className="section-tag">
                {product.category_name}
              </Link>
            )}
            <h1 style={{ fontSize: '2rem', fontWeight: '700', color: 'var(--dark)', margin: '0.5rem 0 1rem' }}>
              {product.name}
            </h1>

            {/* Rating */}
            {product.reviews.length > 0 && (
              <div style={{ display: 'flex', alignItems: 'center', gap: '0.75rem', marginBottom: '1rem' }}>
                <Stars rating={avgRating} />
                <span style={{ fontSize: '0.85rem', color: 'var(--text)' }}>({product.reviews.length} reviews)</span>
              </div>
            )}

            {/* Price */}
            <div style={{ display: 'flex', alignItems: 'center', gap: '1rem', marginBottom: '1.5rem' }}>
              <span style={{ fontSize: '2rem', fontWeight: '700', color: 'var(--primary)' }}>
                ${currentPrice.toFixed(2)}
              </span>
              {product.sale_price && (
                <>
                  <span style={{ fontSize: '1.2rem', color: 'var(--text-light)', textDecoration: 'line-through' }}>
                    ${product.price.toFixed(2)}
                  </span>
                  <span style={{ background: 'var(--primary)', color: 'white', padding: '0.2rem 0.6rem', fontSize: '0.8rem', fontWeight: '700' }}>
                    -{discount}%
                  </span>
                </>
              )}
            </div>

            {product.description && (
              <p style={{ color: 'var(--text)', lineHeight: '1.8', marginBottom: '2rem' }}>
                {product.description}
              </p>
            )}

            {/* Stock */}
            <div style={{ marginBottom: '1.5rem', fontSize: '0.9rem' }}>
              {product.stock > 0 ? (
                <span style={{ color: 'var(--success)' }}>✓ In Stock ({product.stock} available)</span>
              ) : (
                <span style={{ color: 'var(--danger)' }}>✗ Out of Stock</span>
              )}
            </div>

            {/* Qty + Add to cart */}
            <div style={{ display: 'flex', gap: '1rem', alignItems: 'center', marginBottom: '2rem', flexWrap: 'wrap' }}>
              <div style={{ display: 'flex', border: '1px solid var(--border)' }}>
                <button onClick={() => setQty(Math.max(1, qty - 1))} style={{
                  width: '40px', height: '50px', background: 'none', border: 'none', cursor: 'pointer',
                  fontSize: '1.2rem', color: 'var(--text)'
                }}>−</button>
                <input
                  type="number"
                  value={qty}
                  min={1}
                  max={product.stock}
                  onChange={(e) => setQty(Math.max(1, parseInt(e.target.value) || 1))}
                  style={{ width: '60px', textAlign: 'center', border: 'none', fontFamily: 'inherit', fontSize: '1rem' }}
                />
                <button onClick={() => setQty(Math.min(product.stock, qty + 1))} style={{
                  width: '40px', height: '50px', background: 'none', border: 'none', cursor: 'pointer',
                  fontSize: '1.2rem', color: 'var(--text)'
                }}>+</button>
              </div>
              <button
                className="btn-primary"
                style={{ flex: 1 }}
                disabled={product.stock === 0}
                onClick={() => addItem({ id: product.id, name: product.name, slug: product.slug, price: product.price, sale_price: product.sale_price, images: product.images }, qty)}
              >
                Add to Cart
              </button>
            </div>

            {/* Meta */}
            <div style={{ borderTop: '1px solid var(--border)', paddingTop: '1.5rem', fontSize: '0.85rem', color: 'var(--text)' }}>
              <div style={{ marginBottom: '0.4rem' }}>
                <strong style={{ color: 'var(--dark)' }}>SKU:</strong> JUPI-{product.id.toString().padStart(4, '0')}
              </div>
              {product.category_name && (
                <div>
                  <strong style={{ color: 'var(--dark)' }}>Category:</strong> {product.category_name}
                </div>
              )}
            </div>
          </div>
        </div>

        {/* Tabs */}
        <div style={{ marginTop: '4rem' }}>
          <div className="tabs">
            <button className={`tab-btn ${activeTab === 'description' ? 'active' : ''}`} onClick={() => setActiveTab('description')}>
              Description
            </button>
            <button className={`tab-btn ${activeTab === 'reviews' ? 'active' : ''}`} onClick={() => setActiveTab('reviews')}>
              Reviews ({product.reviews.length})
            </button>
          </div>

          {activeTab === 'description' && (
            <div style={{ maxWidth: '700px', lineHeight: '1.8', color: 'var(--text)' }}>
              {product.description || 'No description available for this product.'}
            </div>
          )}

          {activeTab === 'reviews' && (
            <div style={{ maxWidth: '700px' }}>
              {product.reviews.length === 0 ? (
                <p style={{ color: 'var(--text)' }}>No reviews yet. Be the first!</p>
              ) : (
                product.reviews.map((r) => (
                  <div key={r.id} style={{ borderBottom: '1px solid var(--border)', paddingBottom: '1.5rem', marginBottom: '1.5rem' }}>
                    <div style={{ display: 'flex', justifyContent: 'space-between', marginBottom: '0.5rem' }}>
                      <strong style={{ color: 'var(--dark)' }}>{r.author}</strong>
                      <span style={{ fontSize: '0.8rem', color: 'var(--text-light)' }}>{r.created_at.split('T')[0]}</span>
                    </div>
                    <Stars rating={r.rating} />
                    <p style={{ marginTop: '0.5rem', color: 'var(--text)', lineHeight: '1.7' }}>{r.comment}</p>
                  </div>
                ))
              )}
            </div>
          )}
        </div>
      </div>
    </div>
  )
}
