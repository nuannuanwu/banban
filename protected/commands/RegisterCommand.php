<?php
/**
 *
 */
class RegisterCommand extends CConsoleCommand{
    public function run($args)
    {
        $records = UserRegisterInvited::getNullSender();
        foreach($records as $record){
            $sender = Member::getUniqueMember($record->mobilephone);
            if($sender){
                $record->sender = $sender->userid;
                $record->save();
            }
        }
    }
}