<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

/**
 * Class AnomalyModuleFormsCreateNotificationsStream
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 */
class AnomalyModuleFormsCreateNotificationsStream extends Migration
{

    /**
     * The stream definition.
     *
     * @var array
     */
    protected $stream = [
        'slug'         => 'notifications',
        'title_column' => 'notification_name',
        'translatable' => true,
        'trashable'    => true,
    ];

    /**
     * The stream assignments.
     *
     * @var array
     */
    protected $assignments = [
        'notification_name'           => [
            'required' => true,
        ],
        'notification_description',
        'notification_slug'           => [
            'unique'   => true,
            'required' => true,
        ],
        'notification_email_layout',
        'notification_content'        => [
            'required'     => true,
            'translatable' => true,
        ],
        'notification_from_name'      => [
            'required'     => true,
            'translatable' => true,
        ],
        'notification_from_email'     => [
            'required' => true,
        ],
        'notification_reply_to_name'  => [
            'required' => true,
        ],
        'notification_reply_to_email' => [
            'required' => true,
        ],
        'notification_subject'        => [
            'required'     => true,
            'translatable' => true,
        ],
        'include_attachments',
    ];

}
