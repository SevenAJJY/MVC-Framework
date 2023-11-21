<?php

    namespace SEVENAJJY\Controllers ;

    use SEVENAJJY\Models\UserGroupsModel;

    class UsersGroupsController extends AbstractController
    {

        public function defaultAction()
        {
            $this->_language->load('template.common');
            $this->_language->load('usersgroups.default');

            $this->_data["groups"] = UserGroupsModel::getAll();

            $this->_renderView();
        }

        public function createAction()
        {
            $this->_language->load('template.common');
            $this->_language->load('usersgroups.create');
            $this->_language->load('usersgroups.labels');

            
            $this->_renderView();
        }
    }