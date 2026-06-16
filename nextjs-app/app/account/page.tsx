'use client'
import { useState } from 'react'
import Link from 'next/link'

export default function AccountPage() {
  const [mode, setMode] = useState<'login' | 'register'>('login')
  const [loading, setLoading] = useState(false)
  const [msg, setMsg] = useState('')

  async function handleSubmit(e: React.FormEvent<HTMLFormElement>) {
    e.preventDefault()
    setLoading(true)
    setMsg('')
    const fd = new FormData(e.currentTarget)
    const data: any = Object.fromEntries(fd)

    const res = await fetch(`/api/auth/${mode}`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(data),
    })
    const json = await res.json()
    setLoading(false)
    if (res.ok) {
      setMsg('✓ ' + (mode === 'login' ? 'Logged in successfully!' : 'Account created! You can now log in.'))
      if (mode === 'register') setMode('login')
    } else {
      setMsg('✗ ' + (json.error || 'Something went wrong'))
    }
  }

  return (
    <div className="section">
      <div className="container">
        <div style={{ maxWidth: '480px', margin: '0 auto' }}>
          <div style={{ textAlign: 'center', marginBottom: '2.5rem' }}>
            <div className="section-tag">Account</div>
            <h1 className="section-title">{mode === 'login' ? 'Welcome Back' : 'Create Account'}</h1>
          </div>

          {/* Toggle */}
          <div style={{ display: 'flex', marginBottom: '2rem', border: '1px solid var(--border)' }}>
            <button
              className={`tab-btn ${mode === 'login' ? 'active' : ''}`}
              onClick={() => { setMode('login'); setMsg('') }}
              style={{ flex: 1, border: 'none' }}
            >Login</button>
            <button
              className={`tab-btn ${mode === 'register' ? 'active' : ''}`}
              onClick={() => { setMode('register'); setMsg('') }}
              style={{ flex: 1, border: 'none' }}
            >Register</button>
          </div>

          {msg && (
            <div style={{
              padding: '0.85rem 1rem',
              marginBottom: '1.5rem',
              background: msg.startsWith('✓') ? 'rgba(40,167,69,0.1)' : 'rgba(220,53,69,0.1)',
              border: `1px solid ${msg.startsWith('✓') ? '#28a745' : '#dc3545'}`,
              color: msg.startsWith('✓') ? '#28a745' : '#dc3545',
              fontSize: '0.9rem',
            }}>
              {msg}
            </div>
          )}

          <form onSubmit={handleSubmit}>
            {mode === 'register' && (
              <div className="form-group">
                <label className="form-label">Full Name</label>
                <input name="name" type="text" className="form-input" required placeholder="Your full name" />
              </div>
            )}
            <div className="form-group">
              <label className="form-label">Email</label>
              <input name="email" type="email" className="form-input" required placeholder="your@email.com" />
            </div>
            <div className="form-group">
              <label className="form-label">Password</label>
              <input name="password" type="password" className="form-input" required placeholder="••••••••" />
            </div>

            <button type="submit" className="btn-primary" style={{ width: '100%', justifyContent: 'center' }} disabled={loading}>
              {loading ? 'Loading...' : mode === 'login' ? 'Sign In' : 'Create Account'}
            </button>
          </form>

          <div style={{ textAlign: 'center', marginTop: '1.5rem', fontSize: '0.9rem', color: 'var(--text)' }}>
            {mode === 'login' ? (
              <>Don't have an account? <button onClick={() => { setMode('register'); setMsg('') }} style={{ background: 'none', border: 'none', color: 'var(--primary)', cursor: 'pointer', fontFamily: 'inherit', fontSize: 'inherit', fontWeight: '600' }}>Register</button></>
            ) : (
              <>Already have an account? <button onClick={() => { setMode('login'); setMsg('') }} style={{ background: 'none', border: 'none', color: 'var(--primary)', cursor: 'pointer', fontFamily: 'inherit', fontSize: 'inherit', fontWeight: '600' }}>Login</button></>
            )}
          </div>
        </div>
      </div>
    </div>
  )
}
