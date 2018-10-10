<?php
namespace jdlc\telegram;

class TelegramBot {
  public static function main() {
    if (self::checkToken()) {
      $request = self::receiveRequest();
      $chatId = $request->message->chat->id;
      $text = $request->message->text;
      $message = self::execute($text);
      self::sendMessage($chatId, $message);
    }
  }

  public static function execute($input) {
    $output = $input;
    return $output;
  }

  private static function checkToken() {
    $pathInfo = ltrim($_SERVER['PATH_INFO'] ?? '', '/');
    return $pathInfo == getenv('TELEGRAM_TOKEN');
  }

  private static function receiveRequest() {
    $json = file_get_contents("php://input");
    $request = json_decode($json, $assoc=false);
    self::saveLog($json);
    return $request;
  }

  private static function sendMessage($chatId, $text) {
    $query = http_build_query([
      'chat_id'=> $chatId,
      'text'=> $text." de qué?",
      'parse_mode'=> "Markdown",
    ]);
    $response = file_get_contents(getenv('TELEGRAM')."/sendMessage?$query");
    return $response;
  }

  public static function setWebHook() {
    $setWebHook = getenv('TELEGRAM').'/setwebhook?url='.getenv('WEBHOOK');
    $response = file_get_contents($setWebHook);
    return $response;
  }

  private static function saveLog($message) {
    $FILE = "webhook.log";
    $date = date('Y-m-d H:i:s');
    $content = "$date\n$message\n\n";
    file_put_contents($FILE, $content, FILE_APPEND);
  }

}
