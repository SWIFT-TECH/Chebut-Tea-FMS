<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo (!empty($user['photo'])) ? '../images/'.$user['photo'] : '../images/profile.jpg'; ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $user['firstname'].' '.$user['lastname']; ?></p>
          <a><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">REPORTS</li>
        <li class=""><a href="home.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        <li class="header">MANAGE</li>
        
        <li><a href="record.php"><i class="fa fa-calendar"></i> <span>Daily Records</span></a></li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i>
            <span>Farmers</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="farmer.php"><i class="fa fa-circle-o"></i> Farmers List</a></li>
            <li><a href="bonus.php"><i class="fa fa-circle-o"></i> Bonus</a></li>
            <li><a href="cashadvance.php"><i class="fa fa-circle-o"></i> Cash Advance</a></li>
            <li><a href="centre.php"><i class="fa fa-circle-o"></i> Collection Centres</a></li>
          </ul>
        </li>
        <li><a href="deduction.php"><i class="fa fa-file-text"></i> Deductions</a></li>
        <li><a href="rates.php"><i class="fa fa-suitcase"></i> Rates</a></li>
        <li class="header">PRINTABLES</li>
        <li><a href="payroll.php"><i class="fa fa-files-o"></i> <span>Payroll</span></a></li>
        <li><a href="centre_farmer.php"><i class="fa fa-clock-o"></i> <span>Manage Collection Centres</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>