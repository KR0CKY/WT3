<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAB3</title>
    <link rel="stylesheet" href="main.css">
</head>

<body>
    <main>
      <div class="container">
        <h3 class="name">Register form:</h3>
        <div class="forms">
        <form method="post" class="main_forms">
            <div class="input_inf">
                <div class="form_name">   
                    <input class="input" type="text" name="name" autocomplete="off" required placeholder="Enter name">
                </div>
                <div class="form_address">
                    <input class="input" type="text" name="address" autocomplete="off" required placeholder="Enter address ">
                </div>
                <div class="form_phone">
                    <input class="input" type="text" name="phone" autocomplete="off" required placeholder="Enter phone">
                </div>
                <div class="form_mail">
                    <input class="input" type="email" name="mail" autocomplete="off" required placeholder="Enter e-mail">
                </div>
            </div>
                <div class="submit_btn">
                    <input class="submit" type="submit" name="submit" value="Register">
                </div>
        </form>

   

        
        </div>
      </div> 
    </main>
    
    <? if (isset($_POST["submit"]))
    {
        write();
        read();
    }
    else
    {
        read();
    }?>


    <form method="post" class="form_1">
        <div class="find_forms">
            <h5 class="find_text">Find:</h5>
            <div class="form_find">   
                <input class="input_find" type="text" name="find" autocomplete="off" required placeholder="Enter name">
            </div>  
        </div>
        <div class="find_submit">
            <input class="submit" type="submit" name="find_submit" value="Find">
        </div>
    </form>

    <?if(isset($_POST["find_submit"]))
    {
        find();
    }
    ?>


        <?function read()
        {
            $file = fopen('companies.csv', 'rt') or die("Не удалось подключть файл");?>
            <table class="table">
                <th>Name</th>
                <th>Address</th>
                <th>Phone</th>
                <th>E-mail</th>
            <?for($i=0; $data = fgetcsv($file, 1000,";"); $i++)
            {
                $pole = count($data);?>
                <tr>
                    <?for ($c=0; $c < $pole; $c++)
                    {?>
                        <td><? echo $data[$c]?></td>
                    <?}?>   
            <?}?>
            </table>
            <?fclose($file);
        }?>

        <?function write()
        {
            $check = true;
            $file_check = fopen('companies.csv', 'rt');
            for($i=0; $data_check = fgetcsv($file_check, 1000,";"); $i++)
            {
                if ($data_check[0] == $_POST["name"])
                {
                    echo  '<p class = "warning">Such company exist!</p>';
                    $check = false;
                    break;
                }
            }
            fclose($file_check);

            if ($check)
            {
                $list = [$_POST["name"].','. $_POST["address"].','. $_POST["phone"].','. $_POST["mail"]];
                $file = fopen('companies.csv','a');
                foreach($list as $line)
                {
                    fputcsv($file, explode(',', $line), ';');
                }
                fclose($file);  
            }
            
        }?>

        <? 
        function find()
        {
            $find = false;
            $file_find = fopen('companies.csv', 'rt');
            for($i=0; $data_find = fgetcsv($file_find, 1000,";"); $i++)
            {
                if ($data_find[0] == $_POST["find"])
                {
                    $find = true?>
                <div class="find_class">
                <table class="table_find">
                    <th>Name</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>E-mail</th>
                    <tr>
                        <td><?echo $data_find[0]?></td>
                        <td><?echo $data_find[1]?></td>
                        <td><?echo $data_find[2]?></td>
                        <td><?echo $data_find[3]?></td>
                    </tr>
                </table>   
                </div>
                
                <?break;
                }
            }
            fclose($file_find);
            if(!$find)
            {?>
              <p class="warning">Such company doesn't exist!</p>  
            <?}
        }
        ?>

</body>
</html> 