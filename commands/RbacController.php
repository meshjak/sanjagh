<?php
namespace app\commands;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();

        // add "listUser" permission
        $listUser = $auth->createPermission('listUser');
        $listUser->description = 'show list of users';
        $auth->add($listUser);

        // add "createUser" permission
        $createUser = $auth->createPermission('createUser');
        $createUser->description = 'Create a user';
        $auth->add($createUser);

        // add "updateUser" permission
        $updateUser = $auth->createPermission('updateUser');
        $updateUser->description = 'Update user';
        $auth->add($updateUser);

        // add "statusUser" permission
        $statusUser = $auth->createPermission('statusUser');
        $statusUser->description = 'change status user';
        $auth->add($statusUser);

        // add "deleteUser" permission
        $deleteUser = $auth->createPermission('deleteUser');
        $deleteUser->description = 'delete user';
        $auth->add($deleteUser);

        // add "viewDetailsUser" permission
        $viewDetailsUser = $auth->createPermission('viewDetailsUser');
        $viewDetailsUser->description = 'show details user';
        $auth->add($viewDetailsUser);

        // add "indexArticle" permission
        $indexArticle = $auth->createPermission('indexArticle');
        $indexArticle->description = 'delete user';
        $auth->add($indexArticle);

        // add "statusArticle" permission
        $statusArticle = $auth->createPermission('statusArticle');
        $statusArticle->description = 'delete user';
        $auth->add($statusArticle);

        // Roles

        // add managerUser role
        $managerUser = $auth->createRole('managerUser');
        $auth->add($managerUser);
        $auth->addChild($managerUser, $listUser);
        $auth->addChild($managerUser, $createUser);
        $auth->addChild($managerUser, $updateUser);
        $auth->addChild($managerUser, $statusUser);
        $auth->addChild($managerUser, $deleteUser);

        // add managerArticle role
        $managerArticle = $auth->createRole('managerArticle');
        $auth->add($managerArticle);
        $auth->addChild($managerArticle, $indexArticle);
        $auth->addChild($managerArticle, $createUser);

        // add superAdmin
        $superAdmin = $auth->createRole('superAdmin');
        $auth->add($superAdmin);
        $auth->addChild($superAdmin, $managerUser);
        $auth->addChild($superAdmin, $managerArticle);

        $auth->assign($superAdmin, 1);
        $auth->assign($managerArticle, 2);
        $auth->assign($managerUser, 3);
    }
}