<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "comment".
 *
 * @property int $id
 * @property int $user_id
 * @property int $article_id
 * @property int $parent_id
 * @property string|null $body
 * @property int|null $status
 * @property string|null $created_at
 *
 * @property Article $article
 * @property Comment[] $comments
 * @property Comment $parent
 * @property User $user
 */
class Comment extends ActiveRecord
{
    public function behaviors()
    {
        return [
            [
                'class' => BlameableBehavior::class,
                'createdByAttribute' => 'user_id',
                'updatedByAttribute' => 'user_id',
            ],
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'created_at',
//                    ActiveRecord::EVENT_BEFORE_UPDATE => 'update_time',
                ],
                'value' => function() {return date('Y-m-d H:i:s');}
            ],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'article_id'], 'required'],
            [['user_id', 'article_id', 'parent_id', 'status'], 'integer'],
            [['created_at'], 'safe'],
            [['body'], 'string', 'max' => 255, 'min' => 3],
            [['article_id'], 'exist', 'skipOnError' => true, 'targetClass' => Article::className(), 'targetAttribute' => ['article_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'شناسه',
            'user_id' => 'فرستنده',
            'article_id' => 'مقاله',
            'parent_id' => 'نظر پدر',
            'body' => 'متن',
            'status' => 'وضعیت',
            'created_at' => 'زمان ایجاد',
        ];
    }

    /**
     * Gets query for [[Article]].
     *
     * @return ActiveQuery
     */
    public function getArticle()
    {
        return $this->hasOne(Article::className(), ['id' => 'article_id']);
    }

    /**
     * Gets query for [[Comments]].
     *
     * @return ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['parent_id' => 'id']);
    }

    /**
     * Gets query for [[Parent]].
     *
     * @return ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Comment::className(), ['id' => 'parent_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
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
        return Yii::$app->formatter->asRelativeTime($this->getCreatedAt());
    }
}
