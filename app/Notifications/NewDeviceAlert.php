<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewDeviceAlert extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public $device) {}

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('🔔 Novo Dispositivo Detectado')
            ->subject('🔔 Novo Dispositivo Detectado')
            ->line('Um novo dispositivo foi detectado na rede.')
            ->line('IP: ' . $this->device->ip)
            ->line('MAC: ' . $this->device->mac)
            ->line('Fabricante: ' . $this->device->manufacturer)
            ->line('Hora: ' . now()->format('d/m/Y H:i:s'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
