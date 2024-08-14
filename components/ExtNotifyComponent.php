<?php

namespace app\components;

use app\models\AuthorSubscribe;
use yii\base\Component;

class ExtNotifyComponent extends Component
{
    protected $apiKey = 'XXXXXXXXXXXXYYYYYYYYYYYYZZZZZZZZXXXXXXXXXXXXYYYYYYYYYYYYZZZZZZZZ';
    protected $from = 'INFORM';

    public function overSms(array $authors, string $bookName): array
    {
        $sendResult = [];
        $subscribers = AuthorSubscribe::find()
            ->select(['author_id', 'phone', "TRIM(CONCAT(surname, ' ', name, ' ', COALESCE(patronymic, ''))) AS fullname"])
            ->joinWith('author')
            ->where(['author_id' => $authors])
            ->asArray()
            ->all();

        if (!empty($subscribers)) {
            $sendData = [
                'apikey' => $this->apiKey,
                'from' => $this->from,
                'send' => [],
            ];

            $i = 1;
            foreach ($subscribers as $subscriberItem) {
                $sendData['send'][] = [
                    'id' => $i,
                    'to' => $subscriberItem['phone'],
                    'text' => sprintf('У автора %s вышла новая книга %s!', $subscriberItem['fullname'], $bookName),
                ];
                $i++;
            }

            $sendResult = file_get_contents('https://smspilot.ru/api2.php', false, stream_context_create([
                'http' => [
                    'method' => 'POST',
                    'header' => "Content-Type: application/json\r\n",
                    'content' => json_encode($sendData),
                ],
            ]));

            if (!empty($sendResult)) {
                $sendResult = json_decode($sendResult ?? [], true);
            }
        }

        return $sendResult;
    }
}