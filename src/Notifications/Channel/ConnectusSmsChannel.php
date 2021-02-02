<?php

/**
 * Part of the Connectus Laravel package.
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the 3-clause BSD License.
 *
 * This source file is subject to the 3-clause BSD License that is
 * bundled with this package in the LICENSE file.
 *
 * @package    Connectus Laravel
 * @version    1.0.0
 * @author     Jose Lorente
 * @license    BSD License (3-clause)
 * @copyright  (c) 2019, Jose Lorente
 */

namespace Jlorente\Laravel\Connectus\Notifications\Channel;

use Illuminate\Notifications\Notification;
use Jlorente\Connectus\Connectus;

/**
 * Class ConnectusSmsChannel.
 * 
 * A notification channel to send sms messages through Connectus API.
 *
 * @author Jose Lorente <jose.lorente.martin@gmail.com>
 */
class ConnectusSmsChannel
{

    /**
     * The Connectus client instance.
     *
     * @var Connectus
     */
    protected $client;

    /**
     * Create a new Connectus channel instance.
     *
     * @param Connectus $client
     * @return void
     */
    public function __construct(Connectus $client)
    {
        $this->client = $client;
    }

    /**
     * Send the given notification.
     *
     * @param mixed $notifiable
     * @param \Illuminate\Notifications\Notification $notification
     * @return array|bool
     */
    public function send($notifiable, Notification $notification)
    {
        if (!$to = $notifiable->routeNotificationFor('connectusSms', $notification)) {
            $to = $notifiable->phone_number;
            if (!$to) {
                return;
            }
        }

        $message = $notification->toConnectusSms($notifiable);

        if (config('connectus.is_channel_active') === true) {
            return $this->client->api()->sendSms($to, $message);
        } else {
            return true;
        }
    }

}
