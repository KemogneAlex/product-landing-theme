import type { Metadata } from 'next'
import './globals.css'
import Navbar from '@/components/Navbar'
import Footer from '@/components/Footer'
import Preloader from '@/components/Preloader'
import { getDb } from '@/lib/db'
import { seedDatabase } from '@/lib/seed'

export const metadata: Metadata = {
  title: 'Jupi Store — Premium Online Shop',
  description: 'Discover premium products at Jupi Store. Quality electronics, accessories, clothing and more.',
}

// Initialize DB on first render
if (typeof window === 'undefined') {
  try {
    getDb()
    seedDatabase()
  } catch (e) {
    console.error('DB init error:', e)
  }
}

export default function RootLayout({ children }: { children: React.ReactNode }) {
  return (
    <html lang="en">
      <head>
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossOrigin="anonymous" />
      </head>
      <body>
        <Preloader />
        <Navbar />
        <main style={{ minHeight: '60vh' }}>{children}</main>
        <Footer />
      </body>
    </html>
  )
}
