<?php    
session_start();
ob_start();
include 'conn.php';

$username = $_SESSION['username'];

?>
<!doctype html>
<html lang="en">

<head>
    <?php include 'head.php'; ?>
</head>

<body>
    <div class="wrapper" style="background: url('Dark_background_1920x1080.png') 
    center top no-repeat; background-size: cover;">
        <?php include 'sidebar.php'; ?>
        <div class="main-panel">
            <?php include 'nav.php'; ?>
            <div class="content">
                <div class="container-fluid">
                    <ol class='breadcrumb'>
                        <li>
                            <i class='fa fa-dashboard'></i> Dashboard
                        </li>
                        <li class='active'>
                            <i class='fa fa-dashboard'></i> Terms and Conditions
                        </li>
                    </ol>
                    <div class="card">
                        <div class="card-header" style="background-color: #242424;">
                                  <h2 class="title">CLUB MEMBERSHIP AGREEMENT</h2>
                        </div>
                        <div class="card-content">
            <!-- INSERT CODE HERE -->
                            <p>
                                I hereby apply for Club membership with OZ FITNESS CENTRE. I am returning this CLUB MEMBERSHIP AGREEMENT with full understanding of its provisions.
                                <br><br>

                                I hereby agree to the following terms, conditions and obligations of membership.
                                <br><br>
                                1. I attest and verify that I have obtained a medical clearance from my doctor and that I have full knowledge of the risk involved and that I am physically fit to join the club.
                                <br><br>
                                2. I accept full responsibility for the use of any and all apparatus, facility privilege or service whatsoever owned and operated by this Club at my own risk and shall not hold this Club, its shareholders, directors, officers, employees, representatives and agents harmless from any and all loss, claim, injury, theft, damage or liability sustained or incurred by me resulting therefrom.
                                <br><br>
                                3. My membership ID card is required for admittance to the Club and for uniform issue. NO ID. NO ENTRY. NO WORKOUT.
                                <br><br>
                                4. The club reserves the right to cancel, change or introduce rules at any time. It also reserves the right to cancel the membership of any guest abusing the Club rules and regulations as provided for at the Front Desk.
                                <br><br>
                                5. Termination of Membership will be served for the following reasons:
                                *Physical/Verbal Violence in the gym, Stealing; Vandalism; Use of illegal drugs or alcohol in the premises. Exercising under the influence or illegal substances or alcohol.
                                <br><br>
                                6. Health/Fitness is a commitment. Thus, your membership fee or programs enrolled in is NON-REFUNDABLE.
                                <br><br>
                                7. Any suggestions and complaints shall be in writing with my printed name and signature addressed to the General Manager. 
                                <br><br>
                                8. The Club has a PRO-SHOP, thus any form of selling by any member of any merchandise is strictly prohibited. In case a member/client wishes to supply products which are complimentary to the Club's needs/purposes, it shall only be entertained in writing addressed to the General Manager.
                                <br><br>
                                9. Failure to utilize the program enrolled in, whether on Monthly, Semi-Annual, Annual basis from the date of the first workout up to the date of expiration shall result in automatic forfeiture by the management. The same rules shall apply to clients using Gift Certificates issued by the Club.
                                <br><br>
                                10. I have thoroughly checked the facilities of the Club. That everything found in the gym suits my needs and goals.
                                <br><br>
                                11. I attest that I am of legal age and all information written at the back of the document is true. I have fully comprehended all the situations and conditions above mentioned.
                                <br><br>
                                12. That my membership will not be extended even if I file for any form of leave (travel or sick).

                            </p>
                                        <!-- <div class="clear"></div> -->



            <!--^ INSERT CODE HERE ^-->  
                        </div><!--/card-content-->
                    </div><!--./card-->
                </div><!--./container-fluid-->
            </div><!--./content-->
        </div><!--./main-panel-->
    </div><!--./wrappper-->
</body>
<?php include 'javascript.php';?>

</html>