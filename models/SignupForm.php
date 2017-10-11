<?php
namespace app\models;

use app\models\User;
use yii\base\Model;
use Yii;

use app\models\AuthAssignment;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $fname;
    public $lname;
    public $email;
    public $password;
    public $permissions;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fname','lname'],'string','max'=>100],
            ['username', 'filter', 'filter' => 'trim'],
            ['username','required'],
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }
    
    public function attributeLabels() {
        return[
          'fname'=>'Name',
          'lname'=>'Last Name'
        ];
    }
    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            //$user = new User();
            //$user->scenarios='register';
            $user = new User(['scenario' => 'signup']);

            $user->username = $this->username;
            $user->fname=$this->fname;
            $user->lname=$this->lname;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();
           /* if ($user->save()) {
                return $user;
            }*/
            
            $user->save();
                    
            //Add permissions===================
            $permissionList=$_POST['SignupForm']['permissions'];
                        
            foreach ($permissionList AS $value){
                $newPermission=new AuthAssignment();
                $newPermission->user_id=$user->id;
                $newPermission->item_name=$value;
                $newPermission->save();
            }
            
            return $user;
            
        }

        return null;
    }
}