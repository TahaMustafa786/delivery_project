<?php

include 'layout/header.php';

?>

<?php

if (isset($_SESSION['user_id'])) { ?>
    <table class="table mt-5 mb-5" id="myTable">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Address 1</th>
                <th scope="col">Address 2</th>
                <th scope="col">Postcode</th>
                <th scope="col">Lat</th>
                <th scope="col">Lang</th>
                <th scope="col">status</th>
                <th scope="col">Delivery Photo</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data[0] as $value) { ?>
                <tr>
                    <th scope="row"><?php echo $value->id ?></th>
                    <td><?php echo $value->name ?></td>
                    <td><?php echo $value->address_1 ?></td>
                    <td><?php echo $value->address_2 ?></td>
                    <td><?php echo $value->postcode ?></td>
                    <td><?php echo $value->lat ?></td>
                    <td><?php echo $value->lang ?></td>
                    <td><?php echo $value->status_text ?></td>
                    <td>
                        <a target="_blank" href="<?php echo SITE_URL ?>public/assets/img/<?php echo $value->del_photo ?>">
                            <img src="<?php echo SITE_URL ?>public/assets/img/<?php echo $value->del_photo ?>" width="50px" alt="<?php echo $value->del_photo ?>">
                        </a>
                    </td>
                    <td>
                        <button type="button" class="btn btn-primary btn-sm updateStatusBtn" data-toggle="modal" data-target="#updateDeliveryStatus" data-id="<?php echo $value->id ?>">Update</button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <div class="modal fade" id="updateDeliveryStatus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Delivery Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <form action="<?php echo SITE_URL ?>/Home/updateDeliveryStatus/id" method="post" id="updateDeliveryForm">
                            <label for="delivery_options">Update Status</label>
                            <select name="status" class="form-control">
                                <?php foreach ($data[1] as $status) { ?>
                                    <option value="<?php echo $status->status_code ?>"><?php echo $status->status_text ?></option>
                                <?php } ?>
                            </select>
                            <button class="btn btn-success btn-sm mt-3">Submit</button>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let buttons = document.getElementsByClassName("updateStatusBtn");
        let form = document.getElementById("updateDeliveryForm");
        for (let i = 0; i < buttons.length; i++) {
            buttons[i].addEventListener("click", function() {
                let dataId = this.getAttribute("data-id");
                let formAction = form.getAttribute("action");
                formAction = formAction.replace("id" , dataId);
                form.setAttribute("action", formAction)
            });
        }
    });
</script>

<?php

include 'layout/footer.php';

?>