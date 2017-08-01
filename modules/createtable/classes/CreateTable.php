<?php


class CreateTable extends Module
{
    public function __construct()
    {
        $this->name = 'createtable';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'Salwa';
        $this->need_instance = 0;
        $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Create Table');
        $this->description = $this->l('Description of my module.');


        $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');

        if (!Configuration::get('CreateTable_NAME')) {
            $this->warning = $this->l('No name provided');
        }
    }
    public function install()
    {
        return parent::install() &&
        $this->installBD() &&
        $this->addAdminTab();

    }

    public function uninstall()
    {
        // Call uninstall parent method
        return parent::uninstall() &&
        $this->uninstallBD() &&
        $this->removeAdminTab();
    }
    public function installBD()
    {
        return Db::getInstance()->execute('
        CREATE TABLE `'.
        _DB_PREFIX_.'test`(
            `id_test` INT UNSIGNED NOT NULL AUTO_INCREMENT,
            `name` VARCHAR(255) NOT NULL,
            PRIMARY KEY (`id_test`)
            ) DEFAULT CHARSET=utf8;');
    }

    public function uninstallBD()
    {
        return Db::getInstance()->execute('
        DROP TABLE `'.
        _DB_PREFIX_.'blog`');
    }

    // Ajout d'onglet
    public function addAdminTab()
    {
        $tab = new Tab();
        foreach(Language::getLanguages(false) as $lang)
            $tab->name[(int) $lang['id_lang']] = 'CreateTable';
        // Nom du controller sans le mot clé "Controller"
            $tab->class_name = 'AdminCarousel';
            $tab->module = $this->name;
            $tab->id_parent = 0;
            if (!$tab->save())
                return false;
            return true;
    }
    // Suppression d'onglets
    public function removeAdminTab()
    {
        $classNames = array('admin_carousel' => 'AdminCarousel');
        $return = true;
        foreach ($classNames as $key => $className) {
            $tab = new Tab(Tab::getIdFromClassName($className));
            $return &= $tab->delete();
        }
        return $return;
    }
}
