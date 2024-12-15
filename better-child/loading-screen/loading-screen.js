document.addEventListener('DOMContentLoaded', () => {
    const progressBar = document.getElementById('progress-bar');
    const loadingScreen = document.getElementById('loading-screen');
    
    function startLoading() {
        loadingScreen.classList.remove('hidden');
        let progress = 0;
        const interval = setInterval(() => {
            progress += Math.random() * 30;
            if (progress > 100) progress = 100;
            progressBar.style.width = progress + '%';
            
            if (progress === 100) {
                clearInterval(interval);
                setTimeout(() => {
                    loadingScreen.classList.add('hidden');
                }, 200);
            }
        }, 100);
    }

    // Trigger on page load
    startLoading();

    // Trigger on link clicks
    document.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', (e) => {
            if (!link.hasAttribute('target') && link.href.indexOf(window.location.origin) === 0) {
                e.preventDefault();
                startLoading();
                setTimeout(() => {
                    window.location = link.href;
                }, 500);
            }
        });
    });
});
