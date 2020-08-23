<?php namespace Anomaly\FormsModule\Form\Command;

use Anomaly\FormsModule\Form\Contract\FormInterface;
use Anomaly\Streams\Platform\Support\String;
use Anomaly\Streams\Platform\Support\Value;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Anomaly\WysiwygFieldType\WysiwygFieldType;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Mail\Message;

/**
 * Class SendFormMessage
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FormsModule\Form\Command
 */
class SendFormMessage
{

    /**
     * The form builder.
     *
     * @var FormBuilder
     */
    protected $builder;

    /**
     * Create a new SendFormMessage instance.
     *
     * @param FormBuilder $builder
     */
    public function __construct(FormBuilder $builder)
    {
        $this->builder = $builder;
    }

    public function handle(Mailer $mailer, Value $value, String $string)
    {
        /* @var FormInterface $config */
        $config = $this->builder->getOption('config');

        /* @var WysiwygFieldType $email */
        $email = $config->getFieldTypePresenter('message_content');

        $mailer->send(
            $email->getViewPath(),
            [],
            function (Message $message) use ($config, $value) {

                $message->from($config->getMessageFromEmail(), $config->getMessageFromName());
                $message->subject($value->make($config->getMessageSubject(), $this->builder->getFormEntry(), 'input'));
                $message->to($config->getMessageSendTo());
            }
        );
    }
}
