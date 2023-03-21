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

    'title' => 'Inconsag',
    'title_prefix' => '',
    'title_postfix' => '| Inconsag',

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

    'logo' => '<b>I</b>nconsag',
    'logo_img' => 'vendor/adminlte/dist/img/inc.jpeg',
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
            'path' => 'vendor/adminlte/dist/img/inc.jpeg',
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
            'path' => 'vendor/adminlte/dist/img/inc.jpeg',
            'alt' => 'AdminLTE Preloader Image',
            'effect' => 'animation__shake',
            'width' => 65,
            'height' => 60,
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
    'dashboard_url' => '/cliente',
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
            'icon'    => 'fas fa-fw fa-address-card',
            'can'  => 'Admin.puestoLaboral.index',
            'submenu' => [
                [
                    'text' => 'Registro nuevo',
                    'url'  => '/puesto/create',
                ],
                [
                    'text' => 'Listado',
                    'url'  => 'puesto',
                ],
                [
                    'text'    => 'level_one',
                    'url'     => '#',
                    'submenu' => [
                        [
                            'text' => 'level_two',
                            'url'  => '#',
                        ],
                        [
                            'text'    => 'level_two',
                            'url'     => '#',
                            'submenu' => [
                                [
                                    'text' => 'level_three',
                                    'url'  => '#',
                                ],
                                [
                                    'text' => 'level_three',
                                    'url'  => '#',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'text'    => 'Oficina',
            'icon'    => 'fas fa-fw fa-building',
            'can'  => 'Admin.oficina.index',
            'submenu' => [
                [
                    'text' => 'Registro nuevo',
                    'url'  => '/oficina/create',
                ],
                [
                    'text' => 'Listado',
                    'url'  => 'oficina',
                ],
            ],
        ],
        [
            'text'    => 'Empleado',
            'icon'    => 'fas fa-fw fa-users',
            'can'  => 'Admin.empleado.indexEmp',
            'submenu' => [
                [
                    'text' => 'Registro nuevo',
                    'url'  => '/empleado/create',
                ],
                [
                    'text' => 'Listado',
                    'url'  => 'empleado',
                ],
            ],
        ],
        [
            'text'    => 'Inventario',
            'icon'    => 'fas fa-fw fa-folder',
            'can'  => 'Admin.inventario.index',
            'submenu' => [
                [
                    'text' => 'Registro nuevo',
                    'url'  => '/inventario/create',
                ],
                [
                    'text' => 'Listado',
                    'url'  => 'inventario',
                ],
            ],
        ],
        [
            'text'    => 'Proveedor',
            'icon'    => 'fas fa-fw fa-user',
            'can'  => 'Admin.proveedor.index',
            'submenu' => [
                [
                    'text' => 'Registro nuevo',
                    'url'  => '/proveedor/create',
                ],
                [
                    'text' => 'Listado',
                    'url'  => 'proveedor',
                ],
            ],
        ],
        [
            'text'    => 'Maquinaria',
            'icon'    => 'fas fa-fw fa-truck',
            'can'  => 'Admin.maquinaria.index',
            'submenu' => [
                [
                    'text' => 'Registro nuevo',
                    'url'  => '/maquinaria/create',
                ],
                [
                    'text' => 'Listado',
                    'url'  => 'maquinaria',
                ],
            ],
        ],
        [
            'text'    => 'Bloques y lotes',
            'icon'    => 'fas fa-fw fa-th',
            'can'  => 'Admin.bloque.index',
            'submenu' => [
                [
                    'text' => 'Registro nuevo bloque',
                    'url'  => '/bloque/create',
                ],
                [
                    'text' => 'Listado bloque',
                    'url'  => '/bloque',
                ],
                [
                    'text' => 'Registro nuevo lote',
                    'url'  => '/lote/create',
                ],
            ],
        ],
        [
            'text'    => 'Lotes vendidos',
            'icon'    => 'fas fa-fw fa-th-large',
            'can'  => 'Admin.pago.index',
            'submenu' => [
                [
                    'text' => 'Listado lotes vendidos',
                    'url'  => '/pago',
                ],
                [
                    'text' => 'Listado lotes liberados',
                    'url'  => '/liberado',
                ],
            ],
        ],
        [
            'text'    => 'Cliente',
            'icon'    => 'fas fa-fw fa-address-book',
            'can'  => 'Admin.cliente.index',
            'submenu' => [
                [
                    'text' => 'Registro nuevo',
                    'url'  => '/cliente/create',
                ],
                [
                    'text' => 'Listado',
                    'url'  => 'cliente',
                ],
            ],
        ],
        [
            'text'    => 'Ventas',
            'icon'    => 'fas fa-fw fa-chevron-circle-down',
            'can'  => 'Admin.venta.index',
            'submenu' => [
                [
                    'text' => 'Registro nuevo',
                    'url'  => '/venta/create',
                ],
                [
                    'text' => 'Listado',
                    'url'  => 'venta',
                ],
            ],
        ],
        [
            'text'    => 'Constructora',
            'icon'    => 'fas fa-fw fa-archive',
            'can'  => 'Admin.constructora.index',
            'submenu' => [
                [
                    'text' => 'Registro nuevo',
                    'url'  => '/constructora/create',
                ],
                [
                    'text' => 'Listado',
                    'url'  => 'constructora',
                ],
            ],
        ],
        [
            'text'    => 'Casas modelos',
            'icon'    => 'fas fa-fw fa-university',
            'can'  => 'Admin.casa.index',
            'submenu' => [
                [
                    'text' => 'Registro nuevo',
                    'url'  => '/casa/create',
                ],
                [
                    'text' => 'Listado',
                    'url'  => 'casa',
                ],
            ],
        ],
        [
            'text'    => 'Gastos',
            'icon'    => 'fas fa-fw fa-file',
            'can'  => 'Admin.gasto.index',
            'submenu' => [
                [
                    'text' => 'Registro nuevo',
                    'url'  => '/gasto/create',
                ],
                [
                    'text' => 'Listado',
                    'url'  => 'gasto',
                ],
            ],
        ],
        [
            'text'    => 'Planillas',
            'icon'    => 'fas fa-fw fa-file',
            'can'  => 'Admin.planilla.index',
            'submenu' => [
                [
                    'text' => 'Registro nuevo',
                    'url'  => '/planilla/create',
                ],
                [
                    'text' => 'Listado',
                    'url'  => 'planilla',
                ],
            ],
        ],
        [
            'text'    => 'Reservaciones',
            'icon'    => 'fas fa-fw fa-file',
            'submenu' => [
                [
                    'text' => 'Registro nuevo',
                    'url'  => '/gasto/create',
                ],
                [
                    'text' => 'Listado',
                    'url'  => 'gasto',
                ],
            ],
        ],
        
        ['header' => 'labels'],
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
        ],
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