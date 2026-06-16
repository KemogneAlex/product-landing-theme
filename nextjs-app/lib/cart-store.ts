'use client'
import { create } from 'zustand'
import { persist } from 'zustand/middleware'

export type CartProduct = {
  id: number
  name: string
  slug: string
  price: number
  sale_price: number | null
  images: string
}

export type CartEntry = {
  product: CartProduct
  quantity: number
}

type CartState = {
  items: CartEntry[]
  addItem: (product: CartProduct, qty?: number) => void
  removeItem: (productId: number) => void
  updateQty: (productId: number, qty: number) => void
  clearCart: () => void
  total: () => number
  count: () => number
}

export const useCartStore = create<CartState>()(
  persist(
    (set, get) => ({
      items: [],
      addItem: (product, qty = 1) => {
        const items = get().items
        const existing = items.find((i) => i.product.id === product.id)
        if (existing) {
          set({
            items: items.map((i) =>
              i.product.id === product.id
                ? { ...i, quantity: i.quantity + qty }
                : i
            ),
          })
        } else {
          set({ items: [...items, { product, quantity: qty }] })
        }
      },
      removeItem: (productId) => {
        set({ items: get().items.filter((i) => i.product.id !== productId) })
      },
      updateQty: (productId, qty) => {
        if (qty <= 0) {
          get().removeItem(productId)
          return
        }
        set({
          items: get().items.map((i) =>
            i.product.id === productId ? { ...i, quantity: qty } : i
          ),
        })
      },
      clearCart: () => set({ items: [] }),
      total: () =>
        get().items.reduce((sum, i) => {
          const price = i.product.sale_price ?? i.product.price
          return sum + price * i.quantity
        }, 0),
      count: () => get().items.reduce((sum, i) => sum + i.quantity, 0),
    }),
    { name: 'jupi-cart' }
  )
)
