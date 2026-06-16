import { motion } from 'framer-motion';
import useFetch from '../../hooks/useFetch';
import LoadingSkeleton from '../LoadingSkeleton';

const FALLBACK_PROJECTS = [
  {
    id: 1,
    title: 'E-Commerce Platform',
    description: 'A full-featured e-commerce platform with product management, cart system, payment integration via Stripe, and an admin dashboard for analytics and order management.',
    image: null,
    tech_stack: ['React', 'Node.js', 'MongoDB', 'Stripe', 'Tailwind CSS'],
    demo_url: '#',
    github_url: '#',
    is_featured: true,
  },
  {
    id: 2,
    title: 'Task Management App',
    description: 'A collaborative project management tool with real-time updates, drag-and-drop boards, team assignments, and progress tracking.',
    image: null,
    tech_stack: ['Vue.js', 'Laravel', 'MySQL', 'WebSocket'],
    demo_url: '#',
    github_url: '#',
    is_featured: true,
  },
  {
    id: 3,
    title: 'Weather Dashboard',
    description: 'A weather application that provides real-time weather data, 7-day forecasts, and interactive maps using OpenWeatherMap API.',
    image: null,
    tech_stack: ['React', 'OpenWeather API', 'Chart.js', 'Geolocation'],
    demo_url: '#',
    github_url: '#',
    is_featured: false,
  },
  {
    id: 4,
    title: 'Social Media Analytics',
    description: 'A dashboard for tracking social media engagement metrics across multiple platforms with data visualization and automated reporting.',
    image: null,
    tech_stack: ['Next.js', 'Python', 'PostgreSQL', 'D3.js'],
    demo_url: '#',
    github_url: '#',
    is_featured: false,
  },
];

const stagger = {
  hidden: {},
  visible: {
    transition: { staggerChildren: 0.12 },
  },
};

const fadeUp = {
  hidden: { opacity: 0, y: 40 },
  visible: {
    opacity: 1,
    y: 0,
    transition: { duration: 0.6, ease: [0.25, 0.46, 0.45, 0.94] },
  },
};

export default function Projects() {
  const { data, loading } = useFetch('/projects');
  const projects = data?.data || FALLBACK_PROJECTS;

  return (
    <section id="projects" className="section">
      <div className="container">
        <motion.div
          initial="hidden"
          whileInView="visible"
          viewport={{ once: true, margin: '-80px' }}
          variants={fadeUp}
        >
          <h2 className="section-title">
            Featured <span className="text-gradient">Projects</span>
          </h2>
          <div className="divider" />
          <p className="section-subtitle">Some of my recent work</p>
        </motion.div>

        {loading ? (
          <LoadingSkeleton type="project" count={4} />
        ) : (
          <motion.div
            className="projects-grid"
            variants={stagger}
            initial="hidden"
            whileInView="visible"
            viewport={{ once: true, margin: '-50px' }}
          >
            {projects.map((project) => (
              <motion.div
                key={project.id}
                className="project-card"
                variants={fadeUp}
              >
                <div className="project-card-image">
                  {project.image ? (
                    <img src={project.image} alt={project.title} />
                  ) : (
                    <div className="project-card-image-placeholder">
                      <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1" strokeLinecap="round" strokeLinejoin="round">
                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2" />
                        <circle cx="8.5" cy="8.5" r="1.5" />
                        <polyline points="21 15 16 10 5 21" />
                      </svg>
                    </div>
                  )}
                  <div className="project-card-overlay">
                    {project.demo_url && (
                      <a href={project.demo_url} target="_blank" rel="noopener noreferrer" className="btn btn-primary btn-sm">
                        Live Demo
                      </a>
                    )}
                    {project.github_url && (
                      <a href={project.github_url} target="_blank" rel="noopener noreferrer" className="btn btn-outline btn-sm">
                        GitHub
                      </a>
                    )}
                  </div>
                </div>

                <div className="project-card-body">
                  {project.is_featured && (
                    <div className="project-card-featured">
                      ⭐ Featured
                    </div>
                  )}
                  <h3 className="project-card-title">{project.title}</h3>
                  <p className="project-card-desc">{project.description}</p>
                  <div className="project-card-tags">
                    {(project.tech_stack || []).map((tech) => (
                      <span key={tech} className="tag tag-cyan">{tech}</span>
                    ))}
                  </div>
                  <div className="project-card-links">
                    {project.demo_url && (
                      <a href={project.demo_url} target="_blank" rel="noopener noreferrer" className="btn btn-outline btn-sm">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
                          <path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6" />
                          <polyline points="15 3 21 3 21 9" />
                          <line x1="10" y1="14" x2="21" y2="3" />
                        </svg>
                        Demo
                      </a>
                    )}
                    {project.github_url && (
                      <a href={project.github_url} target="_blank" rel="noopener noreferrer" className="btn btn-outline btn-sm">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
                          <path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 00-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0020 4.77 5.07 5.07 0 0019.91 1S18.73.65 16 2.48a13.38 13.38 0 00-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 005 4.77a5.44 5.44 0 00-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 009 18.13V22" />
                        </svg>
                        Code
                      </a>
                    )}
                  </div>
                </div>
              </motion.div>
            ))}
          </motion.div>
        )}
      </div>
    </section>
  );
}
