<?php namespace Anomaly\FormsModule\Form\Handler;

use Anomaly\FormsModule\Form\Handler\Contract\FormHandlerExtensionInterface;
use Anomaly\FormsModule\Form\Handler\Contract\FormHandlerRepositoryInterface;
use Anomaly\Streams\Platform\Addon\Extension\ExtensionCollection;

/**
 * Class FormHandlerRepository
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FormsModule\Form\Handler
 */
class FormHandlerRepository implements FormHandlerRepositoryInterface
{

    /**
     * The handler collection.
     *
     * @var FormHandlerCollection
     */
    protected $extensions;

    /**
     * Create a new FormHandlerRepository instance.
     *
     * @param ExtensionCollection $extensions
     */
    public function __construct(ExtensionCollection $extensions)
    {
        $this->extensions = new FormHandlerCollection(
            $extensions->search('anomaly.module.forms::form_handler.*')->enabled()->all()
        );
    }

    /**
     * Return all handlers.
     *
     * @return FormHandlerCollection
     */
    public function all()
    {
        return $this->extensions;
    }

    /**
     * Get a gateway extension
     * by it's gateway.
     *
     * @param $handler
     * @return null|FormHandlerExtensionInterface
     */
    public function get($handler)
    {
        return $this->extensions->get($handler);
    }
}
