<?php
namespace tests\unit\models;

use app\models\Article;
use app\models\User;
use app\tests\fixtures\ArticleFixture;
use app\tests\fixtures\UserFixture;
use Codeception\Test\Unit;

class ArticleTest extends Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function _before()
    {
        $this->tester->haveFixtures([
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
    public function getAuthor()
    {
        $article = $this->tester->grabFixture('article', 0);
        expect($user = $article->getAuthor());
    }

    /** @test */
    public function validateEmpty()
    {
//        $article = $this->tester->grabFixture('article', 0);
//        $user = $article->author;
        $model = new Article();
        expect('model should not validate', $model->validate())->false();
        expect('title has error', $model->errors)->hasKey('title');
        expect('title has error', $model->errors)->hasKey('body');
    }

    /** @test */
    public function validateCorrect()
    {
        $model = new Article([
            'title' => 'Other Post',
            'body' => 'Other Post Text',
        ]);
        expect('model should validate', $model->validate())->true();
    }

//    /** @test */
//    public function save()
//    {
//        $user = $this->tester->grabFixture('user', 1);
//        $model = new Article(['author_id' => $user->id]);
//        $model->title = 'Test title';
//        $model->body = 'Test body';
//        $model->setAttribute('author_id', 1);
////        $model->link('author', $user);
//        expect('model should save', $model->save())->true();
//    }

    /** @test */
    public function getDescription(){
        $article = $this->tester->grabFixture('article', 1);
        expect($article->description());
    }
}