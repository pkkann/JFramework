<?php
// TODO: Design router
class Router extends Singleton {

    public function route()
    {
        if( isset($_GET['module']) && isset($_GET['action']) )
        {

            // Get parameters
            $module = $_GET['module'];
            $action = $_GET['action'];
            $params = $_GET;
            array_shift($params);
            array_shift($params);

            if(ModuleHandler::Instance()->moduleExists($module) === FALSE)
            {
                throw new ModuleException("Module '".$module."' was not found");
            }

            $routes = $this->getRoutes($module);
            if( isset($routes->{$action}) === FALSE ) {
                throw new ModuleException("Action '".$action."' for module '".$module."' was not found");
            }
            $action = $routes->{$action};


        }
    }

    public function routesFileExists($moduleName)
    {
        $moduleURL = ModuleHandler::Instance()->getModuleURL($moduleName);
        return file_exists($moduleURL."/routes.json");
    }

    public function getRoutes($moduleName)
    {
        if( $this->routesFileExists($moduleName) === FALSE)
        {
            throw new ModuleException("Routes file for module '".$moduleName."' was not found");
        }
        $moduleURL = ModuleHandler::Instance()->getModuleURL($moduleName);
        return json_decode(file_get_contents($moduleURL."/routes.json"));
    }
}