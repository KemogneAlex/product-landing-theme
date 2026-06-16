import { getDb } from '@/lib/db'
import { seedDatabase } from '@/lib/seed'
import Link from 'next/link'
import { notFound } from 'next/navigation'
import type { Post } from '@/lib/db'

export default async function BlogPostPage({ params }: { params: Promise<{ slug: string }> }) {
  const { slug } = await params
  const db = getDb()
  seedDatabase()

  const post = db.prepare(`
    SELECT p.*, c.name as category_name
    FROM posts p LEFT JOIN categories c ON p.category_id = c.id
    WHERE p.slug = ? AND p.published = 1
  `).get(slug) as (Post & { category_name?: string }) | undefined

  if (!post) notFound()

  const recent = db.prepare(`
    SELECT id, title, slug, created_at, image FROM posts WHERE published = 1 AND slug != ? LIMIT 4
  `).all(slug) as Post[]

  const tags: string[] = (() => { try { return JSON.parse(post.tags || '[]') } catch { return [] } })()

  return (
    <div className="section">
      <div className="container">
        <div style={{ display: 'grid', gridTemplateColumns: '1fr 280px', gap: '3rem', alignItems: 'start' }}>
          <article>
            {/* Breadcrumb */}
            <div style={{ marginBottom: '2rem', fontSize: '0.85rem', color: 'var(--text)' }}>
              <Link href="/">Home</Link> › <Link href="/blog">Blog</Link> › {post.title}
            </div>

            {/* Header */}
            <div className="section-tag">{post.category_name || 'Article'}</div>
            <h1 style={{ fontSize: '2.5rem', fontWeight: '700', color: 'var(--dark)', margin: '0.5rem 0 1rem', lineHeight: '1.3' }}>
              {post.title}
            </h1>
            <div style={{ fontSize: '0.85rem', color: 'var(--text-light)', marginBottom: '2rem' }}>
              📅 {new Date(post.created_at).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' })}
            </div>

            {/* Featured image */}
            {post.image && (
              <div style={{ marginBottom: '2rem', borderRadius: '2px', overflow: 'hidden', aspectRatio: '16/9', background: 'var(--bg-light)' }}>
                <img src={post.image} alt={post.title} style={{ width: '100%', height: '100%', objectFit: 'cover' }} />
              </div>
            )}

            {/* Content */}
            <div
              style={{ lineHeight: '1.9', color: 'var(--text)', fontSize: '1rem' }}
              dangerouslySetInnerHTML={{ __html: post.content }}
            />

            {/* Tags */}
            {tags.length > 0 && (
              <div style={{ marginTop: '2rem', display: 'flex', gap: '0.5rem', flexWrap: 'wrap' }}>
                <span style={{ fontSize: '0.85rem', color: 'var(--text)', fontWeight: '600' }}>Tags:</span>
                {tags.map((tag) => (
                  <span key={tag} style={{
                    background: 'var(--bg-light)', border: '1px solid var(--border)',
                    padding: '0.2rem 0.75rem', fontSize: '0.8rem', color: 'var(--text)',
                  }}>
                    #{tag}
                  </span>
                ))}
              </div>
            )}

            <div style={{ marginTop: '2rem' }}>
              <Link href="/blog" className="btn-outline">← Back to Blog</Link>
            </div>
          </article>

          {/* Sidebar */}
          <aside>
            <div className="shop-sidebar">
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
            </div>
          </aside>
        </div>
      </div>
    </div>
  )
}
