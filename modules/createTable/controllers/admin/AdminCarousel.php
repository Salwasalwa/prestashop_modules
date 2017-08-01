<?php


class AdminCarouselController extends ModuleAdminController
{

    public function __construct()
    {

        $this->table = 'blog';
        $this->className = 'createTable';
        $this->bootstrap = true;


        $this->fields_list['position'] = array(
			'name' => array('title' => $this->l('name'),
		);
		$lists = parent::renderList();
		parent::initToolbar();
		// return $lists;

        parent::__construct();
        $this->context = Context::getContext();
    }

}

?>
