<?php

    namespace SEVENAJJY\Controllers ;

    use SEVENAJJY\Library\FileUpload;
    use SEVENAJJY\Library\Messenger;
    use SEVENAJJY\Models\ProductCategoryModel;

    class ProductsCategoriesController extends AbstractController
{
    private $_createActionRoles =
    [
        'Name'  => 'req|alphanum|between(3,60)'
    ];

    public function defaultAction()
    {
        $this->language->load('template.common');
        $this->language->load('productscategories.default');

        $this->_data['categories'] = ProductCategoryModel::getAll();

        $this->_renderView();
    }

    public function createAction()
    {
        $this->language->load('template.common');
        $this->language->load('productscategories.create');
        $this->language->load('productscategories.labels');
        $this->language->load('productscategories.messages');
        $this->language->load('validation.errors');

        $uploadError = false;

        if(isset($_POST['submit']) && $this->isValid($this->_createActionRoles, $_POST)) {
            $category = new ProductCategoryModel();
            $category->Name = $this->filterString($_POST['Name']);

            if(!empty($_FILES['image']['name'])) {
                $uploader = new FileUpload($_FILES);
                try {
                    $uploader->upload();
                    $category->Image = $uploader->getFileName();
                    
                } catch (\Exception $e) {
                    $this->messenger->add($e->getMessage(), Messenger::APP_MESSAGE_ERROR);
                    $uploadError = true;
                }
            }
            if($uploadError === false && $category->save())
            {
                $this->messenger->add($this->language->get('message_create_success'));
                $this->redirect('/productscategories');
            } else {
                $this->messenger->add($this->language->get('message_create_failed'), Messenger::APP_MESSAGE_ERROR);
            }
        }
        $this->_renderView();
    }

    public function editAction()
    {

        $id = $this->_getParams(0, 'int');
        $category = ProductCategoryModel::getByKey($id);

        if($category === false) {
            $this->redirect('/productcategories');
        }

        $this->language->load('template.common');
        $this->language->load('productscategories.edit');
        $this->language->load('productscategories.labels');
        $this->language->load('productscategories.messages');
        $this->language->load('validation.errors');


        $this->_data['category'] = $category;
        $uploadError = false;

        if(isset($_POST['submit'])) {
            $category->Name = $this->filterString($_POST['Name']);
            if(!empty($_FILES['image']['name'])) {
                /**
                 *  Remove the old image
                 */
                if($category->Image !== '' && file_exists(IMAGES_UPLOAD_STORAGE.DS.$category->Image) && is_writable(IMAGES_UPLOAD_STORAGE)) {
                    unlink(IMAGES_UPLOAD_STORAGE.DS.$category->Image);
                }
                /**
                 * Create a new image
                 */
                $uploader = new FileUpload($_FILES);
                try {
                    $uploader->upload();
                    $category->Image = $uploader->getFileName();
                } catch (\Exception $e) {
                    $this->messenger->add($e->getMessage(), Messenger::APP_MESSAGE_ERROR);
                    $uploadError = true;
                }
            }
            if($uploadError === false && $category->save())
            {
                $this->messenger->add($this->language->get('message_create_success'));
                $this->redirect('/productscategories');
            } else {
                $this->messenger->add($this->language->get('message_create_failed'), Messenger::APP_MESSAGE_ERROR);
            }
        }

        $this->_renderView();
    }

    public function deleteAction()
    {

        $id = $this->_getParams(0, 'int');
        $category = ProductCategoryModel::getByKey($id);

        if($category === false) {
            $this->redirect('/productscategories');
        }

        $this->language->load('productscategories.messages');

        if($category->delete())
        {
            /**
             * Remove the old image
             */
            if($category->Image !== '' && file_exists(IMAGES_UPLOAD_STORAGE.DS.$category->Image)) {
                unlink(IMAGES_UPLOAD_STORAGE.DS.$category->Image);
            }
            $this->messenger->add($this->language->get('message_delete_success'));
        } else {
            $this->messenger->add($this->language->get('message_delete_failed'));
        }
        $this->redirect('/productscategories');
    }

}