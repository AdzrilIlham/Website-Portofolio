import { useState } from 'react';
import { motion } from 'framer-motion';
import useFetch from '../../hooks/useFetch';
import LoadingSkeleton from '../LoadingSkeleton';

const fadeUp = {
  hidden: { opacity: 0, y: 40 },
  visible: (i = 0) => ({
    opacity: 1,
    y: 0,
    transition: { duration: 0.6, delay: i * 0.15, ease: [0.25, 0.46, 0.45, 0.94] },
  }),
};

const FALLBACK_ABOUT = {
  about_description: `I am a dedicated full-stack developer with a strong foundation in both frontend and backend technologies. I love building web applications that are not only visually appealing but also performant, accessible, and maintainable.

My journey in software development started several years ago, and since then, I have worked on a wide range of projects from small business websites to large-scale enterprise applications. I believe in continuous learning and staying updated with the latest industry trends and technologies.

When I am not coding, you can find me exploring new technologies, contributing to open-source projects, or sharing knowledge through technical writing and community engagement.`,
};

export default function About() {
  const { data, loading } = useFetch('/profile');
  const profile = data || FALLBACK_ABOUT;
  const description = profile.about_description || FALLBACK_ABOUT.about_description;
  const [imgError, setImgError] = useState(false);

  const showPhoto = profile.photo && !imgError;

  return (
    <section id="about" className="section">
      <div className="container">
        <motion.div
          initial="hidden"
          whileInView="visible"
          viewport={{ once: true, margin: '-80px' }}
          variants={fadeUp}
        >
          <h2 className="section-title">
            About <span className="text-gradient">Me</span>
          </h2>
          <div className="divider" />
          <p className="section-subtitle">Get to know me better</p>
        </motion.div>

        {loading ? (
          <LoadingSkeleton type="timeline" count={2} />
        ) : (
          <div className="about-grid">
            <motion.div
              className="about-image-wrapper"
              initial="hidden"
              whileInView="visible"
              viewport={{ once: true, margin: '-80px' }}
              variants={fadeUp}
              custom={1}
            >
              <div className="about-image-border" />
              {showPhoto ? (
                <img
                  src={profile.photo}
                  alt={profile.name || 'Profile'}
                  className="about-image"
                  onError={() => setImgError(true)}
                />
              ) : (
                <div className="about-image-placeholder">
                  <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1" strokeLinecap="round" strokeLinejoin="round">
                    <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" />
                    <circle cx="12" cy="7" r="4" />
                  </svg>
                </div>
              )}
            </motion.div>

            <motion.div
              className="about-text"
              initial="hidden"
              whileInView="visible"
              viewport={{ once: true, margin: '-80px' }}
              variants={fadeUp}
              custom={2}
            >
              {description.split('\n\n').map((para, i) => (
                <p key={i}>{para}</p>
              ))}
            </motion.div>
          </div>
        )}
      </div>
    </section>
  );
}
