import { getDb } from '@/lib/db'
import { seedDatabase } from '@/lib/seed'
import ProductCard from '@/components/ProductCard'
import Link from 'next/link'
import type { Product, Category } from '@/lib/db'

type SearchParams = { cat?: string; q?: string; sort?: string; page?: string; featured?: string; sale?: string }

function getShopData(sp: SearchParams) {
  const db = getDb()
  seedDatabase()

  const page = parseInt(sp.page || '1')
  const perPage = 12
  const offset = (page - 1) * perPage

  let where = 'WHERE 1=1'
  const params: any[] = []

  if (sp.cat) {
    where += ' AND c.slug = ?'
    params.push(sp.cat)
  }
  if (sp.q) {
    where += ' AND (p.name LIKE ? OR p.description LIKE ?)'
    params.push(`%${sp.q}%`, `%${sp.q}%`)
  }
  if (sp.featured === '1') {
    where += ' AND p.featured = 1'
  }
  if (sp.sale === '1') {
    where += ' AND p.sale_price IS NOT NULL'
  }

  const orderMap: Record<string, string> = {
    'price-asc': 'COALESCE(p.sale_price, p.price) ASC',
    'price-desc': 'COALESCE(p.sale_price, p.price) DESC',
    'newest': 'p.created_at DESC',
    'name': 'p.name ASC',
  }
  const orderBy = orderMap[sp.sort || 'newest'] || 'p.created_at DESC'

  const products = db.prepare(`
    SELECT p.*, c.name as category_name, c.slug as category_slug
    FROM products p LEFT JOIN categories c ON p.category_id = c.id
    ${where}
    ORDER BY ${orderBy}
    LIMIT ? OFFSET ?
  `).all(...params, perPage, offset) as Product[]

  const total = (db.prepare(`
    SELECT COUNT(*) as c FROM products p LEFT JOIN categories c ON p.category_id = c.id ${where}
  `).get(...params) as any).c

  const categories = db.prepare('SELECT *, (SELECT COUNT(*) FROM products WHERE category_id = categories.id) as pcount FROM categories').all() as (Category & { pcount: number })[]

  return { products, categories, total, page, perPage, totalPages: Math.ceil(total / perPage) }
}

export default async function ShopPage({ searchParams }: { searchParams: Promise<SearchParams> }) {
  const sp = await searchParams
  const { products, categories, total, page, totalPages } = getShopData(sp)

  return (
    <div className="section">
      <div className="container">
        {/* Breadcrumb */}
        <div style={{ marginBottom: '2rem', fontSize: '0.85rem', color: 'var(--text)' }}>
          <Link href="/">Home</Link> › Shop
          {sp.cat && <> › {categories.find(c => c.slug === sp.cat)?.name}</>}
        </div>

        <div style={{ display: 'grid', gridTemplateColumns: '260px 1fr', gap: '2rem', alignItems: 'start' }}>
          {/* SIDEBAR */}
          <aside>
            <div className="shop-sidebar">
              {/* Search */}
              <div className="sidebar-widget">
                <h3>Search</h3>
                <form method="get" action="/shop">
                  <input name="q" defaultValue={sp.q} className="form-input" placeholder="Search products..." />
                  <button type="submit" className="btn-primary" style={{ width: '100%', justifyContent: 'center', marginTop: '0.75rem' }}>
                    Search
                  </button>
                </form>
              </div>

              {/* Categories */}
              <div className="sidebar-widget">
                <h3>Categories</h3>
                <div>
                  <Link href="/shop" className={`category-filter-item ${!sp.cat ? 'active' : ''}`} style={{ display: 'flex' }}>
                    <span>All Products</span>
                    <span className="category-count">{total}</span>
                  </Link>
                  {categories.map((cat) => (
                    <Link
                      key={cat.id}
                      href={`/shop?cat=${cat.slug}`}
                      className={`category-filter-item ${sp.cat === cat.slug ? 'active' : ''}`}
                      style={{ display: 'flex' }}
                    >
                      <span>{cat.name}</span>
                      <span className="category-count">{cat.pcount}</span>
                    </Link>
                  ))}
                </div>
              </div>

              {/* Filter buttons */}
              <div className="sidebar-widget">
                <h3>Filter</h3>
                <div style={{ display: 'flex', flexDirection: 'column', gap: '0.5rem' }}>
                  <Link href="/shop?featured=1" className={`category-filter-item ${sp.featured === '1' ? 'active' : ''}`} style={{ display: 'flex', border: '1px solid var(--border)', padding: '0.5rem 0.75rem' }}>
                    ⭐ Featured
                  </Link>
                  <Link href="/shop?sale=1" className={`category-filter-item ${sp.sale === '1' ? 'active' : ''}`} style={{ display: 'flex', border: '1px solid var(--border)', padding: '0.5rem 0.75rem' }}>
                    🏷️ On Sale
                  </Link>
                </div>
              </div>
            </div>
          </aside>

          {/* MAIN */}
          <div>
            {/* Toolbar */}
            <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: '1.5rem', flexWrap: 'wrap', gap: '1rem' }}>
              <p style={{ fontSize: '0.9rem', color: 'var(--text)' }}>
                Showing <strong>{products.length}</strong> of <strong>{total}</strong> products
              </p>
              <form method="get" action="/shop" style={{ display: 'flex', alignItems: 'center', gap: '0.5rem' }}>
                {sp.cat && <input type="hidden" name="cat" value={sp.cat} />}
                {sp.q && <input type="hidden" name="q" value={sp.q} />}
                <label style={{ fontSize: '0.85rem', color: 'var(--text)' }}>Sort by:</label>
                <select name="sort" defaultValue={sp.sort || 'newest'} className="form-select" style={{ width: 'auto' }} onChange="this.form.submit()">
                  <option value="newest">Newest</option>
                  <option value="price-asc">Price: Low → High</option>
                  <option value="price-desc">Price: High → Low</option>
                  <option value="name">Name A-Z</option>
                </select>
                <button type="submit" className="btn-primary" style={{ padding: '0.6rem 1rem' }}>Go</button>
              </form>
            </div>

            {/* Grid */}
            {products.length === 0 ? (
              <div style={{ textAlign: 'center', padding: '4rem', color: 'var(--text)' }}>
                <div style={{ fontSize: '3rem', marginBottom: '1rem' }}>🔍</div>
                <p>No products found. <Link href="/shop" style={{ color: 'var(--primary)' }}>Clear filters</Link></p>
              </div>
            ) : (
              <div style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fill, minmax(220px, 1fr))', gap: '1.5rem' }}>
                {products.map((p) => (
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
            )}

            {/* Pagination */}
            {totalPages > 1 && (
              <div className="pagination">
                {page > 1 && (
                  <Link href={`/shop?page=${page - 1}${sp.cat ? `&cat=${sp.cat}` : ''}`} className="page-btn">←</Link>
                )}
                {Array.from({ length: totalPages }, (_, i) => i + 1).map((p) => (
                  <Link
                    key={p}
                    href={`/shop?page=${p}${sp.cat ? `&cat=${sp.cat}` : ''}`}
                    className={`page-btn ${p === page ? 'active' : ''}`}
                  >
                    {p}
                  </Link>
                ))}
                {page < totalPages && (
                  <Link href={`/shop?page=${page + 1}${sp.cat ? `&cat=${sp.cat}` : ''}`} className="page-btn">→</Link>
                )}
              </div>
            )}
          </div>
        </div>
      </div>
    </div>
  )
}
