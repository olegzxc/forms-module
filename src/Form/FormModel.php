<?php namespace Anomaly\FormsModule\Form;

use Anomaly\FormsModule\Form\Command\GetFormEntriesStream;
use Anomaly\FormsModule\Form\Contract\FormInterface;
use Anomaly\FormsModule\Form\Handler\Contract\FormHandlerExtensionInterface;
use Anomaly\FormsModule\Notification\Contract\NotificationInterface;
use Anomaly\Streams\Platform\Entry\EntryCollection;
use Anomaly\Streams\Platform\Field\Contract\FieldInterface;
use Anomaly\Streams\Platform\Model\Forms\FormsFormsEntryModel;
use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;

/**
 * Class FormModel
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FormsModule\Form
 */
class FormModel extends FormsFormsEntryModel implements FormInterface
{

    /**
     * Get the form handler.
     *
     * @return FormHandlerExtensionInterface
     */
    public function getFormHandler()
    {
        return $this->form_handler;
    }

    /**
     * Get the form view options.
     *
     * @return array
     */
    public function getFormViewOptions()
    {
        return $this->form_view_options;
    }

    /**
     * Get the form entries stream.
     *
     * @return StreamInterface
     */
    public function getFormEntriesStream()
    {
        return $this->dispatch(new GetFormEntriesStream($this));
    }

    /**
     * Get the form entries stream ID.
     *
     * @return int|null
     */
    public function getFormEntriesStreamId()
    {
        if (!$stream = $this->getFormEntriesStream()) {
            return null;
        }

        return $stream->getId();
    }

    /**
     * Get the form slug.
     *
     * @return string
     */
    public function getFormSlug()
    {
        return $this->form_slug;
    }

    /**
     * Get the form name.
     *
     * @return string
     */
    public function getFormName()
    {
        return $this->form_name;
    }

    /**
     * Get the form description.
     *
     * @return string
     */
    public function getFormDescription()
    {
        return $this->form_description;
    }

    /**
     * Get the related actions.
     *
     * @return EntryCollection
     */
    public function getActions()
    {
        return $this->actions;
    }

    /**
     * Get the success message.
     *
     * @return string
     */
    public function getSuccessMessage()
    {
        return $this->success_message;
    }

    /**
     * Get the success redirect.
     *
     * @return string
     */
    public function getSuccessRedirect()
    {
        return $this->success_redirect;
    }

    /**
     * Get the related buttons.
     *
     * @return EntryCollection
     */
    public function getButtons()
    {
        return $this->buttons;
    }

    /**
     * Get the send notification flag.
     *
     * @return array
     */
    public function shouldSendNotification()
    {
        return $this->send_notification;
    }

    /**
     * Get the notification send to emails.
     *
     * @return array
     */
    public function getNotificationSendTo()
    {
        return $this->notification_send_to;
    }

    /**
     * Get the related notification.
     *
     * @return null|NotificationInterface
     */
    public function getNotification()
    {
        return $this->notification;
    }

    /**
     * Get the notification CC emails.
     *
     * @return array
     */
    public function getNotificationCc()
    {
        return $this->notification_cc;
    }

    /**
     * Get the notification BCC emails.
     *
     * @return array
     */
    public function getNotificationBcc()
    {
        return $this->notification_bcc;
    }

    /**
     * Get the related user email field.
     *
     * @return FieldInterface
     */
    public function getUserEmailField()
    {
        return $this->user_email_field;
    }

    /**
     * Get the send autoresponder flag.
     *
     * @return array
     */
    public function shouldSendAutoresponder()
    {
        return $this->send_autoresponder;
    }

    /**
     * Get the related autoresponder.
     *
     * @return null|NotificationInterface
     */
    public function getAutoresponder()
    {
        return $this->autoresponder;
    }
}
