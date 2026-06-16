'use client'
import Link from 'next/link'
import { useState } from 'react'
import { useCartStore } from '@/lib/cart-store'

export default function Navbar() {
  const [menuOpen, setMenuOpen] = useState(false)
  const [searchOpen, setSearchOpen] = useState(false)
  const count = useCartStore((s) => s.count())

  const links = [
    { href: '/', label: 'Home' },
    { href: '/shop', label: 'Shop' },
    { href: '/blog', label: 'Blog' },
    { href: '/about', label: 'About' },
    { href: '/contact', label: 'Contact' },
  ]

  return (
    <>
      <nav className="navbar">
        {/* Logo */}
        <Link href="/" className="navbar-logo">
          JU<span>PI</span>
        </Link>

        {/* Links */}
        <ul className="navbar-links">
          {links.map((l) => (
            <li key={l.href}>
              <Link href={l.href}>{l.label}</Link>
            </li>
          ))}
        </ul>

        {/* Actions */}
        <div className="navbar-actions">
          <button
            className="navbar-icon bg-transparent border-none"
            onClick={() => setSearchOpen(true)}
            aria-label="Search"
          >
            <svg width="20" height="20" fill="none" stroke="currentColor" strokeWidth="2" viewBox="0 0 24 24">
              <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
            </svg>
          </button>

          <Link href="/cart" className="navbar-icon" style={{ display: 'flex', alignItems: 'center' }}>
            <svg width="22" height="22" fill="none" stroke="currentColor" strokeWidth="2" viewBox="0 0 24 24">
              <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/>
              <line x1="3" y1="6" x2="21" y2="6"/>
              <path d="M16 10a4 4 0 0 1-8 0"/>
            </svg>
            {count > 0 && <span className="cart-badge">{count}</span>}
          </Link>

          <Link href="/account" className="navbar-icon">
            <svg width="20" height="20" fill="none" stroke="currentColor" strokeWidth="2" viewBox="0 0 24 24">
              <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
              <circle cx="12" cy="7" r="4"/>
            </svg>
          </Link>

          {/* Hamburger */}
          <button
            className="navbar-icon bg-transparent border-none md:hidden"
            onClick={() => setMenuOpen(true)}
            style={{ display: 'none' }}
            aria-label="Menu"
          >
            <svg width="22" height="22" fill="none" stroke="currentColor" strokeWidth="2" viewBox="0 0 24 24">
              <line x1="3" y1="6" x2="21" y2="6"/>
              <line x1="3" y1="12" x2="21" y2="12"/>
              <line x1="3" y1="18" x2="21" y2="18"/>
            </svg>
          </button>
          <button
            className="navbar-icon bg-transparent border-none"
            onClick={() => setMenuOpen(true)}
            aria-label="Menu"
            style={{ display: 'block' }}
          >
            <svg width="22" height="22" fill="none" stroke="currentColor" strokeWidth="2" viewBox="0 0 24 24">
              <line x1="3" y1="6" x2="21" y2="6"/>
              <line x1="3" y1="12" x2="21" y2="12"/>
              <line x1="3" y1="18" x2="21" y2="18"/>
            </svg>
          </button>
        </div>
      </nav>

      {/* Mobile Menu */}
      <div className={`mobile-menu ${menuOpen ? 'open' : ''}`}>
        <button
          onClick={() => setMenuOpen(false)}
          style={{
            position: 'absolute',
            top: '1.5rem',
            right: '1.5rem',
            background: 'none',
            border: 'none',
            color: 'white',
            fontSize: '1.5rem',
            cursor: 'pointer',
          }}
        >
          ✕
        </button>
        <ul>
          {links.map((l) => (
            <li key={l.href}>
              <Link href={l.href} onClick={() => setMenuOpen(false)}>
                {l.label}
              </Link>
            </li>
          ))}
        </ul>
      </div>

      {/* Search Overlay */}
      <div
        className={`search-overlay ${searchOpen ? 'open' : ''}`}
        onClick={(e) => {
          if (e.target === e.currentTarget) setSearchOpen(false)
        }}
      >
        <div className="search-box">
          <form action="/shop" method="get">
            <input
              name="q"
              className="search-input"
              placeholder="Search products..."
              autoFocus={searchOpen}
            />
          </form>
          <p style={{ color: 'rgba(255,255,255,0.4)', marginTop: '0.75rem', fontSize: '0.85rem' }}>
            Press Enter to search · Esc to close
          </p>
        </div>
      </div>
    </>
  )
}
