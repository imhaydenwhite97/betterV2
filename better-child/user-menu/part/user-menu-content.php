<div class="user-menu-content">
    <?php if (is_user_logged_in()): 
        $current_user = wp_get_current_user();
    ?>
        <div class="user-info">
            <div class="user-avatar-large">
                <?php echo get_avatar($current_user->ID, 64); ?>
            </div>
            <div class="user-details">
                <h3><?php echo $current_user->display_name; ?></h3>
                <span><?php echo $current_user->user_email; ?></span>
            </div>
        </div>
        <nav class="user-navigation">
            <a href="/dashboard" class="menu-item">
                <i class="dashboard icon"></i>
                Dashboard
            </a>
            <a href="/bookmarks" class="menu-item">
                <i class="bookmark icon"></i>
                Bookmarks
            </a>
            <a href="/profile" class="menu-item">
                <i class="user icon"></i>
                Profile Settings
            </a>
            <a href="<?php echo wp_logout_url(home_url()); ?>" class="menu-item">
                <i class="sign-out icon"></i>
                Logout
            </a>
        </nav>
    <?php else: ?>
        <div class="auth-buttons">
            <a href="/login" class="login-btn">Login</a>
            <a href="/register" class="register-btn">Sign Up</a>
        </div>
    <?php endif; ?>
</div>
