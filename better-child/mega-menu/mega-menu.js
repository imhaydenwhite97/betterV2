document.documentElement.classList.add('preload');

window.addEventListener('load', () => {
    document.documentElement.classList.remove('preload');
    
    const trigger = document.querySelector('.mega-menu-trigger');
    const closeBtn = document.querySelector('.mega-menu-close');
    const overlay = document.querySelector('.mega-menu-overlay');
    const html = document.documentElement;
    let scrollPosition = 0;

    // Set initial coordinates
    const initialRect = trigger.getBoundingClientRect();
    const initialX = initialRect.left + (initialRect.width / 2);
    const initialY = initialRect.top + (initialRect.height / 2);
    overlay.style.setProperty('--x', `${initialX}px`);
    overlay.style.setProperty('--y', `${initialY}px`);
    
    function lockScroll() {
        scrollPosition = window.pageYOffset;
        html.style.overflow = 'hidden';
        html.style.position = 'fixed';
        html.style.width = '100%';
        html.style.top = `-${scrollPosition}px`;
    }
    
    function unlockScroll() {
        html.style.removeProperty('overflow');
        html.style.removeProperty('position');
        html.style.removeProperty('width');
        html.style.removeProperty('top');
        window.scrollTo(0, scrollPosition);
    }
    
    function openMenu() {
        const rect = trigger.getBoundingClientRect();
        const x = rect.left + (rect.width / 2);
        const y = rect.top + (rect.height / 2);
        
        overlay.style.setProperty('--x', `${x}px`);
        overlay.style.setProperty('--y', `${y}px`);
        
        trigger.classList.add('active');
        overlay.classList.add('active');
        lockScroll();
    }
    
    function closeMenu() {
        overlay.classList.add('closing');
        overlay.classList.remove('active');
        trigger.classList.remove('active');
        unlockScroll();
        
        setTimeout(() => {
            overlay.classList.remove('closing');
        }, 1200);
    }
    
    trigger.addEventListener('click', openMenu);
    closeBtn.addEventListener('click', closeMenu);
    
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && overlay.classList.contains('active')) {
            closeMenu();
        }
    });
});
