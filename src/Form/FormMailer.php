<?php namespace Anomaly\FormsModule\Form;

use Anomaly\FilesModule\File\Contract\FileInterface;
use Anomaly\FormsModule\Form\Contract\FormInterface;
use Anomaly\FormsModule\Form\Contract\FormRepositoryInterface;
use Anomaly\Streams\Platform\Assignment\Contract\AssignmentInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Support\Value;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Anomaly\WysiwygFieldType\WysiwygFieldType;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Mail\Message;

/**
 * Class FormMailer
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class FormMailer
{

    /**
     * The form repository.
     *
     * @var FormRepositoryInterface
     */
    protected $forms;

    /**
     * The value utility.
     *
     * @var Value
     */
    protected $value;

    /**
     * The mailer utility.
     *
     * @var Mailer
     */
    protected $mailer;

    /**
     * The config repository.
     *
     * @var Repository
     */
    protected $config;

    /**
     * Create a new FormMailer instance.
     *
     * @param Mailer                  $mailer
     * @param Repository              $config
     * @param Value                   $value
     * @param FormRepositoryInterface $forms
     */
    public function __construct(Mailer $mailer, Repository $config, Value $value, FormRepositoryInterface $forms)
    {
        $this->mailer = $mailer;
        $this->config = $config;
        $this->value  = $value;
        $this->forms  = $forms;
    }

    /**
     * Send the form message.
     *
     * @param FormInterface           $form
     * @param FormRepositoryInterface $forms
     * @param FormBuilder             $builder
     */
    public function send(FormInterface $form, FormBuilder $builder)
    {
        $input = $entry = $builder->getFormEntry();

        $stream = $entry->getStream();
        $form   = $this->forms->findBySlug($stream->getSlug());

        if (!$form->shouldSendNotification()) {
            return;
        }

        if (!$form->getNotificationSendTo()) {
            return;
        }

        $notification = $form->getNotification();

        /* @var WysiwygFieldType $email */
        $email = $notification->getFieldType('notification_content');

        $this->mailer->send(
            $email->getViewPath(),
            compact('input', 'form'),
            function (Message $message) use ($form, $entry, $builder, $notification) {

                $message->cc($form->getNotificationCc());
                $message->bcc($form->getNotificationBcc());
                $message->to($form->getNotificationSendTo());
                $message->subject($this->value->make($notification->getNotificationSubject(), $entry, 'input'));
                $message->sender($this->value->make($notification->getNotificationFromEmail(), $entry, 'input'));
                $message->replyTo(
                    $this->value->make($notification->getNotificationReplyToEmail(), $entry, 'input'),
                    $this->value->make($notification->getNotificationReplyToName(), $entry, 'input')
                );
                $message->from(
                    $this->value->make($notification->getNotificationFromEmail(), $entry, 'input'),
                    $this->value->make($notification->getNotificationFromName(), $entry, 'input')
                );

                $this->attachFiles($message, $entry);
            }
        );
    }

    /**
     * Attach file uploads.
     *
     * @param Message        $message
     * @param EntryInterface $entry
     */
    protected function attachFiles(Message $message, EntryInterface $entry)
    {
        $supported = $this->config->get('anomaly.module.forms::attachments.supported', []);

        foreach ($supported as $type) {

            /* @var AssignmentInterface $assignment */
            foreach ($entry->getAssignmentsByFieldType($type) as $assignment) {

                // Load the relation.
                $entry->load(str_humanize($assignment->getFieldSlug()));

                /* @var FileInterface $file */
                if ($file = $entry->{$assignment->getFieldSlug()}) {
                    $message->attachData($file->resource()->read(), $file->getName());
                }
            }
        }
    }
}
