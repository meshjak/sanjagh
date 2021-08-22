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

        // 3- add "viewDetailsArticle" permission
        $viewDetailsArticle = $auth->createPermission('viewDetailsArticle');
        $viewDetailsArticle->description = 'delete article';
        $auth->add($viewDetailsArticle);

        // 4- add "statusArticle" permission
        $deleteArticle = $auth->createPermission('deleteArticle');
        $deleteArticle->description = 'delete article';
        $auth->add($deleteArticle);

        // 1- add "listComment" permission
        $listComment = $auth->createPermission('listComment');
        $listComment->description = 'show list of comments';
        $auth->add($listComment);

        // 2- add "statusComment" permission
        $statusComment = $auth->createPermission('statusComment');
        $statusComment->description = 'change status comment';
        $auth->add($statusComment);

        // 3- add "viewDetailsComment" permission
        $viewDetailsComment = $auth->createPermission('viewDetailsComment');
        $viewDetailsComment->description = 'view comment';
        $auth->add($viewDetailsComment);

        // 4- add "deleteComment" permission
        $deleteComment = $auth->createPermission('deleteComment');
        $deleteComment->description = 'delete comment';
        $auth->add($deleteComment);


        // tags

        // 1- add "listTag" permission
        $listTag = $auth->createPermission('listTag');
        $listTag->description = 'show list of tags';
        $auth->add($listTag);

        // 2- add "viewDetailsTag" permission
        $viewDetailsTag = $auth->createPermission('viewDetailsTag');
        $viewDetailsTag->description = 'view tag';
        $auth->add($viewDetailsTag);

        // 3- add "deleteTag" permission
        $deleteTag = $auth->createPermission('deleteTag');
        $deleteTag->description = 'delete tag';
        $auth->add($deleteTag);

        // 4- add "createTag" permission
        $createTag = $auth->createPermission('createTag');
        $createTag->description = 'Create a tag';
        $auth->add($createTag);

        // 5- add "updateTag" permission
        $updateTag = $auth->createPermission('updateTag');
        $updateTag->description = 'Update tag';
        $auth->add($updateTag);


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

        // add managerComment role
        $managerComment = $auth->createRole('managerComment');
        $auth->add($managerComment);
        $auth->addChild($managerComment, $listComment);
        $auth->addChild($managerComment, $statusComment);
        $auth->addChild($managerComment, $deleteComment);
        $auth->addChild($managerComment, $viewDetailsComment);

        // add managerTag role
        $managerTag = $auth->createRole('managerTag');
        $auth->add($managerTag);
        $auth->addChild($managerTag, $listTag);
        $auth->addChild($managerTag, $createTag);
        $auth->addChild($managerTag, $updateTag);
        $auth->addChild($managerTag, $deleteTag);
        $auth->addChild($managerTag, $viewDetailsTag);

        // add superAdmin
        $superAdmin = $auth->createRole('superAdmin');
        $auth->add($superAdmin);
        $auth->addChild($superAdmin, $managerUser);
        $auth->addChild($superAdmin, $managerArticle);
        $auth->addChild($superAdmin, $managerComment);
        $auth->addChild($superAdmin, $managerTag);

        $auth->assign($superAdmin, 1);
        $auth->assign($managerArticle, 2);
        $auth->assign($managerUser, 3);
        $auth->assign($managerComment, 4);
        $auth->assign($managerTag, 5);
    }
}