<?php

namespace app\modules\m\controllers;

use app\modules\m\controllers\common\BaseController;


class UserController extends BaseController {

    public function actionIndex(){
        return $this->render('index');
    }

	public function actionOrder(){
		return $this->render('order');
	}

	public function actionFav(){
		return $this->render('fav');
	}

	public function actionComment(){
		return $this->render('comment');
	}

	public function actionAddress(){
		return $this->render('address');
	}

	public function actionAddress_set(){
		return $this->render('address_set');
	}

}
