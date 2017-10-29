<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet"
        href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
    <script
        src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js">
    </script>
</head>
<body>
    <div id="wrap">
        <div class="container">
            <div class="row">

                <form class="form-horizontal" action="index.php?c=EmployeeInfo&a=import" method="post"
                    name="upload_excel" enctype="multipart/form-data">
                    <fieldset>

                        <!-- Form Name -->
                        <legend>Import Export CSV</legend>

                        <!-- File Button -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="filebutton">Select
                                File</label>
                            <div class="col-md-4">
                                <input type="file" name="file" id="file" class="input-large">
                            </div>
                        </div>

                        <!-- Button -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="singlebutton">Import
                                data</label>
                            <div class="col-md-4">
                                <button type="submit" id="submit" name="Import"
                                    class="btn btn-primary button-loading"
                                    data-loading-text="Loading...">Import</button>
                            </div>
                        </div>

                    </fieldset>
                </form>

            </div>
            <?php
                if (isset($data)) {
                    if (is_array($data) && count($data) > 0) {
                        echo "<div class='table-responsive'><table id='myTable' class='table table-striped table-bordered'>
                     <thead><tr><th>EMP ID</th>
                                  <th>First Name</th>
                                  <th>Last Name</th>
                                  <th>Email</th>
                                  <th>Registration Date</th>
                                </tr></thead><tbody>";

                        foreach ($data as $row) {
                            echo "<tr><td>" . $row ['emp_id'] . "</td>
                           <td>" . $row ['firstname'] . "</td>
                           <td>" . $row ['lastname'] . "</td>
                           <td>" . $row ['email'] . "</td>
                           <td>" . $row ['reg_date'] . "</td></tr>";
                        }

                        echo "</tbody></table></div>";
                    } else {
                        echo "You have no records";
                    }
                }
			?>
        </div>

        <div>
            <form class="form-horizontal" action="index.php?c=EmployeeInfo&a=export" method="post"
                name="upload_excel" enctype="multipart/form-data">
                <div class="form-group">
                    <div class="col-md-4 col-md-offset-4">
                        <input type="submit" name="Export" class="btn btn-success"
                            value="Export to csv" />
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>