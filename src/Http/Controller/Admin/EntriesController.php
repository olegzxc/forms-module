<?php namespace Anomaly\FormsModule\Http\Controller\Admin;

use Anomaly\FormsModule\Entry\Table\EntryTableBuilder;
use Anomaly\FormsModule\Form\Contract\FormInterface;
use Anomaly\FormsModule\Form\Contract\FormRepositoryInterface;
use Anomaly\FormsModule\FormsModule;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Anomaly\Streams\Platform\Stream\Contract\StreamRepositoryInterface;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class EntriesController
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FormsModule\Http\Controller\Admin
 */
class EntriesController extends AdminController
{

    /**
     * Create a new EntriesController instance.
     *
     * @param FormsModule $module
     * @param FormRepositoryInterface $forms
     */
    public function __construct(FormsModule $module, FormRepositoryInterface $forms)
    {
        parent::__construct();

        // No route in CLI
        if (PHP_SAPI == 'cli') {
            return;
        }

        /* @var FormInterface $form */
        $form = $forms->find($this->route->parameter('form'));

        $stream = $form->getFormEntriesStream();

        $module->addSectionButton(
            'entries',
            'export',
            [
                'enabled'   => 'admin/forms/entries/*',
                'namespace' => $stream->getNamespace(),
                'stream'    => $stream->getSlug(),
            ]
        );
    }

    /**
     * @param EntryTableBuilder $table
     * @param StreamRepositoryInterface $streams
     * @param FormRepositoryInterface $forms
     * @param                           $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(
        EntryTableBuilder $table,
        StreamRepositoryInterface $streams,
        FormRepositoryInterface $forms,
        $form
    ) {
        /* @var FormInterface $form */
        $form = $forms->find($form);

        $stream = $streams->findBySlugAndNamespace($form->getFormSlug(), 'forms');

        return $table
            ->setModel($stream->getEntryModel())
            ->setFilters($form->getFormViewOptions())
            ->setColumns(
                array_merge(
                    [
                        'entry.created_at_datetime' => [
                            'field' => 'created_at',
                        ],
                    ],
                    array_diff(
                        $form->getFormViewOptions(),
                        ['created_at', 'updated_at', 'created_by', 'updated_by']
                    )
                )
            )
            ->render();
    }

    /**
     * Return the readonly view for an entry.
     *
     * @param FormBuilder $generic
     * @param FormRepositoryInterface $forms
     * @param                         $form
     * @param                         $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function view(
        FormBuilder $generic,
        FormRepositoryInterface $forms,
        $form,
        $id
    ) {
        /* @var FormInterface $form */
        $form = $forms->find($form);

        $handler = $form->getFormHandler();
        $builder = $handler->builder($form);

        return $generic
            ->setSave(false)
            ->setReadOnly(true)
            ->setButtons(['cancel'])
            ->setModel($builder->getModel())
            ->setFields($builder->getFields())
            ->render($id);
    }
}
