<?php
namespace common\components\ctrait;

use Yii;
use common\components\Text;

trait Sid {
	public static function sid($sid,$header = null)
	{
        if (empty($sid)) {
            return mb_substr(Text::translit($header), 0, 80);
        }
        else {
            return mb_substr(Text::translit($sid), 0, 80);
        }
        return '';
	}
}
