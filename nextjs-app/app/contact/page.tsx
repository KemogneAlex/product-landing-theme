'use client'
import { useState } from 'react'

export default function ContactPage() {
  const [sent, setSent] = useState(false)

  return (
    <>
      <section style={{ background: 'var(--dark)', padding: '4rem 0', textAlign: 'center' }}>
        <div className="container">
          <div className="section-tag">Get in Touch</div>
          <h1 className="section-title" style={{ color: 'white' }}>Contact <span>Us</span></h1>
        </div>
      </section>

      <section className="section">
        <div className="container">
          <div style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '4rem', alignItems: 'start' }}>
            {/* Info */}
            <div>
              <h2 style={{ fontSize: '1.5rem', fontWeight: '700', color: 'var(--dark)', marginBottom: '1.5rem' }}>
                We'd love to hear from you
              </h2>
              <p style={{ color: 'var(--text)', lineHeight: '1.9', marginBottom: '2rem' }}>
                Have a question about an order? Need help choosing the right product?
                Our team is here to help. Reach out through any of the channels below.
              </p>

              {[
                { icon: '📍', label: 'Address', value: '123 Main Street, Paris, France 75001' },
                { icon: '📧', label: 'Email', value: 'hello@jupi.store' },
                { icon: '📞', label: 'Phone', value: '+33 1 23 45 67 89' },
                { icon: '🕐', label: 'Hours', value: 'Mon-Fri: 9am – 6pm CET' },
              ].map((item) => (
                <div key={item.label} style={{ display: 'flex', gap: '1rem', marginBottom: '1.25rem' }}>
                  <span style={{ fontSize: '1.5rem' }}>{item.icon}</span>
                  <div>
                    <div style={{ fontWeight: '700', color: 'var(--dark)', fontSize: '0.9rem', textTransform: 'uppercase', letterSpacing: '0.05em', marginBottom: '0.2rem' }}>
                      {item.label}
                    </div>
                    <div style={{ color: 'var(--text)', fontSize: '0.95rem' }}>{item.value}</div>
                  </div>
                </div>
              ))}
            </div>

            {/* Form */}
            <div style={{ background: 'var(--bg-light)', padding: '2rem', border: '1px solid var(--border)' }}>
              {sent ? (
                <div style={{ textAlign: 'center', padding: '2rem' }}>
                  <div style={{ fontSize: '3rem', marginBottom: '1rem' }}>✉️</div>
                  <h3 style={{ color: 'var(--dark)', marginBottom: '0.5rem' }}>Message Sent!</h3>
                  <p style={{ color: 'var(--text)' }}>We'll get back to you within 24 hours.</p>
                </div>
              ) : (
                <form onSubmit={(e) => { e.preventDefault(); setSent(true) }}>
                  <div className="form-group">
                    <label className="form-label">Your Name</label>
                    <input className="form-input" required placeholder="John Doe" />
                  </div>
                  <div className="form-group">
                    <label className="form-label">Email</label>
                    <input type="email" className="form-input" required placeholder="your@email.com" />
                  </div>
                  <div className="form-group">
                    <label className="form-label">Subject</label>
                    <input className="form-input" placeholder="How can we help?" />
                  </div>
                  <div className="form-group">
                    <label className="form-label">Message</label>
                    <textarea className="form-input" rows={5} required placeholder="Tell us more..." style={{ resize: 'vertical' }} />
                  </div>
                  <button type="submit" className="btn-primary" style={{ width: '100%', justifyContent: 'center' }}>
                    Send Message
                  </button>
                </form>
              )}
            </div>
          </div>
        </div>
      </section>
    </>
  )
}
