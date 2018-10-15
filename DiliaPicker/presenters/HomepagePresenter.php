<?php

namespace DiliaPicker\Presenters;

use DiliaPicker\Model\DiliaFacade;
use Nette;


final class HomepagePresenter extends Nette\Application\UI\Presenter
{

    /** @var DiliaFacade @inject */
    public $diliaFacade;

    public function actionDefault()
    {
        $this->sendJson(['data' => $this->diliaFacade->refreshList()]);
    }
}
