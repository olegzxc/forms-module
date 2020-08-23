<?php namespace Anomaly\FormsModule\Http\Controller\Admin;

use Anomaly\FormsModule\Action\Form\ActionFormBuilder;
use Anomaly\FormsModule\Action\Table\ActionTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

class ActionsController extends AdminController
{

    /**
     * Display an index of existing entries.
     *
     * @param ActionTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(ActionTableBuilder $table)
    {
        return $table->render();
    }

    /**
     * Create a new entry.
     *
     * @param ActionFormBuilder $form
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(ActionFormBuilder $form)
    {
        return $form->render();
    }

    /**
     * Edit an existing entry.
     *
     * @param ActionFormBuilder $form
     * @param                   $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(ActionFormBuilder $form, $id)
    {
        return $form->render($id);
    }
}
