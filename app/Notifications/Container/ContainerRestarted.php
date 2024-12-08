<?php

namespace App\Notifications\Container;

use App\Models\Server;
use App\Notifications\CustomEmailNotification;
use App\Notifications\Dto\DiscordMessage;
use Illuminate\Notifications\Messages\MailMessage;

class ContainerRestarted extends CustomEmailNotification
{
    public function __construct(public string $name, public Server $server, public ?string $url = null)
    {
        $this->onQueue('high');
    }

    public function via(object $notifiable): array
    {
        return setNotificationChannels($notifiable, 'status_changes');
    }

    public function toMail(): MailMessage
    {
        $mail = new MailMessage;
        $mail->subject("Hostly: A resource ({$this->name}) has been restarted automatically on {$this->server->name}");
        $mail->view('emails.container-restarted', [
            'containerName' => $this->name,
            'serverName' => $this->server->name,
            'url' => $this->url,
        ]);

        return $mail;
    }

    public function toDiscord(): DiscordMessage
    {
        $message = new DiscordMessage(
            title: ':warning: Resource restarted',
            description: "{$this->name} has been restarted automatically on {$this->server->name}.",
            color: DiscordMessage::infoColor(),
        );

        if ($this->url) {
            $message->addField('Resource', '[Link]('.$this->url.')');
        }

        return $message;
    }

    public function toTelegram(): array
    {
        $message = "Hostly: A resource ({$this->name}) has been restarted automatically on {$this->server->name}";
        $payload = [
            'message' => $message,
        ];
        if ($this->url) {
            $payload['buttons'] = [
                [
                    [
                        'text' => 'Check Proxy in Hostly',
                        'url' => $this->url,
                    ],
                ],
            ];
        }

        return $payload;
    }
}