import { useCallback } from 'react';
import { motion, useMotionValue, useTransform, useSpring } from 'framer-motion';
import useFetch from '../../hooks/useFetch';

const fadeUp = {
  hidden: { opacity: 0, y: 40 },
  visible: (i = 0) => ({
    opacity: 1,
    y: 0,
    transition: { duration: 0.6, delay: i * 0.15, ease: [0.25, 0.46, 0.45, 0.94] },
  }),
};

const CODE_LINES = [
  { indent: 0, text: 'const', varName: 'developer', value: '{' },
  { indent: 1, text: 'name:', value: '"Adzril Ilham",' },
  { indent: 1, text: 'role:', value: '"Full-Stack Dev",' },
  { indent: 1, text: 'skills:', value: '["Laravel", "React"],' },
  { indent: 1, text: 'status:', value: '"Available 🚀"' },
  { indent: 0, text: '', value: '}' },
];

function FloatingBadge({ children, style, delay = 0, duration = 4 }) {
  return (
    <motion.div
      style={style}
      animate={{ y: [0, -10, 0, 6, 0] }}
      transition={{ duration, repeat: Infinity, delay, ease: 'easeInOut' }}
    >
      {children}
    </motion.div>
  );
}

function GlowOrb({ className }) {
  return (
    <motion.div
      className={className}
      animate={{ scale: [1, 1.15, 1], opacity: [0.25, 0.45, 0.25] }}
      transition={{ duration: 4, repeat: Infinity, ease: 'easeInOut' }}
    />
  );
}

function OrbitDot({ top, left, size, color, delay }) {
  return (
    <motion.div
      style={{
        position: 'absolute',
        top,
        left,
        width: size,
        height: size,
        borderRadius: '50%',
        background: color,
        boxShadow: `0 0 8px ${color}`,
      }}
      animate={{ scale: [1, 1.4, 1], opacity: [0.5, 1, 0.5] }}
      transition={{ duration: 3, repeat: Infinity, delay, ease: 'easeInOut' }}
    />
  );
}

function CodeCard3D() {
  const x = useMotionValue(0);
  const y = useMotionValue(0);

  const rotateX = useSpring(useTransform(y, [-150, 150], [8, -8]), {
    stiffness: 150,
    damping: 20,
  });
  const rotateY = useSpring(useTransform(x, [-150, 150], [-8, 8]), {
    stiffness: 150,
    damping: 20,
  });

  const handleMouseMove = useCallback(
    (e) => {
      const rect = e.currentTarget.getBoundingClientRect();
      const cx = rect.left + rect.width / 2;
      const cy = rect.top + rect.height / 2;
      x.set(e.clientX - cx);
      y.set(e.clientY - cy);
    },
    [x, y]
  );

  const handleMouseLeave = useCallback(() => {
    x.set(0);
    y.set(0);
  }, [x, y]);

  return (
    <div className="hero-right-visual">
      {/* Background glow */}
      <GlowOrb className="hero-glow-orb" />

      {/* Orbit dots */}
      <OrbitDot top="-8px" left="20%" size="6px" color="#FFD700" delay={0} />
      <OrbitDot top="30%" left="-12px" size="5px" color="#7B52D3" delay={0.8} />
      <OrbitDot top="70%" left="95%" size="7px" color="#2E7D32" delay={1.5} />
      <OrbitDot top="90%" left="40%" size="4px" color="#FFD700" delay={2.2} />

      {/* Floating badges */}
      <FloatingBadge
        style={{
          position: 'absolute',
          top: '-16px',
          left: '10%',
          padding: '5px 12px',
          borderRadius: '9999px',
          background: 'rgba(255, 215, 0, 0.15)',
          border: '1px solid rgba(255, 215, 0, 0.3)',
          color: '#FFD700',
          fontSize: '0.75rem',
          fontWeight: 600,
          zIndex: 5,
          whiteSpace: 'nowrap',
        }}
        delay={0.5}
        duration={3.5}
      >
        ⚡ Available
      </FloatingBadge>

      <FloatingBadge
        style={{
          position: 'absolute',
          bottom: '-14px',
          right: '8%',
          padding: '5px 12px',
          borderRadius: '9999px',
          background: 'rgba(46, 125, 50, 0.15)',
          border: '1px solid rgba(46, 125, 50, 0.3)',
          color: '#4CAF50',
          fontSize: '0.75rem',
          fontWeight: 600,
          zIndex: 5,
          whiteSpace: 'nowrap',
        }}
        delay={1.2}
        duration={4.2}
      >
        Laravel
      </FloatingBadge>

      <FloatingBadge
        style={{
          position: 'absolute',
          top: '40%',
          left: '-20px',
          padding: '5px 12px',
          borderRadius: '9999px',
          background: 'rgba(123, 82, 211, 0.15)',
          border: '1px solid rgba(123, 82, 211, 0.3)',
          color: '#9B72E3',
          fontSize: '0.75rem',
          fontWeight: 600,
          zIndex: 5,
          whiteSpace: 'nowrap',
        }}
        delay={0.8}
        duration={3.8}
      >
        React
      </FloatingBadge>

      <FloatingBadge
        style={{
          position: 'absolute',
          top: '60%',
          right: '-16px',
          padding: '4px 10px',
          borderRadius: '9999px',
          background: 'rgba(74, 44, 143, 0.2)',
          border: '1px solid rgba(74, 44, 143, 0.3)',
          color: '#7B52D3',
          fontSize: '0.7rem',
          fontWeight: 600,
          zIndex: 5,
          whiteSpace: 'nowrap',
        }}
        delay={1.8}
        duration={4.5}
      >
        Full-Stack
      </FloatingBadge>

      {/* Main 3D Card */}
      <motion.div
        className="hero-code-card"
        style={{ rotateX, rotateY, transformPerspective: 1200 }}
        onMouseMove={handleMouseMove}
        onMouseLeave={handleMouseLeave}
        animate={{ y: [0, -20, 0] }}
        transition={{ duration: 3, repeat: Infinity, ease: 'easeInOut' }}
      >
        <div className="code-card-header">
          <div className="code-card-dots">
            <span style={{ background: '#FF5F57' }} />
            <span style={{ background: '#FEBC2E' }} />
            <span style={{ background: '#28C840' }} />
          </div>
          <span className="code-card-filename">developer.js</span>
        </div>

        <div className="code-card-body">
          {CODE_LINES.map((line, i) => (
            <motion.div
              key={i}
              className="code-line"
              style={{ paddingLeft: `${line.indent * 20 + 16}px` }}
              initial={{ opacity: 0, x: -10 }}
              animate={{ opacity: 1, x: 0 }}
              transition={{ delay: 0.8 + i * 0.1, duration: 0.4 }}
            >
              {line.text && <span className="code-keyword">{line.text} </span>}
              {line.varName && <span className="code-var">{line.varName} </span>}
              <span className="code-value">{line.value}</span>
            </motion.div>
          ))}
        </div>
      </motion.div>
    </div>
  );
}

export default function Hero() {
  const { data } = useFetch('/profile');
  const profile = data || {};
  const name = profile.name || 'Your Name';
  const tagline = profile.tagline || 'Full-Stack Developer';
  const description =
    profile.description ||
    'A passionate full-stack developer crafting exceptional digital experiences. I transform ideas into elegant, performant web applications that make a difference.';
  const cvUrl = profile.cv_url || '#';

  const scrollTo = (id) => {
    const el = document.getElementById(id);
    if (el) {
      const offset = 80;
      const y = el.getBoundingClientRect().top + window.pageYOffset - offset;
      window.scrollTo({ top: y, behavior: 'smooth' });
    }
  };

  return (
    <section id="home" className="hero">
      <div className="hero-orb hero-orb-1" />
      <div className="hero-orb hero-orb-2" />
      <div className="hero-orb hero-orb-3" />

      <div className="container">
        <div className="hero-grid">
          {/* Left — Text */}
          <div className="hero-content">
            <motion.div
              className="hero-tag"
              variants={fadeUp}
              initial="hidden"
              animate="visible"
              custom={0}
            >
              <span className="hero-tag-dot" />
              Available for opportunities
            </motion.div>

            <motion.h1
              className="heading-xl hero-name"
              variants={fadeUp}
              initial="hidden"
              animate="visible"
              custom={1}
            >
              Hi, I'm{' '}
              <span className="text-gradient">{name}</span>
            </motion.h1>

            <motion.p
              className="hero-tagline"
              variants={fadeUp}
              initial="hidden"
              animate="visible"
              custom={1.5}
            >
              {tagline}
            </motion.p>

            <motion.p
              className="hero-description"
              variants={fadeUp}
              initial="hidden"
              animate="visible"
              custom={2}
            >
              {description}
            </motion.p>

            <motion.div
              className="hero-actions"
              variants={fadeUp}
              initial="hidden"
              animate="visible"
              custom={3}
            >
              <a
                href={cvUrl}
                className="btn btn-primary"
                target="_blank"
                rel="noopener noreferrer"
              >
                <svg
                  width="18"
                  height="18"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  strokeWidth="2"
                  strokeLinecap="round"
                  strokeLinejoin="round"
                >
                  <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4" />
                  <polyline points="7 10 12 15 17 10" />
                  <line x1="12" y1="15" x2="12" y2="3" />
                </svg>
                Download CV
              </a>
              <button className="btn btn-outline" onClick={() => scrollTo('contact')}>
                Contact Me
              </button>
            </motion.div>
          </div>

          {/* Right — 3D Visual */}
          <CodeCard3D />
        </div>
      </div>

      <motion.div
        className="hero-scroll-indicator"
        initial={{ opacity: 0 }}
        animate={{ opacity: 1 }}
        transition={{ delay: 1.5, duration: 0.5 }}
        onClick={() => scrollTo('about')}
        style={{ cursor: 'pointer' }}
      >
        <div className="hero-scroll-mouse" />
        <span>Scroll Down</span>
      </motion.div>
    </section>
  );
}
