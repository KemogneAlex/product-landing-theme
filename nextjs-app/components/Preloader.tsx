'use client'
import { useEffect, useState } from 'react'

export default function Preloader() {
  const [hidden, setHidden] = useState(false)

  useEffect(() => {
    const t = setTimeout(() => setHidden(true), 1800)
    return () => clearTimeout(t)
  }, [])

  if (hidden) return null

  return (
    <div className={`preloader ${hidden ? 'hidden' : ''}`}>
      <div className="preloader-logo">
        JU<span>PI</span>
      </div>
    </div>
  )
}
