import { NextResponse } from 'next/server'
import { getDb } from '@/lib/db'
import { seedDatabase } from '@/lib/seed'

export async function GET(req: Request, { params }: { params: Promise<{ slug: string }> }) {
  const { slug } = await params
  const db = getDb()
  seedDatabase()

  const product = db.prepare(`
    SELECT p.*, c.name as category_name, c.slug as category_slug
    FROM products p LEFT JOIN categories c ON p.category_id = c.id
    WHERE p.slug = ?
  `).get(slug)

  if (!product) {
    return NextResponse.json({ error: 'Not found' }, { status: 404 })
  }

  const reviews = db.prepare('SELECT * FROM reviews WHERE product_id = ? ORDER BY created_at DESC').all((product as any).id)

  return NextResponse.json({ ...(product as any), reviews })
}
