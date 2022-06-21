<?php

if (!defined('ABSPATH')) {
    exit;
}

function displaySyncSettings() {
    $allSyncStats = (new SyncStatsRepository())->getAllStats();
    $showError = hasSyncStatsError($allSyncStats);
    $showSkipped = hasSyncStatsSkipped($allSyncStats);
?>
<div class="settings-section">    
    <h3 class="title">Sync settings</h3>
    <p class="title-desc">Your store data, like contacts and orders, are automatically synced with Omnisend. The chart below displays the current sync status.</p>
    <div class="sync-stats">
        <table class="wp-list-table widefat fixed striped posts">
            <thead>
                <tr>
                    <td>Data type</td>
                    <td class="fixed_date">Successfully synced</td>
                    <td>Total</td>
                    <td>Pending</td>
                    <?php if ($showError) { echo '<td>Error</td>'; } ?>
                    <?php if ($showSkipped) { echo '<td>Skipped</td>'; } ?>
                </tr>
            </thead>
            <tr>
                <td>Contacts</td>
                <td><?php echo $allSyncStats->contacts->synced; ?></td>
                <td>
                <?php 
                    if ($allSyncStats->contacts->unique && $allSyncStats->contacts->unique != $allSyncStats->contacts->total) {
                        echo $allSyncStats->contacts->total . ' (Unique - ' . $allSyncStats->contacts->unique . ')';
                    } else {
                        echo $allSyncStats->contacts->total;
                    } 
                ?>
                </td>
                <?php 
                    if ($allSyncStats->contacts->notSynced > 0) {
                        echo '<td class="omnisend-warn">' . $allSyncStats->contacts->notSynced . '</td>'; 
                    } else {
                        echo '<td>' . $allSyncStats->contacts->notSynced . '</td>'; 
                    } 
                ?>
                <?php 
                    if ($showError) {
                        if ($allSyncStats->contacts->error > 0) {
                            echo '<td class="omnisend-warn">' . $allSyncStats->contacts->error . '</td>'; 
                        } else {
                            echo '<td>' . $allSyncStats->contacts->error . '</td>'; 
                        } 
                    } 
                ?>
                <?php if ($showSkipped) { echo '<td>' . $allSyncStats->contacts->skipped . '</td>'; } ?>
            </tr>
            <tr>
                <td>Orders</td>
                <td><?php echo $allSyncStats->orders->synced; ?></td>
                <td><?php echo $allSyncStats->orders->total; ?></td>
                <?php
                    if ($allSyncStats->orders->notSynced > 0) {
                        echo '<td class="omnisend-warn">' . $allSyncStats->orders->notSynced . '</td>'; 
                    } else {
                        echo '<td>' . $allSyncStats->orders->notSynced . '</td>'; 
                    } 
                ?>
                <?php 
                    if ($showError) {
                        if ($allSyncStats->orders->error > 0) {
                            echo '<td class="omnisend-warn">' . $allSyncStats->orders->error . '</td>'; 
                        } else {
                            echo '<td>' . $allSyncStats->orders->error . '</td>'; 
                        } 
                    } 
                ?>
                <?php if ($showSkipped) { echo '<td>' . $allSyncStats->orders->skipped . '</td>'; } ?>
            </tr>
            <tr>
                <td>Products</td>
                <td><?php echo $allSyncStats->products->synced; ?></td>
                <td><?php echo $allSyncStats->products->total; ?></td>
                <?php
                    if ($allSyncStats->products->notSynced > 0) {
                        echo '<td class="omnisend-warn">' . $allSyncStats->products->notSynced . '</td>'; 
                    } else {
                        echo '<td>' . $allSyncStats->products->notSynced . '</td>'; 
                    } 
                ?>
                <?php 
                    if ($showError) {
                        if ($allSyncStats->products->error > 0) {
                            echo '<td class="omnisend-warn">' . $allSyncStats->products->error . '</td>'; 
                        } else {
                            echo '<td>' . $allSyncStats->products->error . '</td>'; 
                        } 
                    } 
                ?>
                <?php if ($showSkipped) { echo '<td>' . $allSyncStats->products->skipped . '</td>'; } ?>
            </tr>
            <tr>
                <td>Categories</td>
                <td><?php echo $allSyncStats->categories->synced; ?></td>
                <td><?php echo $allSyncStats->categories->total; ?></td>
                <?php
                    if ($allSyncStats->categories->notSynced > 0) {
                        echo '<td class="omnisend-warn">' . $allSyncStats->categories->notSynced . '</td>'; 
                    } else {
                        echo '<td>' . $allSyncStats->categories->notSynced . '</td>'; 
                    } 
                ?>
                <?php 
                    if ($showError) {
                        if ($allSyncStats->categories->error > 0) {
                            echo '<td class="omnisend-warn">' . $allSyncStats->categories->error . '</td>'; 
                        } else {
                            echo '<td>' . $allSyncStats->categories->error . '</td>'; 
                        } 
                    } 
                ?>
                <?php if ($showSkipped) { echo '<td>' . $allSyncStats->categories->skipped . '</td>'; } ?>
            </tr>
            <tr>
                <td>Carts</td>
                <td><?php echo $allSyncStats->carts; ?></td>
                <td>-</td>
                <td>-</td>
                <?php if ($showError) { echo '<td>-</td>'; } ?>
                <?php if ($showSkipped) { echo '<td>-</td>'; } ?>
            </tr>
        </table>
    </div>
<?php
    displaySyncActions($allSyncStats);
    displayResyncAllContacts();
?>
</div>
<?php
}

function hasSyncStatsError($syncStats) {
    if ($syncStats->contacts->error) {
        return true;
    }
    if ($syncStats->orders->error) {
        return true;
    }
    if ($syncStats->products->error) {
        return true;
    }
    if ($syncStats->categories->error) {
        return true;
    }

    return false;
}

function hasSyncStatsSkipped($syncStats) {
    if ($syncStats->contacts->skipped) {
        return true;
    }
    if ($syncStats->orders->skipped) {
        return true;
    }
    if ($syncStats->products->skipped) {
        return true;
    }
    if ($syncStats->categories->skipped) {
        return true;
    }

    return false;
}

function hasSyncStatsNotSynced($syncStats) {
    if ($syncStats->contacts->notSynced) {
        return true;
    }
    if ($syncStats->orders->notSynced) {
        return true;
    }
    if ($syncStats->products->notSynced) {
        return true;
    }
    if ($syncStats->categories->notSynced) {
        return true;
    }

    return false;
}

function displaySyncActions($allSyncStats) {
    if (!hasSyncStatsError($allSyncStats) && !hasSyncStatsSkipped($allSyncStats) && !hasSyncStatsNotSynced($allSyncStats)) {
        return;
    }
?>
    <div class="sync-actions">
<?php
    if (OmnisendInitSyncManager::areDataSyncing()) {
?>
        <div class="sync-loader">
            <div class="sync-spinner"></div> <span>Syncing...</span>
        </div>
<?php
    } else {
?>
        <p>Resync store data from Pending, Error or Skipped columns.</p>
        <div>
            <form method="post">
                <input type="hidden" name="action" value="omnisend_init_resync" />
                <input type="submit" value="Resync" class="button button-primary" />
            </form>
        </div>
<?php
    }
?>
    </div>
<?php
}

function displayResyncAllContacts() {
    if (OmnisendInitSyncManager::areContactsSyncing()) {
        return;
    }
?>
    <div class="resync-contacts">
        <h3 class="sub-title">Resync all contacts</h3>
        <p class="title-desc">Resync all of your contacts with Omnisend. The resync time depends on how many contacts you have.</p>
        <form method="post">
            <input type="hidden" name="action" value="omnisend_resync_all_contacts">
            <input type="submit" value="Resync all contacts" class="button button-danger">
        </form>
    </div>
<?php
}