import { NextResponse } from 'next/server'
import { getDb } from '@/lib/db'

function slugify(text: string) {
  return text.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, '')
}

export async function GET() {
  const db = getDb()
  const products = db.prepare(`
    SELECT p.*, c.name as category_name
    FROM products p LEFT JOIN categories c ON p.category_id = c.id
    ORDER BY p.created_at DESC
  `).all()
  return NextResponse.json(products)
}

export async function POST(req: Request) {
  const data = await req.json()
  const { name, description, price, sale_price, stock, images, category_id, featured } = data

  if (!name || !price) {
    return NextResponse.json({ error: 'Name and price required' }, { status: 400 })
  }

  const db = getDb()
  let slug = slugify(name)
  const existing = db.prepare('SELECT id FROM products WHERE slug = ?').get(slug)
  if (existing) slug = slug + '-' + Date.now()

  db.prepare(`
    INSERT INTO products (name, slug, description, price, sale_price, stock, images, category_id, featured)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
  `).run(slug, name, description || null, price, sale_price || null, stock || 10, images || '[]', category_id || null, featured || 0)

  return NextResponse.json({ message: 'Product created', slug })
}
