<?php


class Twixmo extends OauthPhirehose
{
    /**
     * This is the one and only method that must be implemented additionally. As per the streaming API documentation,
     * statuses should NOT be processed within the same process that is performing collection
     *
     * @param string $status
     */
    public function enqueueStatus($status)
    {
        $s = json_decode($status);

        echo $s->text . PHP_EOL;

        if( IGNORE_RETWEETS && isset($s->retweeted_status)){
            echo PHP_EOL . "Was retweeted, backing out" . PHP_EOL;
            return;
        }

        $res = file_get_contents('https://rest.nexmo.com/sms/json?' . http_build_query([
                'api_key' => NEXMO_KEY,
                'api_secret' => NEXMO_SECRET,
                'from' => NEXMO_FROM,
                'to' => NEXMO_TO,
                'text' => sprintf('%s said: %s', $s->user->screen_name, $s->text)
            ]));

        $r = json_decode($res);

        printf('Message-ID: %s, Balance: %2.4f' . PHP_EOL, $r->messages[0]->{'message-id'}, $r->messages[0]->{'remaining-balance'});
    }
}