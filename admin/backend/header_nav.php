 <!-- navbar -->
 <div class="container-fluid g-0">
     <div class="row">
         <div class="col-lg-12 p-0 ">
             <div class="header_iner d-flex justify-content-between align-items-center">
                 <div class="sidebar_icon d-lg-none">
                     <i class="ti-menu"></i>
                 </div>
                 <div class="serach_field-area d-flex align-items-center">
                     <div class="search_inner">
                         <form action="#">
                             <div class="search_field">
                                 <input type="text" placeholder="Search here...">
                             </div>
                             <button type="submit"> <img src="assets/img/icon/icon_search.svg" alt> </button>
                         </form>
                     </div>
                     <span class="f_s_14 f_w_400 ml_25 white_text text_white">Apps</span>
                 </div>
                 <div class="header_notification_warp d-flex align-items-center">
                     <li>
                         <a
                             class=" "
                             href="#">
                             <img src="img/icon/bell.svg" alt />
                         </a>

                         
                     </li>
                     <li>
                         <a class="" href="#">
                             <img src="img/icon/msg.svg" alt />
                         </a>
                     </li>
                 </div>
                 <div class=" col-lg-6 header_right d-flex align-items-center justify-content-end">
                     <div class="profile_info d-flex align-items-center">
                         <img src="assets/img/users_logo.png" class="users-icon pr-2" alt="#">
                         <!-- <i class="fa-solid fa-user img users-icon ml-auto" style="width: 35px; height: auto; font-size: 25px;"></i> -->
                         <div class="profile_info_iner">
                             <div class="profile_author_name">
                                 <h5><?php echo $_SESSION['user_name'] ?? '' ?></h5>
                                 <p><?php echo $_SESSION['user_type'] ?? '' ?> </p>
                             </div>
                             <div class="profile_info_details">
                                 <a href="#">My Profile </a>
                                 <a href="#">Settings</a>
                                 <a href="logout.php">Log Out </a>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>