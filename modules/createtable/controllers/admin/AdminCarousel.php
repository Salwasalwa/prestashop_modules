<?php


class AdminCarouselController extends ModuleAdminController
{

    public function __construct()
    {

        $this->bootstrap = true;
        $this->table = 'blog';
        $this->className = 'CreateTable';


        $this->fields_list = array(
			'title' => array('title' => $this->l('title')),
		);

        $this->fields_form = array(
			'legend' => array(
                'title' => $this->l('title')
            ),

            'input' => array(
                array(
                    'type' => 'text',
                    'label' => $this->l('Tit'),
                    'name' => 'title',
                ),
            ),

            'submit' => array(
                'title' => $this->l('Save'),
                'class' => 'button'
            )
		);


        parent::__construct();

    }

}
