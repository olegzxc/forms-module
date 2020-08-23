<?php namespace Anomaly\FormsModule\Form\Form;

use Anomaly\FormsModule\Form\Handler\Contract\FormHandlerExtensionInterface;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class FormFormBuilder
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FormsModule\Form\Form
 */
class FormFormBuilder extends FormBuilder
{

    /**
     * The form handler extension.
     *
     * @var FormHandlerExtensionInterface
     */
    protected $formHandler;

    /**
     * The form fields.
     *
     * @var array
     */
    protected $fields = [
        '*',
        'form_slug'         => [
            'disabled' => 'edit',
        ],
        'form_view_options' => [
            'enabled' => 'edit',
        ],
    ];

    /**
     * Skip these fields.
     *
     * @var array
     */
    protected $skips = [
        'form_handler',
    ];

    /**
     * The form sections.
     *
     * @var array
     */
    protected $sections = [
        [
            'tabs' => [
                'form'          => [
                    'title'  => 'module::tab.form',
                    'fields' => [
                        'form_name',
                        'form_slug',
                        'form_description',
                        'success_message',
                        'success_redirect',
                    ],
                ],
                'notification'  => [
                    'title'  => 'module::tab.notification',
                    'fields' => [
                        'send_notification',
                        'notification',
                        'notification_send_to',
                        'notification_cc',
                        'notification_bcc',
                    ],
                ],
                'autoresponder' => [
                    'title'  => 'module::tab.autoresponder',
                    'fields' => [
                        'send_autoresponder',
                        'autoresponder',
                        'user_email_field',
                    ],
                ],
                'options'       => [
                    'title'  => 'module::tab.options',
                    'fields' => [
                        'form_view_options',
                    ],
                ],
            ],
        ],
    ];

    /**
     * Fired when builder is ready to build.
     *
     * @throws \Exception
     */
    public function onReady()
    {
        if (!$this->getFormHandler() && !$this->getEntry()) {
            throw new \Exception('The $formHandler parameter is required when creating a form.');
        }
    }

    /**
     * Get the form handler extension.
     *
     * @return FormHandlerExtensionInterface
     */
    public function getFormHandler()
    {
        return $this->formHandler;
    }

    /**
     * Set the form handler extension.
     *
     * @param FormHandlerExtensionInterface $formHandler
     * @return $this
     */
    public function setFormHandler(FormHandlerExtensionInterface $formHandler)
    {
        $this->formHandler = $formHandler;

        return $this;
    }

    /**
     * Fired when form is saving.
     */
    public function onSaving()
    {
        $entry = $this->getFormEntry();

        if (!$entry->exists) {
            $entry->form_handler = $this->getFormHandler();
        }
    }
}
