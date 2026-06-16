'use client'
import { useState, useEffect } from 'react'
import { useRouter } from 'next/navigation'
import Link from 'next/link'

type Category = { id: number; name: string }

export default function NewProductPage() {
  const router = useRouter()
  const [categories, setCategories] = useState<Category[]>([])
  const [loading, setLoading] = useState(false)
  const [msg, setMsg] = useState('')

  useEffect(() => {
    fetch('/api/admin/categories').then(r => r.json()).then(setCategories)
  }, [])

  async function handleSubmit(e: React.FormEvent<HTMLFormElement>) {
    e.preventDefault()
    setLoading(true)
    const fd = new FormData(e.currentTarget)
    const data: any = Object.fromEntries(fd)
    data.price = parseFloat(data.price)
    data.sale_price = data.sale_price ? parseFloat(data.sale_price) : null
    data.stock = parseInt(data.stock)
    data.featured = data.featured === 'on' ? 1 : 0
    data.images = JSON.stringify(data.images ? data.images.split('\n').map((s: string) => s.trim()).filter(Boolean) : [])

    const res = await fetch('/api/admin/products', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(data),
    })
    const json = await res.json()
    setLoading(false)
    if (res.ok) {
      router.push('/admin/products')
    } else {
      setMsg(json.error || 'Error saving product')
    }
  }

  return (
    <div style={{ display: 'flex', minHeight: '100vh' }}>
      <aside className="admin-sidebar">
        <div style={{ fontSize: '1.4rem', fontWeight: '700', color: 'white', marginBottom: '2.5rem' }}>
          JU<span style={{ color: 'var(--primary)' }}>PI</span> Admin
        </div>
        {['/admin', '/admin/products', '/admin/orders', '/admin/posts', '/'].map((href, i) => (
          <Link key={href} href={href} style={{ display: 'block', color: 'rgba(255,255,255,0.7)', padding: '0.75rem 1rem', marginBottom: '0.25rem', fontSize: '0.9rem' }}>
            {['📊 Dashboard', '📦 Products', '🛒 Orders', '📝 Blog Posts', '← View Site'][i]}
          </Link>
        ))}
      </aside>

      <div style={{ flex: 1, padding: '2.5rem', background: 'var(--bg-light)' }}>
        <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: '2rem' }}>
          <h1 style={{ fontSize: '1.5rem', fontWeight: '700', color: 'var(--dark)' }}>New Product</h1>
          <Link href="/admin/products" className="btn-outline">← Back</Link>
        </div>

        {msg && (
          <div style={{ background: 'rgba(220,53,69,0.1)', border: '1px solid #dc3545', color: '#dc3545', padding: '1rem', marginBottom: '1.5rem', fontSize: '0.9rem' }}>
            {msg}
          </div>
        )}

        <form onSubmit={handleSubmit} style={{ background: 'white', border: '1px solid var(--border)', padding: '2rem', maxWidth: '800px' }}>
          <div style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '1.5rem' }}>
            <div className="form-group" style={{ gridColumn: '1 / -1' }}>
              <label className="form-label">Product Name *</label>
              <input name="name" className="form-input" required placeholder="e.g. Premium Wireless Headphones" />
            </div>

            <div className="form-group">
              <label className="form-label">Price *</label>
              <input name="price" type="number" step="0.01" className="form-input" required placeholder="0.00" />
            </div>

            <div className="form-group">
              <label className="form-label">Sale Price</label>
              <input name="sale_price" type="number" step="0.01" className="form-input" placeholder="0.00 (optional)" />
            </div>

            <div className="form-group">
              <label className="form-label">Stock *</label>
              <input name="stock" type="number" className="form-input" required defaultValue="10" />
            </div>

            <div className="form-group">
              <label className="form-label">Category</label>
              <select name="category_id" className="form-select">
                <option value="">No category</option>
                {categories.map((c) => (
                  <option key={c.id} value={c.id}>{c.name}</option>
                ))}
              </select>
            </div>

            <div className="form-group" style={{ gridColumn: '1 / -1' }}>
              <label className="form-label">Description</label>
              <textarea name="description" className="form-input" rows={4} placeholder="Product description..." style={{ resize: 'vertical' }} />
            </div>

            <div className="form-group" style={{ gridColumn: '1 / -1' }}>
              <label className="form-label">Image URLs (one per line)</label>
              <textarea name="images" className="form-input" rows={3} placeholder="/images/products/photo.jpg" style={{ resize: 'vertical' }} />
            </div>

            <div className="form-group">
              <label style={{ display: 'flex', alignItems: 'center', gap: '0.5rem', cursor: 'pointer', fontSize: '0.9rem', fontWeight: '600', color: 'var(--dark)' }}>
                <input type="checkbox" name="featured" style={{ width: '18px', height: '18px' }} />
                Featured Product
              </label>
            </div>
          </div>

          <button type="submit" className="btn-primary" disabled={loading}>
            {loading ? 'Saving...' : 'Save Product'}
          </button>
        </form>
      </div>
    </div>
  )
}
