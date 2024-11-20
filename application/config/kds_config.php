    <?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    /*
    |--------------------------------------------------------------------------
    | Custom Config
    |--------------------------------------------------------------------------
    |
    | Put custom config in this class. 
    | To be loaded automatically, this class need to register
    | to $autoload['libraries'] in "config/autoload.php"
    */
    $config['PATH_URI_LOGIN'] = "accounts/accounts/login";
    $config['PATH_URI_LOGIN_AUTHENTICATION'] = "accounts/accounts/login_auth";
    $config['PATH_URI_LOGIN_AUTHENTICATION_API'] = "api/accounts/login_api";
    $config['PATH_URI_LOGOUT'] = "accounts/accounts/logout";
    $config['PATH_URI_LOGOUT_API'] = "api/accounts/logout_api";
    $config['PATH_URI_SWITCH_LANGUAGE'] = "accounts/accounts/lang";

    $config['PATH_URL_SYNCHRONIZE_STORE_HO'] = "http://localhost/ho_bez/index.php/synchronize/store_head_office_factory/";
    $config['PATH_URI_SYNCHRONIZE_AUTHENTICATION_STORE_HO'] = "synchronize/store_head_office_factory";
    $config['PATH_URI_SYNCHRONIZE_AUTHENTICATION_CLIENT'] = "synchronize/store_factory";

    $config['PATH_ROOT_SYNCHRONIZE_STORE_HO_DIRECTORY'] = "archive/synchronized_files/";
    $config['PATH_ROOT_SYNCHRONIZE_STORE_DIRECTORY'] = "archive/store/";

    $config['STORE_HO_SERIAL_NUMBER'] = "9cf91f70-90a9-4335-9d5f-fd9381ef3309";//"Central Distribution Mendrisio"
    $config['STORE_SERIAL_NUMBER'] = "dc83ff00-8dac-4d96-e9fa-e90f40f57d32";//"Net SOHO Park"
    $config['STORE_CODE'] = "221301";//"Net SOHO Park"
