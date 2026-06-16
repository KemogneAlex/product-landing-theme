import { getDb } from '@/lib/db'
import { seedDatabase } from '@/lib/seed'
import Link from 'next/link'

function getStats() {
  const db = getDb()
  seedDatabase()
  const products = (db.prepare('SELECT COUNT(*) as c FROM products').get() as any).c
  const orders = (db.prepare('SELECT COUNT(*) as c FROM orders').get() as any).c
  const users = (db.prepare('SELECT COUNT(*) as c FROM users').get() as any).c
  const posts = (db.prepare('SELECT COUNT(*) as c FROM posts').get() as any).c
  const revenue = ((db.prepare('SELECT SUM(total) as t FROM orders').get() as any).t || 0) as number
  const recentOrders = db.prepare('SELECT * FROM orders ORDER BY created_at DESC LIMIT 5').all()
  return { products, orders, users, posts, revenue, recentOrders }
}

export default function AdminPage() {
  const { products, orders, users, posts, revenue, recentOrders } = getStats()

  return (
    <div style={{ display: 'flex', minHeight: '100vh' }}>
      {/* Sidebar */}
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
            <Link key={l.href} href={l.href} className="active" style={{ display: 'flex', alignItems: 'center', gap: '0.75rem', color: 'rgba(255,255,255,0.7)', padding: '0.75rem 1rem', marginBottom: '0.25rem', fontSize: '0.9rem', fontWeight: '500', transition: 'all 0.3s', borderLeft: '3px solid transparent' }}>
              {l.label}
            </Link>
          ))}
        </nav>
      </aside>

      {/* Main */}
      <div style={{ flex: 1, padding: '2.5rem', background: 'var(--bg-light)' }}>
        <h1 style={{ fontSize: '1.5rem', fontWeight: '700', color: 'var(--dark)', marginBottom: '2rem' }}>Dashboard</h1>

        {/* Stats */}
        <div style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fit, minmax(200px, 1fr))', gap: '1.5rem', marginBottom: '2.5rem' }}>
          {[
            { label: 'Products', value: products, icon: '📦', link: '/admin/products' },
            { label: 'Orders', value: orders, icon: '🛒', link: '/admin/orders' },
            { label: 'Revenue', value: `$${revenue.toFixed(2)}`, icon: '💰', link: '/admin/orders' },
            { label: 'Users', value: users, icon: '👥', link: '/admin/users' },
            { label: 'Blog Posts', value: posts, icon: '📝', link: '/admin/posts' },
          ].map((stat) => (
            <Link key={stat.label} href={stat.link} style={{
              background: 'white',
              border: '1px solid var(--border)',
              padding: '1.5rem',
              display: 'block',
              transition: 'box-shadow 0.3s',
            }}>
              <div style={{ fontSize: '2rem', marginBottom: '0.5rem' }}>{stat.icon}</div>
              <div style={{ fontSize: '1.75rem', fontWeight: '700', color: 'var(--primary)' }}>{stat.value}</div>
              <div style={{ fontSize: '0.85rem', color: 'var(--text)', textTransform: 'uppercase', letterSpacing: '0.05em' }}>{stat.label}</div>
            </Link>
          ))}
        </div>

        {/* Quick actions */}
        <div style={{ background: 'white', border: '1px solid var(--border)', padding: '1.5rem', marginBottom: '2rem' }}>
          <h3 style={{ fontSize: '1rem', fontWeight: '700', color: 'var(--dark)', marginBottom: '1rem', textTransform: 'uppercase', letterSpacing: '0.05em' }}>
            Quick Actions
          </h3>
          <div style={{ display: 'flex', gap: '1rem', flexWrap: 'wrap' }}>
            <Link href="/admin/products/new" className="btn-primary">+ New Product</Link>
            <Link href="/admin/posts/new" className="btn-outline">+ New Post</Link>
          </div>
        </div>

        {/* Recent Orders */}
        <div style={{ background: 'white', border: '1px solid var(--border)', padding: '1.5rem' }}>
          <h3 style={{ fontSize: '1rem', fontWeight: '700', color: 'var(--dark)', marginBottom: '1.5rem', textTransform: 'uppercase', letterSpacing: '0.05em' }}>
            Recent Orders
          </h3>
          {recentOrders.length === 0 ? (
            <p style={{ color: 'var(--text)', fontSize: '0.9rem' }}>No orders yet.</p>
          ) : (
            <table className="cart-table" style={{ fontSize: '0.9rem' }}>
              <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Total</th>
                  <th>Status</th>
                  <th>Date</th>
                </tr>
              </thead>
              <tbody>
                {recentOrders.map((o: any) => (
                  <tr key={o.id}>
                    <td>#{o.id}</td>
                    <td>{o.name || '—'}</td>
                    <td style={{ color: 'var(--primary)', fontWeight: '600' }}>${o.total.toFixed(2)}</td>
                    <td>
                      <span style={{
                        background: o.status === 'completed' ? 'rgba(40,167,69,0.1)' : 'rgba(255,193,7,0.2)',
                        color: o.status === 'completed' ? '#28a745' : '#856404',
                        padding: '0.2rem 0.6rem',
                        fontSize: '0.75rem',
                        fontWeight: '600',
                        textTransform: 'uppercase',
                      }}>
                        {o.status}
                      </span>
                    </td>
                    <td style={{ color: 'var(--text-light)' }}>{new Date(o.created_at).toLocaleDateString()}</td>
                  </tr>
                ))}
              </tbody>
            </table>
          )}
        </div>
      </div>
    </div>
  )
}
