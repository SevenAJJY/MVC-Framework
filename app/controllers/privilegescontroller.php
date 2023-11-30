<?php

    namespace SEVENAJJY\Controllers ;

use SEVENAJJY\Models\PrivilegesModel;
use SEVENAJJY\Models\UserGroupsPrivilegeModel;

    class PrivilegesController extends AbstractController
    {
        public function defaultAction()
        {
            $this->language->load('template.common');
            $this->language->load('privileges.default');
            $this->language->load('privileges.messages');

            $this->_data['privileges'] = PrivilegesModel::getAll();
            $this->_renderView();
        }

        // TODO: We need to implement csrf prevention
        public function createAction()
        {
            $this->language->load('template.common');
            $this->language->load('privileges.labels');
            $this->language->load('privileges.create');
            $this->language->load('privileges.messages');


            if (isset($_POST['save'])) {
                $privilege = new PrivilegesModel();
                $privilege->PrivilegeTitle = $this->filterString($_POST['PrivilegeTitle']);
                $privilege->Privilege = $this->filterString($_POST['Privilege']);
                if ($privilege->save()) {
                    $this->messenger->add($this->language->get('message_create_success'));
                    $this->redirect('/privileges');
                }
                else{
                    $this->messenger->add($this->language->get('message_create_failed'));
                }
                $this->redirect('/privileges');
            }
            $this->_renderView();
        }
        
        public function editAction(){
            $id = $this->_getParams(0, 'int');
            $privilege = PrivilegesModel::getByKey($id);

            if (!$privilege) {
                $this->redirect('/privileges');
            }
            $this->_data['privilege'] = $privilege ;

            $this->language->load('template.common');
            $this->language->load('privileges.labels');
            $this->language->load('privileges.edit');
            $this->language->load('privileges.messages');

            if(isset($_POST['save'])){
                $privilege->PrivilegeTitle = $this->filterString($_POST['PrivilegeTitle']);
                $privilege->Privilege = $this->filterString($_POST['Privilege']);
                if ($privilege->save()) {
                    $this->messenger->add($this->language->get('message_edit_success'));
                    $this->redirect('/privileges');
                }
            }

            $this->_renderView();
        }

        public function deleteAction(){
            $id = $this->_getParams(0, 'int');
            $privilege = PrivilegesModel::getByKey($id);
            $this->language->load('privileges.messages');


            if($privilege === false) {
                $this->redirect('/privileges');
            }

            ### -> To remove the privilege, you must make sure that there is no group approved or associated with this privilege to have a constraint issue (foreign key)
            $groupPrivileges = UserGroupsPrivilegeModel::getBy(['PrivilegeId' => $privilege->PrivilegeId]) ;
            if (false !== $groupPrivileges) {
                foreach ($groupPrivileges as $groupPrivilege) {
                    $groupPrivilege->delete();
                }
            }

            if ($privilege->delete()) {
                $this->messenger->add($this->language->get('message_delete_success'));
                $this->redirect('/privileges');
            }
        }
    }