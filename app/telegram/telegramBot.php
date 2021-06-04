<?php

namespace App\telegram;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Notification;
use App\Models\telegramUser;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\telegramMensagem;
use Illuminate\Support\Facades\Http;
use App\Notifications\notifyTelegramBot;

class TelegramBot 
{
    protected $texto = [
        '1' => 'Se Deseja Cadastrar para receber notificações do sistema envie seu email vinculado ao seu usuário no sistema',
        '2' => 'Seu Telegram já está cadastrado em nosso sistema, se deseja trocar o email  digite "trocar" sem as aspas duplas. 
                Obrigado Pelo Contato!',
        '3' => 'Cadastro Realizado Com Sucesso!',
        '4' => 'O Sistema não possui cadastro com Email Informado',
        '5' => 'Informe o Novo Email:'
    ];

    public function getMensagensTelegram()
    {
        $response = Http::get(Config::get('services.telegram_getUpdates'));
        $retornos = $response->collect();
        foreach($retornos['result'] as $retorno){
            if (isset($retorno['message'])){
                // Verifica se tem o usuário , se não cria
                $userTelegram = telegramUser::find($retorno['message']['from']['id']);
                if(!isset($userTelegram)){
                    $userTelegram = telegramUser::create([
                       'id' =>      $retorno['message']['from']['id'],
                       'usuario' => $retorno['message']['from']['first_name']
                    ]); 
                }
                //Verifica se existe a mensagem, se não cria
                $mensagem = telegramMensagem::find($retorno['update_id']);
                if(!isset($mensagem)){
                    $mensagem = telegramMensagem::create([
                        'id' => $retorno['update_id'],
                        'user_telegram_id' => $userTelegram->id,
                        'mensagem' => $retorno['message']['text']
                    ]);
                }
                // Deletando Mensagem Anteriores
                DB::table('telegram_mensagems')
                    ->where('id' , '<' , $mensagem->id ) 
                    ->where('user_telegram_id' ,'=' , $userTelegram->id)->delete();
            } 
        }
        $this->enviaMensagem();
    }
    public function enviaMensagem()
    {
        $mensagens = telegramMensagem::where('respondida' , '=' , 'N')->get();
        
        foreach($mensagens as $mensagem){

            $user = User::where('telegramid' ,'=' ,$mensagem->user_telegram_id)->first();
            if(isset($user)){
                if(strtolower($mensagem->mensagem) == 'trocar'){
                    DB::table('users')->where('id' , '=' , $user->id)->update(['telegramid'=> null]);
                    $texto = $this->texto['5'];
                }
                else{
                    $texto = $this->texto['2']. 
                                        '  Email Atual  :  ' . $user->email; 
                }  
            }else{
                    if (filter_var($mensagem->mensagem, FILTER_VALIDATE_EMAIL)) {
                        $texto = $this->atualizaUserTelegram($mensagem->mensagem,$mensagem->user_telegram_id);
                    }
                    else{
                        $texto = $this->texto['1']; 
                    }   
            }
            Notification::route('telegram',$mensagem->user_telegram_id)
            ->notify(new NotifyTelegramBot($texto));
            $mensagem->respondida = 'S';
            $mensagem->save();
        } 
    }
    public function atualizaUserTelegram($email,$telegramid)
    {
        $user = User::where('email' , '=' , $email)->first();
        if(isset($user)){
            $user->telegramid = $telegramid;
            $user->save();
            $texto = $this->texto['3'] .'+%0A+ Obrigado '. $user->name . '!' ;
        }else{
            $texto = $this->texto['4'];
        }
        return $texto;
    }


}