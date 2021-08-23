<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

class MasterAsset extends AssetBundle
{
    public $basePath = '@webroot/master_asset';
    public $baseUrl = '@web/master_asset';
    public $css = [
        // Vendor CSS
        'vendors/css/vendors.min.css',
        'vendors/css/extensions/swiper.min.css',

        // Theme CSS
        'css/bootstrap.min.css',
        'css/bootstrap-extended.css',
        'css/colors.css',
        'css/components.css',
        'css/themes/dark-layout.css',
        'css/themes/semi-dark-layout.css',
        'css/custom.css',

        // Page CSS
        'css/core/menu/menu-types/vertical-menu.css',
        'css/pages/dashboard-ecommerce.css',
    ];
    public $js = [
        // Vendor JS
        'vendors/js/vendors.min.js',
        'fonts/LivIconsEvo/js/LivIconsEvo.tools.min.js',
        'fonts/LivIconsEvo/js/LivIconsEvo.defaults.js',
        'fonts/LivIconsEvo/js/LivIconsEvo.min.js',


        // Page Vendor JS
        'vendors/js/extensions/swiper.min.js',

        // Theme JS
        'js/scripts/configs/vertical-menu-light.js',
        'js/core/app-menu.js',
        'js/core/app.js',
        'js/scripts/components.js',
        'js/scripts/footer.js',
        'js/scripts/customizer.js',
    ];
    public $depends = [
    ];
}
