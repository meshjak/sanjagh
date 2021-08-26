<?php
namespace app\tests\fixtures;

use app\models\Comment;
use yii\test\ActiveFixture;

class CommentFixture extends ActiveFixture
{
    public $modelClass = Comment::class;
    public $dataFile = '@tests/_data/comment.php';
    public $depends = [
        UserFixture::class,
        ArticleFixture::class
    ];
}