<?php namespace Anomaly\FormsModule\Http\Controller\Admin;

use Anomaly\FormsModule\Button\Form\ButtonFormBuilder;
use Anomaly\FormsModule\Button\Table\ButtonTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

class ButtonsController extends AdminController
{

    /**
     * Display an index of existing entries.
     *
     * @param ButtonTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(ButtonTableBuilder $table)
    {
        return $table->render();
    }

    /**
     * Create a new entry.
     *
     * @param ButtonFormBuilder $form
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(ButtonFormBuilder $form)
    {
        return $form->render();
    }

    /**
     * Edit an existing entry.
     *
     * @param ButtonFormBuilder $form
     * @param                   $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(ButtonFormBuilder $form, $id)
    {
        return $form->render($id);
    }
}
