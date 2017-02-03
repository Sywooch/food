<?php
namespace common\components\ctrait;

// use Yii;
// use common\components\Text;

trait Path {

    /*
    return 
    */
	public static function intToPath($id)
	{
        $encoding = mb_internal_encoding(); // ISO-8859-1 ???
        if (empty($id)) { return false; }
        $path = str_pad((string)$id, 10, "0", STR_PAD_LEFT);
        if (mb_strlen($path,$encoding)!==10) { return false; }
        return mb_substr($path,0,1,$encoding) . DIRECTORY_SEPARATOR .
            mb_substr($path,1,3,$encoding) . DIRECTORY_SEPARATOR .
            mb_substr($path,4,3,$encoding) . DIRECTORY_SEPARATOR .
            (string)$id . DIRECTORY_SEPARATOR;
	}

    public static function createPath($path)
    {
        if (!is_dir($path))
        {
            if (!mkdir($path, 0775, true))
            {
                return false;
            }
        }
        return true;
    }
}
