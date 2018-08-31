<?php
class ModuleHandler extends Singleton {

    public function moduleExists($name)
    {
        $moduleURL = $this->getModuleURL($name);
        return file_exists($moduleURL);
    }

    public function getModuleURL($name)
    {
        return BASEPATH."/app/modules/".$name;
    }
}