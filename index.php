<?php

	$api_url = "";
	$api_key = "";

	define("ACTIVECAMPAIGN_URL", $api_url);
	define("ACTIVECAMPAIGN_API_KEY", $api_key);

	require_once("../../activecampaign-api-php/includes/ActiveCampaign.class.php");
	$ac = new ActiveCampaign(ACTIVECAMPAIGN_URL, ACTIVECAMPAIGN_API_KEY);

	if (!(int)$ac->credentials_test()) {
		print_r("Invalid credentials (URL and API Key).");
		exit();
	}

	$account = $ac->api("account/view");
//$ac->dbg($account);
	$account_url = "http://" . $account->account; // differs from API URL

	$listid = (isset($_GET["listid"]) && (int)$_GET["listid"]) ? $_GET["listid"] : 1;

	header("Content-type: text/xml");
	print("<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n");

?>

<rss version="2.0">

	<channel>

		<title>Recent Campaigns</title>
		<link>http://<?php echo $_SERVER["HTTP_HOST"]; ?><?php echo $_SERVER["REQUEST_URI"]; ?></link>
		<description>Recent campaign feed with link to web copy of message</description>

		<?php

			$campaigns = $ac->api("campaign/list?ids=all&filters[listid]={$listid}&sort=cdate&sort_direction=DESC&page=1");
//$ac->dbg($campaigns);

			foreach ($campaigns as $campaign) {

				if (isset($campaign->messages[0])) {

					// try to get just the content inside <body>
					preg_match_all("|<body>(.*)</body>|iUs", $campaign->messages[0]->html, $body_content);

					if (isset($body_content[1][0])) {
						$body = $body_content[1][0];
					}
					else {
						$body = $campaign->messages[0]->html;
					}

					?>

					<item>
						<title><?php echo $campaign->messages[0]->subject; ?></title>
						<link><![CDATA[<?php echo $account_url . "/index.php?action=social&c=" . md5($campaign->id) . "." . $campaign->messages[0]->id; ?>]]></link>
						<pubDate><?php echo date("r", strtotime($campaign->cdate)); ?></pubDate>
						<description><![CDATA[ <?php echo $body; ?> ]]></description>
					</item>

					<?php

				}

			}

		?>

	</channel>

</rss>