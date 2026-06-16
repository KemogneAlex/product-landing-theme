import Link from 'next/link'

export default function AboutPage() {
  return (
    <>
      {/* Hero */}
      <section style={{ background: 'var(--dark)', padding: '5rem 0', textAlign: 'center' }}>
        <div className="container">
          <div className="section-tag">Our Story</div>
          <h1 className="section-title" style={{ color: 'white' }}>
            About <span>Jupi Store</span>
          </h1>
          <p style={{ color: 'rgba(255,255,255,0.7)', maxWidth: '600px', margin: '0 auto', lineHeight: '1.8' }}>
            We're passionate about bringing you the finest products from around the world.
            Founded in 2020, Jupi Store has grown to become a trusted destination for quality shopping.
          </p>
        </div>
      </section>

      {/* Mission */}
      <section className="section">
        <div className="container">
          <div style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '4rem', alignItems: 'center' }}>
            <div>
              <div className="section-tag">Our Mission</div>
              <h2 className="section-title">Quality You Can <span>Trust</span></h2>
              <p style={{ color: 'var(--text)', lineHeight: '1.9', marginBottom: '1.5rem' }}>
                At Jupi Store, we believe everyone deserves access to premium products at fair prices.
                We carefully curate every item in our catalogue, working directly with manufacturers
                and artisans to ensure the highest quality standards.
              </p>
              <p style={{ color: 'var(--text)', lineHeight: '1.9' }}>
                Our team of experts tests every product before it reaches our shelves, so you can shop
                with confidence knowing you're getting the best value for your money.
              </p>
            </div>
            <div style={{
              background: 'linear-gradient(135deg, rgba(138,25,250,0.1), rgba(138,25,250,0.3))',
              height: '400px',
              display: 'flex',
              alignItems: 'center',
              justifyContent: 'center',
              fontSize: '8rem',
              border: '1px solid rgba(138,25,250,0.2)',
            }}>
              🏪
            </div>
          </div>
        </div>
      </section>

      {/* Stats */}
      <section className="section" style={{ background: 'var(--primary)' }}>
        <div className="container">
          <div style={{ display: 'grid', gridTemplateColumns: 'repeat(4, 1fr)', gap: '2rem', textAlign: 'center' }}>
            {[
              { value: '10K+', label: 'Happy Customers' },
              { value: '500+', label: 'Products' },
              { value: '50+', label: 'Brands' },
              { value: '99%', label: 'Satisfaction' },
            ].map((stat) => (
              <div key={stat.label}>
                <div style={{ fontSize: '2.5rem', fontWeight: '700', color: 'white', marginBottom: '0.5rem' }}>{stat.value}</div>
                <div style={{ color: 'rgba(255,255,255,0.8)', fontSize: '0.9rem', textTransform: 'uppercase', letterSpacing: '0.1em' }}>{stat.label}</div>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* Team */}
      <section className="section" style={{ background: 'var(--bg-section)' }}>
        <div className="container">
          <div style={{ textAlign: 'center', marginBottom: '3rem' }}>
            <div className="section-tag">Team</div>
            <h2 className="section-title">Meet Our <span>Team</span></h2>
          </div>
          <div style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fit, minmax(200px, 1fr))', gap: '2rem' }}>
            {[
              { name: 'Sarah Johnson', role: 'CEO & Founder', emoji: '👩‍💼' },
              { name: 'Mike Chen', role: 'Head of Product', emoji: '👨‍💻' },
              { name: 'Emma Davis', role: 'Lead Designer', emoji: '👩‍🎨' },
              { name: 'Tom Wilson', role: 'Customer Success', emoji: '👨‍🤝‍👨' },
            ].map((member) => (
              <div key={member.name} style={{
                background: 'white',
                border: '1px solid var(--border)',
                padding: '2.5rem 1.5rem',
                textAlign: 'center',
              }}>
                <div style={{ fontSize: '3.5rem', marginBottom: '1rem' }}>{member.emoji}</div>
                <h3 style={{ fontSize: '1rem', fontWeight: '700', color: 'var(--dark)', marginBottom: '0.3rem' }}>{member.name}</h3>
                <p style={{ fontSize: '0.85rem', color: 'var(--primary)' }}>{member.role}</p>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* CTA */}
      <section className="section" style={{ background: 'var(--dark)', textAlign: 'center' }}>
        <div className="container">
          <h2 className="section-title" style={{ color: 'white' }}>Ready to <span>Shop?</span></h2>
          <p style={{ color: 'rgba(255,255,255,0.7)', marginBottom: '2rem' }}>
            Discover thousands of quality products with free shipping on orders over $50.
          </p>
          <Link href="/shop" className="btn-primary">Browse Products</Link>
        </div>
      </section>
    </>
  )
}
