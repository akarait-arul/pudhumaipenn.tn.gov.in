<!-- <div class="container-fluid p-0 dashboard-ins-layout" id="dashboard-ins" data-layout="container">
        <div class="row g-3 mb-3 mt-0 flex-between-center dist-wise-col-list-cards" id="count_data"> -->
<div class="container-fluid p-0">
    <div class="text-right back-to-dash-button">
        <a id="href_excel" href="download_excel_get_institution_detail_list.php?<?php echo $url ?>" target="_blank"><span class="fas fa-file-excel text-warning fs-3 ms-1" data-fa-transform="down-1"></span></a>
        <a href="dashboard.php" class="btn btn-primary btn-sm">Back To Dashboard </a>
    </div>
</div>

<div class="container-fluid p-0 dashboard-ins-layout" id="dashboard-ins" data-layout="container">

    <div class="row g-3 mb-3 mt-0 dist-wise-col-list-cards" id="count_data">

        <?php
        $over_all_ins_count = 0;
        foreach ($data_institution_count as $key => $value) {
            $over_all_ins_count += $value;
            if ($_SESSION['user_details']['user_type'] != 30) {
                echo '<div class="card">
                                <h5 class="card-header card-title d-flex align-items-center h-100" style="padding:10px;font-size: 12px;">' . $key . '</h5>
                                <div class="card-body" style="padding:0px;">
                                    <div style="padding:10px;font-size: 12px !important;" class="display-4 fs-1 fw-normal font-sans-serif text-primary count" data-countup="{&quot;endValue&quot;:23.434,&quot;decimalPlaces&quot;:2,&quot;suffix&quot;:&quot;k&quot;}">
                                       ' . $value . '
                                    </div>
                                </div>
                                <div class="card-footer m-0 text-right d-none">
                                    <span class="fas fa-eye text-dark ms-1" data-fa-transform="down-1"></span>
                                    <span class="fas fa-file-excel text-warning ms-1" data-fa-transform="down-1"></span>
                                    <span class="fas fa-file-pdf text-success ms-1" data-fa-transform="down-1"></span>
                                </div>
                            </div>';
            }
        }

        if ($over_all_ins_count > 0 && (count($data_institution_count) > 1 || $_SESSION['user_details']['user_type'] == 30)) {
            $link_array = array("Total Application Received", "Application auto-approved for all stages", "Total Pending Application", "Only School Pending", "Only Bank Pending", "Both School and Bank Pending");

            echo '<div class="card">
                                 <h5 class="card-header card-title" style="padding:10px;font-size: 12px;background-color: #2c7be5 !important;color: #ffffff !important;">Total</h5>
                                <div class="card-body" style="padding:0px;">
                       <div style="padding:10px;font-size: 12px !important;color: #000000 !important;" class="display-4 fs-1 fw-normal font-sans-serif text-primary count" data-countup="{&quot;endValue&quot;:23.434,&quot;decimalPlaces&quot;:2,&quot;suffix&quot;:&quot;k&quot;}">';

            if (in_array(base64_decode($_GET['callfor']), $link_array)) {
                echo '<a href="dashboard_student_list.php?inst_name=' . base64_encode('All') . '&dist=' . $_GET['dist'] . '&inst_type=' . $_GET['inst_type'] . '&inst_id=' . base64_encode('All') . '&callfor=' . $_GET['callfor'] . '">' . $over_all_ins_count . '</a>';
            } else {
                echo $over_all_ins_count;
            }
            echo'</div>
                                </div>
                                <div class="card-footer m-0 text-right d-none">
                                    <span class="fas fa-eye text-dark ms-1" data-fa-transform="down-1"></span>
                                    <span class="fas fa-file-excel text-warning ms-1" data-fa-transform="down-1"></span>
                                    <span class="fas fa-file-pdf text-success ms-1" data-fa-transform="down-1"></span>
                                </div>
                            </div>';
        }
        ?>    
    </div>

</div>

<div class="card mt-0">

    <div id="table-dbinswise">

        <div class="table-responsive scrollbar">
            <?php if ($_SESSION['user_details']['user_type'] != 30) { ?>
                <div class="row justify-content-between align-items-center p-2">
                    <div class="col-md-4 col-12">
                        <label class="form-label" for="institution_type">Filter By Institution Type *</label>
                        <select class="form-select" id="institution_type" required onchange="filterbyinstitution(this.value)">
                            <option value="<?php echo base64_encode('All') ?>"> All </option>
    <?php
    $inst_type = getInstituionType();
    foreach ($inst_type as $key => $value) {
        $_selected = false;
        if (base64_encode($key) == $_REQUEST['inst_type'])
            $_selected = true;
        echo'<option value="' . base64_encode($key) . '"' . ($_selected ? "selected" : "") . '>' . $value . '</option>';
    }
    ?>                                                    
                        </select> 
                    </div>
                    <!-- <div class="col-md-3 col-6">
                        <div class="text-right">
                            <a id="href_excel" href="download_excel_get_institution_detail_list.php?<?php echo $url ?>" target="_blank"><span class="fas fa-file-excel text-warning fs-3 ms-1" data-fa-transform="down-1"></span></a>
                            <a href="dashboard.php" class="btn btn-primary">Back To Dashboard </a>
                        </div>
                    </div> -->
                </div>
            <?php } ?>
            <table class="table2excel table table-bordered table-striped fs--1 mb-0 table-sortable-customise" id="districtwise-institution-detail-table">

                <thead>

                    <tr class="bg-primary text-light">
                        <th class="align-middle text-center avoid-sort sorter-false" rowspan="2">Sl No</th>
                        <th class="align-middle text-center" rowspan="2">Institution</th>
                        <th class="align-middle text-center" rowspan="2">Institution Type</th>
                        <th class="align-middle text-center" rowspan="2">Contact Person</th>
                        <th class="align-middle text-center" rowspan="2">Username</th>
                        <th class="align-middle text-center" rowspan="2">Total Application Received</th>
                        <th class="align-middle text-center" rowspan="2">Application auto-approved for all stages</th>
                        <th colspan='4' class="align-middle text-center avoid-sort sorter-false">Application Pending Details</th>
                    </tr> 
                    <tr class="bg-primary text-light">
                        <th class="align-middle text-center">Total Pending</th>		  
                        <th class="align-middle text-center">Only School Pending</th>
                        <th class="align-middle text-center">Only Bank Pending</th>
                        <th class="align-middle text-center">Both School and Bank Pending</th>
                    </tr>
                    <tr class="fw-bold align-middle text-center avoid-sort">
                        <th class="sorter-false">(1)</th>
                        <th class="sorter-false">(2)</th>
                        <th class="sorter-false">(3)</th>
                        <th class="sorter-false">(4)</th>
                        <th class="sorter-false">(5)</th>
                        <th class="sorter-false">(6)</th>
                        <th class="sorter-false">(7)</th>
                        <th class="sorter-false">(8) = (6) - (7)</th>
                        <th class="sorter-false">(9)</th>
                        <th class="sorter-false">(10)</th>
                        <th class="sorter-false">(11)</th>
                    </tr>
                </thead>

                <tbody class="list">
                    <?php
                    $sno = 1;
                    $overall_total_app_recd = 0;
                    $overall_total_pending = 0;
                    $overall_auto_aaproved_all_stage = 0;
                    $overall_school_pending = 0;
                    $overall_bank_pending = 0;
                    $overall_school_bank_pending = 0;
                    foreach ($data_instituion as $key => $value) {
                        $contact_person = "";
                        if (strlen(trim($value['contact_person'])) > 0) {
                            $contact_person .= $value['contact_person'];
                        }
                        if (strlen($contact_person) > 0)
                            $contact_person .= "<br/>";

                        if (strlen(trim($value['email_id'])) > 0) {
                            $contact_person .= $value['email_id'];
                        }

                        if (strlen($contact_person) > 0)
                            $contact_person .= "<br/>";

                        if (strlen(trim($value['mobile_number'])) > 0) {
                            $contact_person .= $value['mobile_number'];
                        }

                        $overall_total_app_recd += $value['total_app_recd'];
                        $overall_total_pending += $value['total_pending'];
                        $overall_auto_aaproved_all_stage += $value['app_auto_approved'];
                        $overall_school_pending += $value['only_school_pending'];
                        $overall_bank_pending += $value['only_bank_pending'];
                        $overall_school_bank_pending += $value['both_bank_school_pending'];
                        echo '<tr>
                                <td class="align-middle">' . $sno . '</td>
                                <td class="align-middle">' . $value['institution_name'] . '</td>
                                <td class="align-middle">' . $value['institution_type'] . '</td>    
                                <td class="align-middle">' . $contact_person . '</td>
                                <td class="align-middle">' . $value['lusername'] . '</td>';

                        echo (int) $value['total_app_recd'] == 0 ? '<td class="text-center">' . $value['total_app_recd'] . '</td>' : '<td class="text-center"><a href="dashboard_student_list.php?inst_name=' . base64_encode($value['institution_name']) . '&inst_id=' . base64_encode($value['m_institution_id']) . '&callfor=' . base64_encode('Total Application Received') . '">' . $value['total_app_recd'] . '</a></td>';
                        echo (int) $value['app_auto_approved'] == 0 ? '<td class="text-center">' . $value['app_auto_approved'] . '</td>' : '<td class="align-middle text-center text-primary "><a href="dashboard_student_list.php?inst_name=' . base64_encode($value['institution_name']) . '&inst_id=' . base64_encode($value['m_institution_id']) . '&callfor=' . base64_encode('Application auto-approved for all stages') . '">' . $value['app_auto_approved'] . '</td>';
                        echo (int) $value['total_pending'] == 0 ? '<td class="text-center">' . $value['total_pending'] . '</td>' : '<td class="align-middle text-center text-primary "><a href="dashboard_student_list.php?inst_name=' . base64_encode($value['institution_name']) . '&inst_id=' . base64_encode($value['m_institution_id']) . '&callfor=' . base64_encode('Total Pending Application') . '">' . $value['total_pending'] . '</td>';
                        echo (int) $value['only_school_pending'] == 0 ? '<td class="text-center">' . $value['only_school_pending'] . '</td>' : '<td class="align-middle text-center text-primary "><a href="dashboard_student_list.php?inst_name=' . base64_encode($value['institution_name']) . '&inst_id=' . base64_encode($value['m_institution_id']) . '&callfor=' . base64_encode('Only School Pending') . '">' . $value['only_school_pending'] . '</td>';
                        echo (int) $value['only_bank_pending'] == 0 ? '<td class="text-center">' . $value['only_bank_pending'] . '</td>' : '<td class="align-middle text-center text-primary "><a href="dashboard_student_list.php?inst_name=' . base64_encode($value['institution_name']) . '&inst_id=' . base64_encode($value['m_institution_id']) . '&callfor=' . base64_encode('Only Bank Pending') . '">' . $value['only_bank_pending'] . '</td>';
                        echo (int) $value['both_bank_school_pending'] == 0 ? '<td class="text-center">' . $value['both_bank_school_pending'] . '</td>' : '<td class="align-middle text-center text-primary "><a href="dashboard_student_list.php?inst_name=' . base64_encode($value['institution_name']) . '&inst_id=' . base64_encode($value['m_institution_id']) . '&callfor=' . base64_encode('Both School and Bank Pending') . '">' . $value['both_bank_school_pending'] . '</td>';
                        echo '</tr>';

                        $sno++;
                    }
                    ?>                              
                </tbody>
                <?php
                echo '<tfoot><tr class="avoid-sort sorter-false">
                        <td class="align-middle text-right sorter-false" colspan="5">Total</td>
                        <td class="align-middle text-center text-primary sorter-false"><a href="dashboard_student_list.php?inst_name=' . base64_encode('All') . '&dist=' . $_GET['dist'] . '&inst_type=' . $_GET['inst_type'] . '&inst_id=' . base64_encode('All') . '&callfor=' . base64_encode('Total Application Received') . '">' . $overall_total_app_recd . '</a></td>
                        <td class="align-middle text-center text-primary sorter-false"><a href="dashboard_student_list.php?inst_name=' . base64_encode('All') . '&dist=' . $_GET['dist'] . '&inst_type=' . $_GET['inst_type'] . '&inst_id=' . base64_encode('All') . '&callfor=' . base64_encode('Application auto-approved for all stages') . '">' . $overall_auto_aaproved_all_stage . '</a></td>
                        <td class="align-middle text-center text-primary sorter-false"><a href="dashboard_student_list.php?inst_name=' . base64_encode('All') . '&dist=' . $_GET['dist'] . '&inst_type=' . $_GET['inst_type'] . '&inst_id=' . base64_encode('All') . '&callfor=' . base64_encode('Total Pending Application') . '">' . $overall_total_pending . '</a></td>                        
                        <td class="align-middle text-center text-primary sorter-false"><a href="dashboard_student_list.php?inst_name=' . base64_encode('All') . '&dist=' . $_GET['dist'] . '&inst_type=' . $_GET['inst_type'] . '&inst_id=' . base64_encode('All') . '&callfor=' . base64_encode('Only School Pending') . '">' . $overall_school_pending . '<a></td>
                        <td class="align-middle text-center text-primary sorter-false"><a href="dashboard_student_list.php?inst_name=' . base64_encode('All') . '&dist=' . $_GET['dist'] . '&inst_type=' . $_GET['inst_type'] . '&inst_id=' . base64_encode('All') . '&callfor=' . base64_encode('Only Bank Pending') . '">' . $overall_bank_pending . '</a></td>
                        <td class="align-middle text-center text-primary sorter-false"><a href="dashboard_student_list.php?inst_name=' . base64_encode('All') . '&dist=' . $_GET['dist'] . '&inst_type=' . $_GET['inst_type'] . '&inst_id=' . base64_encode('All') . '&callfor=' . base64_encode('Both School and Bank Pending') . '">' . $overall_school_bank_pending . '</a></td>
                        <tr></tfoot>';
                ?>
            </table>
        </div>
    </div>
</div>
<script>
    function filterbyinstitution(value) {
        var dist_name = '<?php echo $_GET['dist_name'] ?>';
        var dist = '<?php echo $_GET['dist'] ?>';
        var callfor = '<?php echo $_GET['callfor'] ?>';
        var type = '<?php echo $_GET['type']; ?>';
        if (value) {
            //var url = "dist_name="+dist_name+"&dist="+dist+"&inst_type="+value+"&callfor="+callfor+"";
            var url = "get_institution_detail_list.php?type=" + type + "&dist_name=" + dist_name + "&dist=" + dist + "&inst_type=" + value + "&callfor=" + callfor + "";
            window.location.href = url;
            return;
            //document.getElementById('href_excel').href = "download_excel_get_institution_detail_list.php?"+url; 
        }
        $.ajax({
            method: "POST",
            url: "ajax.php",
            data: {
                fil_type: type,
                m_institution_type_id: value,
                m_district_id: dist,
                callfor: callfor,
                type: 'filterbyinstitution'
            },
            beforeSend: function () {
                $('.loader_firstimelogin').preloader({
                    text: 'Loading Please Wait ....'
                });
            },
            success: function (response) {
                $('.loader_firstimelogin').preloader('remove');
                resdata = $.parseJSON(response);
                console.log(resdata['count']);
                $('.list').empty();
                $('#count_data').empty();
                var data = '';
                var countdata = '';
                var sno = 1;

                if (resdata['list'].length != 0) {
                    var overall_total_app_recd = 0;
                    var overall_total_pending = 0;
                    var overall_auto_approved = 0;
                    var overall_school_pending = 0;
                    var overall_only_bank_pending = 0;
                    var overall_both_bank_school_pending = 0;


                    $.each(resdata['list'], function (index, value) {
                        var contact_person = '';
                        if (value['contact_person']) {
                            contact_person = value['contact_person'];
                        }

                        if (contact_person.length > 0)
                            contact_person += "<br/>";

                        if (value['email_id']) {
                            contact_person += value['email_id'];
                        }
                        if (contact_person.length > 0)
                            contact_person += "<br/>";

                        if (value['mobile_number']) {
                            contact_person += value['mobile_number'];
                        }

                        overall_total_app_recd += parseInt(value.total_app_recd);
                        overall_total_pending += parseInt(value.total_pending);
                        overall_auto_approved += parseInt(value.app_auto_approved);
                        overall_school_pending += parseInt(value.only_school_pending);
                        overall_only_bank_pending += parseInt(value.only_bank_pending);
                        overall_both_bank_school_pending += parseInt(value.both_bank_school_pending);

                        data += `<tr><td class='align-middle'>${sno}</td>
                              <td class='align-middle'>${value.institution_name}</td>
                              <td class='align-middle'>${value.institution_type}</td>
                              <td class='align-middle'>${contact_person}</td>
                              <td class='align-middle'>${value.lusername}</td>
                              <td class='align-middle text-center text-primary'>${value.total_app_recd}</td>
                              <td class='align-middle text-center text-primary'>${value.app_auto_approved}</td>
                              <td class='align-middle text-center text-primary'>${value.total_pending}</td>
                              <td class='align-middle text-center text-primary'>${value.only_school_pending}</td>
                              <td class='align-middle text-center text-primary'>${value.only_bank_pending}</td>
                               <td class='align-middle text-center text-primary'>${value.both_bank_school_pending}</td></tr>`;

                        sno++;
                    });

                    data += `<tr>
                            <th class='align-middle text-right' colspan="5">Total</th>
                            <th class='align-middle text-center text-primary'>${overall_total_app_recd}</th>
                            <th class='align-middle text-center text-primary'>${overall_auto_approved}</th>
                            <th class='align-middle text-center text-primary'>${overall_total_pending}</th>
                                 <th class='align-middle text-center text-primary'>${overall_school_pending}</th> 
                                <th class='align-middle text-center text-primary'>${overall_only_bank_pending}</th> 
                                    <th class='align-middle text-center text-primary'>${overall_both_bank_school_pending}</th> 
                            </tr>`;

                    // Card Count
                    $.each(resdata['count'], function (index, value) {

                        countdata += `
                                    <div class='card'>
                                        <h5 class='card-header card-title d-flex align-items-center h-100' style='padding:10px;font-size: 12px;'>${index}</h5>
                                        <div class='card-body' style='padding:0px;'>
                                            <div style='padding:10px;font-size: 12px !important;' class='display-4 fs-1 fw-normal font-sans-serif text-primary count' data-countup='{&quot;endValue&quot;:23.434,&quot;decimalPlaces&quot;:2,&quot;suffix&quot;:&quot;k&quot;}'>${value}</div>
                                            </div>
                                        <div class='card-footer m-0 text-right d-none'>
                                            <span class='fas fa-eye text-dark ms-1' data-fa-transform='down-1'></span>
                                            <span class='fas fa-file-excel text-warning ms-1' data-fa-transform='down-1'></span>
                                            <span class='fas fa-file-pdf text-success ms-1' data-fa-transform='down-1'></span>
                                        </div>
                                    </div>`;

                    });


                } else {

                    data += "<tr><td class='align-middle text-center' colspan='7'>Records Not found</td></tr>";
                    $('#count_data').empty();
                }
                console.log(countdata);
                $('.list').append(data);
                $('#count_data').append(countdata);
            }
        });


    }



</script>