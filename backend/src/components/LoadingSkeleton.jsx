export default function LoadingSkeleton({ type = 'card', count = 3 }) {
  if (type === 'card') {
    return (
      <div className="skills-grid">
        {Array.from({ length: count }).map((_, i) => (
          <div key={i} className="skill-card">
            <div className="skill-card-header">
              <div className="skeleton skeleton-circle" style={{ width: 48, height: 48 }} />
              <div style={{ flex: 1 }}>
                <div className="skeleton skeleton-text" style={{ width: '60%', height: 18 }} />
                <div className="skeleton skeleton-text" style={{ width: '40%', height: 14 }} />
              </div>
            </div>
            <div className="skeleton skeleton-text" style={{ width: '100%', height: 6, borderRadius: 99 }} />
          </div>
        ))}
      </div>
    );
  }

  if (type === 'project') {
    return (
      <div className="projects-grid">
        {Array.from({ length: count }).map((_, i) => (
          <div key={i} className="project-card">
            <div className="skeleton" style={{ height: 200, borderRadius: 0 }} />
            <div style={{ padding: 24 }}>
              <div className="skeleton skeleton-text" style={{ width: '40%', height: 14, marginBottom: 12 }} />
              <div className="skeleton skeleton-title" />
              <div className="skeleton skeleton-text" />
              <div className="skeleton skeleton-text" />
              <div className="skeleton skeleton-text" style={{ width: '70%' }} />
              <div style={{ display: 'flex', gap: 8, marginTop: 16 }}>
                <div className="skeleton" style={{ width: 60, height: 24, borderRadius: 99 }} />
                <div className="skeleton" style={{ width: 80, height: 24, borderRadius: 99 }} />
              </div>
            </div>
          </div>
        ))}
      </div>
    );
  }

  if (type === 'timeline') {
    return (
      <div className="timeline">
        {Array.from({ length: count }).map((_, i) => (
          <div key={i} className="timeline-item" style={{ left: i % 2 === 0 ? 0 : '50%', textAlign: i % 2 === 0 ? 'right' : 'left' }}>
            <div className="skeleton skeleton-circle" style={{ width: 16, height: 16, position: 'absolute', top: 6, [i % 2 === 0 ? 'right' : 'left']: -8 }} />
            <div className="skeleton skeleton-text" style={{ width: 120, height: 14 }} />
            <div className="skeleton skeleton-title" style={{ width: '80%' }} />
            <div className="skeleton skeleton-text" style={{ width: '60%', height: 16 }} />
            <div className="skeleton skeleton-text" />
            <div className="skeleton skeleton-text" style={{ width: '90%' }} />
          </div>
        ))}
      </div>
    );
  }

  return null;
}
