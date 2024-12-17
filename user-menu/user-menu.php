<div class="user-menu-container">
    <?php if (is_user_logged_in()): 
        $current_user = wp_get_current_user();
    ?>
        <button class="user-menu-trigger">
            <?php echo get_avatar($current_user->ID, 32); ?>
        </button>
        <div class="user-menu-content">
            <div class="user-info">
                <?php echo get_avatar($current_user->ID, 64); ?>
                <h3><?php echo $current_user->display_name; ?></h3>
            </div>
            <nav class="user-navigation">
                <a href="/dashboard" class="menu-item">
                    <i class="dashboard icon"></i> Dashboard
                </a>
                <a href="/bookmarks" class="menu-item">
                    <i class="bookmark icon"></i> Bookmarks
                </a>
                <a href="/profile" class="menu-item">
                    <i class="user icon"></i> Profile
                </a>
                <a href="<?php echo wp_logout_url(home_url()); ?>" class="menu-item">
                    <i class="sign out icon"></i> Logout
                </a>
            </nav>
        </div>
    <?php else: ?>
        <div class="auth-buttons">
            <a href="/login" class="ui button">Login</a>
            <a href="/register" class="ui primary button">Sign Up</a>
        </div>
    <?php endif; ?>
</div>
