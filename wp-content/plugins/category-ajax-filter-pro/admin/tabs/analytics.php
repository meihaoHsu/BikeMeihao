<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>
<div class="tab-pane tab-pad" id="perform" role="tabpanel" aria-labelledby="perform-tab">
	<div class="manage-top-dash general-tab text"><?php echo esc_html__('Analytics', 'category-ajax-filter-pro');
//date_default_timezone_set('NZ');
 ?></div>
<div id="tabs-panel">
 <?php
$status = 'Disable';
if (get_option('caf_enable_analytics_' . get_the_id())) {
    $status = get_option('caf_enable_analytics_' . get_the_id());
}
if ($status == 'Enable') {
    ?>
 <div class="col-sm-12 row-bottom no-margin">
  <div class="form-group row" style="margin-bottom: 0">
  <label for="caf-filter-layout" class='col-sm-12 bold-span-title'><?php echo esc_html__('Filter Your Analytics', 'category-ajax-filter-pro'); ?><span class='info'><?php echo esc_html__('Filter your analytics.', 'category-ajax-filter-pro'); ?></span></label>
   <div class="col-sm-12">
  <select id="filter-analytics" class="form-control tc_caf_object_field tc_caf_select caf_import" onChange="filterAnalytics(this.value)">
   <?php
$filter = 'all';
    if (isset($_REQUEST["filter"])) {
        $filter = $_REQUEST["filter"];
    }
    ?>
   <option value="all" <?php if ($filter == 'all') {echo "selected";}?>>All Stats</option>
   <option value="today" <?php if ($filter == 'today') {echo "selected";}?>>Today's Stats</option>
  </select>
    </div>
   </div>
 </div>
 <?php
}
?>
    <div class="tab-panel analytics-class">
<?php
if ($status == "Enable") {
    if (get_option("caf_performance_" . get_the_ID())) {
        $analytics_data = get_option("caf_performance_" . get_the_ID());
        $total_clicks = $analytics_data['clicks'];
        if (isset($_REQUEST["filter"])) {
            $filter = $_REQUEST["filter"];
            $cats1 = $analytics_data[0]['cats'];
            if ($filter == "today") {
                foreach ($cats1 as $index => $cat) {
                    $tl_clicks = 0;
                    foreach ($cat as $i => $ct1) {
                        if ($ct1['today']['date'] == date("m.d.y")) {
                            $tl_clicks += $ct1['today']['clicks'];
                        }
                    }
                    $tl_cl[] = $tl_clicks;
                }
                $total_clicks = array_sum($tl_cl);
            } else {
                $total_clicks = $analytics_data['clicks'];
            }
        }
        //echo $total_clicks;
        echo "<div class='caf-analytics-main cntr'>";
        echo "<div class='caf-analytics-data'>" . esc_html($total_clicks) . "<div class='caf-analytics-label'>" . esc_html__('Total Clicks', 'category-ajax-filter-pro') . "</div></div>";
        echo "</div>";
        echo "<div class='caf-analytics-main cats'>";
        $cats = $analytics_data[0]['cats'];
        foreach ($cats as $index => $cat) {
            $sum = 0;
            foreach ($cat as $i => $ct1) {
                if (isset($_REQUEST["filter"])) {
                    $filter = $_REQUEST["filter"];
                    if ($filter == "today") {
                        if ($ct1['today']['date'] == date("m.d.y")) {
                            $sum += $ct1['today']['clicks'];
                        }
                    } else {
                        $sum += $ct1['clicks'];
                    }
                } else {
                    $sum += $ct1['clicks'];
                }
            }
            ?>
     	<div class="tab-panel filter-typography">
	<div class="tab-header" data-content="<?php echo esc_attr($index); ?>" style="position: relative;"><i class="fa fa-align-center left" aria-hidden="true"></i> <?php echo esc_html($index, 'tc_caf');
            echo "<div class='an-sum'>" . esc_html($sum) . " <span class='clcks-caf'>" . esc_html__('clicks', 'category-ajax-filter-pro') . "</span></div>"; ?><i class="fa fa-angle-down" aria-hidden="true"></i></div>
  	<div class="tab-content <?php echo esc_attr($index); ?> " style="overflow:hidden">
    <div class="form-group row">
    <?php
echo "<div class='caf-analytics-manager'>";
            //echo "<h5 data-total='".$sum."'>".$index." (".$sum.")</h5>";
            echo "<div id='caf-analytics-$index' style='width:100%;display:inline-block;'></div>";
            echo "</div>";
            $arr = array();
            //var_dump($cat);
            foreach ($cat as $i => $ct) {
                if (get_term($ct['id'])) {
                    $term_name = get_term($ct['id'])->name;
                    if (isset($_REQUEST["filter"])) {
                        $filter = $_REQUEST["filter"];
                        if ($filter == "today") {
                            //  echo $ct['today']['clicks'];
                            if ($ct['today']['date'] == date("m.d.y")) {
                                $arr[] = array($term_name, $ct['today']['clicks']);
                            }
                        } else {
                            $arr[] = array($term_name, $ct['clicks']);
                        }
                    } else {
                        $arr[] = array($term_name, $ct['clicks']);
                    }
                }
            }
            $idd = "caf-analytics-" . $index;
///  var_dump($arr);
             ?>
     <script>
      google.charts.setOnLoadCallback(function setMe() {drawBasic(<?php echo json_encode($arr); ?>,<?php echo "'$idd'"; ?>,<?php echo "'$index'"; ?>)});
     </script>
	</div>
  </div>
  </div>
     <?php
}
        echo "</div>";
        // print_r($analytics_data);
    } else {
        echo "<div class='analytics-warning-status'>";
        echo esc_html__("There is no analytics data for this filter yet. Data will load when any user interact with this filter from frontend.", "category-ajax-filter-pro");
        echo "</div>";
    }
} else {
//      echo "<div class='analytics-warning-status'>";
    //   //   echo "Analytics is not enabled. Please enable analytics and wait for the refreshed data. Data will load when any user interact with this filter from frontend.";
    //      echo "</div>";
}
?>
    </div>
  <div class="form-group row" style="padding-top: 15px;">
  <div class="col-md-12">
    <label for="caf-filter-layout" class='col-sm-12 bold-span-title'><?php echo esc_html__('Enable/Disable Analytics', 'category-ajax-filter-pro'); ?><span class='info'><?php echo esc_html__('If Analytics is not enabled then Please enable analytics and wait for the refreshed data. Data will load when any user interact with this filter from frontend.', 'category-ajax-filter-pro'); ?></span></label>
    <div class="col-sm-12 filter-en">
  <input type="checkbox" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" id="enable-disable-analytics" name="analytics_status"  class="analytics_check tc_caf_object_field tc_caf_checkbox" data-field-type='checkbox' data-name="<?php echo get_the_ID(); ?>" <?php if ($status == "Enable") {echo "checked";} else {echo "";}?>>
    </div>
   </div>
 </div>
 <?php
if ($status == 'Enable') {
    ?>
 <div class="col-sm-12">
  <div class="form-group row">
  <label for="caf-filter-layout" class='col-sm-12 bold-span-title'><?php echo esc_html__('How Reset Works?', 'category-ajax-filter-pro'); ?><span class='info'><?php echo '<b style="color:red;">Note : </b>Analytics Data will be erased completely, You cannot undo it.'; ?></span></label>
   <div class="col-sm-12">
<!--
 <div class="caf-analytics-bar">
 <div class='caf-analytics-q'>How Reset Works?</div>
 <div class='caf-analytics-a'>We will remove the total stats of this specific filter. When any user open the specific filter from frontend then you will see your refreshed data.</div>
-->
  <button onClick="resetAnalytics(event,<?php echo get_the_ID(); ?>)" id='analytics-reset-btn'>Reset</button>
</div>
   </div></div>
 <?php
}
?>
 </div>
</div>