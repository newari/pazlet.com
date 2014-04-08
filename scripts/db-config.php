<?php
$allow=true;
if($allow==true){
    include_once("../classes/tdb.class.php");
    $tdbh=new tdb("root", "", "create new");
    
    if($tdbh->connection){
        $x=mysql_query("CREATE DATABASE charbhar");
        $y=mysql_query("CREATE USER 'fo_user'@'localhost' IDENTIFIED BY 'oct_password'");
        $z=mysql_query("GRANT SELECT, INSERT, UPDATE, DELETE ON charbhar.* TO 'fo_user'@'localhost'");
        $dbh=new tdb("root", "", "charbhar");
        if($dbh->connection){
            mysql_query('SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO"');
            mysql_query('SET time_zone = "+00:00"');

            mysql_query("CREATE TABLE IF NOT EXISTS `bank` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `payee_name` varchar(100) NOT NULL,
              `bank_name` varchar(100) NOT NULL,
              `ac_no` varchar(50) NOT NULL,
              `ifsc` varchar(50) NOT NULL,
              `mobile` varchar(10) NOT NULL,
              `email` varchar(200) NOT NULL,
              `date` datetime NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ");

             




            mysql_query("CREATE TABLE IF NOT EXISTS `billing` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `receipt_no` varchar(10) NOT NULL,
              `buyer_add` tinytext NOT NULL,
              `date` varchar(20) NOT NULL,
              `notes` tinytext NOT NULL,
              `service_des` varchar(100) NOT NULL,
              `qt` varchar(10) NOT NULL,
              `rate` varchar(15) NOT NULL,
              `st` varchar(10) NOT NULL,
              `amt` varchar(10) NOT NULL,
              `amt_word` varchar(50) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10") ;


             
             




            mysql_query("CREATE TABLE IF NOT EXISTS `coupons` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `utt` text NOT NULL,
              `i1` text NOT NULL,
              `t2` text NOT NULL,
              `time` datetime NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=94") ;

             




            mysql_query("CREATE TABLE IF NOT EXISTS `daily_info` (
              `id` int(4) NOT NULL AUTO_INCREMENT,
              `date` datetime NOT NULL,
              `last_day_regi` int(4) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ");


             

             




            mysql_query("CREATE TABLE IF NOT EXISTS `notifications` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `its_for` int(11) NOT NULL,
              `nf_desc` text NOT NULL,
              `link` tinytext NOT NULL,
              `its_from` varchar(20) NOT NULL,
              `nf_time` varchar(15) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=96") ;

             


            mysql_query("CREATE TABLE IF NOT EXISTS `recharge` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `user_id` int(11) NOT NULL,
              `mobile` varchar(12) NOT NULL,
              `amt` int(5) NOT NULL,
              `time` datetime NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ");
             




            mysql_query("CREATE TABLE IF NOT EXISTS `referral_marketing` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `referrer` varchar(100) NOT NULL,
              `user_id` int(11) NOT NULL,
              `time` datetime NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ");

             




            mysql_query("CREATE TABLE IF NOT EXISTS `tmp_users` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `first_name` varchar(50) NOT NULL,
              `last_name` varchar(50) NOT NULL,
              `dob` date NOT NULL,
              `gender` enum('male','female') NOT NULL,
              `mobile` varchar(10) NOT NULL,
              `email` varchar(100) NOT NULL,
              `password` varchar(100) NOT NULL,
              `activation_code` varchar(25) NOT NULL,
              `reg_time` datetime NOT NULL,
              `aprv_status` int(1) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ");


             




            mysql_query("CREATE TABLE IF NOT EXISTS `transfer_fund` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `transfer_to` int(11) NOT NULL,
              `bank_id` int(11) NOT NULL,
              `amt` int(5) NOT NULL,
              `request_date` datetime NOT NULL,
              `status` int(1) NOT NULL,
              `transfer_date` datetime NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ");


             

             




            mysql_query("CREATE TABLE IF NOT EXISTS `users` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `user_id` int(11) NOT NULL,
              `fb_id` int(50) NOT NULL,
              `username` varchar(100) NOT NULL,
              `password` varchar(25) NOT NULL,
              `first_name` varchar(50) NOT NULL,
              `last_name` varchar(100) NOT NULL,
              `dob` date NOT NULL,
              `gender` enum('male','female') NOT NULL DEFAULT 'male',
              `email` varchar(100) NOT NULL,
              `mobile` varchar(10) NOT NULL,
              `balance` int(5) NOT NULL,
              `coupons` varchar(10) NOT NULL,
              `bank_id` int(11) NOT NULL,
              `game_status` varchar(5) NOT NULL,
              `unseen_notification` int(3) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ");

             
             

            mysql_query("CREATE TABLE IF NOT EXISTS `bank` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `payee_name` varchar(100) NOT NULL,
              `bank_name` varchar(100) NOT NULL,
              `ac_no` varchar(50) NOT NULL,
              `ifsc` varchar(50) NOT NULL,
              `mobile` varchar(10) NOT NULL,
              `email` varchar(200) NOT NULL,
              `date` datetime NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ");

             




            mysql_query("CREATE TABLE IF NOT EXISTS `billing` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `receipt_no` varchar(10) NOT NULL,
              `buyer_add` tinytext NOT NULL,
              `date` varchar(20) NOT NULL,
              `notes` tinytext NOT NULL,
              `service_des` varchar(100) NOT NULL,
              `qt` varchar(10) NOT NULL,
              `rate` varchar(15) NOT NULL,
              `st` varchar(10) NOT NULL,
              `amt` varchar(10) NOT NULL,
              `amt_word` varchar(50) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10") ;


             
             




            mysql_query("CREATE TABLE IF NOT EXISTS `coupons` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `utt` text NOT NULL,
              `i1` text NOT NULL,
              `t2` text NOT NULL,
              `time` datetime NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=94") ;

             




            mysql_query("CREATE TABLE IF NOT EXISTS `daily_info` (
              `id` int(4) NOT NULL AUTO_INCREMENT,
              `date` datetime NOT NULL,
              `last_day_regi` int(4) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ");


             

             




            mysql_query("CREATE TABLE IF NOT EXISTS `notifications` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `its_for` int(11) NOT NULL,
              `nf_desc` text NOT NULL,
              `link` tinytext NOT NULL,
              `its_from` varchar(20) NOT NULL,
              `nf_time` varchar(15) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=96") ;

             


            mysql_query("CREATE TABLE IF NOT EXISTS `recharge` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `user_id` int(11) NOT NULL,
              `mobile` varchar(12) NOT NULL,
              `amt` int(5) NOT NULL,
              `time` datetime NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ");
             




            mysql_query("CREATE TABLE IF NOT EXISTS `referral_marketing` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `referrer` varchar(100) NOT NULL,
              `user_id` int(11) NOT NULL,
              `time` datetime NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ");

             




            mysql_query("CREATE TABLE IF NOT EXISTS `tmp_users` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `first_name` varchar(50) NOT NULL,
              `last_name` varchar(50) NOT NULL,
              `dob` date NOT NULL,
              `gender` enum('male','female') NOT NULL,
              `mobile` varchar(10) NOT NULL,
              `email` varchar(100) NOT NULL,
              `password` varchar(100) NOT NULL,
              `activation_code` varchar(25) NOT NULL,
              `reg_time` datetime NOT NULL,
              `aprv_status` int(1) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ");


             




            mysql_query("CREATE TABLE IF NOT EXISTS `transfer_fund` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `transfer_to` int(11) NOT NULL,
              `bank_id` int(11) NOT NULL,
              `amt` int(5) NOT NULL,
              `request_date` datetime NOT NULL,
              `status` int(1) NOT NULL,
              `transfer_date` datetime NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ");


             

             




            mysql_query("CREATE TABLE IF NOT EXISTS `users` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `user_id` int(11) NOT NULL,
              `fb_id` int(50) NOT NULL,
              `username` varchar(100) NOT NULL,
              `password` varchar(25) NOT NULL,
              `first_name` varchar(50) NOT NULL,
              `last_name` varchar(100) NOT NULL,
              `dob` date NOT NULL,
              `gender` enum('male','female') NOT NULL DEFAULT 'male',
              `email` varchar(100) NOT NULL,
              `mobile` varchar(10) NOT NULL,
              `inr_bal` int(5) NOT NULL,
              `coupons` varchar(10) NOT NULL,
              `bank_id` int(11) NOT NULL,
              `game_status` varchar(5) NOT NULL,
              `unseen_notification` int(3) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ");


            mysql_query("CREATE TABLE IF NOT EXISTS `t1_games` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `start_time` datetime NOT NULL,
              `content` varchar(150) NOT NULL,
              `content_table_id` int(5) NOT NULL,
              `crnt_plrs` int(6) NOT NULL,
              `a_plrs` text NOT NULL,
              `b_plrs` text NOT NULL,
              `c_plrs` text NOT NULL,
              `d_plrs` text NOT NULL,
              `e_plrs` text NOT NULL,
              `game_result` varchar(200) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ");
             
   


            mysql_query("CREATE TABLE IF NOT EXISTS `t1_content` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `game_id` int(5) NOT NULL,
              `content_src` varchar(20) NOT NULL,
              `a_content` text NOT NULL,
              `b_content` text NOT NULL,
              `c_content` text NOT NULL,
              `d_content` text NOT NULL,
              `e_content` text NOT NULL,
              `time` varchar(15) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ");

            mysql_query("CREATE TABLE IF NOT EXISTS `puzzles` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `puzzle_src` varchar(50) NOT NULL,
              `ans` varchar(100) NOT NULL,
              `solution` text NOT NULL,
              `used` int(11) NOT NULL,
              `upload_time` varchar(15) NOT NULL,
              `upload_by` int(11) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ");

            mysql_query('CREATE TABLE IF NOT EXISTS `uploaders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `reg_date` varchar(15) NOT NULL,
  `last_login` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ');
          mysql_query("INSERT INTO `uploaders` (`id`, `fname`, `lname`, `username`, `password`, `reg_date`, `last_login`) VALUES
(1, 'Master', 'Admin', 'masteradmin', 'password', '', '')");

        $dbh->add_clm("t1_games", "`crnt_money` INT(11) NOT NULL", "crnt_plrs");
        $dbh->add_clm("puzzles", "`last_used` INT(11) NOT NULL", "used");
        // $dbh->add_clm("tests", "`status` ENUM('closed', 'opened') NOT NULL DEFAULT 'closed'", "attempted_by");
        // $dbh->add_clm("test_packages", "`std_type` tinytext NOT NULL");
        
        $dbh->modify_clm("users", "`game_status`", "tinytext NOT NULL");
        // $dbh->change_clm("test_series", "`desc`", "`description`", "text NOT NULL");
            echo "Created succsessfully";
      

        }

    }else{
        echo "Error! Try again.";
        exit();
    }
}else{
    echo "ERROR! Please first Install this on Online server!";
}

?>