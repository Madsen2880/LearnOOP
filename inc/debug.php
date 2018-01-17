<?php
/**
 * Created by PhpStorm.
 * User: mcarp
 * Date: 17-01-2018
 * Time: 13:01
 */
?>
<div class="usrp-fb-2 is-expanded">

    <!-- Expanded content -->
    <div class="usrp-fb-state-expanded">
        <div class="usrp-fb-title"><i class="fa fa-bug"></i> DEBUG MENU <i class="fa fa-bug"></i></div>
        <?php print_r($_SESSION) ?>
        <div class="usrp-fb-divider"></div>
        <div class="usrp-fb-btn usrp-fb-btn-yes">SKJUL</div>
    </div>

    <!-- Collapsed content -->
    <div class="usrp-fb-state-collapsed">
        <div class="usrp-fb-title"> &nbsp; DEBUG &nbsp;</div>
    </div>

</div>
