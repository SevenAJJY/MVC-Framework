<?php

    namespace SEVENAJJY\Controllers ;

use SEVENAJJY\Models\PrivilegesModel;
use SEVENAJJY\Models\UserGroupsModel;
use SEVENAJJY\Models\UserGroupsPrivilegeModel;


    class UsersGroupsController extends AbstractController
    {

        public function defaultAction()
        {
            $this->language->load('template.common');
            $this->language->load('usersgroups.default');

            $this->_data["groups"] = UserGroupsModel::getAll();

            $this->_renderView();
        }

        public function createAction()
        {
            $this->language->load('template.common');
            $this->language->load('usersgroups.create');
            $this->language->load('usersgroups.labels');

            $this->_data['privileges'] = PrivilegesModel::getAll();

            if (isset($_POST['submit'])) {
                $group = new UserGroupsModel();
                $group->GroupName = $this->filterString($_POST['GroupName']);
                if ($group->save()) {
                    /**
                     * Here we enter the data into the table that is between app_users_groups and app_users_privileges : 
                     * Name of the new table app_users_groups_privileges
                     */
                    if (isset($_POST['Privileges']) &&  is_array($_POST['Privileges'])) {
                        foreach ($_POST['Privileges'] as $privilegeId) {
                            $groupPrivilege = new UserGroupsPrivilegeModel();
                            $groupPrivilege->GroupId = $group->GroupId ;
                            $groupPrivilege->PrivilegeId = $privilegeId ;
                            $groupPrivilege->save();
                        }
                    }
                    $this->redirect('/usersgroups');
                }
            }
            $this->_renderView();
        }

        public function editAction()
        {
            $id = $this->_getParams('0', 'int');
            $group = UserGroupsModel::getByKey($id);

            if ($group === false) {
                $this->redirect('/usersgroups');
            }

            $this->language->load('template.common');
            $this->language->load('usersgroups.edit');
            $this->language->load('usersgroups.labels');

            $this->_data['group'] = $group ;
            $this->_data['privileges'] = PrivilegesModel::getAll();

            $extractPrivilegesIds = $this->_data['groupPrivileges'] = UserGroupsPrivilegeModel::getGroupPrivileges($group);

            if (isset($_POST['submit'])) {
                $group->GroupName = $this->filterString($_POST['GroupName']) ;

                if ($group->save()) {
                    if (isset($_POST['Privileges']) &&  is_array($_POST['Privileges'])) {
                        ### -> Here we will compare $extractPrivilegesIds with the modified permissions ($_POST['Privileges']) where we will delete the permissions that are not in the modified permissions !== ($_POST['Privileges'])
                        $privilegesIdsToBeDeletetd = array_diff($extractPrivilegesIds , $_POST['Privileges']);
                        ### -> Here we do the opposite
                        $privilegeIdsToBeAdded = array_diff($_POST['Privileges'] , $extractPrivilegesIds );
                        ### -> Delete the unwanted privileges
                        foreach ($privilegesIdsToBeDeletetd as $deletedPrivilege) {
                            $unwantedPrivilege = UserGroupsPrivilegeModel::getBy(['PrivilegeId' => $deletedPrivilege , 'GroupId' => $group->GroupId]);
                            $unwantedPrivilege->current()->delete();
                        }
                        ### -> Add the new privileges
                        foreach ($privilegeIdsToBeAdded as $privilegeId) {
                            $groupPrivilege = new UserGroupsPrivilegeModel();
                            $groupPrivilege->GroupId = $group->GroupId ;
                            $groupPrivilege->PrivilegeId = $privilegeId ;
                            $groupPrivilege->save();
                        }
                    }
                    $this->redirect('/usersgroups');
                    ### -> In a general summary, here we will delete the powers that were and have not been taught, and then we will add only the new ones.
                    ### -> As for the powers that were and still are, we will not add or delete them because they are in Database
                }
            }
            $this->_renderView();
        }

        public function deleteAction()
        {
            $id = $this->_getParams('0', 'int');
            $group = UserGroupsModel::getByKey($id);

            if ($group === false) {
                $this->redirect('/usersgroups');
            }

            ### -> First, we delete the user group with Privileges from
            $groupPrivileges = UserGroupsPrivilegeModel::getBy(['GroupId' => $group->GroupId]);
            if($groupPrivileges !== false){
                foreach ($groupPrivileges as $groupPrivilege) {
                    $groupPrivilege->delete();
                }
            }
            ### -> After that we clear the group to avoid a problem Constraint
            if ($group->delete()) {
                $this->redirect('/usersgroups');
            }
        }
    }