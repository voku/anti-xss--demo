document.addEventListener('DOMContentLoaded', () => {
  const navbar = document.querySelector('.main-navbar');
  const navLinks = Array.from(document.querySelectorAll('.main-navbar .js-animate'));
  const scrollTopLink = document.querySelector('.scroll-top a');
  const sections = Array.from(document.querySelectorAll('#section1, #section2'));

  const scrollToTarget = (hash) => {
    const target = document.querySelector(hash);

    if (!target) {
      return;
    }

    const offset = (navbar?.offsetHeight ?? 0) + 12;
    const top = target.getBoundingClientRect().top + window.scrollY - offset;
    window.scrollTo({ top, behavior: 'smooth' });
  };

  const updateActiveLink = () => {
    if (sections.length === 0) {
      return;
    }

    const offset = (navbar?.offsetHeight ?? 0) + 24;
    const currentSection = sections.reduce((activeSection, section) => {
      if (window.scrollY + offset >= section.offsetTop) {
        return section;
      }

      return activeSection;
    }, sections[0]);

    navLinks.forEach((link) => {
      const linkTarget = link.getAttribute('href')?.split('#')[1] ?? '';
      link.classList.toggle('active', linkTarget === currentSection.id);
    });
  };

  navLinks.forEach((link) => {
    link.addEventListener('click', (event) => {
      const url = new URL(link.href, window.location.href);

      if (url.pathname !== window.location.pathname || !url.hash) {
        return;
      }

      event.preventDefault();
      scrollToTarget(url.hash);
      window.history.replaceState(null, '', url.hash);
    });
  });

  scrollTopLink?.addEventListener('click', (event) => {
    event.preventDefault();
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });

  window.addEventListener('scroll', updateActiveLink, { passive: true });
  window.addEventListener('resize', updateActiveLink);
  updateActiveLink();

  if (window.location.hash) {
    setTimeout(() => scrollToTarget(window.location.hash), 50);
  }
});
