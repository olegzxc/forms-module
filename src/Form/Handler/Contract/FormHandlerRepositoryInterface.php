<?php namespace Anomaly\FormsModule\Form\Handler\Contract;

use Anomaly\FormsModule\Form\Handler\FormHandlerCollection;

/**
 * Interface FormHandlerRepositoryInterface
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FormsModule\Form\Handler\Contract
 */
interface FormHandlerRepositoryInterface
{

    /**
     * Return all handlers.
     *
     * @return FormHandlerCollection
     */
    public function all();

    /**
     * Get a gateway extension
     * by it's gateway.
     *
     * @param $handler
     * @return null|FormHandlerExtensionInterface
     */
    public function get($handler);
}
