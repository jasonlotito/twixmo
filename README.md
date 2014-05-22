twixmo
======

Twitter Nexmo search client

## Environmental Vars

Yes, these all need to be setup.  You need a Twitter key and secret.  You also need a Nexmo key and secret.  You need
to set your From and To phone numbers.  From is the number from Nexmo, and To is your number.  Finally, you need your
oauth key and secret from Twitter for your application.

    define('TWITTER_CONSUMER_KEY', getenv('TWITTER_KEY'));
    define('TWITTER_CONSUMER_SECRET', getenv('TWITTER_SECRET'));
    define('NEXMO_KEY', getenv('NEXMO_KEY'));
    define('NEXMO_SECRET', getenv('NEXMO_SECRET'));
    define('NEXMO_FROM', getenv('NEXMO_FROM'));
    define('NEXMO_TO', getenv('NEXMO_TO'));
    define('TWITTER_OAUTH_KEY', getenv('TWITTER_OAUTH_KEY'));
    define('TWITTER_OAUTH_SECRET', getenv('TWITTER_OAUTH_SECRET'));
    
## Run

    $ php twixmo.php search_term

### Example

    $ php twixmo.php phptek
