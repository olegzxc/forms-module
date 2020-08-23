<?php namespace Anomaly\FormsModule;

use Anomaly\Streams\Platform\Addon\Module\Module;

/**
 * Class FormsModule
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FormsModule
 */
class FormsModule extends Module
{

    /*
     * The addon icon.
     *
     * @var string
     */
    protected $icon = 'glyphicons glyphicons-notes-2';

    /**
     * The module sections.
     *
     * @var array
     */
    protected $sections = [
        'forms'         => [
            'buttons'  => [
                'new_form' => [
                    'data-toggle' => 'modal',
                    'data-target' => '#modal',
                    'href'        => 'admin/forms/choose',
                ],
            ],
            'sections' => [
                'entries'     => [
                    'hidden' => true,
                    'href'   => 'admin/forms/entries/{request.route.parameters.form}',
                ],
                'assignments' => [
                    'hidden'  => true,
                    'href'    => 'admin/forms/assignments/{request.route.parameters.stream}',
                    'buttons' => [
                        'add_field' => [
                            'data-toggle' => 'modal',
                            'data-target' => '#modal',
                            'href'        => 'admin/forms/assignments/{request.route.parameters.stream}/choose',
                        ],
                    ],
                ],
            ],
        ],
        'notifications' => [
            'buttons' => [
                'new_notification',
            ],
        ],
        'fields'        => [
            'buttons' => [
                'new_field' => [
                    'data-toggle' => 'modal',
                    'data-target' => '#modal',
                    'href'        => 'admin/forms/fields/choose',
                ],
            ],
        ],
    ];

}
