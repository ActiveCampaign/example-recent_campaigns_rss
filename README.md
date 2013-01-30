ActiveCampaign Custom API Script: Fetch recent campaigns and format it as an RSS feed, with each item showing the message HTML and a link to the web copy of the campaign.

## Requirements

1. [Our PHP API library](https://github.com/ActiveCampaign/activecampaign-api-php)
2. A web server where you can run PHP code

## Installation and Usage

You can install **example-recent_campaigns_rss** by downloading (or cloning) the source.

Input your ActiveCampaign URL and API Key. Example below:

<pre>
define("ACTIVECAMPAIGN_URL", "YOUR ACTIVECAMPAIGN URL");
define("ACTIVECAMPAIGN_API_KEY", "YOUR ACTIVECAMPAIGN API KEY");
</pre>

Make sure the path to the PHP library is correct:

<pre>
require_once("../../activecampaign-api-php/includes/ActiveCampaign.class.php");
</pre>

To specify what list the script uses (to find recent campaigns from), set the `listid` parameter in the URL:

`http://example.com/script.php?listid=10`

(If you don't set the `listid` parameter, it will try using list ID `1` by default.)

Copy the URL of the script to load it in an RSS reader.

## Documentation and Links

* [Full API documentation](http://activecampaign.com/api)

## Reporting Issues

We'd love to help if you have questions or problems. Report issues using the [Github Issue Tracker](https://github.com/ActiveCampaign/example-recent_campaigns_rss/issues) or email help@activecampaign.com.