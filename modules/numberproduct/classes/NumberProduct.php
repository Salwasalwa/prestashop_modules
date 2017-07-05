<?php


class NumberProduct extends Module
{
    public function __construct()
    {
        $this->name = 'numberproduct';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'Salwa';
        $this->need_instance = 0;
        $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Number Product');
        $this->description = $this->l('Description of my module.');

        $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');

        if (!Configuration::get('NUMBERPRODUCT_NAME')) {
            $this->warning = $this->l('No name provided');
        }
    }
    public function install()
    {
        if (Shop::isFeatureActive()) {
            Shop::setContext(Shop::CONTEXT_ALL);
        }

        return parent::install() &&
            $this->registerHook('top') &&
            $this->registerHook('header') &&
            Configuration::updateValue('NUMBERPRODUCT_NAME', 'Hello');
    }

    public function uninstall()
    {
        if (!parent::uninstall()) {
            return false;
        }
        return true;
    }
    public function hookDisplayTop()
    {
        $this->context->smarty->assign(
            array(
              'number_producte_name' => Configuration::get('NUMBERPRODUCT_NAME'),
              'number_producte_link' => $this->context->link->getModuleLink('NUMBERPRODUCT', 'display')
            )
        );
        return $this->display(_PS_MODULE_DIR_.'numberproduct/numberproduct.php', 'numberproduct.tpl');
    }

    public function hookDisplayHeader()
    {
        $this->context->controller->addCSS($this->_path.'css/numberproduct.css', 'all');

    }

    public static function getProductTotal() {

		$productObj = new Product();
		$products = $productObj->getProducts(Context::getContext()->language->id, 0, 0, 'id_product', 'DESC', false, true );
		return count( $products );
	}


}
