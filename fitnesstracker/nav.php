<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">
                    <i class="fa fa-play-circle"></i> <span class="light">OZZ</span> FITNESS CENTER
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="../CUSTOMER1/customer_index.php">HOME</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="dashboard.php">MY FITNESS TRACKER</a>
                   </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            ABOUT <b class="caret"></b></a>
                              <ul class="dropdown-menu">
                                <li>
                                    <a class="page-scroll" href="../CUSTOMER1/aboutus.php">ABOUT OZZ</a></a>
                                </li>
                                <li>
                                    <a class="page-scroll" href="../CUSTOMER1/classes.php">Classes</a>
                                </li>
                                <li>
                                    <a class="page-scroll" href="../CUSTOMER1/trainers.php">Trainers</a>
                                </li>
                                <li>
                                    <a class="page-scroll" href="#contact">CONTACT US</a></a>
                                </li>
                              </ul>

                    </li>
                    
                    
                    
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="glyphicon glyphicon-user"></span> Welcome, <?php echo $username ?>! <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                          <li>
                              <a class="page-scroll" href="../CUSTOMER1/customer_transactions.php">Transactions</a>
                          </li>
                          <li>
                              <a class="page-scroll" href="../CUSTOMER1/enrolledclasses.php">Enrolled Classes</a>
                          </li>
                          <li>
                              <a class="page-scroll" href="../CUSTOMER1/enlistedclasses.php">Enlisted Classes</a>
                          </li>
                          <li>

                            <?php
                              $memTest = mysqli_query($conn, "SELECT * FROM tbl_members WHERE custinfo_id = '$custinfo_id'");
                              while ($show = mysqli_fetch_array($memTest))
                              {
                                  $isActive = $show['isActive'];
                              }

                              if ($isActive == 1)
                              {
                                  echo '<a class="page-scroll" data-toggle="modal" data-target="#uploadpayment"> Upload Payment</a>';
                              }
                              else
                              {
                                echo '<a class="page-scroll" data-toggle="modal" data-target="#uploadpayment2"> Upload Payment</a>';
                              }
                            ?>
                              
                          </li>
                          <li>
                              <a class="page-scroll" href="../logout.php">Log Out</a>
                          </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>