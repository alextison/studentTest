<?php


class StudentTest extends Module
{

    public function __construct()
    {
        $this->name = 'studenttest';
        $this->tab = 'front_office_features';
        $this->version = '1.0';
        $this->author = 'Nhust';
        $this->need_instance = 0;

        $this->bootstrap = true;
        parent::__construct();

        $this->displayName = $this->l('Module Student');
        $this->description = $this->l('Displays something in product page.');
        $this->ps_versions_compliancy = array('min' => '1.6', 'max' => '1.6.99.99');
    }


    public function install()
    {
        return
            parent::install() && $this->registerHook('displayHeader')
            && $this->registerHook('displayAdminProductsExtra')
            && $this->registerHook('displayProductTab');
    }

    public function hookDisplayAdminProductsExtra($params)
    {

        $product = new Product((int)$params['id_product']);

        if (Tools::isSubmit('submitAddCustomField')) {
            $product->short_desc = Tools::getValue('short_desc');
            $product->save();
        }
    
        return '
            <form method="post" action="">
                <label for="short_desc">' . $this->l('Short Desc') . ':</label>
                <input type="text" name="short_desc" value="' . $product->short_desc . '" />
                <button type="submit" name="submitAddCustomField"' . $this->l('Save') . '</button>
            </form>
        ';
    
    }

    public function hookDisplayProductTab($params)
    {
        $product = new Product($params['product']->id);

        $shortDesc = $product->short_desc;
  
        return
        '<div class="short_desc">
            <h3>Description courte</h3>'. $shortDesc . 
        '</div>';

    }

}
