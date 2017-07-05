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
            $this->registerHook('leftColumn') &&
            $this->registerHook('header') &&
            Configuration::updateValue('NUMBERPRODUCT_NAME', 'my friend');
    }

    public function uninstall()
    {
        if (!parent::uninstall()) {
            return false;
        }
        return true;
    }

    public function getContent()
    {
        $output = null;

        if (Tools::isSubmit('submit'.$this->name)) {
            $number_producte_name = strval(Tools::getValue('NUMBERPRODUCT_NAME'));
            if (!$number_producte_name
              || empty($number_producte_name)
              || !Validate::isGenericName($number_producte_name)) {
                $output .= $this->displayError($this->l('Invalid Configuration value'));
            } else {
                Configuration::updateValue('NUMBERPRODUCT_NAME', $number_producte_name);
                $output .= $this->displayConfirmation($this->l('Settings updated'));
            }
        }
        return $output.$this->displayForm();
    }

    public function displayForm()
    {
        // Get default language
        $default_lang = (int)Configuration::get('PS_LANG_DEFAULT');

        // Init Fields form array
        $fields_form[0]['form'] = array(
            'legend' => array(
                'title' => $this->l('Settings'),
            ),
            'input' => array(
                array(
                    'type' => 'text',
                    'label' => $this->l('Configuration value'),
                    'name' => 'NUMBERPRODUCT_NAME',
                    'size' => 20,
                    'required' => true
                )
            ),
            'submit' => array(
                'title' => $this->l('Save'),
                'class' => 'btn btn-default pull-right'
            )
        );

        $helper = new HelperForm();

        // Module, token and currentIndex
        $helper->module = $this;
        $helper->name_controller = $this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->currentIndex = AdminController::$currentIndex.'&configure='.$this->name;

        // Language
        $helper->default_form_language = $default_lang;
        $helper->allow_employee_form_lang = $default_lang;

        // Title and toolbar
        $helper->title = $this->displayName;
        $helper->show_toolbar = true;        // false -> remove toolbar
        $helper->toolbar_scroll = true;      // yes - > Toolbar is always visible on the top of the screen.
        $helper->submit_action = 'submit'.$this->name;
        $helper->toolbar_btn = array(
            'save' =>
            array(
                'desc' => $this->l('Save'),
                'href' => AdminController::$currentIndex.'&configure='.$this->name.'&save'.$this->name.
                '&token='.Tools::getAdminTokenLite('AdminModules'),
            ),
            'back' => array(
                'href' => AdminController::$currentIndex.'&token='.Tools::getAdminTokenLite('AdminModules'),
                'desc' => $this->l('Back to list')
            )
        );

        // Load current value
        $helper->fields_value['NUMBERPRODUCT_NAME'] = Configuration::get('NUMBERPRODUCT_NAME');

        return $helper->generateForm($fields_form);
    }

    // public function getContent()
    // {
    //     $output = null;
    //
    //     if (Tools::isSubmit('submit'.$this->name))
    //     {
    //         $number_producte_name = strval(Tools::getValue('NUMBERPRODUCT_NAME'));
    //         if (!$number_producte_name
    //           || empty($number_producte_name)
    //           || !Validate::isGenericName($number_producte_name))
    //             $output .= $this->displayError($this->l('Invalid Configuration value'));
    //         else
    //         {
    //             Configuration::updateValue('NUMBERPRODUCT_NAME', $number_producte_name);
    //             $output .= $this->displayConfirmation($this->l('Settings updated'));
    //         }
    //     }
    //     return $output.$this->displayForm();
    // }

    public function hookDisplayLeftColumn($params)
    {
        $this->context->smarty->assign(
            array(
              'number_producte_name' => Configuration::get('NUMBERPRODUCT_NAME'),
              'number_producte_link' => $this->context->link->getModuleLink('NUMBERPRODUCT', 'display')
            )
        );
        return $this->display(_PS_MODULE_DIR_.'numberproduct/numberproduct.php', 'numberproduct.tpl');
    }

    public function hookDisplayRightColumn($params)
    {
        return $this->hookDisplayLeftColumn($params);
    }

    public function hookDisplayHeader()
    {
        $this->context->controller->addCSS($this->_path.'css/numberproduct.css', 'all');

        $this->context->smarty->assign(
            array(
              'number_producte_name' => Configuration::get('NUMBERPRODUCT_NAME'),
              'number_producte_link' => $this->context->link->getModuleLink('NUMBERPRODUCT', 'display')
            )
        );
        return $this->display(_PS_MODULE_DIR_.'numberproduct/numberproduct.php', 'numberproduct.tpl');


    }

    public static function getProductTotal() {

		$productObj = new Product();
		$products = $productObj->getProducts(Context::getContext()->language->id, 0, 0, 'id_product', 'DESC', false, true );
		return count( $products );
	}

    
}
