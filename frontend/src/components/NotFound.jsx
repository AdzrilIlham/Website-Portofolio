import { useEffect } from 'react';

export default function NotFound() {
  useEffect(() => {
    document.title = '404 - Page Not Found';
  }, []);

  return (
    <div style={{
      minHeight: '100vh',
      display: 'flex',
      alignItems: 'center',
      justifyContent: 'center',
      background: '#0a0a0a',
      color: '#e5e7eb',
      fontFamily: 'Inter, sans-serif',
      padding: '20px',
      textAlign: 'center',
    }}>
      <div>
        <h1 style={{ fontSize: 96, fontWeight: 700, color: '#4f46e5', lineHeight: 1, marginBottom: 16 }}>404</h1>
        <h2 style={{ fontSize: 24, fontWeight: 600, marginBottom: 8 }}>Page Not Found</h2>
        <p style={{ color: '#9ca3af', marginBottom: 32 }}>
          The page you're looking for doesn't exist.
        </p>
        <a
          href="/"
          style={{
            display: 'inline-block',
            padding: '10px 24px',
            background: '#4f46e5',
            color: '#fff',
            borderRadius: 8,
            textDecoration: 'none',
            fontSize: 14,
            fontWeight: 500,
          }}
        >
          Go Home
        </a>
      </div>
    </div>
  );
}
