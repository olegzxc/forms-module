<?php namespace Anomaly\FormsModule\Form\Command;

use Anomaly\FormsModule\Form\Contract\FormInterface;
use Anomaly\Streams\Platform\Stream\Contract\StreamRepositoryInterface;


/**
 * Class DeleteFormEntriesStream
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FormsModule\Form\Command
 */
class DeleteFormEntriesStream
{

    /**
     * The form instance.
     *
     * @var FormInterface
     */
    protected $form;

    /**
     * Create a new DeleteFormEntriesStream instance.
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
     */
    public function handle(StreamRepositoryInterface $streams)
    {
        if ($stream = $streams->findBySlugAndNamespace($this->form->getFormSlug(), 'forms')) {
            $streams->delete($stream);
        }
    }
}
