<?php
// Image popup config
// Url to be used as a link for popup
SpawConfig::setStaticConfigItem("PG_IMGPOPUP_DIALOG", SpawConfig::getStaticConfigValue('SPAW_UPLOAD').'viewimg.php?', SPAW_CFG_TRANSFER_JS);
// Query string parameter name
SpawConfig::setStaticConfigItem("PG_IMGPOPUP_PARAMETER", 'imglink', SPAW_CFG_TRANSFER_JS);
?>
