<?php header("Content-type: text/css");

include("../../../db.php");

$sql_colors = $mysqli->query("SELECT * FROM colors");
$ActiveRowColors = mysqli_fetch_array($sql_colors);
$sql_colors->close();

$whatsNewCol = stripslashes($ActiveRowColors['whats_new_col']);
$whatsNewColMono = stripslashes($ActiveRowColors['whats_new_col_mono']);
$whatsNewColBorder = stripslashes($ActiveRowColors['whats_new_col_border']);
$whatsNewColText = stripslashes($ActiveRowColors['whats_new_col_text']);
$featCol1 = stripslashes($ActiveRowColors['feat_col_1']);
$featCol1Mono = stripslashes($ActiveRowColors['feat_col_1_mono']);
$featCol1Border = stripslashes($ActiveRowColors['feat_col_1_border']);
$featCol2 = stripslashes($ActiveRowColors['feat_col_2']);
$featCol2Mono = stripslashes($ActiveRowColors['feat_col_2_mono']);
$featCol2Border = stripslashes($ActiveRowColors['feat_col_2_border']);
$featCol3 = stripslashes($ActiveRowColors['feat_col_3']);
$featCol3Mono = stripslashes($ActiveRowColors['feat_col_3_mono']);
$featCol3Border = stripslashes($ActiveRowColors['feat_col_3_border']);
$featCol4 = stripslashes($ActiveRowColors['feat_col_4']);
$featCol4Mono = stripslashes($ActiveRowColors['feat_col_4_mono']);
$featCol4Border = stripslashes($ActiveRowColors['feat_col_4_border']);
$featCol5 = stripslashes($ActiveRowColors['feat_col_5']);
$featCol5Mono = stripslashes($ActiveRowColors['feat_col_5_mono']);
$featCol5Border = stripslashes($ActiveRowColors['feat_col_5_border']);
$allCatCol = stripslashes($ActiveRowColors['all_cat_col']);
$allCatColMono = stripslashes($ActiveRowColors['all_cat_col_mono']);
$allCatColBorder = stripslashes($ActiveRowColors['all_cat_col_border']);
$mobWhatsNewCol = stripslashes($ActiveRowColors['mob_whats_new_color']);
$mobWhatsNewColMono = stripslashes($ActiveRowColors['mob_whats_new_color_mono']);
$mobWhatsNewColBorder = stripslashes($ActiveRowColors['mob_whats_new_color_border']);
$mobPopularCol = stripslashes($ActiveRowColors['mob_popular_color']);
$mobPopularColMono = stripslashes($ActiveRowColors['mob_popular_color_mono']);
$mobPopularColorBorder = stripslashes($ActiveRowColors['mob_popular_color_border']);
$mobGiftGuidesCol = stripslashes($ActiveRowColors['mob_gift_guides_color']);
$mobGiftGuidesColMono = stripslashes($ActiveRowColors['mob_gift_guides_color_mono']);
$mobGiftGuidesColBorder = stripslashes($ActiveRowColors['mob_gift_guides_color_border']);
$mobSearchCol = stripslashes($ActiveRowColors['mob_search_color']);
$mobSearchColMono = stripslashes($ActiveRowColors['mob_search_color_mono']);
$mobSearchColBorder = stripslashes($ActiveRowColors['mob_search_color_border']);
$btnCheckout = stripslashes($ActiveRowColors['btn_checkout']);
$btnSave = stripslashes($ActiveRowColors['btn_save']);
$btnSaveHover = stripslashes($ActiveRowColors['btn_save_hover']);
?>

.nav li:nth-child(7n+1)
{
  background: linear-gradient(to bottom, #<?= $whatsNewCol ?> 0, #<?= $whatsNewColMono ?> 100%);
}
.nav li:nth-child(7n+2)
{
  background: linear-gradient(to bottom, #<?= $featCol1 ?> 0, #<?= $featCol1Mono ?> 100%);
}
.nav li:nth-child(7n+3)
{
  background: linear-gradient(to bottom, #<?= $featCol2 ?> 0, #<?= $featCol2Mono ?> 100%);
}
.nav li:nth-child(7n+4)
{
  background: linear-gradient(to bottom, #<?= $featCol3 ?> 0, #<?= $featCol3Mono ?> 100%);
}
.nav li:nth-child(7n+5)
{
  background: linear-gradient(to bottom, #<?= $featCol4 ?> 0, #<?= $featCol4Mono ?> 100%);
}
.nav li:nth-child(7n+6)
{
  background: linear-gradient(to bottom, #<?= $featCol5 ?> 0, #<?= $featCol5Mono ?> 100%);
}
.nav li:nth-child(7n+7)
{
  background: linear-gradient(to bottom, #<?= $allCatCol ?> 0, #<?= $allCatColMono ?> 100%);
}
.nav li:nth-child(7n+2) a.selected,.nav li:nth-child(7n+2) a:active,.nav li:nth-child(7n+2) a:focus,.nav li:nth-child(7n+2) a:hover
{
  border-bottom:4px solid #<?= $featCol1Border ?>;
}
.nav li:nth-child(7n+3) a.selected,.nav li:nth-child(7n+3) a:active,.nav li:nth-child(7n+3) a:focus,.nav li:nth-child(7n+3) a:hover
{
  border-bottom:4px solid #<?= $featCol2Border ?>;
}
.nav li:nth-child(7n+4) a.selected,.nav li:nth-child(7n+4) a:active,.nav li:nth-child(7n+4) a:focus,.nav li:nth-child(7n+4) a:hover
{
  border-bottom:4px solid #<?= $featCol3Border ?>;
}
.nav li:nth-child(7n+5) a.selected,.nav li:nth-child(7n+5) a:active,.nav li:nth-child(7n+5) a:focus,.nav li:nth-child(7n+5) a:hover
{
  border-bottom:4px solid #<?= $featCol4Border ?>;
}
.nav li:nth-child(7n+6) a.selected,.nav li:nth-child(7n+6) a:active,.nav li:nth-child(7n+6) a:focus,.nav li:nth-child(7n+6) a:hover
{
  border-bottom:4px solid #<?= $featCol5Border ?>;
}
#mobile-nav ul li:nth-child(7n+1)
{
  background: linear-gradient(to bottom, #<?= $mobWhatsNewCol ?> 0, #<?= $mobWhatsNewColMono ?> 100%);
}
#mobile-nav ul li:nth-child(7n+2)
{
  background: linear-gradient(to bottom, #<?= $mobPopularCol ?> 0, #<?= $mobPopularColMono ?> 100%);
}
#mobile-nav ul li:nth-child(7n+3)
{
  background: linear-gradient(to bottom, #<?= $mobGiftGuidesCol ?> 0, #<?= $mobGiftGuidesColMono ?> 100%);
}
#mobile-nav ul li:nth-child(7n+4)
{
  background: linear-gradient(to bottom, #<?= $mobSearchCol ?> 0, #<?= $mobSearchColMono ?> 100%);
}
#mobile-nav ul li:nth-child(7n+1) a.selected, #mobile-nav ul li:nth-child(7n+1) a:active
{
  border-bottom:4px solid #<?= $mobWhatsNewColBorder ?>;
}
#mobile-nav ul li:nth-child(7n+2) a.selected, #mobile-nav ul li:nth-child(7n+2) a:active
{
  border-bottom:4px solid #<?= $mobPopularColorBorder ?>;
}
#mobile-nav ul li:nth-child(7n+3) a.selected, #mobile-nav ul li:nth-child(7n+3) a:active
{
  border-bottom:4px solid #<?= $mobGiftGuidesColBorder ?>;
}
#mobile-nav ul li:nth-child(7n+4) a.selected, #mobile-nav ul li:nth-child(7n+4) a:active
{
  border-bottom:4px solid #<?= $mobSearchColBorder ?>;
}