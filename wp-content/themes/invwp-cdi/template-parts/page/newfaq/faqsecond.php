
<div class="container body-container" style="padding:100px 0px;">
<?php if( have_rows('faq_collapse') ): ?>
    <?php while( have_rows('faq_collapse') ): the_row(); 
        $title = get_sub_field('accordion_title');
        $desc = get_sub_field('accordion_description');
        ?>
        <div class="accordion">
  <div class="group">
    <a href="#"><?php echo $title; ?></a>
    <p class="body-part"><?php echo $desc; ?></p>
    </a>
   </div>
</div>
    <?php endwhile; ?>
<?php endif; ?>
</div>

<style>

.group .body-part{display:none;padding: 19px 25px;}
.accordion{border:1px double #FF0000;;padding: 25px 0;} 
.group{margin-top: -10px;margin-left: 21px;}
.group a::after{content:"🠹"; float:right;padding-right:-5px;margin-right: 31px;cursor: pointer;}
.active .group a::after{content:"🠻";}
.group a{display: block;font-size: 20px;}

</style>
<script>
    $(document).ready(function(){

$(".accordion .group a").click(function(){
 if($(this).closest(".accordion").hasClass("active")) {
   $(this).closest(".accordion").removeClass("active");
   $(this).closest(".accordion").find(".body-part").slideUp();
 }else{
   $(".accordion").removeClass("active");
   $(".accordion").find(".body-part").slideUp();
   $(this).closest(".accordion").addClass("active");
   $(this).closest(".accordion").find(".body-part").slideDown();
 }
})
})
</script>
