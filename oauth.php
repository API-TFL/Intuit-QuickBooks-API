<?php require_once 'configuration.php'; ?>
<html>
<head>
    <title>IPP Oauth</title>

    <!-- Every page of your app should have this snippet of Javascript in it, so that it can show the Blue Dot menu -->
    <script type="text/javascript" src="https://appcenter.intuit.com/Content/IA/intuit.ipp.anywhere.js"></script>
    <script type="text/javascript">
        intuit.ipp.anywhere.setup({
            menuProxy: '<?php print(MENU_URL); ?>',
            grantUrl: '<?php print(OAUTH_URL); ?>'
        });
    </script>

</head>
<body>

    <ipp:connectToIntuit></ipp:connectToIntuit>

</body>
</html>