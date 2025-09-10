<?php
/**
 * Grant Insight Perfect - Critical CSS
 * FOUC対策用のCritical CSS
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * クリティカルCSSを出力
 */
function gi_output_critical_css() {
    ?>
    <style id="critical-css">
        /* Critical CSS - 最初に読み込まれるべき最小限のスタイル */
        
        /* リセットと基本スタイル */
        * {
            box-sizing: border-box;
        }
        
        body {
            margin: 0;
            font-family: 'Noto Sans JP', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            line-height: 1.6;
            color: #1f2937;
            background-color: #ffffff;
        }
        
        /* ヘッダーのCriticalスタイル */
        .header-main {
            position: sticky;
            top: 0;
            background-color: #ffffff;
            border-bottom: 1px solid #e5e7eb;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
            z-index: 1000;
            transition: box-shadow 0.2s ease;
        }
        
        .header-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0.75rem 1rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            min-height: 4rem;
        }
        
        .site-logo {
            flex-shrink: 1;
            min-width: 0;
            max-width: 75%;
        }
        
        .logo-link {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: inherit;
            gap: 0.75rem;
        }
        
        .logo-main img {
            height: 3rem;
            width: auto;
            max-width: 100%;
        }
        
        .site-title-simple h1 {
            font-size: 1rem;
            font-weight: 700;
            color: #1f2937;
            margin: 0;
            line-height: 1.2;
            word-break: break-word;
        }
        
        .subtitle-simple p {
            font-size: 0.75rem;
            color: #6b7280;
            margin: 0.25rem 0 0 0;
            font-weight: 500;
        }
        
        .mobile-menu-toggle {
            flex: 0 0 auto;
        }
        
        .menu-button {
            padding: 0.75rem;
            background: transparent;
            border: none;
            cursor: pointer;
            font-size: 1.25rem;
            color: #374151;
        }
        
        .desktop-nav {
            display: none;
        }
        
        /* モバイルメニューの基本スタイル */
        .mobile-menu {
            position: fixed;
            top: 0;
            right: 0;
            width: 20rem;
            height: 100%;
            background-color: #ffffff;
            box-shadow: -5px 0 15px rgba(0, 0, 0, 0.1);
            transform: translateX(100%);
            transition: transform 0.3s ease-in-out;
            z-index: 1050;
            overflow-y: auto;
        }
        
        .mobile-overlay {
            position: fixed;
            inset: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1040;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .hidden {
            display: none !important;
        }
        
        .sr-only {
            position: absolute !important;
            width: 1px !important;
            height: 1px !important;
            padding: 0 !important;
            margin: -1px !important;
            overflow: hidden !important;
            clip: rect(0, 0, 0, 0) !important;
            white-space: nowrap !important;
            border: 0 !important;
        }
        
        /* レスポンシブ対応 */
        @media (max-width: 640px) {
            .header-container {
                padding: 0.5rem 0.75rem;
            }
            
            .site-logo {
                max-width: 70%;
            }
            
            .logo-link {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.25rem;
            }
            
            .site-title-simple h1 {
                font-size: 0.875rem;
            }
            
            .subtitle-simple {
                display: none;
            }
            
            .logo-main img {
                height: 2.5rem;
            }
            
            .mobile-menu {
                width: 100vw;
            }
        }
        
        @media (min-width: 1024px) {
            .desktop-nav {
                display: flex;
                align-items: center;
            }
            
            .mobile-menu-toggle {
                display: none;
            }
            
            .site-title-simple h1 {
                font-size: 1.5rem;
            }
            
            .logo-main img {
                height: 4rem;
            }
        }
        
        /* アクセシビリティ対応 */
        @media (prefers-reduced-motion: reduce) {
            * {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }
        
        /* フォーカス表示 */
        button:focus-visible,
        a:focus-visible {
            outline: 2px solid #3B82F6;
            outline-offset: 2px;
            border-radius: 4px;
        }
    </style>
    <?php
}

/**
 * 非同期でTailwind CSSを読み込む
 */
function gi_async_tailwind_load() {
    ?>
    <script>
        // Tailwind CSS Play CDNの非同期読み込み
        (function() {
            // すでにTailwindが読み込まれている場合はスキップ
            if (window.tailwind) return;
            
            // スクリプト要素を作成
            var script = document.createElement('script');
            script.src = 'https://cdn.tailwindcss.com';
            script.defer = true;
            
            // スクリプト読み込み完了後の処理
            script.onload = function() {
                // Tailwind設定のカスタマイズ
                if (window.tailwind && window.tailwind.config) {
                    const customConfig = {
                        theme: {
                            extend: {
                                zIndex: {
                                    'header': '1000',
                                    'mobile-menu': '1050',
                                    'overlay': '1040'
                                },
                                fontFamily: {
                                    'japanese': ['Noto Sans JP', 'sans-serif']
                                }
                            }
                        }
                    };
                    
                    // 設定をマージ
                    Object.assign(window.tailwind.config.theme.extend, customConfig.theme.extend);
                }
                
                // カスタムイベントを発火
                window.dispatchEvent(new CustomEvent('tailwind-loaded'));
            };
            
            // エラーハンドリング
            script.onerror = function() {
                console.warn('Tailwind CSSの読み込みに失敗しました');
            };
            
            // head要素に追加
            document.head.appendChild(script);
        })();
    </script>
    <?php
}

/**
 * Critical CSSを出力
 */
add_action('wp_head', 'gi_output_critical_css', 1);

/**
 * Tailwind CSSを非同期で読み込む
 */
add_action('wp_head', 'gi_async_tailwind_load', 2);