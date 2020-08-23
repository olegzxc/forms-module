<?php namespace Anomaly\FormsModule\Http\Controller\Admin;

use Anomaly\FormsModule\Handler\Form\HandlerFormBuilder;
use Anomaly\FormsModule\Handler\Table\HandlerTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

class HandlersController extends AdminController
{

    /**
     * Display an index of existing entries.
     *
     * @param HandlerTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(HandlerTableBuilder $table)
    {
        return $table->render();
    }

    /**
     * Create a new entry.
     *
     * @param HandlerFormBuilder $form
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(HandlerFormBuilder $form)
    {
        return $form->render();
    }

    /**
     * Edit an existing entry.
     *
     * @param HandlerFormBuilder $form
     * @param                    $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(HandlerFormBuilder $form, $id)
    {
        return $form->render($id);
    }
}
