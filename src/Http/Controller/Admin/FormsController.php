<?php namespace Anomaly\FormsModule\Http\Controller\Admin;

use Anomaly\FormsModule\Form\Contract\FormInterface;
use Anomaly\FormsModule\Form\Contract\FormRepositoryInterface;
use Anomaly\FormsModule\Form\Form\FormFormBuilder;
use Anomaly\FormsModule\Form\Handler\Contract\FormHandlerExtensionInterface;
use Anomaly\FormsModule\Form\Handler\Contract\FormHandlerRepositoryInterface;
use Anomaly\FormsModule\Form\Table\FormTableBuilder;
use Anomaly\Streams\Platform\Addon\Extension\ExtensionCollection;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

/**
 * Class FormsController
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FormsModule\Http\Controller\Admin
 */
class FormsController extends AdminController
{

    /**
     * Display an index of existing entries.
     *
     * @param FormTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(FormTableBuilder $table)
    {
        return $table->render();
    }

    /**
     * Choose a form handler for creating a form.
     *
     * @param ExtensionCollection $extensions
     * @return \Illuminate\View\View
     */
    public function choose(FormHandlerRepositoryInterface $formHandlers)
    {
        return view('module::ajax/choose_form_handler', ['extensions' => $formHandlers->all()]);
    }

    /**
     * Create a new entry.
     *
     * @param FormFormBuilder                $form
     * @param FormHandlerRepositoryInterface $formHandlers
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(FormFormBuilder $form, FormHandlerRepositoryInterface $formHandlers)
    {
        /* @var FormHandlerExtensionInterface $handler */
        $handler = $formHandlers->get($_GET['form_handler']);

        $form->setFormHandler($handler);

        $handler->integrate($form);

        return $form->render();
    }

    /**
     * Edit an existing entry.
     *
     * @param FormFormBuilder         $form
     * @param FormRepositoryInterface $forms
     * @param                         $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(FormFormBuilder $form, FormRepositoryInterface $forms, $id)
    {
        /* @var FormInterface $entry */
        $entry = $forms->find($id);

        /* @var FormHandlerExtensionInterface $handler */
        $handler = $entry->getFormHandler();

        $form->setFormHandler($handler);

        $handler->integrate($form);

        return $form->render($entry);
    }

    /**
     * Return a help dialog.
     *
     * @param FormRepositoryInterface $forms
     * @param                         $id
     * @return \Illuminate\View\View
     */
    public function help(FormRepositoryInterface $forms, $id)
    {
        return view('module::admin/forms/help', ['form' => $forms->find($id)]);
    }
}
