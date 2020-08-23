<?php namespace Anomaly\FormsModule\Form\Contract;

use Anomaly\FormsModule\Form\Handler\Contract\FormHandlerExtensionInterface;
use Anomaly\FormsModule\Notification\Contract\NotificationInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Entry\EntryCollection;
use Anomaly\Streams\Platform\Field\Contract\FieldInterface;
use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;

/**
 * Interface FormInterface
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FormsModule\Form\Contract
 */
interface FormInterface extends EntryInterface
{

    /**
     * Get the form handler.
     *
     * @return FormHandlerExtensionInterface
     */
    public function getFormHandler();

    /**
     * Get the form view options.
     *
     * @return array
     */
    public function getFormViewOptions();

    /**
     * Get the form entries stream.
     *
     * @return StreamInterface
     */
    public function getFormEntriesStream();

    /**
     * Get the form entries stream ID.
     *
     * @return int|null
     */
    public function getFormEntriesStreamId();

    /**
     * Get the form slug.
     *
     * @return string
     */
    public function getFormSlug();

    /**
     * Get the form name.
     *
     * @return string
     */
    public function getFormName();

    /**
     * Get the form description.
     *
     * @return string
     */
    public function getFormDescription();

    /**
     * Get the send notification flag.
     *
     * @return array
     */
    public function shouldSendNotification();

    /**
     * Get the notification send to emails.
     *
     * @return array
     */
    public function getNotificationSendTo();

    /**
     * Get the related notification.
     *
     * @return null|NotificationInterface
     */
    public function getNotification();

    /**
     * Get the notification CC emails.
     *
     * @return array
     */
    public function getNotificationCc();

    /**
     * Get the related user email field.
     *
     * @return FieldInterface
     */
    public function getUserEmailField();

    /**
     * Get the notification BCC emails.
     *
     * @return array
     */
    public function getNotificationBcc();

    /**
     * Get the send autoresponder flag.
     *
     * @return array
     */
    public function shouldSendAutoresponder();

    /**
     * Get the related autoresponder.
     *
     * @return null|NotificationInterface
     */
    public function getAutoresponder();

    /**
     * Get the success message.
     *
     * @return string
     */
    public function getSuccessMessage();

    /**
     * Get the success redirect.
     *
     * @return string
     */
    public function getSuccessRedirect();

    /**
     * Get the related actions.
     *
     * @return EntryCollection
     */
    public function getActions();

    /**
     * Get the related buttons.
     *
     * @return EntryCollection
     */
    public function getButtons();
}
