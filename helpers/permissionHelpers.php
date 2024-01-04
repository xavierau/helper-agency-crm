<?php
/**
 * Author: Xavier Au
 * Date: 10/8/2020
 * Time: 1:56 PM
 */

use Illuminate\Support\Str;

if( !function_exists('getPermissionName')) {
    function getPermissionName(string $object, string $action) {
        $arr = explode('\\',
                       $object);
        if(Str::startsWith($object,
                           'Module')) {

            $moduleName = Str::kebab($arr[1]);
            $className = Str::kebab($arr[count($arr) - 1]);

            return sprintf('%s:%s.%s',
                           $moduleName,
                           $className,
                           $action);
        } else {
            $className = Str::kebab($arr[count($arr) - 1]);

            return sprintf('%s.%s',
                           $className,
                           $action);
        }
    }
}
