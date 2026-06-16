import { useState, useEffect } from 'react';
import { motion } from 'framer-motion';
import useFetch from '../../hooks/useFetch';
import LoadingSkeleton from '../LoadingSkeleton';

const ICON_CLASSES = ['', 'purple', 'lime'];

function isUrl(str) {
  return typeof str === 'string' && (str.startsWith('http://') || str.startsWith('https://'));
}

function SkillIcon({ icon, name, iconClass }) {
  if (isUrl(icon)) {
    return (
      <div className={`skill-card-icon ${iconClass}`}>
        <img
          src={icon}
          alt={name}
          className="w-8 h-8 object-contain"
          onError={(e) => {
            e.target.style.display = 'none';
            e.target.parentNode.querySelector('.skill-icon-fallback').style.display = 'flex';
          }}
        />
        <span className="skill-icon-fallback" style={{ display: 'none' }}>
          {name.charAt(0)}
        </span>
      </div>
    );
  }

  return (
    <div className={`skill-card-icon ${iconClass}`}>
      {name.charAt(0)}
    </div>
  );
}

const FALLBACK_SKILLS = [
  { name: 'JavaScript', level: 90, category: 'Frontend', icon: 'javascript' },
  { name: 'TypeScript', level: 85, category: 'Frontend', icon: 'typescript' },
  { name: 'React', level: 88, category: 'Frontend', icon: 'react' },
  { name: 'HTML5', level: 95, category: 'Frontend', icon: 'html' },
  { name: 'CSS3 / Tailwind', level: 90, category: 'Frontend', icon: 'css' },
  { name: 'Vue.js', level: 75, category: 'Frontend', icon: 'vue' },
  { name: 'Node.js', level: 82, category: 'Backend', icon: 'nodejs' },
  { name: 'Python', level: 78, category: 'Backend', icon: 'python' },
  { name: 'Laravel', level: 85, category: 'Backend', icon: 'laravel' },
  { name: 'PHP', level: 80, category: 'Backend', icon: 'php' },
  { name: 'MySQL', level: 80, category: 'Database', icon: 'mysql' },
  { name: 'PostgreSQL', level: 75, category: 'Database', icon: 'postgresql' },
  { name: 'MongoDB', level: 70, category: 'Database', icon: 'mongodb' },
  { name: 'Docker', level: 72, category: 'DevOps', icon: 'docker' },
  { name: 'Git', level: 88, category: 'DevOps', icon: 'git' },
  { name: 'Linux', level: 70, category: 'DevOps', icon: 'linux' },
];

const stagger = {
  hidden: {},
  visible: {
    transition: { staggerChildren: 0.06 },
  },
};

const fadeUp = {
  hidden: { opacity: 0, y: 30 },
  visible: {
    opacity: 1,
    y: 0,
    transition: { duration: 0.5, ease: [0.25, 0.46, 0.45, 0.94] },
  },
};

export default function Skills() {
  const { data, loading } = useFetch('/skills');
  const [allSkills, setAllSkills] = useState([]);
  const [activeFilter, setActiveFilter] = useState('All');

  useEffect(() => {
    const skills = data?.data || FALLBACK_SKILLS;
    setAllSkills(skills);
  }, [data]);

  const categories = ['All', ...new Set(allSkills.map((s) => s.category))];

  const filtered = activeFilter === 'All'
    ? allSkills
    : allSkills.filter((s) => s.category === activeFilter);

  const handleFilter = (category) => {
    setActiveFilter(category);
  };

  return (
    <section id="skills" className="section skills-section">
      <div className="skills-glow skills-glow-purple" />
      <div className="skills-glow skills-glow-green" />
      <div className="container">
        <motion.div
          initial="hidden"
          whileInView="visible"
          viewport={{ once: true, margin: '-80px' }}
          variants={fadeUp}
        >
          <div className="skills-badge">Available Technologies</div>
          <h2 className="section-title">
            My <span className="text-gradient">Skills</span>
          </h2>
          <div className="divider" />
          <p className="section-subtitle">Technologies and tools I work with</p>
        </motion.div>

        <motion.div
          className="skills-filters"
          initial="hidden"
          whileInView="visible"
          viewport={{ once: true }}
          variants={fadeUp}
          custom={1}
        >
          {categories.map((cat) => (
            <button
              key={cat}
              className={`skills-filter-btn ${activeFilter === cat ? 'active' : ''}`}
              onClick={() => handleFilter(cat)}
            >
              {cat}
            </button>
          ))}
        </motion.div>

        {loading ? (
          <LoadingSkeleton type="card" count={6} />
        ) : (
          <motion.div
            className="skills-grid"
            key={activeFilter}
            variants={stagger}
            initial="hidden"
            whileInView="visible"
            viewport={{ once: true, margin: '-50px' }}
          >
            {filtered.map((skill, i) => (
              <motion.div
                key={skill.name}
                className="skill-card"
                variants={fadeUp}
              >
                <div className="skill-card-header">
                  <SkillIcon icon={skill.icon} name={skill.name} iconClass={ICON_CLASSES[i % 3]} />
                  <div>
                    <div className="skill-card-name">{skill.name}</div>
                    <div className="skill-card-level">
                      <span className="skill-card-level-text">{skill.level}%</span> proficiency
                    </div>
                  </div>
                </div>
                <div className="progress-bar">
                  <motion.div
                    className="progress-bar-fill"
                    initial={{ width: 0 }}
                    whileInView={{ width: `${skill.level}%` }}
                    viewport={{ once: true }}
                    transition={{ duration: 1.2, ease: 'easeOut', delay: 0.2 }}
                  />
                </div>
              </motion.div>
            ))}
          </motion.div>
        )}
      </div>
    </section>
  );
}
