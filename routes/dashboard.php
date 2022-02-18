<?php

    session_start();

    if(!isset($_SESSION['userdata']))
    {
        header("location: ../");
    }

    $userdata = $_SESSION['userdata'];
    $groupsdata = $_SESSION['groupsdata'];

    if($_SESSION['userdata']['status'] == 0)
    {
        $status = '<b style="color:red">Not Voted</b>';
    }
    else
    {
        $status = '<b style="color:green">Voted</b>';
    }

?>

<html>

    <head>

        <title>Online Voting System Dashboard</title>
        <link rel="stylesheet" href="../css/stylesheet.css">

    </head>

    <body>

        <style>

            #backbtn{

            padding: 10px;
            border-radius: 5px ;
            background-color: aqua;
            color: black;
            border: none;
            float: left;
            margin: 10px;

            }

            #logoutbtn{

            padding: 10px;
            border-radius: 5px ;
            background-color: aqua;
            color: black;
            border: none;
            float: right;
            margin: 10px;

            }

            #profile
            {

                background-color: aqua;
                width: 30%;
                padding: 20px;
                float: left;

            }

            #party
            {

                background-color: aqua;
                width: 60%;
                padding: 20px;
                float: right;

            }

            #votebtn
            {
                padding: 10px;
                border-radius: 5px ;
                background-color: blue;
                color: white;
                border: none;
                float: left;
            }

            #mainpanel
            {
                padding: 10px;
            }

            #voted
            {
                padding: 10px;
                border-radius: 5px ;
                background-color: green;
                color: white;
                border: none;
                float: left;
            }


        </style>

        <div id="mainSection">


            <center>
            <div id="headersection">

                <a href="../"><button id="backbtn">Back</button></a>
                <a href="logout.php"><button id="logoutbtn">Logout</button></a>

                <h1>Online Voting System</h1>
                <hr>
            </center>

            <div id="mainpanel">

                
                <div id="profile">
                        <center><img src="../uploads/<?php echo $userdata['photo'] ?>" height="100" width="100"></center><br><br>
                        <b>Name: </b><?php echo $userdata['name']?><br><br>
                        <b>Mobile: </b><?php echo $userdata['mobile']?><br><br>
                        <b>Address: </b><?php echo $userdata['address']?><br><br>
                        <b>Status: </b><?php echo $status?><br><br>
                </div>


                <div id="party">

                    <?php
                    
                        if($_SESSION['groupsdata'])
                        {
                            for( $i = 0; $i < count($groupsdata); $i++)
                            {
                                ?>

                                <div>
                                    <img style="float: right" src="../uploads/<?php echo $groupsdata[$i]['photo'] ?>" height="100" width="100"><br><br>
                                    <b>Group Name: </b><?php echo $groupsdata[$i]['name']?><br><br>
                                    <b>Votes: </b><?php echo $groupsdata[$i]['votes']?><br><br>
                                    <form action="../api/vote.php" method="POST">
                                        <input type="hidden" name="gvotes" value="<?php echo $groupsdata[$i]['votes']?>">
                                        <input type="hidden" name="gid" value="<?php echo $groupsdata[$i]['id']?>">
                                        <?php
                                            if($_SESSION['userdata']['status'] == 0)
                                            {
                                                ?>
                                                <input type="submit" name="votebtn" value="vote" id="votebtn">
                                                <?php
                                            }
                                            else
                                            {
                                                ?>
                                                <button disabled type="button" name="votebtn" value="vote" id="voted">Voted</button>
                                                <?php
                                            }
                                        ?>
                                    </form>
                                </div>

                                <?php
                            }
                        }
                        else
                        {

                        }
                    
                    ?>

                </div>

            </div>


            </div>

        </div>
        
    </body>

</html>