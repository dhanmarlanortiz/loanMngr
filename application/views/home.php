<div class="home">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <h3 class="section-title">
                    Standing Loans
                </h3>
                    <table class="standing-loans">
                        <thead>
                            <tr>
                                <th>Client</th>
                                <th>Trans. #</th>
                                <th>Loan Date</th>
                                <th>Balance</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if(isset($standing_loans)) {
                                    foreach ($standing_loans as $key => $sl) {
                                        $raw_date = date_create($sl['date']);
                                        $date = date_format($raw_date,"M d, Y");
                                        $amount = number_format($sl['amount']);
                                        echo "
                                            <tr>
                                                <td>".$sl['firstname']." ".$sl['lastname']."</td>
                                                <td class='text-center'>".$sl['id']."</td>
                                                <td class='text-right'>".$date."</td>
                                                <td class='text-right'>".$amount."</td>
                                                <td><a href='".site_url()."/clients/profile/".$sl['client_id']."'>Details</a></td>
                                            </tr>
                                        ";
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
</div>
