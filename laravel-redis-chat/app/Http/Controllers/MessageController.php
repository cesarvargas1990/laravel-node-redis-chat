<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Message;
use App\Http\Requests;
use App\Conversation;
use LRedis;
class MessageController extends Controller
{
    public function store(Request $request){
        $conversation = Conversation::findOrFail($request->conversation_id);
        if($conversation->user1 == Auth::user()->id || $conversation->user2 == Auth::user()->id){
            $message = new Message;
            $message->conversation_id = $request->conversation_id;
            $message->user_id = Auth::user()->id;
            $message->text = $request->text;
            $message->is_read = 0;
            $message->save();

            $receiver_id = ($conversation->user1 == Auth::user()->id)? $conversation->user2 : $conversation->user1;
            $data = [
                'conversation_id'=>$request->conversation_id,
                'text'=>$request->text,
                'client_id' => $receiver_id
            ];
            $redis = LRedis::connection();
            $redis->publish('message', json_encode($data));

            return response()->json(true);
        }
        return response()->json("permission error");
    }
	
	public function enviarMensajeATodos(Request $request) {
		
		$allConversation = Conversation::all();
		
	
		foreach ($allConversation as $conv) {
			
			$conversation = Conversation::findOrFail($conv->id);
		
			$message = new Message;
			$message->conversation_id = $conv->id;
			$message->user_id = $conv->user1;
			$message->text = $request->get('text');
			$message->is_read = 0;
			$message->save();

			$receiver_id = $conv->user1;
			$data = [
			'conversation_id'=>$conv->id,
			'text'=>$request->get('text'),
			'client_id' => $receiver_id
			];
			$redis = LRedis::connection();
			$redis->publish('message', json_encode($data));
			
		}
		
		foreach ($allConversation as $conv) {
			
			$conversation = Conversation::findOrFail($conv->id);
       
			$message = new Message;
			$message->conversation_id = $conv->id;
			$message->user_id = $conv->user2;
			$message->text = $request->get('text');
			$message->is_read = 0;
			$message->save();

			$receiver_id = $conv->user2;
			$data = [
			'conversation_id'=>$conv->id,
			'text'=>$request->get('text'),
			'client_id' => $receiver_id
			];
			$redis = LRedis::connection();
			$redis->publish('message', json_encode($data));

            
        
			//return response()->json("permission error");
			
			
		}
		
		return response()->json(true);
		
	}
}
