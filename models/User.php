<?php
namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

    public $currentPassword;
    public $newPassword;
    public $newPasswordConfirm;
    public $password;

    
    pubLic $strStatus=[
      self::STATUS_DELETED => 'Blocked',
      self::STATUS_ACTIVE => 'Actived',
    ];
    
    public function getStatus($status=null){
        if($status===null){
            return Yii::t('app',$this->strStatus[$this->status]);
        }
        return Yii::t('app',$this->strStatus[$status]);
    }


    //กำหนดสิทธิ์ให้ User***********
    const ROLE_USER=10;
    const ROLE_MANAGER=20;
    const ROLE_ADMIN=30;
    
    public $strRoles=[
        self::ROLE_USER=> 'User',
        self::ROLE_MANAGER=>'Manager',
        self::ROLE_ADMIN=>'Administrator'
    ];
    
    public function getRoles($roles=null){
        if($roles===null){
            return Yii::t('app',$this->strRoles[$this->roles]);
        }
        return Yii::t('app',$this->strRoles[$roles]);
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fname','lname'],'string','max'=>100],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
            //กำหนดสิทธิ์------------------------------------------
            ['roles','default','value' => self::ROLE_USER],
            ['roles','in','range' => [self::ROLE_USER, self::ROLE_MANAGER, self::ROLE_ADMIN]],
            
            [['newPassword','currentPassword','newPasswordConfirm'],'required','on'=>'change_password'],
            [['currentPassword'],'validateCurrentPassword','on'=>'change_password'],                    //Check old password match***
            [['newPassword','newPasswordConfirm'],'string','min'=>3,'on'=>'change_password'],
            [['newPassword','newPasswordConfirm'],'filter','filter'=>'trim','on'=>'change_password'],
            [['newPasswordConfirm'],'compare','compareAttribute'=>'newPassword','message'=>'Passwords do not match','on'=>'change_password'],
        ];
    }

    public function scenarios(){
        $scenarios=parent::scenarios();
        $scenarios['signup']=['fname','lname','status','roles'];
        return $scenarios;
    }

    public function validateCurrentPassword(){
        if(!$this->verifyPassword($this->currentPassword)){
            $this->addError("currentPassword","Current password incurrect");
        }
    }

    public function verifyPassword($password){
        $dbpassword=static::findOne(['username'=>Yii::$app->user->identity->username,'status' =>self::STATUS_ACTIVE])->password_hash;
        return Yii::$app->security->validatePassword($password,$dbpassword);
    }
    
    public function attributeLabels() {
       return[
         'fname'=>'Name',
           'lname'=>'Last Name'
       ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
}