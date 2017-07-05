<?php
class numberproductdisplayModuleFrontController extends ModuleFrontController
{
    public function initContent()
    {
        parent::initContent();
            $this->setTemplate('display.tpl');
    }
}
