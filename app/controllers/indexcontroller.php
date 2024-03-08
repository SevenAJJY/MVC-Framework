<?php


namespace SEVENAJJY\Controllers;

use SEVENAJJY\Models\ClientInvoiceModel;
use SEVENAJJY\Models\ClientModel;
use SEVENAJJY\Models\DailyExpensesModel;
use SEVENAJJY\Models\PrivilegesModel;
use SEVENAJJY\Models\ProductCategoryModel;
use SEVENAJJY\Models\ProductModel;
use SEVENAJJY\Models\SupplierInvoiceModel;
use SEVENAJJY\Models\SupplierModel;
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
        $this->_data['totalSuppliers'] = SupplierModel::count();
        $this->_data['totalProducts'] = ProductModel::count();
        $this->_data['totalDailyExp'] = DailyExpensesModel::count();
        $this->_data['totalProductscategories'] = ProductCategoryModel::count();
        $this->_data['totalPrivileges'] = PrivilegesModel::count();

        $this->_renderView();
    }

}