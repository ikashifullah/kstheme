<?php

/** bootstrap navigation walker for menus **/
require_once KSTHEME_CLS_DIR .'/wp_bootstrap_navwalker.php';
require_once KSTHEME_CLS_DIR .'/font-awesome-array.php'; // Load the font-awesome array

/** Widgets **/
require_once KSTHEME_WG_DIR .'/kstheme_company_profile.php';
require_once KSTHEME_WG_DIR .'/kstheme_pre_approved_form.php';
require_once KSTHEME_WG_DIR .'/kstheme_image_upload.php';
require_once KSTHEME_WG_DIR .'/kstheme_socials.php';
require_once KSTHEME_WG_DIR .'/kstheme_finance_programs.php';


/** Admin Panel **/
require_once KSTHEME_ADM_DIR."/post-meta-box.php";
require_once KSTHEME_ADM_DIR."/admin-menu.php";

?>