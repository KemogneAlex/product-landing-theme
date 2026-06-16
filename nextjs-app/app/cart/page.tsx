'use client'
import Link from 'next/link'
import { useCartStore } from '@/lib/cart-store'

export default function CartPage() {
  const { items, removeItem, updateQty, total, count } = useCartStore()
  const cartTotal = total()
  const cartCount = count()

  if (cartCount === 0) {
    return (
      <div className="section" style={{ textAlign: 'center' }}>
        <div style={{ fontSize: '4rem', marginBottom: '1.5rem' }}>🛒</div>
        <h2 style={{ fontSize: '1.5rem', fontWeight: '700', color: 'var(--dark)', marginBottom: '1rem' }}>
          Your cart is empty
        </h2>
        <p style={{ color: 'var(--text)', marginBottom: '2rem' }}>
          Looks like you haven't added anything yet.
        </p>
        <Link href="/shop" className="btn-primary">Start Shopping</Link>
      </div>
    )
  }

  const shipping = cartTotal >= 50 ? 0 : 9.99

  return (
    <div className="section">
      <div className="container">
        <h1 style={{ fontSize: '2rem', fontWeight: '700', color: 'var(--dark)', marginBottom: '2rem' }}>
          Shopping Cart
        </h1>

        <div style={{ display: 'grid', gridTemplateColumns: '1fr 340px', gap: '2rem', alignItems: 'start' }}>
          {/* Cart items */}
          <div>
            <table className="cart-table">
              <thead>
                <tr>
                  <th>Product</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th>Total</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                {items.map(({ product, quantity }) => {
                  const price = product.sale_price ?? product.price
                  const imgs = (() => { try { return JSON.parse(product.images) } catch { return [] } })()

                  return (
                    <tr key={product.id}>
                      <td>
                        <div style={{ display: 'flex', alignItems: 'center', gap: '1rem' }}>
                          <div style={{
                            width: '70px', height: '70px', background: 'var(--bg-light)',
                            border: '1px solid var(--border)', flexShrink: 0, overflow: 'hidden',
                            display: 'flex', alignItems: 'center', justifyContent: 'center',
                          }}>
                            {imgs[0]
                              ? <img src={imgs[0]} alt={product.name} style={{ width: '100%', height: '100%', objectFit: 'cover' }} />
                              : <span style={{ fontSize: '1.5rem' }}>🛍️</span>
                            }
                          </div>
                          <div>
                            <Link href={`/shop/${product.slug}`} style={{ fontWeight: '600', color: 'var(--dark)' }}>
                              {product.name}
                            </Link>
                          </div>
                        </div>
                      </td>
                      <td>${price.toFixed(2)}</td>
                      <td>
                        <div style={{ display: 'flex', border: '1px solid var(--border)', width: 'fit-content' }}>
                          <button
                            onClick={() => updateQty(product.id, quantity - 1)}
                            style={{ width: '30px', height: '36px', background: 'none', border: 'none', cursor: 'pointer', fontSize: '1rem' }}
                          >−</button>
                          <input
                            type="number"
                            value={quantity}
                            min={1}
                            onChange={(e) => updateQty(product.id, parseInt(e.target.value) || 1)}
                            className="qty-input"
                          />
                          <button
                            onClick={() => updateQty(product.id, quantity + 1)}
                            style={{ width: '30px', height: '36px', background: 'none', border: 'none', cursor: 'pointer', fontSize: '1rem' }}
                          >+</button>
                        </div>
                      </td>
                      <td style={{ fontWeight: '700', color: 'var(--primary)' }}>
                        ${(price * quantity).toFixed(2)}
                      </td>
                      <td>
                        <button
                          onClick={() => removeItem(product.id)}
                          style={{ background: 'none', border: 'none', cursor: 'pointer', color: 'var(--danger)', fontSize: '1.1rem' }}
                          title="Remove"
                        >
                          ✕
                        </button>
                      </td>
                    </tr>
                  )
                })}
              </tbody>
            </table>

            <div style={{ display: 'flex', justifyContent: 'space-between', marginTop: '1.5rem' }}>
              <Link href="/shop" className="btn-outline">← Continue Shopping</Link>
            </div>
          </div>

          {/* Order Summary */}
          <div style={{ background: 'var(--bg-light)', padding: '2rem', border: '1px solid var(--border)' }}>
            <h3 style={{ fontSize: '1.1rem', fontWeight: '700', color: 'var(--dark)', marginBottom: '1.5rem', textTransform: 'uppercase', letterSpacing: '0.05em' }}>
              Order Summary
            </h3>

            <div style={{ fontSize: '0.9rem' }}>
              <div style={{ display: 'flex', justifyContent: 'space-between', marginBottom: '0.75rem' }}>
                <span style={{ color: 'var(--text)' }}>Subtotal ({cartCount} items)</span>
                <span style={{ fontWeight: '600', color: 'var(--dark)' }}>${cartTotal.toFixed(2)}</span>
              </div>
              <div style={{ display: 'flex', justifyContent: 'space-between', marginBottom: '0.75rem' }}>
                <span style={{ color: 'var(--text)' }}>Shipping</span>
                <span style={{ fontWeight: '600', color: shipping === 0 ? 'var(--success)' : 'var(--dark)' }}>
                  {shipping === 0 ? 'FREE' : `$${shipping.toFixed(2)}`}
                </span>
              </div>
              {shipping > 0 && (
                <div style={{ background: 'rgba(138,25,250,0.08)', padding: '0.75rem', fontSize: '0.8rem', color: 'var(--primary)', marginBottom: '1rem' }}>
                  Add ${(50 - cartTotal).toFixed(2)} more for free shipping!
                </div>
              )}
              <hr style={{ margin: '1rem 0', borderColor: 'var(--border)' }} />
              <div style={{ display: 'flex', justifyContent: 'space-between', marginBottom: '1.5rem' }}>
                <span style={{ fontWeight: '700', color: 'var(--dark)', fontSize: '1rem' }}>Total</span>
                <span style={{ fontWeight: '700', color: 'var(--primary)', fontSize: '1.2rem' }}>
                  ${(cartTotal + shipping).toFixed(2)}
                </span>
              </div>
            </div>

            {/* Coupon */}
            <div style={{ marginBottom: '1.5rem' }}>
              <input type="text" placeholder="Coupon code (JUPI20)" className="form-input" style={{ marginBottom: '0.5rem' }} />
              <button className="btn-outline" style={{ width: '100%', justifyContent: 'center' }}>Apply Coupon</button>
            </div>

            <Link href="/checkout" className="btn-primary" style={{ width: '100%', justifyContent: 'center', display: 'flex' }}>
              Proceed to Checkout →
            </Link>

            <div style={{ textAlign: 'center', marginTop: '1rem', fontSize: '0.8rem', color: 'var(--text)' }}>
              🔒 Secure checkout
            </div>
          </div>
        </div>
      </div>
    </div>
  )
}
