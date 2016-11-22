<!DOCTYPE html>
<html lang="fr">
  <head>
    <style type="text/css">
      body {
          padding: 0;
          margin: 0;
      }
      html { -webkit-text-size-adjust:none; -ms-text-size-adjust: none;}
      @media only screen and (max-device-width: 680px), only screen and (max-width: 680px) { 
          *[class="table_width_100"] {
          width: 96% !important;
        }
        *[class="border-right_mob"] {
          border-right: 1px solid #dddddd;
        }
        *[class="mob_100"] {
          width: 100% !important;
        }
        *[class="mob_center"] {
          text-align: center !important;
        }
        *[class="mob_center_bl"] {
          float: none !important;
          display: block !important;
          margin: 0px auto;
        } 
        .iage_footer a {
          text-decoration: none;
          color: #929ca8;
        }
        img.mob_display_none {
          width: 0px !important;
          height: 0px !important;
          display: none !important;
        }
        img.mob_width_50 {
          width: 40% !important;
          height: auto !important;
        }
      }
      .table_width_100 {
        width: 680px;
      }
    </style>
    <meta name="robots" content="noindex,nofollow" />
    <meta property="og:title" content="My First Campaign" />
  </head>
  <body>


<div id="mailsub" class="notification" align="center">

<table width="100%" border="0" cellspacing="0" cellpadding="0" style="min-width: 320px;"><tr><td align="center" bgcolor="#eff3f8">


<!--[if gte mso 10]>
<table width="680" border="0" cellspacing="0" cellpadding="0">
<tr><td>
<![endif]-->

<table border="0" cellspacing="0" cellpadding="0" class="table_width_100" width="100%" style="max-width: 680px; min-width: 300px;">
    <tr><td>
  <!-- padding --><div style="height: 80px; line-height: 80px; font-size: 10px;"></div>
  </td></tr>
  <!--header -->
  <tr><td align="center" bgcolor="#ffffff">
    <!-- padding --><div style="height: 30px; line-height: 30px; font-size: 10px;"></div>
    <table width="90%" border="0" cellspacing="0" cellpadding="0">
      <tr><td align="left"><!-- 

        Item --><div class="mob_center_bl" style="float: left; display: inline-block; width: 115px;">
          <table class="mob_center" width="115" border="0" cellspacing="0" cellpadding="0" align="left" style="border-collapse: collapse;">
            <tr><td align="left" valign="middle">
              <!-- padding --><div style="height: 20px; line-height: 20px; font-size: 10px;"></div>
              <table width="115" border="0" cellspacing="0" cellpadding="0" >
                <tr><td align="left" valign="top" class="mob_center">
                  <div style="line-height: 24px;">
                    <font face="Arial, Helvetica, sans-seri; font-size: 13px;" size="3" color="#596167">
                    <img src="cid:<?php echo $cid; ?>" width="115" alt="Company" border="0" style="display: block;" /></font>
                  </div>
                </td></tr>
              </table>            
            </td></tr>
          </table></div><!-- Item END--><!--[if gte mso 10]>
          </td>
          <td align="right">
        <![endif]--><!-- 

        Item --><div class="mob_center_bl" style="float: right; display: inline-block; width: 88px;">
          <table width="88" border="0" cellspacing="0" cellpadding="0" align="right" style="border-collapse: collapse;">
            <tr><td align="right" valign="middle">
              <!-- padding --><div style="height: 20px; line-height: 20px; font-size: 10px;"></div>
            </td></tr>
          </table></div><!-- Item END--></td>
      </tr>
    </table>
    <!-- padding --><div style="height: 50px; line-height: 50px; font-size: 10px;"></div>
  </td></tr>
  <!--header END-->

  <!--content 1 -->
  <tr><td align="center" bgcolor="#fbfcfd">
    <table width="90%" border="0" cellspacing="0" cellpadding="0">
      <tr><td align="center">
        <!-- padding --><div style="height: 60px; line-height: 60px; font-size: 10px;"></div>
        <div style="line-height: 44px;">
          <font face="Arial, Helvetica, sans-serif" size="5" color="#57697e" style="font-size: 34px;">
          <span style="font-family: Arial, Helvetica, sans-serif; font-size: 34px; color: #57697e; text-transform: uppercase;">
            <?php echo $w_title; ?>
          </span></font>
        </div>
        <!-- padding --><div style="height: 40px; line-height: 40px; font-size: 10px;"></div>
      </td></tr>
      <tr>
        <td>
          <div style="line-height: 24px;">
            <font face="Arial, Helvetica, sans-serif" size="4" color="#57697e" style="font-size: 15px;">
            <span style="font-family: Arial, Helvetica, sans-serif; font-size: 15px; color: #57697e;">
              Site web : <a href="<?php echo $w_url_rw; ?>"><?php echo $w_url_rw; ?></a>
            </span></font>
          </div>
          <div style="line-height: 24px;">
            <font face="Arial, Helvetica, sans-serif" size="4" color="#57697e" style="font-size: 15px;">
            <span style="font-family: Arial, Helvetica, sans-serif; font-size: 15px; color: #57697e;">
              Langages site web : <?php echo $l_title; ?>
            </span></font>
          </div>
          <div style="height: 40px; line-height: 40px; font-size: 10px;"></div>
        </td>
      </tr>
      <?php if ($check_bo == "on") { ?>
      <tr>
        <td>
          <div style="line-height: 24px;">
            <font face="Arial, Helvetica, sans-serif" size="4" color="#57697e" style="font-size: 15px;">
            <span style="font-family: Arial, Helvetica, sans-serif; font-size: 15px; color: #57697e;">
              Acces Backoffice
            </span></font>
          </div>
          <div style="line-height: 24px;">
            <font face="Arial, Helvetica, sans-serif" size="4" color="#57697e" style="font-size: 15px;">
            <span style="font-family: Arial, Helvetica, sans-serif; font-size: 15px; color: #57697e;">
              Utilisateur  : <?php echo $w_admin_login; ?>
            </span></font>
          </div>
          <div style="line-height: 24px;">
            <font face="Arial, Helvetica, sans-serif" size="4" color="#57697e" style="font-size: 15px;">
            <span style="font-family: Arial, Helvetica, sans-serif; font-size: 15px; color: #57697e;">
              Mot de passe : <?php echo $w_admin_password; ?>
            </span></font>
          </div>
          <div style="height: 40px; line-height: 40px; font-size: 10px;"></div>
        </td>
      </tr>
      <?php } ?>
      <?php if ($check_ftp == "on") { ?>
      <tr>
        <td>
          <div style="line-height: 24px;">
            <font face="Arial, Helvetica, sans-serif" size="4" color="#57697e" style="font-size: 15px;">
            <span style="font-family: Arial, Helvetica, sans-serif; font-size: 15px; color: #57697e;">
              Acces FTP
            </span></font>
          </div>
          <div style="line-height: 24px;">
            <font face="Arial, Helvetica, sans-serif" size="4" color="#57697e" style="font-size: 15px;">
            <span style="font-family: Arial, Helvetica, sans-serif; font-size: 15px; color: #57697e;">
              Serveur : <?php echo $w_host_ftp; ?>
            </span></font>
          </div>
          <div style="line-height: 24px;">
            <font face="Arial, Helvetica, sans-serif" size="4" color="#57697e" style="font-size: 15px;">
            <span style="font-family: Arial, Helvetica, sans-serif; font-size: 15px; color: #57697e;">
              Utilisateur : <?php echo $w_login_ftp; ?>
            </span></font>
          </div>
          <div style="line-height: 24px;">
            <font face="Arial, Helvetica, sans-serif" size="4" color="#57697e" style="font-size: 15px;">
            <span style="font-family: Arial, Helvetica, sans-serif; font-size: 15px; color: #57697e;">
              Mot de passe : <?php echo $w_password_ftp; ?>
            </span></font>
          </div>
          <div style="height: 40px; line-height: 40px; font-size: 10px;"></div>
        </td>
      </tr>
      <?php } ?>
      <?php if ($check_db == "on") { ?>
      <tr>
        <td>
          <div style="line-height: 24px;">
            <font face="Arial, Helvetica, sans-serif" size="4" color="#57697e" style="font-size: 15px;">
            <span style="font-family: Arial, Helvetica, sans-serif; font-size: 15px; color: #57697e;">
              Acces Base de donnee
            </span></font>
          </div>
          <div style="line-height: 24px;">
            <font face="Arial, Helvetica, sans-serif" size="4" color="#57697e" style="font-size: 15px;">
            <span style="font-family: Arial, Helvetica, sans-serif; font-size: 15px; color: #57697e;">
              Serveur : <?php echo $w_host_db; ?>
            </span></font>
          </div>
          <div style="line-height: 24px;">
            <font face="Arial, Helvetica, sans-serif" size="4" color="#57697e" style="font-size: 15px;">
            <span style="font-family: Arial, Helvetica, sans-serif; font-size: 15px; color: #57697e;">
              Nom base de donnee : <?php echo $w_name_db; ?>
            </span></font>
          </div>
          <div style="line-height: 24px;">
            <font face="Arial, Helvetica, sans-serif" size="4" color="#57697e" style="font-size: 15px;">
            <span style="font-family: Arial, Helvetica, sans-serif; font-size: 15px; color: #57697e;">
              Utilisateur : <?php echo $w_login_db; ?>
            </span></font>
          </div>
          <div style="line-height: 24px;">
            <font face="Arial, Helvetica, sans-serif" size="4" color="#57697e" style="font-size: 15px;">
            <span style="font-family: Arial, Helvetica, sans-serif; font-size: 15px; color: #57697e;">
              Mot de passe : <?php echo $w_password_db; ?>
            </span></font>
          </div>
          <div style="height: 40px; line-height: 40px; font-size: 10px;"></div>
        </td>
      </tr>
      <?php } ?>
      <tr><td align="center">
        <div style="line-height: 24px;">
          <a href="#" target="_blank" style="color: #596167; font-family: Arial, Helvetica, sans-serif; font-size: 13px;">
            <font face="Arial, Helvetica, sans-seri; font-size: 13px;" size="3" color="#596167">
            <a href="mailto:<?php echo $w_email; ?>" style="display: inline-block; padding: 6px 12px; margin-bottom: 0; font-size: 14px; font-weight: 700; line-height: 1.42857143; text-align: center; white-space: nowrap; vertical-align: middle; -ms-touch-action: manipulation; touch-action: manipulation; cursor: pointer; -webkit-user-select: none; -moz-user-select: none; -ms-user-select: none; user-select: none; background-image: none; border: 1px solid transparent; border-radius: 4px; color: #fff; background-color: #FF6B57; border-color: #FF6B57;">
              Contacter le webmaster
            </a>
        </div>
        <!-- padding --><div style="height: 60px; line-height: 60px; font-size: 10px;"></div>
      </td></tr>
    </table>    
  </td></tr>
  <!--content 1 END-->

  <!--footer -->
  <tr><td class="iage_footer" align="center" bgcolor="#ffffff">
    <!-- padding --><div style="height: 80px; line-height: 80px; font-size: 10px;"></div>  
    
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr><td align="center">
        <font face="Arial, Helvetica, sans-serif" size="3" color="#96a5b5" style="font-size: 13px;">
        <span style="font-family: Arial, Helvetica, sans-serif; font-size: 13px; color: #96a5b5;">
          2015 &copy; Company. ALL Rights Reserved.
        </span></font>        
      </td></tr>      
    </table>
    
    <!-- padding --><div style="height: 30px; line-height: 30px; font-size: 10px;"></div>  
  </td></tr>
  <!--footer END-->
  <tr><td>
  <!-- padding --><div style="height: 80px; line-height: 80px; font-size: 10px;"></div>
  </td></tr>
</table>
<!--[if gte mso 10]>
</td></tr>
</table>
<![endif]-->
 
</td></tr>
</table>
      
</div>

</body>
</html>