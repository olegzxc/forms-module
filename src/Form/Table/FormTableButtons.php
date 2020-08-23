<?php namespace Anomaly\FormsModule\Form\Table;

use Anomaly\FormsModule\Form\Contract\FormInterface;

/**
 * Class FormTableButtons
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class FormTableButtons
{

    /**
     * Handle the buttons.
     *
     * @param FormTableBuilder $builder
     */
    public function handle(FormTableBuilder $builder)
    {
        $builder->setButtons(
            [
                'help',
                'edit',
                'entries',
                'assignments' => [
                    'href' => function (FormInterface $entry) {
                        return '/admin/forms/assignments/' . $entry->getFormEntriesStreamId();
                    },
                ],
            ]
        );
    }
}
