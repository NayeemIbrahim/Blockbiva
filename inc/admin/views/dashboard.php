<?php
/**
 * Dashboard View
 *
 * @package Blockbiva
 */
?>

<div class="wrap blockbiva-dashboard">
    <h1>
        <?php esc_html_e('Blockbiva Dashboard', 'blockbiva'); ?>
    </h1>

    <div class="blockbiva-dashboard-content">
        <div class="blockbiva-card welcome-card">
            <h2>
                <?php esc_html_e('Welcome to Blockbiva!', 'blockbiva'); ?>
            </h2>
            <p>
                <?php esc_html_e('Thank you for choosing Blockbiva—Fast, Flexible & Gutenberg First. Follow these steps to get your site ready in minutes.', 'blockbiva'); ?>
            </p>
        </div>

        <div class="blockbiva-grid">
            <div class="blockbiva-card">
                <h3>1.
                    <?php esc_html_e('Plugins', 'blockbiva'); ?>
                </h3>
                <p>
                    <?php esc_html_e('Install the One Click Demo Import plugin to start with pre-made templates.', 'blockbiva'); ?>
                </p>
                <a href="<?php echo esc_url(admin_url('themes.php?page=tgmpa-install-plugins')); ?>"
                    class="button button-primary">
                    <?php esc_html_e('Install Plugins', 'blockbiva'); ?>
                </a>
            </div>

            <div class="blockbiva-card">
                <h3>2.
                    <?php esc_html_e('Import Demo', 'blockbiva'); ?>
                </h3>
                <p>
                    <?php esc_html_e('Once plugins are active, import the "Business Demo" with a single click.', 'blockbiva'); ?>
                </p>
                <a href="<?php echo esc_url(admin_url('themes.php?page=one-click-demo-import')); ?>"
                    class="button button-secondary">
                    <?php esc_html_e('Go to Import', 'blockbiva'); ?>
                </a>
            </div>

            <div class="blockbiva-card">
                <h3>3.
                    <?php esc_html_e('Customize', 'blockbiva'); ?>
                </h3>
                <p>
                    <?php esc_html_e('Tailor your site using the built-in WordPress Customizer.', 'blockbiva'); ?>
                </p>
                <a href="<?php echo esc_url(admin_url('customize.php')); ?>" class="button button-secondary">
                    <?php esc_html_e('Open Customizer', 'blockbiva'); ?>
                </a>
            </div>

            <div class="blockbiva-card">
                <h3>4.
                    <?php esc_html_e('Documentation', 'blockbiva'); ?>
                </h3>
                <p>
                    <?php esc_html_e('Need help? Read our clean and simple documentation.', 'blockbiva'); ?>
                </p>
                <a href="#" class="button button-link">
                    <?php esc_html_e('View Docs', 'blockbiva'); ?>
                </a>
            </div>
        </div>
    </div>
</div>