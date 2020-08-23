<?php namespace Anomaly\FormsModule\Form\Form\Field;

use Anomaly\FormsModule\Form\Contract\FormInterface;
use Anomaly\Streams\Platform\Stream\Contract\StreamRepositoryInterface;
use Anomaly\TagsFieldType\TagsFieldType;

/**
 * Class ViewOptions
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FormsModule\Form\Form\Field
 */
class ViewOptions
{

    /**
     * Handle the options.
     *
     * @param TagsFieldType             $fieldType
     * @param StreamRepositoryInterface $streams
     */
    public function handle(TagsFieldType $fieldType, StreamRepositoryInterface $streams)
    {
        /* @var FormInterface $form */
        $form = $fieldType->getEntry();

        $stream = $streams->findBySlugAndNamespace($form->getFormSlug(), 'forms');

        if ($stream) {
            $fieldType->setOptions($stream->getAssignmentFieldSlugs());
        }
    }
}
