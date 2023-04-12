<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For detailed instructions you can look the title section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'title' => 'INCONSAG',
    'title_prefix' => '',
    'title_postfix' => '| INCONSAG',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For detailed instructions you can look the favicon section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_ico_only' => false,
    'use_full_favicon' => false,

    /*
    |--------------------------------------------------------------------------
    | Google Fonts
    |--------------------------------------------------------------------------
    |
    | Here you can allow or not the use of external google fonts. Disabling the
    | google fonts may be useful if your admin panel internet access is
    | restricted somehow.
    |
    | For detailed instructions you can look the google fonts section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'google_fonts' => [
        'allowed' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For detailed instructions you can look the logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'logo' => '<b></b>INCONSAG',
    'logo_img' => 'vendor/adminlte/dist/img/inc.png',
    'logo_img_class' => 'brand-image img-circle elevation-3',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'Inconsag Logo',

    /*
    |--------------------------------------------------------------------------
    | Authentication Logo
    |--------------------------------------------------------------------------
    |
    | Here you can setup an alternative logo to use on your login and register
    | screens. When disabled, the admin panel logo will be used instead.
    |
    | For detailed instructions you can look the auth logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'auth_logo' => [
        'enabled' => false,
        'img' => [
            'path' => 'vendor/adminlte/dist/img/inc.png',
            'alt' => 'Auth Logo',
            'class' => '',
            'width' => 50,
            'height' => 50,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Preloader Animation
    |--------------------------------------------------------------------------
    |
    | Here you can change the preloader animation configuration.
    |
    | For detailed instructions you can look the preloader section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'preloader' => [
        'enabled' => true,
        'img' => [
            'path' => 'vendor/adminlte/dist/img/inc.png',
            'alt' => 'AdminLTE Preloader Image',
            'effect' => 'animation__shake',
            'width' => 100,
            'height' => 80,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For detailed instructions you can look the user menu section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'usermenu_enabled' => true,
    'usermenu_header' => true,
    'usermenu_header_class' => 'bg-info',
    'usermenu_image' => false,
    'usermenu_desc' => false,
    'usermenu_profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For detailed instructions you can look the layout section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => true,
    'layout_fixed_navbar' => null,
    'layout_fixed_footer' => null,
    'layout_dark_mode' => null,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For detailed instructions you can look the auth classes section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_auth_card' => 'card-outline card-primary',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-primary',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For detailed instructions you can look the admin panel classes here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-info elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-white navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For detailed instructions you can look the sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'sidebar_mini' => 'lg',
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,
    

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For detailed instructions you can look the right sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For detailed instructions you can look the urls section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_route_url' => false,
    'dashboard_url' => '/dashboard',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => 'register',
    'password_reset_url' => 'password/reset',
    'password_email_url' => 'password/email',
    'profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Laravel Mix
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Mix option for the admin panel.
    |
    | For detailed instructions you can look the laravel mix section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'enabled_laravel_mix' => false,
    'laravel_mix_css_path' => 'css/app.css',
    'laravel_mix_js_path' => 'js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */
    
    'menu' => [
        // Navbar items:
        [
            'type'         => 'navbar-search',
            'text'         => 'search',
            'topnav_right' => false,
        ],
        [
            'text' => 'Contactos',
            'url'  => '#',
            'topnav_right' => true,
        ],
        [
            'type'         => 'fullscreen-widget',
            'topnav_right' => true,
        ],

        // Sidebar items:
        // [ buscador lateral
        //     'type' => 'sidebar-menu-search',
        //     'text' => 'Buscar',
        // ],
        [
            'text' => 'blog',
            'url'  => 'admin/blog',
            'can'  => 'manage-blog',
        ],
        // [
        //     'text'        => 'pages',
        //     'url'         => 'admin/pages',
        //     'icon'        => 'far fa-fw fa-file',
        //     'label'       => 4,
        //     'label_color' => 'success',
        // ],
        ['header' => 'Elementos '],
            [
                'text' => 'profile',
                'url'  => '/user',
                'icon' => 'fas fa-fw fa-user',
                'can'  => 'Admin.user.index',
            ],
        // [
        //     'text' => 'change_password',
        //     'url'  => '/profile/update',
        //     'icon' => 'fas fa-fw fa-lock',
        // ],
        [
            'text'    => 'Puesto Laboral',
            'icon'    => 'fa-solid fa-people-roof',
            'can'  => 'Admin.puestoLaboral.index',
            'submenu' => [
                [
                    'text' => 'Nuevo registro',
                    'url'  => '/puesto/create',
                    'icon' => 'fa-sharp fa-solid fa-file-circle-plus', //si no permite un emoji usar este para los de agregar
                ],
                [
                    'text' => 'Listado',
                    'url'  => 'puesto',
                    'icon' => 'fa-solid fa-users-rectangle',
                ],
        
            ],
        ],
        [
            'text'    => 'Oficina',
            'icon'    => 'fas fa-fw fa-building',
            'can'  => 'Admin.oficina.index',
            'submenu' => [
                [
                    'text' => 'Nuevo registro',
                    'url'  => '/oficina/create',
                    'icon' => 'fa-sharp fa-solid fa-file-circle-plus',
                    //'icon' => 'fa-solid fa-building-circle-exclamation', no hay con el signo +

                ],
                [
                    'text' => 'Listado',
                    'url'  => 'oficina',
                    'icon' => 'fa-solid fa-building-circle-check',
                ],
            ],
        ],
        [
            'text'    => 'Empleado',
            'icon'    => 'fas fa-fw fa-users',
            'can'  => 'Admin.empleado.indexEmp',
            'submenu' => [
                [
                    'text' => 'Nuevo registro',
                    'url'  => '/empleado/create',
                    'icon' => 'fa-sharp fa-solid fa-person-circle-plus',
                ],
                [
                    'text' => 'Listado',
                    'url'  => 'empleado',
                    'icon' => 'fa-solid fa-person-booth',
                ],
            ],
        ],
        [
            'text'    => 'Inventario',
            'icon'    => 'fas fa-fw fa-folder',
            'can'  => 'Admin.inventario.index',
            'submenu' => [
                [
                    'text' => 'Nuevo registro',
                    'url'  => '/inventario/create',
                    'icon' => 'fa-sharp fa-solid fa-folder-plus',
                ],
                [
                    'text' => 'Listado',
                    'url'  => 'inventario',
                    'icon' => 'fa-solid fa-folder-open',
                ],
            ],
        ],
        [
            'text'    => 'Bloques y lotes',
            'icon'    => 'fas fa-fw fa-th',
            'can'  => 'Admin.bloque.index',
            'submenu' => [
                [
                    'text' => 'Nuevo registro de bloque',
                    'url'  => '/bloque/create',
                    'icon' => 'fa-solid fa-cubes',
                ],
                [
                    'text' => 'Listado bloque',
                    'url'  => '/bloque',
                    'icon' => 'fa-solid fa-chart-simple',
                ],
                [
                    'text' => 'Nuevo registro lote',
                    'url'  => '/lote/create',
                    'icon' => 'fa-solid fa-cubes-stacked',
                ],
            ],
        ],
        [
            'text'    => 'Cliente',
            'icon'    => 'fas fa-fw fa-address-book',
            'can'  => 'Admin.cliente.index',
            'submenu' => [
                [
                    'text' => 'Nuevo registro',
                    'url'  => '/cliente/create',
                    'icon' => 'fa-solid fa-user-plus',
                ],
                [
                    'text' => 'Listado',
                    'url'  => 'cliente',
                    'icon' => 'fa-solid fa-users-line',
                ],
            ],
        ],

        [
            'text'    => 'Ventas',
           'icon'    => 'fa-solid fa-money-bill-trend-up',
          // 'icon' => 'fa-solid fa-money-check-dollar',
            'can'  => 'Admin.venta.index',
            'submenu' => [
                [
                    'text' => 'Nuevo registro',
                    'url'  => '/venta/create',
                    'icon' => 'fa-solid fa-money-check-dollar',
                ],
                [
                    'text' => 'Listado',
                    'url'  => 'venta',
                    'icon' => 'fa-solid fa-money-check',
                ],
            ],
        ],

        [
            'text'    => 'Lotes vendidos',
            'icon'    => 'fa-solid fa-hand-holding-dollar',
            'can'  => 'Admin.pago.index',
            'submenu' => [
                [
                    'text' => 'Listado lotes vendidos',
                    'url'  => '/pago',
                    'icon' => 'fa-solid fa-clipboard-list',
                ],
                [
                    'text' => 'Listado lotes liberados',
                    'url'  => '/liberado',
                    'icon' => 'fa-solid fa-unlock',
                ],
            ],
        ],

 
        [
            'text'    => 'Proveedor',
            'icon'    => 'fas fa-fw fa-user',
            'can'  => 'Admin.proveedor.index',
            'submenu' => [
                [
                    'text' => 'Nuevo registro',
                    'url'  => '/proveedor/create',
                    'icon' => 'fa-sharp fa-solid fa-person-circle-plus',
                ],
                [
                    'text' => 'Listado',
                    'url'  => 'proveedor',
                    'icon' => 'fa-solid fa-clipboard-user',
                ],
            ],
        ],
        [
            'text'    => 'Maquinaria',
            'icon'    => 'fas fa-fw fa-truck',
            'can'  => 'Admin.maquinaria.index',
            'submenu' => [
                [
                    'text' => 'Nuevo registro',
                    'url'  => '/maquinaria/create',
                    'icon' => 'fa-sharp fa-solid fa-file-circle-plus',
                ],
                [
                    'text' => 'Listado',
                    'url'  => 'maquinaria',
                    'icon' => 'fa-solid fa-sheet-plastic',
                ],
            ],
        ],
        [
            'text'    => 'Constructora',
            'icon'    => 'fa fa-screwdriver-wrench',
            'can'  => 'Admin.constructora.index',
            'submenu' => [
                [
                    'text' => 'Nuevo registro',
                    'url'  => '/constructora/create',
                    'icon' => 'fa-sharp fa-solid fa-file-circle-plus',
                ],
                [
                    'text' => 'Listado',
                    'url'  => 'constructora',
                    'icon' => 'fa-solid fa-sheet-plastic',
                ],
            ],
        ],
        [
            'text'    => 'Casas modelos',
            'icon'    => 'fas fa-fw fa-university',
            'can'  => 'Admin.casa.index',
            'submenu' => [
                [
                    'text' => 'Nuevo registro',
                    'url'  => '/casa/create',
                    'icon' => 'fa-sharp fa-solid fa-house-medical-flag',
                ],
                [
                    'text' => 'Listado',
                    'url'  => 'casa',
                    'icon' => 'fa-solid fa-warehouse',
                ],
            ],
        ],
        [
            'text'    => 'Gastos',
            'icon'    => 'fa-solid fa-receipt',
            'can'  => 'Admin.gasto.index',
            'submenu' => [
                [
                    'text' => 'Nuevo registro',
                    'icon' => 'fa-solid fa-file-circle-plus',
                    'url'  => '/gasto/create',
                ],
                [
                    'text' => 'Listado',
                    'url'  => 'gasto',
                    'icon' => 'fa-solid fa-file-zipper',
                ],
            ],
        ],
        [
            'text'    => 'Planillas',
            'icon'    => 'fa-solid fa-boxes-packing',
            'can'  => 'Admin.planilla.index',
            'submenu' => [
                [
                    'text' => 'Nuevo registro',
                    'url'  => '/planilla/create',
                    'icon' => 'fa-solid fa-file-circle-plus',
                ],
                [
                    'text' => 'Listado',
                    'url'  => 'planilla',
                    'icon' => 'fa-solid fa-box-archive',
                ],
            ],
        ],
        [
            'text'    => 'Reservaciones',
            'icon'    => 'fa-solid fa-calendar-days',
            'submenu' => [
                [
                    'text' => 'Nuevo registro',
                    'url'  => '/reservacion/create',
                    'icon' => 'fa-solid fa-calendar-plus',
                ],
                [
                    'text' => 'Listado',
                    'url'  => 'reservacion',
                    'icon' => 'fa-solid fa-calendar',
                ],
            ],
        ],
        
    /*   ['header' => 'labels'],
        [
            'text'       => 'important',
            'icon_color' => 'red',
            'url'        => '#',
        ],
        [
            'text'       => 'warning',
            'icon_color' => 'yellow',
            'url'        => '#',
        ],
        [
            'text'       => 'information',
            'icon_color' => 'cyan',
            'url'        => '#',
        ],*/
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For detailed instructions you can look the menu filters section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For detailed instructions you can look the plugins section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Plugins-Configuration
    |
    */

    'plugins' => [
        'Datatables' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
                ],
            ],
        ],
        'Select2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@8',
                ],
            ],
        ],
        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | IFrame
    |--------------------------------------------------------------------------
    |
    | Here we change the IFrame mode configuration. Note these changes will
    | only apply to the view that extends and enable the IFrame mode.
    |
    | For detailed instructions you can look the iframe mode section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/IFrame-Mode-Configuration
    |
    */

    'iframe' => [
        'default_tab' => [
            'url' => null,
            'title' => null,
        ],
        'buttons' => [
            'close' => true,
            'close_all' => true,
            'close_all_other' => true,
            'scroll_left' => true,
            'scroll_right' => true,
            'fullscreen' => true,
        ],
        'options' => [
            'loading_screen' => 1000,
            'auto_show_new_tab' => true,
            'use_navbar_items' => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Livewire support.
    |
    | For detailed instructions you can look the livewire here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'livewire' => false,
];
