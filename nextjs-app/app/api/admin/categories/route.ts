import { NextResponse } from 'next/server'
import { getDb } from '@/lib/db'
import { seedDatabase } from '@/lib/seed'

export async function GET() {
  const db = getDb()
  seedDatabase()
  const categories = db.prepare('SELECT * FROM categories ORDER BY name').all()
  return NextResponse.json(categories)
}
