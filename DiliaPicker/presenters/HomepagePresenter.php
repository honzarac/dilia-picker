<?php

namespace DiliaPicker\Presenters;

use DiliaPicker\Model\DiliaFacade;
use Nette;


final class HomepagePresenter extends Nette\Application\UI\Presenter
{

    /** @var DiliaFacade @inject */
    public $diliaFacade;

    public function renderDefault()
    {

    }

    public function handleRefresh($page)
    {
        $results = $this->diliaFacade->refreshList($page);

        $this->template->refreshProgress = ($page/322)*100;

        if($results !== 0) {
            $this->template->redirectUrl = $this->link('//refresh!', ['page' => $page+1]);
        } else {
            $this->redirect('this');
        }
    }
}
