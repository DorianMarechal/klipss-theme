<?php
/**
 * Main template file (fallback - required by WordPress)
 *
 * This file is required by WordPress but won't be used:
 * - Homepage → front-page.php
 * - Pages (CGV, CGU, etc.) → page.php
 */

// Redirect to homepage if someone lands here
wp_redirect(home_url('/'));
exit;
