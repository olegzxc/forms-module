<?php namespace Anomaly\FormsModule\Form\Handler\Contract;

use Anomaly\FormsModule\Form\Contract\FormInterface;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Interface FormHandlerExtensionInterface
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FormsModule\Form\Handler\Contract
 */
interface FormHandlerExtensionInterface
{

    /**
     * Return the form's builder instance.
     *
     * @param FormInterface $form
     * @return FormBuilder
     */
    public function builder(FormInterface $form);

    /**
     * Integrate the form handler's services
     * with the primary form's builder instance.
     *
     * @param FormBuilder $builder
     */
    public function integrate(FormBuilder $builder);
}
