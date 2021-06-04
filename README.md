<h1>Projeto Feito em video aulas sobre notificação no telegram</h1>

## Configure o arquivo .env

        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=aula_telegram
        DB_USERNAME=root
        DB_PASSWORD=

## Rode o comando 
php artisan migrate


## em config services configure

    'telegram-bot-api' => [
        'token' => env('TELEGRAM_BOT_API','SEU TOKEN BOT')
     ]
    'telegram_id' => env('TELEGRAM_ID','INSIRA_CHAT_ID_ENVIO')
    'telegram_getUpdates' => 'https://api.telegram.org/botSEU TOKEN BOT/getUpdates'

## Rode o comando 

Composer install

## Rode o Comando no Terminal

 php artisan short-schedule:run

## Agora adicione um usuário com email na sua base antes de testar. 





  