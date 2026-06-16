'use client'
import Link from 'next/link'
import { useCartStore } from '@/lib/cart-store'
import { useState } from 'react'

type Props = {
  id: number
  name: string
  slug: string
  price: number
  sale_price?: number | null
  images: string
  category_name?: string
}

export default function ProductCard({ id, name, slug, price, sale_price, images, category_name }: Props) {
  const addItem = useCartStore((s) => s.addItem)
  const [added, setAdded] = useState(false)

  const imgs = (() => {
    try { return JSON.parse(images) } catch { return [] }
  })()
  const thumb = imgs[0] || null
  const discount = sale_price ? Math.round(((price - sale_price) / price) * 100) : null

  function handleAdd(e: React.MouseEvent) {
    e.preventDefault()
    addItem({ id, name, slug, price, sale_price: sale_price ?? null, images })
    setAdded(true)
    setTimeout(() => setAdded(false), 1500)
  }

  return (
    <div className="product-card">
      <Link href={`/shop/${slug}`}>
        <div className="image-wrap">
          {discount && <span className="sale-badge">-{discount}%</span>}
          {thumb ? (
            <img src={thumb} alt={name} />
          ) : (
            <div className="placeholder-img">🛍️</div>
          )}
          <div className="card-actions">
            <button className="card-action-btn" title="Quick view">
              <svg width="16" height="16" fill="none" stroke="currentColor" strokeWidth="2" viewBox="0 0 24 24">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
              </svg>
            </button>
            <button className="card-action-btn" title="Wishlist">
              <svg width="16" height="16" fill="none" stroke="currentColor" strokeWidth="2" viewBox="0 0 24 24">
                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
              </svg>
            </button>
          </div>
        </div>
        <div className="card-body">
          {category_name && <div className="category-label">{category_name}</div>}
          <div className="product-name">{name}</div>
          <div className="price-wrap">
            <span className="price">${(sale_price ?? price).toFixed(2)}</span>
            {sale_price && <span className="price-old">${price.toFixed(2)}</span>}
          </div>
        </div>
      </Link>
      <div style={{ padding: '0 1.25rem 1.25rem' }}>
        <button className="btn-primary" style={{ width: '100%', justifyContent: 'center' }} onClick={handleAdd}>
          {added ? '✓ Added!' : 'Add to Cart'}
        </button>
      </div>
    </div>
  )
}
