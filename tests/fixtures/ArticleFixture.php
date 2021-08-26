<?php
namespace app\tests\fixtures;
use app\models\Article;
use yii\test\ActiveFixture;
class ArticleFixture extends ActiveFixture
{
    public $modelClass = Article::class;
    public $dataFile = '@tests/_data/article.php';
    public $depends = [UserFixture::class];
}