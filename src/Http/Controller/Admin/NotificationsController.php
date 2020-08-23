<?php namespace Anomaly\FormsModule\Http\Controller\Admin;

use Anomaly\FormsModule\Notification\Form\NotificationFormBuilder;
use Anomaly\FormsModule\Notification\Table\NotificationTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

class NotificationsController extends AdminController
{

    /**
     * Display an index of existing entries.
     *
     * @param NotificationTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(NotificationTableBuilder $table)
    {
        return $table->render();
    }

    /**
     * Create a new entry.
     *
     * @param NotificationFormBuilder $form
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(NotificationFormBuilder $form)
    {
        return $form->render();
    }

    /**
     * Edit an existing entry.
     *
     * @param NotificationFormBuilder $form
     * @param                         $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(NotificationFormBuilder $form, $id)
    {
        return $form->render($id);
    }
}
