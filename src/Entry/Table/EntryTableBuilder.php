<?php namespace Anomaly\FormsModule\Entry\Table;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

/**
 * Class EntryTableBuilder
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class EntryTableBuilder extends TableBuilder
{

    /**
     * The table buttons.
     *
     * @var array
     */
    protected $buttons = [
        'view' => [
            'href' => 'admin/forms/entries/{request.route.parameters.form}/view/{entry.id}',
        ],
    ];

    /**
     * The table actions.
     *
     * @var array
     */
    protected $actions = [
        'delete',
        'export',
    ];

    /**
     * The table options.
     *
     * @var array
     */
    protected $options = [
        'order_by' => [
            'created_at' => 'DESC',
        ],
    ];
}
