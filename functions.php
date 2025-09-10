<?php
/**
 * Grant Insight Perfect - Functions File Loader
 * @package Grant_Insight_Perfect
 */

// セキュリティチェック
if (!defined('ABSPATH')) {
    exit;
}

// テーマバージョン定数
define('GI_THEME_VERSION', '6.2.1');
define('GI_THEME_PREFIX', 'gi_');

// 機能ファイルの読み込み
$inc_dir = get_template_directory() . '/inc/';

require_once $inc_dir . '1-theme-setup-optimized.php'; // テーマ基本設定、スクリプト（最適化版）
require_once $inc_dir . '2-post-types.php';      // 投稿タイプ、タクソノミー
require_once $inc_dir . '3-ajax-functions.php';  // AJAX関連
require_once $inc_dir . '4-helper-functions.php';// ヘルパー関数
require_once $inc_dir . '5-template-tags.php';   // テンプレート用関数
require_once $inc_dir . '6-admin-functions.php'; // 管理画面関連
require_once $inc_dir . '7-acf-setup.php';       // ACF関連
require_once $inc_dir . '8-initial-setup.php';   // 初期データ投入
require_once $inc_dir . 'performance-helpers.php'; // パフォーマンス最適化ヘルパー
require_once $inc_dir . 'critical-css.php';    // Critical CSS（FOUC対策）

/**
 * テーマの最終初期化
 */
function gi_final_init() {
    if (defined('WP_DEBUG') && WP_DEBUG) {
        error_log('Grant Insight Theme v6.2.1: Initialization completed successfully');
    }
}
add_action('wp_loaded', 'gi_final_init', 999);

/**
 * クリーンアップ処理
 */
function gi_theme_cleanup() {
    delete_option('gi_login_attempts');
    wp_cache_flush();
}
add_action('switch_theme', 'gi_theme_cleanup');