<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gadget extends Model
{
    public $timestamps = false;
    
    public function add($user_id,$name, $number)
    {
        $this->user_id = $user_id;
        $this->product_name = $name;
        $this->product_number = $number;
        $this->product_sale_date = date('Y-m-d H:i:s');
        $this->save();
    }

    static public function select($user_id)
    {
        $query = self::get()->where('user_id', $user_id);
        $result = self::object_to_array($query, $role = 'user');
        return $result;
    }

    static public function select_with_users()
    {
        $query = self::join('users', 'gadgets.user_id', '=', 'users.id')
                        ->select('gadgets.*', 'name as shop_name')
                        ->get();
        $result = self::object_to_array($query, $role = 'admin');
        return $result;
    }
    
    private static function object_to_array($object, $role)
    {
        $result = [];
        foreach ($object as $element) {
            if($role == 'admin'){
                $shop_name = $element->shop_name;
            }
            else{
                $shop_name = '';
            }
            $result[] = [
                'id' => $element->id,
                'shop_name' => $shop_name,
                'product_name' => $element->product_name,
                'product_number' => $element->product_number,
                'product_sale_date' => $element->product_sale_date
            ];
        }
        return $result;
    }
}
