<?php


namespace SEVENAJJY\Controllers;

use SEVENAJJY\Models\ClientInvoiceModel;
use SEVENAJJY\Models\ClientModel;
use SEVENAJJY\Models\SupplierInvoiceModel;
use SEVENAJJY\Models\UserModel;

class IndexController extends AbstractController
{
    public function defaultAction()
    {
        $this->language->load('template.common');
        $this->language->load('index.default');

        $this->_data['totalUsers'] = UserModel::count();
        $this->_data['totalClients'] = ClientModel::count();
        $this->_data['totalSales'] = ClientInvoiceModel::count();
        $this->_data['totalPurchases'] = SupplierInvoiceModel::count();

        $this->_renderView();
    }

}