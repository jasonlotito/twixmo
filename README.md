twixmo
======

Twitter Nexmo search client

## Requirements

The scripts expects PHP 5.5 and that you have composer installed.

## Setup

    $ composer install
    
### 3rd Party Systems

You'll need to setup an application in [Twitter Application Management](https://apps.twitter.com/) and then you'll need to setup OAuth for your account.  You'll also need Nexmo setup as well, and then provide all that information.  You'll see that information below.  You can set it as environmental variables, or you can pass it all in as command line arguments.

This script runs as a long running process.

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


* -h  This display
* -f  Nexmo from phone number
* -t  Nexmo to phone number
* -s  Search term
* -i  Include retweets
* --twitter_oauth_key <key>
* --twitter_consumer_secret <key>
* --nexmo_key <key>
* --nexmo_secret <key>
* --twitter_oauth_key <key>
* --twitter_oauth_secret <key>

Example:

    $ php twixmo.php -s phptek -t 12152371280 --nexmo_key 59od68u2
    
## Run

    $ php twixmo.php -s search_term

### Example

    $ php twixmo.php -s phptek
