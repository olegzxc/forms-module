<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

/**
 * Class AnomalyModuleFormsCreateFormsFields
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 */
class AnomalyModuleFormsCreateFormsFields extends Migration
{

    /**
     * The addon fields.
     *
     * @var array
     */
    protected $fields = [
        'form_name'                   => 'anomaly.field_type.text',
        'form_description'            => 'anomaly.field_type.textarea',
        'form_slug'                   => [
            'type'   => 'anomaly.field_type.slug',
            'config' => [
                'slugify' => 'form_name',
            ],
        ],
        'form_handler'                => [
            'type'   => 'anomaly.field_type.addon',
            'config' => [
                'type'          => 'extension',
                'search'        => 'anomaly.module.forms::form_handler.*',
                'default_value' => 'anomaly.extension.default_form_handler',
            ],
        ],
        'form_view_options'           => [
            'type'   => 'anomaly.field_type.tags',
            'config' => [
                'handler'             => 'Anomaly\FormsModule\Form\Form\Field\ViewOptions@handle',
                'allow_creating_tags' => false,
            ],
        ],
        'notification_name'           => 'anomaly.field_type.text',
        'notification_description'    => 'anomaly.field_type.textarea',
        'notification_slug'           => [
            'type'   => 'anomaly.field_type.slug',
            'config' => [
                'slugify' => 'notification_name',
            ],
        ],
        'notification_email_layout'   => [
            'type'   => 'anomaly.field_type.select',
            'config' => [
                'handler' => 'emails',
            ],
        ],
        'notification_content'        => [
            'type'   => 'anomaly.field_type.wysiwyg',
            'config' => [
                'default_value' => '<h3>{{ form.form_name }}</h3><p><a href="{{ url_previous() }}">{{ url_previous() }}</a></p><hr><p><em>{{ form.form_description }}</em><br>{{ forms_input(input)|raw }}</p>',
            ],
        ],
        'notification_from_name'      => 'anomaly.field_type.text',
        'notification_from_email'     => 'anomaly.field_type.text',
        'notification_reply_to_name'  => 'anomaly.field_type.text',
        'notification_reply_to_email' => 'anomaly.field_type.text',
        'notification_subject'        => 'anomaly.field_type.text',
        'notification_cc'             => [
            'type'   => 'anomaly.field_type.tags',
            'config' => [
                'filter' => [
                    'FILTER_VALIDATE_EMAIL',
                ],
            ],
        ],
        'notification_bcc'            => [
            'type'   => 'anomaly.field_type.tags',
            'config' => [
                'filter' => [
                    'FILTER_VALIDATE_EMAIL',
                ],
            ],
        ],
        'send_notification'           => 'anomaly.field_type.boolean',
        'notification_send_to'        => [
            'type'   => 'anomaly.field_type.tags',
            'config' => [
                'filter' => [
                    'FILTER_VALIDATE_EMAIL',
                ],
            ],
        ],
        'notification'                => [
            'type'   => 'anomaly.field_type.relationship',
            'config' => [
                'related' => 'Anomaly\FormsModule\Notification\NotificationModel',
            ],
        ],
        'send_autoresponder'          => 'anomaly.field_type.boolean',
        'user_email_field'            => [
            'type'   => 'anomaly.field_type.relationship',
            'config' => [
                'related'   => 'Anomaly\Streams\Platform\Field\FieldModel',
                'handler'   => 'fields',
                'namespace' => 'forms',
                'unlocked'  => true,
            ],
        ],
        'autoresponder'               => [
            'type'   => 'anomaly.field_type.relationship',
            'config' => [
                'related' => 'Anomaly\FormsModule\Notification\NotificationModel',
            ],
        ],
        'include_attachments'         => 'anomaly.field_type.boolean',
        'success_message'             => 'anomaly.field_type.textarea',
        'success_redirect'            => 'anomaly.field_type.text',
    ];

}
