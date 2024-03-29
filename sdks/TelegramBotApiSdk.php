<?php

namespace sdks;

use core\helpers\Log;


class TelegramBotApiSdk
{
    const API_URL = 'https://api.telegram.org/bot';

    const API_ROUT = "tg_api";

    const API_ENTRYPOINT = "/entry";

    private string $token;

    protected ?array $requestData;

    protected string $adminChatId;


    function __construct(?array $requestData = null){
        $this->token = config("telegram.token");
        $this->adminChatId = config("telegram.admin_chat_id");
        $this->requestData = $requestData;
    }

    public function getTelegramApi(string $method, array $options = null): mixed {
        $str_request = self::API_URL . $this->token . '/' . $method;
        if ($options) {
            $str_request .= '?' . http_build_query($options);
        }

        Log::info("PRE TG API request: \n" . print_r([
                "method" => $method,
                "params" => $options,
            ], true));

        $response = file_get_contents($str_request);
        $response_data = json_decode($response, 1) ?? $response;

        Log::info("TG API request: \n" . print_r([
            "method" => $method,
            "params" => $options,
            "result" => $response_data
        ], true));

        return $response_data;
    }

    public function sendMessage(
        string $text,
        string $chatId,
        array $keyboardArray = null
    ): mixed {
        $options['text'] = $text;
        $options['chat_id'] = $chatId;
        if ($keyboardArray) {
            $options['reply_markup'] = $this->makeInlineKeyboard($keyboardArray);
        }
        return $this->getTelegramApi('sendMessage', $options);
    }

    public function editKeyboardOfMessage(
        string $chatId,
        string $messageId,
        array $newKeyboardArray = null
    ): mixed {
        $options['chat_id'] = $chatId;
        $options['message_id'] = $messageId;
        $options['reply_markup'] = $this->makeInlineKeyboard($newKeyboardArray);
        return $this->getTelegramApi('editMessageReplyMarkup', $options);
    }

    public function sendEchoMessage(string $text, array $keyboardArray = null): mixed {
        if (!@$this->requestData['message']['chat']['id']) {
            throw new \Exception("No chat id in request data");
        }
        return $this->sendMessage(
            $text,
            $this->requestData['message']['chat']['id'],
            $keyboardArray
        );
    }

    public function sendMessageToAdminChat(string $text, array $keyboardArray = null) {
        return $this->sendMessage(
            $text,
            $this->adminChatId,
            $keyboardArray
        );
    }

    public function makeInlineKeyboard(array $keyboardArray): string {
        $buttons = [];
        foreach ($keyboardArray as $name => $callbackData) {
            $buttons[] = ['text' => $name, 'callback_data' => $callbackData];
        }
        return json_encode(["inline_keyboard" => [$buttons]]);
    }

    public function setHook($set = 1) {
        $uri = "{$_SERVER['REQUEST_SCHEME']}://{$_SERVER['HTTP_HOST']}/"
            . self::API_ROUT . self::API_ENTRYPOINT;

        return self::getTelegramApi(
            'setWebhook',
            ['url' => $set ? $uri : '']
        ) + ["url" => $uri];
    }
}
