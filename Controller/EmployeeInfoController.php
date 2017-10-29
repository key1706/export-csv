<?php
/**
 * @author TruongHV1
 */

namespace Controller;

class EmployeeInfoController extends BaseController
{
    /**
     * @inheritdoc
     */
    protected $template = "View.php";
    protected $time;
    protected $performace;

    /**
     * @inheritdoc
     */
    public function indexAction()
    {
        $data = array();
        $this->time = microtime(true);
        $time = date('i:s', $this->time);
        echo "<div class=\"alert alert-dismissible alert-danger\">
  <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
  <strong>Thời gian khởi tạo: </strong> $time
</div>";
//        if (isset($this->performace)) {
            echo sprintf("Memory: %s / %s bytes\nTime: %f ms\n",
                number_format(memory_get_usage()),
                number_format(memory_get_peak_usage()),
                ($this->performace - $this->time)
            );
//        }

        if ($this->model) {
            $data = $this->model->findAll();
        }
        return $this->render($data);
    }

    /**
     * Handle import
     */
    public function importAction()
    {
        // CODE HERE

        if (isset ($_POST ["Import"])) {
            $filename = $_FILES ["file"] ["tmp_name"];

            // validate whether uploaded file is a csv file
            $csvMimes = array(
                'text/x-comma-separated-values',
                'text/comma-separated-values',
                'application/octet-stream',
                'application/vnd.ms-excel',
                'application/x-csv',
                'text/x-csv',
                'text/csv',
                'application/csv',
                'application/excel',
                'application/vnd.msexcel',
                'text/plain'
            );

            if ($_FILES ["file"] ["size"] > 0 && is_uploaded_file($filename) && in_array($_FILES ['file'] ['type'], $csvMimes)) {
                // open uploaded csv file with read only mode
                $file = fopen($filename, "r");

                // skip first line
                fgetcsv($file);

                try {
                    // parse data from csv file line by line
                    while (($getData = fgetcsv($file, 10000, ",")) !== FALSE) {

                        $data = array();
                        $data['emp_id'] = $getData [0];
                        $data['firstname'] = $getData [1];
                        $data['lastname'] = $getData [2];
                        $data['email'] = $getData [3];
                        if ($getData [4] == null) {
                            $data['reg_date'] = date('Y-m-d');

                        } else {
//                            convert date format dd/mm/yyyy => yyyy-mm-dd
                            $date = str_replace('/', '-', $getData [4]);
                            $data['reg_date'] = date('Y-m-d', strtotime($date));
                        }
                        $this->performace = microtime(true);
                        $result = $this->model->insertAll($data);
                    }
                } catch (Exception $e) {
                    echo "<script type=\"text/javascript\">
                            alert(\"Error:" . $e->getMessage() . "\");
                            window.location = \"index.php?c=EmployeeInfo\"
                        </script>";
                }

                if (isset ($result)) {

                    echo "<script type=\"text/javascript\">
                        alert(\"CSV File has been successfully Imported.\");
                        window.location = \"index.php?c=EmployeeInfo\"
                    </script>";
                }


                // close opened csv file
                fclose($file);
            } else {
                echo "<script type=\"text/javascript\">
                        alert(\"Invalid File:Please Upload CSV File.\");
                        window.location = \"index.php?c=EmployeeInfo\"
                      </script>";
            }
        }
    }

    /**
     * Handle export csv
     */
    public function exportAction()
    {
        if (isset ( $_POST ["Export"] )) {
            header ( 'Content-Type: text/csv; charset=utf-8' );
            header ( 'Content-Disposition: attachment; filename=data.csv' );

            $output = fopen ( "php://output", "w" );

            fputcsv ( $output, array (
                'ID',
                'First Name',
                'Last Name',
                'Email',
                'Joining Date'
            ) );

            $result = $this->model->exprot();


            while ( $row = mysqli_fetch_assoc ( $result ) ) {
                fputcsv ( $output, $row );
            }

            fclose ( $output );
        }
    }
}