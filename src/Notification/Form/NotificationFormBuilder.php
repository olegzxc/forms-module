<?php namespace Anomaly\FormsModule\Notification\Form;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class NotificationFormBuilder
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FormsModule\Notification\Form
 */
class NotificationFormBuilder extends FormBuilder
{

    /**
     * The form sections.
     *
     * @var array
     */
    protected $sections = [
        [
            'tabs' => [
                'general' => [
                    'title'  => 'module::tab.general',
                    'fields' => [
                        'notification_name',
                        'notification_slug',
                        'notification_description',
                        'success_message',
                        'success_redirect',
                    ],
                ],
                'message' => [
                    'title'  => 'module::tab.message',
                    'fields' => [
                        'notification_from_name',
                        'notification_from_email',
                        'notification_reply_to_name',
                        'notification_reply_to_email',
                        'notification_subject',
                    ],
                ],
                'content' => [
                    'title'  => 'module::tab.content',
                    'fields' => [
                        'include_attachments',
                        'notification_email_layout',
                        'notification_content',
                    ],
                ],
            ],
        ],
    ];

}
