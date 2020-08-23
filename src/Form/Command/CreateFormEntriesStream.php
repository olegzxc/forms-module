<?php namespace Anomaly\FormsModule\Form\Command;

use Anomaly\FormsModule\Form\Contract\FormInterface;
use Anomaly\Streams\Platform\Stream\Contract\StreamRepositoryInterface;
use Illuminate\Contracts\Config\Repository;


/**
 * Class CreateFormEntriesStream
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FormsModule\Form\Command
 */
class CreateFormEntriesStream
{

    /**
     * The form instance.
     *
     * @var FormInterface
     */
    protected $form;

    /**
     * Create a new CreateFormEntriesStream instance.
     *
     * @param FormInterface $form
     */
    public function __construct(FormInterface $form)
    {
        $this->form = $form;
    }

    /**
     * Handle the command.
     *
     * @param StreamRepositoryInterface $streams
     * @param Repository $config
     */
    public function handle(StreamRepositoryInterface $streams, Repository $config)
    {
        $streams->create(
            [
                $config->get('app.fallback_locale') => [
                    'name'        => $this->form->getFormName(),
                    'description' => $this->form->getFormDescription(),
                ],
                'namespace'                         => 'forms',
                'slug'                              => $this->form->getFormSlug(),
                'translatable'                      => true,
            ]
        );
    }
}
