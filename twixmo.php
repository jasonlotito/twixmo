<?php

require_once './vendor/autoload.php';

$options = getopt('f:t:s:h', [
    'twitter_oauth_key:',
    'twitter_oauth_secret:',
    'nexmo_secret:',
    'nexmo_key:',
    'twitter_consumer_key:',
    'twitter_consumer_secret:'
]);

if(isset($options['h'])) {
    echo <<<EOT
twixmo - Twitter Nexmo search and sms server v.1

    -h  This display
    -f  Nexmo from phone number
    -t  Nexmo to phone number
    -s  Search term
    --twitter_oauth_key <key>
    --twitter_consumer_secret <key>
    --nexmo_key <key>
    --nexmo_secret <key>
    --twitter_oauth_key <key>
    --twitter_oauth_secret <key>

Example:

    $ php twixmo.php -s phptek -t 12152371280 --nexmo_key 59od68u2

EOT;
    exit(0);
}

define('TWITTER_CONSUMER_KEY', isset($options['twitter_consumer_key']) ? $options['twitter_consumer_key'] : getenv('TWITTER_KEY'));
define('TWITTER_CONSUMER_SECRET', isset($options['twitter_consumer_secret']) ? $options['twitter_consumer_secret'] : getenv('TWITTER_SECRET'));
define('NEXMO_KEY', isset($options['nexmo_key']) ? $options['nexmo_key'] : getenv('NEXMO_KEY'));
define('NEXMO_SECRET', isset($options['nexmo_secret']) ? $options['nexmo_secret'] : getenv('NEXMO_SECRET'));
define('NEXMO_FROM', isset($options['f']) ? $options['f'] : getenv('NEXMO_FROM'));
define('NEXMO_TO', isset($options['t']) ? $options['t'] : getenv('NEXMO_TO'));
define('TWITTER_OAUTH_KEY', isset($options['twitter_oauth_key']) ? $options['twitter_oauth_key'] : getenv('TWITTER_OAUTH_KEY'));
define('TWITTER_OAUTH_SECRET', isset($options['twitter_oauth_secret']) ? $options['twitter_oauth_secret'] : getenv('TWITTER_OAUTH_SECRET'));

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

        var_dump($s->text);

        if(isset($s->retweeted_status)){
            echo PHP_EOL . "Was retweeted, backing out" . PHP_EOL;
            return;
        }

        $res = file_get_contents('https://rest.nexmo.com/sms/json?' . http_build_query([
                'api_key' => NEXMO_KEY,
                'api_secret' => NEXMO_SECRET,
                'from' => NEXMO_FROM,
                'to' => NEXMO_TO,
                'text' => $s->text
            ]));
        var_dump($res);
    }
}

$hose = new Twixmo(TWITTER_OAUTH_KEY, TWITTER_OAUTH_SECRET, Phirehose::METHOD_FILTER);
$track = $options['s'];
$hose->setTrack([$track]);
$hose->consume(true);