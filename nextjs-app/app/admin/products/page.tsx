import { getDb } from '@/lib/db'
import { seedDatabase } from '@/lib/seed'
import Link from 'next/link'
import type { Product } from '@/lib/db'

function getProducts() {
  const db = getDb()
  seedDatabase()
  return db.prepare(`
    SELECT p.*, c.name as category_name
    FROM products p LEFT JOIN categories c ON p.category_id = c.id
    ORDER BY p.created_at DESC
  `).all() as (Product & { category_name?: string })[]
}

export default function AdminProductsPage() {
  const products = getProducts()

  return (
    <div style={{ display: 'flex', minHeight: '100vh' }}>
      <aside className="admin-sidebar">
        <div style={{ fontSize: '1.4rem', fontWeight: '700', color: 'white', marginBottom: '2.5rem', letterSpacing: '0.1em' }}>
          JU<span style={{ color: 'var(--primary)' }}>PI</span> Admin
        </div>
        <nav>
          {[
            { href: '/admin', label: '📊 Dashboard' },
            { href: '/admin/products', label: '📦 Products' },
            { href: '/admin/orders', label: '🛒 Orders' },
            { href: '/admin/posts', label: '📝 Blog Posts' },
            { href: '/admin/users', label: '👥 Users' },
            { href: '/', label: '← View Site' },
          ].map((l) => (
            <Link key={l.href} href={l.href} style={{ display: 'flex', gap: '0.75rem', color: 'rgba(255,255,255,0.7)', padding: '0.75rem 1rem', marginBottom: '0.25rem', fontSize: '0.9rem' }}>
              {l.label}
            </Link>
          ))}
        </nav>
      </aside>

      <div style={{ flex: 1, padding: '2.5rem', background: 'var(--bg-light)' }}>
        <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: '2rem' }}>
          <h1 style={{ fontSize: '1.5rem', fontWeight: '700', color: 'var(--dark)' }}>Products</h1>
          <Link href="/admin/products/new" className="btn-primary">+ New Product</Link>
        </div>

        <div style={{ background: 'white', border: '1px solid var(--border)' }}>
          <table className="cart-table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Featured</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              {products.map((p) => (
                <tr key={p.id}>
                  <td style={{ color: 'var(--text-light)', fontSize: '0.85rem' }}>#{ p.id}</td>
                  <td>
                    <Link href={`/shop/${p.slug}`} style={{ fontWeight: '600', color: 'var(--dark)' }}>
                      {p.name}
                    </Link>
                  </td>
                  <td style={{ fontSize: '0.85rem', color: 'var(--text)' }}>{p.category_name || '—'}</td>
                  <td>
                    <span style={{ color: 'var(--primary)', fontWeight: '600' }}>${(p.sale_price ?? p.price).toFixed(2)}</span>
                    {p.sale_price && <span style={{ color: 'var(--text-light)', textDecoration: 'line-through', marginLeft: '0.5rem', fontSize: '0.85rem' }}>${p.price.toFixed(2)}</span>}
                  </td>
                  <td>{p.stock}</td>
                  <td>{p.featured ? '⭐' : '—'}</td>
                  <td>
                    <div style={{ display: 'flex', gap: '0.5rem' }}>
                      <Link href={`/admin/products/${p.id}/edit`} style={{ fontSize: '0.8rem', color: 'var(--primary)', fontWeight: '600' }}>Edit</Link>
                      <span style={{ color: 'var(--border)' }}>|</span>
                      <Link href={`/shop/${p.slug}`} style={{ fontSize: '0.8rem', color: 'var(--text)' }}>View</Link>
                    </div>
                  </td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>
      </div>
    </div>
  )
}
