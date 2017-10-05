<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-5">
            <table class="table table-responsive table-sm table-striped">
                <thead class="thead-inverse">
                    <tr>
                        <th>#</th>
                        <th>Last&nbsp;Name</th>
                        <th>First&nbsp;Name</th>
                        <th>Address</th>
                        <th>Telephone</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        
                        if(null == $clients) {
                            echo "<tr><td colspan='6' class='text-center'>No records</td></tr>";
                        }else {
                            $ctr = 1;
                            foreach ($clients as $c): ?>
                                <tr>
                                    <td><?=$ctr++?></td>
                                    <td><?=$c['lastname'] ?></td>
                                    <td><?=$c['firstname'] ?></td>
                                    <td><?=$c['address'] ?></td>
                                    <td><?=$c['telephone'] ?></td>
                                    <td class="text-center"><a href="#"><i class="fa fa-pencil-square-o"></i></a></td>
                                </tr>
                        <?php
                            endforeach;
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

