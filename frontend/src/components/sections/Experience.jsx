import { motion } from 'framer-motion';
import useFetch from '../../hooks/useFetch';
import LoadingSkeleton from '../LoadingSkeleton';

const FALLBACK_EXPERIENCE = [
  {
    id: 1,
    type: 'work',
    title: 'Full Stack Developer',
    company_or_institution: 'Tech Solutions Inc.',
    start_date: '2023-01-15',
    end_date: null,
    description: 'Lead development of the main SaaS platform, architecting microservices and building responsive frontends. Improved application performance by 40%.',
    is_current: true,
  },
  {
    id: 2,
    type: 'work',
    title: 'Frontend Developer',
    company_or_institution: 'Digital Agency Co.',
    start_date: '2021-06-01',
    end_date: '2022-12-31',
    description: 'Developed and maintained client websites using React and Vue.js. Implemented responsive designs and improved SEO for multiple projects.',
    is_current: false,
  },
  {
    id: 3,
    type: 'education',
    title: 'B.Sc. Computer Science',
    company_or_institution: 'University of Technology',
    start_date: '2018-09-01',
    end_date: '2022-05-30',
    description: 'Graduated with honors. Specialized in software engineering and web technologies. Active member of the coding club.',
    is_current: false,
  },
];

const formatDate = (dateStr) => {
  if (!dateStr) return 'Present';
  const d = new Date(dateStr);
  const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
  return `${months[d.getMonth()]} ${d.getFullYear()}`;
};

const fadeUp = {
  hidden: { opacity: 0, y: 40 },
  visible: (i = 0) => ({
    opacity: 1,
    y: 0,
    transition: { duration: 0.6, delay: i * 0.1, ease: [0.25, 0.46, 0.45, 0.94] },
  }),
};

export default function Experience() {
  const { data, loading } = useFetch('/experiences');
  const experiences = data?.data || FALLBACK_EXPERIENCE;

  const sorted = [...experiences].sort((a, b) => {
    const aDate = a.start_date || '';
    const bDate = b.start_date || '';
    return bDate.localeCompare(aDate);
  });

  return (
    <section id="experience" className="section experience-section">
      <div className="experience-glow experience-glow-purple" />
      <div className="experience-glow experience-glow-green" />
      <div className="container">
        <motion.div
          initial="hidden"
          whileInView="visible"
          viewport={{ once: true, margin: '-80px' }}
          variants={fadeUp}
        >
          <div className="experience-badge">My Journey</div>
          <h2 className="section-title">
            Experience <span className="text-gradient">& Education</span>
          </h2>
          <div className="divider" />
          <p className="section-subtitle">My professional journey</p>
        </motion.div>

        {loading ? (
          <LoadingSkeleton type="timeline" count={4} />
        ) : (
          <div className="timeline">
            {sorted.map((item, i) => (
              <motion.div
                key={item.id}
                className="timeline-item"
                initial="hidden"
                whileInView="visible"
                viewport={{ once: true, margin: '-50px' }}
                variants={fadeUp}
                custom={i}
              >
                <div className={`timeline-dot ${item.is_current ? 'current' : ''}`} />
                <div className="timeline-card">
                  <div className="timeline-date">
                    {formatDate(item.start_date)} — {item.is_current ? 'Present' : formatDate(item.end_date)}
                  </div>
                  <h3 className="timeline-title">{item.title}</h3>
                  <div className="timeline-company" style={{ color: item.type === 'work' ? 'var(--accent)' : 'var(--primary-light)' }}>
                    {item.company_or_institution}
                  </div>
                  <p className="timeline-desc">{item.description}</p>
                  <div className="timeline-tags">
                    {item.type === 'work' && (
                      <span className="tag tag-cyan">Work</span>
                    )}
                    {item.type === 'education' && (
                      <span className="tag tag-purple">Education</span>
                    )}
                    {item.is_current && (
                      <span className="tag tag-current">Current</span>
                    )}
                  </div>
                </div>
              </motion.div>
            ))}
          </div>
        )}
      </div>
    </section>
  );
}
