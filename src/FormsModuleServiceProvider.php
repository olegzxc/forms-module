<?php namespace Anomaly\FormsModule;

use Anomaly\FormsModule\Form\Contract\FormInterface;
use Anomaly\FormsModule\Form\Contract\FormRepositoryInterface;
use Anomaly\FormsModule\Form\FormRepository;
use Anomaly\FormsModule\Form\Handler\Contract\FormHandlerRepositoryInterface;
use Anomaly\FormsModule\Form\Handler\FormHandlerRepository;
use Anomaly\FormsModule\Http\Controller\Admin\AssignmentsController;
use Anomaly\FormsModule\Http\Controller\Admin\FieldsController;
use Anomaly\FormsModule\Notification\Contract\NotificationRepositoryInterface;
use Anomaly\FormsModule\Notification\NotificationRepository;
use Anomaly\Streams\Platform\Addon\AddonServiceProvider;
use Anomaly\Streams\Platform\Assignment\AssignmentRouter;
use Anomaly\Streams\Platform\Field\FieldRouter;

/**
 * Class FormsModuleServiceProvider
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FormsModule
 */
class FormsModuleServiceProvider extends AddonServiceProvider
{

    /**
     * The addon plugins.
     *
     * @var array
     */
    protected $plugins = [
        FormsModulePlugin::class,
    ];

    /**
     * The singleton bindings.
     *
     * @var array
     */
    protected $singletons = [
        FormRepositoryInterface::class         => FormRepository::class,
        NotificationRepositoryInterface::class => NotificationRepository::class,
        FormHandlerRepositoryInterface::class  => FormHandlerRepository::class,
    ];

    /**
     * The addon routes.
     *
     * @var array
     */
    protected $routes = [
        'forms/handle/{form}'                  => [
            'method' => 'post',
            'uses'   => 'Anomaly\FormsModule\Http\Controller\FormsController@handle',
        ],
        'admin/forms'                          => 'Anomaly\FormsModule\Http\Controller\Admin\FormsController@index',
        'admin/forms/choose'                   => 'Anomaly\FormsModule\Http\Controller\Admin\FormsController@choose',
        'admin/forms/create'                   => 'Anomaly\FormsModule\Http\Controller\Admin\FormsController@create',
        'admin/forms/edit/{id}'                => 'Anomaly\FormsModule\Http\Controller\Admin\FormsController@edit',
        'admin/forms/help/{id}'                => 'Anomaly\FormsModule\Http\Controller\Admin\FormsController@help',
        'admin/forms/entries/{form}'           => 'Anomaly\FormsModule\Http\Controller\Admin\EntriesController@index',
        'admin/forms/entries/{form}/view/{id}' => 'Anomaly\FormsModule\Http\Controller\Admin\EntriesController@view',
        'admin/forms/notifications'            => 'Anomaly\FormsModule\Http\Controller\Admin\NotificationsController@index',
        'admin/forms/notifications/create'     => 'Anomaly\FormsModule\Http\Controller\Admin\NotificationsController@create',
        'admin/forms/notifications/edit/{id}'  => 'Anomaly\FormsModule\Http\Controller\Admin\NotificationsController@edit',
        'admin/forms/actions'                  => 'Anomaly\FormsModule\Http\Controller\Admin\ActionsController@index',
        'admin/forms/actions/create'           => 'Anomaly\FormsModule\Http\Controller\Admin\ActionsController@create',
        'admin/forms/actions/edit/{id}'        => 'Anomaly\FormsModule\Http\Controller\Admin\ActionsController@edit',
        'admin/forms/buttons'                  => 'Anomaly\FormsModule\Http\Controller\Admin\ButtonsController@index',
        'admin/forms/buttons/create'           => 'Anomaly\FormsModule\Http\Controller\Admin\ButtonsController@create',
        'admin/forms/buttons/edit/{id}'        => 'Anomaly\FormsModule\Http\Controller\Admin\ButtonsController@edit',
    ];

    /**
     * Map the addon.
     *
     * @param FieldRouter      $fields
     * @param AssignmentRouter $assignments
     */
    public function map(FieldRouter $fields, AssignmentRouter $assignments)
    {
        $fields->route($this->addon, FieldsController::class);
        $assignments->route($this->addon, AssignmentsController::class);
    }

    /**
     * Boot the addon.
     *
     * @param FormRepositoryInterface $forms
     */
    public function boot(FormRepositoryInterface $forms)
    {
        $forms = $forms->cache(
            __METHOD__,
            60,
            function () use ($forms) {
                return $forms->all();
            }
        );

        /* @var FormInterface $form */
        foreach ($forms as $form) {

            $this->app->bind(
                'anomaly.module.forms::forms.' . $form->getFormSlug(),
                function () use ($form) {
                    $handler = $form->getFormHandler();
                    $builder = $handler->builder($form);

                    return $builder;
                }
            );

            $this->app->alias(
                'anomaly.module.forms::forms.' . $form->getFormSlug(),
                'forms::' . $form->getFormSlug()
            );
        }
    }

}
