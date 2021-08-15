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

        // 1- add "listUser" permission
        $listUser = $auth->createPermission('listUser');
        $listUser->description = 'show list of users';
        $auth->add($listUser);

        // 2- add "createUser" permission
        $createUser = $auth->createPermission('createUser');
        $createUser->description = 'Create a user';
        $auth->add($createUser);

        // 3- add "updateUser" permission
        $updateUser = $auth->createPermission('updateUser');
        $updateUser->description = 'Update user';
        $auth->add($updateUser);

        // 4- add "statusUser" permission
        $statusUser = $auth->createPermission('statusUser');
        $statusUser->description = 'change status user';
        $auth->add($statusUser);

        // 5- add "deleteUser" permission
        $deleteUser = $auth->createPermission('deleteUser');
        $deleteUser->description = 'delete user';
        $auth->add($deleteUser);

        // 6- add "viewDetailsUser" permission
        $viewDetailsUser = $auth->createPermission('viewDetailsUser');
        $viewDetailsUser->description = 'show details user';
        $auth->add($viewDetailsUser);

        // 1- add "indexArticle" permission
        $listArticle = $auth->createPermission('listArticle');
        $listArticle->description = 'show list of articles';
        $auth->add($listArticle);

        // 2- add "statusArticle" permission
        $statusArticle = $auth->createPermission('statusArticle');
        $statusArticle->description = 'change status article';
        $auth->add($statusArticle);

        // 3- add "statusArticle" permission
        $viewDetailsArticle = $auth->createPermission('viewDetailsArticle');
        $viewDetailsArticle->description = 'delete user';
        $auth->add($viewDetailsArticle);

        // 4- add "statusArticle" permission
        $deleteArticle = $auth->createPermission('deleteArticle');
        $deleteArticle->description = 'delete user';
        $auth->add($deleteArticle);

        // Roles

        // add managerUser role
        $managerUser = $auth->createRole('managerUser');
        $auth->add($managerUser);
        $auth->addChild($managerUser, $listUser);
        $auth->addChild($managerUser, $createUser);
        $auth->addChild($managerUser, $updateUser);
        $auth->addChild($managerUser, $statusUser);
        $auth->addChild($managerUser, $deleteUser);
        $auth->addChild($managerUser, $viewDetailsUser);

        // add managerArticle role
        $managerArticle = $auth->createRole('managerArticle');
        $auth->add($managerArticle);
        $auth->addChild($managerArticle, $listArticle);
        $auth->addChild($managerArticle, $statusArticle);
        $auth->addChild($managerArticle, $deleteArticle);
        $auth->addChild($managerArticle, $viewDetailsArticle);

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