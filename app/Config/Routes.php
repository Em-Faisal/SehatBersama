    <?php

    use CodeIgniter\Router\RouteCollection;

    /**
     * @var RouteCollection $routes
     */
        
    $routes->get('/', 'Home::index');
    $routes->get('/article/(:any)', 'Home::details/$1');

    $routes->get('/register', 'AuthController::register');
    $routes->post('/proses_register', 'AuthController::proses_register');
    $routes->get('/login', 'AuthController::login');
    $routes->post('/proses_login', 'AuthController::proses_login');
    $routes->get('/logout', 'AuthController::logout');
    
    $routes->get('/kategori', 'HomeController::kategori');
    $routes->get('/kategori/(:any)', 'HomeController::kategori_details/$1');

    $routes->group('',['filter' => 'role:user,admin'], function ($routes) {
        
        $routes->get('/home', 'HomeController::index');
        $routes->get('/articles/(:any)', 'HomeController::details/$1');
        $routes->get('/kategori', 'HomeController::kategori');
        $routes->get('/kategori/(:any)', 'HomeController::kategori_details/$1');
        $routes->post('/add-comment', 'HomeController::add_comment');

        $routes->get('/dashboard', 'DashboardController::index');
        $routes->get('/dashboard-profiles', 'DashboardController::dashboard_profiles');
        $routes->post('/update_profile/(:num)', 'DashboardController::update_profile/$1');
        $routes->post('/update_photo/(:num)', 'DashboardController::update_photo/$1');
        $routes->get('/dashboard-password', 'DashboardController::dashboard_password');
        $routes->post('/update_password/(:num)', 'DashboardController::update_password/$1');
        $routes->get('/dashboard/logout', 'DashboardController::logout');
    });

    $routes->group('', ['filter' => 'role:admin'], function ($routes) {
        $routes->get('/dashboard-articles', 'ArticleController::articles');
        $routes->get('/dashboard-articles-create', 'ArticleController::articles_create');
        $routes->post('/proses_menambahkan_artikel', 'ArticleController::proses_menambahkan_artikel');
        $routes->get('/dashboard-articles-edit/(:num)', 'ArticleController::articles_edit/$1');
        $routes->post('/proses-edit-artikel/(:num)', 'ArticleController::proses_edit_artikel/$1');
        $routes->get('/dashboard-articles-delete/(:num)', 'ArticleController::articles_delete/$1');
    });
    
    

