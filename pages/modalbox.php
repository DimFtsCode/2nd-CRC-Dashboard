
<!-- Modal Start Update task -->
<div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title text-center ">Update Task Job </h4>
            </div>
            <div class="modal-body">
                <form role="form" id="addTask" name="updateTask" action="../php_functions/update_task.php" method="POST">
                    <div class="form-horizontal">
                        <div class="form-group bg-primary">

                            <label class="col-sm-2 control-label">Subject : </label>
                            <div class="col-sm-10">
                                <input type="text" name="subject" class="form-control input-group-lg" required="Επιλέξτε Θέμα" placeholder="Θέμα">
                            </div>
                        </div>


                        <hr />
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Task Created by User : </label>
                            <?php
                            //$user_reg = $_SESSION['login_user'][2];
                            //echo "id" . $subject_id_parse[0];
                            //echo "<div class=\"col-sm-8\"><strong class=\"text-danger\">$user_reg</strong></div>";
                            //echo "<input class=\"hidden\" name=\"user_reg\"  value=\"" . $user_reg . "\">";
                            ?>

                        </div>
                        <br />
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Update</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>

</div> 