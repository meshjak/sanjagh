<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
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
 * @property User $author
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

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['author_id', 'title', 'body'], 'required'],
            [['author_id', 'status'], 'integer'],
            [['body'], 'string'],
            [['created_at'], 'safe'],
            [['title'], 'string', 'max' => 100],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['author_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'author_id' => 'Author ID',
            'title' => 'Title',
            'body' => 'Body',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
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

    public function description(): string
    {
        return StringHelper::truncateWords(Html::encode($this->body), 60);
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