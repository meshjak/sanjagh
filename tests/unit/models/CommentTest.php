<?php
namespace tests\unit\models;

use app\models\Comment;
use app\models\User;
use app\tests\fixtures\ArticleFixture;
use app\tests\fixtures\CommentFixture;
use app\tests\fixtures\UserFixture;
use Codeception\Test\Unit;

class CommentTest extends Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function _before()
    {
        $this->tester->haveFixtures([
            'comment' => [
                'class' => CommentFixture::className(),
                'dataFile' => codecept_data_dir() . 'comment.php'
            ],
            'article' => [
                'class' => ArticleFixture::className(),
                'dataFile' => codecept_data_dir() . 'article.php'
            ],
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'user.php',
            ],
        ]);
    }

    /** @test */
    public function save()
    {
        $comment = new Comment([
            'article_id' => 1,
            'user_id' => \Yii::$app->user->id,
            'body' => 'test comment hi, how are you?',
        ]);
        expect('model should save', $comment->save());
    }
}