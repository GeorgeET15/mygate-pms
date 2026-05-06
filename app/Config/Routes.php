<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Auth routes
$routes->get('/login', 'Login::index');
$routes->post('/login/authenticate', 'Login::authenticate');
$routes->get('/login/logout', 'Login::logout');

// Admin route group
$routes->group('admin', ['namespace' => 'App\Controllers\Admin'], static function ($routes) {
    
    // Dashboard (Placeholder if no controller exists yet)
    $routes->get('dashboard', 'Dashboard::index');

    // Property Routes
    $routes->get('property', 'Property::index');
    $routes->match(['GET', 'POST'], 'property/create', 'Property::create');
    $routes->match(['GET', 'POST'], 'property/edit/(:num)', 'Property::edit/$1');
    $routes->get('property/delete/(:num)', 'Property::delete/$1');

    // Unit Routes
    $routes->get('unit', 'Unit::index');
    $routes->match(['GET', 'POST'], 'unit/create', 'Unit::create');
    $routes->match(['GET', 'POST'], 'unit/edit/(:num)', 'Unit::edit/$1');
    $routes->get('unit/delete/(:num)', 'Unit::delete/$1');

    // Tenant Routes
    $routes->get('tenant', 'Tenant::index');
    $routes->match(['GET', 'POST'], 'tenant/create', 'Tenant::create');
    $routes->match(['GET', 'POST'], 'tenant/edit/(:num)', 'Tenant::edit/$1');
    $routes->get('tenant/delete/(:num)', 'Tenant::delete/$1');

    // Lease Routes
    $routes->get('lease', 'Lease::index');
    $routes->match(['GET', 'POST'], 'lease/create', 'Lease::create');
    $routes->match(['GET', 'POST'], 'lease/edit/(:num)', 'Lease::edit/$1');
    $routes->get('lease/delete/(:num)', 'Lease::delete/$1');

    // Landlord Routes
    $routes->get('landlord', 'Landlord::index');
    $routes->match(['GET', 'POST'], 'landlord/create', 'Landlord::create');
    $routes->match(['GET', 'POST'], 'landlord/edit/(:num)', 'Landlord::edit/$1');
    $routes->get('landlord/delete/(:num)', 'Landlord::delete/$1');

    // Accounting Routes
    $routes->get('accounting/journal', 'Accounting::journal');
    $routes->match(['GET', 'POST'], 'accounting/add_journal', 'Accounting::add_journal');
    $routes->get('accounting/receipts', 'Accounting::receipts');
    $routes->match(['GET', 'POST'], 'accounting/add_receipt', 'Accounting::add_receipt');

    // Maintenance & Work Orders
    $routes->get('maintenance', 'Maintenance::index');
    $routes->get('workorder', 'WorkOrder::index');
    $routes->get('project', 'Project::index');

    // Marketing & Misc
    $routes->get('marketing', 'Marketing::index');
    $routes->match(['GET', 'POST'], 'marketing/create', 'Marketing::create');
    $routes->get('marketing/delete/(:num)', 'Marketing::delete/$1');

    $routes->get('notice', 'Notice::index');
    $routes->match(['GET', 'POST'], 'notice/create', 'Notice::create');
    $routes->match(['GET', 'POST'], 'notice/edit/(:num)', 'Notice::edit/$1');
    $routes->get('notice/delete/(:num)', 'Notice::delete/$1');

    $routes->get('quicklink', 'QuickLink::index');
    $routes->match(['GET', 'POST'], 'quicklink/create', 'QuickLink::create');
    $routes->get('quicklink/delete/(:num)', 'QuickLink::delete/$1');

    $routes->match(['GET', 'POST'], 'settings/system', 'Settings::system');
    $routes->match(['GET', 'POST'], 'settings/dashboard', 'Settings::dashboard');
    $routes->match(['GET', 'POST'], 'settings/late_fee', 'Settings::late_fee');
    $routes->get('settings/pass_storer', 'Settings::pass_storer');
    $routes->match(['GET', 'POST'], 'settings/create_pass', 'Settings::create_pass');
    $routes->get('settings/delete_pass/(:num)', 'Settings::delete_pass/$1');

    // Reports
    $routes->get('report/cashflow', 'Report::cashflow');
    $routes->get('report/graphical', 'Report::graphical');

    // Payment Routes
    $routes->get('payment', 'Payment::index');
    
    // AI Routes
    $routes->post('aichat', 'AiChat::index');
    
    // Application Routes
    $routes->get('application', 'Application::index');
    $routes->get('application/list', 'Application::list');
    $routes->match(['GET', 'POST'], 'application/create', 'Application::create');
});
