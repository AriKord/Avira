<?php
//   Avira Edit v1.1  //
ob_start();
define('API_KEY','759185909:AAENHdklxUhGF1ErZQJvHrisKyNUXWnUQ9U');     
//----------------------------------------------------------------------
function bot($method,$data){
  
  $url = "https://api.telegram.org/bot".API_KEY."/".$method;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, count($data));
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $result = curl_exec($ch);
  curl_close($ch);
  return $result;
 }
$dev = array("779216972","777754237","000000000","000000000");   
@$usernamebot = "AviraApiBot";    
@$channel = "Kordsticker";   
@$token = API_KEY;
////   Avira Edit v1.1  ////
$update = json_decode(file_get_contents('php://input'));
@$message = $update->message;
@$from_id = $message->from->id;
@$chat_id = $message->chat->id;
@$message_id = $message->message_id;
@$first_name = $message->from->first_name;
@$last_name = $message->from->last_name;
@$username = $message->from->username;
@$textmassage = $message->text;
@$firstname = $update->callback_query->from->first_name;
@$usernames = $update->callback_query->from->username;
@$chatid = $update->callback_query->message->chat->id;
@$fromid = $update->callback_query->from->id;
@$membercall = $update->callback_query->id;
@$reply = $update->message->reply_to_message->forward_from->id;
//   Telesub Edit v1.0  //
@$data = $update->callback_query->data;
@$messageid = $update->callback_query->message->message_id;
@$tc = $update->message->chat->type;
@$gpname = $update->callback_query->message->chat->title;
@$namegroup = $update->message->chat->title;
@$text = $update->inline_qurey->qurey;
//------------------------------------------------------------------------
@$newchatmemberid = $update->message->new_chat_member->id;
@$newchatmemberu = $update->message->new_chat_member->username;
@$rt = $update->message->reply_to_message;
@$replyid = $update->message->reply_to_message->message_id;
@$tedadmsg = $update->message->message_id;
@$edit = $update->edited_message->text;
@$re_id = $update->message->reply_to_message->from->id;
@$re_user = $update->message->reply_to_message->from->username;
@$re_name = $update->message->reply_to_message->from->first_name;
@$re_msgid = $update->message->reply_to_message->message_id;
@$re_chatid = $update->message->reply_to_message->chat->id;
@$message_edit_id = $update->edited_message->message_id;
@$chat_edit_id = $update->edited_message->chat->id;
@$edit_for_id = $update->edited_message->from->id;
@$edit_chatid = $update->callback_query->edited_message->chat->id;
@$caption = $update->message->caption;
//------------------------------------------------------------------------
@$statjson = json_decode(file_get_contents("https://api.telegram.org/bot$token/getChatMember?chat_id=$chat_id&user_id=".$from_id),true);
@$status = $statjson['result']['status'];
@$statjsonrt = json_decode(file_get_contents("https://api.telegram.org/bot$token/getChatMember?chat_id=$chat_id&user_id=".$re_id),true);
@$statusrt = $statjsonrt['result']['status'];
@$statjsonq = json_decode(file_get_contents("https://api.telegram.org/bot$token/getChatMember?chat_id=$chatid&user_id=".$fromid),true);
@$statusq = $statjsonq['result']['status'];
@$info = json_decode(file_get_contents("https://api.telegram.org/bot$token/getChatMember?chat_id=$chat_edit_id&user_id=".$edit_for_id),true);
@$you = $info['result']['status'];
@$forchannel = json_decode(file_get_contents("https://api.telegram.org/bot".$token."/getChatMember?chat_id=@".$channel."&user_id=".$from_id));
@$tch = $forchannel->result->status;
//-----------------------------------------------------------------------------------------
@$settings = json_decode(file_get_contents("data/$chat_id.json"),true);
@$settings2 = json_decode(file_get_contents("data/$chatid.json"),true);
@$editgetsettings = json_decode(file_get_contents("data/$chat_edit_id.json"),true);
@$user = json_decode(file_get_contents("data/user.json"),true);
@$filterget = $settings["filterlist"];
//=======================================================================================
/////  AviraApiBot   /////
$button_back = json_encode(['keyboard'=>[
[['text'=>'برگشت »']],
],'resize_keyboard'=>true]);
//فانکشن ها :
function SendMessage($chat_id, $text){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>$text,
'parse_mode'=>'HTML']);
}
 function Forward($berekoja,$azchejaei,$kodompayam)
{
bot('ForwardMessage',[
'chat_id'=>$berekoja,
'from_chat_id'=>$azchejaei,
'message_id'=>$kodompayam
]);
}
function  getUserProfilePhotos($token,$from_id) {
  @$url = 'https://api.telegram.org/bot'.$token.'/getUserProfilePhotos?user_id='.$from_id;
  @$result = file_get_contents($url);
  @$result = json_decode ($result);
  @$result = $result->result;
  return $result;
}
function check_filter($str){
	global $filterget;
	foreach($filterget as $d){
		if (mb_strpos($str, $d) !== false) {
			return true;
		}
	}
}
//=======================================================================================
// msg check
// lock link
if($settings["lock"]["link"] == "Active ✓"){
if ($status != 'creator' && $status != 'administrator' && !in_array($from_id,$dev)){
if (strstr($textmassage,"t.me") == true or strstr($textmassage,"telegram.me") == true or strstr($caption,"t.me") == true or strstr($caption,"telegram.me") == true or strstr($caption,"https://")) {   
bot('deletemessage',[
    'chat_id'=>$chat_id,
    'message_id'=>$message_id
    ]);
  }
}
}
// lock photo
if($settings["lock"]["photo"] == "Active ✓"){
if ($status != 'creator' && $status != 'administrator' && !in_array($from_id,$dev)){
if ($update->message->photo){  
bot('deletemessage',[
    'chat_id'=>$chat_id,
    'message_id'=>$message_id
    ]);
  }
}
}
// gif
if($settings["lock"]["gif"] == "Active ✓"){
if ($status != 'creator' && $status != 'administrator' && !in_array($from_id,$dev)){
if ($update->message->document){  
bot('deletemessage',[
    'chat_id'=>$chat_id,
    'message_id'=>$message_id
    ]);
  }
}
}
// document
if($settings["lock"]["document"] == "Active ✓"){
if ($status != 'creator' && $status != 'administrator' && !in_array($from_id,$dev)){
if ($update->message->document){  
bot('deletemessage',[
    'chat_id'=>$chat_id,
    'message_id'=>$message_id
    ]);
  }
}
}
// video
if($settings["lock"]["video"] == "Active ✓"){
if ($status != 'creator' && $status != 'administrator' && !in_array($from_id,$dev)){
if ($update->message->video){  
bot('deletemessage',[
    'chat_id'=>$chat_id,
    'message_id'=>$message_id
    ]);
  }
}
}
// edit 
if($editgetsettings["lock"]["edit"] == "Active ✓"){
if ( $you != 'creator' && $you != 'administrator' && $edit_for_id != $dev){
if ($update->edited_message->text){  
bot('deletemessage',[
    'chat_id'=>$chat_edit_id,
    'message_id'=>$message_edit_id
    ]);
  }
}
}
// contact
if ($settings["lock"]["contact"] == "Active ✓"){
if($update->message->contact){
if ($tc == 'group' | $tc == 'supergroup'){
if ( $status != 'creator' && $status != 'administrator' && !in_array($from_id,$dev) ){
	bot('deletemessage',[
    'chat_id'=>$chat_id,
    'message_id'=>$message_id
    ]);
	}
}
}
}
// tag
if ($settings["lock"]["tag"] == "Active ✓"){
if (strstr($textmassage,"#") == true or strstr($caption,"#") == true) {
if ($tc == 'group' | $tc == 'supergroup'){
if ( $status != 'creator' && $status != 'administrator' && !in_array($from_id,$dev) ){
	bot('deletemessage',[
    'chat_id'=>$chat_id,
    'message_id'=>$message_id
    ]);
	}
}
}
}// username 
if ($settings["lock"]["username"] == "Active ✓"){
if (strstr($textmassage,"@") == true or strstr($caption,"@") == true) {
if ($tc == 'group' | $tc == 'supergroup'){
if ( $status != 'creator' && $status != 'administrator' && !in_array($from_id,$dev) ){
	bot('deletemessage',[
    'chat_id'=>$chat_id,
    'message_id'=>$message_id
    ]);
	}
}
}
}
// audio
if ($settings["lock"]["audio"] == "Active ✓"){
if($update->message->audio){
if ($tc == 'group' | $tc == 'supergroup'){
if ( $status != 'creator' && $status != 'administrator' && !in_array($from_id,$dev) ){
	bot('deletemessage',[
    'chat_id'=>$chat_id,
    'message_id'=>$message_id
    ]);
	}
}
}
}
// voice 
if ($settings["lock"]["voice"] == "Active ✓"){
if($update->message->voice){
if ($tc == 'group' | $tc == 'supergroup'){
if ( $status != 'creator' && $status != 'administrator' && !in_array($from_id,$dev) ){
	bot('deletemessage',[
    'chat_id'=>$chat_id,
    'message_id'=>$message_id
    ]);
	}
}
}
}
// add
if($settings["information"]["add"] == "Active ✓") {
if($newchatmemberid == true){
$add = $settings["addlist"]["$from_id"]["add"];
$addplus = $add +1;
$settings["addlist"]["{$from_id}"]["add"]="$addplus";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
}
if($settings["information"]["add"] == "Active ✓"){
if ($status != "creator" && $status != "administrator" && !in_array($from_id,$dev)){
if ($tc == 'group' | $tc == 'supergroup'){
$youadding = $settings["addlist"]["$from_id"]["add"];
$setadd = $settings["information"]["setadd"];
$addtext = $settings["addlist"]["$from_id"]["addtext"];
$msg = $settings["information"]["lastmsgadd"];
            if($youadding < $setadd){
			if($addtext == false){
            bot('SendMessage',[
			'parse_mode'=>"HTML",
                'chat_id'=>$chat_id,
                'text'=>"
• کاربر $re_name به منظور چت کردن در گروه باید $setadd عدد عضو اد کنید !",
            ]);
            bot('deletemessage',[
                'chat_id'=>$chat_id,
            'message_id'=>$message_id
            ]);
			            bot('deletemessage',[
                'chat_id'=>$chat_id,
            'message_id'=>$msg
            ]);
$msgplus = $message_id + 1;
$settings["information"]["lastmsgadd"]="$msgplus";
$settings["addlist"]["$from_id"]["addtext"]="true";
$settings["addlist"]["$from_id"]["add"]=0;
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
          }
		  else
		  {
			              bot('deletemessage',[
                'chat_id'=>$chat_id,
            'message_id'=>$message_id
			 ]);
       }
		}
		  }
		}
		}
//  game
if($settings["lock"]["game"] == "Active ✓"){
if($update->message->game){
if ($tc == 'group' | $tc == 'supergroup'){
if ( $status != 'creator' && $status != 'administrator' && !in_array($from_id,$dev) ){
	bot('deletemessage',[
    'chat_id'=>$chat_id,
    'message_id'=>$message_id
    ]);
	}
}
}
}
// location
if ($settings["lock"]["location"] == "Active ✓"){
if($update->message->location){
if ($tc == 'group' | $tc == 'supergroup'){
if ( $status != 'creator' && $status != 'administrator' && !in_array($from_id,$dev) ){
	bot('deletemessage',[
    'chat_id'=>$chat_id,
    'message_id'=>$message_id
    ]);
	}
}
}
}
// filter
if($settings["filterlist"] != false){
if ($status != 'creator' && $status != 'administrator' ) {
$check = check_filter("$textmassage");
if ($check == true) {
bot('deletemessage',[
    'chat_id'=>$chat_id,
    'message_id'=>$message_id
    ]);
}
}
}
// setrules
if($settings["information"]["step"] == "setrules"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev) ){
if ($tc == 'group' | $tc == 'supergroup'){
$plus = mb_strlen("$textmassage");
if($plus < 600) {
bot('sendmessage',[
 'chat_id'=>$chat_id,
 'text'=>"• قوانین گروه شما ثبت شد !",
  'reply_to_message_id'=>$message_id,
 ]);
$settings["information"]["rules"]="$textmassage";
$settings["information"]["step"]="none";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
else
{
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• حداکثر میتوانید 600 حرف را وارد کنید !",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
}
}
}
}
// lock channel 
if($settings["information"]["lockchannel"] == "Active ✓"){
if ($status != "creator" && $status != "administrator" && !in_array($from_id,$dev)){
if ($tc == 'group' | $tc == 'supergroup'){
$usernamechannel = $settings["information"]["setchannel"];
@$forchannel = json_decode(file_get_contents("https://api.telegram.org/bot".$token."/getChatMember?chat_id=".$usernamechannel."&user_id=".$from_id));
@$tch = $forchannel->result->status;
if($tch != 'member' && $tch != 'creator' && $tch != 'administrator'){
$msg = $settings["information"]["lastmsglockchannel"];
$channeltext = $settings["channellist"]["$from_id"]["channeltext"];
			if($channeltext == false){
            bot('SendMessage',[
			'parse_mode'=>"HTML",
                'chat_id'=>$chat_id,
                'text'=>"
• کاربر [$from_id]
جهت بدست آوردن توانایی چت در گروه باید عضو کانال ( $usernamechannel ) شوید",
            ]);
            bot('deletemessage',[
                'chat_id'=>$chat_id,
            'message_id'=>$message_id
            ]);
			            bot('deletemessage',[
                'chat_id'=>$chat_id,
            'message_id'=>$msg
            ]);
$msgplus = $message_id + 1;
$settings["information"]["lastmsglockchannel"]="$msgplus";
$settings["channellist"]["$from_id"]["channeltext"]="true";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
          }
		  else
		  {
			              bot('deletemessage',[
                'chat_id'=>$chat_id,
            'message_id'=>$message_id
			 ]);
       }
		}
		  }
		}
		}
if($settings["information"]["step"] == "setchannel"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev) ){
if ($tc == 'group' | $tc == 'supergroup'){
if(strpos($textmassage , '@') !== false) {
bot('sendmessage',[
 'chat_id'=>$chat_id,
 'text'=>"• کانال ( $textmassage ) با موفقیت تنظیم شد !",
  'reply_to_message_id'=>$message_id,
 ]);
$settings["information"]["setchannel"]="$textmassage";
$settings["information"]["step"]="none";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
else
{
		bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• یوزرنیم کانال با @ شروع می شود !",
  'reply_to_message_id'=>$message_id,
            'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
					 [
					 ['text'=>"برگشت »",'callback_data'=>'lockchannel']
					 ],
                     ]
               ])
 ]);
}
}
}
}
// banall
elseif ($tc == 'private'){ 
if(in_array($from_id, $user["banlist"])) {
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• کاربر به صورت همگانی مسدود می باشد !",
'reply_markup'=>json_encode(['KeyboardRemove'=>[
],'remove_keyboard'=>true
])
]);
    }
}
elseif ($tc == 'group' | $tc == 'supergroup'){ 
if(in_array($from_id, $user["banlist"])) {
		bot('KickChatMember',[
    'chat_id'=>$chat_id,
    'user_id'=>$from_id
      ]);
}
}
// sup
if($user["userjop"]["$from_id"]["file"] == "sup"&& $tc == "private"){   
if ($textmassage != "برگشت »") {	
bot('ForwardMessage',[
'chat_id'=>$dev[0],
'from_chat_id'=>$chat_id,
'message_id'=>$message_id
]);
			bot('sendmessage',[       
			'chat_id'=>$chat_id,
			'text'=>"
• پیام شما با موفقیت ثبت شد\nبرای اتمام مکالمه /cancel را ارسال کنید !",
	]);	
	}
	}
// bots
if($settings["lock"]["bot"] == "Active ✓"){
if ($message->new_chat_member->is_bot) {
$hardmodebot = $settings["information"]["hardmodebot"];
if($hardmodebot == "Inactive ✗"){
 bot('kickChatMember',[
 'chat_id'=>$chat_id,
  'user_id'=>$update->message->new_chat_member->id
  ]);
  }
else
{
 bot('kickChatMember',[
 'chat_id'=>$chat_id,
  'user_id'=>$update->message->new_chat_member->id
  ]);
   bot('kickChatMember',[
 'chat_id'=>$chat_id,
  'user_id'=>$from_id
  ]);
}
}
}
// sticker
if ($settings["lock"]["sticker"] == "Active ✓"){
if($update->message->sticker){
if ($tc == 'group' | $tc == 'supergroup'){
if ( $status != 'creator' && $status != 'administrator' && !in_array($from_id,$dev) ){
	bot('deletemessage',[
    'chat_id'=>$chat_id,
    'message_id'=>$message_id
    ]);
	}
}
}
}
// forward
if ($settings["lock"]["forward"] == "Active ✓"){
if($update->message->forward_from | $update->message->forward_from_chat){
if ($tc == 'group' | $tc == 'supergroup'){
if ( $status != 'creator' && $status != 'administrator' && !in_array($from_id,$dev) ){
 bot('deletemessage',[
    'chat_id'=>$chat_id,
    'message_id'=>$message->message_id
    ]);
 }
}
}
}
// fosh 
if ($settings["lock"]["fosh"] == "Active ✓"){
if (strstr($textmassage,"کسکش") == true  or strstr($textmassage,"جنده") == true or strstr($textmassage,"کیر") == true  or  strstr($textmassage,"سکسی") == true   or strstr($textmassage,"کون") == true) {
if ($tc == 'group' | $tc == 'supergroup'){
if ( $status != 'creator' && $status != 'administrator' && !in_array($from_id,$dev) ){
	bot('deletemessage',[
    'chat_id'=>$chat_id,
    'message_id'=>$message_id
    ]);
	}
}
}
}
// muteall
if ($settings["lock"]["mute_all"] == "Active ✓"){
if($update->message){
if ( $status != 'creator' && $status != 'administrator' && !in_array($from_id,$dev) ){
 bot('deletemessage',[
    'chat_id'=>$chat_id,
    'message_id'=>$message->message_id
    ]);
 }
}
}
// muteall time
if ($settings["lock"]["mute_all_time"] == "Active ✓"){
$locktime = $settings["information"]["mute_all_time"];
date_default_timezone_set('Asia/Tehran');
$date1 = date("h:i:s");
if($date1 < $locktime){
if($update->message){
if ( $status != 'creator' && $status != 'administrator' && !in_array($from_id,$dev) ){
 bot('deletemessage',[
    'chat_id'=>$chat_id,
    'message_id'=>$message->message_id
    ]);
 }
else
{
$settings["lock"]["mute_all_time"]="Inactive ✗";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
}
}
}
// replay
if ($settings["lock"]["reply"] == "Active ✓"){
if($update->message->reply_to_message){
if ($tc == 'group' | $tc == 'supergroup'){
if ( $status != 'creator' && $status != 'administrator' && !in_array($from_id,$dev) ){
 bot('deletemessage',[
    'chat_id'=>$chat_id,
    'message_id'=>$message->message_id
    ]);
 }
}
}
}
// tg
if ($settings["lock"]["tgservic"] == "Active ✓"){
if($update->message->new_chat_member | $update->message->new_chat_photo | $update->message->new_chat_title | $update->message->left_chat_member | $update->message->pinned_message){
if ($tc == 'group' | $tc == 'supergroup'){
if ( $status != 'creator' && $status != 'administrator' && !in_array($from_id,$dev) ){
 bot('deletemessage',[
    'chat_id'=>$chat_id,
    'message_id'=>$message->message_id
    ]);
 }
}
}
}
// text
if ($settings["lock"]["text"] == "Active ✓"){
if($update->message->text){
if ($tc == 'group' | $tc == 'supergroup'){
if ( $status != 'creator' && $status != 'administrator' && !in_array($from_id,$dev) ){
 bot('deletemessage',[
    'chat_id'=>$chat_id,
    'message_id'=>$message->message_id
    ]);
 }
}
}
}
// video note
if ($settings["lock"]["video_msg"] == "Active ✓"){
if($update->message->video_note){
if ($tc == 'group' | $tc == 'supergroup'){
if ( $status != 'creator' && $status != 'administrator' && !in_array($from_id,$dev) ) {
 bot('deletemessage',[
    'chat_id'=>$chat_id,
    'message_id'=>$message->message_id
    ]);
 }
}
}
}
// restart settings 
if($settings["information"]["step"] == "reset"){
if($textmassage == "بله"){
              bot('sendmessage', [
                'chat_id' => $chat_id,
             'text'=>"• تنظیمات گروه با موفقیت ریست شد !",
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["link"]="Inactive ✗";
$settings["lock"]["photo"]="Inactive ✗";
$settings["lock"]["text"]="Inactive ✗";
$settings["lock"]["tag"]="Inactive ✗";
$settings["lock"]["username"]="Inactive ✗";
$settings["lock"]["sticker"]="Inactive ✗";
$settings["lock"]["video"]="Inactive ✗";
$settings["lock"]["voice"]="Inactive ✗";
$settings["lock"]["audio"]="Inactive ✗";
$settings["lock"]["forward"]="Inactive ✗";
$settings["lock"]["tgservices"]="Inactive ✗";
$settings["lock"]["gif"]="Inactive ✗";
$settings["lock"]["bot"]="Inactive ✗";
$settings["lock"]["document"]="Inactive ✗";
$settings["lock"]["tgservic"]="Inactive ✗";
$settings["lock"]["edit"]="Inactive ✗";
$settings["lock"]["reply"]="Inactive ✗";
$settings["lock"]["contact"]="Inactive ✗";
$settings["lock"]["game"]="Inactive ✗";
$settings["lock"]["cmd"]="Inactive ✗";
$settings["lock"]["mute_all"]="Inactive ✗";
$settings["lock"]["mute_all_time"]="Inactive ✗";
$settings["lock"]["fosh"]="Inactive ✗";
$settings["lock"]["video_msg"]="Inactive ✗";
$settings["lock"]["lockauto"]="Inactive ✗";
$settings["lock"]["lockcharacter"]="Inactive ✗";
$settings["information"]["welcome"]="Inactive ✗";
$settings["information"]["add"]="Inactive ✗";
$settings["information"]["lockchannel"]="Inactive ✗";
$settings["information"]["setadd"]="3";
$settings["information"]["setwarn"]="3";
$settings["information"]["textwelcome"]="خوش امدید";
$settings["information"]["rules"]="ثبت نشده";
$settings["information"]["timelock"]="00:00";
$settings["information"]["timeunlock"]="00:00";
$settings["information"]["pluscharacter"]="300";
$settings["information"]["downcharacter"]="0";
$settings["information"]["step"]="none";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}else{
	bot('sendmessage',[
          'chat_id' => $chat_id,
'text'=>"
• درخواست ریست گروه با موفقیت رد شد !",
]);
$settings["information"]["step"]="none";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
 }
}
// buy charge
if(file_get_contents("data/$from_id.txt") == "true" && $tc == "private"){
		date_default_timezone_set('Asia/Tehran');
		$date1 = date('Y-m-d', time());
		$date2 = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');
		$next_date = date('Y-m-d', strtotime($date2 ." +30 day"));
	bot('sendmessage',[
        "chat_id"=>$chat_id,
        "text"=>"• گروه شما با موفقیت شارژ شد !"
		]);
			bot('sendmessage',[
        "chat_id"=>$textmassage,
        "text"=>"• شارژ با موفقیت برای این گروه خریداری شد !"
		]);
$settings = json_decode(file_get_contents("data/$textmassage.json"),true);
$settings["information"]["expire"]="$next_date";
$settings["information"]["charge"]="30 روز";
$settings = json_encode($settings,true);
file_put_contents("data/$textmassage.json",$settings);
unlink("data/$from_id.txt");
}
 // left group when end charge
date_default_timezone_set('Asia/Tehran');
$date4 = date('Y-m-d', time());
if ($tc == 'group' | $tc == 'supergroup'){ 
if($settings["information"]["expire"] != false){
if($date4 > $settings["information"]["expire"]){
			bot('sendmessage',[
            'chat_id'=>$dev[0],
            'text'=>"

● اشتراک این گروه به اتمام رسید !

•• شناسه گروه : [$chat_id]

•• نام گروه : [$namegroup]",
        ]); 
			 bot('sendmessage',[
            'chat_id'=>$chat_id,
            'text'=>"
● اشتراک این گروه به اتمام رسید !

•• شناسه گروه : [$chat_id]

•• نام گروه : [$namegroup]

جهت خرید اشتراک به مدیر ربات مراجعه کنید.
",
]);
        bot('LeaveChat', [
        'chat_id' =>$chat_id,
    ]);
    }
}
}
// welcome
if ($settings["information"]["welcome"] == "Active ✓"){
if($update->message->new_chat_member){
if ($tc == "group" | $tc == "supergroup"){
$text2 = $settings["information"]["textwelcome"];
$newmemberuser = $update->message->new_chat_member->username;
$text = str_replace("gpname","$namegroup","$text2");
$text1 = str_replace("username","$newmemberuser","$text");
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"$text1",
	]);
}
}
}
// lock character
if($settings["lock"]["lockcharacter"] == "Active ✓"){
if ($status != 'creator' && $status != 'administrator' && !in_array($from_id,$dev)){
$plus = mb_strlen("$textmassage");
$pluscharacter = $settings["information"]["pluscharacter"];
$downcharacter = $settings["information"]["downcharacter"];
if ($pluscharacter < $plus or $plus < $downcharacter) {   
bot('deletemessage',[
    'chat_id'=>$chat_id,
    'message_id'=>$message_id
    ]);
  }
}
}
// autolock 
if ($settings["lock"]["lockauto"] == "Active ✓"){
date_default_timezone_set('Asia/Tehran');
$date1 = date("H:i");
$timelockauto = $settings["information"]["timelock"];
$unlocktime = $settings["information"]["timeunlock"];
if($unlocktime > $date1 && $date1 > $timelockauto){
if ($tc == 'group' | $tc == 'supergroup'){
if ( $status != 'creator' && $status != 'administrator' && !in_array($from_id,$dev) ) {
$timeremmber = $settings["information"]["timeremmber"];
if($date1 < $timeremmber){
 bot('deletemessage',[
    'chat_id'=>$chat_id,
    'message_id'=>$message->message_id
    ]);
}
else
{
	 bot('deletemessage',[
    'chat_id'=>$chat_id,
    'message_id'=>$message->message_id
    ]);

		bot('sendmessage',[
            'chat_id'=>$chat_id,
            'text'=>"
!! هشدار

• قفل گروه در ساعت $timelockauto فعال شده است
 و ساعت $unlocktime غیرفعال خواهد شد !",
'reply_markup'=>$inlinebutton,
   ]);
$next_date = date('H:i', strtotime($date1 ."+180 Minutes"));
$settings["information"]["timeremmber"]="$next_date";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
}
}
}
}
// panel
elseif ($user["userjop"]["$from_id"]["file"] == 'forwarduser') {
$user["userjop"]["$from_id"]["file"]="none";
$numbers = $user["userlist"];
$user = json_encode($user,true);
file_put_contents("data/user.json",$user);	
if ($textmassage != "برگشت »") {
         bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"• پیام شما با موفقیت ارسال شد !",
	  'reply_to_message_id'=>$message_id,
 ]);
for($z = 0;$z <= count($numbers)-1;$z++){
Forward($numbers[$z], $chat_id,$message_id);
}
}
}
elseif ($user["userjop"]["$from_id"]["file"] == 'forwardgroup') {
$user["userjop"]["$from_id"]["file"]="none";
$numbers = $user["grouplist"];
$user = json_encode($user,true);
file_put_contents("data/user.json",$user);	
if ($textmassage != "برگشت »") {
         bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"• پیام با موفقیت ارسال شد !",
	  'reply_to_message_id'=>$message_id,
 ]);
for($z = 0;$z <= count($numbers)-1;$z++){
Forward($numbers[$z], $chat_id,$message_id);
}
}
}
elseif ($user["userjop"]["$from_id"]["file"] == 'sendgroup') {
$user["userjop"]["$from_id"]["file"]="none";
$numbers = $user["grouplist"];
$user = json_encode($user,true);
file_put_contents("data/user.json",$user);	
if ($textmassage != "برگشت »") {
         bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"• پیام با موفقیت ارسال شد !",
	  'reply_to_message_id'=>$message_id,
 ]);
for($z = 0;$z <= count($numbers)-1;$z++){
     bot('sendmessage',[
          'chat_id'=>$numbers[$z],        
		  'text'=>"$textmassage",
        ]);
}
}
}
elseif ($user["userjop"]["$from_id"]["file"] == 'senduser') {
$user["userjop"]["$from_id"]["file"]="none";
$numbers = $user["userlist"];
$user = json_encode($user,true);
file_put_contents("data/user.json",$user);	
if ($textmassage != "برگشت »") {
         bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"• پیام با موفقیت ارسال شد !",
	  'reply_to_message_id'=>$message_id,
 ]);
for($z = 0;$z <= count($numbers)-1;$z++){
     bot('sendmessage',[
          'chat_id'=>$numbers[$z],        
		  'text'=>"$textmassage",
        ]);
}
}
}
if($textmassage=="Panel" or $textmassage=="panel" or $textmassage=="پنل مدیریت" or $textmassage=="عارفم"){
if ($tc == "private") {
if (in_array($from_id,$dev)) {
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"
ادمین عزیز به پنل مدیریت ربات خوش آمدید

لطفا از دکمه های زیر برای مدیریت گروه ها استفاده کنید",
         'reply_to_message_id'=>$message_id,
	  'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"• مدیریت گروه ها"],['text'=>"• آمار ربات"]
	],
 	[
	  	['text'=>"• فوروارد به گروه "],['text'=>"• فوروارد به کاربران"]
	  ],
	  	  	 [
		['text'=>"• ارسال به گروه"],['text'=>"• ارسال به کاربران"]                            
		 ],
		 	  	  	 [
					 ['text'=>"برگشت »"]                            
		 ],
   ],
      'resize_keyboard'=>true
   ])
 ]);
}
}
}
elseif($textmassage=="Panel gp" or $textmassage=="• مدیریت گروه ها" or $textmassage=="panel gp"){
if ($tc == "private") {
if (in_array($from_id,$dev)) {
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"
ادمین عزیز به پنل مدیریت گروه ها خوش آمدید

لطفا از دکمه های زیر برای مدیریت گروه ها استفاده کنید",
         'reply_to_message_id'=>$message_id,
	  'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"• لیست گروه ها"],['text'=>"• خروج ربات از گروه"]
	],
	[
	['text'=>"برگشت »"] 
	]
   ],
      'resize_keyboard'=>true
   ])
 ]);
}
}
}
elseif($textmassage=="• لیست گروه ها" ){
if ($tc == "private") {
if (in_array($from_id,$dev)) {
	bot('senddocument',[
	'chat_id'=>$chat_id,
	'document'=>new CURLFile("data/group.txt"),
	'caption'=>"",
	'reply_to_message_id'=>$message_id,
	]);
}
}
}
elseif($textmassage=="• خروج ربات از گروه" ){
if ($tc == "private") {
if (in_array($from_id,$dev)) {
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"
• ادمین عزیز جهت خروج ربات از گروه موردنظر میتوانید از دستور :

left[ایدی گروه]
یا

ترک[ایدی گروه]

استفاده کنید 

مثال : left -1001073837688",
'reply_to_message_id'=>$message_id,
 ]);
}
}
}
elseif(strpos($textmassage , "ترک" ) !== false or strpos($textmassage , "left" ) !== false) {
$text = str_replace("ترک","",$textmassage);
if ($tc == "private") {
if (in_array($from_id,$dev)) {
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"
• ربات از گروه با شناسه $text خارج شد !
",
  ]);
bot('LeaveChat',[
  'chat_id'=>$text,
  ]);
unlink("data/$text.json");
}
}
}
elseif($textmassage=="• آمار ربات"){
$users = count($user["userlist"]);
$group = count($user["grouplist"]);
				bot('sendmessage',[
		'chat_id'=>$chat_id,
		'text'=>"
•• آمار ربات شما :

• تعداد گروه های ربات : $group

• تعداد کاربران ربات : $users
",
                'hide_keyboard'=>true,
		]);
		}
elseif ($textmassage == '• ارسال به کاربران' && in_array($from_id,$dev)) {
         bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"• لطفا متن خود را ارسال کنید !",
	  'reply_to_message_id'=>$message_id,
	   'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"برگشت »"] 
	]
   ],
      'resize_keyboard'=>true
   ])
 ]);
$user["userjop"]["$from_id"]["file"]="senduser";
$user = json_encode($user,true);
file_put_contents("data/user.json",$user);
}
elseif ($textmassage == '• ارسال به گروه' && in_array($from_id,$dev)) {
         bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"• لطفا متن خود را ارسال کنید !",
	  'reply_to_message_id'=>$message_id,
	   'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"برگشت »"] 
	]
   ],
      'resize_keyboard'=>true
   ])
 ]);
$user["userjop"]["$from_id"]["file"]="sendgroup";
$user = json_encode($user,true);
file_put_contents("data/user.json",$user);
}
elseif ($textmassage == '• فوروارد به گروه' && in_array($from_id,$dev)) {
         bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"• لطفا متن خود را ارسال کنید !",
	  'reply_to_message_id'=>$message_id,
	   'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"برگشت »"] 
	]
   ],
      'resize_keyboard'=>true
   ])
 ]);
$user["userjop"]["$from_id"]["file"]="forwardgroup";
$user = json_encode($user,true);
file_put_contents("data/user.json",$user);
}
elseif ($textmassage == '• فوروارد به کاربران' && in_array($from_id,$dev)) {
         bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"• لطفا متن خود را فوروارد کنید !",
				  'reply_to_message_id'=>$message_id,
				   'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"برگشت »"] 
	]
   ],
      'resize_keyboard'=>true
   ])
    		]);
$user["userjop"]["$from_id"]["file"]="forwarduser";
$user = json_encode($user,true);
file_put_contents("data/user.json",$user);
}
//-----------------------------------------------------------------------------------------
// save id
if ($tc == 'private'){  
@$user = json_decode(file_get_contents("data/user.json"),true);
if(!in_array($from_id, $user["userlist"])) {
$user["userlist"][]="$from_id";
$user = json_encode($user,true);
file_put_contents("data/user.json",$user);
    }
}
elseif ($tc == 'group' | $tc == 'supergroup'){  
@$user = json_decode(file_get_contents("data/user.json"),true);
if(!in_array($chat_id, $user["grouplist"])) {
$user["grouplist"][]="$chat_id";
$user = json_encode($user,true);
file_put_contents("data/user.json",$user);
    }
}
 // settings inline
 /////  editor and debugger: @Shita   /////
	 elseif($data=="other" ){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
$locklink = $settings2["lock"]["link"];
$lockusername = $settings2["lock"]["username"];
$locktag = $settings2["lock"]["tag"];
$lockedit = $settings2["lock"]["edit"];
$lockfosh = $settings2["lock"]["fosh"];
$lockbots = $settings2["lock"]["bot"];
$lockforward = $settings2["lock"]["forward"];
$locktg = $settings2["lock"]["tgservic"];
$lockreply = $settings2["lock"]["reply"];
$lockcmd = $settings2["lock"]["cmd"];
$lockdocument = $settings2["lock"]["document"];
$lockgif = $settings2["lock"]["gif"];
$lockvideo_note = $settings2["lock"]["video_msg"];
$locklocation = $settings2["lock"]["location"];
$lockphoto = $settings2["lock"]["photo"];
$lockcontact = $settings2["lock"]["contact"];
$lockaudio = $settings2["lock"]["audio"];
$lockvoice = $settings2["lock"]["voice"];
$locksticker = $settings2["lock"]["sticker"];
$lockgame = $settings2["lock"]["game"];
$lockvideo = $settings2["lock"]["video"];
$locktext = $settings2["lock"]["text"];
$mute_all = $settings2["lock"]["mute_all"];
         bot('editmessagetext',[
             'chat_id'=>$chatid,
  'message_id'=>$messageid,
  'text'=>"
•• تنظیمات مدیریت :

• نام گروه : [$gpname]
• شناسه گروه : [$chatid]
",
	'reply_markup'=>json_encode([
	'resize_keyboard'=>true,
	'inline_keyboard'=>[
 [
 ['text'=>"• قفل کاراکتر",'callback_data'=>'character'],['text'=>"• قفل خودکار",'callback_data'=>'lockauto'],['text'=>"• حساسیت اخطار",'callback_data'=>'warn']
 ],
 [
 ['text'=>"• خوش آمد گویی",'callback_data'=>'welcome'],['text'=>"قفل همه : $mute_all ",'callback_data'=>'lockall'],['text'=>"• حالت سختگیرانه",'callback_data'=>'hardmode']
 ],
 [
 ['text'=>"• لينک : $locklink",'callback_data'=>'locklink'],['text'=>"• فایل  : $lockdocument",'callback_data'=>'lockdocument']
 ],
 [
 ['text'=>"• هشتگ : $locktag",'callback_data'=>'locktag'],['text'=>"• گیف : $lockgif",'callback_data'=>'lockgif']
 ],
 [
 ['text'=>"• تگ : $lockusername",'callback_data'=>'lockusername'],['text'=>"• فیلم سلفی : $lockvideo_note",'callback_data'=>'lockvideo_note']
 ],
 [
 ['text'=>"• ویرایش : $lockedit",'callback_data'=>'lockedit'],['text'=>"• موقعیت مکانی : $locklocation",'callback_data'=>'lockluction']
 ],
 [
 ['text'=>"• فحش : $lockfosh",'callback_data'=>'lockfosh'],['text'=>"• عکس : $lockphoto",'callback_data'=>'lockphoto']
 ],
 [
 ['text'=>"• ورود ربات : $lockbots",'callback_data'=>'lockbots2'],['text'=>"• مخاطب : $lockcontact",'callback_data'=>'lockcontact']
 ],
 [
 ['text'=>"• فوروارد : $lockforward",'callback_data'=>'lockforward'],['text'=>"• موزیک : $lockaudio",'callback_data'=>'lockaudio']
 ],
 [
 ['text'=>"• سرویس تلگرام : $locktg",'callback_data'=>'locktg'],['text'=>"• ویس : $lockvoice",'callback_data'=>'lockvoice']
 ],
 [
 ['text'=>"• ریپلی : $lockreply",'callback_data'=>'lockreply'],['text'=>"• استیکر : $locksticker",'callback_data'=>'locksticker']
 ],
 [
 ['text'=>"• دستورات عمومی : $lockcmd",'callback_data'=>'lockcmd'],
 ],
 [
 ['text'=>"• بازی : $lockgame",'callback_data'=>'lockgame']
 ],
 [
 ['text'=>"• فیلم : $lockvideo",'callback_data'=>'lockvideo']
 ],
 [
 ['text'=>"• متن : $locktext",'callback_data'=>'locktext']
 ],
 [
 ['text'=>"« برگشت",'callback_data'=>'settings']
 ],
	]
	])
	]);
	}else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
	}
	 }
elseif($data=="settings" ){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
			 $mute_all = $settings2["lock"]["mute_all"];
         bot('editmessagetext',[
             'chat_id'=>$chatid,
  'message_id'=>$messageid,
  'text'=>" به بخش تنظیمات و مدیریت خوش آمدید :",
	'reply_markup'=>json_encode([
	'resize_keyboard'=>true,
	'inline_keyboard'=>[
 [
 ['text'=>"• اطلاعات گروه",'callback_data'=>'groupe'],['text'=>"• راهنما",'callback_data'=>'helppanel']
 ],
 [
 ['text'=>"برگشت »",'callback_data'=>'back']
 ],
 [
 ['text'=>"بستن فهرست",'callback_data'=>'exit']
 ],
	]
	])
	]);
	}else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
	}
}
  elseif($data=="back"){
			 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
          bot('editmessagetext',[
              'chat_id'=>$chatid,
   'message_id'=>$messageid,
   'text'=>"به فهرست مدیریتی گروه خوش آمدید",
  
    'reply_markup'=>json_encode([
    'resize_keyboard'=>true,
    'inline_keyboard'=>[
   [
   ['text'=>"• مدیریت قفل ها",'callback_data'=>'other']
   ],
   [
   ['text'=>"کانال ما",'url'=>"https://telegram.me/$channel"],['text'=>"• تنظیمات دیگر",'callback_data'=>'settings']
   ],
   [
   ['text'=>"بستن فهرست",'callback_data'=>'exit']
   ],
   ]
  	])
  	]);
	}else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
  	}
  }
if($textmassage=="Panel" or $textmassage=="panel" or $textmassage=="پنل" or $textmassage=="/panel@$usernamebot"){
	if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev)){
	if ($tc == 'group' | $tc == 'supergroup'){  
	$add = $settings["information"]["added"];
if ($add == true) {
  	bot('sendmessage',[
  	'chat_id'=>$chat_id,
  	'text'=>"
• مدیر گرامی ؛ به پنل تنظیمات مدیریتی ربات خوش آمدید ",
    'reply_to_message_id'=>$message_id,
  	'reply_markup'=>json_encode([
  	'resize_keyboard'=>true,
  	'inline_keyboard'=>[
   [
   ['text'=>"• مدیریت قفل ها",'callback_data'=>'other']
   ],
   [
   ['text'=>"کانال ما",'url'=>"https://telegram.me/$channel"],['text'=>"• تنظیمات دیگر",'callback_data'=>'settings']
   ],
   [
   ['text'=>"بستن فهرست",'callback_data'=>'exit']
   ],
   ]
  	])
  	]);
  	}
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• ربات در گروه نصب نشده است !",
  'reply_to_message_id'=>$message_id,
 ]);
    }	
  }
	}
}
	elseif($data=="exit" ){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
            bot('deletemessage',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
           ]);
		   }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
    }
	}
elseif($data=="groupe"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
$url = file_get_contents("https://api.telegram.org/bot$token/getChatMembersCount?chat_id=$chatid");
$getchat = json_decode($url, true);
$howmember = $getchat["result"];
            bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"
•• به بخش اطلاعات گروه خوش آمدید

• نام گروه : [$gpname]
• شناسه گروه : [$chatid]
• تعداد پیام ها : [$messageid]
• تعداد کل عضو های گروه : [$howmember]",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
				   ['text'=>"• لینک گروه",'callback_data'=>"link"],['text'=>"• قوانین گروه",'callback_data'=>'rules']
				   ],
				   [
				   ['text'=>"• لیست مدیران",'callback_data'=>'adminlist'],['text'=>"• لیست بی صدا",'callback_data'=>'silentlist']
				   ],
				   [
				   ['text'=>"• لیست فیلتر",'callback_data'=>'filterword']
				   ],
				   [
				   ['text'=>"برگشت »",'callback_data'=>'back']
				   ],
                   ]
               ])
           ]);
$settings2["information"]["step"]="none";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		   }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
    }
}
	elseif($data=="adminlist"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
  $up = json_decode(file_get_contents("https://api.telegram.org/bot$token/getChatAdministrators?chat_id=".$chatid),true);
  $result = $up['result'];
$msg = "";
  foreach($result as $key=>$value){
    $found = $result[$key]['status'];
    if($found == "creator"){
      $owner = $result[$key]['user']['id'];
	  $owner2 = $result[$key]['user']['username'];
    }
if($found == "administrator"){
if($result[$key]['user']['first_name'] == true){
$innames = str_replace(['[',']'],'',$result[$key]['user']['first_name']);
$msg = $msg."\n"."●"."[{$innames}]{$result[$key]['user']['id']})";
}
  }
		 }
            bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"
صاحب گروه : 
@$owner2

لیست مدیران گروه :
$msg",
'parse_mode'=>"HTML",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
					 [
					 ['text'=>"برگشت »",'callback_data'=>'groupe']
					 ],
                     ]
               ])
           ]);
		   }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
    }
	}
	elseif($data=="yessup"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
$getlink = file_get_contents("https://api.telegram.org/bot$token/exportChatInviteLink?chat_id=$chatid");
$jsonlink = json_decode($getlink, true);
$getlinkde = $jsonlink['result'];
            bot('sendmessage', [
                'chat_id' =>$dev[0],
                'text' => "
● گروه ( $gpname ) درخواست پشتیبانی کرده است !

•• مشخصات درخواست دهنده :

• شناسه فرد :  $fromid 
• نام :  $firstname 
• نام کاربری :  @$usernames 

•• مشخصات گروه :

• شناسه گروه :  $chatid 
• لینک گروه :  $getlinkde
 ",
            ]);
            bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"
درخواست پشتیبانی شما با موفقیت ثبت شد ! درخواست شما بزودی توسط مدیر ربات بررسی خواهد شد.",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
					 [
					 ['text'=>"برگشت »",'callback_data'=>'back']
					 ],
                     ]
               ])
           ]);
		   }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
    }
	}
	elseif($data=="filterword"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
$filter = $settings2["filterlist"];
for($z = 0;$z <= count($filter)-1;$z++){
$result = $result.$filter[$z]."\n";
}
            bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"
• لیست کلمات فیلتر گروه :

$result",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
				   ['text'=>"• پاکسازی لیست فیلتر",'callback_data'=>'cleanfilterlist']
				   ],
					 [
					 ['text'=>"برگشت »",'callback_data'=>'groupe']
					 ],
                     ]
               ])
           ]);
		   }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
    }
	}
		elseif($data=="cleanfilterlist"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
            bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"
• لیست کلمات فیلتر شده پاکسازی شد !",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
					 [
					 ['text'=>"برگشت »",'callback_data'=>'groupe']
					 ],
                     ]
               ])
           ]);
unset($settings2["filterlist"]);
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		   }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
    }
	}
	elseif($data=="link"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
		$getlink = file_get_contents("https://api.telegram.org/bot$token/exportChatInviteLink?chat_id=$chatid");
$jsonlink = json_decode($getlink, true);
$getlinkde = $jsonlink['result'];
            bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"
• لینک گروه :
$getlinkde ",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
					 [
					 ['text'=>"برگشت »",'callback_data'=>'groupe']
					 ],
                     ]
               ])
           ]);
		   }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
    }
	}
		elseif($data=="rules"){
$text = $settings2["information"]["rules"];
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
            bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"
• قوانین گروه :
$text",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   		   				   [
				   ['text'=>"• تنظیم قوانین",'callback_data'=>'setrules']
				   ],
					 [
					 ['text'=>"برگشت »",'callback_data'=>'groupe']
					 ],
                     ]
               ])
           ]);

		   }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
    }
		}
				elseif($data=="setrules"){
$text = $settings2["information"]["rules"];
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
            bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"
• قوانین گروه خود را ارسال کنید !",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
					 [
					 ['text'=>"برگشت »",'callback_data'=>'groupe']
					 ],
                     ]
               ])
           ]);
$settings2["information"]["step"]="setrules";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		   }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
    }
		}
		elseif($data=="silentlist" ){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
$silent = $settings2["silentlist"];
for($z = 0;$z <= count($silent)-1;$z++){
$result = $result.$silent[$z]."\n";
}
            bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"
• لیست افراد بی صدا :

$result ",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   				   [
				   ['text'=>"• پاکسازی لیست بی صدا",'callback_data'=>'cleansilentlist']
				   ],
					 [
					 ['text'=>"برگشت »",'callback_data'=>'groupe']
					 ],
                     ]
               ])
           ]);
		   }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
    }
		}
				elseif($data=="cleansilentlist"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
$silent = $settings2["silentlist"];
for($z = 0;$z <= count($silent)-1;$z++){
 bot('restrictChatMember',[
   'user_id'=>$silent[$z],   
   'chat_id'=>$chatid,
   'can_post_messages'=>true,
   'can_add_web_page_previews'=>false,
   'can_send_other_messages'=>true,
   'can_send_media_messages'=>true,
         ]);
}
            bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"
• لیست افراد بی صدا پاکسازی شد !",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
					 [
					 ['text'=>"برگشت »",'callback_data'=>'groupe']
					 ],
                     ]
               ])
           ]);
unset($settings2["silentlist"]);
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		   }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
    }
	}
//=======================================================================================
									    elseif($data=="restart"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
            bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"
• توجه داشته باشید که تمامی تنظیمات گروه به حالت اولیه باز خواهد گشت

آیا از بازنشانی تنظیمات گروه اطمینان دارید ؟️",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[

					 [
					 ['text'=>"بله, اطمینان دارم",'callback_data'=>'yes']
					 ],
					 [
					 ['text'=>"برگشت »",'callback_data'=>'panel3']
					 ],
                     ]
               ])
           ]);
		   }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
    }
				}
													    elseif($data=="yes"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
$settings2["lock"]["link"]="Inactive ✗";
$settings2["lock"]["photo"]="Inactive ✗";
$settings2["lock"]["text"]="Inactive ✗";
$settings2["lock"]["tag"]="Inactive ✗";
$settings2["lock"]["username"]="Inactive ✗";
$settings2["lock"]["sticker"]="Inactive ✗";
$settings2["lock"]["video"]="Inactive ✗";
$settings2["lock"]["voice"]="Inactive ✗";
$settings2["lock"]["audio"]="Inactive ✗";
$settings2["lock"]["forward"]="Inactive ✗";
$settings2["lock"]["tgservices"]="Inactive ✗";
$settings2["lock"]["gif"]="Inactive ✗";
$settings2["lock"]["bot"]="Inactive ✗";
$settings2["lock"]["document"]="Inactive ✗";
$settings2["lock"]["tgservic"]="Inactive ✗";
$settings2["lock"]["edit"]="Inactive ✗";
$settings2["lock"]["reply"]="Inactive ✗";
$settings2["lock"]["contact"]="Inactive ✗";
$settings2["lock"]["game"]="Inactive ✗";
$settings2["lock"]["cmd"]="Inactive ✗";
$settings2["lock"]["mute_all"]="Inactive ✗";
$settings2["lock"]["mute_all_time"]="Inactive ✗";
$settings2["lock"]["fosh"]="Inactive ✗";
$settings2["lock"]["lockauto"]="Inactive ✗";
$settings2["lock"]["lockcharacter"]="Inactive ✗";
$settings2["lock"]["video_msg"]="Inactive ✗";
$settings2["information"]["welcome"]="Inactive ✗";
$settings2["information"]["add"]="Inactive ✗";
$settings2["information"]["lockchannel"]="Inactive ✗";
$settings2["information"]["setadd"]="3";
$settings2["information"]["setwarn"]="3";
$settings2["information"]["textwelcome"]="خوش آمدید";
$settings2["information"]["rules"]="ثبت نشده";
$settings2["information"]["timelock"]="00:00";
$settings2["information"]["timeunlock"]="00:00";
$settings2["information"]["pluscharacter"]="300";
$settings2["information"]["downcharacter"]="0";
$settings2["information"]["step"]="none";
$settings = json_encode($settings,true);
            bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"• تنظیمات گروه با موفقیت ریست شد !",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
					 [
					 ['text'=>"برگشت »",'callback_data'=>'panel3']
					 ],
                     ]
               ])
           ]);
		   }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
    }
				}
			    elseif($data=="welcome"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
$welcome = $settings2["information"]["welcome"];
            bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"
به بخش خوش آمد گویی خوش آمدید.

لطفا بخش مورد نظر خود را انتخاب کنید !",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
                     [
                     ['text'=>"• خوش آمد گویی : $welcome",'callback_data'=>'pwelcome']
					 ],
					 [
					 ['text'=>"• متن خوش آمد",'callback_data'=>'textwelcome']
					 ],
					 [
					 ['text'=>"برگشت »",'callback_data'=>'other']
					 ],
                     ]
               ])
           ]);
		   }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
    }
				}
				    elseif($data=="textwelcome"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
$textwelcome = $settings2["information"]["textwelcome"];
            bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"
• متن خوش آمد گویی گروه :
$textwelcome",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
					 [
					 ['text'=>"برگشت »",'callback_data'=>'welcome']
					 ],
                     ]
               ])
           ]);
		   }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
    }
					}
					    elseif($data=="pwelcome" && $settings2["information"]["welcome"] =="Active ✓"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
            bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"
به بخش خوش آمد گویی خوش آمدید.

خوش آمد گویی گروه خاموش شد !",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				     [
                     ['text'=>"• خوش آمد : غیرفعال",'callback_data'=>'pwelcome']
					 ],
					 [
					 ['text'=>"• متن خوش آمد",'callback_data'=>'textwelcome']
					 ],
					 [
					 ['text'=>"برگشت »",'callback_data'=>'other']
					 ],
                     ]
               ])
           ]);
$settings2["information"]["welcome"]="Inactive ✗";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		   }
		  else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
    }
						}
						    elseif($data=="pwelcome" && $settings2["information"]["welcome"] == "Inactive ✗"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
            bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"
به بخش خوش آمد گویی خوش آمدید.

خوش آمد گویی گروه روشن شد !",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				     [
                     ['text'=>"• خوش آمد : فعال",'callback_data'=>'pwelcome']
					 ],
					 [
					 ['text'=>"• متن خوش آمد",'callback_data'=>'textwelcome']
					 ],
					 [
					 ['text'=>"برگشت »",'callback_data'=>'other']
					 ],
                     ]
               ])
           ]);
$settings2["information"]["welcome"]="Active ✓";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		   }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
    }
							}
		  elseif($data=="lockall" && $settings2["lock"]["mute_all"] =="Active ✓"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
         bot('editmessagetext',[
             'chat_id'=>$chatid,
  'message_id'=>$messageid,
  'text'=>"
نام گروه : [$gpname]
شناسه گروه : [$chatid]

قفل گروه با موفقیت غیرفعال شد !",
	'reply_markup'=>json_encode([
	'resize_keyboard'=>true,
	'inline_keyboard'=>[
 [
 ['text'=>"• تنظیمات گروه",'callback_data'=>'other'],['text'=>"• قفل کانال و اد اجباری",'callback_data'=>'panel3']
 ],
 [
 ['text'=>"• اطلاعات گروه",'callback_data'=>'groupe'],['text'=>"• راهنما",'callback_data'=>'helppanel']
 ],
 [
 ['text'=>"بستن فهرست",'callback_data'=>'exit']
 ],
 [
 ['text'=>"برگشت »",'callback_data'=>'back']
 ],
	]
	])
	]);
$settings2["lock"]["mute_all"]="Inactive ✗";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
	}else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
	}
		  }
			  elseif($data=="lockall" && $settings2["lock"]["mute_all"] =="Inactive ✗"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
         bot('editmessagetext',[
             'chat_id'=>$chatid,
  'message_id'=>$messageid,
  'text'=>"
•• به بخش اول پنل مدیریت گروه خوش آمدید.
  
• نام گروه : [$gpname]
• شناسه گروه : [$chatid]

• قفل گروه با موفقیت فعال شد !",
	'reply_markup'=>json_encode([
	'resize_keyboard'=>true,
	'inline_keyboard'=>[
 [
 ['text'=>"• تنظیمات گروه",'callback_data'=>'other'],['text'=>"• قفل کانال و اد اجباری",'callback_data'=>'panel3']
 ],
 [
 ['text'=>"• اطلاعات گروه",'callback_data'=>'groupe'],['text'=>"• راهنما",'callback_data'=>'helppanel']
 ],
 [
 ['text'=>"بستن فهرست",'callback_data'=>'exit']
 ],
 [
 ['text'=>"برگشت »",'callback_data'=>'back']
 ],
	]
	])
	]);
$settings2["lock"]["mute_all"]="Active ✓";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
	}else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
	}
			  }
			elseif($data=="panel3"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
            bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"
به بخش اد اجباری و قفل کانال خوش آمدید",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
                    
					 [
					 ['text'=>"• اد اجباری",'callback_data'=>'addbzn'],['text'=>"• قفل کانال",'callback_data'=>'lockchannel']
					 ],
					 [
					 ['text'=>"• بازنشانی تنظیمات",'callback_data'=>'restart']
					 ],
					 [
					 ['text'=>"« برگشت",'callback_data'=>'other']
					 ],
                     ]
               ])
           ]);
		   }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
    }
		}
			      elseif($data=="warn"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
$setwarn = $settings2["information"]["setwarn"];
            bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"
•• به بخش اخطار خوش آمدید.

در این بخش میتوانید مقدار اخطار را تنظیم کنید

مقدار انتخابی باید بین 1 تا 20 باشد !",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
					 [
					 ['text'=>"میزان اخطار",'callback_data'=>'text']
					 ],
					 [
					 ['text'=>"《",'callback_data'=>'warn-'],['text'=>"$setwarn",'callback_data'=>'text'],['text'=>"》",'callback_data'=>'warn+']
					 ],
					 [
					 ['text'=>"برگشت »",'callback_data'=>'panel2']
					 ],
                     ]
               ])
           ]);
		   }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
    }
	}
	elseif($data=="warn+"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
$setwarn = $settings2["information"]["setwarn"];
    $manfi = $setwarn + 1;
    if ($manfi <= 20 && $manfi >= 1){
          bot('editmessagetext',[
              'chat_id'=>$chatid,
   'message_id'=>$messageid,
             'text'=>"
• مقدار اخطار افزایش یافت !",
             'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
					 [
					 ['text'=>"میزان اخطار",'callback_data'=>'text']
					 ],
					 [
					 ['text'=>"《",'callback_data'=>'warn-'],['text'=>"$manfi",'callback_data'=>'text'],['text'=>"》",'callback_data'=>'warn+']
					 ],
					 [
					 ['text'=>"برگشت »",'callback_data'=>'panel2']
					 ],
                     ]
               ])
	]);
$settings2["information"]["setwarn"]="$manfi";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
	}else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
	}
		  }
						}
								  		  		elseif($data=="warn-"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
$setwarn = $settings2["information"]["setwarn"];
    $manfi = $setwarn - 1;
    if ($manfi <= 20 && $manfi >= 1){
          bot('editmessagetext',[
              'chat_id'=>$chatid,
   'message_id'=>$messageid,
             'text'=>"
به بخش اخطار خوش آمدید.

• مقدار اخطار کاهش یافت !",
             'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
					 [
					 ['text'=>"میزان اخطار",'callback_data'=>'text']
					 ],
					 [
					 ['text'=>"《",'callback_data'=>'warn-'],['text'=>"$manfi",'callback_data'=>'text'],['text'=>"》",'callback_data'=>'warn+']
					 ],
					 [
					 ['text'=>"برگشت »",'callback_data'=>'panel2']
					 ],
                     ]
               ])
	]);
$settings2["information"]["setwarn"]="$manfi";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
	}else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
	}
		  }
						}
											    elseif($data=="hardmode"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
$hardmodebot = $settings2["information"]["hardmodebot"];
$hardmodewarn = $settings2["information"]["hardmodewarn"];
            bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"
به بخش حالت سختگیرانه خوش آمدید.

از دکمه های زیر استفاده کنید",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
                     [
                     ['text'=>"افزودن ربات : $hardmodebot",'callback_data'=>'hardmodebot']
					 ],
					            [
                     ['text'=>"حداکثر اخطار : $hardmodewarn",'callback_data'=>'hardmodewarn']
					 ],
					 [
					 ['text'=>"برگشت »",'callback_data'=>'panel2']
					 ],
                     ]
               ])
           ]);
		   }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
    }
				}
						  elseif($data=="hardmodebot" && $settings2["information"]["hardmodebot"] == "اخراج کاربر"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
$hardmodewarn = $settings2["information"]["hardmodewarn"];
                    bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"
به بخش حالت سخت گیرانه خوش آمدید.

حالت سخت گیرانه اضافه کردن ربات غیرفعال شد !",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
                     [
                     ['text'=>"افزودن ربات : غیر فعال",'callback_data'=>'hardmodebot']
					 ],
					            [
                     ['text'=>"حداکثر اخطار : $hardmodewarn",'callback_data'=>'hardmodewarn']
					 ],
					 [
					 ['text'=>"برگشت »",'callback_data'=>'panel2']
					 ],
                     ]
               ])
           ]);
$settings2["information"]["hardmodebot"]="Inactive ✗";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
	}else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
	}
		  }
		  						  elseif($data=="hardmodebot" && $settings2["information"]["hardmodebot"] == "Inactive ✗"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
$hardmodewarn = $settings2["information"]["hardmodewarn"];
                    bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"
به بخش حالت سخت گیرانه خوش آمدید.

حالت سخت گیرانه اضافه کردن ربات فعال شد !",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
                     [
                     ['text'=>"افزودن ربات : فعال",'callback_data'=>'hardmodebot']
					 ],
					            [
                     ['text'=>"حداکثر اخطار : $hardmodewarn",'callback_data'=>'hardmodewarn']
					 ],
					 [
					 ['text'=>"برگشت »",'callback_data'=>'panel2']
					 ],
                     ]
               ])
           ]);
$settings2["information"]["hardmodebot"]="اخراج کاربر";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
	}else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
	}
		  }
		  						  elseif($data=="hardmodewarn" && $settings2["information"]["hardmodewarn"] == "اخراج کاربر"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
$hardmodebot = $settings2["information"]["hardmodebot"];
                    bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"
به بخش حالت سخت گیرانه خوش آمدید.

وضعیت اخطار به حالت سکوت تنظیم شد !",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
                     [
                     ['text'=>"افزودن ربات : $hardmodebot",'callback_data'=>'hardmodebot']
					 ],
					            [
                     ['text'=>"حداکثر اخطار : سکوت کاربر",'callback_data'=>'hardmodewarn']
					 ],
					 [
					 ['text'=>"برگشت »",'callback_data'=>'panel2']
					 ],
                     ]
               ])
           ]);
$settings2["information"]["hardmodewarn"]="سکوت کاربر️";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
	}else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
	}
		  }
		  						  elseif($data=="hardmodewarn" && $settings2["information"]["hardmodewarn"] == "سکوت کاربر"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
$hardmodebot = $settings2["information"]["hardmodebot"];
                    bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"
به بخش حالت سختگیرانه خوش آمدید.

وضعیت اخطار به حالت اخراج کاربر تنظیم شد !",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
                     [
                     ['text'=>"افزودن ربات : $hardmodebot",'callback_data'=>'hardmodebot']
					 ],
					            [
                     ['text'=>"حداکثر اخطار : اخراج کاربر",'callback_data'=>'hardmodewarn']
					 ],
					 [
					 ['text'=>"برگشت »",'callback_data'=>'panel2']
					 ],
                     ]
               ])
           ]);
$settings2["information"]["hardmodewarn"]="اخراج کاربر";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
	}else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
	}
		  }
		  
 if($data=="lockphoto" && $settings2["lock"]["photo"] == "Active ✓"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
$locklink = $settings2["lock"]["link"];
$lockusername = $settings2["lock"]["username"];
$locktag = $settings2["lock"]["tag"];
$lockedit = $settings2["lock"]["edit"];
$lockfosh = $settings2["lock"]["fosh"];
$lockbots = $settings2["lock"]["bot"];
$lockforward = $settings2["lock"]["forward"];
$locktg = $settings2["lock"]["tgservic"];
$lockreply = $settings2["lock"]["reply"];
$lockcmd = $settings2["lock"]["cmd"];
$lockdocument = $settings2["lock"]["document"];
$lockgif = $settings2["lock"]["gif"];
$lockvideo_note = $settings2["lock"]["video_msg"];
$locklocation = $settings2["lock"]["location"];
$lockphoto = $settings2["lock"]["photo"];
$lockcontact = $settings2["lock"]["contact"];
$lockaudio = $settings2["lock"]["audio"];
$lockvoice = $settings2["lock"]["voice"];
$locksticker = $settings2["lock"]["sticker"];
$lockgame = $settings2["lock"]["game"];
$lockvideo = $settings2["lock"]["video"];
$locktext = $settings2["lock"]["text"];
$mute_all = $settings2["lock"]["mute_all"];
          bot('editmessagetext',[
              'chat_id'=>$chatid,
   'message_id'=>$messageid,
             'text'=>"
•• پنل تنظیمات قفلی ربات

• نام گروه | $gpname
• شناسه گروه | $chatid

● قفل عکس با موفقیت غیرفعال شد !
",
             'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
[
 ['text'=>"• قفل کاراکتر",'callback_data'=>'character'],['text'=>"• قفل خودکار",'callback_data'=>'lockauto'],['text'=>"• حساسیت اخطار",'callback_data'=>'warn']
 ],
 [
 ['text'=>"• خوش آمد گویی",'callback_data'=>'welcome'],['text'=>"• قفل همه : $mute_all ",'callback_data'=>'lockall'],['text'=>"• حالت سختگیرانه",'callback_data'=>'hardmode']
 ],
 [
 ['text'=>"• لينک : $locklink",'callback_data'=>'locklink'],['text'=>"• فایل : $lockdocument",'callback_data'=>'lockdocument']
 ],
 [
 ['text'=>"• هشتگ : $locktag",'callback_data'=>'locktag'],['text'=>"• گیف : $lockgif",'callback_data'=>'lockgif']
 ],
 [
 ['text'=>"• تگ : $lockusername",'callback_data'=>'lockusername'],['text'=>"• فیلم سلفی : $lockvideo_note",'callback_data'=>'lockvideo_note']
 ],
 [
 ['text'=>"• ویرایش پیام : $lockedit",'callback_data'=>'lockedit'],['text'=>"• موقعیت مکانی : $locklocation",'callback_data'=>'lockluction']
 ],
 [
 ['text'=>"• فحش : $lockfosh",'callback_data'=>'lockfosh'],['text'=>"• عکس : $lockphoto",'callback_data'=>'lockphoto']
 ],
 [
 ['text'=>"• ورود ربات : $lockbots",'callback_data'=>'lockbots2'],['text'=>"• مخاطب : $lockcontact",'callback_data'=>'lockcontact']
 ],
 [
 ['text'=>"فوروارد : $lockforward",'callback_data'=>'lockforward'],['text'=>"• موزیک : $lockaudio",'callback_data'=>'lockaudio']
 ],
 [
 ['text'=>"• سرویس تلگرام : $locktg",'callback_data'=>'locktg'],['text'=>"• ویس : $lockvoice",'callback_data'=>'lockvoice']
 ],
 [
 ['text'=>"• ریپلی : $lockreply",'callback_data'=>'lockreply'],['text'=>"• استیکر : $locksticker",'callback_data'=>'locksticker']
 ],
 [
 ['text'=>"• دستورات عمومی : $lockcmd",'callback_data'=>'lockcmd'],
 ],
 [
 ['text'=>"• بازی : $lockgame",'callback_data'=>'lockgame']
 ],
 [
 ['text'=>"• فیلم : $lockvideo",'callback_data'=>'lockvideo']
 ],
 [
 ['text'=>"• متن : $locktext",'callback_data'=>'locktext']
 ],
 [
 ['text'=>"« برگشت",'callback_data'=>'settings']
 ],
                    ]
             ])
         ]);
$settings2["lock"]["photo"]="Inactive ✗";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		 }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
  }
  }
  elseif($data=="lockphoto" && $settings2["lock"]["photo"] == "Inactive ✗"){
			 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
$locklink = $settings2["lock"]["link"];
$lockusername = $settings2["lock"]["username"];
$locktag = $settings2["lock"]["tag"];
$lockedit = $settings2["lock"]["edit"];
$lockfosh = $settings2["lock"]["fosh"];
$lockbots = $settings2["lock"]["bot"];
$lockforward = $settings2["lock"]["forward"];
$locktg = $settings2["lock"]["tgservic"];
$lockreply = $settings2["lock"]["reply"];
$lockcmd = $settings2["lock"]["cmd"];
$lockdocument = $settings2["lock"]["document"];
$lockgif = $settings2["lock"]["gif"];
$lockvideo_note = $settings2["lock"]["video_msg"];
$locklocation = $settings2["lock"]["location"];
$lockphoto = $settings2["lock"]["photo"];
$lockcontact = $settings2["lock"]["contact"];
$lockaudio = $settings2["lock"]["audio"];
$lockvoice = $settings2["lock"]["voice"];
$locksticker = $settings2["lock"]["sticker"];
$lockgame = $settings2["lock"]["game"];
$lockvideo = $settings2["lock"]["video"];
$locktext = $settings2["lock"]["text"];
$mute_all = $settings2["lock"]["mute_all"];
          bot('editmessagetext',[
              'chat_id'=>$chatid,
   'message_id'=>$messageid,
             'text'=>"
•• پنل تنظیمات قفلی ربات

• نام گروه | $gpname
• شناسه گروه | $chatid

● قفل عکس با موفقیت فعال شد !
",
             'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
[
 ['text'=>"قفل کاراکتر",'callback_data'=>'character'],['text'=>"قفل خودکار",'callback_data'=>'lockauto'],['text'=>"حساسیت اخطار",'callback_data'=>'warn']
 ],
 [
 ['text'=>" بخش خوشامد گویی",'callback_data'=>'welcome'],['text'=>"قفل همه : $mute_all ",'callback_data'=>'lockall'],['text'=>"حالت سختگیرانه",'callback_data'=>'hardmode']
 ],
 [
 ['text'=>"لينک : $locklink",'callback_data'=>'locklink'],['text'=>" فایل  : $lockdocument",'callback_data'=>'lockdocument']
 ],
 [
 ['text'=>"هشتگ [#] : $locktag",'callback_data'=>'locktag'],['text'=>" گیف: $lockgif",'callback_data'=>'lockgif']
 ],
 [
 ['text'=>"یوزرنیم [@] : $lockusername",'callback_data'=>'lockusername'],['text'=>" پیام ویدیویی  : $lockvideo_note",'callback_data'=>'lockvideo_note']
 ],
 [
 ['text'=>"ویرایش پیام : $lockedit",'callback_data'=>'lockedit'],['text'=>" ارسال مکان  : $locklocation",'callback_data'=>'lockluction']
 ],
 [
 ['text'=>"فحش : $lockfosh",'callback_data'=>'lockfosh'],['text'=>" تصویر  : $lockphoto",'callback_data'=>'lockphoto']
 ],
 [
 ['text'=>"ورود ربات ها : $lockbots",'callback_data'=>'lockbots2'],['text'=>" ارسال شماره  : $lockcontact",'callback_data'=>'lockcontact']
 ],
 [
 ['text'=>"فوروارد : $lockforward",'callback_data'=>'lockforward'],['text'=>" موسیقی  : $lockaudio",'callback_data'=>'lockaudio']
 ],
 [
 ['text'=>"خدمات تلگرام : $locktg",'callback_data'=>'locktg'],['text'=>" صدا  : $lockvoice",'callback_data'=>'lockvoice']
 ],
 [
 ['text'=>"ریپلای : $lockreply",'callback_data'=>'lockreply'],['text'=>" استیکر  : $locksticker",'callback_data'=>'locksticker']
 ],
 [
 ['text'=>"دستورات عمومی : $lockcmd",'callback_data'=>'lockcmd'],
 ],
 [
 ['text'=>" بازی  : $lockgame",'callback_data'=>'lockgame']
 ],
 [
 ['text'=>" فیلم  : $lockvideo",'callback_data'=>'lockvideo']
 ],
 [
 ['text'=>" متن  : $locktext",'callback_data'=>'locktext']
 ],
 [
 ['text'=>"« برگشت »",'callback_data'=>'settings']
 ],
                    ]
             ])
         ]);
$settings2["lock"]["photo"]="Active ✓";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		 }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
  }
  }
  elseif($data=="lockvideo" && $settings2["lock"]["video"] =="Active ✓"){
			 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
$locklink = $settings2["lock"]["link"];
$lockusername = $settings2["lock"]["username"];
$locktag = $settings2["lock"]["tag"];
$lockedit = $settings2["lock"]["edit"];
$lockfosh = $settings2["lock"]["fosh"];
$lockbots = $settings2["lock"]["bot"];
$lockforward = $settings2["lock"]["forward"];
$locktg = $settings2["lock"]["tgservic"];
$lockreply = $settings2["lock"]["reply"];
$lockcmd = $settings2["lock"]["cmd"];
$lockdocument = $settings2["lock"]["document"];
$lockgif = $settings2["lock"]["gif"];
$lockvideo_note = $settings2["lock"]["video_msg"];
$locklocation = $settings2["lock"]["location"];
$lockphoto = $settings2["lock"]["photo"];
$lockcontact = $settings2["lock"]["contact"];
$lockaudio = $settings2["lock"]["audio"];
$lockvoice = $settings2["lock"]["voice"];
$locksticker = $settings2["lock"]["sticker"];
$lockgame = $settings2["lock"]["game"];
$lockvideo = $settings2["lock"]["video"];
$locktext = $settings2["lock"]["text"];
$mute_all = $settings2["lock"]["mute_all"];
          bot('editmessagetext',[
              'chat_id'=>$chatid,
   'message_id'=>$messageid,
             'text'=>"
•• پنل تنظیمات قفلی ربات

• نام گروه | $gpname
• شناسه گروه | $chatid

● قفل فیلم با موفقیت غیرفعال شد !
",
             'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
[
 ['text'=>"قفل کاراکتر",'callback_data'=>'character'],['text'=>"قفل خودکار",'callback_data'=>'lockauto'],['text'=>"حساسیت اخطار",'callback_data'=>'warn']
 ],
 [
 ['text'=>" بخش خوشامد گویی",'callback_data'=>'welcome'],['text'=>"قفل همه : $mute_all ",'callback_data'=>'lockall'],['text'=>"حالت سختگیرانه",'callback_data'=>'hardmode']
 ],
 [
 ['text'=>"لينک : $locklink",'callback_data'=>'locklink'],['text'=>" فایل  : $lockdocument",'callback_data'=>'lockdocument']
 ],
 [
 ['text'=>"هشتگ [#] : $locktag",'callback_data'=>'locktag'],['text'=>" گیف: $lockgif",'callback_data'=>'lockgif']
 ],
 [
 ['text'=>"یوزرنیم [@] : $lockusername",'callback_data'=>'lockusername'],['text'=>" پیام ویدیویی  : $lockvideo_note",'callback_data'=>'lockvideo_note']
 ],
 [
 ['text'=>"ویرایش پیام : $lockedit",'callback_data'=>'lockedit'],['text'=>" ارسال مکان  : $locklocation",'callback_data'=>'lockluction']
 ],
 [
 ['text'=>"فحش : $lockfosh",'callback_data'=>'lockfosh'],['text'=>" تصویر  : $lockphoto",'callback_data'=>'lockphoto']
 ],
 [
 ['text'=>"ورود ربات ها : $lockbots",'callback_data'=>'lockbots2'],['text'=>" ارسال شماره  : $lockcontact",'callback_data'=>'lockcontact']
 ],
 [
 ['text'=>"فوروارد : $lockforward",'callback_data'=>'lockforward'],['text'=>" موسیقی  : $lockaudio",'callback_data'=>'lockaudio']
 ],
 [
 ['text'=>"خدمات تلگرام : $locktg",'callback_data'=>'locktg'],['text'=>" صدا  : $lockvoice",'callback_data'=>'lockvoice']
 ],
 [
 ['text'=>"ریپلای : $lockreply",'callback_data'=>'lockreply'],['text'=>" استیکر  : $locksticker",'callback_data'=>'locksticker']
 ],
 [
 ['text'=>"دستورات عمومی : $lockcmd",'callback_data'=>'lockcmd'],
 ],
 [
 ['text'=>" بازی  : $lockgame",'callback_data'=>'lockgame']
 ],
 [
 ['text'=>" فیلم  : $lockvideo",'callback_data'=>'lockvideo']
 ],
 [
 ['text'=>" متن  : $locktext",'callback_data'=>'locktext']
 ],
 [
 ['text'=>"« برگشت »",'callback_data'=>'settings']
 ],
                    ]
             ])
         ]);
$settings2["lock"]["video"]="Inactive ✗";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		 		 }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
  }
  }
  elseif($data=="lockvideo" && $settings2["lock"]["video"] =="Inactive ✗"){
			 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
$locklink = $settings2["lock"]["link"];
$lockusername = $settings2["lock"]["username"];
$locktag = $settings2["lock"]["tag"];
$lockedit = $settings2["lock"]["edit"];
$lockfosh = $settings2["lock"]["fosh"];
$lockbots = $settings2["lock"]["bot"];
$lockforward = $settings2["lock"]["forward"];
$locktg = $settings2["lock"]["tgservic"];
$lockreply = $settings2["lock"]["reply"];
$lockcmd = $settings2["lock"]["cmd"];
$lockdocument = $settings2["lock"]["document"];
$lockgif = $settings2["lock"]["gif"];
$lockvideo_note = $settings2["lock"]["video_msg"];
$locklocation = $settings2["lock"]["location"];
$lockphoto = $settings2["lock"]["photo"];
$lockcontact = $settings2["lock"]["contact"];
$lockaudio = $settings2["lock"]["audio"];
$lockvoice = $settings2["lock"]["voice"];
$locksticker = $settings2["lock"]["sticker"];
$lockgame = $settings2["lock"]["game"];
$lockvideo = $settings2["lock"]["video"];
$locktext = $settings2["lock"]["text"];
$mute_all = $settings2["lock"]["mute_all"];
          bot('editmessagetext',[
              'chat_id'=>$chatid,
   'message_id'=>$messageid,
             'text'=>"
•• پنل تنظیمات قفلی ربات

• نام گروه | $gpname
• شناسه گروه | $chatid

● قفل فیلم با موفقیت فعال شد !
",
             'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
[
 ['text'=>"قفل کاراکتر",'callback_data'=>'character'],['text'=>"قفل خودکار",'callback_data'=>'lockauto'],['text'=>"حساسیت اخطار",'callback_data'=>'warn']
 ],
 [
 ['text'=>" بخش خوشامد گویی",'callback_data'=>'welcome'],['text'=>"قفل همه : $mute_all ",'callback_data'=>'lockall'],['text'=>"حالت سختگیرانه",'callback_data'=>'hardmode']
 ],
 [
 ['text'=>"لينک : $locklink",'callback_data'=>'locklink'],['text'=>" فایل  : $lockdocument",'callback_data'=>'lockdocument']
 ],
 [
 ['text'=>"هشتگ [#] : $locktag",'callback_data'=>'locktag'],['text'=>" گیف: $lockgif",'callback_data'=>'lockgif']
 ],
 [
 ['text'=>"یوزرنیم [@] : $lockusername",'callback_data'=>'lockusername'],['text'=>" پیام ویدیویی  : $lockvideo_note",'callback_data'=>'lockvideo_note']
 ],
 [
 ['text'=>"ویرایش پیام : $lockedit",'callback_data'=>'lockedit'],['text'=>" ارسال مکان  : $locklocation",'callback_data'=>'lockluction']
 ],
 [
 ['text'=>"فحش : $lockfosh",'callback_data'=>'lockfosh'],['text'=>" تصویر  : $lockphoto",'callback_data'=>'lockphoto']
 ],
 [
 ['text'=>"ورود ربات ها : $lockbots",'callback_data'=>'lockbots2'],['text'=>" ارسال شماره  : $lockcontact",'callback_data'=>'lockcontact']
 ],
 [
 ['text'=>"فوروارد : $lockforward",'callback_data'=>'lockforward'],['text'=>" موسیقی  : $lockaudio",'callback_data'=>'lockaudio']
 ],
 [
 ['text'=>"خدمات تلگرام : $locktg",'callback_data'=>'locktg'],['text'=>" صدا  : $lockvoice",'callback_data'=>'lockvoice']
 ],
 [
 ['text'=>"ریپلای : $lockreply",'callback_data'=>'lockreply'],['text'=>" استیکر  : $locksticker",'callback_data'=>'locksticker']
 ],
 [
 ['text'=>"دستورات عمومی : $lockcmd",'callback_data'=>'lockcmd'],
 ],
 [
 ['text'=>" بازی  : $lockgame",'callback_data'=>'lockgame']
 ],
 [
 ['text'=>" فیلم  : $lockvideo",'callback_data'=>'lockvideo']
 ],
 [
 ['text'=>" متن  : $locktext",'callback_data'=>'locktext']
 ],
 [
 ['text'=>"« برگشت »",'callback_data'=>'settings']
 ],
                    ]
             ])
         ]);
$settings2["lock"]["video"] = "Active ✓";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		 		 }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
  }
  }
  elseif($data=="lockgame" && $settings2["lock"]["game"] =="Active ✓"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
$locklink = $settings2["lock"]["link"];
$lockusername = $settings2["lock"]["username"];
$locktag = $settings2["lock"]["tag"];
$lockedit = $settings2["lock"]["edit"];
$lockfosh = $settings2["lock"]["fosh"];
$lockbots = $settings2["lock"]["bot"];
$lockforward = $settings2["lock"]["forward"];
$locktg = $settings2["lock"]["tgservic"];
$lockreply = $settings2["lock"]["reply"];
$lockcmd = $settings2["lock"]["cmd"];
$lockdocument = $settings2["lock"]["document"];
$lockgif = $settings2["lock"]["gif"];
$lockvideo_note = $settings2["lock"]["video_msg"];
$locklocation = $settings2["lock"]["location"];
$lockphoto = $settings2["lock"]["photo"];
$lockcontact = $settings2["lock"]["contact"];
$lockaudio = $settings2["lock"]["audio"];
$lockvoice = $settings2["lock"]["voice"];
$locksticker = $settings2["lock"]["sticker"];
$lockgame = $settings2["lock"]["game"];
$lockvideo = $settings2["lock"]["video"];
$locktext = $settings2["lock"]["text"];
$mute_all = $settings2["lock"]["mute_all"];
          bot('editmessagetext',[
              'chat_id'=>$chatid,
   'message_id'=>$messageid,
             'text'=>"
•• پنل تنظیمات قفلی ربات

• نام گروه | $gpname
• شناسه گروه | $chatid

● قفل بازی با موفقیت غیرفعال شد !
",
             'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
[
 ['text'=>"قفل کاراکتر",'callback_data'=>'character'],['text'=>"قفل خودکار",'callback_data'=>'lockauto'],['text'=>"حساسیت اخطار",'callback_data'=>'warn']
 ],
 [
 ['text'=>" بخش خوشامد گویی",'callback_data'=>'welcome'],['text'=>"قفل همه : $mute_all ",'callback_data'=>'lockall'],['text'=>"حالت سختگیرانه",'callback_data'=>'hardmode']
 ],
 [
 ['text'=>"لينک : $locklink",'callback_data'=>'locklink'],['text'=>" فایل  : $lockdocument",'callback_data'=>'lockdocument']
 ],
 [
 ['text'=>"هشتگ [#] : $locktag",'callback_data'=>'locktag'],['text'=>" گیف: $lockgif",'callback_data'=>'lockgif']
 ],
 [
 ['text'=>"یوزرنیم [@] : $lockusername",'callback_data'=>'lockusername'],['text'=>" پیام ویدیویی  : $lockvideo_note",'callback_data'=>'lockvideo_note']
 ],
 [
 ['text'=>"ویرایش پیام : $lockedit",'callback_data'=>'lockedit'],['text'=>" ارسال مکان  : $locklocation",'callback_data'=>'lockluction']
 ],
 [
 ['text'=>"فحش : $lockfosh",'callback_data'=>'lockfosh'],['text'=>" تصویر  : $lockphoto",'callback_data'=>'lockphoto']
 ],
 [
 ['text'=>"ورود ربات ها : $lockbots",'callback_data'=>'lockbots2'],['text'=>" ارسال شماره  : $lockcontact",'callback_data'=>'lockcontact']
 ],
 [
 ['text'=>"فوروارد : $lockforward",'callback_data'=>'lockforward'],['text'=>" موسیقی  : $lockaudio",'callback_data'=>'lockaudio']
 ],
 [
 ['text'=>"خدمات تلگرام : $locktg",'callback_data'=>'locktg'],['text'=>" صدا  : $lockvoice",'callback_data'=>'lockvoice']
 ],
 [
 ['text'=>"ریپلای : $lockreply",'callback_data'=>'lockreply'],['text'=>" استیکر  : $locksticker",'callback_data'=>'locksticker']
 ],
 [
 ['text'=>"دستورات عمومی : $lockcmd",'callback_data'=>'lockcmd'],
 ],
 [
 ['text'=>" بازی  : $lockgame",'callback_data'=>'lockgame']
 ],
 [
 ['text'=>" فیلم  : $lockvideo",'callback_data'=>'lockvideo']
 ],
 [
 ['text'=>" متن  : $locktext",'callback_data'=>'locktext']
 ],
 [
 ['text'=>"« برگشت »",'callback_data'=>'settings']
 ],
                    ]
             ])
         ]);
$settings2["lock"]["game"]="Inactive ✗";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		 		 }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
  }
  }
  elseif($data=="lockgame" && $settings2["lock"]["game"] =="Inactive ✗"){
			 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
$locklink = $settings2["lock"]["link"];
$lockusername = $settings2["lock"]["username"];
$locktag = $settings2["lock"]["tag"];
$lockedit = $settings2["lock"]["edit"];
$lockfosh = $settings2["lock"]["fosh"];
$lockbots = $settings2["lock"]["bot"];
$lockforward = $settings2["lock"]["forward"];
$locktg = $settings2["lock"]["tgservic"];
$lockreply = $settings2["lock"]["reply"];
$lockcmd = $settings2["lock"]["cmd"];
$lockdocument = $settings2["lock"]["document"];
$lockgif = $settings2["lock"]["gif"];
$lockvideo_note = $settings2["lock"]["video_msg"];
$locklocation = $settings2["lock"]["location"];
$lockphoto = $settings2["lock"]["photo"];
$lockcontact = $settings2["lock"]["contact"];
$lockaudio = $settings2["lock"]["audio"];
$lockvoice = $settings2["lock"]["voice"];
$locksticker = $settings2["lock"]["sticker"];
$lockgame = $settings2["lock"]["game"];
$lockvideo = $settings2["lock"]["video"];
$locktext = $settings2["lock"]["text"];
$mute_all = $settings2["lock"]["mute_all"];
          bot('editmessagetext',[
              'chat_id'=>$chatid,
   'message_id'=>$messageid,
             'text'=>"
•• پنل تنظیمات قفلی ربات

• نام گروه | $gpname
• شناسه گروه | $chatid

● قفل بازی با موفقیت فعال شد !
",
             'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
[
 ['text'=>"قفل کاراکتر",'callback_data'=>'character'],['text'=>"قفل خودکار",'callback_data'=>'lockauto'],['text'=>"حساسیت اخطار",'callback_data'=>'warn']
 ],
 [
 ['text'=>" بخش خوشامد گویی",'callback_data'=>'welcome'],['text'=>"قفل همه : $mute_all ",'callback_data'=>'lockall'],['text'=>"حالت سختگیرانه",'callback_data'=>'hardmode']
 ],
 [
 ['text'=>"لينک : $locklink",'callback_data'=>'locklink'],['text'=>" فایل  : $lockdocument",'callback_data'=>'lockdocument']
 ],
 [
 ['text'=>"هشتگ [#] : $locktag",'callback_data'=>'locktag'],['text'=>" گیف: $lockgif",'callback_data'=>'lockgif']
 ],
 [
 ['text'=>"یوزرنیم [@] : $lockusername",'callback_data'=>'lockusername'],['text'=>" پیام ویدیویی  : $lockvideo_note",'callback_data'=>'lockvideo_note']
 ],
 [
 ['text'=>"ویرایش پیام : $lockedit",'callback_data'=>'lockedit'],['text'=>" ارسال مکان  : $locklocation",'callback_data'=>'lockluction']
 ],
 [
 ['text'=>"فحش : $lockfosh",'callback_data'=>'lockfosh'],['text'=>" تصویر  : $lockphoto",'callback_data'=>'lockphoto']
 ],
 [
 ['text'=>"ورود ربات ها : $lockbots",'callback_data'=>'lockbots2'],['text'=>" ارسال شماره  : $lockcontact",'callback_data'=>'lockcontact']
 ],
 [
 ['text'=>"فوروارد : $lockforward",'callback_data'=>'lockforward'],['text'=>" موسیقی  : $lockaudio",'callback_data'=>'lockaudio']
 ],
 [
 ['text'=>"خدمات تلگرام : $locktg",'callback_data'=>'locktg'],['text'=>" صدا  : $lockvoice",'callback_data'=>'lockvoice']
 ],
 [
 ['text'=>"ریپلای : $lockreply",'callback_data'=>'lockreply'],['text'=>" استیکر  : $locksticker",'callback_data'=>'locksticker']
 ],
 [
 ['text'=>"دستورات عمومی : $lockcmd",'callback_data'=>'lockcmd'],
 ],
 [
 ['text'=>" بازی  : $lockgame",'callback_data'=>'lockgame']
 ],
 [
 ['text'=>" فیلم  : $lockvideo",'callback_data'=>'lockvideo']
 ],
 [
 ['text'=>" متن  : $locktext",'callback_data'=>'locktext']
 ],
 [
 ['text'=>"« برگشت »",'callback_data'=>'settings']
 ],
                    ]
             ])
         ]);
$settings2["lock"]["game"] = "Active ✓";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		 		 }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
  }
  }
  elseif($data=="locksticker" && $settings2["lock"]["sticker"] =="Active ✓"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
$locklink = $settings2["lock"]["link"];
$lockusername = $settings2["lock"]["username"];
$locktag = $settings2["lock"]["tag"];
$lockedit = $settings2["lock"]["edit"];
$lockfosh = $settings2["lock"]["fosh"];
$lockbots = $settings2["lock"]["bot"];
$lockforward = $settings2["lock"]["forward"];
$locktg = $settings2["lock"]["tgservic"];
$lockreply = $settings2["lock"]["reply"];
$lockcmd = $settings2["lock"]["cmd"];
$lockdocument = $settings2["lock"]["document"];
$lockgif = $settings2["lock"]["gif"];
$lockvideo_note = $settings2["lock"]["video_msg"];
$locklocation = $settings2["lock"]["location"];
$lockphoto = $settings2["lock"]["photo"];
$lockcontact = $settings2["lock"]["contact"];
$lockaudio = $settings2["lock"]["audio"];
$lockvoice = $settings2["lock"]["voice"];
$locksticker = $settings2["lock"]["sticker"];
$lockgame = $settings2["lock"]["game"];
$lockvideo = $settings2["lock"]["video"];
$locktext = $settings2["lock"]["text"];
$mute_all = $settings2["lock"]["mute_all"];
          bot('editmessagetext',[
              'chat_id'=>$chatid,
   'message_id'=>$messageid,
             'text'=>"
•• پنل تنظیمات قفلی ربات

• نام گروه | $gpname
• شناسه گروه | $chatid

● قفل استیکر با موفقیت غیرفعال شد !
",
             'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
[
 ['text'=>"قفل کاراکتر",'callback_data'=>'character'],['text'=>"قفل خودکار",'callback_data'=>'lockauto'],['text'=>"حساسیت اخطار",'callback_data'=>'warn']
 ],
 [
 ['text'=>" بخش خوشامد گویی",'callback_data'=>'welcome'],['text'=>"قفل همه : $mute_all ",'callback_data'=>'lockall'],['text'=>"حالت سختگیرانه",'callback_data'=>'hardmode']
 ],
 [
 ['text'=>"لينک : $locklink",'callback_data'=>'locklink'],['text'=>" فایل  : $lockdocument",'callback_data'=>'lockdocument']
 ],
 [
 ['text'=>"هشتگ [#] : $locktag",'callback_data'=>'locktag'],['text'=>" گیف: $lockgif",'callback_data'=>'lockgif']
 ],
 [
 ['text'=>"یوزرنیم [@] : $lockusername",'callback_data'=>'lockusername'],['text'=>" پیام ویدیویی  : $lockvideo_note",'callback_data'=>'lockvideo_note']
 ],
 [
 ['text'=>"ویرایش پیام : $lockedit",'callback_data'=>'lockedit'],['text'=>" ارسال مکان  : $locklocation",'callback_data'=>'lockluction']
 ],
 [
 ['text'=>"فحش : $lockfosh",'callback_data'=>'lockfosh'],['text'=>" تصویر  : $lockphoto",'callback_data'=>'lockphoto']
 ],
 [
 ['text'=>"ورود ربات ها : $lockbots",'callback_data'=>'lockbots2'],['text'=>" ارسال شماره  : $lockcontact",'callback_data'=>'lockcontact']
 ],
 [
 ['text'=>"فوروارد : $lockforward",'callback_data'=>'lockforward'],['text'=>" موسیقی  : $lockaudio",'callback_data'=>'lockaudio']
 ],
 [
 ['text'=>"خدمات تلگرام : $locktg",'callback_data'=>'locktg'],['text'=>" صدا  : $lockvoice",'callback_data'=>'lockvoice']
 ],
 [
 ['text'=>"ریپلای : $lockreply",'callback_data'=>'lockreply'],['text'=>" استیکر  : $locksticker",'callback_data'=>'locksticker']
 ],
 [
 ['text'=>"دستورات عمومی : $lockcmd",'callback_data'=>'lockcmd'],
 ],
 [
 ['text'=>" بازی  : $lockgame",'callback_data'=>'lockgame']
 ],
 [
 ['text'=>" فیلم  : $lockvideo",'callback_data'=>'lockvideo']
 ],
 [
 ['text'=>" متن  : $locktext",'callback_data'=>'locktext']
 ],
 [
 ['text'=>"« برگشت »",'callback_data'=>'settings']
 ],
                    ]
             ])
         ]);
$settings2["lock"]["sticker"]="Inactive ✗";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		 		 }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
  }
  }
  elseif($data=="locksticker" && $settings2["lock"]["sticker"] =="Inactive ✗"){
	 		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
$locklink = $settings2["lock"]["link"];
$lockusername = $settings2["lock"]["username"];
$locktag = $settings2["lock"]["tag"];
$lockedit = $settings2["lock"]["edit"];
$lockfosh = $settings2["lock"]["fosh"];
$lockbots = $settings2["lock"]["bot"];
$lockforward = $settings2["lock"]["forward"];
$locktg = $settings2["lock"]["tgservic"];
$lockreply = $settings2["lock"]["reply"];
$lockcmd = $settings2["lock"]["cmd"];
$lockdocument = $settings2["lock"]["document"];
$lockgif = $settings2["lock"]["gif"];
$lockvideo_note = $settings2["lock"]["video_msg"];
$locklocation = $settings2["lock"]["location"];
$lockphoto = $settings2["lock"]["photo"];
$lockcontact = $settings2["lock"]["contact"];
$lockaudio = $settings2["lock"]["audio"];
$lockvoice = $settings2["lock"]["voice"];
$locksticker = $settings2["lock"]["sticker"];
$lockgame = $settings2["lock"]["game"];
$lockvideo = $settings2["lock"]["video"];
$locktext = $settings2["lock"]["text"];
$mute_all = $settings2["lock"]["mute_all"];
          bot('editmessagetext',[
              'chat_id'=>$chatid,
   'message_id'=>$messageid,
             'text'=>"
•• پنل تنظیمات قفلی ربات

• نام گروه | $gpname
• شناسه گروه | $chatid

● قفل استیکر با موفقیت فعال شد !
",
             'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
[
 ['text'=>"قفل کاراکتر",'callback_data'=>'character'],['text'=>"قفل خودکار",'callback_data'=>'lockauto'],['text'=>"حساسیت اخطار",'callback_data'=>'warn']
 ],
 [
 ['text'=>" بخش خوشامد گویی",'callback_data'=>'welcome'],['text'=>"قفل همه : $mute_all ",'callback_data'=>'lockall'],['text'=>"حالت سختگیرانه",'callback_data'=>'hardmode']
 ],
 [
 ['text'=>"لينک : $locklink",'callback_data'=>'locklink'],['text'=>" فایل  : $lockdocument",'callback_data'=>'lockdocument']
 ],
 [
 ['text'=>"هشتگ [#] : $locktag",'callback_data'=>'locktag'],['text'=>" گیف: $lockgif",'callback_data'=>'lockgif']
 ],
 [
 ['text'=>"یوزرنیم [@] : $lockusername",'callback_data'=>'lockusername'],['text'=>" پیام ویدیویی  : $lockvideo_note",'callback_data'=>'lockvideo_note']
 ],
 [
 ['text'=>"ویرایش پیام : $lockedit",'callback_data'=>'lockedit'],['text'=>" ارسال مکان  : $locklocation",'callback_data'=>'lockluction']
 ],
 [
 ['text'=>"فحش : $lockfosh",'callback_data'=>'lockfosh'],['text'=>" تصویر  : $lockphoto",'callback_data'=>'lockphoto']
 ],
 [
 ['text'=>"ورود ربات ها : $lockbots",'callback_data'=>'lockbots2'],['text'=>" ارسال شماره  : $lockcontact",'callback_data'=>'lockcontact']
 ],
 [
 ['text'=>"فوروارد : $lockforward",'callback_data'=>'lockforward'],['text'=>" موسیقی  : $lockaudio",'callback_data'=>'lockaudio']
 ],
 [
 ['text'=>"خدمات تلگرام : $locktg",'callback_data'=>'locktg'],['text'=>" صدا  : $lockvoice",'callback_data'=>'lockvoice']
 ],
 [
 ['text'=>"ریپلای : $lockreply",'callback_data'=>'lockreply'],['text'=>" استیکر  : $locksticker",'callback_data'=>'locksticker']
 ],
 [
 ['text'=>"دستورات عمومی : $lockcmd",'callback_data'=>'lockcmd'],
 ],
 [
 ['text'=>" بازی  : $lockgame",'callback_data'=>'lockgame']
 ],
 [
 ['text'=>" فیلم  : $lockvideo",'callback_data'=>'lockvideo']
 ],
 [
 ['text'=>" متن  : $locktext",'callback_data'=>'locktext']
 ],
 [
 ['text'=>"« برگشت »",'callback_data'=>'settings']
 ],
                    ]
             ])
         ]);
$settings2["lock"]["sticker"] = "Active ✓";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		 		 }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
  }
  }
  elseif($data=="lockvoice" && $settings2["lock"]["voice"] =="Active ✓"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
$locklink = $settings2["lock"]["link"];
$lockusername = $settings2["lock"]["username"];
$locktag = $settings2["lock"]["tag"];
$lockedit = $settings2["lock"]["edit"];
$lockfosh = $settings2["lock"]["fosh"];
$lockbots = $settings2["lock"]["bot"];
$lockforward = $settings2["lock"]["forward"];
$locktg = $settings2["lock"]["tgservic"];
$lockreply = $settings2["lock"]["reply"];
$lockcmd = $settings2["lock"]["cmd"];
$lockdocument = $settings2["lock"]["document"];
$lockgif = $settings2["lock"]["gif"];
$lockvideo_note = $settings2["lock"]["video_msg"];
$locklocation = $settings2["lock"]["location"];
$lockphoto = $settings2["lock"]["photo"];
$lockcontact = $settings2["lock"]["contact"];
$lockaudio = $settings2["lock"]["audio"];
$lockvoice = $settings2["lock"]["voice"];
$locksticker = $settings2["lock"]["sticker"];
$lockgame = $settings2["lock"]["game"];
$lockvideo = $settings2["lock"]["video"];
$locktext = $settings2["lock"]["text"];
$mute_all = $settings2["lock"]["mute_all"];
          bot('editmessagetext',[
              'chat_id'=>$chatid,
   'message_id'=>$messageid,
             'text'=>"
•• پنل تنظیمات قفلی ربات

• نام گروه | $gpname
• شناسه گروه | $chatid

● قفل ویس با موفقیت غیرفعال شد !",
             'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
[
 ['text'=>"قفل کاراکتر",'callback_data'=>'character'],['text'=>"قفل خودکار",'callback_data'=>'lockauto'],['text'=>"حساسیت اخطار",'callback_data'=>'warn']
 ],
 [
 ['text'=>" بخش خوشامد گویی",'callback_data'=>'welcome'],['text'=>"قفل همه : $mute_all ",'callback_data'=>'lockall'],['text'=>"حالت سختگیرانه",'callback_data'=>'hardmode']
 ],
 [
 ['text'=>"لينک : $locklink",'callback_data'=>'locklink'],['text'=>" فایل  : $lockdocument",'callback_data'=>'lockdocument']
 ],
 [
 ['text'=>"هشتگ [#] : $locktag",'callback_data'=>'locktag'],['text'=>" گیف: $lockgif",'callback_data'=>'lockgif']
 ],
 [
 ['text'=>"یوزرنیم [@] : $lockusername",'callback_data'=>'lockusername'],['text'=>" پیام ویدیویی  : $lockvideo_note",'callback_data'=>'lockvideo_note']
 ],
 [
 ['text'=>"ویرایش پیام : $lockedit",'callback_data'=>'lockedit'],['text'=>" ارسال مکان  : $locklocation",'callback_data'=>'lockluction']
 ],
 [
 ['text'=>"فحش : $lockfosh",'callback_data'=>'lockfosh'],['text'=>" تصویر  : $lockphoto",'callback_data'=>'lockphoto']
 ],
 [
 ['text'=>"ورود ربات ها : $lockbots",'callback_data'=>'lockbots2'],['text'=>" ارسال شماره  : $lockcontact",'callback_data'=>'lockcontact']
 ],
 [
 ['text'=>"فوروارد : $lockforward",'callback_data'=>'lockforward'],['text'=>" موسیقی  : $lockaudio",'callback_data'=>'lockaudio']
 ],
 [
 ['text'=>"خدمات تلگرام : $locktg",'callback_data'=>'locktg'],['text'=>" صدا  : $lockvoice",'callback_data'=>'lockvoice']
 ],
 [
 ['text'=>"ریپلای : $lockreply",'callback_data'=>'lockreply'],['text'=>" استیکر  : $locksticker",'callback_data'=>'locksticker']
 ],
 [
 ['text'=>"دستورات عمومی : $lockcmd",'callback_data'=>'lockcmd'],
 ],
 [
 ['text'=>" بازی  : $lockgame",'callback_data'=>'lockgame']
 ],
 [
 ['text'=>" فیلم  : $lockvideo",'callback_data'=>'lockvideo']
 ],
 [
 ['text'=>" متن  : $locktext",'callback_data'=>'locktext']
 ],
 [
 ['text'=>"« برگشت »",'callback_data'=>'settings']
 ],
                    ]
             ])
         ]);
$settings2["lock"]["voice"] = "Inactive ✗";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		 		 }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
  }
  }
  elseif($data=="lockvoice" && $settings2["lock"]["voice"] =="Inactive ✗"){
			 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
$locklink = $settings2["lock"]["link"];
$lockusername = $settings2["lock"]["username"];
$locktag = $settings2["lock"]["tag"];
$lockedit = $settings2["lock"]["edit"];
$lockfosh = $settings2["lock"]["fosh"];
$lockbots = $settings2["lock"]["bot"];
$lockforward = $settings2["lock"]["forward"];
$locktg = $settings2["lock"]["tgservic"];
$lockreply = $settings2["lock"]["reply"];
$lockcmd = $settings2["lock"]["cmd"];
$lockdocument = $settings2["lock"]["document"];
$lockgif = $settings2["lock"]["gif"];
$lockvideo_note = $settings2["lock"]["video_msg"];
$locklocation = $settings2["lock"]["location"];
$lockphoto = $settings2["lock"]["photo"];
$lockcontact = $settings2["lock"]["contact"];
$lockaudio = $settings2["lock"]["audio"];
$lockvoice = $settings2["lock"]["voice"];
$locksticker = $settings2["lock"]["sticker"];
$lockgame = $settings2["lock"]["game"];
$lockvideo = $settings2["lock"]["video"];
$locktext = $settings2["lock"]["text"];
$mute_all = $settings2["lock"]["mute_all"];
          bot('editmessagetext',[
              'chat_id'=>$chatid,
   'message_id'=>$messageid,
             'text'=>"
•• پنل تنظیمات قفلی ربات

• نام گروه | $gpname
• شناسه گروه | $chatid

● قفل ویس با موفقیت فعال شد !",
             'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
[
 ['text'=>"قفل کاراکتر",'callback_data'=>'character'],['text'=>"قفل خودکار",'callback_data'=>'lockauto'],['text'=>"حساسیت اخطار",'callback_data'=>'warn']
 ],
 [
 ['text'=>" بخش خوشامد گویی",'callback_data'=>'welcome'],['text'=>"قفل همه : $mute_all ",'callback_data'=>'lockall'],['text'=>"حالت سختگیرانه",'callback_data'=>'hardmode']
 ],
 [
 ['text'=>"لينک : $locklink",'callback_data'=>'locklink'],['text'=>" فایل  : $lockdocument",'callback_data'=>'lockdocument']
 ],
 [
 ['text'=>"هشتگ [#] : $locktag",'callback_data'=>'locktag'],['text'=>" گیف: $lockgif",'callback_data'=>'lockgif']
 ],
 [
 ['text'=>"یوزرنیم [@] : $lockusername",'callback_data'=>'lockusername'],['text'=>" پیام ویدیویی  : $lockvideo_note",'callback_data'=>'lockvideo_note']
 ],
 [
 ['text'=>"ویرایش پیام : $lockedit",'callback_data'=>'lockedit'],['text'=>" ارسال مکان  : $locklocation",'callback_data'=>'lockluction']
 ],
 [
 ['text'=>"فحش : $lockfosh",'callback_data'=>'lockfosh'],['text'=>" تصویر  : $lockphoto",'callback_data'=>'lockphoto']
 ],
 [
 ['text'=>"ورود ربات ها : $lockbots",'callback_data'=>'lockbots2'],['text'=>" ارسال شماره  : $lockcontact",'callback_data'=>'lockcontact']
 ],
 [
 ['text'=>"فوروارد : $lockforward",'callback_data'=>'lockforward'],['text'=>" موسیقی  : $lockaudio",'callback_data'=>'lockaudio']
 ],
 [
 ['text'=>"خدمات تلگرام : $locktg",'callback_data'=>'locktg'],['text'=>" صدا  : $lockvoice",'callback_data'=>'lockvoice']
 ],
 [
 ['text'=>"ریپلای : $lockreply",'callback_data'=>'lockreply'],['text'=>" استیکر  : $locksticker",'callback_data'=>'locksticker']
 ],
 [
 ['text'=>"دستورات عمومی : $lockcmd",'callback_data'=>'lockcmd'],
 ],
 [
 ['text'=>" بازی  : $lockgame",'callback_data'=>'lockgame']
 ],
 [
 ['text'=>" فیلم  : $lockvideo",'callback_data'=>'lockvideo']
 ],
 [
 ['text'=>" متن  : $locktext",'callback_data'=>'locktext']
 ],
 [
 ['text'=>"« برگشت »",'callback_data'=>'settings']
 ],
                    ]
             ])
         ]);
$settings2["lock"]["voice"] = "Active ✓";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		 		 }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
  }
  }
  elseif($data=="lockaudio" && $settings2["lock"]["audio"] =="Active ✓"){
	 		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
$locklink = $settings2["lock"]["link"];
$lockusername = $settings2["lock"]["username"];
$locktag = $settings2["lock"]["tag"];
$lockedit = $settings2["lock"]["edit"];
$lockfosh = $settings2["lock"]["fosh"];
$lockbots = $settings2["lock"]["bot"];
$lockforward = $settings2["lock"]["forward"];
$locktg = $settings2["lock"]["tgservic"];
$lockreply = $settings2["lock"]["reply"];
$lockcmd = $settings2["lock"]["cmd"];
$lockdocument = $settings2["lock"]["document"];
$lockgif = $settings2["lock"]["gif"];
$lockvideo_note = $settings2["lock"]["video_msg"];
$locklocation = $settings2["lock"]["location"];
$lockphoto = $settings2["lock"]["photo"];
$lockcontact = $settings2["lock"]["contact"];
$lockaudio = $settings2["lock"]["audio"];
$lockvoice = $settings2["lock"]["voice"];
$locksticker = $settings2["lock"]["sticker"];
$lockgame = $settings2["lock"]["game"];
$lockvideo = $settings2["lock"]["video"];
$locktext = $settings2["lock"]["text"];
$mute_all = $settings2["lock"]["mute_all"];
          bot('editmessagetext',[
              'chat_id'=>$chatid,
   'message_id'=>$messageid,
             'text'=>"
•• پنل تنظیمات قفلی ربات

• نام گروه | $gpname
• شناسه گروه | $chatid

● قفل موزیک با موفقیت غیرفعال شد !",
             'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
[
 ['text'=>"قفل کاراکتر",'callback_data'=>'character'],['text'=>"قفل خودکار",'callback_data'=>'lockauto'],['text'=>"حساسیت اخطار",'callback_data'=>'warn']
 ],
 [
 ['text'=>" بخش خوشامد گویی",'callback_data'=>'welcome'],['text'=>"قفل همه : $mute_all ",'callback_data'=>'lockall'],['text'=>"حالت سختگیرانه",'callback_data'=>'hardmode']
 ],
 [
 ['text'=>"لينک : $locklink",'callback_data'=>'locklink'],['text'=>" فایل  : $lockdocument",'callback_data'=>'lockdocument']
 ],
 [
 ['text'=>"هشتگ [#] : $locktag",'callback_data'=>'locktag'],['text'=>" گیف: $lockgif",'callback_data'=>'lockgif']
 ],
 [
 ['text'=>"یوزرنیم [@] : $lockusername",'callback_data'=>'lockusername'],['text'=>" پیام ویدیویی  : $lockvideo_note",'callback_data'=>'lockvideo_note']
 ],
 [
 ['text'=>"ویرایش پیام : $lockedit",'callback_data'=>'lockedit'],['text'=>" ارسال مکان  : $locklocation",'callback_data'=>'lockluction']
 ],
 [
 ['text'=>"فحش : $lockfosh",'callback_data'=>'lockfosh'],['text'=>" تصویر  : $lockphoto",'callback_data'=>'lockphoto']
 ],
 [
 ['text'=>"ورود ربات ها : $lockbots",'callback_data'=>'lockbots2'],['text'=>" ارسال شماره  : $lockcontact",'callback_data'=>'lockcontact']
 ],
 [
 ['text'=>"فوروارد : $lockforward",'callback_data'=>'lockforward'],['text'=>" موسیقی  : $lockaudio",'callback_data'=>'lockaudio']
 ],
 [
 ['text'=>"خدمات تلگرام : $locktg",'callback_data'=>'locktg'],['text'=>" صدا  : $lockvoice",'callback_data'=>'lockvoice']
 ],
 [
 ['text'=>"ریپلای : $lockreply",'callback_data'=>'lockreply'],['text'=>" استیکر  : $locksticker",'callback_data'=>'locksticker']
 ],
 [
 ['text'=>"دستورات عمومی : $lockcmd",'callback_data'=>'lockcmd'],
 ],
 [
 ['text'=>" بازی  : $lockgame",'callback_data'=>'lockgame']
 ],
 [
 ['text'=>" فیلم  : $lockvideo",'callback_data'=>'lockvideo']
 ],
 [
 ['text'=>" متن  : $locktext",'callback_data'=>'locktext']
 ],
 [
 ['text'=>"« برگشت »",'callback_data'=>'settings']
 ],
                    ]
             ])
         ]);
$settings2["lock"]["audio"] = "Inactive ✗";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		 		 }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
  }
  }
  elseif($data=="lockaudio" && $settings2["lock"]["audio"] =="Inactive ✗"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
$locklink = $settings2["lock"]["link"];
$lockusername = $settings2["lock"]["username"];
$locktag = $settings2["lock"]["tag"];
$lockedit = $settings2["lock"]["edit"];
$lockfosh = $settings2["lock"]["fosh"];
$lockbots = $settings2["lock"]["bot"];
$lockforward = $settings2["lock"]["forward"];
$locktg = $settings2["lock"]["tgservic"];
$lockreply = $settings2["lock"]["reply"];
$lockcmd = $settings2["lock"]["cmd"];
$lockdocument = $settings2["lock"]["document"];
$lockgif = $settings2["lock"]["gif"];
$lockvideo_note = $settings2["lock"]["video_msg"];
$locklocation = $settings2["lock"]["location"];
$lockphoto = $settings2["lock"]["photo"];
$lockcontact = $settings2["lock"]["contact"];
$lockaudio = $settings2["lock"]["audio"];
$lockvoice = $settings2["lock"]["voice"];
$locksticker = $settings2["lock"]["sticker"];
$lockgame = $settings2["lock"]["game"];
$lockvideo = $settings2["lock"]["video"];
$locktext = $settings2["lock"]["text"];
$mute_all = $settings2["lock"]["mute_all"];
          bot('editmessagetext',[
              'chat_id'=>$chatid,
   'message_id'=>$messageid,
             'text'=>"
•• پنل تنظیمات قفلی ربات

• نام گروه | $gpname
• شناسه گروه | $chatid

● قفل موزیک با موفقیت فعال شد !",
             'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
[
 ['text'=>"قفل کاراکتر",'callback_data'=>'character'],['text'=>"قفل خودکار",'callback_data'=>'lockauto'],['text'=>"حساسیت اخطار",'callback_data'=>'warn']
 ],
 [
 ['text'=>" بخش خوشامد گویی",'callback_data'=>'welcome'],['text'=>"قفل همه : $mute_all ",'callback_data'=>'lockall'],['text'=>"حالت سختگیرانه",'callback_data'=>'hardmode']
 ],
 [
 ['text'=>"لينک : $locklink",'callback_data'=>'locklink'],['text'=>" فایل  : $lockdocument",'callback_data'=>'lockdocument']
 ],
 [
 ['text'=>"هشتگ [#] : $locktag",'callback_data'=>'locktag'],['text'=>" گیف: $lockgif",'callback_data'=>'lockgif']
 ],
 [
 ['text'=>"یوزرنیم [@] : $lockusername",'callback_data'=>'lockusername'],['text'=>" پیام ویدیویی  : $lockvideo_note",'callback_data'=>'lockvideo_note']
 ],
 [
 ['text'=>"ویرایش پیام : $lockedit",'callback_data'=>'lockedit'],['text'=>" ارسال مکان  : $locklocation",'callback_data'=>'lockluction']
 ],
 [
 ['text'=>"فحش : $lockfosh",'callback_data'=>'lockfosh'],['text'=>" تصویر  : $lockphoto",'callback_data'=>'lockphoto']
 ],
 [
 ['text'=>"ورود ربات ها : $lockbots",'callback_data'=>'lockbots2'],['text'=>" ارسال شماره  : $lockcontact",'callback_data'=>'lockcontact']
 ],
 [
 ['text'=>"فوروارد : $lockforward",'callback_data'=>'lockforward'],['text'=>" موسیقی  : $lockaudio",'callback_data'=>'lockaudio']
 ],
 [
 ['text'=>"خدمات تلگرام : $locktg",'callback_data'=>'locktg'],['text'=>" صدا  : $lockvoice",'callback_data'=>'lockvoice']
 ],
 [
 ['text'=>"ریپلای : $lockreply",'callback_data'=>'lockreply'],['text'=>" استیکر  : $locksticker",'callback_data'=>'locksticker']
 ],
 [
 ['text'=>"دستورات عمومی : $lockcmd",'callback_data'=>'lockcmd'],
 ],
 [
 ['text'=>" بازی  : $lockgame",'callback_data'=>'lockgame']
 ],
 [
 ['text'=>" فیلم  : $lockvideo",'callback_data'=>'lockvideo']
 ],
 [
 ['text'=>" متن  : $locktext",'callback_data'=>'locktext']
 ],
 [
 ['text'=>"« برگشت »",'callback_data'=>'settings']
 ],
                    ]
             ])
         ]);
$settings2["lock"]["audio"] = "Active ✓";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		 		 }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
  }
  }
  elseif($data=="lockforward" && $settings2["lock"]["forward"] =="Active ✓"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
$locklink = $settings2["lock"]["link"];
$lockusername = $settings2["lock"]["username"];
$locktag = $settings2["lock"]["tag"];
$lockedit = $settings2["lock"]["edit"];
$lockfosh = $settings2["lock"]["fosh"];
$lockbots = $settings2["lock"]["bot"];
$lockforward = $settings2["lock"]["forward"];
$locktg = $settings2["lock"]["tgservic"];
$lockreply = $settings2["lock"]["reply"];
$lockcmd = $settings2["lock"]["cmd"];
$lockdocument = $settings2["lock"]["document"];
$lockgif = $settings2["lock"]["gif"];
$lockvideo_note = $settings2["lock"]["video_msg"];
$locklocation = $settings2["lock"]["location"];
$lockphoto = $settings2["lock"]["photo"];
$lockcontact = $settings2["lock"]["contact"];
$lockaudio = $settings2["lock"]["audio"];
$lockvoice = $settings2["lock"]["voice"];
$locksticker = $settings2["lock"]["sticker"];
$lockgame = $settings2["lock"]["game"];
$lockvideo = $settings2["lock"]["video"];
$locktext = $settings2["lock"]["text"];
$mute_all = $settings2["lock"]["mute_all"];
          bot('editmessagetext',[
              'chat_id'=>$chatid,
   'message_id'=>$messageid,
             'text'=>"
•• پنل تنظیمات قفلی ربات

• نام گروه | $gpname
• شناسه گروه | $chatid

● قفل فوروارد با موفقیت غیرفعال شد !
",
             'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
[
 ['text'=>"قفل کاراکتر",'callback_data'=>'character'],['text'=>"قفل خودکار",'callback_data'=>'lockauto'],['text'=>"حساسیت اخطار",'callback_data'=>'warn']
 ],
 [
 ['text'=>" بخش خوشامد گویی",'callback_data'=>'welcome'],['text'=>"قفل همه : $mute_all ",'callback_data'=>'lockall'],['text'=>"حالت سختگیرانه",'callback_data'=>'hardmode']
 ],
 [
 ['text'=>"لينک : $locklink",'callback_data'=>'locklink'],['text'=>" فایل  : $lockdocument",'callback_data'=>'lockdocument']
 ],
 [
 ['text'=>"هشتگ [#] : $locktag",'callback_data'=>'locktag'],['text'=>" گیف: $lockgif",'callback_data'=>'lockgif']
 ],
 [
 ['text'=>"یوزرنیم [@] : $lockusername",'callback_data'=>'lockusername'],['text'=>" پیام ویدیویی  : $lockvideo_note",'callback_data'=>'lockvideo_note']
 ],
 [
 ['text'=>"ویرایش پیام : $lockedit",'callback_data'=>'lockedit'],['text'=>" ارسال مکان  : $locklocation",'callback_data'=>'lockluction']
 ],
 [
 ['text'=>"فحش : $lockfosh",'callback_data'=>'lockfosh'],['text'=>" تصویر  : $lockphoto",'callback_data'=>'lockphoto']
 ],
 [
 ['text'=>"ورود ربات ها : $lockbots",'callback_data'=>'lockbots2'],['text'=>" ارسال شماره  : $lockcontact",'callback_data'=>'lockcontact']
 ],
 [
 ['text'=>"فوروارد : $lockforward",'callback_data'=>'lockforward'],['text'=>" موسیقی  : $lockaudio",'callback_data'=>'lockaudio']
 ],
 [
 ['text'=>"خدمات تلگرام : $locktg",'callback_data'=>'locktg'],['text'=>" صدا  : $lockvoice",'callback_data'=>'lockvoice']
 ],
 [
 ['text'=>"ریپلای : $lockreply",'callback_data'=>'lockreply'],['text'=>" استیکر  : $locksticker",'callback_data'=>'locksticker']
 ],
 [
 ['text'=>"دستورات عمومی : $lockcmd",'callback_data'=>'lockcmd'],
 ],
 [
 ['text'=>" بازی  : $lockgame",'callback_data'=>'lockgame']
 ],
 [
 ['text'=>" فیلم  : $lockvideo",'callback_data'=>'lockvideo']
 ],
 [
 ['text'=>" متن  : $locktext",'callback_data'=>'locktext']
 ],
 [
 ['text'=>"« برگشت »",'callback_data'=>'settings']
 ],
	]
             ])
         ]);
$settings2["lock"]["forward"] = "Inactive ✗";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		 		 }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
  }
  }
  elseif($data=="lockforward" && $settings2["lock"]["forward"] =="Inactive ✗"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
$locklink = $settings2["lock"]["link"];
$lockusername = $settings2["lock"]["username"];
$locktag = $settings2["lock"]["tag"];
$lockedit = $settings2["lock"]["edit"];
$lockfosh = $settings2["lock"]["fosh"];
$lockbots = $settings2["lock"]["bot"];
$lockforward = $settings2["lock"]["forward"];
$locktg = $settings2["lock"]["tgservic"];
$lockreply = $settings2["lock"]["reply"];
$lockcmd = $settings2["lock"]["cmd"];
$lockdocument = $settings2["lock"]["document"];
$lockgif = $settings2["lock"]["gif"];
$lockvideo_note = $settings2["lock"]["video_msg"];
$locklocation = $settings2["lock"]["location"];
$lockphoto = $settings2["lock"]["photo"];
$lockcontact = $settings2["lock"]["contact"];
$lockaudio = $settings2["lock"]["audio"];
$lockvoice = $settings2["lock"]["voice"];
$locksticker = $settings2["lock"]["sticker"];
$lockgame = $settings2["lock"]["game"];
$lockvideo = $settings2["lock"]["video"];
$locktext = $settings2["lock"]["text"];
$mute_all = $settings2["lock"]["mute_all"];
          bot('editmessagetext',[
              'chat_id'=>$chatid,
   'message_id'=>$messageid,
             'text'=>"
•• پنل تنظیمات قفلی ربات

• نام گروه | $gpname
• شناسه گروه | $chatid

● قفل فوروارد با موفقیت فعال شد !
",
             'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
[
 ['text'=>"قفل کاراکتر",'callback_data'=>'character'],['text'=>"قفل خودکار",'callback_data'=>'lockauto'],['text'=>"حساسیت اخطار",'callback_data'=>'warn']
 ],
 [
 ['text'=>" بخش خوشامد گویی",'callback_data'=>'welcome'],['text'=>"قفل همه : $mute_all ",'callback_data'=>'lockall'],['text'=>"حالت سختگیرانه",'callback_data'=>'hardmode']
 ],
 [
 ['text'=>"لينک : $locklink",'callback_data'=>'locklink'],['text'=>" فایل  : $lockdocument",'callback_data'=>'lockdocument']
 ],
 [
 ['text'=>"هشتگ [#] : $locktag",'callback_data'=>'locktag'],['text'=>" گیف: $lockgif",'callback_data'=>'lockgif']
 ],
 [
 ['text'=>"یوزرنیم [@] : $lockusername",'callback_data'=>'lockusername'],['text'=>" پیام ویدیویی  : $lockvideo_note",'callback_data'=>'lockvideo_note']
 ],
 [
 ['text'=>"ویرایش پیام : $lockedit",'callback_data'=>'lockedit'],['text'=>" ارسال مکان  : $locklocation",'callback_data'=>'lockluction']
 ],
 [
 ['text'=>"فحش : $lockfosh",'callback_data'=>'lockfosh'],['text'=>" تصویر  : $lockphoto",'callback_data'=>'lockphoto']
 ],
 [
 ['text'=>"ورود ربات ها : $lockbots",'callback_data'=>'lockbots2'],['text'=>" ارسال شماره  : $lockcontact",'callback_data'=>'lockcontact']
 ],
 [
 ['text'=>"فوروارد : $lockforward",'callback_data'=>'lockforward'],['text'=>" موسیقی  : $lockaudio",'callback_data'=>'lockaudio']
 ],
 [
 ['text'=>"خدمات تلگرام : $locktg",'callback_data'=>'locktg'],['text'=>" صدا  : $lockvoice",'callback_data'=>'lockvoice']
 ],
 [
 ['text'=>"ریپلای : $lockreply",'callback_data'=>'lockreply'],['text'=>" استیکر  : $locksticker",'callback_data'=>'locksticker']
 ],
 [
 ['text'=>"دستورات عمومی : $lockcmd",'callback_data'=>'lockcmd'],
 ],
 [
 ['text'=>" بازی  : $lockgame",'callback_data'=>'lockgame']
 ],
 [
 ['text'=>" فیلم  : $lockvideo",'callback_data'=>'lockvideo']
 ],
 [
 ['text'=>" متن  : $locktext",'callback_data'=>'locktext']
 ],
 [
 ['text'=>"« برگشت »",'callback_data'=>'settings']
 ],
	]
             ])
         ]);
$settings2["lock"]["forward"] = "Active ✓";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		 		 }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
  }
  }
  elseif($data=="lockcontact" && $settings2["lock"]["contact"] =="Active ✓"){
			 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
$locklink = $settings2["lock"]["link"];
$lockusername = $settings2["lock"]["username"];
$locktag = $settings2["lock"]["tag"];
$lockedit = $settings2["lock"]["edit"];
$lockfosh = $settings2["lock"]["fosh"];
$lockbots = $settings2["lock"]["bot"];
$lockforward = $settings2["lock"]["forward"];
$locktg = $settings2["lock"]["tgservic"];
$lockreply = $settings2["lock"]["reply"];
$lockcmd = $settings2["lock"]["cmd"];
$lockdocument = $settings2["lock"]["document"];
$lockgif = $settings2["lock"]["gif"];
$lockvideo_note = $settings2["lock"]["video_msg"];
$locklocation = $settings2["lock"]["location"];
$lockphoto = $settings2["lock"]["photo"];
$lockcontact = $settings2["lock"]["contact"];
$lockaudio = $settings2["lock"]["audio"];
$lockvoice = $settings2["lock"]["voice"];
$locksticker = $settings2["lock"]["sticker"];
$lockgame = $settings2["lock"]["game"];
$lockvideo = $settings2["lock"]["video"];
$locktext = $settings2["lock"]["text"];
$mute_all = $settings2["lock"]["mute_all"];
          bot('editmessagetext',[
              'chat_id'=>$chatid,
   'message_id'=>$messageid,
             'text'=>"
•• پنل تنظیمات قفلی ربات

• نام گروه | $gpname
• شناسه گروه | $chatid

● قفل مخاطب با موفقیت غیرفعال شد !",
             'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
[
 ['text'=>"قفل کاراکتر",'callback_data'=>'character'],['text'=>"قفل خودکار",'callback_data'=>'lockauto'],['text'=>"حساسیت اخطار",'callback_data'=>'warn']
 ],
 [
 ['text'=>" بخش خوشامد گویی",'callback_data'=>'welcome'],['text'=>"قفل همه : $mute_all ",'callback_data'=>'lockall'],['text'=>"حالت سختگیرانه",'callback_data'=>'hardmode']
 ],
 [
 ['text'=>"لينک : $locklink",'callback_data'=>'locklink'],['text'=>" فایل  : $lockdocument",'callback_data'=>'lockdocument']
 ],
 [
 ['text'=>"هشتگ [#] : $locktag",'callback_data'=>'locktag'],['text'=>" گیف: $lockgif",'callback_data'=>'lockgif']
 ],
 [
 ['text'=>"یوزرنیم [@] : $lockusername",'callback_data'=>'lockusername'],['text'=>" پیام ویدیویی  : $lockvideo_note",'callback_data'=>'lockvideo_note']
 ],
 [
 ['text'=>"ویرایش پیام : $lockedit",'callback_data'=>'lockedit'],['text'=>" ارسال مکان  : $locklocation",'callback_data'=>'lockluction']
 ],
 [
 ['text'=>"فحش : $lockfosh",'callback_data'=>'lockfosh'],['text'=>" تصویر  : $lockphoto",'callback_data'=>'lockphoto']
 ],
 [
 ['text'=>"ورود ربات ها : $lockbots",'callback_data'=>'lockbots2'],['text'=>" ارسال شماره  : $lockcontact",'callback_data'=>'lockcontact']
 ],
 [
 ['text'=>"فوروارد : $lockforward",'callback_data'=>'lockforward'],['text'=>" موسیقی  : $lockaudio",'callback_data'=>'lockaudio']
 ],
 [
 ['text'=>"خدمات تلگرام : $locktg",'callback_data'=>'locktg'],['text'=>" صدا  : $lockvoice",'callback_data'=>'lockvoice']
 ],
 [
 ['text'=>"ریپلای : $lockreply",'callback_data'=>'lockreply'],['text'=>" استیکر  : $locksticker",'callback_data'=>'locksticker']
 ],
 [
 ['text'=>"دستورات عمومی : $lockcmd",'callback_data'=>'lockcmd'],
 ],
 [
 ['text'=>" بازی  : $lockgame",'callback_data'=>'lockgame']
 ],
 [
 ['text'=>" فیلم  : $lockvideo",'callback_data'=>'lockvideo']
 ],
 [
 ['text'=>" متن  : $locktext",'callback_data'=>'locktext']
 ],
 [
 ['text'=>"« برگشت »",'callback_data'=>'settings']
 ],
                    ]
             ])
         ]);
$settings2["lock"]["contact"] = "Inactive ✗";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		 		 }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
  }
  }
  elseif($data=="lockcontact" && $settings2["lock"]["contact"] =="Inactive ✗"){
			 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
$locklink = $settings2["lock"]["link"];
$lockusername = $settings2["lock"]["username"];
$locktag = $settings2["lock"]["tag"];
$lockedit = $settings2["lock"]["edit"];
$lockfosh = $settings2["lock"]["fosh"];
$lockbots = $settings2["lock"]["bot"];
$lockforward = $settings2["lock"]["forward"];
$locktg = $settings2["lock"]["tgservic"];
$lockreply = $settings2["lock"]["reply"];
$lockcmd = $settings2["lock"]["cmd"];
$lockdocument = $settings2["lock"]["document"];
$lockgif = $settings2["lock"]["gif"];
$lockvideo_note = $settings2["lock"]["video_msg"];
$locklocation = $settings2["lock"]["location"];
$lockphoto = $settings2["lock"]["photo"];
$lockcontact = $settings2["lock"]["contact"];
$lockaudio = $settings2["lock"]["audio"];
$lockvoice = $settings2["lock"]["voice"];
$locksticker = $settings2["lock"]["sticker"];
$lockgame = $settings2["lock"]["game"];
$lockvideo = $settings2["lock"]["video"];
$locktext = $settings2["lock"]["text"];
$mute_all = $settings2["lock"]["mute_all"];
          bot('editmessagetext',[
              'chat_id'=>$chatid,
   'message_id'=>$messageid,
             'text'=>"
•• پنل تنظیمات قفلی ربات

• نام گروه | $gpname
• شناسه گروه | $chatid

● قفل مخاطب با موفقیت فعال شد !",
             'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
[
 ['text'=>"قفل کاراکتر",'callback_data'=>'character'],['text'=>"قفل خودکار",'callback_data'=>'lockauto'],['text'=>"حساسیت اخطار",'callback_data'=>'warn']
 ],
 [
 ['text'=>" بخش خوشامد گویی",'callback_data'=>'welcome'],['text'=>"قفل همه : $mute_all ",'callback_data'=>'lockall'],['text'=>"حالت سختگیرانه",'callback_data'=>'hardmode']
 ],
 [
 ['text'=>"لينک : $locklink",'callback_data'=>'locklink'],['text'=>" فایل  : $lockdocument",'callback_data'=>'lockdocument']
 ],
 [
 ['text'=>"هشتگ [#] : $locktag",'callback_data'=>'locktag'],['text'=>" گیف: $lockgif",'callback_data'=>'lockgif']
 ],
 [
 ['text'=>"یوزرنیم [@] : $lockusername",'callback_data'=>'lockusername'],['text'=>" پیام ویدیویی  : $lockvideo_note",'callback_data'=>'lockvideo_note']
 ],
 [
 ['text'=>"ویرایش پیام : $lockedit",'callback_data'=>'lockedit'],['text'=>" ارسال مکان  : $locklocation",'callback_data'=>'lockluction']
 ],
 [
 ['text'=>"فحش : $lockfosh",'callback_data'=>'lockfosh'],['text'=>" تصویر  : $lockphoto",'callback_data'=>'lockphoto']
 ],
 [
 ['text'=>"ورود ربات ها : $lockbots",'callback_data'=>'lockbots2'],['text'=>" ارسال شماره  : $lockcontact",'callback_data'=>'lockcontact']
 ],
 [
 ['text'=>"فوروارد : $lockforward",'callback_data'=>'lockforward'],['text'=>" موسیقی  : $lockaudio",'callback_data'=>'lockaudio']
 ],
 [
 ['text'=>"خدمات تلگرام : $locktg",'callback_data'=>'locktg'],['text'=>" صدا  : $lockvoice",'callback_data'=>'lockvoice']
 ],
 [
 ['text'=>"ریپلای : $lockreply",'callback_data'=>'lockreply'],['text'=>" استیکر  : $locksticker",'callback_data'=>'locksticker']
 ],
 [
 ['text'=>"دستورات عمومی : $lockcmd",'callback_data'=>'lockcmd'],
 ],
 [
 ['text'=>" بازی  : $lockgame",'callback_data'=>'lockgame']
 ],
 [
 ['text'=>" فیلم  : $lockvideo",'callback_data'=>'lockvideo']
 ],
 [
 ['text'=>" متن  : $locktext",'callback_data'=>'locktext']
 ],
 [
 ['text'=>"« برگشت »",'callback_data'=>'settings']
 ],
                    ]
             ])
         ]);
$settings2["lock"]["contact"] = "Active ✓";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		 		 }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
  }
  }
  elseif($data=="lockluction" && $settings2["lock"]["location"] =="Active ✓"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
$locklink = $settings2["lock"]["link"];
$lockusername = $settings2["lock"]["username"];
$locktag = $settings2["lock"]["tag"];
$lockedit = $settings2["lock"]["edit"];
$lockfosh = $settings2["lock"]["fosh"];
$lockbots = $settings2["lock"]["bot"];
$lockforward = $settings2["lock"]["forward"];
$locktg = $settings2["lock"]["tgservic"];
$lockreply = $settings2["lock"]["reply"];
$lockcmd = $settings2["lock"]["cmd"];
$lockdocument = $settings2["lock"]["document"];
$lockgif = $settings2["lock"]["gif"];
$lockvideo_note = $settings2["lock"]["video_msg"];
$locklocation = $settings2["lock"]["location"];
$lockphoto = $settings2["lock"]["photo"];
$lockcontact = $settings2["lock"]["contact"];
$lockaudio = $settings2["lock"]["audio"];
$lockvoice = $settings2["lock"]["voice"];
$locksticker = $settings2["lock"]["sticker"];
$lockgame = $settings2["lock"]["game"];
$lockvideo = $settings2["lock"]["video"];
$locktext = $settings2["lock"]["text"];
$mute_all = $settings2["lock"]["mute_all"];
          bot('editmessagetext',[
              'chat_id'=>$chatid,
   'message_id'=>$messageid,
             'text'=>"
•• پنل تنظیمات قفلی ربات

• نام گروه | $gpname
• شناسه گروه | $chatid

● قفل موقعیت مکانی با موفقیت غیرفعال شد !",
             'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
[
 ['text'=>"قفل کاراکتر",'callback_data'=>'character'],['text'=>"قفل خودکار",'callback_data'=>'lockauto'],['text'=>"حساسیت اخطار",'callback_data'=>'warn']
 ],
 [
 ['text'=>" بخش خوشامد گویی",'callback_data'=>'welcome'],['text'=>"قفل همه : $mute_all ",'callback_data'=>'lockall'],['text'=>"حالت سختگیرانه",'callback_data'=>'hardmode']
 ],
 [
 ['text'=>"لينک : $locklink",'callback_data'=>'locklink'],['text'=>" فایل  : $lockdocument",'callback_data'=>'lockdocument']
 ],
 [
 ['text'=>"هشتگ [#] : $locktag",'callback_data'=>'locktag'],['text'=>" گیف: $lockgif",'callback_data'=>'lockgif']
 ],
 [
 ['text'=>"یوزرنیم [@] : $lockusername",'callback_data'=>'lockusername'],['text'=>" پیام ویدیویی  : $lockvideo_note",'callback_data'=>'lockvideo_note']
 ],
 [
 ['text'=>"ویرایش پیام : $lockedit",'callback_data'=>'lockedit'],['text'=>" ارسال مکان  : $locklocation",'callback_data'=>'lockluction']
 ],
 [
 ['text'=>"فحش : $lockfosh",'callback_data'=>'lockfosh'],['text'=>" تصویر  : $lockphoto",'callback_data'=>'lockphoto']
 ],
 [
 ['text'=>"ورود ربات ها : $lockbots",'callback_data'=>'lockbots2'],['text'=>" ارسال شماره  : $lockcontact",'callback_data'=>'lockcontact']
 ],
 [
 ['text'=>"فوروارد : $lockforward",'callback_data'=>'lockforward'],['text'=>" موسیقی  : $lockaudio",'callback_data'=>'lockaudio']
 ],
 [
 ['text'=>"خدمات تلگرام : $locktg",'callback_data'=>'locktg'],['text'=>" صدا  : $lockvoice",'callback_data'=>'lockvoice']
 ],
 [
 ['text'=>"ریپلای : $lockreply",'callback_data'=>'lockreply'],['text'=>" استیکر  : $locksticker",'callback_data'=>'locksticker']
 ],
 [
 ['text'=>"دستورات عمومی : $lockcmd",'callback_data'=>'lockcmd'],
 ],
 [
 ['text'=>" بازی  : $lockgame",'callback_data'=>'lockgame']
 ],
 [
 ['text'=>" فیلم  : $lockvideo",'callback_data'=>'lockvideo']
 ],
 [
 ['text'=>" متن  : $locktext",'callback_data'=>'locktext']
 ],
 [
 ['text'=>"« برگشت »",'callback_data'=>'settings']
 ],
                    ]
             ])
         ]);
$settings2["lock"]["location"] = "Inactive ✗";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		 		 }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
  }
  }
  elseif($data=="lockluction" && $settings2["lock"]["location"] =="Inactive ✗"){
			 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
$locklink = $settings2["lock"]["link"];
$lockusername = $settings2["lock"]["username"];
$locktag = $settings2["lock"]["tag"];
$lockedit = $settings2["lock"]["edit"];
$lockfosh = $settings2["lock"]["fosh"];
$lockbots = $settings2["lock"]["bot"];
$lockforward = $settings2["lock"]["forward"];
$locktg = $settings2["lock"]["tgservic"];
$lockreply = $settings2["lock"]["reply"];
$lockcmd = $settings2["lock"]["cmd"];
$lockdocument = $settings2["lock"]["document"];
$lockgif = $settings2["lock"]["gif"];
$lockvideo_note = $settings2["lock"]["video_msg"];
$locklocation = $settings2["lock"]["location"];
$lockphoto = $settings2["lock"]["photo"];
$lockcontact = $settings2["lock"]["contact"];
$lockaudio = $settings2["lock"]["audio"];
$lockvoice = $settings2["lock"]["voice"];
$locksticker = $settings2["lock"]["sticker"];
$lockgame = $settings2["lock"]["game"];
$lockvideo = $settings2["lock"]["video"];
$locktext = $settings2["lock"]["text"];
$mute_all = $settings2["lock"]["mute_all"];
          bot('editmessagetext',[
              'chat_id'=>$chatid,
   'message_id'=>$messageid,
             'text'=>"
•• پنل تنظیمات قفلی ربات

• نام گروه | $gpname
• شناسه گروه | $chatid

● قفل موقعیت مکانی با موفقیت فعال شد !",
             'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
[
 ['text'=>"قفل کاراکتر",'callback_data'=>'character'],['text'=>"قفل خودکار",'callback_data'=>'lockauto'],['text'=>"حساسیت اخطار",'callback_data'=>'warn']
 ],
 [
 ['text'=>" بخش خوشامد گویی",'callback_data'=>'welcome'],['text'=>"قفل همه : $mute_all ",'callback_data'=>'lockall'],['text'=>"حالت سختگیرانه",'callback_data'=>'hardmode']
 ],
 [
 ['text'=>"لينک : $locklink",'callback_data'=>'locklink'],['text'=>" فایل  : $lockdocument",'callback_data'=>'lockdocument']
 ],
 [
 ['text'=>"هشتگ [#] : $locktag",'callback_data'=>'locktag'],['text'=>" گیف: $lockgif",'callback_data'=>'lockgif']
 ],
 [
 ['text'=>"یوزرنیم [@] : $lockusername",'callback_data'=>'lockusername'],['text'=>" پیام ویدیویی  : $lockvideo_note",'callback_data'=>'lockvideo_note']
 ],
 [
 ['text'=>"ویرایش پیام : $lockedit",'callback_data'=>'lockedit'],['text'=>" ارسال مکان  : $locklocation",'callback_data'=>'lockluction']
 ],
 [
 ['text'=>"فحش : $lockfosh",'callback_data'=>'lockfosh'],['text'=>" تصویر  : $lockphoto",'callback_data'=>'lockphoto']
 ],
 [
 ['text'=>"ورود ربات ها : $lockbots",'callback_data'=>'lockbots2'],['text'=>" ارسال شماره  : $lockcontact",'callback_data'=>'lockcontact']
 ],
 [
 ['text'=>"فوروارد : $lockforward",'callback_data'=>'lockforward'],['text'=>" موسیقی  : $lockaudio",'callback_data'=>'lockaudio']
 ],
 [
 ['text'=>"خدمات تلگرام : $locktg",'callback_data'=>'locktg'],['text'=>" صدا  : $lockvoice",'callback_data'=>'lockvoice']
 ],
 [
 ['text'=>"ریپلای : $lockreply",'callback_data'=>'lockreply'],['text'=>" استیکر  : $locksticker",'callback_data'=>'locksticker']
 ],
 [
 ['text'=>"دستورات عمومی : $lockcmd",'callback_data'=>'lockcmd'],
 ],
 [
 ['text'=>" بازی  : $lockgame",'callback_data'=>'lockgame']
 ],
 [
 ['text'=>" فیلم  : $lockvideo",'callback_data'=>'lockvideo']
 ],
 [
 ['text'=>" متن  : $locktext",'callback_data'=>'locktext']
 ],
 [
 ['text'=>"« برگشت »",'callback_data'=>'settings']
 ],
                    ]
             ])
         ]);
$settings2["lock"]["location"] = "Active ✓";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		 		 }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
  }
  }
  elseif($data=="lockfosh" && $settings2["lock"]["fosh"] =="Active ✓"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
$locklink = $settings2["lock"]["link"];
$lockusername = $settings2["lock"]["username"];
$locktag = $settings2["lock"]["tag"];
$lockedit = $settings2["lock"]["edit"];
$lockfosh = $settings2["lock"]["fosh"];
$lockbots = $settings2["lock"]["bot"];
$lockforward = $settings2["lock"]["forward"];
$locktg = $settings2["lock"]["tgservic"];
$lockreply = $settings2["lock"]["reply"];
$lockcmd = $settings2["lock"]["cmd"];
$lockdocument = $settings2["lock"]["document"];
$lockgif = $settings2["lock"]["gif"];
$lockvideo_note = $settings2["lock"]["video_msg"];
$locklocation = $settings2["lock"]["location"];
$lockphoto = $settings2["lock"]["photo"];
$lockcontact = $settings2["lock"]["contact"];
$lockaudio = $settings2["lock"]["audio"];
$lockvoice = $settings2["lock"]["voice"];
$locksticker = $settings2["lock"]["sticker"];
$lockgame = $settings2["lock"]["game"];
$lockvideo = $settings2["lock"]["video"];
$locktext = $settings2["lock"]["text"];
$mute_all = $settings2["lock"]["mute_all"];
          bot('editmessagetext',[
              'chat_id'=>$chatid,
   'message_id'=>$messageid,
             'text'=>"
•• پنل تنظیمات قفلی ربات

• نام گروه | $gpname
• شناسه گروه | $chatid

● قفل فحش با موفقیت غیرفعال شد !
",
             'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
[
 ['text'=>"قفل کاراکتر",'callback_data'=>'character'],['text'=>"قفل خودکار",'callback_data'=>'lockauto'],['text'=>"حساسیت اخطار",'callback_data'=>'warn']
 ],
 [
 ['text'=>" بخش خوشامد گویی",'callback_data'=>'welcome'],['text'=>"قفل همه : $mute_all ",'callback_data'=>'lockall'],['text'=>"حالت سختگیرانه",'callback_data'=>'hardmode']
 ],
 [
 ['text'=>"لينک : $locklink",'callback_data'=>'locklink'],['text'=>" فایل  : $lockdocument",'callback_data'=>'lockdocument']
 ],
 [
 ['text'=>"هشتگ [#] : $locktag",'callback_data'=>'locktag'],['text'=>" گیف: $lockgif",'callback_data'=>'lockgif']
 ],
 [
 ['text'=>"یوزرنیم [@] : $lockusername",'callback_data'=>'lockusername'],['text'=>" پیام ویدیویی  : $lockvideo_note",'callback_data'=>'lockvideo_note']
 ],
 [
 ['text'=>"ویرایش پیام : $lockedit",'callback_data'=>'lockedit'],['text'=>" ارسال مکان  : $locklocation",'callback_data'=>'lockluction']
 ],
 [
 ['text'=>"فحش : $lockfosh",'callback_data'=>'lockfosh'],['text'=>" تصویر  : $lockphoto",'callback_data'=>'lockphoto']
 ],
 [
 ['text'=>"ورود ربات ها : $lockbots",'callback_data'=>'lockbots2'],['text'=>" ارسال شماره  : $lockcontact",'callback_data'=>'lockcontact']
 ],
 [
 ['text'=>"فوروارد : $lockforward",'callback_data'=>'lockforward'],['text'=>" موسیقی  : $lockaudio",'callback_data'=>'lockaudio']
 ],
 [
 ['text'=>"خدمات تلگرام : $locktg",'callback_data'=>'locktg'],['text'=>" صدا  : $lockvoice",'callback_data'=>'lockvoice']
 ],
 [
 ['text'=>"ریپلای : $lockreply",'callback_data'=>'lockreply'],['text'=>" استیکر  : $locksticker",'callback_data'=>'locksticker']
 ],
 [
 ['text'=>"دستورات عمومی : $lockcmd",'callback_data'=>'lockcmd'],
 ],
 [
 ['text'=>" بازی  : $lockgame",'callback_data'=>'lockgame']
 ],
 [
 ['text'=>" فیلم  : $lockvideo",'callback_data'=>'lockvideo']
 ],
 [
 ['text'=>" متن  : $locktext",'callback_data'=>'locktext']
 ],
 [
 ['text'=>"« برگشت »",'callback_data'=>'settings']
 ],
	]
             ])
         ]);
$settings2["lock"]["fosh"] = "Inactive ✗";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		 		 }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
  }
  }
  elseif($data=="lockfosh" && $settings2["lock"]["fosh"] =="Inactive ✗" ){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
$locklink = $settings2["lock"]["link"];
$lockusername = $settings2["lock"]["username"];
$locktag = $settings2["lock"]["tag"];
$lockedit = $settings2["lock"]["edit"];
$lockfosh = $settings2["lock"]["fosh"];
$lockbots = $settings2["lock"]["bot"];
$lockforward = $settings2["lock"]["forward"];
$locktg = $settings2["lock"]["tgservic"];
$lockreply = $settings2["lock"]["reply"];
$lockcmd = $settings2["lock"]["cmd"];
$lockdocument = $settings2["lock"]["document"];
$lockgif = $settings2["lock"]["gif"];
$lockvideo_note = $settings2["lock"]["video_msg"];
$locklocation = $settings2["lock"]["location"];
$lockphoto = $settings2["lock"]["photo"];
$lockcontact = $settings2["lock"]["contact"];
$lockaudio = $settings2["lock"]["audio"];
$lockvoice = $settings2["lock"]["voice"];
$locksticker = $settings2["lock"]["sticker"];
$lockgame = $settings2["lock"]["game"];
$lockvideo = $settings2["lock"]["video"];
$locktext = $settings2["lock"]["text"];
$mute_all = $settings2["lock"]["mute_all"];
          bot('editmessagetext',[
              'chat_id'=>$chatid,
   'message_id'=>$messageid,
             'text'=>"
•• پنل تنظیمات قفلی ربات

• نام گروه | $gpname
• شناسه گروه | $chatid

● قفل فحش با موفقیت فعال شد !",
             'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
[
 ['text'=>"قفل کاراکتر",'callback_data'=>'character'],['text'=>"قفل خودکار",'callback_data'=>'lockauto'],['text'=>"حساسیت اخطار",'callback_data'=>'warn']
 ],
 [
 ['text'=>" بخش خوشامد گویی",'callback_data'=>'welcome'],['text'=>"قفل همه : $mute_all ",'callback_data'=>'lockall'],['text'=>"حالت سختگیرانه",'callback_data'=>'hardmode']
 ],
 [
 ['text'=>"لينک : $locklink",'callback_data'=>'locklink'],['text'=>" فایل  : $lockdocument",'callback_data'=>'lockdocument']
 ],
 [
 ['text'=>"هشتگ [#] : $locktag",'callback_data'=>'locktag'],['text'=>" گیف: $lockgif",'callback_data'=>'lockgif']
 ],
 [
 ['text'=>"یوزرنیم [@] : $lockusername",'callback_data'=>'lockusername'],['text'=>" پیام ویدیویی  : $lockvideo_note",'callback_data'=>'lockvideo_note']
 ],
 [
 ['text'=>"ویرایش پیام : $lockedit",'callback_data'=>'lockedit'],['text'=>" ارسال مکان  : $locklocation",'callback_data'=>'lockluction']
 ],
 [
 ['text'=>"فحش : $lockfosh",'callback_data'=>'lockfosh'],['text'=>" تصویر  : $lockphoto",'callback_data'=>'lockphoto']
 ],
 [
 ['text'=>"ورود ربات ها : $lockbots",'callback_data'=>'lockbots2'],['text'=>" ارسال شماره  : $lockcontact",'callback_data'=>'lockcontact']
 ],
 [
 ['text'=>"فوروارد : $lockforward",'callback_data'=>'lockforward'],['text'=>" موسیقی  : $lockaudio",'callback_data'=>'lockaudio']
 ],
 [
 ['text'=>"خدمات تلگرام : $locktg",'callback_data'=>'locktg'],['text'=>" صدا  : $lockvoice",'callback_data'=>'lockvoice']
 ],
 [
 ['text'=>"ریپلای : $lockreply",'callback_data'=>'lockreply'],['text'=>" استیکر  : $locksticker",'callback_data'=>'locksticker']
 ],
 [
 ['text'=>"دستورات عمومی : $lockcmd",'callback_data'=>'lockcmd'],
 ],
 [
 ['text'=>" بازی  : $lockgame",'callback_data'=>'lockgame']
 ],
 [
 ['text'=>" فیلم  : $lockvideo",'callback_data'=>'lockvideo']
 ],
 [
 ['text'=>" متن  : $locktext",'callback_data'=>'locktext']
 ],
 [
 ['text'=>"« برگشت »",'callback_data'=>'settings']
 ],
	]
             ])
         ]);
$settings2["lock"]["fosh"] = "Active ✓";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		 		 }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
  }
  }
  elseif($data=="lockedit" && $settings2["lock"]["edit"] =="Active ✓"){
			 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
$locklink = $settings2["lock"]["link"];
$lockusername = $settings2["lock"]["username"];
$locktag = $settings2["lock"]["tag"];
$lockedit = $settings2["lock"]["edit"];
$lockfosh = $settings2["lock"]["fosh"];
$lockbots = $settings2["lock"]["bot"];
$lockforward = $settings2["lock"]["forward"];
$locktg = $settings2["lock"]["tgservic"];
$lockreply = $settings2["lock"]["reply"];
$lockcmd = $settings2["lock"]["cmd"];
$lockdocument = $settings2["lock"]["document"];
$lockgif = $settings2["lock"]["gif"];
$lockvideo_note = $settings2["lock"]["video_msg"];
$locklocation = $settings2["lock"]["location"];
$lockphoto = $settings2["lock"]["photo"];
$lockcontact = $settings2["lock"]["contact"];
$lockaudio = $settings2["lock"]["audio"];
$lockvoice = $settings2["lock"]["voice"];
$locksticker = $settings2["lock"]["sticker"];
$lockgame = $settings2["lock"]["game"];
$lockvideo = $settings2["lock"]["video"];
$locktext = $settings2["lock"]["text"];
$mute_all = $settings2["lock"]["mute_all"];
          bot('editmessagetext',[
              'chat_id'=>$chatid,
   'message_id'=>$messageid,
             'text'=>"
•• پنل تنظیمات قفلی ربات

• نام گروه | $gpname
• شناسه گروه | $chatid

● قفل ویرایش پیام با موفقیت غیرفعال شد !",
             'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
[
 ['text'=>"قفل کاراکتر",'callback_data'=>'character'],['text'=>"قفل خودکار",'callback_data'=>'lockauto'],['text'=>"حساسیت اخطار",'callback_data'=>'warn']
 ],
 [
 ['text'=>" بخش خوشامد گویی",'callback_data'=>'welcome'],['text'=>"قفل همه : $mute_all ",'callback_data'=>'lockall'],['text'=>"حالت سختگیرانه",'callback_data'=>'hardmode']
 ],
 [
 ['text'=>"لينک : $locklink",'callback_data'=>'locklink'],['text'=>" فایل  : $lockdocument",'callback_data'=>'lockdocument']
 ],
 [
 ['text'=>"هشتگ [#] : $locktag",'callback_data'=>'locktag'],['text'=>" گیف: $lockgif",'callback_data'=>'lockgif']
 ],
 [
 ['text'=>"یوزرنیم [@] : $lockusername",'callback_data'=>'lockusername'],['text'=>" پیام ویدیویی  : $lockvideo_note",'callback_data'=>'lockvideo_note']
 ],
 [
 ['text'=>"ویرایش پیام : $lockedit",'callback_data'=>'lockedit'],['text'=>" ارسال مکان  : $locklocation",'callback_data'=>'lockluction']
 ],
 [
 ['text'=>"فحش : $lockfosh",'callback_data'=>'lockfosh'],['text'=>" تصویر  : $lockphoto",'callback_data'=>'lockphoto']
 ],
 [
 ['text'=>"ورود ربات ها : $lockbots",'callback_data'=>'lockbots2'],['text'=>" ارسال شماره  : $lockcontact",'callback_data'=>'lockcontact']
 ],
 [
 ['text'=>"فوروارد : $lockforward",'callback_data'=>'lockforward'],['text'=>" موسیقی  : $lockaudio",'callback_data'=>'lockaudio']
 ],
 [
 ['text'=>"خدمات تلگرام : $locktg",'callback_data'=>'locktg'],['text'=>" صدا  : $lockvoice",'callback_data'=>'lockvoice']
 ],
 [
 ['text'=>"ریپلای : $lockreply",'callback_data'=>'lockreply'],['text'=>" استیکر  : $locksticker",'callback_data'=>'locksticker']
 ],
 [
 ['text'=>"دستورات عمومی : $lockcmd",'callback_data'=>'lockcmd'],
 ],
 [
 ['text'=>" بازی  : $lockgame",'callback_data'=>'lockgame']
 ],
 [
 ['text'=>" فیلم  : $lockvideo",'callback_data'=>'lockvideo']
 ],
 [
 ['text'=>" متن  : $locktext",'callback_data'=>'locktext']
 ],
 [
 ['text'=>"« برگشت »",'callback_data'=>'settings']
 ],
	]
             ])
         ]);
$settings2["lock"]["edit"] = "Inactive ✗";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		 		 }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
  }
  }
  elseif($data=="lockedit" && $settings2["lock"]["edit"] =="Inactive ✗"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
$locklink = $settings2["lock"]["link"];
$lockusername = $settings2["lock"]["username"];
$locktag = $settings2["lock"]["tag"];
$lockedit = $settings2["lock"]["edit"];
$lockfosh = $settings2["lock"]["fosh"];
$lockbots = $settings2["lock"]["bot"];
$lockforward = $settings2["lock"]["forward"];
$locktg = $settings2["lock"]["tgservic"];
$lockreply = $settings2["lock"]["reply"];
$lockcmd = $settings2["lock"]["cmd"];
$lockdocument = $settings2["lock"]["document"];
$lockgif = $settings2["lock"]["gif"];
$lockvideo_note = $settings2["lock"]["video_msg"];
$locklocation = $settings2["lock"]["location"];
$lockphoto = $settings2["lock"]["photo"];
$lockcontact = $settings2["lock"]["contact"];
$lockaudio = $settings2["lock"]["audio"];
$lockvoice = $settings2["lock"]["voice"];
$locksticker = $settings2["lock"]["sticker"];
$lockgame = $settings2["lock"]["game"];
$lockvideo = $settings2["lock"]["video"];
$locktext = $settings2["lock"]["text"];
$mute_all = $settings2["lock"]["mute_all"];
          bot('editmessagetext',[
              'chat_id'=>$chatid,
   'message_id'=>$messageid,
             'text'=>"
•• پنل تنظیمات قفلی ربات

• نام گروه | $gpname
• شناسه گروه | $chatid

● قفل ویرایش پیام با موفقیت فعال شد !
",
             'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
[
 ['text'=>"قفل کاراکتر",'callback_data'=>'character'],['text'=>"قفل خودکار",'callback_data'=>'lockauto'],['text'=>"حساسیت اخطار",'callback_data'=>'warn']
 ],
 [
 ['text'=>" بخش خوشامد گویی",'callback_data'=>'welcome'],['text'=>"قفل همه : $mute_all ",'callback_data'=>'lockall'],['text'=>"حالت سختگیرانه",'callback_data'=>'hardmode']
 ],
 [
 ['text'=>"لينک : $locklink",'callback_data'=>'locklink'],['text'=>" فایل  : $lockdocument",'callback_data'=>'lockdocument']
 ],
 [
 ['text'=>"هشتگ [#] : $locktag",'callback_data'=>'locktag'],['text'=>" گیف: $lockgif",'callback_data'=>'lockgif']
 ],
 [
 ['text'=>"یوزرنیم [@] : $lockusername",'callback_data'=>'lockusername'],['text'=>" پیام ویدیویی  : $lockvideo_note",'callback_data'=>'lockvideo_note']
 ],
 [
 ['text'=>"ویرایش پیام : $lockedit",'callback_data'=>'lockedit'],['text'=>" ارسال مکان  : $locklocation",'callback_data'=>'lockluction']
 ],
 [
 ['text'=>"فحش : $lockfosh",'callback_data'=>'lockfosh'],['text'=>" تصویر  : $lockphoto",'callback_data'=>'lockphoto']
 ],
 [
 ['text'=>"ورود ربات ها : $lockbots",'callback_data'=>'lockbots2'],['text'=>" ارسال شماره  : $lockcontact",'callback_data'=>'lockcontact']
 ],
 [
 ['text'=>"فوروارد : $lockforward",'callback_data'=>'lockforward'],['text'=>" موسیقی  : $lockaudio",'callback_data'=>'lockaudio']
 ],
 [
 ['text'=>"خدمات تلگرام : $locktg",'callback_data'=>'locktg'],['text'=>" صدا  : $lockvoice",'callback_data'=>'lockvoice']
 ],
 [
 ['text'=>"ریپلای : $lockreply",'callback_data'=>'lockreply'],['text'=>" استیکر  : $locksticker",'callback_data'=>'locksticker']
 ],
 [
 ['text'=>"دستورات عمومی : $lockcmd",'callback_data'=>'lockcmd'],
 ],
 [
 ['text'=>" بازی  : $lockgame",'callback_data'=>'lockgame']
 ],
 [
 ['text'=>" فیلم  : $lockvideo",'callback_data'=>'lockvideo']
 ],
 [
 ['text'=>" متن  : $locktext",'callback_data'=>'locktext']
 ],
 [
 ['text'=>"« برگشت »",'callback_data'=>'settings']
 ],
	]
             ])
         ]);
$settings2["lock"]["edit"] = "Active ✓";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		 		 }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
  }
  }
  elseif($data=="lockusername" && $settings2["lock"]["username"] =="Active ✓"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
$locklink = $settings2["lock"]["link"];
$lockusername = $settings2["lock"]["username"];
$locktag = $settings2["lock"]["tag"];
$lockedit = $settings2["lock"]["edit"];
$lockfosh = $settings2["lock"]["fosh"];
$lockbots = $settings2["lock"]["bot"];
$lockforward = $settings2["lock"]["forward"];
$locktg = $settings2["lock"]["tgservic"];
$lockreply = $settings2["lock"]["reply"];
$lockcmd = $settings2["lock"]["cmd"];
$lockdocument = $settings2["lock"]["document"];
$lockgif = $settings2["lock"]["gif"];
$lockvideo_note = $settings2["lock"]["video_msg"];
$locklocation = $settings2["lock"]["location"];
$lockphoto = $settings2["lock"]["photo"];
$lockcontact = $settings2["lock"]["contact"];
$lockaudio = $settings2["lock"]["audio"];
$lockvoice = $settings2["lock"]["voice"];
$locksticker = $settings2["lock"]["sticker"];
$lockgame = $settings2["lock"]["game"];
$lockvideo = $settings2["lock"]["video"];
$locktext = $settings2["lock"]["text"];
$mute_all = $settings2["lock"]["mute_all"];
          bot('editmessagetext',[
              'chat_id'=>$chatid,
   'message_id'=>$messageid,
             'text'=>"
•• پنل تنظیمات قفلی ربات

• نام گروه | $gpname
• شناسه گروه | $chatid

● قفل تگ با موفقیت غیرفعال شد !",
             'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
[
 ['text'=>"قفل کاراکتر",'callback_data'=>'character'],['text'=>"قفل خودکار",'callback_data'=>'lockauto'],['text'=>"حساسیت اخطار",'callback_data'=>'warn']
 ],
 [
 ['text'=>" بخش خوشامد گویی",'callback_data'=>'welcome'],['text'=>"قفل همه : $mute_all ",'callback_data'=>'lockall'],['text'=>"حالت سختگیرانه",'callback_data'=>'hardmode']
 ],
 [
 ['text'=>"لينک : $locklink",'callback_data'=>'locklink'],['text'=>" فایل  : $lockdocument",'callback_data'=>'lockdocument']
 ],
 [
 ['text'=>"هشتگ [#] : $locktag",'callback_data'=>'locktag'],['text'=>" گیف: $lockgif",'callback_data'=>'lockgif']
 ],
 [
 ['text'=>"یوزرنیم [@] : $lockusername",'callback_data'=>'lockusername'],['text'=>" پیام ویدیویی  : $lockvideo_note",'callback_data'=>'lockvideo_note']
 ],
 [
 ['text'=>"ویرایش پیام : $lockedit",'callback_data'=>'lockedit'],['text'=>" ارسال مکان  : $locklocation",'callback_data'=>'lockluction']
 ],
 [
 ['text'=>"فحش : $lockfosh",'callback_data'=>'lockfosh'],['text'=>" تصویر  : $lockphoto",'callback_data'=>'lockphoto']
 ],
 [
 ['text'=>"ورود ربات ها : $lockbots",'callback_data'=>'lockbots2'],['text'=>" ارسال شماره  : $lockcontact",'callback_data'=>'lockcontact']
 ],
 [
 ['text'=>"فوروارد : $lockforward",'callback_data'=>'lockforward'],['text'=>" موسیقی  : $lockaudio",'callback_data'=>'lockaudio']
 ],
 [
 ['text'=>"خدمات تلگرام : $locktg",'callback_data'=>'locktg'],['text'=>" صدا  : $lockvoice",'callback_data'=>'lockvoice']
 ],
 [
 ['text'=>"ریپلای : $lockreply",'callback_data'=>'lockreply'],['text'=>" استیکر  : $locksticker",'callback_data'=>'locksticker']
 ],
 [
 ['text'=>"دستورات عمومی : $lockcmd",'callback_data'=>'lockcmd'],
 ],
 [
 ['text'=>" بازی  : $lockgame",'callback_data'=>'lockgame']
 ],
 [
 ['text'=>" فیلم  : $lockvideo",'callback_data'=>'lockvideo']
 ],
 [
 ['text'=>" متن  : $locktext",'callback_data'=>'locktext']
 ],
 [
 ['text'=>"« برگشت »",'callback_data'=>'settings']
 ],
	]
             ])
         ]);
$settings2["lock"]["username"] = "Inactive ✗";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		 		 }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
  }
  }
  elseif($data=="lockusername" && $settings2["lock"]["username"] =="Inactive ✗"){
			 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
$locklink = $settings2["lock"]["link"];
$lockusername = $settings2["lock"]["username"];
$locktag = $settings2["lock"]["tag"];
$lockedit = $settings2["lock"]["edit"];
$lockfosh = $settings2["lock"]["fosh"];
$lockbots = $settings2["lock"]["bot"];
$lockforward = $settings2["lock"]["forward"];
$locktg = $settings2["lock"]["tgservic"];
$lockreply = $settings2["lock"]["reply"];
$lockcmd = $settings2["lock"]["cmd"];
$lockdocument = $settings2["lock"]["document"];
$lockgif = $settings2["lock"]["gif"];
$lockvideo_note = $settings2["lock"]["video_msg"];
$locklocation = $settings2["lock"]["location"];
$lockphoto = $settings2["lock"]["photo"];
$lockcontact = $settings2["lock"]["contact"];
$lockaudio = $settings2["lock"]["audio"];
$lockvoice = $settings2["lock"]["voice"];
$locksticker = $settings2["lock"]["sticker"];
$lockgame = $settings2["lock"]["game"];
$lockvideo = $settings2["lock"]["video"];
$locktext = $settings2["lock"]["text"];
$mute_all = $settings2["lock"]["mute_all"];
          bot('editmessagetext',[
              'chat_id'=>$chatid,
   'message_id'=>$messageid,
             'text'=>"
•• پنل تنظیمات قفلی ربات

• نام گروه | $gpname
• شناسه گروه | $chatid

● قفل تگ با موفقیت فعال شد !
",
             'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
[
 ['text'=>"قفل کاراکتر",'callback_data'=>'character'],['text'=>"قفل خودکار",'callback_data'=>'lockauto'],['text'=>"حساسیت اخطار",'callback_data'=>'warn']
 ],
 [
 ['text'=>" بخش خوشامد گویی",'callback_data'=>'welcome'],['text'=>"قفل همه : $mute_all ",'callback_data'=>'lockall'],['text'=>"حالت سختگیرانه",'callback_data'=>'hardmode']
 ],
 [
 ['text'=>"لينک : $locklink",'callback_data'=>'locklink'],['text'=>" فایل  : $lockdocument",'callback_data'=>'lockdocument']
 ],
 [
 ['text'=>"هشتگ [#] : $locktag",'callback_data'=>'locktag'],['text'=>" گیف: $lockgif",'callback_data'=>'lockgif']
 ],
 [
 ['text'=>"یوزرنیم [@] : $lockusername",'callback_data'=>'lockusername'],['text'=>" پیام ویدیویی  : $lockvideo_note",'callback_data'=>'lockvideo_note']
 ],
 [
 ['text'=>"ویرایش پیام : $lockedit",'callback_data'=>'lockedit'],['text'=>" ارسال مکان  : $locklocation",'callback_data'=>'lockluction']
 ],
 [
 ['text'=>"فحش : $lockfosh",'callback_data'=>'lockfosh'],['text'=>" تصویر  : $lockphoto",'callback_data'=>'lockphoto']
 ],
 [
 ['text'=>"ورود ربات ها : $lockbots",'callback_data'=>'lockbots2'],['text'=>" ارسال شماره  : $lockcontact",'callback_data'=>'lockcontact']
 ],
 [
 ['text'=>"فوروارد : $lockforward",'callback_data'=>'lockforward'],['text'=>" موسیقی  : $lockaudio",'callback_data'=>'lockaudio']
 ],
 [
 ['text'=>"خدمات تلگرام : $locktg",'callback_data'=>'locktg'],['text'=>" صدا  : $lockvoice",'callback_data'=>'lockvoice']
 ],
 [
 ['text'=>"ریپلای : $lockreply",'callback_data'=>'lockreply'],['text'=>" استیکر  : $locksticker",'callback_data'=>'locksticker']
 ],
 [
 ['text'=>"دستورات عمومی : $lockcmd",'callback_data'=>'lockcmd'],
 ],
 [
 ['text'=>" بازی  : $lockgame",'callback_data'=>'lockgame']
 ],
 [
 ['text'=>" فیلم  : $lockvideo",'callback_data'=>'lockvideo']
 ],
 [
 ['text'=>" متن  : $locktext",'callback_data'=>'locktext']
 ],
 [
 ['text'=>"« برگشت »",'callback_data'=>'settings']
 ],
	]
             ])
         ]);
$settings2["lock"]["username"] = "Active ✓";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		 		 }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
  }
  }
if($data=="locklink" && $settings2["lock"]["link"] == "Active ✓"){
if($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev)){
$locklink = $settings2["lock"]["link"];
$lockusername = $settings2["lock"]["username"];
$locktag = $settings2["lock"]["tag"];
$lockedit = $settings2["lock"]["edit"];
$lockfosh = $settings2["lock"]["fosh"];
$lockbots = $settings2["lock"]["bot"];
$lockforward = $settings2["lock"]["forward"];
$locktg = $settings2["lock"]["tgservic"];
$lockreply = $settings2["lock"]["reply"];
$lockcmd = $settings2["lock"]["cmd"];
$lockdocument = $settings2["lock"]["document"];
$lockgif = $settings2["lock"]["gif"];
$lockvideo_note = $settings2["lock"]["video_msg"];
$locklocation = $settings2["lock"]["location"];
$lockphoto = $settings2["lock"]["photo"];
$lockcontact = $settings2["lock"]["contact"];
$lockaudio = $settings2["lock"]["audio"];
$lockvoice = $settings2["lock"]["voice"];
$locksticker = $settings2["lock"]["sticker"];
$lockgame = $settings2["lock"]["game"];
$lockvideo = $settings2["lock"]["video"];
$locktext = $settings2["lock"]["text"];
$mute_all = $settings2["lock"]["mute_all"];
          bot('editmessagetext',[
              'chat_id'=>$chatid,
   'message_id'=>$messageid,
             'text'=>"
•• پنل تنظیمات قفلی ربات

• نام گروه | $gpname
• شناسه گروه | $chatid

● قفل لینک با موفقیت غیرفعال شد !",
             'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
[
 ['text'=>"قفل کاراکتر",'callback_data'=>'character'],['text'=>"قفل خودکار",'callback_data'=>'lockauto'],['text'=>"حساسیت اخطار",'callback_data'=>'warn']
 ],
 [
 ['text'=>" بخش خوشامد گویی",'callback_data'=>'welcome'],['text'=>"قفل همه : $mute_all ",'callback_data'=>'lockall'],['text'=>"حالت سختگیرانه",'callback_data'=>'hardmode']
 ],
 [
 ['text'=>"لينک : $locklink",'callback_data'=>'locklink'],['text'=>" فایل  : $lockdocument",'callback_data'=>'lockdocument']
 ],
 [
 ['text'=>"هشتگ [#] : $locktag",'callback_data'=>'locktag'],['text'=>" گیف: $lockgif",'callback_data'=>'lockgif']
 ],
 [
 ['text'=>"یوزرنیم [@] : $lockusername",'callback_data'=>'lockusername'],['text'=>" پیام ویدیویی  : $lockvideo_note",'callback_data'=>'lockvideo_note']
 ],
 [
 ['text'=>"ویرایش پیام : $lockedit",'callback_data'=>'lockedit'],['text'=>" ارسال مکان  : $locklocation",'callback_data'=>'lockluction']
 ],
 [
 ['text'=>"فحش : $lockfosh",'callback_data'=>'lockfosh'],['text'=>" تصویر  : $lockphoto",'callback_data'=>'lockphoto']
 ],
 [
 ['text'=>"ورود ربات ها : $lockbots",'callback_data'=>'lockbots2'],['text'=>" ارسال شماره  : $lockcontact",'callback_data'=>'lockcontact']
 ],
 [
 ['text'=>"فوروارد : $lockforward",'callback_data'=>'lockforward'],['text'=>" موسیقی  : $lockaudio",'callback_data'=>'lockaudio']
 ],
 [
 ['text'=>"خدمات تلگرام : $locktg",'callback_data'=>'locktg'],['text'=>" صدا  : $lockvoice",'callback_data'=>'lockvoice']
 ],
 [
 ['text'=>"ریپلای : $lockreply",'callback_data'=>'lockreply'],['text'=>" استیکر  : $locksticker",'callback_data'=>'locksticker']
 ],
 [
 ['text'=>"دستورات عمومی : $lockcmd",'callback_data'=>'lockcmd'],
 ],
 [
 ['text'=>" بازی  : $lockgame",'callback_data'=>'lockgame']
 ],
 [
 ['text'=>" فیلم  : $lockvideo",'callback_data'=>'lockvideo']
 ],
 [
 ['text'=>" متن  : $locktext",'callback_data'=>'locktext']
 ],
 [
 ['text'=>"« برگشت »",'callback_data'=>'settings']
 ],
                  	]
             ])
         ]);
$settings2["lock"]["link"] = "Inactive ✗";
$settings2 = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings2);
		 		 }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
  }
  }
  elseif($data=="locklink" && $settings2["lock"]["link"] == "Inactive ✗"){
if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev)){
$locklink = $settings2["lock"]["link"];
$lockusername = $settings2["lock"]["username"];
$locktag = $settings2["lock"]["tag"];
$lockedit = $settings2["lock"]["edit"];
$lockfosh = $settings2["lock"]["fosh"];
$lockbots = $settings2["lock"]["bot"];
$lockforward = $settings2["lock"]["forward"];
$locktg = $settings2["lock"]["tgservic"];
$lockreply = $settings2["lock"]["reply"];
$lockcmd = $settings2["lock"]["cmd"];
$lockdocument = $settings2["lock"]["document"];
$lockgif = $settings2["lock"]["gif"];
$lockvideo_note = $settings2["lock"]["video_msg"];
$locklocation = $settings2["lock"]["location"];
$lockphoto = $settings2["lock"]["photo"];
$lockcontact = $settings2["lock"]["contact"];
$lockaudio = $settings2["lock"]["audio"];
$lockvoice = $settings2["lock"]["voice"];
$locksticker = $settings2["lock"]["sticker"];
$lockgame = $settings2["lock"]["game"];
$lockvideo = $settings2["lock"]["video"];
$locktext = $settings2["lock"]["text"];
$mute_all = $settings2["lock"]["mute_all"];
          bot('editmessagetext',[
              'chat_id'=>$chatid,
   'message_id'=>$messageid,
             'text'=>"
•• پنل تنظیمات قفلی ربات

• نام گروه | $gpname
• شناسه گروه | $chatid

● قفل لینک با موفقیت فعال شد !",
             'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
[
 ['text'=>"قفل کاراکتر",'callback_data'=>'character'],['text'=>"قفل خودکار",'callback_data'=>'lockauto'],['text'=>"حساسیت اخطار",'callback_data'=>'warn']
 ],
 [
 ['text'=>" بخش خوشامد گویی",'callback_data'=>'welcome'],['text'=>"قفل همه : $mute_all ",'callback_data'=>'lockall'],['text'=>"حالت سختگیرانه",'callback_data'=>'hardmode']
 ],
 [
 ['text'=>"لينک : $locklink",'callback_data'=>'locklink'],['text'=>" فایل  : $lockdocument",'callback_data'=>'lockdocument']
 ],
 [
 ['text'=>"هشتگ [#] : $locktag",'callback_data'=>'locktag'],['text'=>" گیف: $lockgif",'callback_data'=>'lockgif']
 ],
 [
 ['text'=>"یوزرنیم [@] : $lockusername",'callback_data'=>'lockusername'],['text'=>" پیام ویدیویی  : $lockvideo_note",'callback_data'=>'lockvideo_note']
 ],
 [
 ['text'=>"ویرایش پیام : $lockedit",'callback_data'=>'lockedit'],['text'=>" ارسال مکان  : $locklocation",'callback_data'=>'lockluction']
 ],
 [
 ['text'=>"فحش : $lockfosh",'callback_data'=>'lockfosh'],['text'=>" تصویر  : $lockphoto",'callback_data'=>'lockphoto']
 ],
 [
 ['text'=>"ورود ربات ها : $lockbots",'callback_data'=>'lockbots2'],['text'=>" ارسال شماره  : $lockcontact",'callback_data'=>'lockcontact']
 ],
 [
 ['text'=>"فوروارد : $lockforward",'callback_data'=>'lockforward'],['text'=>" موسیقی  : $lockaudio",'callback_data'=>'lockaudio']
 ],
 [
 ['text'=>"خدمات تلگرام : $locktg",'callback_data'=>'locktg'],['text'=>" صدا  : $lockvoice",'callback_data'=>'lockvoice']
 ],
 [
 ['text'=>"ریپلای : $lockreply",'callback_data'=>'lockreply'],['text'=>" استیکر  : $locksticker",'callback_data'=>'locksticker']
 ],
 [
 ['text'=>"دستورات عمومی : $lockcmd",'callback_data'=>'lockcmd'],
 ],
 [
 ['text'=>" بازی  : $lockgame",'callback_data'=>'lockgame']
 ],
 [
 ['text'=>" فیلم  : $lockvideo",'callback_data'=>'lockvideo']
 ],
 [
 ['text'=>" متن  : $locktext",'callback_data'=>'locktext']
 ],
 [
 ['text'=>"« برگشت »",'callback_data'=>'settings']
 ],
                  	]
             ])
         ]);
$settings2["lock"]["link"] = "Active ✓";
$settings2 = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings2);
		 		 }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
  }
  }
  elseif($data=="lockbots2" && $settings2["lock"]["bot"] =="Active ✓"){
			 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
$locklink = $settings2["lock"]["link"];
$lockusername = $settings2["lock"]["username"];
$locktag = $settings2["lock"]["tag"];
$lockedit = $settings2["lock"]["edit"];
$lockfosh = $settings2["lock"]["fosh"];
$lockbots = $settings2["lock"]["bot"];
$lockforward = $settings2["lock"]["forward"];
$locktg = $settings2["lock"]["tgservic"];
$lockreply = $settings2["lock"]["reply"];
$lockcmd = $settings2["lock"]["cmd"];
$lockdocument = $settings2["lock"]["document"];
$lockgif = $settings2["lock"]["gif"];
$lockvideo_note = $settings2["lock"]["video_msg"];
$locklocation = $settings2["lock"]["location"];
$lockphoto = $settings2["lock"]["photo"];
$lockcontact = $settings2["lock"]["contact"];
$lockaudio = $settings2["lock"]["audio"];
$lockvoice = $settings2["lock"]["voice"];
$locksticker = $settings2["lock"]["sticker"];
$lockgame = $settings2["lock"]["game"];
$lockvideo = $settings2["lock"]["video"];
$locktext = $settings2["lock"]["text"];
$mute_all = $settings2["lock"]["mute_all"];
          bot('editmessagetext',[
              'chat_id'=>$chatid,
   'message_id'=>$messageid,
             'text'=>"
•• پنل تنظیمات قفلی ربات

• نام گروه | $gpname
• شناسه گروه | $chatid

● قفل ورود ربات با موفقیت غیرفعال شد !
",
             'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
[
 ['text'=>"قفل کاراکتر",'callback_data'=>'character'],['text'=>"قفل خودکار",'callback_data'=>'lockauto'],['text'=>"حساسیت اخطار",'callback_data'=>'warn']
 ],
 [
 ['text'=>" بخش خوشامد گویی",'callback_data'=>'welcome'],['text'=>"قفل همه : $mute_all ",'callback_data'=>'lockall'],['text'=>"حالت سختگیرانه",'callback_data'=>'hardmode']
 ],
 [
 ['text'=>"لينک : $locklink",'callback_data'=>'locklink'],['text'=>" فایل  : $lockdocument",'callback_data'=>'lockdocument']
 ],
 [
 ['text'=>"هشتگ [#] : $locktag",'callback_data'=>'locktag'],['text'=>" گیف: $lockgif",'callback_data'=>'lockgif']
 ],
 [
 ['text'=>"یوزرنیم [@] : $lockusername",'callback_data'=>'lockusername'],['text'=>" پیام ویدیویی  : $lockvideo_note",'callback_data'=>'lockvideo_note']
 ],
 [
 ['text'=>"ویرایش پیام : $lockedit",'callback_data'=>'lockedit'],['text'=>" ارسال مکان  : $locklocation",'callback_data'=>'lockluction']
 ],
 [
 ['text'=>"فحش : $lockfosh",'callback_data'=>'lockfosh'],['text'=>" تصویر  : $lockphoto",'callback_data'=>'lockphoto']
 ],
 [
 ['text'=>"ورود ربات ها : $lockbots",'callback_data'=>'lockbots2'],['text'=>" ارسال شماره  : $lockcontact",'callback_data'=>'lockcontact']
 ],
 [
 ['text'=>"فوروارد : $lockforward",'callback_data'=>'lockforward'],['text'=>" موسیقی  : $lockaudio",'callback_data'=>'lockaudio']
 ],
 [
 ['text'=>"خدمات تلگرام : $locktg",'callback_data'=>'locktg'],['text'=>" صدا  : $lockvoice",'callback_data'=>'lockvoice']
 ],
 [
 ['text'=>"ریپلای : $lockreply",'callback_data'=>'lockreply'],['text'=>" استیکر  : $locksticker",'callback_data'=>'locksticker']
 ],
 [
 ['text'=>"دستورات عمومی : $lockcmd",'callback_data'=>'lockcmd'],
 ],
 [
 ['text'=>" بازی  : $lockgame",'callback_data'=>'lockgame']
 ],
 [
 ['text'=>" فیلم  : $lockvideo",'callback_data'=>'lockvideo']
 ],
 [
 ['text'=>" متن  : $locktext",'callback_data'=>'locktext']
 ],
 [
 ['text'=>"« برگشت »",'callback_data'=>'settings']
 ],
                    ]
             ])
         ]);
$settings2["lock"]["bot"] = "Inactive ✗";
$settings2 = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings2);
		 		 }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
  }
  }
  elseif($data=="lockbots2" && $settings2["lock"]["bot"] == "Inactive ✗"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
$locklink = $settings2["lock"]["link"];
$lockusername = $settings2["lock"]["username"];
$locktag = $settings2["lock"]["tag"];
$lockedit = $settings2["lock"]["edit"];
$lockfosh = $settings2["lock"]["fosh"];
$lockbots = $settings2["lock"]["bot"];
$lockforward = $settings2["lock"]["forward"];
$locktg = $settings2["lock"]["tgservic"];
$lockreply = $settings2["lock"]["reply"];
$lockcmd = $settings2["lock"]["cmd"];
$lockdocument = $settings2["lock"]["document"];
$lockgif = $settings2["lock"]["gif"];
$lockvideo_note = $settings2["lock"]["video_msg"];
$locklocation = $settings2["lock"]["location"];
$lockphoto = $settings2["lock"]["photo"];
$lockcontact = $settings2["lock"]["contact"];
$lockaudio = $settings2["lock"]["audio"];
$lockvoice = $settings2["lock"]["voice"];
$locksticker = $settings2["lock"]["sticker"];
$lockgame = $settings2["lock"]["game"];
$lockvideo = $settings2["lock"]["video"];
$locktext = $settings2["lock"]["text"];
$mute_all = $settings2["lock"]["mute_all"];
          bot('editmessagetext',[
              'chat_id'=>$chatid,
   'message_id'=>$messageid,
             'text'=>"
•• پنل تنظیمات قفلی ربات

• نام گروه | $gpname
• شناسه گروه | $chatid

● قفل ورود ربات با موفقیت فعال شد !",
             'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
[
 ['text'=>"قفل کاراکتر",'callback_data'=>'character'],['text'=>"قفل خودکار",'callback_data'=>'lockauto'],['text'=>"حساسیت اخطار",'callback_data'=>'warn']
 ],
 [
 ['text'=>" بخش خوشامد گویی",'callback_data'=>'welcome'],['text'=>"قفل همه : $mute_all ",'callback_data'=>'lockall'],['text'=>"حالت سختگیرانه",'callback_data'=>'hardmode']
 ],
 [
 ['text'=>"لينک : $locklink",'callback_data'=>'locklink'],['text'=>" فایل  : $lockdocument",'callback_data'=>'lockdocument']
 ],
 [
 ['text'=>"هشتگ [#] : $locktag",'callback_data'=>'locktag'],['text'=>" گیف: $lockgif",'callback_data'=>'lockgif']
 ],
 [
 ['text'=>"یوزرنیم [@] : $lockusername",'callback_data'=>'lockusername'],['text'=>" پیام ویدیویی  : $lockvideo_note",'callback_data'=>'lockvideo_note']
 ],
 [
 ['text'=>"ویرایش پیام : $lockedit",'callback_data'=>'lockedit'],['text'=>" ارسال مکان  : $locklocation",'callback_data'=>'lockluction']
 ],
 [
 ['text'=>"فحش : $lockfosh",'callback_data'=>'lockfosh'],['text'=>" تصویر  : $lockphoto",'callback_data'=>'lockphoto']
 ],
 [
 ['text'=>"ورود ربات ها : $lockbots",'callback_data'=>'lockbots2'],['text'=>" ارسال شماره  : $lockcontact",'callback_data'=>'lockcontact']
 ],
 [
 ['text'=>"فوروارد : $lockforward",'callback_data'=>'lockforward'],['text'=>" موسیقی  : $lockaudio",'callback_data'=>'lockaudio']
 ],
 [
 ['text'=>"خدمات تلگرام : $locktg",'callback_data'=>'locktg'],['text'=>" صدا  : $lockvoice",'callback_data'=>'lockvoice']
 ],
 [
 ['text'=>"ریپلای : $lockreply",'callback_data'=>'lockreply'],['text'=>" استیکر  : $locksticker",'callback_data'=>'locksticker']
 ],
 [
 ['text'=>"دستورات عمومی : $lockcmd",'callback_data'=>'lockcmd'],
 ],
 [
 ['text'=>" بازی  : $lockgame",'callback_data'=>'lockgame']
 ],
 [
 ['text'=>" فیلم  : $lockvideo",'callback_data'=>'lockvideo']
 ],
 [
 ['text'=>" متن  : $locktext",'callback_data'=>'locktext']
 ],
 [
 ['text'=>"« برگشت »",'callback_data'=>'settings']
 ],
                    ]
             ])
         ]);
$settings2["lock"]["bot"] = "Active ✓";
$settings2 = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings2);
		 		 }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
  }
  }
      elseif($data=="lockdocument" &&  $settings2["lock"]["document"] =="Active ✓"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
$locklink = $settings2["lock"]["link"];
$lockusername = $settings2["lock"]["username"];
$locktag = $settings2["lock"]["tag"];
$lockedit = $settings2["lock"]["edit"];
$lockfosh = $settings2["lock"]["fosh"];
$lockbots = $settings2["lock"]["bot"];
$lockforward = $settings2["lock"]["forward"];
$locktg = $settings2["lock"]["tgservic"];
$lockreply = $settings2["lock"]["reply"];
$lockcmd = $settings2["lock"]["cmd"];
$lockdocument = $settings2["lock"]["document"];
$lockgif = $settings2["lock"]["gif"];
$lockvideo_note = $settings2["lock"]["video_msg"];
$locklocation = $settings2["lock"]["location"];
$lockphoto = $settings2["lock"]["photo"];
$lockcontact = $settings2["lock"]["contact"];
$lockaudio = $settings2["lock"]["audio"];
$lockvoice = $settings2["lock"]["voice"];
$locksticker = $settings2["lock"]["sticker"];
$lockgame = $settings2["lock"]["game"];
$lockvideo = $settings2["lock"]["video"];
$locktext = $settings2["lock"]["text"];
$mute_all = $settings2["lock"]["mute_all"];
          bot('editmessagetext',[
              'chat_id'=>$chatid,
   'message_id'=>$messageid,
             'text'=>"
•• پنل تنظیمات قفلی ربات

• نام گروه | $gpname
• شناسه گروه | $chatid

● قفل فایل با موفقیت غیرفعال شد !
",
             'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
[
 ['text'=>"قفل کاراکتر",'callback_data'=>'character'],['text'=>"قفل خودکار",'callback_data'=>'lockauto'],['text'=>"حساسیت اخطار",'callback_data'=>'warn']
 ],
 [
 ['text'=>" بخش خوشامد گویی",'callback_data'=>'welcome'],['text'=>"قفل همه : $mute_all ",'callback_data'=>'lockall'],['text'=>"حالت سختگیرانه",'callback_data'=>'hardmode']
 ],
 [
 ['text'=>"لينک : $locklink",'callback_data'=>'locklink'],['text'=>" فایل  : $lockdocument",'callback_data'=>'lockdocument']
 ],
 [
 ['text'=>"هشتگ [#] : $locktag",'callback_data'=>'locktag'],['text'=>" گیف: $lockgif",'callback_data'=>'lockgif']
 ],
 [
 ['text'=>"یوزرنیم [@] : $lockusername",'callback_data'=>'lockusername'],['text'=>" پیام ویدیویی  : $lockvideo_note",'callback_data'=>'lockvideo_note']
 ],
 [
 ['text'=>"ویرایش پیام : $lockedit",'callback_data'=>'lockedit'],['text'=>" ارسال مکان  : $locklocation",'callback_data'=>'lockluction']
 ],
 [
 ['text'=>"فحش : $lockfosh",'callback_data'=>'lockfosh'],['text'=>" تصویر  : $lockphoto",'callback_data'=>'lockphoto']
 ],
 [
 ['text'=>"ورود ربات ها : $lockbots",'callback_data'=>'lockbots2'],['text'=>" ارسال شماره  : $lockcontact",'callback_data'=>'lockcontact']
 ],
 [
 ['text'=>"فوروارد : $lockforward",'callback_data'=>'lockforward'],['text'=>" موسیقی  : $lockaudio",'callback_data'=>'lockaudio']
 ],
 [
 ['text'=>"خدمات تلگرام : $locktg",'callback_data'=>'locktg'],['text'=>" صدا  : $lockvoice",'callback_data'=>'lockvoice']
 ],
 [
 ['text'=>"ریپلای : $lockreply",'callback_data'=>'lockreply'],['text'=>" استیکر  : $locksticker",'callback_data'=>'locksticker']
 ],
 [
 ['text'=>"دستورات عمومی : $lockcmd",'callback_data'=>'lockcmd'],
 ],
 [
 ['text'=>" بازی  : $lockgame",'callback_data'=>'lockgame']
 ],
 [
 ['text'=>" فیلم  : $lockvideo",'callback_data'=>'lockvideo']
 ],
 [
 ['text'=>" متن  : $locktext",'callback_data'=>'locktext']
 ],
 [
 ['text'=>"« برگشت",'callback_data'=>'settings']
 ],
                    ]
             ])
         ]);
$settings2["lock"]["document"] = "Inactive ✗";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		 		 }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
  }
	  }
  elseif($data=="lockdocument" && $settings2["lock"]["document"] =="Inactive ✗"){
			 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
$locklink = $settings2["lock"]["link"];
$lockusername = $settings2["lock"]["username"];
$locktag = $settings2["lock"]["tag"];
$lockedit = $settings2["lock"]["edit"];
$lockfosh = $settings2["lock"]["fosh"];
$lockbots = $settings2["lock"]["bot"];
$lockforward = $settings2["lock"]["forward"];
$locktg = $settings2["lock"]["tgservic"];
$lockreply = $settings2["lock"]["reply"];
$lockcmd = $settings2["lock"]["cmd"];
$lockdocument = $settings2["lock"]["document"];
$lockgif = $settings2["lock"]["gif"];
$lockvideo_note = $settings2["lock"]["video_msg"];
$locklocation = $settings2["lock"]["location"];
$lockphoto = $settings2["lock"]["photo"];
$lockcontact = $settings2["lock"]["contact"];
$lockaudio = $settings2["lock"]["audio"];
$lockvoice = $settings2["lock"]["voice"];
$locksticker = $settings2["lock"]["sticker"];
$lockgame = $settings2["lock"]["game"];
$lockvideo = $settings2["lock"]["video"];
$locktext = $settings2["lock"]["text"];
$mute_all = $settings2["lock"]["mute_all"];
          bot('editmessagetext',[
              'chat_id'=>$chatid,
   'message_id'=>$messageid,
             'text'=>"
•• پنل تنظیمات قفلی ربات

• نام گروه | $gpname
• شناسه گروه | $chatid

● قفل فایل با موفقیت فعال شد !
",
             'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
[
 ['text'=>"قفل کاراکتر",'callback_data'=>'character'],['text'=>"قفل خودکار",'callback_data'=>'lockauto'],['text'=>"حساسیت اخطار",'callback_data'=>'warn']
 ],
 [
 ['text'=>" بخش خوشامد گویی",'callback_data'=>'welcome'],['text'=>"قفل همه : $mute_all ",'callback_data'=>'lockall'],['text'=>"حالت سختگیرانه",'callback_data'=>'hardmode']
 ],
 [
 ['text'=>"لينک : $locklink",'callback_data'=>'locklink'],['text'=>" فایل  : $lockdocument",'callback_data'=>'lockdocument']
 ],
 [
 ['text'=>"هشتگ [#] : $locktag",'callback_data'=>'locktag'],['text'=>" گیف: $lockgif",'callback_data'=>'lockgif']
 ],
 [
 ['text'=>"یوزرنیم [@] : $lockusername",'callback_data'=>'lockusername'],['text'=>" پیام ویدیویی  : $lockvideo_note",'callback_data'=>'lockvideo_note']
 ],
 [
 ['text'=>"ویرایش پیام : $lockedit",'callback_data'=>'lockedit'],['text'=>" ارسال مکان  : $locklocation",'callback_data'=>'lockluction']
 ],
 [
 ['text'=>"فحش : $lockfosh",'callback_data'=>'lockfosh'],['text'=>" تصویر  : $lockphoto",'callback_data'=>'lockphoto']
 ],
 [
 ['text'=>"ورود ربات ها : $lockbots",'callback_data'=>'lockbots2'],['text'=>" ارسال شماره  : $lockcontact",'callback_data'=>'lockcontact']
 ],
 [
 ['text'=>"فوروارد : $lockforward",'callback_data'=>'lockforward'],['text'=>" موسیقی  : $lockaudio",'callback_data'=>'lockaudio']
 ],
 [
 ['text'=>"خدمات تلگرام : $locktg",'callback_data'=>'locktg'],['text'=>" صدا  : $lockvoice",'callback_data'=>'lockvoice']
 ],
 [
 ['text'=>"ریپلای : $lockreply",'callback_data'=>'lockreply'],['text'=>" استیکر  : $locksticker",'callback_data'=>'locksticker']
 ],
 [
 ['text'=>"دستورات عمومی : $lockcmd",'callback_data'=>'lockcmd'],
 ],
 [
 ['text'=>" بازی  : $lockgame",'callback_data'=>'lockgame']
 ],
 [
 ['text'=>" فیلم  : $lockvideo",'callback_data'=>'lockvideo']
 ],
 [
 ['text'=>" متن  : $locktext",'callback_data'=>'locktext']
 ],
 [
 ['text'=>"« برگشت",'callback_data'=>'settings']
 ],
                    ]
             ])
         ]);
$settings2["lock"]["document"] = "Active ✓";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		 		 }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
  }
  }
        elseif($data=="lockgif" && $settings2["lock"]["gif"] =="Active ✓"){
				 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
$locklink = $settings2["lock"]["link"];
$lockusername = $settings2["lock"]["username"];
$locktag = $settings2["lock"]["tag"];
$lockedit = $settings2["lock"]["edit"];
$lockfosh = $settings2["lock"]["fosh"];
$lockbots = $settings2["lock"]["bot"];
$lockforward = $settings2["lock"]["forward"];
$locktg = $settings2["lock"]["tgservic"];
$lockreply = $settings2["lock"]["reply"];
$lockcmd = $settings2["lock"]["cmd"];
$lockdocument = $settings2["lock"]["document"];
$lockgif = $settings2["lock"]["gif"];
$lockvideo_note = $settings2["lock"]["video_msg"];
$locklocation = $settings2["lock"]["location"];
$lockphoto = $settings2["lock"]["photo"];
$lockcontact = $settings2["lock"]["contact"];
$lockaudio = $settings2["lock"]["audio"];
$lockvoice = $settings2["lock"]["voice"];
$locksticker = $settings2["lock"]["sticker"];
$lockgame = $settings2["lock"]["game"];
$lockvideo = $settings2["lock"]["video"];
$locktext = $settings2["lock"]["text"];
$mute_all = $settings2["lock"]["mute_all"];
          bot('editmessagetext',[
              'chat_id'=>$chatid,
   'message_id'=>$messageid,
             'text'=>"
•• پنل تنظیمات قفلی ربات

• نام گروه | $gpname
• شناسه گروه | $chatid

● قفل گیف با موفقیت غیرفعال شد !
",
             'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
[
 ['text'=>"قفل کاراکتر",'callback_data'=>'character'],['text'=>"قفل خودکار",'callback_data'=>'lockauto'],['text'=>"حساسیت اخطار",'callback_data'=>'warn']
 ],
 [
 ['text'=>" بخش خوشامد گویی",'callback_data'=>'welcome'],['text'=>"قفل همه : $mute_all ",'callback_data'=>'lockall'],['text'=>"حالت سختگیرانه",'callback_data'=>'hardmode']
 ],
 [
 ['text'=>"لينک : $locklink",'callback_data'=>'locklink'],['text'=>" فایل  : $lockdocument",'callback_data'=>'lockdocument']
 ],
 [
 ['text'=>"هشتگ [#] : $locktag",'callback_data'=>'locktag'],['text'=>" گیف: $lockgif",'callback_data'=>'lockgif']
 ],
 [
 ['text'=>"یوزرنیم [@] : $lockusername",'callback_data'=>'lockusername'],['text'=>" پیام ویدیویی  : $lockvideo_note",'callback_data'=>'lockvideo_note']
 ],
 [
 ['text'=>"ویرایش پیام : $lockedit",'callback_data'=>'lockedit'],['text'=>" ارسال مکان  : $locklocation",'callback_data'=>'lockluction']
 ],
 [
 ['text'=>"فحش : $lockfosh",'callback_data'=>'lockfosh'],['text'=>" تصویر  : $lockphoto",'callback_data'=>'lockphoto']
 ],
 [
 ['text'=>"ورود ربات ها : $lockbots",'callback_data'=>'lockbots2'],['text'=>" ارسال شماره  : $lockcontact",'callback_data'=>'lockcontact']
 ],
 [
 ['text'=>"فوروارد : $lockforward",'callback_data'=>'lockforward'],['text'=>" موسیقی  : $lockaudio",'callback_data'=>'lockaudio']
 ],
 [
 ['text'=>"خدمات تلگرام : $locktg",'callback_data'=>'locktg'],['text'=>" صدا  : $lockvoice",'callback_data'=>'lockvoice']
 ],
 [
 ['text'=>"ریپلای : $lockreply",'callback_data'=>'lockreply'],['text'=>" استیکر  : $locksticker",'callback_data'=>'locksticker']
 ],
 [
 ['text'=>"دستورات عمومی : $lockcmd",'callback_data'=>'lockcmd'],
 ],
 [
 ['text'=>" بازی  : $lockgame",'callback_data'=>'lockgame']
 ],
 [
 ['text'=>" فیلم  : $lockvideo",'callback_data'=>'lockvideo']
 ],
 [
 ['text'=>" متن  : $locktext",'callback_data'=>'locktext']
 ],
 [
 ['text'=>"« برگشت",'callback_data'=>'settings']
 ],
                    ]
             ])
         ]);
$settings2["lock"]["gif"] = "Inactive ✗";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		 		 }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
  }
		}
  elseif($data=="lockgif" && $settings2["lock"]["gif"] =="Inactive ✗"){
			 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
$locklink = $settings2["lock"]["link"];
$lockusername = $settings2["lock"]["username"];
$locktag = $settings2["lock"]["tag"];
$lockedit = $settings2["lock"]["edit"];
$lockfosh = $settings2["lock"]["fosh"];
$lockbots = $settings2["lock"]["bot"];
$lockforward = $settings2["lock"]["forward"];
$locktg = $settings2["lock"]["tgservic"];
$lockreply = $settings2["lock"]["reply"];
$lockcmd = $settings2["lock"]["cmd"];
$lockdocument = $settings2["lock"]["document"];
$lockgif = $settings2["lock"]["gif"];
$lockvideo_note = $settings2["lock"]["video_msg"];
$locklocation = $settings2["lock"]["location"];
$lockphoto = $settings2["lock"]["photo"];
$lockcontact = $settings2["lock"]["contact"];
$lockaudio = $settings2["lock"]["audio"];
$lockvoice = $settings2["lock"]["voice"];
$locksticker = $settings2["lock"]["sticker"];
$lockgame = $settings2["lock"]["game"];
$lockvideo = $settings2["lock"]["video"];
$locktext = $settings2["lock"]["text"];
$mute_all = $settings2["lock"]["mute_all"];
          bot('editmessagetext',[
              'chat_id'=>$chatid,
   'message_id'=>$messageid,
             'text'=>"
•• پنل تنظیمات قفلی ربات

• نام گروه | $gpname
• شناسه گروه | $chatid

● قفل گیف با موفقیت فعال شد !
",
             'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
[
 ['text'=>"قفل کاراکتر",'callback_data'=>'character'],['text'=>"قفل خودکار",'callback_data'=>'lockauto'],['text'=>"حساسیت اخطار",'callback_data'=>'warn']
 ],
 [
 ['text'=>" بخش خوشامد گویی",'callback_data'=>'welcome'],['text'=>"قفل همه : $mute_all ",'callback_data'=>'lockall'],['text'=>"حالت سختگیرانه",'callback_data'=>'hardmode']
 ],
 [
 ['text'=>"لينک : $locklink",'callback_data'=>'locklink'],['text'=>" فایل  : $lockdocument",'callback_data'=>'lockdocument']
 ],
 [
 ['text'=>"هشتگ [#] : $locktag",'callback_data'=>'locktag'],['text'=>" گیف: $lockgif",'callback_data'=>'lockgif']
 ],
 [
 ['text'=>"یوزرنیم [@] : $lockusername",'callback_data'=>'lockusername'],['text'=>" پیام ویدیویی  : $lockvideo_note",'callback_data'=>'lockvideo_note']
 ],
 [
 ['text'=>"ویرایش پیام : $lockedit",'callback_data'=>'lockedit'],['text'=>" ارسال مکان  : $locklocation",'callback_data'=>'lockluction']
 ],
 [
 ['text'=>"فحش : $lockfosh",'callback_data'=>'lockfosh'],['text'=>" تصویر  : $lockphoto",'callback_data'=>'lockphoto']
 ],
 [
 ['text'=>"ورود ربات ها : $lockbots",'callback_data'=>'lockbots2'],['text'=>" ارسال شماره  : $lockcontact",'callback_data'=>'lockcontact']
 ],
 [
 ['text'=>"فوروارد : $lockforward",'callback_data'=>'lockforward'],['text'=>" موسیقی  : $lockaudio",'callback_data'=>'lockaudio']
 ],
 [
 ['text'=>"خدمات تلگرام : $locktg",'callback_data'=>'locktg'],['text'=>" صدا  : $lockvoice",'callback_data'=>'lockvoice']
 ],
 [
 ['text'=>"ریپلای : $lockreply",'callback_data'=>'lockreply'],['text'=>" استیکر  : $locksticker",'callback_data'=>'locksticker']
 ],
 [
 ['text'=>"دستورات عمومی : $lockcmd",'callback_data'=>'lockcmd'],
 ],
 [
 ['text'=>" بازی  : $lockgame",'callback_data'=>'lockgame']
 ],
 [
 ['text'=>" فیلم  : $lockvideo",'callback_data'=>'lockvideo']
 ],
 [
 ['text'=>" متن  : $locktext",'callback_data'=>'locktext']
 ],
 [
 ['text'=>"« برگشت",'callback_data'=>'settings']
 ],
                    ]
             ])
         ]);
$settings2["lock"]["gif"] = "Active ✓";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		 		 }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
  }
  }
          elseif($data=="locktg" && $settings2["lock"]["tgservic"] =="Active ✓"){
				 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
$locklink = $settings2["lock"]["link"];
$lockusername = $settings2["lock"]["username"];
$locktag = $settings2["lock"]["tag"];
$lockedit = $settings2["lock"]["edit"];
$lockfosh = $settings2["lock"]["fosh"];
$lockbots = $settings2["lock"]["bot"];
$lockforward = $settings2["lock"]["forward"];
$locktg = $settings2["lock"]["tgservic"];
$lockreply = $settings2["lock"]["reply"];
$lockcmd = $settings2["lock"]["cmd"];
$lockdocument = $settings2["lock"]["document"];
$lockgif = $settings2["lock"]["gif"];
$lockvideo_note = $settings2["lock"]["video_msg"];
$locklocation = $settings2["lock"]["location"];
$lockphoto = $settings2["lock"]["photo"];
$lockcontact = $settings2["lock"]["contact"];
$lockaudio = $settings2["lock"]["audio"];
$lockvoice = $settings2["lock"]["voice"];
$locksticker = $settings2["lock"]["sticker"];
$lockgame = $settings2["lock"]["game"];
$lockvideo = $settings2["lock"]["video"];
$locktext = $settings2["lock"]["text"];
$mute_all = $settings2["lock"]["mute_all"];
          bot('editmessagetext',[
              'chat_id'=>$chatid,
   'message_id'=>$messageid,
             'text'=>"
•• پنل تنظیمات قفلی ربات

• نام گروه | $gpname
• شناسه گروه | $chatid

● قفل سرویس تلگرام با موفقیت غیرفعال شد !
",
             'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
[
 ['text'=>"قفل کاراکتر",'callback_data'=>'character'],['text'=>"قفل خودکار",'callback_data'=>'lockauto'],['text'=>"حساسیت اخطار",'callback_data'=>'warn']
 ],
 [
 ['text'=>" بخش خوشامد گویی",'callback_data'=>'welcome'],['text'=>"قفل همه : $mute_all ",'callback_data'=>'lockall'],['text'=>"حالت سختگیرانه",'callback_data'=>'hardmode']
 ],
 [
 ['text'=>"لينک : $locklink",'callback_data'=>'locklink'],['text'=>" فایل  : $lockdocument",'callback_data'=>'lockdocument']
 ],
 [
 ['text'=>"هشتگ [#] : $locktag",'callback_data'=>'locktag'],['text'=>" گیف: $lockgif",'callback_data'=>'lockgif']
 ],
 [
 ['text'=>"یوزرنیم [@] : $lockusername",'callback_data'=>'lockusername'],['text'=>" پیام ویدیویی  : $lockvideo_note",'callback_data'=>'lockvideo_note']
 ],
 [
 ['text'=>"ویرایش پیام : $lockedit",'callback_data'=>'lockedit'],['text'=>" ارسال مکان  : $locklocation",'callback_data'=>'lockluction']
 ],
 [
 ['text'=>"فحش : $lockfosh",'callback_data'=>'lockfosh'],['text'=>" تصویر  : $lockphoto",'callback_data'=>'lockphoto']
 ],
 [
 ['text'=>"ورود ربات ها : $lockbots",'callback_data'=>'lockbots2'],['text'=>" ارسال شماره  : $lockcontact",'callback_data'=>'lockcontact']
 ],
 [
 ['text'=>"فوروارد : $lockforward",'callback_data'=>'lockforward'],['text'=>" موسیقی  : $lockaudio",'callback_data'=>'lockaudio']
 ],
 [
 ['text'=>"خدمات تلگرام : $locktg",'callback_data'=>'locktg'],['text'=>" صدا  : $lockvoice",'callback_data'=>'lockvoice']
 ],
 [
 ['text'=>"ریپلای : $lockreply",'callback_data'=>'lockreply'],['text'=>" استیکر  : $locksticker",'callback_data'=>'locksticker']
 ],
 [
 ['text'=>"دستورات عمومی : $lockcmd",'callback_data'=>'lockcmd'],
 ],
 [
 ['text'=>" بازی  : $lockgame",'callback_data'=>'lockgame']
 ],
 [
 ['text'=>" فیلم  : $lockvideo",'callback_data'=>'lockvideo']
 ],
 [
 ['text'=>" متن  : $locktext",'callback_data'=>'locktext']
 ],
 [
 ['text'=>"« برگشت",'callback_data'=>'settings']
 ],
                    ]
             ])
         ]);
$settings2["lock"]["tgservic"] = "Inactive ✗";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		 		 }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
  }
		  }
  elseif($data=="locktg" && $settings2["lock"]["tgservic"] =="Inactive ✗" ){
			 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
$locklink = $settings2["lock"]["link"];
$lockusername = $settings2["lock"]["username"];
$locktag = $settings2["lock"]["tag"];
$lockedit = $settings2["lock"]["edit"];
$lockfosh = $settings2["lock"]["fosh"];
$lockbots = $settings2["lock"]["bot"];
$lockforward = $settings2["lock"]["forward"];
$locktg = $settings2["lock"]["tgservic"];
$lockreply = $settings2["lock"]["reply"];
$lockcmd = $settings2["lock"]["cmd"];
$lockdocument = $settings2["lock"]["document"];
$lockgif = $settings2["lock"]["gif"];
$lockvideo_note = $settings2["lock"]["video_msg"];
$locklocation = $settings2["lock"]["location"];
$lockphoto = $settings2["lock"]["photo"];
$lockcontact = $settings2["lock"]["contact"];
$lockaudio = $settings2["lock"]["audio"];
$lockvoice = $settings2["lock"]["voice"];
$locksticker = $settings2["lock"]["sticker"];
$lockgame = $settings2["lock"]["game"];
$lockvideo = $settings2["lock"]["video"];
$locktext = $settings2["lock"]["text"];
$mute_all = $settings2["lock"]["mute_all"];
          bot('editmessagetext',[
              'chat_id'=>$chatid,
   'message_id'=>$messageid,
             'text'=>"
•• پنل تنظیمات قفلی ربات

• نام گروه | $gpname
• شناسه گروه | $chatid

● قفل سرویس تلگرام با موفقیت فعال شد !",
             'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
[
 ['text'=>"قفل کاراکتر",'callback_data'=>'character'],['text'=>"قفل خودکار",'callback_data'=>'lockauto'],['text'=>"حساسیت اخطار",'callback_data'=>'warn']
 ],
 [
 ['text'=>" بخش خوشامد گویی",'callback_data'=>'welcome'],['text'=>"قفل همه : $mute_all ",'callback_data'=>'lockall'],['text'=>"حالت سختگیرانه",'callback_data'=>'hardmode']
 ],
 [
 ['text'=>"لينک : $locklink",'callback_data'=>'locklink'],['text'=>" فایل  : $lockdocument",'callback_data'=>'lockdocument']
 ],
 [
 ['text'=>"هشتگ [#] : $locktag",'callback_data'=>'locktag'],['text'=>" گیف: $lockgif",'callback_data'=>'lockgif']
 ],
 [
 ['text'=>"یوزرنیم [@] : $lockusername",'callback_data'=>'lockusername'],['text'=>" پیام ویدیویی  : $lockvideo_note",'callback_data'=>'lockvideo_note']
 ],
 [
 ['text'=>"ویرایش پیام : $lockedit",'callback_data'=>'lockedit'],['text'=>" ارسال مکان  : $locklocation",'callback_data'=>'lockluction']
 ],
 [
 ['text'=>"فحش : $lockfosh",'callback_data'=>'lockfosh'],['text'=>" تصویر  : $lockphoto",'callback_data'=>'lockphoto']
 ],
 [
 ['text'=>"ورود ربات ها : $lockbots",'callback_data'=>'lockbots2'],['text'=>" ارسال شماره  : $lockcontact",'callback_data'=>'lockcontact']
 ],
 [
 ['text'=>"فوروارد : $lockforward",'callback_data'=>'lockforward'],['text'=>" موسیقی  : $lockaudio",'callback_data'=>'lockaudio']
 ],
 [
 ['text'=>"خدمات تلگرام : $locktg",'callback_data'=>'locktg'],['text'=>" صدا  : $lockvoice",'callback_data'=>'lockvoice']
 ],
 [
 ['text'=>"ریپلای : $lockreply",'callback_data'=>'lockreply'],['text'=>" استیکر  : $locksticker",'callback_data'=>'locksticker']
 ],
 [
 ['text'=>"دستورات عمومی : $lockcmd",'callback_data'=>'lockcmd'],
 ],
 [
 ['text'=>" بازی  : $lockgame",'callback_data'=>'lockgame']
 ],
 [
 ['text'=>" فیلم  : $lockvideo",'callback_data'=>'lockvideo']
 ],
 [
 ['text'=>" متن  : $locktext",'callback_data'=>'locktext']
 ],
 [
 ['text'=>"« برگشت",'callback_data'=>'settings']
 ],
                    ]
             ])
         ]);
$settings2["lock"]["tgservic"] = "Active ✓";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		 		 }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
  }
  }
              elseif($data=="lockvideo_note" && $settings2["lock"]["video_msg"] =="Active ✓"){
			 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
$locklink = $settings2["lock"]["link"];
$lockusername = $settings2["lock"]["username"];
$locktag = $settings2["lock"]["tag"];
$lockedit = $settings2["lock"]["edit"];
$lockfosh = $settings2["lock"]["fosh"];
$lockbots = $settings2["lock"]["bot"];
$lockforward = $settings2["lock"]["forward"];
$locktg = $settings2["lock"]["tgservic"];
$lockreply = $settings2["lock"]["reply"];
$lockcmd = $settings2["lock"]["cmd"];
$lockdocument = $settings2["lock"]["document"];
$lockgif = $settings2["lock"]["gif"];
$lockvideo_note = $settings2["lock"]["video_msg"];
$locklocation = $settings2["lock"]["location"];
$lockphoto = $settings2["lock"]["photo"];
$lockcontact = $settings2["lock"]["contact"];
$lockaudio = $settings2["lock"]["audio"];
$lockvoice = $settings2["lock"]["voice"];
$locksticker = $settings2["lock"]["sticker"];
$lockgame = $settings2["lock"]["game"];
$lockvideo = $settings2["lock"]["video"];
$locktext = $settings2["lock"]["text"];
$mute_all = $settings2["lock"]["mute_all"];
          bot('editmessagetext',[
              'chat_id'=>$chatid,
   'message_id'=>$messageid,
             'text'=>"
•• پنل تنظیمات قفلی ربات

• نام گروه | $gpname
• شناسه گروه | $chatid

● قفل فیلم سلفی با موفقیت غیرفعال شد !
",
             'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
[
 ['text'=>"قفل کاراکتر",'callback_data'=>'character'],['text'=>"قفل خودکار",'callback_data'=>'lockauto'],['text'=>"حساسیت اخطار",'callback_data'=>'warn']
 ],
 [
 ['text'=>" بخش خوشامد گویی",'callback_data'=>'welcome'],['text'=>"قفل همه : $mute_all ",'callback_data'=>'lockall'],['text'=>"حالت سختگیرانه",'callback_data'=>'hardmode']
 ],
 [
 ['text'=>"لينک : $locklink",'callback_data'=>'locklink'],['text'=>" فایل  : $lockdocument",'callback_data'=>'lockdocument']
 ],
 [
 ['text'=>"هشتگ [#] : $locktag",'callback_data'=>'locktag'],['text'=>" گیف: $lockgif",'callback_data'=>'lockgif']
 ],
 [
 ['text'=>"یوزرنیم [@] : $lockusername",'callback_data'=>'lockusername'],['text'=>" پیام ویدیویی  : $lockvideo_note",'callback_data'=>'lockvideo_note']
 ],
 [
 ['text'=>"ویرایش پیام : $lockedit",'callback_data'=>'lockedit'],['text'=>" ارسال مکان  : $locklocation",'callback_data'=>'lockluction']
 ],
 [
 ['text'=>"فحش : $lockfosh",'callback_data'=>'lockfosh'],['text'=>" تصویر  : $lockphoto",'callback_data'=>'lockphoto']
 ],
 [
 ['text'=>"ورود ربات ها : $lockbots",'callback_data'=>'lockbots2'],['text'=>" ارسال شماره  : $lockcontact",'callback_data'=>'lockcontact']
 ],
 [
 ['text'=>"فوروارد : $lockforward",'callback_data'=>'lockforward'],['text'=>" موسیقی  : $lockaudio",'callback_data'=>'lockaudio']
 ],
 [
 ['text'=>"خدمات تلگرام : $locktg",'callback_data'=>'locktg'],['text'=>" صدا  : $lockvoice",'callback_data'=>'lockvoice']
 ],
 [
 ['text'=>"ریپلای : $lockreply",'callback_data'=>'lockreply'],['text'=>" استیکر  : $locksticker",'callback_data'=>'locksticker']
 ],
 [
 ['text'=>"دستورات عمومی : $lockcmd",'callback_data'=>'lockcmd'],
 ],
 [
 ['text'=>" بازی  : $lockgame",'callback_data'=>'lockgame']
 ],
 [
 ['text'=>" فیلم  : $lockvideo",'callback_data'=>'lockvideo']
 ],
 [
 ['text'=>" متن  : $locktext",'callback_data'=>'locktext']
 ],
 [
 ['text'=>"« برگشت",'callback_data'=>'settings']
 ],
                    ]
             ])
         ]);
$settings2["lock"]["video_msg"] = "Inactive ✗";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		 		 }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
  }
			  }
  elseif($data=="lockvideo_note" && $settings2["lock"]["video_msg"] == "Inactive ✗" ){
			 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
$locklink = $settings2["lock"]["link"];
$lockusername = $settings2["lock"]["username"];
$locktag = $settings2["lock"]["tag"];
$lockedit = $settings2["lock"]["edit"];
$lockfosh = $settings2["lock"]["fosh"];
$lockbots = $settings2["lock"]["bot"];
$lockforward = $settings2["lock"]["forward"];
$locktg = $settings2["lock"]["tgservic"];
$lockreply = $settings2["lock"]["reply"];
$lockcmd = $settings2["lock"]["cmd"];
$lockdocument = $settings2["lock"]["document"];
$lockgif = $settings2["lock"]["gif"];
$lockvideo_note = $settings2["lock"]["video_msg"];
$locklocation = $settings2["lock"]["location"];
$lockphoto = $settings2["lock"]["photo"];
$lockcontact = $settings2["lock"]["contact"];
$lockaudio = $settings2["lock"]["audio"];
$lockvoice = $settings2["lock"]["voice"];
$locksticker = $settings2["lock"]["sticker"];
$lockgame = $settings2["lock"]["game"];
$lockvideo = $settings2["lock"]["video"];
$locktext = $settings2["lock"]["text"];
$mute_all = $settings2["lock"]["mute_all"];
          bot('editmessagetext',[
              'chat_id'=>$chatid,
   'message_id'=>$messageid,
             'text'=>"
•• پنل تنظیمات قفلی ربات

• نام گروه | $gpname
• شناسه گروه | $chatid

● قفل فیلم سلفی با موفقیت فعال شد !
",
             'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
[
 ['text'=>"قفل کاراکتر",'callback_data'=>'character'],['text'=>"قفل خودکار",'callback_data'=>'lockauto'],['text'=>"حساسیت اخطار",'callback_data'=>'warn']
 ],
 [
 ['text'=>" بخش خوشامد گویی",'callback_data'=>'welcome'],['text'=>"قفل همه : $mute_all ",'callback_data'=>'lockall'],['text'=>"حالت سختگیرانه",'callback_data'=>'hardmode']
 ],
 [
 ['text'=>"لينک : $locklink",'callback_data'=>'locklink'],['text'=>" فایل  : $lockdocument",'callback_data'=>'lockdocument']
 ],
 [
 ['text'=>"هشتگ [#] : $locktag",'callback_data'=>'locktag'],['text'=>" گیف: $lockgif",'callback_data'=>'lockgif']
 ],
 [
 ['text'=>"یوزرنیم [@] : $lockusername",'callback_data'=>'lockusername'],['text'=>" پیام ویدیویی  : $lockvideo_note",'callback_data'=>'lockvideo_note']
 ],
 [
 ['text'=>"ویرایش پیام : $lockedit",'callback_data'=>'lockedit'],['text'=>" ارسال مکان  : $locklocation",'callback_data'=>'lockluction']
 ],
 [
 ['text'=>"فحش : $lockfosh",'callback_data'=>'lockfosh'],['text'=>" تصویر  : $lockphoto",'callback_data'=>'lockphoto']
 ],
 [
 ['text'=>"ورود ربات ها : $lockbots",'callback_data'=>'lockbots2'],['text'=>" ارسال شماره  : $lockcontact",'callback_data'=>'lockcontact']
 ],
 [
 ['text'=>"فوروارد : $lockforward",'callback_data'=>'lockforward'],['text'=>" موسیقی  : $lockaudio",'callback_data'=>'lockaudio']
 ],
 [
 ['text'=>"خدمات تلگرام : $locktg",'callback_data'=>'locktg'],['text'=>" صدا  : $lockvoice",'callback_data'=>'lockvoice']
 ],
 [
 ['text'=>"ریپلای : $lockreply",'callback_data'=>'lockreply'],['text'=>" استیکر  : $locksticker",'callback_data'=>'locksticker']
 ],
 [
 ['text'=>"دستورات عمومی : $lockcmd",'callback_data'=>'lockcmd'],
 ],
 [
 ['text'=>" بازی  : $lockgame",'callback_data'=>'lockgame']
 ],
 [
 ['text'=>" فیلم  : $lockvideo",'callback_data'=>'lockvideo']
 ],
 [
 ['text'=>" متن  : $locktext",'callback_data'=>'locktext']
 ],
 [
 ['text'=>"« برگشت",'callback_data'=>'settings']
 ],
                    ]
             ])
         ]);
$settings2["lock"]["video_msg"] = "Active ✓";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		 		 }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
  }
  }
                elseif($data=="lockreply" && $settings2["lock"]["reply"] =="Active ✓"){
			 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
$locklink = $settings2["lock"]["link"];
$lockusername = $settings2["lock"]["username"];
$locktag = $settings2["lock"]["tag"];
$lockedit = $settings2["lock"]["edit"];
$lockfosh = $settings2["lock"]["fosh"];
$lockbots = $settings2["lock"]["bot"];
$lockforward = $settings2["lock"]["forward"];
$locktg = $settings2["lock"]["tgservic"];
$lockreply = $settings2["lock"]["reply"];
$lockcmd = $settings2["lock"]["cmd"];
$lockdocument = $settings2["lock"]["document"];
$lockgif = $settings2["lock"]["gif"];
$lockvideo_note = $settings2["lock"]["video_msg"];
$locklocation = $settings2["lock"]["location"];
$lockphoto = $settings2["lock"]["photo"];
$lockcontact = $settings2["lock"]["contact"];
$lockaudio = $settings2["lock"]["audio"];
$lockvoice = $settings2["lock"]["voice"];
$locksticker = $settings2["lock"]["sticker"];
$lockgame = $settings2["lock"]["game"];
$lockvideo = $settings2["lock"]["video"];
$locktext = $settings2["lock"]["text"];
$mute_all = $settings2["lock"]["mute_all"];
          bot('editmessagetext',[
              'chat_id'=>$chatid,
   'message_id'=>$messageid,
             'text'=>"
•• پنل تنظیمات قفلی ربات

• نام گروه | $gpname
• شناسه گروه | $chatid

● قفل ریپلی با موفقیت غیرفعال شد !
",
             'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
[
 ['text'=>"قفل کاراکتر",'callback_data'=>'character'],['text'=>"قفل خودکار",'callback_data'=>'lockauto'],['text'=>"حساسیت اخطار",'callback_data'=>'warn']
 ],
 [
 ['text'=>" بخش خوشامد گویی",'callback_data'=>'welcome'],['text'=>"قفل همه : $mute_all ",'callback_data'=>'lockall'],['text'=>"حالت سختگیرانه",'callback_data'=>'hardmode']
 ],
 [
 ['text'=>"لينک : $locklink",'callback_data'=>'locklink'],['text'=>" فایل  : $lockdocument",'callback_data'=>'lockdocument']
 ],
 [
 ['text'=>"هشتگ [#] : $locktag",'callback_data'=>'locktag'],['text'=>" گیف: $lockgif",'callback_data'=>'lockgif']
 ],
 [
 ['text'=>"یوزرنیم [@] : $lockusername",'callback_data'=>'lockusername'],['text'=>" پیام ویدیویی  : $lockvideo_note",'callback_data'=>'lockvideo_note']
 ],
 [
 ['text'=>"ویرایش پیام : $lockedit",'callback_data'=>'lockedit'],['text'=>" ارسال مکان  : $locklocation",'callback_data'=>'lockluction']
 ],
 [
 ['text'=>"فحش : $lockfosh",'callback_data'=>'lockfosh'],['text'=>" تصویر  : $lockphoto",'callback_data'=>'lockphoto']
 ],
 [
 ['text'=>"ورود ربات ها : $lockbots",'callback_data'=>'lockbots2'],['text'=>" ارسال شماره  : $lockcontact",'callback_data'=>'lockcontact']
 ],
 [
 ['text'=>"فوروارد : $lockforward",'callback_data'=>'lockforward'],['text'=>" موسیقی  : $lockaudio",'callback_data'=>'lockaudio']
 ],
 [
 ['text'=>"خدمات تلگرام : $locktg",'callback_data'=>'locktg'],['text'=>" صدا  : $lockvoice",'callback_data'=>'lockvoice']
 ],
 [
 ['text'=>"ریپلای : $lockreply",'callback_data'=>'lockreply'],['text'=>" استیکر  : $locksticker",'callback_data'=>'locksticker']
 ],
 [
 ['text'=>"دستورات عمومی : $lockcmd",'callback_data'=>'lockcmd'],
 ],
 [
 ['text'=>" بازی  : $lockgame",'callback_data'=>'lockgame']
 ],
 [
 ['text'=>" فیلم  : $lockvideo",'callback_data'=>'lockvideo']
 ],
 [
 ['text'=>" متن  : $locktext",'callback_data'=>'locktext']
 ],
 [
 ['text'=>"« برگشت",'callback_data'=>'settings']
 ],
                    ]
             ])
         ]);
$settings2["lock"]["reply"] = "Inactive ✗";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		 		 }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
  }
			}
  elseif($data=="lockreply" && $settings2["lock"]["reply"] =="Inactive ✗"){
			 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
$locklink = $settings2["lock"]["link"];
$lockusername = $settings2["lock"]["username"];
$locktag = $settings2["lock"]["tag"];
$lockedit = $settings2["lock"]["edit"];
$lockfosh = $settings2["lock"]["fosh"];
$lockbots = $settings2["lock"]["bot"];
$lockforward = $settings2["lock"]["forward"];
$locktg = $settings2["lock"]["tgservic"];
$lockreply = $settings2["lock"]["reply"];
$lockcmd = $settings2["lock"]["cmd"];
$lockdocument = $settings2["lock"]["document"];
$lockgif = $settings2["lock"]["gif"];
$lockvideo_note = $settings2["lock"]["video_msg"];
$locklocation = $settings2["lock"]["location"];
$lockphoto = $settings2["lock"]["photo"];
$lockcontact = $settings2["lock"]["contact"];
$lockaudio = $settings2["lock"]["audio"];
$lockvoice = $settings2["lock"]["voice"];
$locksticker = $settings2["lock"]["sticker"];
$lockgame = $settings2["lock"]["game"];
$lockvideo = $settings2["lock"]["video"];
$locktext = $settings2["lock"]["text"];
$mute_all = $settings2["lock"]["mute_all"];
          bot('editmessagetext',[
              'chat_id'=>$chatid,
   'message_id'=>$messageid,
             'text'=>"
•• پنل تنظیمات قفلی ربات

• نام گروه | $gpname
• شناسه گروه | $chatid

● قفل ریپلی با موفقیت فعال شد !",
             'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
[
 ['text'=>"قفل کاراکتر",'callback_data'=>'character'],['text'=>"قفل خودکار",'callback_data'=>'lockauto'],['text'=>"حساسیت اخطار",'callback_data'=>'warn']
 ],
 [
 ['text'=>" بخش خوشامد گویی",'callback_data'=>'welcome'],['text'=>"قفل همه : $mute_all ",'callback_data'=>'lockall'],['text'=>"حالت سختگیرانه",'callback_data'=>'hardmode']
 ],
 [
 ['text'=>"لينک : $locklink",'callback_data'=>'locklink'],['text'=>" فایل  : $lockdocument",'callback_data'=>'lockdocument']
 ],
 [
 ['text'=>"هشتگ [#] : $locktag",'callback_data'=>'locktag'],['text'=>" گیف: $lockgif",'callback_data'=>'lockgif']
 ],
 [
 ['text'=>"یوزرنیم [@] : $lockusername",'callback_data'=>'lockusername'],['text'=>" پیام ویدیویی  : $lockvideo_note",'callback_data'=>'lockvideo_note']
 ],
 [
 ['text'=>"ویرایش پیام : $lockedit",'callback_data'=>'lockedit'],['text'=>" ارسال مکان  : $locklocation",'callback_data'=>'lockluction']
 ],
 [
 ['text'=>"فحش : $lockfosh",'callback_data'=>'lockfosh'],['text'=>" تصویر  : $lockphoto",'callback_data'=>'lockphoto']
 ],
 [
 ['text'=>"ورود ربات ها : $lockbots",'callback_data'=>'lockbots2'],['text'=>" ارسال شماره  : $lockcontact",'callback_data'=>'lockcontact']
 ],
 [
 ['text'=>"فوروارد : $lockforward",'callback_data'=>'lockforward'],['text'=>" موسیقی  : $lockaudio",'callback_data'=>'lockaudio']
 ],
 [
 ['text'=>"خدمات تلگرام : $locktg",'callback_data'=>'locktg'],['text'=>" صدا  : $lockvoice",'callback_data'=>'lockvoice']
 ],
 [
 ['text'=>"ریپلای : $lockreply",'callback_data'=>'lockreply'],['text'=>" استیکر  : $locksticker",'callback_data'=>'locksticker']
 ],
 [
 ['text'=>"دستورات عمومی : $lockcmd",'callback_data'=>'lockcmd'],
 ],
 [
 ['text'=>" بازی  : $lockgame",'callback_data'=>'lockgame']
 ],
 [
 ['text'=>" فیلم  : $lockvideo",'callback_data'=>'lockvideo']
 ],
 [
 ['text'=>" متن  : $locktext",'callback_data'=>'locktext']
 ],
 [
 ['text'=>"« برگشت",'callback_data'=>'settings']
 ],
                    ]
             ])
         ]);
$settings2["lock"]["reply"] = "Active ✓";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		 		 }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
  }
  }
                  elseif($data=="lockcmd" && $settings2["lock"]["cmd"] =="Active ✓"){
			 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
$locklink = $settings2["lock"]["link"];
$lockusername = $settings2["lock"]["username"];
$locktag = $settings2["lock"]["tag"];
$lockedit = $settings2["lock"]["edit"];
$lockfosh = $settings2["lock"]["fosh"];
$lockbots = $settings2["lock"]["bot"];
$lockforward = $settings2["lock"]["forward"];
$locktg = $settings2["lock"]["tgservic"];
$lockreply = $settings2["lock"]["reply"];
$lockcmd = $settings2["lock"]["cmd"];
$lockdocument = $settings2["lock"]["document"];
$lockgif = $settings2["lock"]["gif"];
$lockvideo_note = $settings2["lock"]["video_msg"];
$locklocation = $settings2["lock"]["location"];
$lockphoto = $settings2["lock"]["photo"];
$lockcontact = $settings2["lock"]["contact"];
$lockaudio = $settings2["lock"]["audio"];
$lockvoice = $settings2["lock"]["voice"];
$locksticker = $settings2["lock"]["sticker"];
$lockgame = $settings2["lock"]["game"];
$lockvideo = $settings2["lock"]["video"];
$locktext = $settings2["lock"]["text"];
$mute_all = $settings2["lock"]["mute_all"];
          bot('editmessagetext',[
              'chat_id'=>$chatid,
   'message_id'=>$messageid,
             'text'=>"
•• پنل تنظیمات قفلی ربات

• نام گروه | $gpname
• شناسه گروه | $chatid

● قفل دستورات عمومی با موفقیت غیرفعال شد !
",
             'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
[
 ['text'=>"قفل کاراکتر",'callback_data'=>'character'],['text'=>"قفل خودکار",'callback_data'=>'lockauto'],['text'=>"حساسیت اخطار",'callback_data'=>'warn']
 ],
 [
 ['text'=>" بخش خوشامد گویی",'callback_data'=>'welcome'],['text'=>"قفل همه : $mute_all ",'callback_data'=>'lockall'],['text'=>"حالت سختگیرانه",'callback_data'=>'hardmode']
 ],
 [
 ['text'=>"لينک : $locklink",'callback_data'=>'locklink'],['text'=>" فایل  : $lockdocument",'callback_data'=>'lockdocument']
 ],
 [
 ['text'=>"هشتگ [#] : $locktag",'callback_data'=>'locktag'],['text'=>" گیف: $lockgif",'callback_data'=>'lockgif']
 ],
 [
 ['text'=>"یوزرنیم [@] : $lockusername",'callback_data'=>'lockusername'],['text'=>" پیام ویدیویی  : $lockvideo_note",'callback_data'=>'lockvideo_note']
 ],
 [
 ['text'=>"ویرایش پیام : $lockedit",'callback_data'=>'lockedit'],['text'=>" ارسال مکان  : $locklocation",'callback_data'=>'lockluction']
 ],
 [
 ['text'=>"فحش : $lockfosh",'callback_data'=>'lockfosh'],['text'=>" تصویر  : $lockphoto",'callback_data'=>'lockphoto']
 ],
 [
 ['text'=>"ورود ربات ها : $lockbots",'callback_data'=>'lockbots2'],['text'=>" ارسال شماره  : $lockcontact",'callback_data'=>'lockcontact']
 ],
 [
 ['text'=>"فوروارد : $lockforward",'callback_data'=>'lockforward'],['text'=>" موسیقی  : $lockaudio",'callback_data'=>'lockaudio']
 ],
 [
 ['text'=>"خدمات تلگرام : $locktg",'callback_data'=>'locktg'],['text'=>" صدا  : $lockvoice",'callback_data'=>'lockvoice']
 ],
 [
 ['text'=>"ریپلای : $lockreply",'callback_data'=>'lockreply'],['text'=>" استیکر  : $locksticker",'callback_data'=>'locksticker']
 ],
 [
 ['text'=>"دستورات عمومی : $lockcmd",'callback_data'=>'lockcmd'],
 ],
 [
 ['text'=>" بازی  : $lockgame",'callback_data'=>'lockgame']
 ],
 [
 ['text'=>" فیلم  : $lockvideo",'callback_data'=>'lockvideo']
 ],
 [
 ['text'=>" متن  : $locktext",'callback_data'=>'locktext']
 ],
 [
 ['text'=>"« برگشت",'callback_data'=>'settings']
 ],
                    ]
             ])
         ]);
$settings2["lock"]["cmd"] = "Inactive ✗";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		 		 }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
  }
			}
  elseif($data=="lockcmd" && $settings2["lock"]["cmd"] =="Inactive ✗"){
			 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
$locklink = $settings2["lock"]["link"];
$lockusername = $settings2["lock"]["username"];
$locktag = $settings2["lock"]["tag"];
$lockedit = $settings2["lock"]["edit"];
$lockfosh = $settings2["lock"]["fosh"];
$lockbots = $settings2["lock"]["bot"];
$lockforward = $settings2["lock"]["forward"];
$locktg = $settings2["lock"]["tgservic"];
$lockreply = $settings2["lock"]["reply"];
$lockcmd = $settings2["lock"]["cmd"];
$lockdocument = $settings2["lock"]["document"];
$lockgif = $settings2["lock"]["gif"];
$lockvideo_note = $settings2["lock"]["video_msg"];
$locklocation = $settings2["lock"]["location"];
$lockphoto = $settings2["lock"]["photo"];
$lockcontact = $settings2["lock"]["contact"];
$lockaudio = $settings2["lock"]["audio"];
$lockvoice = $settings2["lock"]["voice"];
$locksticker = $settings2["lock"]["sticker"];
$lockgame = $settings2["lock"]["game"];
$lockvideo = $settings2["lock"]["video"];
$locktext = $settings2["lock"]["text"];
$mute_all = $settings2["lock"]["mute_all"];
          bot('editmessagetext',[
              'chat_id'=>$chatid,
   'message_id'=>$messageid,
             'text'=>"
•• پنل تنظیمات قفلی ربات

• نام گروه | $gpname
• شناسه گروه | $chatid

● قفل دستورات عمومی با موفقیت فعال شد !",
             'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
[
 ['text'=>"• قفل کاراکتر",'callback_data'=>'character'],['text'=>"• قفل خودکار",'callback_data'=>'lockauto'],['text'=>"• حساسیت اخطار",'callback_data'=>'warn']
 ],
 [
 ['text'=>" بخش خوشامد گویی",'callback_data'=>'welcome'],['text'=>"قفل همه : $mute_all ",'callback_data'=>'lockall'],['text'=>"حالت سختگیرانه",'callback_data'=>'hardmode']
 ],
 [
 ['text'=>"لينک : $locklink",'callback_data'=>'locklink'],['text'=>" فایل  : $lockdocument",'callback_data'=>'lockdocument']
 ],
 [
 ['text'=>"هشتگ [#] : $locktag",'callback_data'=>'locktag'],['text'=>" گیف: $lockgif",'callback_data'=>'lockgif']
 ],
 [
 ['text'=>"یوزرنیم [@] : $lockusername",'callback_data'=>'lockusername'],['text'=>" پیام ویدیویی  : $lockvideo_note",'callback_data'=>'lockvideo_note']
 ],
 [
 ['text'=>"ویرایش پیام : $lockedit",'callback_data'=>'lockedit'],['text'=>" ارسال مکان  : $locklocation",'callback_data'=>'lockluction']
 ],
 [
 ['text'=>"فحش : $lockfosh",'callback_data'=>'lockfosh'],['text'=>" تصویر  : $lockphoto",'callback_data'=>'lockphoto']
 ],
 [
 ['text'=>"ورود ربات ها : $lockbots",'callback_data'=>'lockbots2'],['text'=>" ارسال شماره  : $lockcontact",'callback_data'=>'lockcontact']
 ],
 [
 ['text'=>"فوروارد : $lockforward",'callback_data'=>'lockforward'],['text'=>" موسیقی  : $lockaudio",'callback_data'=>'lockaudio']
 ],
 [
 ['text'=>"خدمات تلگرام : $locktg",'callback_data'=>'locktg'],['text'=>" صدا  : $lockvoice",'callback_data'=>'lockvoice']
 ],
 [
 ['text'=>"ریپلای : $lockreply",'callback_data'=>'lockreply'],['text'=>" استیکر  : $locksticker",'callback_data'=>'locksticker']
 ],
 [
 ['text'=>"دستورات عمومی : $lockcmd",'callback_data'=>'lockcmd'],
 ],
 [
 ['text'=>" بازی  : $lockgame",'callback_data'=>'lockgame']
 ],
 [
 ['text'=>" فیلم  : $lockvideo",'callback_data'=>'lockvideo']
 ],
 [
 ['text'=>" متن  : $locktext",'callback_data'=>'locktext']
 ],
 [
 ['text'=>"« برگشت",'callback_data'=>'settings']
 ],
                    ]
             ])
         ]);
$settings2["lock"]["cmd"] = "Active ✓";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		 		 }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
  }
  }
               elseif($data=="locktext" && $settings2["lock"]["text"] =="Active ✓"){
			 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
$locklink = $settings2["lock"]["link"];
$lockusername = $settings2["lock"]["username"];
$locktag = $settings2["lock"]["tag"];
$lockedit = $settings2["lock"]["edit"];
$lockfosh = $settings2["lock"]["fosh"];
$lockbots = $settings2["lock"]["bot"];
$lockforward = $settings2["lock"]["forward"];
$locktg = $settings2["lock"]["tgservic"];
$lockreply = $settings2["lock"]["reply"];
$lockcmd = $settings2["lock"]["cmd"];
$lockdocument = $settings2["lock"]["document"];
$lockgif = $settings2["lock"]["gif"];
$lockvideo_note = $settings2["lock"]["video_msg"];
$locklocation = $settings2["lock"]["location"];
$lockphoto = $settings2["lock"]["photo"];
$lockcontact = $settings2["lock"]["contact"];
$lockaudio = $settings2["lock"]["audio"];
$lockvoice = $settings2["lock"]["voice"];
$locksticker = $settings2["lock"]["sticker"];
$lockgame = $settings2["lock"]["game"];
$lockvideo = $settings2["lock"]["video"];
$locktext = $settings2["lock"]["text"];
$mute_all = $settings2["lock"]["mute_all"];
          bot('editmessagetext',[
              'chat_id'=>$chatid,
   'message_id'=>$messageid,
             'text'=>"
•• پنل تنظیمات قفلی ربات

• نام گروه | $gpname
• شناسه گروه | $chatid

● قفل متن با موفقیت غیرفعال شد !
",
             'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
[
 ['text'=>"قفل کاراکتر",'callback_data'=>'character'],['text'=>"قفل خودکار",'callback_data'=>'lockauto'],['text'=>"حساسیت اخطار",'callback_data'=>'warn']
 ],
 [
 ['text'=>" بخش خوشامد گویی",'callback_data'=>'welcome'],['text'=>"قفل همه : $mute_all ",'callback_data'=>'lockall'],['text'=>"حالت سختگیرانه",'callback_data'=>'hardmode']
 ],
 [
 ['text'=>"لينک : $locklink",'callback_data'=>'locklink'],['text'=>" فایل  : $lockdocument",'callback_data'=>'lockdocument']
 ],
 [
 ['text'=>"هشتگ [#] : $locktag",'callback_data'=>'locktag'],['text'=>" گیف: $lockgif",'callback_data'=>'lockgif']
 ],
 [
 ['text'=>"یوزرنیم [@] : $lockusername",'callback_data'=>'lockusername'],['text'=>" پیام ویدیویی  : $lockvideo_note",'callback_data'=>'lockvideo_note']
 ],
 [
 ['text'=>"ویرایش پیام : $lockedit",'callback_data'=>'lockedit'],['text'=>" ارسال مکان  : $locklocation",'callback_data'=>'lockluction']
 ],
 [
 ['text'=>"فحش : $lockfosh",'callback_data'=>'lockfosh'],['text'=>" تصویر  : $lockphoto",'callback_data'=>'lockphoto']
 ],
 [
 ['text'=>"ورود ربات ها : $lockbots",'callback_data'=>'lockbots2'],['text'=>" ارسال شماره  : $lockcontact",'callback_data'=>'lockcontact']
 ],
 [
 ['text'=>"فوروارد : $lockforward",'callback_data'=>'lockforward'],['text'=>" موسیقی  : $lockaudio",'callback_data'=>'lockaudio']
 ],
 [
 ['text'=>"خدمات تلگرام : $locktg",'callback_data'=>'locktg'],['text'=>" صدا  : $lockvoice",'callback_data'=>'lockvoice']
 ],
 [
 ['text'=>"ریپلای : $lockreply",'callback_data'=>'lockreply'],['text'=>" استیکر  : $locksticker",'callback_data'=>'locksticker']
 ],
 [
 ['text'=>"دستورات عمومی : $lockcmd",'callback_data'=>'lockcmd'],
 ],
 [
 ['text'=>" بازی  : $lockgame",'callback_data'=>'lockgame']
 ],
 [
 ['text'=>" فیلم  : $lockvideo",'callback_data'=>'lockvideo']
 ],
 [
 ['text'=>" متن  : $locktext",'callback_data'=>'locktext']
 ],
 [
 ['text'=>"« برگشت",'callback_data'=>'settings']
 ],
                    ]
             ])
         ]);
$settings2["lock"]["text"] = "Inactive ✗";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		 		 }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
  }
			  }
  elseif($data=="locktext" && $settings2["lock"]["text"] == "Inactive ✗" ){
			 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
$locklink = $settings2["lock"]["link"];
$lockusername = $settings2["lock"]["username"];
$locktag = $settings2["lock"]["tag"];
$lockedit = $settings2["lock"]["edit"];
$lockfosh = $settings2["lock"]["fosh"];
$lockbots = $settings2["lock"]["bot"];
$lockforward = $settings2["lock"]["forward"];
$locktg = $settings2["lock"]["tgservic"];
$lockreply = $settings2["lock"]["reply"];
$lockcmd = $settings2["lock"]["cmd"];
$lockdocument = $settings2["lock"]["document"];
$lockgif = $settings2["lock"]["gif"];
$lockvideo_note = $settings2["lock"]["video_msg"];
$locklocation = $settings2["lock"]["location"];
$lockphoto = $settings2["lock"]["photo"];
$lockcontact = $settings2["lock"]["contact"];
$lockaudio = $settings2["lock"]["audio"];
$lockvoice = $settings2["lock"]["voice"];
$locksticker = $settings2["lock"]["sticker"];
$lockgame = $settings2["lock"]["game"];
$lockvideo = $settings2["lock"]["video"];
$locktext = $settings2["lock"]["text"];
$mute_all = $settings2["lock"]["mute_all"];
          bot('editmessagetext',[
              'chat_id'=>$chatid,
   'message_id'=>$messageid,
             'text'=>"
•• پنل تنظیمات قفلی ربات

• نام گروه | $gpname
• شناسه گروه | $chatid

● قفل متن با موفقیت فعال شد !",
             'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
[
 ['text'=>"قفل کاراکتر",'callback_data'=>'character'],['text'=>"قفل خودکار",'callback_data'=>'lockauto'],['text'=>"حساسیت اخطار",'callback_data'=>'warn']
 ],
 [
 ['text'=>" بخش خوشامد گویی",'callback_data'=>'welcome'],['text'=>"قفل همه : $mute_all ",'callback_data'=>'lockall'],['text'=>"حالت سختگیرانه",'callback_data'=>'hardmode']
 ],
 [
 ['text'=>"لينک : $locklink",'callback_data'=>'locklink'],['text'=>" فایل  : $lockdocument",'callback_data'=>'lockdocument']
 ],
 [
 ['text'=>"هشتگ [#] : $locktag",'callback_data'=>'locktag'],['text'=>" گیف: $lockgif",'callback_data'=>'lockgif']
 ],
 [
 ['text'=>"یوزرنیم [@] : $lockusername",'callback_data'=>'lockusername'],['text'=>" پیام ویدیویی  : $lockvideo_note",'callback_data'=>'lockvideo_note']
 ],
 [
 ['text'=>"ویرایش پیام : $lockedit",'callback_data'=>'lockedit'],['text'=>" ارسال مکان  : $locklocation",'callback_data'=>'lockluction']
 ],
 [
 ['text'=>"فحش : $lockfosh",'callback_data'=>'lockfosh'],['text'=>" تصویر  : $lockphoto",'callback_data'=>'lockphoto']
 ],
 [
 ['text'=>"ورود ربات ها : $lockbots",'callback_data'=>'lockbots2'],['text'=>" ارسال شماره  : $lockcontact",'callback_data'=>'lockcontact']
 ],
 [
 ['text'=>"فوروارد : $lockforward",'callback_data'=>'lockforward'],['text'=>" موسیقی  : $lockaudio",'callback_data'=>'lockaudio']
 ],
 [
 ['text'=>"خدمات تلگرام : $locktg",'callback_data'=>'locktg'],['text'=>" صدا  : $lockvoice",'callback_data'=>'lockvoice']
 ],
 [
 ['text'=>"ریپلای : $lockreply",'callback_data'=>'lockreply'],['text'=>" استیکر  : $locksticker",'callback_data'=>'locksticker']
 ],
 [
 ['text'=>"دستورات عمومی : $lockcmd",'callback_data'=>'lockcmd'],
 ],
 [
 ['text'=>" بازی  : $lockgame",'callback_data'=>'lockgame']
 ],
 [
 ['text'=>" فیلم  : $lockvideo",'callback_data'=>'lockvideo']
 ],
 [
 ['text'=>" متن  : $locktext",'callback_data'=>'locktext']
 ],
 [
 ['text'=>"« برگشت",'callback_data'=>'settings']
 ],
                    ]
             ])
         ]);
$settings2["lock"]["text"] = "Active ✓";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		 		 }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
  }
  } 
                    elseif($data=="locktag" && $settings2["lock"]["tag"] =="Active ✓"){
			 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
$locklink = $settings2["lock"]["link"];
$lockusername = $settings2["lock"]["username"];
$locktag = $settings2["lock"]["tag"];
$lockedit = $settings2["lock"]["edit"];
$lockfosh = $settings2["lock"]["fosh"];
$lockbots = $settings2["lock"]["bot"];
$lockforward = $settings2["lock"]["forward"];
$locktg = $settings2["lock"]["tgservic"];
$lockreply = $settings2["lock"]["reply"];
$lockcmd = $settings2["lock"]["cmd"];
$lockdocument = $settings2["lock"]["document"];
$lockgif = $settings2["lock"]["gif"];
$lockvideo_note = $settings2["lock"]["video_msg"];
$locklocation = $settings2["lock"]["location"];
$lockphoto = $settings2["lock"]["photo"];
$lockcontact = $settings2["lock"]["contact"];
$lockaudio = $settings2["lock"]["audio"];
$lockvoice = $settings2["lock"]["voice"];
$locksticker = $settings2["lock"]["sticker"];
$lockgame = $settings2["lock"]["game"];
$lockvideo = $settings2["lock"]["video"];
$locktext = $settings2["lock"]["text"];
$mute_all = $settings2["lock"]["mute_all"];
          bot('editmessagetext',[
              'chat_id'=>$chatid,
   'message_id'=>$messageid,
             'text'=>"
•• پنل تنظیمات قفلی ربات

• نام گروه | $gpname
• شناسه گروه | $chatid

● قفل هشتگ با موفقیت غیرفعال شد !
",
             'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
[
 ['text'=>"قفل کاراکتر",'callback_data'=>'character'],['text'=>"قفل خودکار",'callback_data'=>'lockauto'],['text'=>"حساسیت اخطار",'callback_data'=>'warn']
 ],
 [
 ['text'=>" بخش خوشامد گویی",'callback_data'=>'welcome'],['text'=>"قفل همه : $mute_all ",'callback_data'=>'lockall'],['text'=>"حالت سختگیرانه",'callback_data'=>'hardmode']
 ],
 [
 ['text'=>"لينک : $locklink",'callback_data'=>'locklink'],['text'=>" فایل  : $lockdocument",'callback_data'=>'lockdocument']
 ],
 [
 ['text'=>"هشتگ [#] : $locktag",'callback_data'=>'locktag'],['text'=>" گیف: $lockgif",'callback_data'=>'lockgif']
 ],
 [
 ['text'=>"یوزرنیم [@] : $lockusername",'callback_data'=>'lockusername'],['text'=>" پیام ویدیویی  : $lockvideo_note",'callback_data'=>'lockvideo_note']
 ],
 [
 ['text'=>"ویرایش پیام : $lockedit",'callback_data'=>'lockedit'],['text'=>" ارسال مکان  : $locklocation",'callback_data'=>'lockluction']
 ],
 [
 ['text'=>"فحش : $lockfosh",'callback_data'=>'lockfosh'],['text'=>" تصویر  : $lockphoto",'callback_data'=>'lockphoto']
 ],
 [
 ['text'=>"ورود ربات ها : $lockbots",'callback_data'=>'lockbots2'],['text'=>" ارسال شماره  : $lockcontact",'callback_data'=>'lockcontact']
 ],
 [
 ['text'=>"فوروارد : $lockforward",'callback_data'=>'lockforward'],['text'=>" موسیقی  : $lockaudio",'callback_data'=>'lockaudio']
 ],
 [
 ['text'=>"خدمات تلگرام : $locktg",'callback_data'=>'locktg'],['text'=>" صدا  : $lockvoice",'callback_data'=>'lockvoice']
 ],
 [
 ['text'=>"ریپلای : $lockreply",'callback_data'=>'lockreply'],['text'=>" استیکر  : $locksticker",'callback_data'=>'locksticker']
 ],
 [
 ['text'=>"دستورات عمومی : $lockcmd",'callback_data'=>'lockcmd'],
 ],
 [
 ['text'=>" بازی  : $lockgame",'callback_data'=>'lockgame']
 ],
 [
 ['text'=>" فیلم  : $lockvideo",'callback_data'=>'lockvideo']
 ],
 [
 ['text'=>" متن  : $locktext",'callback_data'=>'locktext']
 ],
 [
 ['text'=>"« برگشت",'callback_data'=>'settings']
 ],
                    ]
             ])
         ]);
$settings2["lock"]["tag"] = "Inactive ✗";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		 		 }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
  }
			}
  elseif($data=="locktag" && $settings2["lock"]["tag"] =="Inactive ✗"){
			 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
$locklink = $settings2["lock"]["link"];
$lockusername = $settings2["lock"]["username"];
$locktag = $settings2["lock"]["tag"];
$lockedit = $settings2["lock"]["edit"];
$lockfosh = $settings2["lock"]["fosh"];
$lockbots = $settings2["lock"]["bot"];
$lockforward = $settings2["lock"]["forward"];
$locktg = $settings2["lock"]["tgservic"];
$lockreply = $settings2["lock"]["reply"];
$lockcmd = $settings2["lock"]["cmd"];
$lockdocument = $settings2["lock"]["document"];
$lockgif = $settings2["lock"]["gif"];
$lockvideo_note = $settings2["lock"]["video_msg"];
$locklocation = $settings2["lock"]["location"];
$lockphoto = $settings2["lock"]["photo"];
$lockcontact = $settings2["lock"]["contact"];
$lockaudio = $settings2["lock"]["audio"];
$lockvoice = $settings2["lock"]["voice"];
$locksticker = $settings2["lock"]["sticker"];
$lockgame = $settings2["lock"]["game"];
$lockvideo = $settings2["lock"]["video"];
$locktext = $settings2["lock"]["text"];
$mute_all = $settings2["lock"]["mute_all"];
          bot('editmessagetext',[
              'chat_id'=>$chatid,
   'message_id'=>$messageid,
             'text'=>"
•• پنل تنظیمات قفلی ربات

• نام گروه | $gpname
• شناسه گروه | $chatid

● قفل هشتگ با موفقیت فعال شد !",
             'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
[
 ['text'=>"قفل کاراکتر",'callback_data'=>'character'],['text'=>"قفل خودکار",'callback_data'=>'lockauto'],['text'=>"حساسیت اخطار",'callback_data'=>'warn']
 ],
 [
 ['text'=>" بخش خوشامد گویی",'callback_data'=>'welcome'],['text'=>"قفل همه : $mute_all ",'callback_data'=>'lockall'],['text'=>"حالت سختگیرانه",'callback_data'=>'hardmode']
 ],
 [
 ['text'=>"لينک : $locklink",'callback_data'=>'locklink'],['text'=>" فایل  : $lockdocument",'callback_data'=>'lockdocument']
 ],
 [
 ['text'=>"هشتگ [#] : $locktag",'callback_data'=>'locktag'],['text'=>" گیف: $lockgif",'callback_data'=>'lockgif']
 ],
 [
 ['text'=>"یوزرنیم [@] : $lockusername",'callback_data'=>'lockusername'],['text'=>" پیام ویدیویی  : $lockvideo_note",'callback_data'=>'lockvideo_note']
 ],
 [
 ['text'=>"ویرایش پیام : $lockedit",'callback_data'=>'lockedit'],['text'=>" ارسال مکان  : $locklocation",'callback_data'=>'lockluction']
 ],
 [
 ['text'=>"فحش : $lockfosh",'callback_data'=>'lockfosh'],['text'=>" تصویر  : $lockphoto",'callback_data'=>'lockphoto']
 ],
 [
 ['text'=>"ورود ربات ها : $lockbots",'callback_data'=>'lockbots2'],['text'=>" ارسال شماره  : $lockcontact",'callback_data'=>'lockcontact']
 ],
 [
 ['text'=>"فوروارد : $lockforward",'callback_data'=>'lockforward'],['text'=>" موسیقی  : $lockaudio",'callback_data'=>'lockaudio']
 ],
 [
 ['text'=>"خدمات تلگرام : $locktg",'callback_data'=>'locktg'],['text'=>" صدا  : $lockvoice",'callback_data'=>'lockvoice']
 ],
 [
 ['text'=>"ریپلای : $lockreply",'callback_data'=>'lockreply'],['text'=>" استیکر  : $locksticker",'callback_data'=>'locksticker']
 ],
 [
 ['text'=>"دستورات عمومی : $lockcmd",'callback_data'=>'lockcmd'],
 ],
 [
 ['text'=>" بازی  : $lockgame",'callback_data'=>'lockgame']
 ],
 [
 ['text'=>" فیلم  : $lockvideo",'callback_data'=>'lockvideo']
 ],
 [
 ['text'=>" متن  : $locktext",'callback_data'=>'locktext']
 ],
 [
 ['text'=>"« برگشت",'callback_data'=>'settings']
 ],
                    ]
             ])
         ]);
$settings2["lock"]["tag"] = "Active ✓";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		 		 }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
  }
  }
elseif($textmassage=="Settings" or $textmassage=="settings" or $textmassage=="تنظیمات"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev)){
$locklink = $settings["lock"]["link"];
$lockusername = $settings["lock"]["username"];
$locktag = $settings["lock"]["tag"];
$lockedit = $settings["lock"]["edit"];
$lockfosh = $settings["lock"]["fosh"];
$lockbots = $settings["lock"]["bot"];
$lockforward = $settings["lock"]["forward"];
$locktg = $settings["lock"]["tgservic"];
$lockreply = $settings["lock"]["reply"];
$lockcmd = $settings["lock"]["cmd"];
$lockdocument = $settings["lock"]["document"];
$lockgif = $settings["lock"]["gif"];
$lockvideo_note = $settings["lock"]["video_msg"];
$locklocation = $settings["lock"]["location"];
$lockphoto = $settings["lock"]["photo"];
$lockcontact = $settings["lock"]["contact"];
$lockaudio = $settings["lock"]["audio"];
$lockvoice = $settings["lock"]["voice"];
$locksticker = $settings["lock"]["sticker"];
$lockgame = $settings["lock"]["game"];
$lockvideo = $settings["lock"]["video"];
$locktext = $settings["lock"]["text"];
$mute_all = $settings["lock"]["mute_all"];
$welcome = $settings["information"]["welcome"];
$add = $settings["information"]["add"];
$setwarn = $settings["information"]["setwarn"];
$charge = $settings["information"]["charge"];
$lockauto = $settings["lock"]["lockauto"];
$lockcharacter = $settings["lock"]["lockcharacter"];
$startlock = $settings["information"]["timelock"];
$endlock = $settings["information"]["timeunlock"];
$startlockcharacter = $settings["information"]["pluscharacter"];
$endlockcharacter = $settings["information"]["downcharacter"];
$text = str_replace("| Active ✓ |",""," •• وضعیت قفل ها و تنظیمات گروه️

•• قفل لینک | $locklink

•• قفل فایل | $lockdocument

•• قفل گیف | $lockgif

•• قفل عکس | $lockphoto

•• قفل موزیک | $lockaudio

•• قفل ویس | $lockvoice

•• قفل فیلم | $lockvideo

•• قفل فیلم سلفی | $lockvideo_note

•• قفل استیکر | $locksticker

•• قفل فوروارد | $lockforward

•• قفل ورود ربات | $lockbots

•• قفل ریپلی | $lockreply

•• قفل سرویس تلگرام | $locktg

•• قفل ویرایش پیام | $lockedit

•• قفل بازی : | $lockgame

•• قفل فحش | $lockfosh

•• قفل مخاطب | $lockcontact

•• قفل هشتگ | $locktag

•• قفل تگ | $lockusername

•• قفل دستورات | $lockcmd

•• قفل متن | $locktext

•• قفل گروه | $mute_all

•• قفل کاراکتر | $lockcharacter

•• قفل خودکار | $lockauto

•• خوش آمد گویی | $welcome

•• اد اجباری | $add

• حداکثر اخطار : $setwarn
• زمان شروع قفل گروه : $startlock
• زمان پایان قفل گروه : $endlock

- نام گروه : $namegroup
- شناسه گروه : $chat_id
- اعتبار گروه : $charge

");
$text2 = str_replace("| Inactive ✗ |","","$text");
	bot('sendmessage',[ 
 'chat_id'=>$chat_id,
 'text'=>"$text2",
'reply_to_message_id'=>$message_id,
   ]);
}
}
//=======================================================================================
if($textmassage=="Filterlist" or $textmassage=="filterlist" or $textmassage=="لیست فیلتر"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev)) {
$filter = $settings["filterlist"];
for($z = 0;$z <= count($filter)-1;$z++){
$result = $result.$filter[$z]."\n";
}
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"
• لیست کلمات فیلتر شده :

$result",
         'reply_to_message_id'=>$message_id,

 ]);
}
}
elseif (strpos($textmassage , "filter ") !== false or strpos($textmassage , "فیلتر کردن ") !== false) {
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev)) {
$add = $settings["information"]["added"];
if ($add == true) {
$text = str_replace(['filter ','فیلتر کردن '],'',$textmassage);
bot('sendmessage',[
            'chat_id'=>$chat_id,
            'text'=>"• کلمه ( $text ) فیلتر شد !",
         'reply_to_message_id'=>$message_id,

 ]);
@$settings = json_decode(file_get_contents("data/$chat_id.json"),true);
$settings["filterlist"][]="$text";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• ربات در گروه نصب نشده است !",
  'reply_to_message_id'=>$message_id,

 ]);
}
}
}
elseif (strpos($textmassage , "unfilter " ) !== false or strpos($textmassage , "حذف فیلتر ") !== false) {
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev)) {
$text = str_replace(['unfilter ','حذف فیلتر '],'',$textmassage);
bot('sendmessage',[
            'chat_id'=>$chat_id,
            'text'=>"• کلمه ( $text ) از لیست فیلتر حذف شد !",
         'reply_to_message_id'=>$message_id,

 ]);
@$settings = json_decode(file_get_contents("data/$chat_id.json"),true);
$key = array_search($text,$settings["filterlist"]);
unset($settings["filterlist"][$key]);
$settings["filterlist"] = array_values($settings["filterlist"]); 
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
}
elseif($textmassage=="Clean filterlist" or $textmassage=="حذف لیست فیلتر" or $textmassage=="پاکسازی لیست فیلتر"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev) ) {
$add = $settings["information"]["added"];
if ($add == true) {
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"• لیست کلمات فیلتر شده پاکسازی شد !
",
         'reply_to_message_id'=>$message_id,

 ]);
@$settings = json_decode(file_get_contents("data/$chat_id.json"),true);
unset($settings["filterlist"]);
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• ربات در گروه نصب نشده است !",
  'reply_to_message_id'=>$message_id,

 ]);
}
}
}
// delall
elseif($textmassage == "Clean msgs" or $textmassage == "پاکسازی کلی" or $textmassage == "clean msgs"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev) ) {
$add = $settings["information"]["added"];
if ($add == true) {
$time = $settings["information"]["timermsg"];
date_default_timezone_set('Asia/Tehran');
$date1 = date("H:i:s");
if($date1 > $time){
$msg_id = $settings["information"]["msg_id"];	
$manha = $message_id - $msg_id ;
if($manha < 1000){
for($i=$update->message->message_id; $i>= $msg_id; $i--){
bot('deletemessage',[
 'chat_id' =>$update->message->chat->id,
 'message_id' =>$i,
              ]);
}
bot('sendmessage',[
 'chat_id' =>$update->message->chat->id,
 'text' =>"
• پاکسازی کلی با موفقیت انجام شد !

- تعداد پیام های پاک شده: $manha
",
   ]);
date_default_timezone_set('Asia/Tehran');
$date1 = date("H:i:s");
$date2 = isset($_GET['date']) ? $_GET['date'] : date("H:i:s");;
$next_date = date('H:i:s', strtotime($date2 ."+120 Minutes"));
$settings["information"]["timermsg"]="$next_date";
$settings["information"]["msg_id"]="$message_id";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
else
{
$plus = $message_id - 500 ;
for($i=$update->message->message_id; $i>= $plus; $i--){
bot('deletemessage',[
 'chat_id' =>$update->message->chat->id,
 'message_id' =>$i,
              ]);
}
date_default_timezone_set('Asia/Tehran');
$date1 = date("H:i:s");
$date2 = isset($_GET['date']) ? $_GET['date'] : date("H:i:s");;
$next_date = date('H:i:s', strtotime($date2 ."+60 Minutes"));
$settings["information"]["timermsg"]="$next_date";
$settings["information"]["msg_id"]="$message_id";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
}
else
{
bot('sendmessage',[
 'chat_id' =>$update->message->chat->id,
 'text' =>"• به دلیل پاکسازی انجام شده قبلی شما تا $time دیگر نمیتوانید از این دستور استفاده کنید !",
   ]);
}
}	
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• ربات در گروه نصب نشده است !",
  'reply_to_message_id'=>$message_id,

 ]);
}
}
}
// lock auto 
											    elseif($data=="lockauto"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
$lockauto = $settings2["lock"]["lockauto"];
$timelockauto = $settings2["information"]["timelock"];
$timeunlockauto = $settings2["information"]["timeunlock"];
            bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"
به بخش قفل خودکار گروه خوش آمدید.
			   
در این قسمت میتوانید سکوت گروه را به صورت خودکار تعیین کنید تا در زمان معین شده گروه از حالت سکوت خارج یا بی صدا شود !",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
                     [
                     ['text'=>"وضعیت قفل : $lockauto",'callback_data'=>'lockautostats']
					 ],
					            [
                     ['text'=>"زمان فعال شدن",'callback_data'=>'text']
					 ],
					 [
                     ['text'=>"《《",'callback_data'=>'hourlockautodown'],['text'=>"《",'callback_data'=>'minlockautodown'],['text'=>"$timelockauto",'callback_data'=>'text'],['text'=>"》",'callback_data'=>'minlockautoplus'],['text'=>"》》",'callback_data'=>'hourlockautoplus']
					 ],
					 [
                     ['text'=>"زمان غیرفعال شدن",'callback_data'=>'text']
					 ],
					 [
                     ['text'=>"《《",'callback_data'=>'hourunlockautodown'],['text'=>"《",'callback_data'=>'minunlockautodown'],['text'=>"$timeunlockauto",'callback_data'=>'text'],['text'=>"》",'callback_data'=>'minunlockautoplus'],['text'=>"》》",'callback_data'=>'hourunlockautoplus']
					 ],

					 [
					 ['text'=>"برگشت »",'callback_data'=>'panel2']
					 ],
                     ]
               ])
           ]);
		   }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
    }
				}
											    elseif($data=="lockautostats" &&  $settings2["lock"]["lockauto"] == "Inactive ✗"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
$lockauto = $settings2["lock"]["lockauto"];
$timelockauto = $settings2["information"]["timelock"];
$timeunlockauto = $settings2["information"]["timeunlock"];
            bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
     'text'=>"
به بخش قفل خودکار گروه خوش آمدید.
			   
قفل خودکار گروه فعال شد !",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
                     [
                     ['text'=>"وضعیت قفل : فعال",'callback_data'=>'lockautostats']
					 ],
					            [
                     ['text'=>"زمان فعال شدن",'callback_data'=>'text']
					 ],
					 					            [
                     ['text'=>"《《",'callback_data'=>'hourlockautodown'],['text'=>"《",'callback_data'=>'minlockautodown'],['text'=>"$timelockauto",'callback_data'=>'text'],['text'=>"》",'callback_data'=>'minlockautoplus'],['text'=>"》》",'callback_data'=>'hourlockautoplus']
					 ],

					 		            [
                     ['text'=>"زمان غیرفعال شدن",'callback_data'=>'text']
					 ],
					 			 					            [
                     ['text'=>"《《",'callback_data'=>'hourunlockautodown'],['text'=>"《",'callback_data'=>'minunlockautodown'],['text'=>"$timeunlockauto",'callback_data'=>'text'],['text'=>"》",'callback_data'=>'minunlockautoplus'],['text'=>"》》",'callback_data'=>'hourunlockautoplus']
					 ],

					 [
					 ['text'=>"برگشت »",'callback_data'=>'panel2']
					 ],
                     ]
               ])
           ]);
		   /////  AriKord  /////
$settings2["lock"]["lockauto"]="Active ✓";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		   }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
    }
				}
															    elseif($data=="lockautostats" &&  $settings2["lock"]["lockauto"] == "Active ✓"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
$lockauto = $settings2["lock"]["lockauto"];
$timelockauto = $settings2["information"]["timelock"];
$timeunlockauto = $settings2["information"]["timeunlock"];
            bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
     'text'=>"
به بخش قفل خودکار گروه خوش آمدید.
			   
قفل خودکار گروه غیر فعال شد !",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
                     [
                     ['text'=>"وضعیت قفل : غیرفعال",'callback_data'=>'lockautostats']
					 ],
					            [
                     ['text'=>"زمان فعال شدن",'callback_data'=>'text']
					 ],
					 					            [
                     ['text'=>"《《",'callback_data'=>'hourlockautodown'],['text'=>"《",'callback_data'=>'minlockautodown'],['text'=>"$timelockauto",'callback_data'=>'text'],['text'=>"》",'callback_data'=>'minlockautoplus'],['text'=>"》》",'callback_data'=>'hourlockautoplus']
					 ],

					 		            [
                     ['text'=>"زمان غیرفعال شدن",'callback_data'=>'text']
					 ],
					 			 					            [
                     ['text'=>"《《",'callback_data'=>'hourunlockautodown'],['text'=>"《",'callback_data'=>'minunlockautodown'],['text'=>"$timeunlockauto",'callback_data'=>'text'],['text'=>"》",'callback_data'=>'minunlockautoplus'],['text'=>"》》",'callback_data'=>'hourunlockautoplus']
					 ],

					 [
					 ['text'=>"برگشت »",'callback_data'=>'panel2']
					 ],
                     ]
               ])
           ]);
$settings2["lock"]["lockauto"]="Inactive ✗";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		   }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
    }
				}
											    elseif($data=="hourlockautoplus"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
$lockauto = $settings2["lock"]["lockauto"];
$timelockauto = $settings2["information"]["timelock"];
$timeunlockauto = $settings2["information"]["timeunlock"];
$next_date = date('H:i', strtotime($timelockauto ."+60 Minutes"));
            bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"
به بخش قفل خودکار گروه خوش آمدید.

زمان فعال سازی قفل یک ساعت افزایش یافت !",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
                     [
                     ['text'=>"وضعیت قفل : غیرفعال",'callback_data'=>'lockautostats']
					 ],
					            [
                     ['text'=>"زمان فعال شدن",'callback_data'=>'text']
					 ],
					 					            [
                     ['text'=>"《《",'callback_data'=>'hourlockautodown'],['text'=>"《",'callback_data'=>'minlockautodown'],['text'=>"$next_date",'callback_data'=>'text'],['text'=>"》",'callback_data'=>'minlockautoplus'],['text'=>"》》",'callback_data'=>'hourlockautoplus']
					 ],

					 		            [
                     ['text'=>"زمان غیرفعال شدن",'callback_data'=>'text']
					 ],
					 			 					            [
                     ['text'=>"《《",'callback_data'=>'hourunlockautodown'],['text'=>"《",'callback_data'=>'minunlockautodown'],['text'=>"$timeunlockauto",'callback_data'=>'text'],['text'=>"》",'callback_data'=>'minunlockautoplus'],['text'=>"》》",'callback_data'=>'hourunlockautoplus']
					 ],

					 [
					 ['text'=>"برگشت »",'callback_data'=>'panel2']
					 ],
                     ]
               ])
           ]);
$settings2["information"]["timelock"]="$next_date";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		   }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
    }
				}
															    elseif($data=="hourlockautodown"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
$lockauto = $settings2["lock"]["lockauto"];
$timelockauto = $settings2["information"]["timelock"];
$timeunlockauto = $settings2["information"]["timeunlock"];
$next_date = date('H:i', strtotime($timelockauto ."-60 Minutes"));
            bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"
به بخش قفل خودکار گروه خوش آمدید.

زمان فعال سازی قفل یک ساعت کاهش یافت !",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
                     [
                     ['text'=>"وضعیت قفل : غیرفعال",'callback_data'=>'lockautostats']
					 ],
					            [
                     ['text'=>"زمان فعال شدن",'callback_data'=>'text']
					 ],
					 					            [
                     ['text'=>"《《",'callback_data'=>'hourlockautodown'],['text'=>"《",'callback_data'=>'minlockautodown'],['text'=>"$next_date",'callback_data'=>'text'],['text'=>"》",'callback_data'=>'minlockautoplus'],['text'=>"》》",'callback_data'=>'hourlockautoplus']
					 ],

					 		            [
                     ['text'=>"زمان غیرفعال شدن",'callback_data'=>'text']
					 ],
					 			 					            [
                     ['text'=>"《《",'callback_data'=>'hourunlockautodown'],['text'=>"《",'callback_data'=>'minunlockautodown'],['text'=>"$timeunlockauto",'callback_data'=>'text'],['text'=>"》",'callback_data'=>'minunlockautoplus'],['text'=>"》》",'callback_data'=>'hourunlockautoplus']
					 ],

					 [
					 ['text'=>"برگشت »",'callback_data'=>'panel2']
					 ],
                     ]
               ])
           ]);
$settings2["information"]["timelock"]="$next_date";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		   }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
    }
				}
											    elseif($data=="minlockautoplus"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
$lockauto = $settings2["lock"]["lockauto"];
$timelockauto = $settings2["information"]["timelock"];
$timeunlockauto = $settings2["information"]["timeunlock"];
$next_date = date('H:i', strtotime($timelockauto ."+5 Minutes"));
            bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"
به بخش قفل خودکار گروه خوش آمدید.

زمان فعال سازی قفل پنج دقیقه افزایش یافت !",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
                     [
                     ['text'=>"وضعیت قفل : غیرفعال",'callback_data'=>'lockautostats']
					 ],
					            [
                     ['text'=>"⇩ زمان فـعـالــ شدن ⇩",'callback_data'=>'text']
					 ],
					 					            [
                     ['text'=>"《《",'callback_data'=>'hourlockautodown'],['text'=>"《",'callback_data'=>'minlockautodown'],['text'=>"$next_date",'callback_data'=>'text'],['text'=>"》",'callback_data'=>'minlockautoplus'],['text'=>"》》",'callback_data'=>'hourlockautoplus']
					 ],

					 		            [
                     ['text'=>"زمان غیرفعال شدن",'callback_data'=>'text']
					 ],
					 			 					            [
                     ['text'=>"《《",'callback_data'=>'hourunlockautodown'],['text'=>"《",'callback_data'=>'minunlockautodown'],['text'=>"$timeunlockauto",'callback_data'=>'text'],['text'=>"》",'callback_data'=>'minunlockautoplus'],['text'=>"》》",'callback_data'=>'hourunlockautoplus']
					 ],

					 [
					 ['text'=>"برگشت »",'callback_data'=>'panel2']
					 ],
                     ]
               ])
           ]);
$settings2["information"]["timelock"]="$next_date";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		   }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
    }
				}
															    elseif($data=="minlockautodown"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
$lockauto = $settings2["lock"]["lockauto"];
$timelockauto = $settings2["information"]["timelock"];
$timeunlockauto = $settings2["information"]["timeunlock"];
$next_date = date('H:i', strtotime($timelockauto ."-5 Minutes"));
            bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"
به بخش قفل خودکار گروه خوش آمدید.

زمان فعال سازی قفل پنج دقیقه کاهش یافت !",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
                     [
                     ['text'=>"وضعیت قفل : غیرفعال",'callback_data'=>'lockautostats']
					 ],
					            [
                     ['text'=>"زمان فعال شدن",'callback_data'=>'text']
					 ],
					 					            [
                     ['text'=>"《《",'callback_data'=>'hourlockautodown'],['text'=>"《",'callback_data'=>'minlockautodown'],['text'=>"$next_date",'callback_data'=>'text'],['text'=>"》",'callback_data'=>'minlockautoplus'],['text'=>"》》",'callback_data'=>'hourlockautoplus']
					 ],

					 		            [
                     ['text'=>"زمان غیرفعال شدن",'callback_data'=>'text']
					 ],
					 			 					            [
                     ['text'=>"《《",'callback_data'=>'hourunlockautodown'],['text'=>"《",'callback_data'=>'minunlockautodown'],['text'=>"$timeunlockauto",'callback_data'=>'text'],['text'=>"》",'callback_data'=>'minunlockautoplus'],['text'=>"》》",'callback_data'=>'hourunlockautoplus']
					 ],

					 [
					 ['text'=>"برگشت »",'callback_data'=>'panel2']
					 ],
                     ]
               ])
           ]);
$settings2["information"]["timelock"]="$next_date";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		   }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
    }
				}
												    elseif($data=="hourunlockautoplus"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
$lockauto = $settings2["lock"]["lockauto"];
$timelockauto = $settings2["information"]["timelock"];
$timeunlockauto = $settings2["information"]["timeunlock"];
$next_date = date('H:i', strtotime($timeunlockauto ."+60 Minutes"));
            bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"
به بخش قفل خودکار گروه خوش آمدید.

زمان خاموش شدن قفل یک ساعت افزایش یافت !",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
                     [
                     ['text'=>"وضعیت قفل : غیرفعال",'callback_data'=>'lockautostats']
					 ],
					            [
                     ['text'=>"زمان فعال شدن",'callback_data'=>'text']
					 ],
					 					            [
                     ['text'=>"🎗《《",'callback_data'=>'hourlockautodown'],['text'=>"《",'callback_data'=>'minlockautodown'],['text'=>"$next_date",'callback_data'=>'text'],['text'=>"》",'callback_data'=>'minlockautoplus'],['text'=>"》》🎗",'callback_data'=>'hourlockautoplus']
					 ],

					 		            [
                     ['text'=>"زمان غیرفعال شدن",'callback_data'=>'text']
					 ],
					 			 					            [
                     ['text'=>"《《",'callback_data'=>'hourunlockautodown'],['text'=>"《",'callback_data'=>'minunlockautodown'],['text'=>"$timeunlockauto",'callback_data'=>'text'],['text'=>"》",'callback_data'=>'minunlockautoplus'],['text'=>"》》",'callback_data'=>'hourunlockautoplus']
					 ],

					 [
					 ['text'=>"برگشت »",'callback_data'=>'panel2']
					 ],
                     ]
               ])
           ]);
$settings2["information"]["timeunlock"]="$next_date";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		   }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
    }
				}
																    elseif($data=="hourunlockautodown"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
$lockauto = $settings2["lock"]["lockauto"];
$timelockauto = $settings2["information"]["timelock"];
$timeunlockauto = $settings2["information"]["timeunlock"];
$next_date = date('H:i', strtotime($timeunlockauto ."-60 Minutes"));
            bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"
به بخش قفل خودکار گروه خوش آمدید.

زمان خاموش شدن قفل یک ساعت کاهش یافت !",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
                     [
                     ['text'=>"وضعیت قفل : غیرفعال",'callback_data'=>'lockautostats']
					 ],
					            [
                     ['text'=>"زمان فعال شدن",'callback_data'=>'text']
					 ],
					 					            [
                     ['text'=>"《《",'callback_data'=>'hourlockautodown'],['text'=>"《",'callback_data'=>'minlockautodown'],['text'=>"$next_date",'callback_data'=>'text'],['text'=>"》",'callback_data'=>'minlockautoplus'],['text'=>"》》",'callback_data'=>'hourlockautoplus']
					 ],

					 		            [
                     ['text'=>"زمان غیرفعال شدن",'callback_data'=>'text']
					 ],
					 			 					            [
                     ['text'=>"《《",'callback_data'=>'hourunlockautodown'],['text'=>"《",'callback_data'=>'minunlockautodown'],['text'=>"$timeunlockauto",'callback_data'=>'text'],['text'=>"》",'callback_data'=>'minunlockautoplus'],['text'=>"》》",'callback_data'=>'hourunlockautoplus']
					 ],

					 [
					 ['text'=>"برگشت »",'callback_data'=>'panel2']
					 ],
                     ]
               ])
           ]);
$settings2["information"]["timeunlock"]="$next_date";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		   }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
    }
				}
																    elseif($data=="minunlockautoplus"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
$lockauto = $settings2["lock"]["lockauto"];
$timelockauto = $settings2["information"]["timelock"];
$timeunlockauto = $settings2["information"]["timeunlock"];
$next_date = date('H:i', strtotime($timeunlockauto ."+5 Minutes"));
            bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"
به بخش قفل خودکار گروه خوش آمدید.

زمان خاموش شدن قفل پنج دقیقه افزایش یافت !",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
                     [
                     ['text'=>"وضعیت قفل : غیرفعال",'callback_data'=>'lockautostats']
					 ],
					            [
                     ['text'=>"زمان فعال شدن",'callback_data'=>'text']
					 ],
					 					            [
                     ['text'=>"🎗《《",'callback_data'=>'hourlockautodown'],['text'=>"《",'callback_data'=>'minlockautodown'],['text'=>"$next_date",'callback_data'=>'text'],['text'=>"》",'callback_data'=>'minlockautoplus'],['text'=>"》》🎗",'callback_data'=>'hourlockautoplus']
					 ],

					 		            [
                     ['text'=>"زمان غیرفعال شدن",'callback_data'=>'text']
					 ],
					 			 					            [
                     ['text'=>"《《",'callback_data'=>'hourunlockautodown'],['text'=>"《",'callback_data'=>'minunlockautodown'],['text'=>"$timeunlockauto",'callback_data'=>'text'],['text'=>"》",'callback_data'=>'minunlockautoplus'],['text'=>"》》",'callback_data'=>'hourunlockautoplus']
					 ],

					 [
					 ['text'=>"برگشت »",'callback_data'=>'panel2']
					 ],
                     ]
               ])
           ]);
$settings2["information"]["timeunlock"]="$next_date";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		   }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
    }
				}
																				    elseif($data=="minunlockautodown"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
$lockauto = $settings2["lock"]["lockauto"];
$timelockauto = $settings2["information"]["timelock"];
$timeunlockauto = $settings2["information"]["timeunlock"];
$next_date = date('H:i', strtotime($timeunlockauto ."-5 Minutes"));
            bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"
به بخش قفل خودکار گروه خوش آمدید.

زمان خاموش شدن قفل پنج دقیقه کاهش یافت !",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
                     [
                     ['text'=>"وضعیت قفل : غیرفعال",'callback_data'=>'lockautostats']
					 ],
					            [
                     ['text'=>"زمان فعال شدن",'callback_data'=>'text']
					 ],
					 					            [
                     ['text'=>"《《",'callback_data'=>'hourlockautodown'],['text'=>"《",'callback_data'=>'minlockautodown'],['text'=>"$next_date",'callback_data'=>'text'],['text'=>"》",'callback_data'=>'minlockautoplus'],['text'=>"》》",'callback_data'=>'hourlockautoplus']
					 ],

					 		            [
                     ['text'=>"زمان غیرفعال شدن",'callback_data'=>'text']
					 ],
					 			 					            [
                     ['text'=>"《《",'callback_data'=>'hourunlockautodown'],['text'=>"《",'callback_data'=>'minunlockautodown'],['text'=>"$timeunlockauto",'callback_data'=>'text'],['text'=>"》",'callback_data'=>'minunlockautoplus'],['text'=>"》》",'callback_data'=>'hourunlockautoplus']
					 ],

					 [
					 ['text'=>"برگشت »",'callback_data'=>'panel2']
					 ],
                     ]
               ])
           ]);
$settings2["information"]["timeunlock"]="$next_date";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		   }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
    }
				}
//=======================================================================================
// add kon and dell msg
if($textmassage == "Add on" or $textmassage == "add on" or $textmassage == "دعوت روشن"){
if ($tc == 'group' | $tc == 'supergroup'){  
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev)){
$add = $settings["information"]["added"];
if ($add == true) {
$setadd = $settings["information"]["setadd"];
 bot('sendMessage',[
    'chat_id'=>$chat_id,
    'text'=>"
•• قفل اد اجباری در گروه فعال شد !
• مقدار اد اجباری : $setadd نفر",
		 'reply_to_message_id'=>$message_id,

   ]);
$settings["information"]["add"]="Active ✓";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
   } 
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• ربات در گروه نصب نشده است !

",
  'reply_to_message_id'=>$message_id,

 ]);
	}   
}
	}
}
elseif($textmassage == "Add off" or $textmassage == "add off" or $textmassage == "دعوت خاموش"){
if ($tc == 'group' | $tc == 'supergroup'){  
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev)){
$add = $settings["information"]["added"];
if ($add == true) {
$setadd = $settings["information"]["setadd"];
 bot('sendMessage',[
    'chat_id'=>$chat_id,
    'text'=>"• قفل اد اجباری در گروه غیرفعال شد !",
		 'reply_to_message_id'=>$message_id,

   ]);
$settings["information"]["add"]="Inactive ✗";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
   }
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• ربات در گروه نصب نشده است !

",
  'reply_to_message_id'=>$message_id,

 ]);   
}	   
}
	}
}
elseif (strpos($textmassage , 'Setadd ') !== false or strpos($textmassage , 'تنظیم دعوت ') !== false ) {
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev)){
$add = $settings["information"]["added"];
if ($add == true) {
$code = str_replace(['Setadd ','تنظیم دعوت '],'',$textmassage);
if($code <= 20 && $code >= 1){
 bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"
• مقدار اد اجباری به $code نفر تغییر پیدا کرد !",
'reply_to_message_id'=>$message_id,

   ]);
$settings["information"]["setadd"]="$code";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
   } 
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• عددی بین 1 تا 20 وارد کنید !",
  'reply_to_message_id'=>$message_id,

 ]);  
}
}
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• ربات در گروه نصب نشده است !

",
  'reply_to_message_id'=>$message_id,

 ]);   
}	   
}
}

					elseif($data=="addbzn"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev)){
$add = $settings2["information"]["add"];
$setadd = $settings2["information"]["setadd"];
          bot('editmessagetext',[
              'chat_id'=>$chatid,
   'message_id'=>$messageid,
             'text'=>"
به بخش تنظیمات اد اجباری خوش آمدید

از دکمه های زیر استفاده کنید !",
             'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
    [
                     ['text'=>"اد اجباری : $add",'callback_data'=>'lockadd']
					 ],
					 [
					 ['text'=>"میزان دعوت",'callback_data'=>'text']
					 ],
					 [
					 ['text'=>"کاهش",'callback_data'=>'add-'],['text'=>"$setadd",'callback_data'=>'text'],['text'=>"افزایش",'callback_data'=>'add+']
					 ],
					 [
					 ['text'=>"برگشت »",'callback_data'=>'panel3']
					 ],
                     ]
               ])
	]);
	}else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
	}
		  }
		elseif($data=="lockadd" && $settings2["information"]["add"] == "Active ✓"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev)){
$setadd = $settings2["information"]["setadd"];
          bot('editmessagetext',[
              'chat_id'=>$chatid,
   'message_id'=>$messageid,
             'text'=>"
به بخش تنظیمات ادد اجباری خوش آمدید

اد اجباری خاموش شد !",
             'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
    [
					 ['text'=>"اد اجباری : غیرفعال",'callback_data'=>'lockadd']
					 ],
					 [
					 ['text'=>"میزان دعوت",'callback_data'=>'text']
					 ],
					 [
					 ['text'=>"کاهش",'callback_data'=>'add-'],['text'=>"$setadd",'callback_data'=>'text'],['text'=>"افزایش",'callback_data'=>'add+']
					 ],
					 [
					 ['text'=>"برگشت »",'callback_data'=>'panel3']
					 ],
                     ]
               ])
	]);
$settings2["information"]["add"]="Inactive ✗";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
	}else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
	}
		  }
		  		elseif($data=="lockadd" && $settings2["information"]["add"] == "Inactive ✗"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev)){
$setadd = $settings2["information"]["setadd"];
          bot('editmessagetext',[
              'chat_id'=>$chatid,
   'message_id'=>$messageid,
             'text'=>"
به بخش تنظیمات ادد اجباری خوش آمدید

اد اجباری خاموش شد !",
             'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
    [
                     ['text'=>"اد اجباری : فعال",'callback_data'=>'lockadd']
					 ],
					 [
					 ['text'=>"میزان دعوت",'callback_data'=>'text']
					 ],
					 [
					 ['text'=>"کاهش",'callback_data'=>'add-'],['text'=>"$setadd",'callback_data'=>'text'],['text'=>"افزایش",'callback_data'=>'add+']
					 ],
					 [
					 ['text'=>"برگشت »",'callback_data'=>'panel3']
					 ],
                     ]
               ])
	]);
$settings2["information"]["add"]="Active ✓";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
	}else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
	}
		  }
		  		  		elseif($data=="add+"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev)){
$setadd = $settings2["information"]["setadd"];
$add = $settings2["information"]["add"];
$manfi = $setadd + 1;
if($manfi <= 20 && $manfi >= 1){
          bot('editmessagetext',[
              'chat_id'=>$chatid,
   'message_id'=>$messageid,
             'text'=>"
به بخش تنظیمات اد اجباری خوش آمدید

 مقدار دعوت افزایش یافت !",
             'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
    [
                     ['text'=>"اد اجباری : فعال",'callback_data'=>'lockadd']
					 ],
					 [
					 ['text'=>"میزان دعوت",'callback_data'=>'text']
					 ],
					 [
					 ['text'=>"کاهش",'callback_data'=>'add-'],['text'=>"$manfi",'callback_data'=>'text'],['text'=>"افزایش",'callback_data'=>'add+']
					 ],
					 [
					 ['text'=>"برگشت »",'callback_data'=>'panel3']
					 ],
                     ]
               ])
	]);
$settings2["information"]["setadd"]="$manfi";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
}
else
{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"• امکان تغییر دیگر وجود ندارد !",
]);
	}
		 }
	else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
	}
		  }
								  		  		elseif($data=="add-"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev)){
$setadd = $settings2["information"]["setadd"];
$add = $settings2["information"]["add"];
$manfi = $setadd - 1;
    if ($manfi <= 20 && $manfi >= 1){
          bot('editmessagetext',[
              'chat_id'=>$chatid,
   'message_id'=>$messageid,
             'text'=>"
به بخش تنظیمات ادد اجباری خوش آمدید

 مقدار دعوت کاهش یافت !",
             'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
    [
                     ['text'=>"اد اجباری : فعال",'callback_data'=>'lockadd']
					 ],
					 [
					 ['text'=>"میزان دعوت",'callback_data'=>'text']
					 ],
					 [
					 ['text'=>"کاهش",'callback_data'=>'add-'],['text'=>"$manfi",'callback_data'=>'text'],['text'=>"افزایش",'callback_data'=>'add+']
					 ],
					 [
					 ['text'=>"برگشت »",'callback_data'=>'panel3']
					 ],
                     ]
               ])
	]);
$settings2["information"]["setadd"]="$manfi";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
}
else
{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"• امکان تغییر دیگر وجود ندارد !",
]);
	}
		 }
	else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
	}
		  }
//=======================================================================================
// lock
// lock link
/////  editor: AriKord   /////
if($textmassage=="Lock link" or $textmassage=="lock link" or $textmassage=="قفل لینک"){
if ($status == 'creator' or $status == 'administrator' or in_array($from_id,$dev) ){
$add = $settings["information"]["added"];
if ($add == true) {
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• قفل لینک فعال شد !",
  'reply_to_message_id'=>$message_id,

 ]);
$settings["lock"]["link"]="Active ✓";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• ربات در گروه نصب نشده است !

",
  'reply_to_message_id'=>$message_id,

 ]);
	}
}
}
elseif($textmassage=="Unlock link" or $textmassage=="unlock link" or $textmassage=="بازکردن لینک"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev) ){
$add = $settings["information"]["added"];
if ($add == true) {
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• قفل لینک غیرفعال شد !",
  'reply_to_message_id'=>$message_id,

 ]);
$settings["lock"]["link"]="Inactive ✗";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• ربات در گروه نصب نشده است !

 ",
  'reply_to_message_id'=>$message_id,

 ]);
	}
}
}
// lock photo
elseif($textmassage=="Lock photo" or $textmassage=="lock photo" or $textmassage=="قفل عکس"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev) ){
$add = $settings["information"]["added"];
if ($add == true) {	
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• قفل عکس فعال شد !",
  'reply_to_message_id'=>$message_id,

 ]);
$settings["lock"]["photo"]="Active ✓";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• ربات در گروه نصب نشده است !

 ",
  'reply_to_message_id'=>$message_id,

 ]);
	}
}
}
elseif($textmassage=="Unlock photo" or $textmassage=="unlock photo" or $textmassage=="بازکردن عکس"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev) ){
$add = $settings["information"]["added"];
if ($add == true) {
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• قفل عکس غیرفعال شد !",
  'reply_to_message_id'=>$message_id,

 ]);
$settings["lock"]["photo"]="Inactive ✗";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• ربات در گروه نصب نشده است !

 ",
  'reply_to_message_id'=>$message_id,

 ]);
	}
}
}
// gif
elseif($textmassage=="Lock gif" or $textmassage=="lock gif" or $textmassage=="قفل گیف"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev) ){
$add = $settings["information"]["added"];
if ($add == true) {
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• قفل گیف فعال شد !",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["gif"]="Active ✓";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• ربات در گروه نصب نشده است !

",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
	}
}
}
elseif($textmassage=="Unlock gif" or $textmassage=="unlock gif" or $textmassage=="بازکردن گیف"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev) ){
$add = $settings["information"]["added"];
if ($add == true) {
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• قفل گیف غیرفعال شد !",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["gif"]="Inactive ✗";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• ربات در گروه نصب نشده است !

",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
	}
}
}
// document
elseif($textmassage=="Lock document" or $textmassage=="lock document" or $textmassage=="قفل فایل"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev) ){
$add = $settings["information"]["added"];
if ($add == true) {
	bot('sendmessage',[
	'chat_id'=>$chat_id,
'text'=>"• قفل فایل فعال شد !",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["document"]="Active ✓";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• ربات در گروه نصب نشده است !

",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
	}
}
}
elseif($textmassage=="Unlock document" or $textmassage=="unlock document" or $textmassage=="بازکردن فایل"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev) ){
$add = $settings["information"]["added"];
if ($add == true) {
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• قفل فایل غیرفعال شد !",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["document"]="Inactive ✗";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• ربات در گروه نصب نشده است !

",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
	}
}
}
// video
elseif($textmassage=="Lock video" or $textmassage=="lock video" or $textmassage=="قفل فیلم"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev) ){
$add = $settings["information"]["added"];
if ($add == true) {
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• قفل فیلم فعال شد !",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["video"]="Active ✓";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• ربات در گروه نصب نشده است !

",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
	}
}
}
elseif($textmassage=="Unlock video" or $textmassage=="unlock video" or $textmassage=="بازکردن فیلم"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev) ){
$add = $settings["information"]["added"];
if ($add == true) {
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• قفل فیلم غیرفعال شد !",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["video"]="Inactive ✗";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• ربات در گروه نصب نشده است !

",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
	}
}
}
// edit
elseif($textmassage=="Lock edit" or $textmassage=="lock edit" or $textmassage=="قفل ویرایش"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev) ){
$add = $settings["information"]["added"];
if ($add == true) {
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• قفل ویرایش پیام فعال شد !",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["edit"]="Active ✓";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• ربات در گروه نصب نشده است !

",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
	}
}
}
elseif($textmassage=="Unlock edit" or $textmassage=="unlock edit" or $textmassage=="بازکردن ویرایش"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev) ){
$add = $settings["information"]["added"];
if ($add == true) {
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• قفل ویرایش پیام غیرفعال شد !",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["edit"]="Inactive ✗";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• ربات در گروه نصب نشده است !

",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
	}
}
}
// game
elseif($textmassage=="Lock game" or $textmassage=="lock game" or $textmassage=="قفل بازی"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev) ){
$add = $settings["information"]["added"];
if ($add == true) {
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• قفل بازی فعال شد !",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["game"]="Active ✓";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• ربات در گروه نصب نشده است !

",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
	}
}
}
elseif($textmassage=="Unlock game" or $textmassage=="unlock game" or $textmassage=="بازکردن بازی"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev) ){
$add = $settings["information"]["added"];
if ($add == true) {
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• قفل بازی غیرفعال شد !",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
 $settings["lock"]["game"]="Inactive ✗";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• ربات در گروه نصب نشده است !

",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
	}
}
}
// location
elseif($textmassage=="Lock location" or $textmassage=="lock location" or $textmassage=="قفل موقعیت مکانی"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev) ){
$add = $settings["information"]["added"];
if ($add == true) {
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• قفل موقعیت مکانی فعال شد !",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["location"]="Active ✓";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• ربات در گروه نصب نشده است !

",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
	}
}
}
elseif($textmassage=="Unlock location" or $textmassage=="unlock location" or $textmassage=="بازکردن موقعیت مکانی"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev) ){
$add = $settings["information"]["added"];
if ($add == true) {
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• قفل موقعیت مکانی غیرفعال شد !",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["location"]="Inactive ✗";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• ربات در گروه نصب نشده است !

",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
	}
}
}
// contact
elseif($textmassage=="Lock contact" or $textmassage=="lock contact" or $textmassage=="قفل مخاطب"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev) ){
$add = $settings["information"]["added"];
if ($add == true) {
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• قفل مخاطب فعال شد !",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["contact"]="Active ✓";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• ربات در گروه نصب نشده است !

",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
	}
}
}
elseif($textmassage=="Unlock contact" or $textmassage=="lock contact" or $textmassage=="بازکردن مخاطب"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev) ){
$add = $settings["information"]["added"];
if ($add == true) {
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• قفل مخاطب غیرفعال شد !",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["contact"]="Inactive ✗";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• ربات در گروه نصب نشده است !

",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
	}
}
}
// tag
elseif($textmassage=="Lock hashtag" or  $textmassage=="lock hashtag" or $textmassage=="قفل هشتگ"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev) ){
$add = $settings["information"]["added"];
if ($add == true) {
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• قفل هشتگ فعال شد !",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["tag"]="Active ✓";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• ربات در گروه نصب نشده است !

",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
	}
}
}
elseif($textmassage=="Unlock hashtag" or $textmassage=="unlock hashtag" or $textmassage=="بازکردن هشتگ"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev) ){
$add = $settings["information"]["added"];
if ($add == true) {
	bot('sendmessage',[
	'chat_id'=>$chat_id,
'text'=>"• قفل هشتگ غیرفعال شد !",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["tag"]="Inactive ✗";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• ربات در گروه نصب نشده است !

",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
	}
}
}
// username 
if($textmassage=="Lock tag" or $textmassage=="lock tag" or $textmassage=="قفل تگ"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev) ){
$add = $settings["information"]["added"];
if ($add == true) {
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• قفل تگ فعال شد !",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["username"]="Active ✓";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• ربات در گروه نصب نشده است !

",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
	}
}
}
elseif($textmassage=="Unlock tag" or $textmassage=="unlock tag" or $textmassage=="بازکردن تگ"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev) ){
$add = $settings["information"]["added"];
if ($add == true) {
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• قفل تگ غیرفعال شد !",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["username"]="Inactive ✗";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• ربات در گروه نصب نشده است !

",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
	}
}
}
// audio
elseif($textmassage=="Lock music" or $textmassage=="lock music" or $textmassage=="قفل موزیک"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev) ){
$add = $settings["information"]["added"];
if ($add == true) {
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• قفل موزیک فعال شد !",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["audio"]="Active ✓";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• ربات در گروه نصب نشده است !

",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
	}
}
}
elseif($textmassage=="Unlock music" or $textmassage=="lock music" or $textmassage=="بازکردن موزیک"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev) ){
$add = $settings["information"]["added"];
if ($add == true) {
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• قفل موزیک غیرفعال شد !",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["audio"]="Inactive ✗";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• ربات در گروه نصب نشده است !

",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
	}
}
}
// voice
if($textmassage=="Lock voice" or $textmassage=="lock voice" or $textmassage=="قفل ویس"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev) ){
$add = $settings["information"]["added"];
if ($add == true) {
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• قفل ویس فعال شد !",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["voice"]="Active ✓";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• ربات در گروه نصب نشده است !

",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
	}
}
}
elseif($textmassage=="Unlock voice" or $textmassage=="unlock voice" or $textmassage=="بازکردن ویس"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev) ){
$add = $settings["information"]["added"];
if ($add == true) {
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• قفل ویس غیرفعال شد !",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["voice"]="Inactive ✗";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• ربات در گروه نصب نشده است !

",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
	}
}
}
// sticker
elseif($textmassage=="Lock sticker" or $textmassage=="lock sticker" or $textmassage=="قفل استیکر"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev) ){
$add = $settings["information"]["added"];
if ($add == true) {
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• قفل استیکر فعال شد !",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["sticker"]="Active ✓";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• ربات در گروه نصب نشده است !

",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
	}
}
}
elseif($textmassage=="Unlock sticker" or $textmassage=="unlock sticker" or $textmassage=="بازکردن استیکر"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev) ) {
$add = $settings["information"]["added"];
if ($add == true) {
  	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• قفل استیکر غیرفعال شد !",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["sticker"]="Inactive ✗";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• ربات در گروه نصب نشده است !

",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
	}
}
}
// forward
elseif($textmassage=="Lock forward" or $textmassage=="lock forward" or $textmassage=="قفل فوروارد"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev) ) {
$add = $settings["information"]["added"];
if ($add == true) {
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• قفل فوروارد فعال شد !",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["forward"]="Active ✓";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• ربات در گروه نصب نشده است !

",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
	}
}
}
elseif($textmassage=="Unlock forward" or $textmassage=="unlock forward" or $textmassage=="بازکردن فوروارد"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev) ) {
$add = $settings["information"]["added"];
if ($add == true) {
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• قفل فوروارد غیرفعال شد !",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["forward"]="Inactive ✗";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• ربات در گروه نصب نشده است !

",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
	}
}
}
// fosh
elseif($textmassage=="Lock fosh" or $textmassage=="lock fosh" or $textmassage=="قفل فحش"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev) ) {
$add = $settings["information"]["added"];
if ($add == true) {
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• قفل فحش فعال شد !",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["fosh"]="Active ✓";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• ربات در گروه نصب نشده است !

",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
	}
}
}
elseif($textmassage=="Unlock fosh" or $textmassage=="unlock fosh" or $textmassage=="بازکردن فحش"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev) ) {
$add = $settings["information"]["added"];
if ($add == true) {
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• قفل فحش غیرفعال شد !",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["fosh"]="Inactive ✗";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• ربات در گروه نصب نشده است !

",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
	}
}
}
// muteall
elseif($textmassage=="Lock group"  or $textmassage=="lock group" or $textmassage=="قفل گروه"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev) ) {
$add = $settings["information"]["added"];
if ($add == true) {
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• قفل گروه فعال شد !",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["mute_all"]="Active ✓";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• ربات در گروه نصب نشده است !

",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
	}
}
}
elseif($textmassage=="Unlock group"  or $textmassage=="unlock group" or $textmassage=="بازکردن گروه"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev) ) {
$add = $settings["information"]["added"];
if ($add == true) {
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• قفل گروه غیرفعال شد !",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["mute_all"]="Inactive ✗";
$settings["lock"]["mute_all_time"]="Inactive ✗";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• ربات در گروه نصب نشده است !

",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
	}
}
}
// muteall time
elseif (strpos($textmassage , "Lock group ") !== false or strpos($textmassage , "قفل گروه ") !== false) {
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev) ) {
	$num = str_replace(['Lock group ','قفل گروه '],'',$textmassage);
	$add = $settings["information"]["added"];
if ($add == true) {
	if ($num <= 100000 && $num >= 1){
		date_default_timezone_set('Asia/Tehran');
        $date1 = date("h:i:s");
        $date2 = isset($_GET['date']) ? $_GET['date'] : date("h:i:s");
        $next_date = date('h:i:s', strtotime($date2 ."+$num Minutes"));
			  bot('sendmessage',[
            'chat_id'=>$chat_id,
            'text'=>"• قفل گروه با موفقیت برای $num دقیقه فعال شد.
			
قفل گروه از ساعت $date1 تا ساعت $next_date فعال خواهد بود !",
'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
   ]);
$settings["information"]["mute_all_time"]="$next_date";
$settings["lock"]["mute_all_time"]="Active ✓";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings); 
   }else{
bot('sendmessage',[
 'chat_id' => $chat_id,
 'text'=>"• عدد وارد شده باید بین 1 تا 1000 باشد.
$date1
$nextdata",
'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
   ]);
}
}
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• ربات در گروه نصب نشده است !

",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
}
}
}
// farsi
if($textmassage=="Lock text" or $textmassage=="lock text" or $textmassage=="قفل متن"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev) ) {
$add = $settings["information"]["added"];
if ($add == true) {
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• قفل متن فعال شد !",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["text"]="Active ✓";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• ربات در گروه نصب نشده است !

",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
	}
}
}
elseif($textmassage=="Unlock text" or $textmassage=="unlock text" or $textmassage=="بازکردن متن"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev) ) {
$add = $settings["information"]["added"];
if ($add == true) {
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• قفل متن غیرفعال شد !",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["text"]="Inactive ✗";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• ربات در گروه نصب نشده است !

",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
	}
}
}
// cmd
elseif($textmassage=="Lock cmd" or $textmassage=="lock cmd" or $textmassage=="قفل دستورات"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev) ) {
$add = $settings["information"]["added"];
if ($add == true) {
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• قفل دستورات فعال شد !",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["cmd"]="Active ✓";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• ربات در گروه نصب نشده است !

",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
	}
}
}
if($textmassage=="Unlock cmd" or $textmassage=="unlock cmd" or $textmassage=="بازکردن دستورات"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev) ) {
$add = $settings["information"]["added"];
if ($add == true) {
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• قفل دستورات غیرفعال شد !",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["cmd"]="Inactive ✗";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• ربات در گروه نصب نشده است !

",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
	}
}
}
// replay
elseif($textmassage=="Lock reply" or $textmassage=="lock reply" or $textmassage=="قفل ریپلی"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev) ) {
$add = $settings["information"]["added"];
if ($add == true) {
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• قفل ریپلی فعال شد !",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["reply"]="Active ✓";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• ربات در گروه نصب نشده است !

",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
	}
}
}
elseif($textmassage=="Unlock reply" or $textmassage=="unlock reply" or $textmassage=="بازکردن ریپلی"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev) ) {
$add = $settings["information"]["added"];
if ($add == true) {
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• قفل ریپلی غیرفعال شد !",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["reply"]="Inactive ✗";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• ربات در گروه نصب نشده است !

",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
	}
}
}
// tgservic
elseif($textmassage=="Lock tgservice" or $textmassage=="lock tgservic" or $textmassage=="قفل سرویس تلگرام"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev) ) {
$add = $settings["information"]["added"];
if ($add == true) {
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• قفل سرویس تلگرام فعال شد !",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["tgservic"]="Active ✓";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• ربات در گروه نصب نشده است !

",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
	}
}
}
elseif($textmassage=="Unlock tgservice" or $textmassage=="unlock tgservic" or $textmassage=="بازکردن سرویس تلگرام"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev) ) {
$add = $settings["information"]["added"];
if ($add == true) {
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• قفل سرویس تلگرام غیرفعال شد !",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["tgservic"]="Inactive ✗";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• ربات در گروه نصب نشده است !

",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
	}
}
}
// video note
elseif($textmassage=="Lock selfvideo" or $textmassage=="lock selfvideo" or $textmassage=="قفل فیلم سلفی"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev) ) {
$add = $settings["information"]["added"];
if ($add == true) {
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• قفل فیلم سلفی فعال شد !",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["video_msg"]="Active ✓";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• ربات در گروه نصب نشده است !

",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
	}
}
}
if($textmassage=="Unlock selfvideo" or $textmassage=="unlock selfvideo" or $textmassage=="بازکردن فیلم سلفی"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev) ) {
$add = $settings["information"]["added"];
if ($add == true) {
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• قفل فیلم سلفی غیرفعال شد !",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["video_msg"]="Inactive ✗";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• ربات در گروه نصب نشده است !

",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
	}
}
}
// lock bots
if ($textmassage == "Lock bot" or $textmassage == "lock bot" or $textmassage == "قفل ربات") {
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev)) {
$add = $settings["information"]["added"];
if ($add == true) {
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• قفل ورود ربات فعال شد !",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["bot"]="Active ✓";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• ربات در گروه نصب نشده است !

",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
	}
}
}
if ($textmassage == "Unlock bot" or $textmassage == "unlock bot"  or $textmassage == "بازکردن ربات") {
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev) ) {
$add = $settings["information"]["added"];
if ($add == true) {
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• قفل ورود ربات غیرفعال شد !",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["bot"]="Inactive ✗";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• ربات در گروه نصب نشده است !

",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
	}
}
}
// end lock
//=======================================================================================
if($textmassage == "Channel on" or $textmassage == "channel on" or $textmassage == "قفل کانال روشن"){
if ($tc == 'group' | $tc == 'supergroup'){  
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev)){
$add = $settings["information"]["added"];
if ($add == true) {
 bot('sendMessage',[
    'chat_id'=>$chat_id,
    'text'=>"• عضویت اجباری کانال با موفقیت فعال شد !",
		 'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
   ]);
$settings["information"]["lockchannel"]="Active ✓";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• ربات در گروه نصب نشده است !",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
}
}
   }   
}
elseif($textmassage == "Channel off" or $textmassage == "channel off" or $textmassage == "قفل کانال خاموش"){
if ($tc == 'group' | $tc == 'supergroup'){  
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev)){
$add = $settings["information"]["added"];
if ($add == true) {
 bot('sendMessage',[
    'chat_id'=>$chat_id,
    'text'=>"• عضویت اجباری کانال با موفقیت غیرفعال شد !",
		 'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
   ]);
$settings["information"]["lockchannel"]="Inactive ✗";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• ربات در گروه نصب نشده است !",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
}
}
   }   
}
elseif ( strpos($textmassage , 'Setchannel ') !== false or strpos($textmassage , 'تنظیم کانال ') !== false) {
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev)){
$add = $settings["information"]["added"];
if ($add == true) {
$code = $num = str_replace(['Setchannel ','تنظیم کانال '],'',$textmassage);
 bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• کانال عضویت اجباری تنظیم شد !",
'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
   ]);
$settings["information"]["setchannel"]="$code";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• ربات در گروه نصب نشده است !",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
}
}
   }  
					elseif($data=="lockchannel"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev)){
$add = $settings2["information"]["lockchannel"];
$setadd = $settings2["information"]["setchannel"];
          bot('editmessagetext',[
              'chat_id'=>$chatid,
   'message_id'=>$messageid,
             'text'=>"
به بخش تنظیمات قفل کانال خوش آمدید .

از دکمه های زیر استفاده کنید",
             'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
    [
                     ['text'=>"قفل کانال : $add",'callback_data'=>'channellock']
					 ],
					 [
					 ['text'=>"کانال تنظیم شده : $setadd",'callback_data'=>'text'],['text'=>"تنظیم کانال",'callback_data'=>'setchannel']
					 ],
					 [
					 ['text'=>"برگشت »",'callback_data'=>'panel2']
					 ],
                     ]
               ])
	]);
$settings2["information"]["step"]="none";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
	}else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
	}
		  }
		elseif($data=="channellock" && $settings2["information"]["lockchannel"] == "Active ✓"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev)){
$setadd = $settings2["information"]["setchannel"];
          bot('editmessagetext',[
              'chat_id'=>$chatid,
   'message_id'=>$messageid,
             'text'=>"🥇به بخش تنظیمات قفل کانال خوش آمدید .

■  قفل کانال خاموش شد !",
             'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
    [
                     ['text'=>"قفل کانال : غیرفعال",'callback_data'=>'channellock']
					 ],
					 [
					 ['text'=>"کانال تنظیم شده : $setadd",'callback_data'=>'text'],['text'=>"تنظیم کانال",'callback_data'=>'setchannel']
					 ],
					 [
					 ['text'=>"برگشت »",'callback_data'=>'panel2']
					 ],
                     ]
               ])
	]);
$settings2["information"]["lockchannel"]="Inactive ✗";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
	}else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
	}
		  }
		  		elseif($data=="channellock" && $settings2["information"]["lockchannel"] == "Inactive ✗"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev)){
$setadd = $settings2["information"]["setchannel"];
          bot('editmessagetext',[
              'chat_id'=>$chatid,
   'message_id'=>$messageid,
             'text'=>"
به بخش تنظیمات قفل کانال خوش آمدید .

قفل کانال روشن شد !",
             'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
    [
                     ['text'=>"قفل کانال : فـعـالــ",'callback_data'=>'channellock']
					 ],
					 [
					 ['text'=>"کانال تنظیم شده : $setadd",'callback_data'=>'text'],['text'=>"تنظیم کانال",'callback_data'=>'setchannel']
					 ],
					 [
					 ['text'=>"برگشت »",'callback_data'=>'panel2']
					 ],
                     ]
               ])
	]);
$settings2["information"]["lockchannel"]="Active ✓";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
	}else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
	}
		  }
		  		  		elseif($data=="setchannel"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev)){
          bot('editmessagetext',[
              'chat_id'=>$chatid,
   'message_id'=>$messageid,
             'text'=>"
نام کاربری کانال خود را همراه با @ ارسال کنید :

هشدار
ربات حتما باید در کانال تنظیم شده ادمین باشد تا بتواند عمل کند",
             'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
					 [
					 ['text'=>"برگشت »",'callback_data'=>'lockchannel']
					 ],
                     ]
               ])
	]);
$settings2["information"]["step"]="setchannel";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
	}else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
	}
		  }
// lock auto cmd 
if($textmassage=="Lock auto" or $textmassage=="lock auto" or $textmassage=="قفل خودکار روشن"){
if ($status == 'creator' or $status == 'administrator' or in_array($from_id,$dev) ){
$add = $settings["information"]["added"];
if ($add == true) {
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• قفل خودکار فعال شد !",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["lockauto"]="Active ✓";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• ربات در گروه نصب نشده است !",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
	}
}
}
elseif($textmassage=="Unlock auto" or $textmassage=="unlock auto" or $textmassage=="قفل خودکار خاموش"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev) ){
$add = $settings["information"]["added"];
if ($add == true) {
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• قفل خودکار غیرفعال شد !",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["lockauto"]="Inactive ✗";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• ربات در گروه نصب نشده است !",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
	}
}
}
if (strpos($textmassage , "Setlockauto ") !== false or strpos($textmassage , "تنظیم قفل خودکار ") !== false) {
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev) ) {
$num = str_replace(['Setlockauto ','تنظیم قفل خودکار '],'',$textmassage);
$add = $settings["information"]["added"];
if ($add == true) {
$te = explode(" ",$num);
date_default_timezone_set('Asia/Tehran');
$date1 = date("H:i:s");
$startlock = $te[0];
$endlock = $te[1];
			  bot('sendmessage',[
            'chat_id'=>$chat_id,
            'text'=>"
•• قفل خودکار تنظیم شد !
			
گروه به صورت خودکار ساعت $startlock قفل و در ساعت $endlock باز می شود !",
'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
   ]);
$settings["information"]["timelock"]="$startlock";
$settings["information"]["timeunlock"]="$endlock";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings); 
}
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• ربات در گروه نصب نشده است !",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
}
}
}
//=======================================================================================
//leave and rem
if($textmassage == 'Leave'  or $textmassage == 'leave'  or $textmassage == 'ترک'){
if (in_array($from_id,$dev)){
bot('sendMessage',[
  'chat_id'=>$chat_id,
  'text'=>"
• به دستور مدیر ؛ ربات این گروه را ترک می کند !",
  'reply_to_message_id'=>$message_id,

   ]);
bot('LeaveChat',[
  'chat_id'=>$chat_id,
  ]);
  }
}
  elseif($textmassage == 'Rem' or $textmassage == 'rem'  or  $textmassage == 'حذف' ){
	  if (in_array($from_id,$dev)){
bot('sendMessage',[
  'chat_id'=>$chat_id,
  'text'=>"
• گروه از لیست گروه های تحت پشتیبانی ربات حذف شد !",
'reply_to_message_id'=>$message_id,

   ]);
unlink("data/$chat_id.json");
   }  
  }   
 // tools and cmd
 //rules
elseif($textmassage=="Rules" or $textmassage=="rules" or $textmassage=="قوانین"){
if ($tc == 'group' | $tc == 'supergroup'){  
$lockcmd = $settings["lock"]["cmd"];
if ($lockcmd == "Inactive ✗") {
$text = $settings["information"]["rules"];
 bot('sendMessage',[
    'chat_id'=>$chat_id,
    'text'=>"• قوانین گروه :

$text",
		 
		 'reply_to_message_id'=>$message_id,

   ]);
   }   
}
}
elseif (strpos($textmassage , 'Setrules ') !== false or strpos($textmassage , 'تنظیم قوانین ') !== false) {
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev)){
$add = $settings["information"]["added"];
if ($add == true) {
$code = str_replace(['Setrules ','تنظیم قوانین '],'',$textmassage);
$plus = mb_strlen("$code");
if($plus < 600) {
 bot('sendMessage',[
    'chat_id'=>$chat_id,
    'text'=>"• قوانین جدید گروه ثبت شد !",
'reply_to_message_id'=>$message_id,

   ]);
$settings["information"]["rules"]="$code";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
	}
else
{
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"
• تعداد کلمات وارد شده بیش از حد مجاز است حداکثر میتوانید 600 حرف را وارد کنید !",
  'reply_to_message_id'=>$message_id,

 ]);
}
}
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• ربات در گروه نصب نشده است !",
  'reply_to_message_id'=>$message_id,

 ]);	
}
}
}
//pin
elseif($rt && $textmassage=="Pin"  or $rt && $textmassage=="pin" or $rt && $textmassage=="سنجاق"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev)){
 bot('pinChatMessage',[
    'chat_id'=>$chat_id,
    'message_id'=>$replyid
      ]);
bot('sendmessage',[
 'chat_id'=>$chat_id,
 'text'=>"• پیام مورد نظر سنجاق شد !",
'reply_to_message_id'=>$message_id,

 ]);
 }
}
elseif($textmassage=="Unpin"  or  $textmassage=="unpin"  or  $textmassage=="حذف سنجاق"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev)){
 bot('unpinChatMessage',[
    'chat_id'=>$chat_id,
    'message_id'=>$replyid
      ]);
bot('sendmessage',[
 'chat_id'=>$chat_id,
 'text'=>"• پیام مورد نظر از حالت سنجاق خارج شد !",
'reply_to_message_id'=>$message_id,

 ]);
 }
}
// kick

 elseif($rt && $textmassage=="Ban"  or $rt && $textmassage=="ban" or $rt && $textmassage== "مسدود"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev)){
if ( $statusrt != 'creator' && $statusrt != 'administrator' && !in_array($re_id,$dev)) {
	bot('KickChatMember',[
    'chat_id'=>$chat_id,
    'user_id'=>$re_id
      ]);
bot('sendmessage',[
    'parse_mode'=>"HTML",
	'chat_id'=>$chat_id,
	'text'=>"• کاربر ( $re_name ) مسدود شد !",
'reply_to_message_id'=>$message_id,
	    'reply_markup'=>json_encode([
      'inline_keyboard'=>[
     [
    ['text'=>"$re_name", 'url'=>"https://telegram.me/$re_user"]
    ],
    ]
    ])
   ]);
   } 
else	
{
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• شما نمیتوانید مدیران را مسدود کنید !",
  'reply_to_message_id'=>$message_id,

 ]);
   }
}
 }
   //del
elseif($rt && $textmassage == "Del" or $rt && $textmassage == "del" or $rt && $textmassage == "پاک کردن"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev)){
 bot('deletemessage',[
    'chat_id'=>$chat_id,
    'message_id'=>$re_msgid
    ]);
	 bot('deletemessage',[
    'chat_id'=>$chat_id,
    'message_id'=>$message_id
    ]);
 }
}
// rmsg

elseif ( strpos($textmassage , 'Clean ') !== false or strpos($textmassage , 'پاکسازی ') !== false  ) {
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev)){
$num = str_replace(['Clean ','پاکسازی '],'',$textmassage);
if ($num <= 300 && $num >= 1){
$add = $settings["information"]["added"];
if ($add == true) {
for($i=$message_id; $i>=$message_id-$num; $i--){
bot('deletemessage',[
 'chat_id' => $chat_id,
 'message_id' =>$i,
              ]);
}
bot('sendmessage',[
 'chat_id' => $chat_id,
 'text' =>"• تعداد ( $num ) پیام اخیر حذف شد !",

   ]);
}
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• ربات در گروه نصب نشده است !",
  'reply_to_message_id'=>$message_id,

 ]);
}
}
else
{
bot('sendmessage',[
 'chat_id' => $chat_id,
 'text'=>"• عدد وارد شده باید بین 1 تا 300 باشد !",

   ]);
}
}
}
//  setname
elseif ( strpos($textmassage , 'Setname ') !== false or strpos($textmassage , 'تنظیم نام ') !== false  ) {
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev)){
$newname= str_replace(['Setname ','تنظیم نام '],'',$textmassage);
 bot('setChatTitle',[
    'chat_id'=>$chat_id,
    'title'=>$newname
      ]);
bot('sendmessage',[
 'chat_id'=>$chat_id,
 'text'=>"• نام گروه به [ $newname ] تغییر پیدا کرد !",
'reply_to_message_id'=>$message_id,

   ]);
 }
}
// description
elseif ( strpos($textmassage , 'Setdescription ') !== false or strpos($textmassage , 'تنظیم اطلاعات ') !== false  ) {
$newdec= str_replace(['Setdescription ','تنظیم اطلاعات '],'',$textmassage);
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev)){
 bot('setChatDescription',[
    'chat_id'=>$chat_id,
    'description'=>$newdec
      ]);
bot('sendmessage',[
 'chat_id'=>$chat_id,
 'text'=>"• اطلاعات گروه با موفقیت تغییر کرد !",
'reply_to_message_id'=>$message_id,

   ]);
 }
}
// set photo
elseif($textmassage=="Del photo" or $textmassage=="del photo" or $textmassage=="حذف عکس"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev)){
bot('deleteChatPhoto',[
   'chat_id'=>$chat_id,
     ]);
bot('sendmessage',[
 'chat_id'=>$chat_id,
 'text'=>"
• عکس گروه با موفقیت حذف شد !",
'reply_to_message_id'=>$message_id,

   ]);
 }
}
elseif($textmassage=="Setphoto" or $textmassage=="setphoto" or $textmassage=="تنظیم عکس"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev)){
$photo = $update->message->reply_to_message->photo;
$file = $photo[count($photo)-1]->file_id;
      $get = bot('getfile',['file_id'=>$file]);
      	  $getchat = json_decode($get, true);
      $patch = $getchat["result"]["file_path"];
    file_put_contents("data/photogp.png",file_get_contents("https://api.telegram.org/file/bot$token/$patch"));
bot('setChatPhoto',[
   'chat_id'=>$chat_id,
   'photo'=>new CURLFile("data/photogp.png")
     ]);
bot('sendmessage',[
 'chat_id'=>$chat_id,
 'text'=>"• عکس گروه با موفقیت تغییر کرد !",
'reply_to_message_id'=>$message_id,

   ]);
unlink("data/photogp.png");
 }
}
// link
 elseif($textmassage=="Link" or $textmassage=="link" or $textmassage=="لینک"){
if ($tc == 'group' | $tc == 'supergroup'){  
$lockcmd = $settings["lock"]["cmd"];
if ($lockcmd == "Inactive ✗") {
$getlink = file_get_contents("https://api.telegram.org/bot$token/exportChatInviteLink?chat_id=$chat_id");
$jsonlink = json_decode($getlink, true);
$getlinkde = $jsonlink['result'];
bot('sendmessage',[
   'chat_id'=>$chat_id,
   'text'=>"
• لینک گروه :
   
$getlinkde",
'reply_to_message_id'=>$message_id,

   ]);
 }
 }
 }
// warn
elseif($textmassage=="Warn" or $textmassage=="warn" or $textmassage=="اخطار" && $rt){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev)){
if ($tc == 'group' | $tc == 'supergroup'){
if ( $statusrt != 'creator' && $statusrt != 'administrator' && !in_array($re_id,$dev)) {
$add = $settings["information"]["added"];
if ($add == true) {
$warn = $settings["warnlist"]["$re_id"];
$setwarn = $settings["information"]["setwarn"];
$warnplus = $warn + 1;	
if ($warnplus >= $setwarn) {
$hardmodewarn = $settings["information"]["hardmodewarn"];
if($hardmodewarn == "اخراج کاربر"){
bot('KickChatMember',[
    'chat_id'=>$chat_id,
    'user_id'=>$re_id
	]);
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"
• کاربر ( $re_name ) به دلیل رسیدن به حداکثر اخطار ها مسدود شد !",
	'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				    [
                    ['text'=>"$re_name",'url'=>'https://telegram.me/$re_user']
				    ],
				    ]
               ])
   ]);
 }
else
{
   bot('restrictChatMember',[
   'user_id'=>$re_id,   
   'chat_id'=>$chat_id,
   'can_post_messages'=>false,
         ]);
		 	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• کاربر ( $re_name ) به دلیل رسیدن به حداکثر اخطار ها بی صدا شد !",
	'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				    [
                    ['text'=>"$re_name",'url'=>'https://telegram.me/$re_user']
				    ],
				    ]
               ])
   ]);
$settings["silentlist"][]="$re_id";
$settings = json_encode($settings,true);
$msg = "[{$re_id}](tg://user?id={$re_id})";
file_put_contents("data/$chat_id.json",$settings);
}
}
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"
• کاربر ( $re_name ) شما به دلیل رعایت نکردن قوانین گروه یک اخطار دریافت کردید !

در صورت گرفتن $setwarn اخطار بنا به دستورات تنظیم شده بی صدا یا مسدود خواهید شد !",
'reply_to_message_id'=>$message_id,
	'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				    [
                    ['text'=>"$re_name",'url'=>'https://telegram.me/$re_user']
				    ],
				    ]
               ])
	 
   ]);
$settings["warnlist"]["{$re_id}"]=$warnplus;
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
}
 else
 {
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• ربات در گروه نصب نشده است !",
  'reply_to_message_id'=>$message_id,

 ]);
 }
 }
else
{
		bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• شما نمیتوانید به مدیران اخطار بدهید !",
  'reply_to_message_id'=>$message_id,

 ]);
}
}
}
}
 elseif($textmassage=="Unwarn" or $textmassage=="unwarn" or $textmassage=="حذف اخطار"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev)){
if ($tc == 'group' | $tc == 'supergroup'){  
$add = $settings["information"]["added"];
if ($add == true) {
$warn = $settings["warnlist"]["$re_id"];
$setwarn = $settings["information"]["setwarn"];
$warnplus = $warn - 1;	
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• تعداد یک اخطار کاربر ( $re_name ) پاکسازی شد !",
'reply_to_message_id'=>$message_id,
'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				    [
                    ['text'=>"$re_name",'url'=>'https://telegram.me/$re_user']
				    ],
				    ]
               ])

   ]);
$settings["warnlist"]["{$re_id}"]=$warnplus;
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
 }
 else
 {
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• ربات در گروه نصب نشده است !",
  'reply_to_message_id'=>$message_id,

 ]);
 }
 }
}
}
elseif ( strpos($textmassage , 'Setwarn ') !== false or strpos($textmassage , 'تنظیم اخطار ') !== false  ) {
$newdec = str_replace(['Setwarn ','تنظیم اخطار '],'',$textmassage);
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev)){
$add = $settings["information"]["added"];
if ($add == true) {
if ($newdec <= 6 && $newdec >= 1){
bot('sendmessage',[
 'chat_id'=>$chat_id,
 'text'=>"
• تعداد حداکثر اخطار ها به [$newdec] تغییر پیدا کرد !",
'reply_to_message_id'=>$message_id,

   ]);
$settings["information"]["setwarn"]="$newdec";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
   }else{
bot('sendmessage',[
 'chat_id' => $chat_id,
 'text'=>"• عدد انتخابی باید بین 1 تا 6 باشد !",

   ]);
 }
}
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• ربات در گروه نصب نشده است !",
  'reply_to_message_id'=>$message_id,

 ]);
}
}
}
elseif($textmassage=="Warn info" or $textmassage=="warn info" or $textmassage=="اطلاعات اخطار"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev) ){
if ($tc == 'group' | $tc == 'supergroup'){  
$warn = $settings["warnlist"]["$re_id"];
$setwarn = $settings["information"]["setwarn"];
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"
• تعداد اخطار ها : $warn
• حداکثر اخطار : $setwarn
",
'reply_to_message_id'=>$message_id,
	 'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				    [
                    ['text'=>"$re_name",'url'=>'https://telegram.me/$re_user']
				    ],
				    ]
               ])
   ]);
 }
 }
 }
 /////  AriKord /////
// setup and setowner
// add
if($textmassage == "Add" or $textmassage == "add" or $textmassage == "نصب" or $textmassage == "/start@$usernamebot" or $textmassage == "/add@$usernamebot") {
if ($status == 'creator' or in_array($from_id,$dev)){
$url = file_get_contents("https://api.telegram.org/bot$token/getChatMembersCount?chat_id=$chat_id");
$getchat = json_decode($url, true);
$howmember = $getchat["result"];
$add = $settings["information"]["added"];
$dataadd = $settings["information"]["dataadded"];
if ($add == true) {
bot('sendMessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"
• گروه در لیست گروه های پشتیبانی ربات بوده است !",
  'reply_to_message_id'=>$message_id,
     ]); 
}
else
{
if($howmember >= 3){
bot('sendMessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"
• گروه با موفقیت به لیست پشتیبانی ربات اضافه شد !
تمایل دارید مدیریت گروه به صورت اتوماتیک انجام شود !؟",
'reply_to_message_id'=>$message_id,
		  	  'reply_markup'=>json_encode([
    'inline_keyboard'=>[
	  	  	 [
				 ['text'=>"• بله",'callback_data'=>"auto1"],['text'=>"• خیر",'callback_data'=>"auto2"]
		 ],
	 ],
	   ])
 ]); 
		        bot('sendmessage',[
            'chat_id'=>$dev[0],
            'text'=>"
• یک گروه به لیست گروه های مدیریتی رایگان اضافه شد !

•• اطلاعات گروه :

شناسه گروه : [$chat_id]

نام گروه : [$namegroup]

توسط : [ @$username ]  
", 
        ]); 
$dateadd = date('Y-m-d', time());
$dateadd2 = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');
$next_date = date('Y-m-d', strtotime($dateadd2 ." +2 day"));
        $settings = '{"lock": {
                "text": "Inactive ✗",
                "photo": "Inactive ✗",
                "link": "Inactive ✗",
                "tag": "Inactive ✗",
				"username": "Inactive ✗",
                "sticker": "Inactive ✗",
                "video": "Inactive ✗",
                "voice": "Inactive ✗",
                "audio": "Inactive ✗",
                "gif": "Inactive ✗",
                "bot": "Inactive ✗",
                "forward": "Inactive ✗",
                "document": "Inactive ✗",
                "tgservic": "Inactive ✗",
				"edit": "Inactive ✗",
				"reply": "Inactive ✗",
				"contact": "Inactive ✗",
				"location": "Inactive ✗",
				"game": "Inactive ✗",
				"cmd": "Inactive ✗",
				"mute_all": "Inactive ✗",
				"mute_all_time": "Inactive ✗",
				"fosh": "Inactive ✗",
				"lockauto": "Inactive ✗",
				"lockcharacter": "Inactive ✗",
				"video_msg": "Inactive ✗"
			},
			"information": {
            "added": "true",
			"welcome": "Inactive ✗",
			"add": "Inactive ✗",
			"lockchannel": "Inactive ✗",
			"hardmodebot": "Inactive ✗",
			"hardmodewarn": "سکوت کاربر️",
			"charge": "7 روز",
			"setadd": "3",
			"dataadded": "",
			"expire": "",
			"textwelcome": "خوش امدید",
			"rules": "ثبت نشده",
			"msg": "",
			"timelock": "00:00",
			"timeunlock": "00:00",
			"pluscharacter": "300",
			"downcharacter": "0",
			"setwarn": "3"
			}
}';
        $settings = json_decode($settings,true);
		$settings["information"]["expire"]="$next_date";
		$settings["information"]["dataadded"]="$dateadd";
		$settings["information"]["msg_id"]="$message_id";
        $settings = json_encode($settings,true);
        file_put_contents("data/$chat_id.json",$settings);
$gpadd = fopen("data/group.txt",'a') or die("Unable to open file!");  
fwrite($gpadd, "
• نام گروه : $namegroup
• شناسه گروه : $chat_id
");
fclose($gpadd);
}
else
{
if ($add != true) {
bot('sendMessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"
• برای فعالسازی ربات ؛ گروه باید حداقل 3 عضو داشته باشد !

لطفا اعضای گروه را افزایش دهید سپس مجدد ربات را اد کرده و دستور add را ارسال کنید !",
  'reply_to_message_id'=>$message_id,
     ]); 
	 bot('LeaveChat',[
  'chat_id'=>$chat_id,
  ]);
}
}
}
}
}
//add
elseif ($textmassage == "Config"  or $textmassage == "Install" or $textmassage == "نصب") {
if (in_array($from_id,$dev)){
if ($tc == 'group' | $tc == 'supergroup'){
$add = $settings["information"]["added"];
if ($add != true) {
bot('sendMessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"
• گروه با موفقیت به لیست پشتیبانی ربات اضافه شد !",
'reply_to_message_id'=>$message_id,
		  	  'reply_markup'=>json_encode([
    'inline_keyboard'=>[
	  	  	 [
				 ['text'=>"• پنل گروه",'callback_data'=>"back"],['text'=>"• راهنمای دستورات",'callback_data'=>"help"]
		 ],

	 ],
	   ])
 ]);  
 		        bot('sendmessage',[
            'chat_id'=>$dev[0],
            'text'=>"
•• یک گروه توسط مدیریت ربات اضافه شد !

• اطلاعات گروه :

شناسه گروه : [$chat_id]

نام گروه : [$namegroup]

توسط : [ @$username ] 
", 
        ]); 
$dateadd = date('Y-m-d', time());
$dateadd2 = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');
$next_date = date('Y-m-d', strtotime($dateadd2 ." +10 day"));
        $settings = '{"lock": {
                "text": "Inactive ✗",
                "photo": "Inactive ✗",
                "link": "Inactive ✗",
                "tag": "Inactive ✗",
				"username": "Inactive ✗",
                "sticker": "Inactive ✗",
                "video": "Inactive ✗",
                "voice": "Inactive ✗",
                "audio": "Inactive ✗",
                "gif": "Inactive ✗",
                "bot": "Inactive ✗",
                "forward": "Inactive ✗",
                "document": "Inactive ✗",
                "tgservic": "Inactive ✗",
				"edit": "Inactive ✗",
				"reply": "Inactive ✗",
				"contact": "Inactive ✗",
				"location": "Inactive ✗",
				"game": "Inactive ✗",
				"cmd": "Inactive ✗",
				"mute_all": "Inactive ✗",
				"mute_all_time": "Inactive ✗",
				"fosh": "Inactive ✗",
				"lockauto": "Inactive ✗",
				"lockcharacter": "Inactive ✗",
				"video_msg": "Inactive ✗"
			},
			"information": {
            "added": "true",
			"welcome": "Inactive ✗",
			"add": "Inactive ✗",
			"lockchannel": "Inactive ✗",
			"hardmodebot": "Inactive ✗",
			"hardmodewarn": "سکوت کاربر️",
			"charge": "7 روز",
			"setadd": "3",
			"dataadded": "",
			"expire": "",
			"msg": "",
			"timelock": "00:00",
			"timeunlock": "00:00",
			"pluscharacter": "300",
			"downcharacter": "0",
			"textwelcome": "خوش امدید",
			"rules": "ثبت نشده",
			"setwarn": "3"
			}
}';
        $settings = json_decode($settings,true);
		$settings["information"]["expire"]="$next_date";
		$settings["information"]["dataadded"]="$dateadd";
		$settings["information"]["msg_id"]="$message_id";
        $settings = json_encode($settings,true);
        file_put_contents("data/$chat_id.json",$settings);
$gpadd = fopen("data/group.txt",'a') or die("Unable to open file!");  
fwrite($gpadd, "
• نام گروه : $namegroup
• شناسه گروه : $chat_id
");
fclose($gpadd);
}
else
{
$dataadd = $settings["information"]["dataadded"];
bot('sendMessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"
• گروه قبلا در لیست گروه های پشتیبانی ربات بوده است !",
  'reply_to_message_id'=>$message_id,
     ]); 
}
}
}
}
//automatic

					 elseif($data=="auto1"){
            bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"
• مدیریت خودکار گروه فعال شد !
			   
لطفا بخش موردنظر خود را انتخاب کنید. ",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
	  	  	 [
				 ['text'=>"• پنل گروه",'callback_data'=>"back"]
				 ],
				 [
				 ['text'=>"• راهنمای دستورات",'callback_data'=>"help"]
		 ],
	 ]
               ])
           ]);
		$settings["lock"]["link"]="Active ✓";
		$settings["lock"]["username"]="Active ✓";
		$settings["lock"]["bot"]="Active ✓";
		$settings["lock"]["forward"]="Active ✓";
		$settings["lock"]["tgservices"]="Active ✓";
		$settings["lock"]["contact"]="Active ✓";
        $settings = json_encode($settings,true);
        file_put_contents("data/$chat_id.json",$settings);
    }
					 elseif($data=="auto2"){
            bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"
• مدیریت خودکار گروه غیر فعال شد !
			   
لطفا بخش مورد نظر خود را انتخاب کنید. ",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
	  	  	 [
				 ['text'=>"• پنل گروه",'callback_data'=>"back"]
				 ],
				 [
				 ['text'=>"• راهنمای دستورات",'callback_data'=>"help"]
		 ],
	 ]
               ])
           ]);
    }
// setwelcome
if (strpos($textmassage , "Setwelcome ") !== false or strpos($textmassage , "تنظیم خوش آمد ") !== false ) {
if ($status == 'creator' or $status == 'administrator' or in_array($from_id,$dev)) {
$add = $settings["information"]["added"];
if ($add == true) {
$we = str_replace(['/setwelcome ','تنظیم خوش آمد '],'',$textmassage);
$plus = mb_strlen("$we");
if($plus < 600) {
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• متن خوش آمد گویی با موفقیت تغییر کرد !

$we",
  'reply_to_message_id'=>$message_id,

 ]);
$settings["information"]["textwelcome"]="$we";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
	}
else
{
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"
• تعداد کلمات وارد شده بیش از حد مجاز است حداکثر میتوانید 60 حرف را وارد کنید !",
  'reply_to_message_id'=>$message_id,

 ]);
}
}
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• ربات در گروه نصب نشده است !",
  'reply_to_message_id'=>$message_id,

 ]);	
}
}
}
// welcome enbale and off
elseif ($textmassage == "Welcome on"  or $textmassage == "welcome on" or $textmassage == "خوش آمد روشن") {
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev)) {
$add = $settings["information"]["added"];
if ($add == true) {
$text = $settings["information"]["textwelcome"];
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"
• خوش آمد گویی روشن شد !

متن خوش آمد :
[ $text ]",
  'reply_to_message_id'=>$message_id,

 ]);
$settings["information"]["welcome"]="Active ✓";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
	}
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• ربات در گروه نصب نشده است !",
  'reply_to_message_id'=>$message_id,

 ]);
}
}
}
elseif ($textmassage == "Welcome off"  or $textmassage == "welcome off" or $textmassage == "خوش آمد خاموش") {
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev)) {
$add = $settings["information"]["added"];
if ($add == true) {
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• خوش آمد گویی خاموش شد !",
  'reply_to_message_id'=>$message_id,

 ]);
$settings["information"]["welcome"]="Inactive ✗";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
	}
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• ربات در گروه نصب نشده است !",
  'reply_to_message_id'=>$message_id,

 ]);
}
}
}
// report
elseif ($rt && $textmassage=="Report" or $rt && $textmassage=="report" or $rt && $textmassage=="ارسال گزارش" ) {
$lockcmd = $settings["lock"]["cmd"];
if ($lockcmd == "Inactive ✗") {
$getlink = file_get_contents("https://api.telegram.org/bot$token/exportChatInviteLink?chat_id=$chat_id");
$jsonlink = json_decode($getlink, true);
$getlinkde = $jsonlink['result'];
$up = json_decode(file_get_contents("https://api.telegram.org/bot$token/getChatAdministrators?chat_id=".$chat_id),true);
$result = $up['result'];
        bot('sendmessage',[
            'chat_id'=>$chat_id,
            'text'=>"• گزارش شما با موفقیت ثبت شد !",
'reply_to_message_id'=>$message_id,

 ]);
  foreach($result as $key=>$value){
    $found = $result[$key]['status'];
    if($found == "creator"){
      $owner = $result[$key]['user']['id'];
    }
	        bot('sendmessage',[
            'chat_id'=>$owner,
            'text'=>"
•• یک مورد توسط اعضا گزارش شده است !

• اطلاعات کاربر گزارش دهنده :

- شناسه : [ $from_id ]
- نام : [ $first_name ]
- نام کاربری : [ @$username ]

• اطلاعات کاربر گزارش شده :

- شناسه : [ $re_id ]
- نام : [ $re_name ]
- نام کاربری : [ @$re_user ]

مشخصات گروه :

- شناسه گروه : [ $chat_id ]
- نام گروه : [ $namegroup ]
- لینک گروه : [ $getlinkde  ]
",
        ]);
        bot('forwardMessage',[
            'chat_id'=>$owner,
            'from_chat_id'=>$chat_id,
            'message_id'=>$replyid,
        ]);
}
}
}
// support 
elseif ($textmassage=="Support" or $textmassage=="support" or $textmassage=="درخواست پشتیبانی" ) {
$lockcmd = $settings["lock"]["cmd"];
if ($lockcmd == "Inactive ✗") {
$getlink = file_get_contents("https://api.telegram.org/bot$token/exportChatInviteLink?chat_id=$chat_id");
$jsonlink = json_decode($getlink, true);
$getlinkde = $jsonlink['result'];
            bot('sendmessage', [
                'chat_id' =>$dev[0],
                'text' => "
•• گروه [ $namegroup ] درخواست پشتیبانی کرده است !

• مشخصات درخواست دهنده :

- شناسه : [ $from_id ]
- نام : [ $first_name ]
- نام کاربری : [ @$username ]

• مشخصات گروه :

- شناسه گروه : [ $chat_id ]
- لینک گروه : [ $getlinkde  ]",
            ]);
            bot('sendmessage', [
                'chat_id'=>$chat_id,
                'text'=>"
• درخواست پشتیبانی شما با موفقیت ثبت شد !
درخواست شما بزودی توسط مدیر ربات بررسی خواهد شد.",
'reply_to_message_id'=>$message_id,

 ]);
        }
}
// hardmode
elseif($textmassage=="Modebot on" or $textmassage=="modebot on" or $textmassage=="سختگیرانه ربات روشن"){
if ($status == 'creator' or $status == 'administrator' or in_array($from_id,$dev) ){
$add = $settings["information"]["added"];
if ($add == true) {
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• حالت سختگیرانه افزودن ربات فعال شد !",
  'reply_to_message_id'=>$message_id,

 ]);
$settings["information"]["hardmodebot"]="اخراج کاربر";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• ربات در گروه نصب نشده است !",
  'reply_to_message_id'=>$message_id,

 ]);
	}
}
}
elseif($textmassage=="Modebot off" or $textmassage=="modebot off" or $textmassage=="سختگیرانه ربات خاموش"){
if ($status == 'creator' or $status == 'administrator' or in_array($from_id,$dev) ){
$add = $settings["information"]["added"];
if ($add == true) {
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• حالت سختگیرانه افزودن ربات غیرفعال شد !",
  'reply_to_message_id'=>$message_id,

 ]);
$settings["information"]["hardmodebot"]="Inactive ✗";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• ربات در گروه نصب نشده است !",
  'reply_to_message_id'=>$message_id,

 ]);
	}
}
}
elseif($textmassage=="Modewarn on" or $textmassage=="modewarn on" or $textmassage=="وضعیت اخطار اخراج"){
if ($status == 'creator' or $status == 'administrator' or in_array($from_id,$dev) ){
$add = $settings["information"]["added"];
if ($add == true) {
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• وضعیت اخطار به حالت ( اخراج کاربر ) تنظیم شد !",
  'reply_to_message_id'=>$message_id,

 ]);
$settings["information"]["hardmodewarn"]="اخراج کاربر";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• ربات در گروه نصب نشده است !",
  'reply_to_message_id'=>$message_id,

 ]);
	}
}
}
elseif($textmassage=="Modewarn off" or $textmassage=="modewarn off" or $textmassage=="وضعیت اخطار بی صدا"){
if ($status == 'creator' or $status == 'administrator' or in_array($from_id,$dev) ){
$add = $settings["information"]["added"];
if ($add == true) {
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• وضعیت اخطار به حالت ( بی صدا ) تنظیم شد !",
  'reply_to_message_id'=>$message_id,

 ]);
$settings["information"]["hardmodewarn"]="سکوت کاربر️";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• ربات در گروه نصب نشده است !",
  'reply_to_message_id'=>$message_id,

 ]);
	}
}
}
//=======================================================================================
// restart settings
if($textmassage=="Restart" or $textmassage=="restart settings" or $textmassage=="ریستارت تنظیمات"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev)) {
$add = $settings["information"]["added"];
if ($add == true) {
bot('sendmessage',[
'reply_to_message_id'=>$message_id,
 'chat_id'=>$chat_id,
 'text'=>"
• اگر از ریست کردن تنظیمات گروه اطمینان دارید بله را ارسال کنید !",
 ]);
$settings["information"]["step"]="reset";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• ربات در گروه نصب نشده است !",
  'reply_to_message_id'=>$message_id,

 ]);
	}
 }
}
// kick 
elseif(strpos($textmassage ,"Kick ") !== false or strpos($textmassage ,"اخراج ") !== false) {
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev)){
$text = str_replace(['Kick ','اخراج '],'',$textmassage);
$stat = file_get_contents("https://api.telegram.org/bot$token/getChatMember?chat_id=$text&user_id=".$text);
$statjson = json_decode($stat, true);
$name = $statjson['result']['user']['first_name'];
$username = $statjson['result']['user']['username'];
$id = $statjson['result']['user']['id'];
	bot('KickChatMember',[
    'chat_id'=>$chat_id,
    'user_id'=>$text
      ]);
              bot('sendmessage', [
                'chat_id' => $chat_id,
             'text'=>"• کاربر ( $name ) اخراج شد !",
'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
   ]);

   }
}
 elseif($rt && $textmassage=="Kick"  or $rt && $textmassage=="kick" or $rt && $textmassage=="Sik" or $rt && $textmassage=="sik" or $rt && $textmassage== "اخراج"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev)){
if ( $statusrt != 'creator' && $statusrt != 'administrator' && !in_array($re_id,$dev)) {
	bot('KickChatMember',[
    'chat_id'=>$chat_id,
    'user_id'=>$re_id
      ]);
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• کاربر ( $re_name ) اخراج شد !",
'reply_to_message_id'=>$message_id,
	 'reply_markup'=>$inlinebutton,
   ]);
   } 
else	
{
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• شما نمیتوانید مدیران را اخراج کنید !",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
   }
}
 }
 // kick me
elseif($textmassage=="Kickme" or $textmassage=="kickme" or $textmassage=="اخراج من"){
$lockcmd = $settings["lock"]["cmd"];
if ($lockcmd == "Inactive ✗") {
if ( $status != 'creator' && $status != 'administrator' && !in_array($from_id,$dev) ){
bot('KickChatMember',[
    'chat_id'=>$chat_id,
    'user_id'=>$from_id
	]);
              bot('sendmessage', [
                'chat_id' => $chat_id,
             'text'=>"• کاربر ( $first_name ) اخراج شد !",
'reply_markup'=>$inlinebutton,
 ]);
 }
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• شما نمیتوانید مدیران را اخراج کنید !",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
}
}
}
// silent
elseif($textmassage == "Silent" && $rt or $textmassage == "silent" && $rt or $textmassage == "Mute" && $rt or $textmassage == "mute" && $rt or $textmassage == "سکوت" && $rt or $textmassage == "بی صدا" && $rt){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev)) {
if ( $statusrt != 'creator' && $statusrt != 'administrator' && !in_array($re_id,$dev)) {
$add = $settings["information"]["added"];
if ($add == true){
   bot('restrictChatMember',[
   'user_id'=>$re_id,   
   'chat_id'=>$chat_id,
   'can_post_messages'=>false,
         ]);
  bot('sendMessage',[
'parse_mode'=>"HTML",
'chat_id'=>$chat_id,
'text'=>"• کاربر ( $re_name ) بی صدا گردید !",
'reply_to_message_id'=>$re_msgid,
   'reply_markup'=>json_encode([
      'inline_keyboard'=>[
     [
    ['text'=>"$re_name", 'url'=>"https://telegram.me/$re_user"]
    ],
	[
	
	]
    ]
    ])
]);
$settings["silentlist"][]="$re_id";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• ربات در گروه نصب نشده است !

",
  'reply_to_message_id'=>$message_id,

 ]);
 }
}
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• شما نمیتوانید مدیران را بی صدا کنید !",
  'reply_to_message_id'=>$message_id,

 ]);
}
}
}

elseif (strpos($textmassage , "Silent ") !== false && $rt or strpos($textmassage , "بی صدا ") !== false && $rt) {
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev)) {
if ( $statusrt != 'creator' && $statusrt != 'administrator' && !in_array($re_id,$dev)) {
$add = $settings["information"]["added"];
$we = str_replace(['/silent ','بی صدا '],'',$textmassage);
if ($we <= 1000 && $we >= 1){
if ($add == true) {
$weplus = $we + 5;
	bot('sendmessage',[
	'parse_mode'=>"HTML",
	'chat_id'=>$chat_id,
	'text'=>"
• کاربر $re_name به مدت ( $we ) دقیقه در حالت بی صدا قرار گرفت !",
  'reply_to_message_id'=>$message_id,
   'reply_markup'=>json_encode([
      'inline_keyboard'=>[
     [
    ['text'=>"$re_name", 'url'=>"https://telegram.me/$re_user"]
    ],
	[
	
	]
    ]
    ])
 ]);
    bot('restrictChatMember',[
   'user_id'=>$re_id,   
   'chat_id'=>$chat_id,
   'can_post_messages'=>false,
   'until_date'=>time()+$weplus*60,
         ]);
$settings["silentlist"][]="$re_id";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• ربات در گروه نصب نشده است !

",
  'reply_to_message_id'=>$message_id,

 ]);
}
}
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• عدد وارد شده باید بین 1 تا 1000 باشد !",
  'reply_to_message_id'=>$message_id,

 ]);
}
}
else
{
bot('sendmessage',[
 'chat_id' => $chat_id,
 'text'=>"• شما نمیتوانید مدیران را بی صدا کنید !",

   ]);
}
}
}
elseif($textmassage == "Unsilent" && $rt or $textmassage == "unsilent" && $rt or $textmassage == "Unmute" && $rt or $textmassage == "unmute" && $rt or $textmassage == "حذف بی صدا" && $rt){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev) ) {
$add = $settings["information"]["added"];
if ($add == true) {
 bot('restrictChatMember',[
   'user_id'=>$re_id,   
   'chat_id'=>$chat_id,
   'can_post_messages'=>true,
   'can_add_web_page_previews'=>false,
   'can_send_other_messages'=>true,
   'can_send_media_messages'=>true,
         ]);
  bot('sendMessage',[
'parse_mode'=>"HTML",
  'chat_id'=>$chat_id,
'text'=>"
• کاربر ( $re_name ) از حالت بی صدا خارج گردید !",
'reply_to_message_id'=>$re_msgid,
 
   'reply_markup'=>json_encode([
      'inline_keyboard'=>[
     [
    ['text'=>"$re_name", 'url'=>"https://telegram.me/$re_user"]
    ],
	[
	
	]
    ]
    ])
]);
$key = array_search($re_id,$settings["silentlist"]);
unset($settings["silentlist"][$key]);
$settings["silentlist"] = array_values($settings["silentlist"]); 
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• ربات در گروه نصب نشده است !

",
  'reply_to_message_id'=>$message_id,

 ]);
}
}
}
elseif($textmassage == "List silent"  or $textmassage == "list silent" or $textmassage == "لیست افراد بی صدا") {
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev)) {
$silent = $settings["silentlist"];
for($z = 0;$z <= count($silent)-1;$z++){
$result = $result.$silent[$z]."\n";
}
	  bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"
• لیست افراد بی صدا : 

$result",
'reply_to_message_id'=>$message_id,

 ]);
}
}
elseif($textmassage == "Clean mutelist"  or $textmassage == "clean mutelist" or $textmassage == "حذف لیست بی صدا") {
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev)) {
$add = $settings["information"]["added"];
if ($add == true) {
$silent = $settings["silentlist"];
for($z = 0;$z <= count($silent)-1;$z++){
 bot('restrictChatMember',[
   'user_id'=>$silent[$z],   
   'chat_id'=>$chat_id,
   'can_post_messages'=>true,
   'can_add_web_page_previews'=>false,
   'can_send_other_messages'=>true,
   'can_send_media_messages'=>true,
         ]);
}
	  bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"• لیست کاربران بی صدا پاکسازی شد !",
'reply_to_message_id'=>$message_id,

 ]);
unset($settings["silentlist"]);
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
else
{
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• ربات در گروه نصب نشده است !

",
  'reply_to_message_id'=>$message_id,

 ]);
}
}
}
// promote
elseif($textmassage=="Promote" or $textmassage=="promote" or $textmassage=="ارتقا مقام"){
if ( $status == 'creator' or in_array($from_id,$dev)) {
bot('sendmessage',[
'parse_mode'=>"HTML",
'chat_id'=>$chat_id,
'text'=>"• کاربر ( $re_name ) به مدیریت ارتقا مقام یافت !",
'reply_to_message_id'=>$message_id,
   'reply_markup'=>json_encode([
      'inline_keyboard'=>[
     [
    ['text'=>"$re_name", 'url'=>"https://telegram.me/$re_user"]
    ],
	[
	
	]
    ]
    ])
 ]);
 bot('promoteChatMember',[
 'chat_id'=>$chat_id,
  'user_id'=>$re_id,
 'can_change_info'=>True,
  'can_delete_messages'=>True,
  'can_invite_users'=>True,
  'can_restrict_members'=>True,
  'can_pin_messages'=>True,
  'can_promote_members'=>false
]);
	}
}
elseif($textmassage=="Demote" or $textmassage=="demote" or $textmassage=="عزل مقام"){
if ( $status == 'creator' or in_array($from_id,$dev)) {
bot('sendmessage',[
'parse_mode'=>"HTML",
'chat_id'=>$chat_id,
'text'=>"• کاربر ( $re_name ) از مقام مدیریت عزل شد !",
'reply_to_message_id'=>$message_id,
'reply_markup'=>json_encode([
      'inline_keyboard'=>[
     [
    ['text'=>"$re_name", 'url'=>"https://telegram.me/$re_user"]
    ],
	[
	
	]
    ]
    ])
 ]);
 bot('restrictChatMember',[
   'user_id'=>$re_id,   
   'chat_id'=>$chat_id,
   'can_post_messages'=>true,
   'can_add_web_page_previews'=>false,
   'can_send_other_messages'=>true,
   'can_send_media_messages'=>true,
         ]);
	}
}
// admin list
elseif($textmassage=="Admin list" or $textmassage=="admin list" or $textmassage=="لیست مدیران گروه"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev)) {
  $up = json_decode(file_get_contents("https://api.telegram.org/bot$token/getChatAdministrators?chat_id=".$chat_id),true);
  $result = $up['result'];
  foreach($result as $key=>$value){
    $found = $result[$key]['status'];
    if($found == "creator"){
      $owner = $result[$key]['user']['id'];
	  $owner2 = $result[$key]['user']['username'];
    }
if($found == "administrator"){
if($result[$key]['user']['first_name'] == true){
$innames = str_replace(['[',']'],'',$result[$key]['user']['first_name']);
$msg = $msg."\n"."● "."[{$innames}]{$result[$key]['user']['id']})";
}
  }
		 }
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"
•• صاحب گروه :
$owner

•• ادمین های گروه :
$msg ",
'reply_to_message_id'=>$message_id,

'parse_mode'=>"HTML",
 ]);
	}
}
  // text callback
elseif ($data == 'text'){
bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"• شما به این بخش دسترسی ندارید !",
]);
}
//=======================================================================================
// time
if($textmassage=="ریبوت" or $textmassage=="Rebot" or $textmassage=="rebot"){
if ( $status != 'creator' && $status != 'administrator' && !in_array($from_id,$dev) ){
$lockcmd = $settings["lock"]["cmd"];
if ($lockcmd == "Inactive ✗") {
if ($tc == 'group' | $tc == 'supergroup'){  
$basetime = file_get_contents("http://irapi.ir/time/");
$getchat = json_decode($basetime, true);
$time = $getchat["FAtime"];
$date = $getchat["FAdate"];
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"
•• تنظیمات Re-bot ربات:
",
'reply_to_message_id'=>$message_id,
	   'reply_markup'=>json_encode([
    'inline_keyboard'=>[
  [
                    ['text'=>"Re-bot ®",'callback_data'=>'text']
                ],
                [
                   ['text'=>"Re-start ↺",'callback_data'=>'text']
                ],
                [
                    ['text'=>"Edit source ✎",'callback_data'=>'text']
                ],
                [
                   ['text'=>"Shut down ∅",'callback_data'=>'text']
                ],
	  	  	 [
				 ['text'=>"• Bot Channel",'url'=>"https://telegram.me/$channel"]],
   ]
   ])
   ]);
   }  
}
}
else
{
$basetime = file_get_contents("http://irapi.ir/time/");
$getchat = json_decode($basetime, true);
$time = $getchat["FAtime"];
$date = $getchat["FAdate"];
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"
•• تنظیمات Re-bot ربات:
",
'reply_to_message_id'=>$message_id,
	   'reply_markup'=>json_encode([
    'inline_keyboard'=>[
  [
                    ['text'=>"Re-bot ®",'callback_data'=>'text']
                ],
                [
                   ['text'=>"Re-start ↺",'callback_data'=>'text']
                ],
                [
                    ['text'=>"Edit source ✎",'callback_data'=>'text']
                ],
                [
                   ['text'=>"Shut down ∅",'callback_data'=>'text']
                ],
	  	  	 [
				 ['text'=>"• Bot Channel",'url'=>"https://telegram.me/$channel"]
		 ],
   ]
   ])
   ]);
}
}
// id
elseif($rt && $textmassage =="Id" or $rt && $textmassage =="ایدی" or $rt && $textmassage =="id"){
if ( $status != 'creator' && $status != 'administrator' && !in_array($from_id,$dev) ){
$lockcmd = $settings["lock"]["cmd"];
if ($lockcmd == "Inactive ✗") {
$getuserprofile = getUserProfilePhotos($token,$re_id);
$cuphoto = $getuserprofile->total_count;
$getuserphoto = $getuserprofile->photos[0][0]->file_id;
if ($getuserphoto != false) {
  bot('sendphoto',[
  'chat_id'=>$chat_id,
'photo'=>$getuserphoto,
  'caption'=>"
شناسه گروه : [$chat_id]
  
نام : [$re_name]

شناسه : [$re_id]

نام کاربری : [ @$re_user ]",
'reply_markup'=>$inlinebutton,
   ]);
   }  
else
{
	bot('sendphoto',[
  'chat_id'=>$chat_id,
'photo'=>new CURLFile("other/nophoto.png"),
  'caption'=>"
شناسه گروه : [$chat_id]
  
نام : [$re_name]

شناسه : [$re_id]

نام کاربری : [ @$re_user ]",
'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
   ]);
   }  
}
}   
else
{
$getuserprofile = getUserProfilePhotos($token,$re_id);
$cuphoto = $getuserprofile->total_count;
$getuserphoto = $getuserprofile->photos[0][0]->file_id;
  bot('sendphoto',[
  'chat_id'=>$chat_id,
'photo'=>$getuserphoto,
 'caption'=>"
شناسه گروه : [$chat_id]

نام : [$re_name]

شناسه : [$re_id]

نام کاربری : [ @$re_user ]",
'reply_markup'=>$inlinebutton,
   ]);
   }
   }
elseif($textmassage=="Id" or $textmassage=="ایدی" or $textmassage=="id"){
if ( $status != 'creator' && $status != 'administrator' && !in_array($from_id,$dev) ){
$lockcmd = $settings["lock"]["cmd"];
if ($lockcmd == "Inactive ✗") {
$getuserprofile = getUserProfilePhotos($token,$from_id);
$cuphoto = $getuserprofile->total_count;
$getuserphoto = $getuserprofile->photos[0][0]->file_id;
if ($getuserphoto != false) {
  bot('sendphoto',[
  'chat_id'=>$chat_id,
'photo'=>$getuserphoto,
  'caption'=>"
شناسه گروه : [$chat_id]
  
نام شما : [$first_name]

شناسه : [$from_id]

نام کاربری : [ @$username ]",
'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
   ]);
   }
else
{
	bot('sendphoto',[
  'chat_id'=>$chat_id,
'photo'=>new CURLFile("other/nophoto.png"),
  'caption'=>"
شناسه گروه : [$chat_id]
  
نام شما : [$first_name]

شناسه : [$from_id]

نام کاربری : [ @$username ]",
'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
   ]);
   }
}
}
else
{
$getuserprofile = getUserProfilePhotos($token,$from_id);
$cuphoto = $getuserprofile->total_count;
$getuserphoto = $getuserprofile->photos[0][0]->file_id;
  bot('sendphoto',[
  'chat_id'=>$chat_id,
'photo'=>$getuserphoto,
  'caption'=>"
شناسه گروه : [$chat_id]
  
نام شما : [$first_name]

شناسه : [$from_id]

نام کاربری : [ @$username ]",
'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
   ]);
}
}
// getpro
elseif(strpos($textmassage ,"Getpro ") !== false or strpos($textmassage ,"getpro ") !== false or strpos($textmassage ,"عکس پروفایل ") !== false) {
if ( $status != 'creator' && $status != 'administrator' && !in_array($from_id,$dev) ){
$lockcmd = $settings["lock"]["cmd"];
if ($lockcmd == "Inactive ✗") {
$text = str_replace(['Getpro ','getpro ','عکس پروفایل '],'',$textmassage);
$getuserprofile = getUserProfilePhotos($token,$from_id);
$cuphoto = $getuserprofile->total_count;
$getuserphoto = $getuserprofile->photos[$text - 1][0]->file_id;
if ($getuserphoto != false) {
  bot('sendphoto',[
  'chat_id'=>$chat_id,
'photo'=>$getuserphoto,
  'caption'=>"
• عکس فعلی شما [$text]  تعداد عکس های شما :[$cuphoto]",
'reply_to_message_id'=>$message_id,

   ]);
   }
else
{
	bot('sendmessage',[
  'chat_id'=>$chat_id,
  'text'=>"• شما عکس پروفایل ندارید !",
'reply_to_message_id'=>$message_id,

   ]);
   }
}
}
else
{
$text = str_replace(['Getpro ','getpro ','عکس پروفایل '],'',$textmassage);
$getuserprofile = getUserProfilePhotos($token,$from_id);
$cuphoto = $getuserprofile->total_count;
$getuserphoto = $getuserprofile->photos[$text - 1][0]->file_id;
  bot('sendphoto',[
  'chat_id'=>$chat_id,
'photo'=>$getuserphoto,
  'caption'=>"• عکس فعلی شما [$text]  تعداد عکس های شما :[$cuphoto]",
'reply_to_message_id'=>$message_id,

   ]);
}
}
// Rebix
elseif($textmassage=="Bot" or $textmassage=="ربات" or $textmassage=="bot"){
    $ping=rand(34,41);
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"
• The robot is #Online now !
	",
'reply_to_message_id'=>$message_id,

   ]);
   } 
      elseif($textmassage == "!me"){
bot('restrictChatMember',[
   'user_id'=>$re_id,   
   'chat_id'=>$chat_id,
   'can_post_messages'=>false,
   'until_date'=>time()+1*60,
         ]);
$settings["silentlist"][]="$re_id";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
   }
// Getpro help
elseif($textmassage=="Getpro" or $textmassage=="getpro"){
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"
• لطفا دستور را همراه با عدد عکس پروفایل مورد نظر ارسال کنید !
	
به عنوان مثال برای دریافت عکس اول پروفایل از دستور زیر استفاده کنید :

	getpro 1",
'reply_to_message_id'=>$message_id,

   ]);
   }    
   // nerkh
elseif($textmassage=="server info" or $textmassage=="Server info" or $textmassage=="وضعیت سرور"){
if ( $status != 'creator' && $status != 'administrator' && !in_array($from_id,$dev) ){
$lockcmd = $settings["lock"]["cmd"];
if ($lockcmd == "Inactive ✗") {
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"
•• اطلاعات و وضعیت سرور


• فضای کل دیسک : 1.9 GB

• فضای استفاده شده : 0.5 GB

• فضای آزاد دیسک : 1.3 GB

• سرعت پردازش : $ping  بر  32 ms

• تعداد هسته : 4 Core

• موقعیت مکانی سرور : Netherlands

• نوع هارد : NVME 1.3 GHZ

• وضعیت : Med",
'reply_to_message_id'=>$message_id,
   'reply_markup'=>json_encode([
    'inline_keyboard'=>[
	[
	['text'=>"پشتیبانی",'url'=>"https://t.me/Shita"]
	],
              ],
        ])
   ]);
   }  
}
else
{
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"
•• اطلاعات و وضعیت سرور ربات


• فضای کل دیسک : 1.9 GB

• فضای استفاده شده : 0.5 GB

• فضای آزاد دیسک : 1.3 GB

• سرعت پردازش : $ping  بر  32 ms

• تعداد هسته : 4 Core

• موقعیت مکانی سرور : Netherlands

• نوع هارد : NVME 1.3 GHZ

• وضعیت : Med",
'reply_to_message_id'=>$message_id,
   'reply_markup'=>json_encode([
    'inline_keyboard'=>[
	[
	['text'=>"پشتیبانی",'url'=>"https://t.me/Shita"]
	],
              ],
        ])
   ]);
}
}
// info
elseif($textmassage=="Info" && $rt or $textmassage=="اطلاعات" && $rt or $textmassage=="info" && $rt){
if ( $status != 'creator' && $status != 'administrator' && !in_array($from_id,$dev) ){
$lockcmd = $settings["lock"]["cmd"];
if ($lockcmd == "Inactive ✗") {
$getuserprofile = getUserProfilePhotos($token,$from_id);
$cuphoto = $getuserprofile->total_count;
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"
• نام : $re_name
• شناسه : $re_id
• نام کاربری : @$re_user
• تعداد عکس پروفایل : $cuphoto
",
'reply_to_message_id'=>$message_id,

   ]);
   } 
}
else
{
$getuserprofile = getUserProfilePhotos($token,$from_id);
$cuphoto = $getuserprofile->total_count;
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"
• نام : $re_name
• شناسه : $re_id
• نام کاربری : @$re_user
• تعداد عکس پروفایل : $cuphoto
",
'reply_to_message_id'=>$message_id,

   ]);
}
}
elseif($textmassage=="info"  or $textmassage=="me" or $textmassage=="من"  or $textmassage=="اطلاعات"  or $textmassage=="info" ){
if ( $status != 'creator' && $status != 'administrator' && !in_array($from_id,$dev) ){
$lockcmd = $settings["lock"]["cmd"];
if ($lockcmd == "Inactive ✗") {
$getuserprofile = getUserProfilePhotos($token,$from_id);
$cuphoto = $getuserprofile->total_count;
	bot('sendmessage',[
	'parse_mode'=>"HTML",
	'chat_id'=>$chat_id,
	'text'=>"
• نام شما : $first_name
• شناسه شما : $from_id
• نام کاربری شما : @$username
• تعداد پیام ها : $tedadmsg
• تعداد عکس پروفایل : $cuphoto
• لینک شما : https://t.me/$username
• کانال ما : @$channel

",
'reply_to_message_id'=>$message_id,

   ]);
   } 
}   
 else
 {
$getuserprofile = getUserProfilePhotos($token,$from_id);
$cuphoto = $getuserprofile->total_count;
	bot('sendmessage',[
	'parse_mode'=>"HTML",
	'chat_id'=>$chat_id,
	'text'=>"
• نام شما : $first_name
• شناسه شما : $from_id
• نام کاربری شما : @$username
• تعداد پیام ها : $tedadmsg
• تعداد عکس پروفایل : $cuphoto
• لینک شما : https://t.me/$username
• کانال ما : @$channel
",
'reply_to_message_id'=>$message_id,

   ]);
} 
}
if(strpos($textmassage ,"/info ") !== false or strpos($textmassage ,"اطلاعات فرد ") !== false) {
if ( $status != 'creator' && $status != 'administrator' && !in_array($from_id,$dev) ){
$lockcmd = $settings["lock"]["cmd"];
if ($lockcmd == "Inactive ✗") {
$text = str_replace(['/info ','اطلاعات فرد '],'',$textmassage);
if($text > 0){
              bot('sendmessage', [
                'chat_id' => $chat_id,
             'text'=>"
• پروفایل فرد :
 [$text]",
			 'parse_mode'=>"HTML",
'reply_to_message_id'=>$message_id,

   ]);
   }
}
}
else
{
$text = str_replace(['/info ','اطلاعات فرد '],'',$textmassage);
              bot('sendmessage', [
                'chat_id' => $chat_id,
             'text'=>"پروفایل فرد : [$text](tg://user?id=$text)",
			 'parse_mode'=>"HTML",
'reply_to_message_id'=>$message_id,

   ]);
}
}
// ping
if($textmassage=="/ping" or $textmassage=="انلاینی" or $textmassage=="Cheetah" or $textmassage=="ping"){
if ( $status != 'creator' && $status != 'administrator' && !in_array($from_id,$dev) ){
$lockcmd = $settings["lock"]["cmd"];
if ($lockcmd == "Inactive ✗") {
   bot('sendVideoNote',[
  'chat_id'=>$chat_id,
	'video_note'=>new CURLFile("other/ping.mp4"),
		'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
        ]);
   } 
}
else
{
   bot('sendVideoNote',[
  'chat_id'=>$chat_id,
	'video_note'=>new CURLFile("other/ping.mp4"),
		'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
        ]);	
}
}
// gif
elseif ( strpos($textmassage , 'Gif ') !== false  ) {
if ( $status != 'creator' && $status != 'administrator' && !in_array($from_id,$dev) ){
$lockcmd = $settings["lock"]["cmd"];
if ($lockcmd == "Inactive ✗") {
$text = str_replace("Gif ","",$textmassage);
$ran = rand(1,3);
if ($ran == "1") {
$info_user = file_get_contents("http://www.flamingtext.com/net-fu/image_output.cgi?_comBuyRedirect=false&script=memories-anim-logo&text=$text&symbol_tagname=popular&fontsize=70&fontname=futura_poster&fontname_tagname=cool&textBorder=15&growSize=0&antialias=on&hinting=on&justify=2&letterSpacing=0&lineSpacing=0&textSlant=0&textVerticalSlant=0&textAngle=0&textOutline=off&textOutline=false&textOutlineSize=2&textColor=%230000CC&angle=0&blueFlame=on&blueFlame=false&framerate=75&frames=5&pframes=5&oframes=4&distance=2&transparent=off&transparent=false&extAnim=gif&animLoop=on&animLoop=false&defaultFrameRate=75&doScale=off&scaleWidth=240&scaleHeight=120&&_=1469943010141");
$getchat = json_decode($info_user, true);
$gif = $getchat["src"];
 bot('senddocument',[
    'chat_id'=>$chat_id,
    'document'=>"$gif",
	'caption'=>"
👤 Creator : @AriKord
👾 Bot : @AviraApiBot",
	'reply_to_message_id'=>$message_id,

     ]);
}
if ($ran == "2") {
	$info_user = file_get_contents("http://www.flamingtext.com/net-fu/image_output.cgi?_comBuyRedirect=false&script=flash-anim-logo&text=$text&symbol_tagname=popular&fontsize=70&fontname=futura_poster&fontname_tagname=cool&textBorder=15&growSize=0&antialias=on&hinting=on&justify=2&letterSpacing=0&lineSpacing=0&textSlant=0&textVerticalSlant=0&textAngle=0&textOutline=off&textOutline=false&textOutlineSize=2&textColor=%230000CC&angle=0&blueFlame=on&blueFlame=false&framerate=75&frames=5&pframes=5&oframes=4&distance=2&transparent=off&transparent=false&extAnim=gif&animLoop=on&animLoop=false&defaultFrameRate=75&doScale=off&scaleWidth=240&scaleHeight=120&&_=1469943010141");
$getchat = json_decode($info_user, true);
$gif = $getchat["src"];
 bot('senddocument',[
    'chat_id'=>$chat_id,
    'document'=>"$gif",
	'caption'=>"
👤 Creator : @AriKord
👾 Bot : @AviraApiBot
",
	'reply_to_message_id'=>$message_id,

     ]);
}
if ($ran == "3") {
		$info_user = file_get_contents("http://www.flamingtext.com/net-fu/image_output.cgi?_comBuyRedirect=false&script=alien-glow-anim-logo&text=$text&symbol_tagname=popular&fontsize=70&fontname=futura_poster&fontname_tagname=cool&textBorder=15&growSize=0&antialias=on&hinting=on&justify=2&letterSpacing=0&lineSpacing=0&textSlant=0&textVerticalSlant=0&textAngle=0&textOutline=off&textOutline=false&textOutlineSize=2&textColor=%230000CC&angle=0&blueFlame=on&blueFlame=false&framerate=75&frames=5&pframes=5&oframes=4&distance=2&transparent=off&transparent=false&extAnim=gif&animLoop=on&animLoop=false&defaultFrameRate=75&doScale=off&scaleWidth=240&scaleHeight=120&&_=1469943010141");
$getchat = json_decode($info_user, true);
$gif = $getchat["src"];
 bot('senddocument',[
    'chat_id'=>$chat_id,
    'document'=>"$gif",
	'caption'=>"
👤 Creator : @AriKord
👾 Bot : @AviraApiBot
",
	'reply_to_message_id'=>$message_id,

     ]);
   }  
}
}
else
{
$text = str_replace("Gif ","",$textmassage);
$info_user = file_get_contents("http://www.flamingtext.com/net-fu/image_output.cgi?_comBuyRedirect=false&script=memories-anim-logo&text=$text&symbol_tagname=popular&fontsize=70&fontname=futura_poster&fontname_tagname=cool&textBorder=15&growSize=0&antialias=on&hinting=on&justify=2&letterSpacing=0&lineSpacing=0&textSlant=0&textVerticalSlant=0&textAngle=0&textOutline=off&textOutline=false&textOutlineSize=2&textColor=%230000CC&angle=0&blueFlame=on&blueFlame=false&framerate=75&frames=5&pframes=5&oframes=4&distance=2&transparent=off&transparent=false&extAnim=gif&animLoop=on&animLoop=false&defaultFrameRate=75&doScale=off&scaleWidth=240&scaleHeight=120&&_=1469943010141");
$getchat = json_decode($info_user, true);
$gif = $getchat["src"];
 bot('senddocument',[
    'chat_id'=>$chat_id,
    'document'=>"$gif",
	'caption'=>"
👤 Creator : @AriKord
👾 Bot : @AviraApiBot
",
	'reply_to_message_id'=>$message_id,

     ]);
}
}
// logo 
elseif ( strpos($textmassage , 'Logo ') !== false or strpos($textmassage , 'لوگو بساز ') !== false) {
if ( $status != 'creator' && $status != 'administrator' && !in_array($from_id,$dev) ){
$lockcmd = $settings["lock"]["cmd"];
if ($lockcmd == "Inactive ✗") {
$text = str_replace(['Logo ','لوگو بساز '],'',$textmassage);
 bot('sendphoto',[
    'chat_id'=>$chat_id,
    'photo'=>"http://api.monsterbot.ir/pic/?text=$text&y=15&font=Steamy&fsize=90&bg=logo8",
	'caption'=>"
👤 Creator : @AriKord
👾 Bot : @AviraApiBot",
	'reply_to_message_id'=>$message_id,

   ]);
   } 
}
else
{
	$text = str_replace(['Logo ','لوگو بساز '],'',$textmassage);
 bot('sendphoto',[
    'chat_id'=>$chat_id,
    'photo'=>"http://api.monsterbot.ir/pic/?text=$text&y=15&font=Steamy&fsize=90&bg=logo8",
	'caption'=>"
👤 Creator : @AriKord
👾 Bot : @AviraApiBot
",
	'reply_to_message_id'=>$message_id,

   ]);
   } 
}
// voice
elseif ( strpos($textmassage ,'voice ') !== false  ) {
if ( $status != 'creator' && $status != 'administrator' && !in_array($from_id,$dev) ){
$lockcmd = $settings["lock"]["cmd"];
if ($lockcmd == "Inactive ✗") {
$text = str_replace("voice ","",$textmassage);
$trtext = urlencode($text);
 bot('sendvoice',[
    'chat_id'=>$chat_id,
    'voice'=>"http://tts.baidu.com/text2audio?lan=en&ie=UTF-8&text=$trtext",
	'caption'=>"
👤 Creator : @AriKord
👾 Bot : @AviraApiBot
",
	'reply_to_message_id'=>$message_id,

   ]);
   } 
}
else
{	
$text = str_replace("voice ","",$textmassage);
$trtext = urlencode($text);
 bot('sendvoice',[
    'chat_id'=>$chat_id,
    'voice'=>"http://tts.baidu.com/text2audio?lan=en&ie=UTF-8&text=$trtext",
	'caption'=>"
👤 Creator : @AriKord
👾 Bot : @AviraApiBot
",
	'reply_to_message_id'=>$message_id,

   ]);
}
}
// sticker
elseif($textmassage=="Photo" or $textmassage=="photo" or $textmassage=="تبدیل به عکس"){
if ( $status != 'creator' && $status != 'administrator' && !in_array($from_id,$dev) ){
$lockcmd = $settings["lock"]["cmd"];
if ($lockcmd == "Inactive ✗") {
$file = $update->message->reply_to_message->sticker->file_id;
      $get = bot('getfile',['file_id'=>$file]);
      	  $getchat = json_decode($get, true);
      $patch = $getchat["result"]["file_path"];
    file_put_contents("data/photo.png",file_get_contents("https://api.telegram.org/file/bot$token/$patch"));
bot('sendphoto',[
 'chat_id'=>$chat_id,
 'photo'=>new CURLFile("data/photo.png"),
  'caption'=>"
👤 Creator : @AriKord
👾 Bot : @AviraApiBot
",
  'reply_to_message_id'=>$message_id,

 ]);
unlink("data/photo.png");
 }
}
else
{
$file = $update->message->reply_to_message->sticker->file_id;
      $get = bot('getfile',['file_id'=>$file]);
      	  $getchat = json_decode($get, true);
      $patch = $getchat["result"]["file_path"];
    file_put_contents("data/photo.png",file_get_contents("https://api.telegram.org/file/bot$token/$patch"));
bot('sendphoto',[
 'chat_id'=>$chat_id,
 'photo'=>new CURLFile("data/photo.png"),
  'caption'=>"
👤 Creator : @AriKord
👾 Bot : @AviraApiBot
",
  'reply_to_message_id'=>$message_id,

 ]);
unlink("data/photo.png");
}
}
// photo
elseif($textmassage=="Sticker" or $textmassage=="sticker" or $textmassage=="تبدیل به استیکر"){
if ( $status != 'creator' && $status != 'administrator' && !in_array($from_id,$dev) ){
$lockcmd = $settings["lock"]["cmd"];
if ($lockcmd == "Inactive ✗") {
$photo = $update->message->reply_to_message->photo;
$file = $photo[count($photo)-1]->file_id;
      $get = bot('getfile',['file_id'=>$file]);
	  $getchat = json_decode($get, true);
      $patch = $getchat["result"]["file_path"];
    file_put_contents("data/sticker.webp",file_get_contents("https://api.telegram.org/file/bot$token/$patch"));
bot('sendsticker',[
 'chat_id'=>$chat_id,
 'sticker'=>new CURLFile("data/sticker.webp"),
   'reply_to_message_id'=>$message_id,

 ]);
unlink("data/sticker.webp");
 }
}
else
{
	$photo = $update->message->reply_to_message->photo;
$file = $photo[count($photo)-1]->file_id;
      $get = bot('getfile',['file_id'=>$file]);
	  $getchat = json_decode($get, true);
      $patch = $getchat["result"]["file_path"];
    file_put_contents("data/sticker.webp",file_get_contents("https://api.telegram.org/file/bot$token/$patch"));
bot('sendsticker',[
 'chat_id'=>$chat_id,
 'sticker'=>new CURLFile("data/sticker.webp"),
   'reply_to_message_id'=>$message_id,

 ]);
unlink("data/sticker.webp");
}
}
//=======================================================================================
// charge
if (strpos($textmassage , "Charge ") !== false && in_array($from_id,$dev) or strpos($textmassage , "شارژ ") !== false && in_array($from_id,$dev)) {
	$num = str_replace(['Charge ','شارژ '],'',$textmassage);
	if ($num <= 1000 && $num >= 1){
		date_default_timezone_set('Asia/Tehran');
		$date1 = date('Y-m-d', time());
		$date2 = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');
		$next_date = date('Y-m-d', strtotime($date2 ." +$num day"));
			  bot('sendmessage',[
            'chat_id'=>$chat_id,
            'text'=>"
•• گروه $namegroup با موفقیت $num روز شارژ شد !",
'reply_to_message_id'=>$message_id,

   ]);
$settings["information"]["expire"]="$next_date";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
   }else{
bot('sendmessage',[
 'chat_id' => $chat_id,
 'text'=>"¯\_(ツ)_/¯",
'reply_to_message_id'=>$message_id,

   ]);
}
}
// check charge
elseif($textmassage == "اعتبار" or $textmassage == "Expire" or $textmassage == "expire"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev)){
date_default_timezone_set('Asia/Tehran');
$date3 = date('Y-m-d');
$date2 = date('d');
$ndate = $settings["information"]["expire"];
$rdate = $settings["information"]["dataadded"];
$endtime = date('d', strtotime($ndate ."-$date2 day"));
        bot('sendmessage', [
            "chat_id" => $chat_id,
            "text" => "• گروه شما $endtime روز دیگر اعتبار دارد !",
            'reply_to_message_id'=>$message_id,
        'reply_markup'=>json_encode([
            'resize_keyboard'=>true,
            'inline_keyboard'=>[
					 [
					 ['text'=>"• خرید شارژ",'callback_data'=>'requstcharge']
					 ],
					 					      [
   ['text'=>"تایید و بستن",'callback_data'=>'exit']
   ],
            ]
        ])
        ]);
}
}
// panel for sharge
if (strpos($textmassage , "/plan1 ") !== false && in_array($from_id,$dev) or strpos($textmassage , "ارسال شارژ ") !== false && in_array($from_id,$dev)) {
    $panels = str_replace(['/plan1 ','ارسال شارژ '],'',$textmassage);
	$modified = ltrim($panels);
    $jam = "$modified";
    date_default_timezone_set('Asia/Tehran');
    $date1 = date('Y-m-d', time());
    $date2 = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');
    $next_date = date('Y-m-d', strtotime($date2 ." +60 day"));
			       bot('sendmessage',[
            'chat_id'=>$panels,
            'text'=>"
پلن یک برای گروه شما فعال شد.
			
فعالیت ربات برای 30 روز دیگر تمدید شد."
   ]);
        bot('sendmessage',[
            'chat_id'=>$chat_id,
            'text'=>"
• پلن یک در تاریخ $date1 با موفقیت ثبت شد !",
'reply_to_message_id'=>$message_id,

   ]);
@$getsettings = file_get_contents("data/$jam.json");
@$settings = json_decode($getsettings,true);
$settings["information"]["expire"]="$next_date";
$settings["information"]["charge"]="30 روز";
$settings = json_encode($settings,true);
file_put_contents("data/$jam.json",$settings);
}
// panel charge in pv
if ($textmassage == "Request" or $textmassage == "درخواست شارژ" or $textmassage == "request"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$dev)) {
$getlink = file_get_contents("https://api.telegram.org/bot$token/exportChatInviteLink?chat_id=$chat_id");
$jsonlink = json_decode($getlink, true);
$getlinkde = $jsonlink['result'];
$ndate = $settings["information"]["expire"];
$charge = $settings["information"]["charge"];
$rdate = $settings["information"]["dataadded"];
	bot('sendmessage',[
  'chat_id'=>$chat_id,
  'reply_to_message_id'=>$message_id,
        'text'=>"• درخواست شما ثبت شد !",
  ]);
 bot('sendmessage',[
  'chat_id'=>$dev[0],
  'parse_mode'=>"HTML",
        'text'=>"
•• کاربر [$from_id] درخواست شارژ گروه کرده است !

• شناسه گروه : [$chat_id]

 • گروه مذکور تا تاریخ $ndate شارژ دارد.",
	    'reply_markup'=>json_encode([
      'inline_keyboard'=>[
     [
    ['text'=>"• ورود به گروه", 'url'=>"$getlinkde"]
    ],
    ]
    ])
        ]);
}
}
// lock character
		    elseif($data=="character"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
$lockcharacter = $settings2["lock"]["lockcharacter"];
$pluscharacter = $settings2["information"]["pluscharacter"];
$downcharacter = $settings2["information"]["downcharacter"];
            bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"
• به بخش تنظیم تعداد کاراکتر یا حروف پیام خوش آمدید.
			   
 شما در این قسمت میتوانید حداکثر یا حداقل تعداد حروف پیام را تعیین کنید

 از دکمه های زیر استفاده کنید",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
                     [
                     ['text'=>"• وضعیت قفل : $lockcharacter",'callback_data'=>'lockcharacter']
					 ],
					            [
                     ['text'=>"حداکثر کاراکتر",'callback_data'=>'text']
					 ],
					               [
                     ['text'=>"《",'callback_data'=>'dempluscharacter'],['text'=>"$pluscharacter",'callback_data'=>'text'],['text'=>"》",'callback_data'=>'uppluscharacter']
					 ],
					 		            [
                     ['text'=>"حداقل کاراکتر",'callback_data'=>'text']
					 ],
					               [
                     ['text'=>"《",'callback_data'=>'demdowncharacter'],['text'=>"$downcharacter",'callback_data'=>'text'],['text'=>"》",'callback_data'=>'updowncharacter']
					 ],
					 [
					 ['text'=>"برگشت »",'callback_data'=>'panel2']
					 ],
                     ]
               ])
           ]);
		   }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
    }
				}
						    elseif($data=="lockcharacter" &&  $settings2["lock"]["lockcharacter"] == "Inactive ✗"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
$lockcharacter = $settings2["lock"]["lockcharacter"];
$pluscharacter = $settings2["information"]["pluscharacter"];
$downcharacter = $settings2["information"]["downcharacter"];
            bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"
• به بخش تنظیم تعداد کارکتر یا حروف پیام خوش آمدید.

قفل کاراکتر پیام با موفقیت فعال شد !",
'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
                     [
                     ['text'=>"وضعیت قفل : فعال",'callback_data'=>'lockcharacter']
					 ],
					            [
                     ['text'=>"حداکثر کاراکتر",'callback_data'=>'text']
					 ],
					               [
                     ['text'=>"《",'callback_data'=>'dempluscharacter'],['text'=>"$pluscharacter",'callback_data'=>'text'],['text'=>"》",'callback_data'=>'uppluscharacter']
					 ],
					 		            [
                     ['text'=>"حداقل کاراکتر",'callback_data'=>'text']
					 ],
					               [
                     ['text'=>"《",'callback_data'=>'demdowncharacter'],['text'=>"$downcharacter",'callback_data'=>'text'],['text'=>"》",'callback_data'=>'updowncharacter']
					 ],
					 [
					 ['text'=>"برگشت »",'callback_data'=>'panel2']
					 ],
                     ]
               ])
           ]);
$settings2["lock"]["lockcharacter"]="Active ✓";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		   }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
    }
				}
		    elseif($data=="lockcharacter" &&  $settings2["lock"]["lockcharacter"] == "Active ✓"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
$lockcharacter = $settings2["lock"]["lockcharacter"];
$pluscharacter = $settings2["information"]["pluscharacter"];
$downcharacter = $settings2["information"]["downcharacter"];
            bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"
• به بخش تنظیم تعداد کارکتر یا حروف پیام خوش آمدید.

قفل کاراکتر پیام با موفقیت غیرفعال شد !",
'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
                     [
                     ['text'=>"وضعیت قفل : غیرفعال",'callback_data'=>'lockcharacter']
					 ],
					            [
                     ['text'=>"حداکثر کاراکتر",'callback_data'=>'text']
					 ],
					               [
                     ['text'=>"《",'callback_data'=>'dempluscharacter'],['text'=>"$pluscharacter",'callback_data'=>'text'],['text'=>"》",'callback_data'=>'uppluscharacter']
					 ],
					 		            [
                     ['text'=>"حداقل کاراکتر",'callback_data'=>'text']
					 ],
					               [
                     ['text'=>"《",'callback_data'=>'demdowncharacter'],['text'=>"$downcharacter",'callback_data'=>'text'],['text'=>"》",'callback_data'=>'updowncharacter']
					 ],
					 [
					 ['text'=>"برگشت »",'callback_data'=>'panel2']
					 ],
                     ]
               ])
           ]);
$settings2["lock"]["lockcharacter"]="Inactive ✗";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		   }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
    }
				}
		    elseif($data=="uppluscharacter"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
$lockcharacter = $settings2["lock"]["lockcharacter"];
$pluscharacter = $settings2["information"]["pluscharacter"];
$pluscharacterplus = $pluscharacter + 10 ;
$downcharacter = $settings2["information"]["downcharacter"];
            bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"
• به بخش تنظیم تعداد کارکتر یا حروف پیام خوش آمدید.

حداکثر تعداد کاراکتر 10 عدد افزایش یافت !",
'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
                     [
                     ['text'=>"وضعیت قفل : $lockcharacter",'callback_data'=>'lockcharacter']
					 ],
					            [
                     ['text'=>"حداکثر کاراکتر",'callback_data'=>'text']
					 ],
					               [
                     ['text'=>"《",'callback_data'=>'dempluscharacter'],['text'=>"$pluscharacterplus",'callback_data'=>'text'],['text'=>"》",'callback_data'=>'uppluscharacter']
					 ],
					 		            [
                     ['text'=>"حداقل کاراکتر",'callback_data'=>'text']
					 ],
					               [
                     ['text'=>"《",'callback_data'=>'demdowncharacter'],['text'=>"$downcharacter",'callback_data'=>'text'],['text'=>"》",'callback_data'=>'updowncharacter']
					 ],
					 [
					 ['text'=>"برگشت »",'callback_data'=>'panel2']
					 ],
                     ]
               ])
           ]);
$settings2["information"]["pluscharacter"]="$pluscharacterplus";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		   }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
    }
				}
			    elseif($data=="dempluscharacter"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
$lockcharacter = $settings2["lock"]["lockcharacter"];
$pluscharacter = $settings2["information"]["pluscharacter"];
$pluscharacterplus = $pluscharacter - 10 ;
if($pluscharacterplus >= 0){
$downcharacter = $settings2["information"]["downcharacter"];
            bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"
• به بخش تنظیم تعداد کارکتر یا حروف پیام خوش آمدید.

حداکثر تعداد کاراکتر 10 عدد کاهش یافت !",
'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
                     [
                     ['text'=>"وضعیت قفل : $lockcharacter",'callback_data'=>'lockcharacter']
					 ],
					            [
                     ['text'=>"حداکثر کاراکتر",'callback_data'=>'text']
					 ],
					               [
                     ['text'=>"《",'callback_data'=>'dempluscharacter'],['text'=>"$pluscharacterplus",'callback_data'=>'text'],['text'=>"》",'callback_data'=>'uppluscharacter']
					 ],
					 		            [
                     ['text'=>"حداقل کاراکتر",'callback_data'=>'text']
					 ],
					               [
                     ['text'=>"《",'callback_data'=>'demdowncharacter'],['text'=>"$downcharacter",'callback_data'=>'text'],['text'=>"》",'callback_data'=>'updowncharacter']
					 ],
					 [
					 ['text'=>"برگشت »",'callback_data'=>'panel2']
					 ],
                     ]
               ])
           ]);
$settings2["information"]["pluscharacter"]="$pluscharacterplus";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		   }
		   else
		   {
			  			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"• شما مجاز به تغییر عدد به زیر 0 نیستید !",
]); 
		 }
				}
		   else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
    }
				}
						 elseif($data=="demdowncharacter"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
$lockcharacter = $settings2["lock"]["lockcharacter"];
$pluscharacter = $settings2["information"]["pluscharacter"];
$downcharacter = $settings2["information"]["downcharacter"];
$downcharacterplus = $downcharacter - 10 ;
if($downcharacterplus >= 0){
            bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"
• به بخش تنظیم تعداد کارکتر یا حروف پیام خوش آمدید.

حداقل تعداد کاراکتر 10 عدد کاهش یافت !",
'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
                     [
                     ['text'=>"وضعیت قفل : $lockcharacter",'callback_data'=>'lockcharacter']
					 ],
					            [
                     ['text'=>"حداکثر کاراکتر",'callback_data'=>'text']
					 ],
					               [
                     ['text'=>"《",'callback_data'=>'dempluscharacter'],['text'=>"$pluscharacter",'callback_data'=>'text'],['text'=>"》",'callback_data'=>'uppluscharacter']
					 ],
					 		            [
                     ['text'=>"حداقل کاراکتر",'callback_data'=>'text']
					 ],
					               [
                     ['text'=>"《",'callback_data'=>'demdowncharacter'],['text'=>"$downcharacterplus",'callback_data'=>'text'],['text'=>"》",'callback_data'=>'updowncharacter']
					 ],
					 [
					 ['text'=>"برگشت »",'callback_data'=>'panel2']
					 ],
                     ]
               ])
           ]);
$settings2["information"]["downcharacter"]="$downcharacterplus";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		   }
		   else
		   {
			  			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"• شما مجاز به تغییر عدد به زیر 0 نیستید !️",
]); 
		 }
				}
		   else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
    }
				}
							elseif($data=="updowncharacter"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
$lockcharacter = $settings2["lock"]["lockcharacter"];
$pluscharacter = $settings2["information"]["pluscharacter"];
$downcharacter = $settings2["information"]["downcharacter"];
$downcharacterplus = $downcharacter + 10 ;
            bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"
به بخش تنظیم تعداد کارکتر یا حروف پیام خوش آمدید.

حداقل تعداد کاراکتر 10 عدد افزایش یافت !",
'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
                     [
                     ['text'=>"وضعیت قفل : $lockcharacter",'callback_data'=>'lockcharacter']
					 ],
					            [
                     ['text'=>"حداکثر کاراکتر",'callback_data'=>'text']
					 ],
					               [
                     ['text'=>"《",'callback_data'=>'dempluscharacter'],['text'=>"$pluscharacter",'callback_data'=>'text'],['text'=>"》",'callback_data'=>'uppluscharacter']
					 ],
					 		            [
                     ['text'=>"حداقل کاراکتر",'callback_data'=>'text']
					 ],
					               [
                     ['text'=>"《",'callback_data'=>'demdowncharacter'],['text'=>"$downcharacterplus",'callback_data'=>'text'],['text'=>"》",'callback_data'=>'updowncharacter']
					 ],
					 [
					 ['text'=>"برگشت »",'callback_data'=>'panel2']
					 ],
                     ]
               ])
           ]);
$settings2["information"]["downcharacter"]="$downcharacterplus";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		   }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
    }
				}
//======================================================================================
// pv
if($textmassage=="/start" && $tc == "private" or $textmassage=="/panel" && $tc == "private " or $textmassage=="برگشت »" && $tc == "private"){
	if($tch == 'member' or $tch == 'creator' or $tch == 'administrator'){
	    $user = file_get_contents('Member.txt');
    $members = explode("\n",$user);
    if (!in_array($chat_id,$members)){
      $add_user = file_get_contents('Member.txt');
      $add_user .= $chat_id."\n";
     file_put_contents('Member.txt',$add_user);
    }	
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"
• سلام $first_name ؛ به ربات هوشمند مدیریت گروه آویرا خوش آمدید.

• Hello $first_name ؛ Welcome to the Avira Group Smart Management Robot.

",
'reply_to_message_id'=>$message_id,
	   'reply_markup'=>json_encode([
    'inline_keyboard'=>[
                 [
                ['text'=>"•••",'callback_data'=>'kharid2'],['text'=>"•••",'callback_data'=>'freepv']
                ],
				[
                ['text'=>"• دستورات ربات",'callback_data'=>'help11'],['text'=>"افزودن ربات به گروه",'url'=>'https://t.me/AviraApibot?startgroup=add']
                ],
                [
				['text'=>"• درباره ما",'callback_data'=>'aboutus'],['text'=>"• پشتیبانی",'callback_data'=>'poshtibanipv']
                ],
				[
				['text'=>"گروه پشتیبانی",'url'=>'https://t.me/joinchat/LnHoTFMoy259sMXqjjk2Ow'],['text'=>"کانال پشتیبانی",'url'=>'https://t.me/AviraApi']
                ],
				
                ]
   ])
   ]);
   	       
}
else
{
		bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"
• کاربر $first_name

جهت استفاده از ربات ابتدا باید در کانال ربات عضو شوید
سپس به ربات برگردید و دستور /start را ارسال کنید !",
'reply_markup'=>json_encode([
    'inline_keyboard'=>[
	[
	['text'=>"• ورود به کانال",'url'=>"https://t.me/$channel"]
	],
              ]
        ])
            ]);
}	
}
 elseif($data=="kharid2"){
            bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"
این بخش تکمیل نشده است !
",
'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				[
                ['text'=>"! Unknown !",'url'=>'https://t.me/Shita'],['text'=>"! Unknown !",'callback_data'=>'freepv']
                ],    
			    [
   ['text'=>"برگشت »",'callback_data'=>'backpv']
   ],
                     ]
               ])
           ]);
 }
  elseif($data=="backpv"){
            bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"
• سلام $first_name ؛ به ربات هوشمند مدیریت گروه آویرا خوش آمدید.

• Hello $first_name ؛ Welcome to the Avira Group Smart Management Robot.


",
'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
                  [
                ['text'=>"•••",'callback_data'=>'kharid2'],['text'=>"•••",'callback_data'=>'freepv']
                ],
				[
                ['text'=>"• دستورات ربات",'callback_data'=>'help11'],['text'=>"افزودن ربات به گروه",'url'=>'https://t.me/AviraApibot?startgroup=add']
                ],
                [
				['text'=>"• درباره ما",'callback_data'=>'aboutus'],['text'=>"• پشتیبانی",'callback_data'=>'poshtibanipv']
                ],
				[
				['text'=>"گروه پشتیبانی",'url'=>'https://t.me/joinchat/LnHoTFMoy259sMXqjjk2Ow'],['text'=>"کانال پشتیبانی",'url'=>'https://t.me/AviraApi']
                ],
				
                ]
   ])
   ]);
   	       
}
   elseif($data=="aboutus"){
            bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"

از اینکه ربات ما را جهت خدمت رسانی انتخاب کرده اید صمیمانه سپاسگذاریم
ما نهایت تلاش خود را داریم که بهترین هارو در اختیار شما عزیزان قرار بدیم

• سازنده و توسعه دهنده: عـارفــAr̸iــ
• ایمیل پشتیبانی: cmprotox@gmail.com
• پشتیبانی تلگرامی: @Shita و @AriKord


• Creator: ShitaGian

",
'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				[
   ['text'=>"برگشت »",'callback_data'=>'backpv']
   ],
                ]
               ])
           ]);
 }
    elseif($data=="help11"){
            bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"
• دوست عزیز ؛ جهت نمایش دستورات ربات ؛ ربات را در گروه اد کرده ادمین کنید سپس دستور نصب را ارسال کنید بعد از نصب شدن ربات دستور راهنما را بزنید تا قسمت های مختلف ربات جهت راهنمایی نمایش داده شود.
",
'reply_markup'=>json_encode([
            'inline_keyboard'=>[
				[
                    ['text'=>"برگشت »",'callback_data'=>'backpv']
                ],
                ]
               ])
           ]);
 }
 
     elseif($data=="poshtibanipv"){
            bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"
• کاربر گرامی
در صورتی که به پشتیبانی نیاز دارید بر روی گزینه /support کلیک کنید و مشکل خود را مطرح کنید و منتظر بمانید ؛ پشتیبانی ربات به زودی درخواست شما را بررسی و به آن پاسخ می دهد.

لطفا شکیبا باشید ...
",
'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				[
                    ['text'=>"برگشت »",'callback_data'=>'backpv']
                ],
                ]
               ])
           ]);
 }

   elseif($data=="gap"){
            bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"
			   بزودی این بخش کامل میشود
",
'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				[
   ['text'=>"برگشت »",'callback_data'=>'backpv']
   ],
                ]
               ])
           ]);
 }
 
     elseif($data=="freepv"){
            bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"
این بخش تکمیل نشده است !
",
'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
                [
                    ['text'=>"افزودن ربات به گروه",'url'=>'https://t.me/AviraApibot?startgroup=add']
                ],
				[
                    ['text'=>"برگشت »",'callback_data'=>'backpv']
                ],
                ]
               ])
           ]);
 }
elseif($textmassage=="/cancel" && $tc == "private"){
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"
• عملیات با موفقیت لغو شد !

برای نمایش منوی اول دستور /start را ارسال کنید",
    		]);
$user["userjop"]["$from_id"]["file"]="none";
$user = json_encode($user,true);
file_put_contents("data/user.json",$user);	
}
    elseif($textmassage=="/support" && $tc == "private"){
        bot('sendmessage',[
    'chat_id'=>$chat_id,
    'text'=>"
• لطفا پیام خود را ارسال کنید !

جهت لغو عملیات دستور /cancel را ارسال کنید",
  ]);
$user["userjop"]["{$from_id}"]["file"]="sup";
$user = json_encode($user,true);
$arashw = 779216972;
file_put_contents("data/user.json",$user);  
  }
elseif($update->message && $rt && in_array($from_id,$arashw) && $tc == "private"){
  bot('sendmessage',[
        "chat_id"=>$chat_id,
        "text"=>"• پیام شما برای فرد ارسال شد !"
    ]);
    if ($from_id == $arashw){
  bot('sendmessage',[
        "chat_id"=>$reply,
        "text"=>"$textmassage",
'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
                [
                    ['text'=>"کد پشتیبان : 22",'url'=>'https://t.me/$channel']
                ],
                ]
        
               ])
    ]);
    }
    else
    {
      bot('sendmessage',[
        "chat_id"=>$reply,
        "text"=>"$textmassage",
'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
                [
                    ['text'=>"کد پشتیبان : 13",'url'=>'https://t.me/$channel']
                ],
                ]
        
               ])
    ]);
    }
}            
//=======================================================================================
// help
 if($textmassage=="Help" or $textmassage=="راهنما" or $textmassage=="help"){
	 if ($tc == 'group' | $tc == 'supergroup'){  
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"
• لطفا زبان موردنظر را جهت دریافت لیست دستورات انتخاب کنید.",
	   'reply_markup'=>json_encode([
    'inline_keyboard'=>[
 	[
	  ['text'=>"• فارسی",'callback_data'=>"farsi"],['text'=>"• English",'callback_data'=>"english"]
	  ],
	  	  	 [
				 ['text'=>"بستن",'callback_data'=>'exit']
		 ],
   ]
   ])
   ]);
   }  
  }  
   	    elseif($data=="help"){
            bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"
• لطفا زبان موردنظر را جهت دریافت لیست دستورات انتخاب کنید.",
	   'reply_markup'=>json_encode([
    'inline_keyboard'=>[
 	[
	  ['text'=>"• فارسی",'callback_data'=>"farsi"],['text'=>"• English",'callback_data'=>"english"]
	  ],
	  	  	 [
				 ['text'=>"بستن",'callback_data'=>'exit']
		 ],
   ]
   ])
   ]);
   } 
	    elseif($data=="english"){
            bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"Welcome to the Robot English Help section. Please select your desired section",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				    	[
	  ['text'=>"• General guide",'callback_data'=>"allen"],['text'=>"• Management guide",'callback_data'=>"manageen"]
	  ],
	  				    	[
	  ['text'=>"• Lock guides",'callback_data'=>"locken"],['text'=>"• Owner's guide",'callback_data'=>"sudohelpen"]
	  ],
					 [
					 ['text'=>"Back »",'callback_data'=>'help']
					 ],
                     ]
               ])
           ]);
    }
		
		    elseif($data=="farsi"){
            bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"
•• بخش راهنمای فارسی ربات
لطفا یکی از بخش های زیر را انتخاب کنید !",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				    	[
	  ['text'=>"• راهنمای عمومی",'callback_data'=>"allfa"],['text'=>"• راهنمای مدیریتی",'callback_data'=>"managefa"]
	  ],
	  				    	[
	  ['text'=>"• راهنمای قفلی",'callback_data'=>"lockfa"],['text'=>"• راهنمای سودو",'callback_data'=>"sudohelpfa"]
	  ],
					 [
					 ['text'=>"برگشت »",'callback_data'=>'help']
					 ],
                     ]
               ])
           ]);
    }
			    elseif($data=="manageen"){
			 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev)){
            bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"• با عرض پوزش ربات در حال بازنویسی است و امکان دریافت راهنمای مدیریتی مقدور نیست !
اگر سوال یا مشکلی دارید با @Shita در میان بگذارید
",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
					 [
					 ['text'=>"برگشت »",'callback_data'=>'english']
					 ],
                     ]
               ])
           ]);
		   		 }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
    }
				}
				    elseif($data=="managefa"){
				 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
            bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"• با عرض پوزش ربات در حال بازنویسی است و امکان دریافت راهنمای مدیریتی مقدور نیست !
اگر سوال یا مشکلی دارید با @Shita در میان بگذارید
",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
					 [
					 ['text'=>"برگشت »",'callback_data'=>'farsi']
					 ],
                     ]
               ])
           ]);
		   		 }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
    }
					}
					 elseif($data=="allen"){
            bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"• با عرض پوزش ربات در حال بازنویسی است و امکان دریافت راهنمای عمومی مقدور نیست !
اگر سوال یا مشکلی دارید با @Shita در میان بگذارید",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
					 [
					 ['text'=>"برگشت »",'callback_data'=>'english']
					 ],
                     ]
               ])
           ]);
    }
						 elseif($data=="allfa"){
            bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"• با عرض پوزش ربات در حال بازنویسی است و امکان دریافت راهنمای عمومی مقدور نیست !
اگر سوال یا مشکلی دارید با @Shita در میان بگذارید",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
					 [
					 ['text'=>"برگشت »",'callback_data'=>'farsi']
					 ],
                     ]
               ])
           ]);
    }	
				    elseif($data=="lockfa"){
				 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
            bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"
•• راهنمای دستورات قفلی ربات:

برای قفل کردن یا بازکردن فقط کافیست عبارات [قفل] یا [بازکردن] را به ابتدای کلمات زیر اضافه کنید.

مثال:

قفل لینک
بازکردن لینک


🔒 قفل لینک
🔓 بازکردن لینک

🔒 قفل فایل
🔓 بازکردن فایل

🔒 قفل گیف
🔓 بازکردن گیف

🔒 قفل عکس
🔓 بازکردن عکس

🔒 قفل موزیک
🔓 بازکردن موزیک

🔒 قفل ویس
🔓 بازکردن ویس

🔒 قفل فیلم
🔓 بازکردن فیلم

🔒 قفل فیلم سلفی
🔓 بازکردن فیلم سلفی

🔒 قفل استیکر
🔓 بازکردن استیکر

🔒 قفل فوروارد
🔓 بازکردن فوروارد

🔒 قفل ربات
🔓 بازکردن ربات

🔒 قفل ریپلی
🔓 بازکردن ریپلی

🔒 قفل سرویس تلگرام
🔓 بازکردن سرویس تلگرام

🔒 قفل ویرایش
🔓 بازکردن ویرایش

🔒 قفل بازی
🔓 بازکردن بازی

🔒 قفل فحش
🔓 بازکردن فحش

🔒 قفل مخاطب
🔓 بازکردن مخاطب

🔒 قفل هشتگ
🔓 بازکردن هشتگ

🔒 قفل تگ
🔓 بازکردن تگ

🔒 قفل دستورات
🔓 بازکردن دستورات

🔒 قفل متن
🔓 بازکردن متن

🔒 قفل گروه 
🔓 بازکردن گروه

🔒 قفل خودکار
🔓 بازکردن خودکار 
",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
					 [
					 ['text'=>"برگشت »",'callback_data'=>'farsi']
					 ],
                     ]
               ])
           ]);
		   		 }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
    }
					}	
									    elseif($data=="locken"){
				 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
            bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"
•• Robot Lock Guides:

To lock or unlock, just add the [Lock] or [Unlock] phrases to the beginning of the following words.

Example:

Lock link
Unlock link


🔒 Lock link
🔓 Unlock link

🔒 Lock document
🔓 Unlock document

🔒 Lock gif
🔓 Unlock gif

🔒 Lock photo
🔓 Unlock photo

🔒 Lock music
🔓 Unlock music

🔒 Lock voice
🔓 Unlock voice

🔒 Lock video
🔓 Unlock video

🔒 Lock selfvideo
🔓 Unlock selfvideo

🔒 Lock sticker
🔓 Unlock sticker

🔒 Lock forward
🔓 Unlock forward

🔒 Lock bot
🔓 Unlock bot

🔒 Lock reply
🔓 Unlock reply

🔒 Lock tgservice
🔓 Unlock tgservice

🔒 Lock edit
🔓 Unlock edit

🔒 Lock game
🔓 Unlock game

🔒 Lock fosh
🔓 Unlock fosh

🔒 Lock contact
🔓 Unlock contact

🔒 Lock hashtag
🔓 Unlock hashtag

🔒 Lock tag
🔓 Unlock tag

🔒 Lock cmd
🔓 Unlock cmd

🔒 Lock text
🔓 Unlock text

🔒 Lock group
🔓 Unlock group

🔒 Lock auto
🔓 Unlock auto
",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
					 [
					 ['text'=>"Back »",'callback_data'=>'english']
					 ],
                     ]
               ])
           ]);
		   		 }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
    }
					}
						 elseif($data=="sudohelpfa"){
				 if (in_array($fromid,$dev) ){
            bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"• با عرض پوزش ربات در حال بازنویسی است و امکان دریافت راهنمای سودو مقدور نیست !
اگر سوال یا مشکلی دارید با @Shita در میان بگذارید",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
					 [
					 ['text'=>"برگشت »",'callback_data'=>'farsi']
					 ],
                     ]
               ])
           ]);
		   		 }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"• شما دسترسی ندارید !",
]);
    }
					}
							elseif($data=="sudohelpen"){
				 if (in_array($fromid,$dev) ){
            bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"• با عرض پوزش ربات در حال بازنویسی است و امکان دریافت راهنمای سودو مقدور نیست !
اگر سوال یا مشکلی دارید با @Shita در میان بگذارید",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
					 [
					 ['text'=>"برگشت »",'callback_data'=>'english']
					 ],
                     ]
               ])
           ]);
		   		 }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"• شما دسترسی ندارید !",
]);
    }
					}
  elseif($data=="helppanel"){
									 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
            bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"
به بخش راهنمای ربات خوش آمدید
	
لطفا زبان موردنظر را جهت دریافت لیست دستورات ربات انتخاب کنید",
	   'reply_markup'=>json_encode([
    'inline_keyboard'=>[
 	[
	  ['text'=>"• فارسی",'callback_data'=>"farsipanel"],['text'=>"• English",'callback_data'=>"englishpanel"]
	  ],
	  	  	 [
				 ['text'=>"برگشت »",'callback_data'=>'back']
		 ],
		      
   ]
   ])
   ]);
   }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
   } 
						}
   	    elseif($data=="englishpanel"){
					 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
            bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"Welcome to the Robot English Help section
",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				    	[
	  ['text'=>"• General",'callback_data'=>"allenpanel"],['text'=>"• Managerial",'callback_data'=>"manageenpanel"]
	  ],
	  				    	[
	  ['text'=>"• The lock",'callback_data'=>"lockenpanel"],['text'=>"• Sudo",'callback_data'=>"sudohelpenpanel"]
	  ],
					 [
					 ['text'=>"Back »",'callback_data'=>'helppanel']
					 ],
                     ]
               ])
           ]);
		   }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
    }
		}
		    elseif($data=="farsipanel"){
						 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
            bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"
به بخش راهنمای فارسی ربات خوش آمدید",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				    	[
	  ['text'=>"• عمومی",'callback_data'=>"allfapanel"],['text'=>"• مدیریتی",'callback_data'=>"managefapanel"]
	  ],
	  				    	[
	  ['text'=>"• قفلی",'callback_data'=>"lockfapanel"],['text'=>"• سودو",'callback_data'=>"sudohelpfapanel"]
	  ],
					 [
					 ['text'=>"برگشت »",'callback_data'=>'helppanel']
					 ],
                     ]
               ])
           ]);
		   }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
    }
			}
			elseif($data=="manageenpanel"){
			 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
            bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"• با عرض پوزش ربات در حال بازنویسی است و امکان دریافت راهنمای مدیریتی مقدور نیست !
اگر سوال یا مشکلی دارید با @Shita در میان بگذارید",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
					 [
					 ['text'=>"برگشت »",'callback_data'=>'englishpanel']
					 ],
                     ]
               ])
           ]);
		   }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
    }
				}
				    elseif($data=="managefapanel"){
				 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
            bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"• با عرض پوزش ربات در حال بازنویسی است و امکان دریافت راهنمای مدیریتی مقدور نیست !
اگر سوال یا مشکلی دارید با @Shita در میان بگذارید",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
					 [
					 ['text'=>"برگشت »",'callback_data'=>'farsipanel']
					 ],
                     ]
               ])
           ]);
		   }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
    }
					}
					 elseif($data=="allenpanel"){
						 	 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
            bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"• با عرض پوزش ربات در حال بازنویسی است و امکان دریافت راهنمای عمومی مقدور نیست !
اگر سوال یا مشکلی دارید با @Shita در میان بگذارید",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
					 [
					 ['text'=>"برگشت »",'callback_data'=>'englishpanel']
					 ],
                     ]
               ])
           ]);
		   }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
    }
					 }
						 elseif($data=="allfapanel"){
							 	 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
            bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"• با عرض پوزش ربات در حال بازنویسی است و امکان دریافت راهنمای مدیریتی مقدور نیست !
اگر سوال یا مشکلی دارید با @Shita در میان بگذارید",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
					 [
					 ['text'=>"برگشت »",'callback_data'=>'farsipanel']
					 ],
                     ]
               ])
           ]);
		   }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
    }	
						 }
				    elseif($data=="lockfapanel"){
				 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
            bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"
•• راهنمای دستورات قفلی ربات:

برای قفل کردن یا بازکردن فقط کافیست عبارات [قفل] یا [بازکردن] را به ابتدای کلمات زیر اضافه کنید.

مثال:

قفل لینک
بازکردن لینک


🔒 قفل لینک
🔓 بازکردن لینک

🔒 قفل فایل
🔓 بازکردن فایل

🔒 قفل گیف
🔓 بازکردن گیف

🔒 قفل عکس
🔓 بازکردن عکس

🔒 قفل موزیک
🔓 بازکردن موزیک

🔒 قفل ویس
🔓 بازکردن ویس

🔒 قفل فیلم
🔓 بازکردن فیلم

🔒 قفل فیلم سلفی
🔓 بازکردن فیلم سلفی

🔒 قفل استیکر
🔓 بازکردن استیکر

🔒 قفل فوروارد
🔓 بازکردن فوروارد

🔒 قفل ربات
🔓 بازکردن ربات

🔒 قفل ریپلی
🔓 بازکردن ریپلی

🔒 قفل سرویس تلگرام
🔓 بازکردن سرویس تلگرام

🔒 قفل ویرایش
🔓 بازکردن ویرایش

🔒 قفل بازی
🔓 بازکردن بازی

🔒 قفل فحش
🔓 بازکردن فحش

🔒 قفل مخاطب
🔓 بازکردن مخاطب

🔒 قفل هشتگ
🔓 بازکردن هشتگ

🔒 قفل تگ
🔓 بازکردن تگ

🔒 قفل دستورات
🔓 بازکردن دستورات

🔒 قفل متن
🔓 بازکردن متن

🔒 قفل گروه 
🔓 بازکردن گروه

🔒 قفل خودکار
🔓 بازکردن خودکار
",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
					 [
					 ['text'=>"برگشت »",'callback_data'=>'farsipanel']
					 ],
                     ]
               ])
           ]);
		   }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
    }
					}	
									    elseif($data=="lockenpanel"){
				 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$dev) ){
            bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"
•• Robot Lock Guides:

To lock or unlock, just add the [Lock] or [Unlock] phrases to the beginning of the following words.

Example:

Lock link
Unlock link


🔒 Lock link
🔓 Unlock link

🔒 Lock document
🔓 Unlock document

🔒 Lock gif
🔓 Unlock gif

🔒 Lock photo
🔓 Unlock photo

🔒 Lock music
🔓 Unlock music

🔒 Lock voice
🔓 Unlock voice

🔒 Lock video
🔓 Unlock video

🔒 Lock selfvideo
🔓 Unlock selfvideo

🔒 Lock sticker
🔓 Unlock sticker

🔒 Lock forward
🔓 Unlock forward

🔒 Lock bot
🔓 Unlock bot

🔒 Lock reply
🔓 Unlock reply

🔒 Lock tgservice
🔓 Unlock tgservice

🔒 Lock edit
🔓 Unlock edit

🔒 Lock game
🔓 Unlock game

🔒 Lock fosh
🔓 Unlock fosh

🔒 Lock contact
🔓 Unlock contact

🔒 Lock hashtag
🔓 Unlock hashtag

🔒 Lock tag
🔓 Unlock tag

🔒 Lock cmd
🔓 Unlock cmd

🔒 Lock text
🔓 Unlock text

🔒 Lock group
🔓 Unlock group

🔒 Lock auto
🔓 Unlock auto
",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
					 [
					 ['text'=>"Back »",'callback_data'=>'englishpanel']
					 ],
                     ]
               ])
           ]);
		   }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"داداچ داری اشتباه میزنی!",
]);
    }
					}
						 elseif($data=="sudohelpfapanel"){
				 if (in_array($fromid,$dev) ){
            bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"• با عرض پوزش ربات در حال بازنویسی است و امکان دریافت راهنمای سودو مقدور نیست !
اگر سوال یا مشکلی دارید با @Shita در میان بگذارید",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
					 [
					 ['text'=>"برگشت »",'callback_data'=>'farsipanel']
					 ],
                     ]
               ])
           ]);
		   }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"• شما دسترسی ندارید !",
]);
    }
					}
							elseif($data=="sudohelpenpanel"){
				 if (in_array($fromid,$dev) ){
            bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"• با عرض پوزش ربات در حال بازنویسی است و امکان دریافت راهنمای سودو مقدور نیست !
اگر سوال یا مشکلی دارید با @Shita در میان بگذارید",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
					 [
					 ['text'=>"برگشت »",'callback_data'=>'englishpanel']
					 ],
                     ]
               ])
           ]);
		   }else{
			bot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"• شما دسترسی ندارید !",
]);
    }
					}
					
unlink("error_log");
error_reporting(0);

?>
