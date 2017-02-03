<?php
namespace common\components\resizeimg;

class ResizeImgException extends \Exception
{
	public function __construct($error_code)
	{
		parent::__construct(ResizeImgErrors::getErrorMessage($error_code), $error_code);
	}
}
