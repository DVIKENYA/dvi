<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
    <div class="block-web">
        <div class="col-lg-12">

            <div class="col-md-6">
                <div id="table" class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <?php if ($user_level == '1' || $user_level == '2') { ?>
                                <th>
                                    <h5 class="content-header text-info">3 Good Performing Counties</h5></th>
                                <?php }elseif($user_level == '3') { ?>
                                <th>
                                    <h5 class="content-header text-info">3 Good Performing </br>SubCounties</h5></th>

                                <?php }elseif($user_level == '4') { ?>
                                <th>
                                    <h5 class="content-header text-info">3 Good Performing </br>Facilities</h5></th>
                                <?php } ?>
                                <th>
                                    <h5 class="content-header text-info">DPT </br>Coverage %</h5></th>
                                <th>
                                    <h5 class="content-header text-info">Drop Out</h5></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($best as $row) {?>
                            <tr>
                                <?php if ($user_level == '2') { ?>
                                <td><?php echo $row['county_name'] ?></td>
                                <td><?php echo $row['totaldpt3'] ?></td>
                                <td><?php echo($row['totaldpt3'] - $row['totaldpt3']) ?></td>
                                <?php }elseif($user_level == '3') { ?>
                                <td><?php echo $row['subcounty_name'] ?></td>
                                <td><?php echo $row['totaldpt3'] ?></td>
                                <td><?php echo($row['totaldpt3'] - $row['totaldpt3']) ?></td>
                                <?php }elseif($user_level == '4') { ?>
                                <td><?php echo $row['facility_name'] ?></td>
                                <td><?php echo $row['totaldpt3'] ?></td>
                                <td><?php echo($row['totaldpt3'] - $row['totaldpt3']) ?></td>
                            </tr><?php } ?> <?php } ?>
                        </tbody>
                    </table>
                    <hr>
                    </br>

                </div>

            </div>

            <div class="col-md-6">

                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <?php if ($user_level == '1' || $user_level == '2') { ?>
                                <th>
                                    <h5 class="content-header text-info">3 Poor Performing Counties</h5></th>
                                <?php }elseif($user_level == '3') { ?>
                                <th>
                                    <h5 class="content-header text-info">3 Poor Performing </br>SubCounties</h5></th>
                                <?php }elseif($user_level == '4') { ?>
                                <th>
                                    <h5 class="content-header text-info">3 Poor Performing </br>Facilities</h5></th>
                                <?php } ?>
                                <th>
                                    <h5 class="content-header text-info">DPT </br>Coverage %</h5></th>
                                <th>
                                    <h5 class="content-header text-info">Drop Out</h5></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php  foreach($worst as $row) {   ?>
                            <tr>
                                <?php if ($user_level == '2') { ?>
                                <td><?php echo $row['county_name'] ?></td>
                                <td><?php echo $row['totaldpt3'] ?></td>
                                <td><?php echo($row['totaldpt3'] - $row['totaldpt3']) ?></td>
                                <?php }elseif($user_level == '3') { ?>
                                <td><?php echo $row['subcounty_name'] ?></td>
                                <td><?php echo $row['totaldpt3'] ?></td>
                                <td><?php echo($row['totaldpt3'] - $row['totaldpt3']) ?></td>
                                <?php }elseif($user_level == '4') { ?>
                                <td><?php echo $row['facility_name'] ?></td>
                                <td><?php echo $row['totaldpt3'] ?></td>
                                <td><?php echo($row['totaldpt3'] - $row['totaldpt3']) ?></td>
                            </tr><?php } ?> <?php } ?>
                        </tbody>
                    </table>
                    <hr>
                    </br>

                </div>

            </div>

        </div>
    </div>
</div>
