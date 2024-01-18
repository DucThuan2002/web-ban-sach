<?php

namespace App\Helpers;
use Illuminate\Support\Str;

Class Helper
{
    public static function menu($menus, $parent_id = 0, $char = '') 
    {
        $html = '';
        
        
        foreach ($menus as $key => $menu) {
            if($parent_id == $menu->parent_id) {
                $html .='
                    <tr>
                        <td>'. $menu->id .'</td>
                        <td>'. $char. $menu->name .'</td>
                        <td>'. self::active($menu->active) .'</td>
                        <td>'. $menu->updated_at .'</td>
                        <td>
                            <a href="/shop/admin/menus/edit/'.$menu->id.'" class="btn btn-primary btn-sm">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <a class="btn btn-danger btn-sm" onclick="removeRow('.$menu->id.', \'/shop/admin/menus/destroy\')">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                ';
                unset($menus[$key]);

                $html.= self::menu($menus,$menu->id,$char.'--');
            }
        }
        
        return $html;
    } 

    public static function active($active = 0)
    {
        if ($active == 0) {
            return '<span class="btn btn-danger btn-xs">NO</span>';
        }
        else    
            return '<span class="btn btn-success btn-xs">YES</span>';
    }

    public static function menus($menus, $parent_id = 0) 
    {
        $html = '';
        foreach($menus as $key => $menu) {
            if($menu->parent_id == $parent_id) {
                $html .= '
                <li>
                    <a href="danh-muc/'. $menu->id .'-'. Str::slug($menu->name, '-') .'.html">
                         '. $menu->name .'
                    </a>';

                unset($menus[$key]);
                if (self::isChild($menus, $menu->id)) {
                    $html .= '<ul class="sub-menu">';
                    $html .= self::menus($menus,$menu->id);
                    $html .= '</ul>';
                }
                
                $html .= '</li>';
            }
        }
        return $html;
    }

    public static function isChild($menus, $id) 
    {
        foreach($menus as $key => $menu) {
            if ($menu->parent_id == $id) {
                return true;
            }
        }
        return false;
        
    }

    public static function price($price = 0, $price_sale = 0)
    {
        if( $price_sale != 0 ) return $price;
        if( $price != 0 ) return $price_sale;
        return '<a href="lien-he.html">Liên Hệ</a>';
    }

    public static function isEmpty()
    {
        $carts = session()->get('carts');

        if ($carts != null) {
            return session()->get('carts');
        }
        
        return [];
    }

    public static function numProduct($id = 0)
    {
        $carts = session()->get('carts');
        if ($carts == null)
            return false;

        $num = $carts[$id];
        
        return $num;
    }

    public static function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data))
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }
}