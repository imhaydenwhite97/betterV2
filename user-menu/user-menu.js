jQuery(document).ready(function($) {
    const userMenu = {
        init: function() {
            this.trigger = $('.user-menu-trigger');
            this.content = $('.user-menu-content');
            this.bindEvents();
        },

        bindEvents: function() {
            this.trigger.on('click', this.toggleMenu.bind(this));
            $(document).on('click', this.handleClickOutside.bind(this));
        },

        toggleMenu: function(e) {
            e.preventDefault();
            this.trigger.toggleClass('active');
            this.content.toggleClass('active');
        },

        handleClickOutside: function(e) {
            if (!this.trigger.is(e.target) && 
                !this.content.is(e.target) && 
                this.content.has(e.target).length === 0) {
                this.trigger.removeClass('active');
                this.content.removeClass('active');
            }
        }
    };

    userMenu.init();
});
