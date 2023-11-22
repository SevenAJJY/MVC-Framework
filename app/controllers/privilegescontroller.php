<?php

    namespace SEVENAJJY\Controllers ;

use SEVENAJJY\Models\PrivilegesModel;
use SEVENAJJY\Models\UserGroupsPrivilegeModel;

    class PrivilegesController extends AbstractController
    {
        public function defaultAction()
        {
            $this->_language->load('template.common');
            $this->_language->load('privileges.default');
            $this->_language->load('privileges.messages');

            $this->_data['privileges'] = PrivilegesModel::getAll();
            $this->_renderView();
        }

        // TODO: We need to implement csrf prevention
        public function createAction()
        {
            $this->_language->load('template.common');
            $this->_language->load('privileges.labels');
            $this->_language->load('privileges.create');
            $this->_language->load('privileges.messages');


            if (isset($_POST['save'])) {
                $privilege = new PrivilegesModel();
                $privilege->PrivilegeTitle = $this->filterString($_POST['PrivilegeTitle']);
                $privilege->Privilege = $this->filterString($_POST['Privilege']);
                if ($privilege->save()) {
                    $this->redirect('/privileges');
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

            $this->_language->load('template.common');
            $this->_language->load('privileges.labels');
            $this->_language->load('privileges.edit');
            $this->_language->load('privileges.messages');

            if(isset($_POST['save'])){
                $privilege->PrivilegeTitle = $this->filterString($_POST['PrivilegeTitle']);
                $privilege->Privilege = $this->filterString($_POST['Privilege']);
                if ($privilege->save()) {
                    $this->redirect('/privileges');
                }
            }

            $this->_renderView();
        }

        public function deleteAction(){
            $id = $this->_getParams(0, 'int');
            $privilege = PrivilegesModel::getByKey($id);
            $this->_language->load('privileges.messages');


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
                $this->redirect('/privileges');
            }
        }
    }