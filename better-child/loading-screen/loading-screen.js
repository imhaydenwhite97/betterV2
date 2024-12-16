(function($) {
    'use strict';

    let animationFrame;
    let resourcesLoaded = false;
    let animationStarted = false;

    function checkIntersection() {
        const circle = document.querySelector('.expanding-circle');
        const bottomLogo = document.querySelector('.bottom-logo');
        
        const circleRect = circle.getBoundingClientRect();
        const logoRect = bottomLogo.getBoundingClientRect();
        
        const radius = circleRect.width / 2;
        const circleCenter = {
            x: circleRect.left + radius,
            y: circleRect.top + radius
        };
        
        const distance = Math.sqrt(
            Math.pow(circleCenter.x - (logoRect.left + logoRect.width/2), 2) +
            Math.pow(circleCenter.y - (logoRect.top + logoRect.height/2), 2)
        );
        
        if (distance <= radius) {
            bottomLogo.querySelector('img').style.filter = 'invert(1)';
        } else {
            bottomLogo.querySelector('img').style.filter = 'invert(0)';
        }
    }

    function animate() {
        checkIntersection();
        animationFrame = requestAnimationFrame(animate);
    }

    function startLoadingAnimation() {
        if (!animationStarted && resourcesLoaded) {
            animationStarted = true;
            $('.loading-screen').addClass('exit');
            animate();
            setTimeout(function() {
                cancelAnimationFrame(animationFrame);
                $('.loading-screen').hide();
            }, 5500);
        }
    }

    var loadingScreen = {
        init: function() {
            const isFirstVisit = !localStorage.getItem('hasVisited');
            
            this.initLinks();
            this.checkResources();
            
            if (isFirstVisit) {
                localStorage.setItem('hasVisited', 'true');
            }
        },

        checkResources: function() {
            if (document.readyState === 'complete') {
                resourcesLoaded = true;
                startLoadingAnimation();
            } else {
                setTimeout(this.checkResources.bind(this), 100);
            }
        },

        initLinks: function() {
            $(document).on('click', 'a:not(.no-transition)', function(e) {
                var el = $(this);
                var url = el.attr('href');

                if (url && url.indexOf('#') != 0 && url.indexOf('tel:') != 0 && url.indexOf('mailto:') != 0 && url.indexOf('//') == -1 && !el.hasClass('ab-item') && !el.hasClass('logout-link') && !el.hasClass('no-transition')) {
                    e.preventDefault();
                    e.stopPropagation();

                    $('.loading-screen').show().removeClass('exit');
                    
                    setTimeout(function() {
                        window.location = url;
                    }, 400);
                }
            });
        }
    };

    $(window).on('load', function() {
        loadingScreen.init();
    });
})(jQuery);
