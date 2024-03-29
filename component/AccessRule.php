<?php
//โค้ดนี้ใช้สำหรับการกำหนดสิทธิ์ User
namespace app\component;

class AccessRule extends \yii\filters\AccessRule{
    protected function matchRole($user) {
        if(empty($this->roles)){
            return true;
        }
        
        foreach($this->roles as $role){
            if($role==='?'){
                if($user->getIsGuest()){
                    return true;
                }
            }elseif($role==='@'){
               if(!$user->getIsGuest()){
                   return true;
               }
            }elseif(!$user->getIsGuest() && $role===$user->identity->roles){
                return true;
            }
        }
        
        return false;
    }
}
