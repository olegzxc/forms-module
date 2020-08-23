<?php namespace Anomaly\FormsModule\Notification;

use Anomaly\FormsModule\Notification\Contract\NotificationInterface;
use Anomaly\Streams\Platform\Model\Forms\FormsNotificationsEntryModel;

/**
 * Class NotificationModel
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FormsModule\Notification
 */
class NotificationModel extends FormsNotificationsEntryModel implements NotificationInterface
{

    /**
     * Get the notification from email.
     *
     * @return string
     */
    public function getNotificationFromEmail()
    {
        return $this->notification_from_email;
    }

    /**
     * Get the notification from name.
     *
     * @return string
     */
    public function getNotificationFromName()
    {
        return $this->notification_from_name;
    }

    /**
     * Get the reply to email.
     *
     * @return string
     */
    public function getNotificationReplyToEmail()
    {
        return $this->notification_reply_to_email;
    }

    /**
     * Get the reply to name.
     *
     * @return string
     */
    public function getNotificationReplyToName()
    {
        return $this->notification_reply_to_name;
    }

    /**
     * Get the notification subject.
     *
     * @return string
     */
    public function getNotificationSubject()
    {
        return $this->notification_subject;
    }
}
