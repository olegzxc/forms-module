<?php namespace Anomaly\FormsModule\Notification\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;

/**
 * Interface NotificationInterface
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FormsModule\Notification\Contract
 */
interface NotificationInterface extends EntryInterface
{

    /**
     * Get the notification from email.
     *
     * @return string
     */
    public function getNotificationFromEmail();

    /**
     * Get the notification from name.
     *
     * @return string
     */
    public function getNotificationFromName();

    /**
     * Get the reply to email.
     *
     * @return string
     */
    public function getNotificationReplyToEmail();

    /**
     * Get the reply to name.
     *
     * @return string
     */
    public function getNotificationReplyToName();

    /**
     * Get the notification subject.
     *
     * @return string
     */
    public function getNotificationSubject();
}
