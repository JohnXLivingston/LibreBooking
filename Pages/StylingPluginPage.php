<?php

// debugging tools / libs
if (file_exists(ROOT_DIR . 'vendor/autoload.php')) {
    require ROOT_DIR . 'vendor/autoload.php';
}

require_once(ROOT_DIR . 'lib/Common/namespace.php');

interface IStylingPluginPage
{
    public function PageLoad();
}

class StylingPluginPage implements IStylingPluginPage
{
    public function PageLoad()
    {
        $userSession = ServiceLocator::GetServer()->GetUserSession();

        header('Content-type: text/css');
        $factory = PluginManager::Instance()->LoadStyling();
        $path = $factory->AdditionalCSS($userSession);
        if (empty($path)) {
            http_response_code(200);
            die();
        }
        if (!file_exists($path)) {
            http_response_code(404);
            die();
        }
        http_response_code(200);
        readfile($path);
        die();
    }
}
