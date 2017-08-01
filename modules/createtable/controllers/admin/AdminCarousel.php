<?php


class AdminCarouselController extends ModuleAdminController
{

    public function __construct()
    {

        $this->table = 'blog';
        $this->className = 'CreateTable';
        $this->bootstrap = true;


        $this->fields_list['position'] = array(
			'name' => array('title' => $this->l('name')
		);



        parent::__construct();
        
    }

}
