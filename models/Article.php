<?php

namespace app\models;

use cornernote\linkall\LinkAllBehavior;
use Yii;
use yii\base\InvalidConfigException;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\Html;
use yii\helpers\StringHelper;

/**
 * This is the model class for table "article".
 *
 * @property int $id
 * @property int $author_id
 * @property string $title
 * @property string $body
 * @property int|null $status
 * @property string|null $created_at
 *
 * @property ArticleTag[] $articleTags
 * @property User $author
 * @property Comment[] $comments
 * @property Tag[] $tags
 */
class Article extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'article';
    }

    public function behaviors()
    {
        return [
            LinkAllBehavior::class,
            [
                'class' => BlameableBehavior::class,
                'createdByAttribute' => 'author_id',
                'updatedByAttribute' => 'author_id',
            ],
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'created_at',
//                    ActiveRecord::EVENT_BEFORE_UPDATE => 'update_time',
                ],
                'value' => new Expression('NOW()'),
//                'value' => function() {return date('Y-m-d H:i:s');}
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'body'], 'required'],
            [['author_id', 'status'], 'integer'],
            [['body'], 'string'],
            [['created_at'], 'safe'],
            [['title'], 'string', 'max' => 100, 'min' => 3],
            [['body'], 'string', 'min' => 10],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['author_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'شناسه',
            'author_id' => 'نویسنده',
            'title' => 'عنوان',
            'body' => 'مطلب',
            'status' => 'وضعیت',
            'created_at' => 'زمان ایجاد',
        ];
    }

    public function afterSave($insert, $changedAttributes)
    {
        if (Yii::$app->request->post('tags')){
            $tags = [];
            foreach (Yii::$app->request->post('tags') as $tagId){
                $tags[] = Tag::findOne($tagId);
            }
            $this->linkAll('tags', $tags);
        }else{
            $this->unlinkAll('tags', true);
        }

        parent::afterSave($insert, $changedAttributes);
    }

    /**
     * Gets query for [[Author]].
     *
     * @return ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }

    public function getDescription(): string
    {
        $string = StringHelper::truncateWords(Html::encode($this->body), 60);
        $string = html_entity_decode(strip_tags(nl2br($string,'<br>'),ENT_QUOTES));
        return strip_tags($string);
    }

    /**
     * get article "create at"
     *
     * @return string
     */
    public function getCreatedAt(): ?string
    {
        return $this->created_at;
    }

    public function relativeCreateTime(): string
    {
        return Yii::$app->formatter->asDate($this->getCreatedAt());
    }

    public function comments(){
        return $this->hasMany(Comment::class, ['article_id' => 'id']);
    }

    /**
     * Gets query for [[ArticleTags]].
     *
     * @return ActiveQuery
     */
    public function getArticleTags()
    {
        return $this->hasMany(ArticleTag::className(), ['article_id' => 'id']);
    }

    /**
     * Gets query for [[Tags]].
     *
     * @return ActiveQuery
     * @throws InvalidConfigException
     */
    public function getTags()
    {
        return $this->hasMany(Tag::className(), ['id' => 'tag_id'])->viaTable('article_tag', ['article_id' => 'id']);
    }
}
