import Link from 'next/link'

export default function Footer() {
  return (
    <footer className="footer">
      <div className="container">
        <div style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fit, minmax(200px, 1fr))', gap: '3rem' }}>
          {/* About */}
          <div>
            <div className="footer-logo">JU<span>PI</span></div>
            <p style={{ fontSize: '0.9rem', lineHeight: '1.8', marginBottom: '1.5rem' }}>
              Your premium online store for quality products. Discover the best deals and exclusive collections.
            </p>
            <div style={{ display: 'flex', gap: '0.75rem' }}>
              {['F', 'T', 'I', 'Y'].map((s) => (
                <a key={s} href="#" style={{
                  width: '36px', height: '36px', background: 'rgba(255,255,255,0.1)',
                  display: 'flex', alignItems: 'center', justifyContent: 'center',
                  color: 'rgba(255,255,255,0.7)', fontSize: '0.8rem', fontWeight: '700',
                  transition: 'background 0.3s',
                }}>
                  {s}
                </a>
              ))}
            </div>
          </div>

          {/* Shop */}
          <div>
            <h4>Shop</h4>
            <ul>
              <li><Link href="/shop">All Products</Link></li>
              <li><Link href="/shop?featured=1">Featured</Link></li>
              <li><Link href="/shop?sale=1">Sale Items</Link></li>
              <li><Link href="/shop?cat=electronics">Electronics</Link></li>
              <li><Link href="/shop?cat=accessories">Accessories</Link></li>
            </ul>
          </div>

          {/* Info */}
          <div>
            <h4>Information</h4>
            <ul>
              <li><Link href="/about">About Us</Link></li>
              <li><Link href="/blog">Blog</Link></li>
              <li><Link href="/contact">Contact</Link></li>
              <li><a href="#">Privacy Policy</a></li>
              <li><a href="#">Terms of Service</a></li>
            </ul>
          </div>

          {/* Contact */}
          <div>
            <h4>Contact</h4>
            <ul>
              <li style={{ color: 'rgba(255,255,255,0.6)', fontSize: '0.9rem', marginBottom: '0.6rem' }}>
                📍 123 Main Street, Paris, France
              </li>
              <li style={{ color: 'rgba(255,255,255,0.6)', fontSize: '0.9rem', marginBottom: '0.6rem' }}>
                📧 hello@jupi.store
              </li>
              <li style={{ color: 'rgba(255,255,255,0.6)', fontSize: '0.9rem' }}>
                📞 +33 1 23 45 67 89
              </li>
            </ul>
          </div>
        </div>

        <hr className="footer-divider" />

        <div className="footer-bottom">
          <p style={{ fontSize: '0.85rem', color: 'rgba(255,255,255,0.5)' }}>
            © {new Date().getFullYear()} Jupi Store. All rights reserved.
          </p>
          <div className="payment-logos">
            {['VISA', 'MC', 'PAYPAL', 'STRIPE', 'AMEX'].map((p) => (
              <span key={p} className="payment-logo">{p}</span>
            ))}
          </div>
        </div>
      </div>
    </footer>
  )
}
