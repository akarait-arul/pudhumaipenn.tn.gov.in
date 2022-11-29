<div id="table-dbinswise">
    <div class="table-responsive scrollbar">

        <table class="table2excel table table-bordered table-striped fs--1 mb-0 table-sortable-customise" id="dboard-institution-table">

            <thead class="pdf_hide">
                <tr>
                    <th colspan='11' class="h5 align-middle text-center sorter-false">Pudhumai Penn Scheme - Application Status as on <?php echo date('d-M-Y'); ?>
                        <div class="text-right">
                            <a href="download_excel_institution.php" target="_blank"><span class="fas fa-file-excel text-warning fs-3 ms-1" data-fa-transform="down-1"></span></a>
                        </div>
                    </th>

                </tr>		
                <tr class="bg-primary text-light">
                    <th class="align-middle text-center avoid-sort sorter-false" rowspan="2">Sl No</th>
                    <th class="align-middle text-center" rowspan="2">Institution Type</th>
                    <th class="align-middle text-center" rowspan="2">Total No of Institutions</th>
                    <th class="align-middle text-center" rowspan="2">No of Institutions logged in</th>
                    <th class="align-middle text-center" rowspan="2">No of Institutions not logged in</th>
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
            <thead  class="pdf_visible d-none"    >
                <tr>
                    <th colspan='11' class="h5 align-middle text-center sorter-false">Pudhumai Penn Scheme - Application Status as on <?php echo date('d-M-Y'); ?>
                        <div class="text-right">
                            <a data-html2canvas-ignore="true"  href="download_excel_institution.php" target="_blank"><span class="fas fa-file-excel text-warning fs-3 ms-1" data-fa-transform="down-1"></span></a>
                        </div>
                    </th>

                </tr>		
                <tr class="bg-primary text-light">
                    <th class="align-middle text-center" >Sl No</th>
                    <th class="align-middle text-center">Institution Type</th>
                    <th class="align-middle text-center" >Total No of Institutions</th>
                    <th class="align-middle text-center" >No of Institutions logged in</th>
                    <th class="align-middle text-center" >No of Institutions not logged in</th>
                    <th class="align-middle text-center" >Total Application Received</th>
                    <th class="align-middle text-center" >Application auto-approved for all stages</th>
                    <th class="align-middle text-center">Total Pending  Application</th>		  
                    <th class="align-middle text-center">Only School Pending  Application</th>
                    <th class="align-middle text-center">Only Bank Pending  Application</th>
                    <th class="align-middle text-center">Both School and Bank Pending  Applications</th>
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
                $total_no_institution = 0;
                $no_of_institutions_logged_in = 0;
                $no_of_institutions__not_logged_in = 0;
                $total_application_received = 0;
                $application_auto_approved_all_stages = 0;
                $total_pending = 0;
                $only_school_pending = 0;
                $only_bank_pending = 0;
                $both_school_bank_pending = 0;
                $_row = 1;

                foreach ($data_instituion as $k => $value) {

                    echo '<tr>
                            <td class="name">' . $_row . '</td>
                            <td class="name">' . $value['institution_type'] . '</td>';
                    echo (int) $value['Total No of Institutions'] != 0 ? '<td class="text-center"><a href="get_institution_detail_list.php?type=' . base64_encode('inst') . '&inst_type_name=' . base64_encode($value['institution_type']) . '&dist=' . base64_encode($m_district_id) . '&inst_type=' . base64_encode($k) . '&callfor=' . base64_encode('Total No of Institutions') . '">' . $value['Total No of Institutions'] . '</a></td>' : '<td class="text-center">' . $value['Total No of Institutions'] . '</td>';
                    echo (int) $value['No of Institutions logged in'] != 0 ? '<td class="text-center"><a href="get_institution_detail_list.php?type=' . base64_encode('inst') . '&inst_type_name=' . base64_encode($value['institution_type']) . '&dist=' . base64_encode($m_district_id) . '&inst_type=' . base64_encode($k) . '&callfor=' . base64_encode('No of Institutions logged in') . '">' . $value['No of Institutions logged in'] . '</a></td>' : '<td class="text-center">' . $value['No of Institutions logged in'] . '</td>';
                    echo (int) $value['No of Institutions not logged in'] != 0 ? '<td class="text-center"><a href="get_institution_detail_list.php?type=' . base64_encode('inst') . '&inst_type_name=' . base64_encode($value['institution_type']) . '&dist=' . base64_encode($m_district_id) . '&inst_type=' . base64_encode($k) . '&callfor=' . base64_encode('No of Institutions not logged in') . '">' . $value['No of Institutions not logged in'] . '</a></td>' : '<td class="text-center">' . $value['No of Institutions not logged in'] . '</td>';
                    echo (int) $value['Total Application Received'] != 0 ? '<td class="text-center"><a href="get_institution_detail_list.php?type=' . base64_encode('appl') . '&inst_type_name=' . base64_encode($value['institution_type']) . '&dist=' . base64_encode($m_district_id) . '&inst_type=' . base64_encode($k) . '&callfor=' . base64_encode('Total Application Received') . '">' . $value['Total Application Received'] . '</a></td>' : '<td class="text-center">' . $value['Total Application Received'] . '</td>';
                    echo (int) $value['Application auto-approved for all stages'] != 0 ? '<td class="text-center"><a href="get_institution_detail_list.php?type=' . base64_encode('appl') . '&inst_type_name=' . base64_encode($value['institution_type']) . '&dist=' . base64_encode($m_district_id) . '&inst_type=' . base64_encode($k) . '&callfor=' . base64_encode('Application auto-approved for all stages') . '">' . $value['Application auto-approved for all stages'] . '</a></td>' : '<td class="text-center">' . $value['Application auto-approved for all stages'] . '</td>';
                    echo (int) ((int) $value['Total Application Received'] - (int) $value['Application auto-approved for all stages']) != 0 ? '<td class="text-center"><a href="get_institution_detail_list.php?type=' . base64_encode('appl') . '&inst_type_name=' . base64_encode($value['institution_type']) . '&dist=' . base64_encode($m_district_id) . '&inst_type=' . base64_encode($k) . '&callfor=' . base64_encode('Total Pending Application') . '">' . ((int) $value['Total Application Received'] - (int) $value['Application auto-approved for all stages']) . '</a></td>' : '<td class="text-center">' . ((int) $value['Total Application Received'] - (int) $value['Application auto-approved for all stages']) . '</td>';
                    echo (int) $value['Only School Pending'] != 0 ? '<td class="text-center"><a href="get_institution_detail_list.php?type=' . base64_encode('appl') . '&inst_type_name=' . base64_encode($value['institution_type']) . '&dist=' . base64_encode($m_district_id) . '&inst_type=' . base64_encode($k) . '&callfor=' . base64_encode('Only School Pending') . '">' . $value['Only School Pending'] . '</a></td>' : '<td class="text-center">' . $value['Only School Pending'] . '</td>';
                    echo (int) $value['Only Bank Pending'] != 0 ? '<td class="text-center"><a href="get_institution_detail_list.php?type=' . base64_encode('appl') . '&inst_type_name=' . base64_encode($value['institution_type']) . '&dist=' . base64_encode($m_district_id) . '&inst_type=' . base64_encode($k) . '&callfor=' . base64_encode('Only Bank Pending') . '">' . $value['Only Bank Pending'] . '</a></td>' : '<td class="text-center">' . $value['Only Bank Pending'] . '</td>';
                    echo (int) $value['Both School and Bank Pending'] != 0 ? '<td class="text-center"><a href="get_institution_detail_list.php?type=' . base64_encode('appl') . '&inst_type_name=' . base64_encode($value['institution_type']) . '&dist=' . base64_encode($m_district_id) . '&inst_type=' . base64_encode($k) . '&callfor=' . base64_encode('Both School and Bank Pending') . '">' . $value['Both School and Bank Pending'] . '</a></td>' : '<td class="text-center">' . $value['Both School and Bank Pending'] . '</td>';
                    echo "</tr>";
                    $total_no_institution += (int) $value['Total No of Institutions'];
                    $no_of_institutions_logged_in += (int) $value['No of Institutions logged in'];
                    $no_of_institutions__not_logged_in += (int) $value['No of Institutions not logged in'];
                    $total_application_received += (int) $value['Total Application Received'];
                    $application_auto_approved_all_stages += (int) $value['Application auto-approved for all stages'];
                    $total_pending += ((int) $value['Total Application Received'] - (int) $value['Application auto-approved for all stages']);
                    $only_school_pending += (int) $value['Only School Pending'];
                    $only_bank_pending += (int) $value['Only Bank Pending'];
                    $both_school_bank_pending += (int) $value['Both School and Bank Pending'];

                    $_row++;
                }
                ?>
            </tbody>
            <?php
            echo '<tfoot><tr class="avoid-sort sorter-false">
                    <td colspan="2" class="text-center fw-bold avoid-sort sorter-false"> Total </td>';
            echo (int) $total_no_institution != 0 ? '<td class="text-center avoid-sort sorter-false"><a href="get_institution_detail_list.php?type=' . base64_encode('inst') . '&inst_type_name=' . base64_encode($value['institution_type']) . '&dist=' . base64_encode($m_district_id) . '&inst_type=' . base64_encode($m_institution_type_id) . '&callfor=' . base64_encode('Total No of Institutions') . '">' . $total_no_institution . '</a></td>' : '<td class="text-center avoid-sort sorter-false">' . $total_no_institution . '</td>';
            echo (int) $no_of_institutions_logged_in != 0 ? '<td class="text-center avoid-sort sorter-false"><a href="get_institution_detail_list.php?type=' . base64_encode('inst') . '&inst_type_name=' . base64_encode($value['institution_type']) . '&dist=' . base64_encode($m_district_id) . '&inst_type=' . base64_encode($m_institution_type_id) . '&callfor=' . base64_encode('No of Institutions logged in') . '">' . $no_of_institutions_logged_in . '</a></td>' : '<td class="text-center avoid-sort sorter-false">' . $no_of_institutions_logged_in . '</td>';
            echo (int) $no_of_institutions__not_logged_in != 0 ? '<td class="text-center avoid-sort sorter-false"><a href="get_institution_detail_list.php?type=' . base64_encode('inst') . '&inst_type_name=' . base64_encode($value['institution_type']) . '&dist=' . base64_encode($m_district_id) . '&inst_type=' . base64_encode($m_institution_type_id) . '&callfor=' . base64_encode('No of Institutions not logged in') . '">' . $no_of_institutions__not_logged_in . '</a></td>' : '<td class="text-center avoid-sort sorter-false">' . $no_of_institutions__not_logged_in . '</td>';
            echo (int) $total_application_received != 0 ? '<td class="text-center avoid-sort sorter-false"><a href="get_institution_detail_list.php?type=' . base64_encode('appl') . '&inst_type_name=' . base64_encode($value['institution_type']) . '&dist=' . base64_encode($m_district_id) . '&inst_type=' . base64_encode($m_institution_type_id) . '&callfor=' . base64_encode('Total Application Received') . '">' . $total_application_received . '</a></td>' : '<td class="text-center avoid-sort sorter-false">' . $total_application_received . '</td>';
            echo (int) $application_auto_approved_all_stages != 0 ? '<td class="text-center avoid-sort sorter-false"><a href="get_institution_detail_list.php?type=' . base64_encode('appl') . '&inst_type_name=' . base64_encode($value['institution_type']) . '&dist=' . base64_encode($m_district_id) . '&inst_type=' . base64_encode($m_institution_type_id) . '&callfor=' . base64_encode('Application auto-approved for all stages') . '">' . $application_auto_approved_all_stages . '</a></td>' : '<td class="text-center avoid-sort sorter-false">' . $application_auto_approved_all_stages . '</td>';
            echo (int) $total_pending != 0 ? '<td class="text-center avoid-sort sorter-false"><a href="get_institution_detail_list.php?type=' . base64_encode('appl') . '&inst_type_name=' . base64_encode($value['institution_type']) . '&dist=' . base64_encode($m_district_id) . '&inst_type=' . base64_encode($m_institution_type_id) . '&callfor=' . base64_encode('Total Pending Application') . '">' . $total_pending . '</a></td>' : '<td class="text-center avoid-sort sorter-false">' . $total_pending . '</td>';
            echo (int) $only_school_pending != 0 ? '<td class="text-center avoid-sort sorter-false"><a href="get_institution_detail_list.php?type=' . base64_encode('appl') . '&inst_type_name=' . base64_encode($value['institution_type']) . '&dist=' . base64_encode($m_district_id) . '&inst_type=' . base64_encode($m_institution_type_id) . '&callfor=' . base64_encode('Only School Pending') . '">' . $only_school_pending . '</a></td>' : '<td class="text-center avoid-sort sorter-false">' . $only_school_pending . '</td>';
            echo (int) $only_bank_pending != 0 ? '<td class="text-center avoid-sort sorter-false"><a href="get_institution_detail_list.php?type=' . base64_encode('appl') . '&inst_type_name=' . base64_encode($value['institution_type']) . '&dist=' . base64_encode($m_district_id) . '&inst_type=' . base64_encode($m_institution_type_id) . '&callfor=' . base64_encode('Only Bank Pending') . '">' . $only_bank_pending . '</a></td>' : '<td class="text-center avoid-sort sorter-false">' . $only_bank_pending . '</td>';
            echo (int) $both_school_bank_pending != 0 ? '<td class="text-center avoid-sort sorter-false"><a href="get_institution_detail_list.php?type=' . base64_encode('appl') . '&inst_type_name=' . base64_encode($value['institution_type']) . '&dist=' . base64_encode($m_district_id) . '&inst_type=' . base64_encode($m_institution_type_id) . '&callfor=' . base64_encode('Both School and Bank Pending') . '">' . $both_school_bank_pending . '</a></td>' : '<td class="text-center avoid-sort sorter-false">' . $both_school_bank_pending . '</td>';

            echo'<tr></tfoot>';
            ?>
        </table>
    </div>
</div>