<?php

class AuthManager extends CPhpAuthManager
{
	public function init()
	{

		parent::init();
		// mlog(self::getAuthItem('teacher'));
		if($this->getAuthItem('teacher')===null)
		{
			$this->createAuthItem('teacher',2);
			$this->save();
		}
		if($this->getAuthItem('parent')===null)
		{
			$this->createAuthItem('parent',2);
			$this->save();
		}
	}
}
