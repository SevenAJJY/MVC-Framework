<?php

namespace SEVENAJJY\Controllers ;

use SEVENAJJY\LIBRARY\FileUpload;
use SEVENAJJY\LIBRARY\Messenger;
use SEVENAJJY\Models\ProductCategoryModel;
use SEVENAJJY\Models\ProductModel;

class ProductListController extends AbstractController
{
    private $_createActionRoles =
    [
        'CategoryId'  => 'req|num',
        'Name'        => 'req|alphanum|between(3,50)',
        'Quantity'    => 'req|num',
        'BuyPrice'    => 'req|num',
        'SellPrice'   => 'req|num',
        'Unit'        => 'req|num',
    ];

    public function defaultAction()
    {
        $this->language->load('template.common');
        $this->language->load('productlist.default');

        $this->_data['products'] = ProductModel::getAll();

        $this->_renderView();
    }

    public function createAction()
    {
        $this->language->load('template.common');
        $this->language->load('productlist.create');
        $this->language->load('productlist.labels');
        $this->language->load('productlist.messages');
        $this->language->load('productlist.units');
        $this->language->load('validation.errors');

        $this->_data['categories'] = ProductCategoryModel::getAll();

        $uploadError = false;

        if(isset($_POST['submit']) && $this->isValid($this->_createActionRoles, $_POST)) {
            $product = new ProductModel();
            $product->Name = $this->filterString($_POST['Name']);
            $product->CategoryId = $this->filterInt($_POST['CategoryId']);
            $product->Quantity = $this->filterInt($_POST['Quantity']);
            $product->BuyPrice = $this->filterFloat($_POST['BuyPrice']);
            $product->SellPrice = $this->filterFloat($_POST['SellPrice']);
            $product->Unit = $this->filterInt($_POST['Unit']);

            if(!empty($_FILES['image']['name'])) {
                $uploader = new FileUpload($_FILES);
                try {
                    $uploader->upload();
                    $product->Image = $uploader->getFileName();
                    
                } catch (\Exception $e) {
                    $this->messenger->add($e->getMessage(), Messenger::APP_MESSAGE_ERROR);
                    $uploadError = true;
                }
            }
            if($uploadError === false && $product->save())
            {
                $this->messenger->add($this->language->get('message_create_success'));
                $this->redirect('/productlist');
            } else {
                $this->messenger->add($this->language->get('message_create_failed'), Messenger::APP_MESSAGE_ERROR);
            }
        }

        $this->_renderView();
    }

    public function editAction()
    {

        $id = $this->_getParams(0, 'int');
        $product = ProductModel::getByKey($id);

        if($product === false) {
            $this->redirect('/productlist');
        }

        $this->language->load('template.common');
        $this->language->load('productlist.edit');
        $this->language->load('productlist.labels');
        $this->language->load('productlist.messages');
        $this->language->load('productlist.units');
        $this->language->load('validation.errors');


        $this->_data['product'] = $product;
        $this->_data['categories'] = ProductCategoryModel::getAll();

        $uploadError = false;

        if(isset($_POST['submit'])) {
            $product->Name = $this->filterString($_POST['Name']);
            $product->CategoryId = $this->filterInt($_POST['CategoryId']);
            $product->Quantity = $this->filterInt($_POST['Quantity']);
            $product->BuyPrice = $this->filterFloat($_POST['BuyPrice']);
            $product->SellPrice = $this->filterFloat($_POST['SellPrice']);
            $product->Unit = $this->filterInt($_POST['Unit']);
            if(!empty($_FILES['image']['name'])) {
                // Remove the old image
                if($product->Image !== '' && file_exists(IMAGES_UPLOAD_STORAGE.DS.$product->Image) && is_writable(IMAGES_UPLOAD_STORAGE)) {
                    unlink(IMAGES_UPLOAD_STORAGE.DS.$product->Image);
                }
                // Create a new image
                $uploader = new FileUpload($_FILES);
                try {
                    $uploader->upload();
                    $product->Image = $uploader->getFileName();
                } catch (\Exception $e) {
                    $this->messenger->add($e->getMessage(), Messenger::APP_MESSAGE_ERROR);
                    $uploadError = true;
                }
            }
            if($uploadError === false && $product->save())
            {
                $this->messenger->add($this->language->get('message_create_success'));
                $this->redirect('/productlist');
            } else {
                $this->messenger->add($this->language->get('message_create_failed'), Messenger::APP_MESSAGE_ERROR);
            }
        }

        $this->_renderView();
    }

    public function deleteAction()
    {

        $id = $this->_getParams(0, 'int');
        $product = ProductModel::getByKey($id);

        if($product === false) {
            $this->redirect('/productlist');
        }

        $this->language->load('productlist.messages');

        if($product->delete())
        {
            // Remove the old image
            if($product->Image !== '' && file_exists(IMAGES_UPLOAD_STORAGE.DS.$product->Image)) {
                unlink(IMAGES_UPLOAD_STORAGE.DS.$product->Image);
            }
            $this->messenger->add($this->language->get('message_delete_success'));
        } else {
            $this->messenger->add($this->language->get('message_delete_failed'));
        }
        $this->redirect('/productlist');
    }
}