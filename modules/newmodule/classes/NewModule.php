<?php


class NewModule extends Module
{
    public function __construct()
    {
        $this->name = 'newmodule';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'Salwa';
        $this->need_instance = 0;
        $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('New Module');
        $this->description = $this->l('Description of my module.');

        $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');

        if (!Configuration::get('NEWMODULE_NAME')) {
            $this->warning = $this->l('No name provided');
        }
    }
    // public function install()
    // {
    //     if (!parent::install()) {
    //         return false;
    //     }
    //     return true;
    // }
    //
    // public function uninstall()
    // {
    //     if (!parent::uninstall()) {
    //         return false;
    //     }
    //     return true;
    // }
}
