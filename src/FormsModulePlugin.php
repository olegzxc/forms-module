<?php namespace Anomaly\FormsModule;

use Anomaly\FormsModule\Form\Contract\FormRepositoryInterface;
use Anomaly\Streams\Platform\Addon\Plugin\Plugin;
use Anomaly\Streams\Platform\Assignment\Contract\AssignmentInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Support\Decorator;
use Anomaly\Streams\Platform\Support\Presenter;

/**
 * Class FormsModulePlugin
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FormsModule
 */
class FormsModulePlugin extends Plugin
{

    /**
     * The form repository.
     *
     * @var FormRepositoryInterface
     */
    protected $forms;

    /**
     * The presenter decorator.
     *
     * @var Decorator
     */
    protected $decorator;

    /**
     * Create a new FormsModulePlugin instance.
     *
     * @param FormRepositoryInterface $forms
     * @param Decorator               $decorator
     */
    public function __construct(FormRepositoryInterface $forms, Decorator $decorator)
    {
        $this->forms     = $forms;
        $this->decorator = $decorator;
    }

    /**
     * Get the functions.
     *
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('forms_get', [$this, 'get'], ['is_safe' => ['html']]),
            new \Twig_SimpleFunction('forms_input', [$this, 'input'], ['is_safe' => ['html']]),
            new \Twig_SimpleFunction('forms_display', [$this, 'get'], ['is_safe' => ['html']]),
        ];
    }

    /**
     * Return the form presenter.
     *
     * @param $slug
     * @return array|\ArrayAccess|\IteratorAggregate|null|\Robbo\Presenter\Presenter
     */
    public function get($slug)
    {
        if (!$form = $this->forms->findBySlug($slug)) {
            return null;
        }

        $handler = $form->getFormHandler();
        $builder = $handler->builder($form);

        return $this->decorator->decorate(
            $builder->make()->getForm()
        );
    }

    /**
     * Return the form input.
     *
     * @param $input
     */
    public function input($input)
    {
        $output = '';

        if ($input instanceof Presenter) {
            $input = $input->getObject();
        }

        /* @var EntryInterface $input */
        /* @var AssignmentInterface $assignment */
        foreach ($input->getAssignments() as $assignment) {

            $value = $input->getFieldValue($assignment->getFieldSlug());

            if (is_array($value)) {
                $value = implode(', ', $value);
            }

            $label = $assignment->getFieldName();

            $output .= "<strong>{$label}: </strong> {$value}<br>";
        }

        return $output;
    }
}
