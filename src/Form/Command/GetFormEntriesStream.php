<?php namespace Anomaly\FormsModule\Form\Command;

use Anomaly\FormsModule\Form\Contract\FormInterface;
use Anomaly\Streams\Platform\Stream\Contract\StreamRepositoryInterface;


/**
 * Class GetFormEntriesStream
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FormsModule\Form\Command
 */
class GetFormEntriesStream
{

    /**
     * The form instance.
     *
     * @var FormInterface
     */
    protected $form;

    /**
     * Create a new GetFormEntriesStream instance.
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
     * @return \Anomaly\Streams\Platform\Stream\Contract\StreamInterface|null
     */
    public function handle(StreamRepositoryInterface $streams)
    {
        return $streams->findBySlugAndNamespace($this->form->getFormSlug(), 'forms');
    }
}
