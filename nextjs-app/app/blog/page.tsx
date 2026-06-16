import { getDb } from '@/lib/db'
import { seedDatabase } from '@/lib/seed'
import Link from 'next/link'
import type { Post, Category } from '@/lib/db'

function getBlogData() {
  const db = getDb()
  seedDatabase()
  const posts = db.prepare(`
    SELECT p.*, c.name as category_name
    FROM posts p LEFT JOIN categories c ON p.category_id = c.id
    WHERE p.published = 1
    ORDER BY p.created_at DESC
  `).all() as (Post & { category_name?: string })[]

  const categories = db.prepare('SELECT * FROM categories').all() as Category[]
  const recent = posts.slice(0, 5)
  return { posts, categories, recent }
}

export default function BlogPage() {
  const { posts, categories, recent } = getBlogData()

  return (
    <div className="section">
      <div className="container">
        {/* Header */}
        <div style={{ textAlign: 'center', marginBottom: '3rem' }}>
          <div className="section-tag">Our Blog</div>
          <h1 className="section-title">Latest <span>Articles</span></h1>
          <p className="section-subtitle" style={{ margin: '0 auto' }}>
            Stay up to date with the latest news, reviews, and guides from our team.
          </p>
        </div>

        <div style={{ display: 'grid', gridTemplateColumns: '1fr 300px', gap: '3rem', alignItems: 'start' }}>
          {/* Posts */}
          <div style={{ display: 'flex', flexDirection: 'column', gap: '2rem' }}>
            {posts.map((post) => (
              <article key={post.id} className="blog-card">
                <div className="blog-image">
                  {post.image
                    ? <img src={post.image} alt={post.title} />
                    : <div style={{ width: '100%', height: '100%', background: 'linear-gradient(135deg, #e8d5ff, #c4b5fd)', display: 'flex', alignItems: 'center', justifyContent: 'center', fontSize: '3rem', minHeight: '200px' }}>📰</div>
                  }
                </div>
                <div className="blog-body">
                  <div className="blog-meta">
                    {post.category_name && <span>📂 {post.category_name}</span>}
                    <span>📅 {new Date(post.created_at).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' })}</span>
                  </div>
                  <h2 className="blog-title">
                    <Link href={`/blog/${post.slug}`}>{post.title}</Link>
                  </h2>
                  {post.excerpt && (
                    <p className="blog-excerpt">{post.excerpt}</p>
                  )}
                  <Link href={`/blog/${post.slug}`} className="btn-outline" style={{ fontSize: '0.8rem', padding: '0.5rem 1.25rem' }}>
                    Read More →
                  </Link>
                </div>
              </article>
            ))}
          </div>

          {/* Sidebar */}
          <aside>
            {/* Search */}
            <div className="shop-sidebar" style={{ marginBottom: '1.5rem' }}>
              <div className="sidebar-widget">
                <h3>Search</h3>
                <form>
                  <input className="form-input" placeholder="Search articles..." />
                  <button type="submit" className="btn-primary" style={{ width: '100%', justifyContent: 'center', marginTop: '0.75rem' }}>
                    Search
                  </button>
                </form>
              </div>

              <div className="sidebar-widget">
                <h3>Recent Posts</h3>
                {recent.map((p) => (
                  <div key={p.id} style={{ borderBottom: '1px solid var(--border)', padding: '0.75rem 0' }}>
                    <Link href={`/blog/${p.slug}`} style={{ fontSize: '0.9rem', fontWeight: '600', color: 'var(--dark)', lineHeight: '1.4' }}>
                      {p.title}
                    </Link>
                    <div style={{ fontSize: '0.75rem', color: 'var(--text-light)', marginTop: '0.25rem' }}>
                      {new Date(p.created_at).toLocaleDateString()}
                    </div>
                  </div>
                ))}
              </div>

              <div className="sidebar-widget">
                <h3>Categories</h3>
                {categories.map((cat) => (
                  <div key={cat.id} className="category-filter-item">
                    <Link href={`/shop?cat=${cat.slug}`} style={{ color: 'inherit' }}>{cat.name}</Link>
                  </div>
                ))}
              </div>
            </div>
          </aside>
        </div>
      </div>
    </div>
  )
}
